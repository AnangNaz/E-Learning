<?php

include '../components/connect.php';

if(!isset($_COOKIE['tutor_id'])){
   header('location:login.php');
   exit;
}

$tutor_id = $_COOKIE['tutor_id'];

if(isset($_POST['submit'])){

   $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
   $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
   $mapel_id = filter_var($_POST['mapel_id'], FILTER_SANITIZE_STRING);

   // materi teks panjang
   $materi = filter_var($_POST['materi'], FILTER_SANITIZE_STRING);

   // insert ke tabel materi (hapus kolom file)
   $insert = $conn->prepare("
      INSERT INTO materi (tutor_id, playlist_id, title, description, materi)
      VALUES (?,?,?,?,?)
   ");

   $insert->execute([$tutor_id, $mapel_id, $title, $description, $materi]);

   $message[] = 'Materi berhasil ditambahkan!';
}

?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
   <title>Add Materi</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="../css/styleadmin.css">
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="form-container">

<form method="post">
   <h3>Tambah Materi</h3>

   <?php
      if(isset($message)){
         foreach($message as $msg){
            echo '<p class="success">'.$msg.'</p>';
         }
      }
   ?>

   <p>Judul Materi</p>
   <input type="text" name="title" required class="box">

   <p>Pilih Mapel (Kerajaan)</p>
   <select name="mapel_id" class="box" required>
      <?php
         $m = $conn->prepare("SELECT * FROM mapel WHERE tutor_id=?");
         $m->execute([$tutor_id]);
         while($row = $m->fetch(PDO::FETCH_ASSOC)){
            echo '<option value="'.$row['id'].'">'.$row['nama_kerajaan'].'</option>';
         }
      ?>
   </select>

   <p>Deskripsi</p>
   <textarea name="description" class="box" rows="4" required></textarea>

   <p>Isi Materi (Teks Panjang)</p>
   <textarea name="materi" class="box" rows="12" required placeholder="Tulis materi lengkap di sini..."></textarea>

   <input type="submit" name="submit" value="Simpan Materi" class="btn">
</form>

</section>

<?php include '../components/footer.php'; ?>
<script src="../js/admin_script.js"></script>

</body>
</html>
