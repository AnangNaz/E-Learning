<?php

include '../components/connect.php';

if(!isset($_COOKIE['tutor_id'])){
   header('location:login.php');
   exit;
}

$tutor_id = $_COOKIE['tutor_id'];

if(isset($_POST['submit'])){

   $id = unique_id();
   $status = filter_var($_POST['status'], FILTER_SANITIZE_STRING);
   $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
   $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
   // field form tetap name="playlist" agar kompatibel, nilainya adalah id dari tabel mapel
   $playlist = filter_var($_POST['playlist'], FILTER_SANITIZE_STRING);

   // thumbnail
   $thumb = $_FILES['thumb']['name'];
   $thumb = filter_var($thumb, FILTER_SANITIZE_STRING);
   $thumb_ext = pathinfo($thumb, PATHINFO_EXTENSION);
   $rename_thumb = unique_id().'.'.$thumb_ext;
   $thumb_size = $_FILES['thumb']['size'];
   $thumb_tmp_name = $_FILES['thumb']['tmp_name'];
   $thumb_folder = '../uploaded_files/'.$rename_thumb;

   // video
   $video = $_FILES['video']['name'];
   $video = filter_var($video, FILTER_SANITIZE_STRING);
   $video_ext = pathinfo($video, PATHINFO_EXTENSION);
   $rename_video = unique_id().'.'.$video_ext;
   $video_tmp_name = $_FILES['video']['tmp_name'];
   $video_folder = '../uploaded_files/'.$rename_video;

   // validasi ukuran thumbnail (contoh)
   if($thumb_size > 2000000){
      $message[] = 'Ukuran gambar terlalu besar (maks 2MB).';
   }else{
      // insert ke tabel content (kolom playlist_id sesuai struktur content kamu)
      $insert = $conn->prepare("INSERT INTO `content` (id, tutor_id, playlist_id, title, description, video, thumb, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
      $insert->execute([$id, $tutor_id, $playlist, $title, $description, $rename_video, $rename_thumb, $status]);

      // pindah file
      move_uploaded_file($thumb_tmp_name, $thumb_folder);
      move_uploaded_file($video_tmp_name, $video_folder);

      $message[] = 'Video berhasil diunggah!';
   }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
   <meta charset="UTF-8">
   <title>Tambah Video</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="../css/styleadmin.css">
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="video-form">

   <h1 class="heading">Tambah Video</h1>

   <?php
   if(isset($message)){
      foreach($message as $m){
         echo '<p class="success">'.$m.'</p>';
      }
   }
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <p>Status Video <span>*</span></p>
      <select name="status" class="box" required>
         <option value="" selected disabled>-- pilih status --</option>
         <option value="active">active</option>
         <option value="deactive">deactive</option>
      </select>

      <p>Judul Video <span>*</span></p>
      <input type="text" name="title" maxlength="100" required placeholder="Masukkan judul video" class="box">

      <p>Deskripsi Video <span>*</span></p>
      <textarea name="description" class="box" required placeholder="Tulis deskripsi" maxlength="1000" cols="30" rows="6"></textarea>

      <p>Mata Pelajaran (Mapel) <span>*</span></p>
      <select name="playlist" class="box" required>
         <option value="" disabled selected>-- pilih mata pelajaran --</option>
         <?php
            $select_mapel = $conn->prepare("SELECT id, nama_kerajaan FROM mapel ORDER BY nama_kerajaan ASC");
$select_mapel->execute();


$select_mapel = $conn->prepare("SELECT id, nama_kerajaan FROM mapel ORDER BY nama_kerajaan ASC");
$select_mapel->execute();

if($select_mapel->rowCount() > 0){
    while($mp = $select_mapel->fetch(PDO::FETCH_ASSOC)){
        echo '<option value="'.htmlspecialchars($mp['id']).'">'.htmlspecialchars($mp['nama_kerajaan']).'</option>';
    }
}else{
    echo '<option value="" disabled>Belum ada mata pelajaran</option>';
}

         ?>
      </select>

      <p>Pilih Thumbnail <span>*</span></p>
      <input type="file" name="thumb" accept="image/*" required class="box">

      <p>Pilih File Video <span>*</span></p>
      <input type="file" name="video" accept="video/*" required class="box">

      <input type="submit" name="submit" value="Upload Video" class="btn">
   </form>

</section>

<?php include '../components/footer.php'; ?>
<script src="../js/admin_script.js"></script>
</body>
</html>
