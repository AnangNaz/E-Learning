<?php

include '../components/connect.php';

if(!isset($_COOKIE['tutor_id'])){
   header('location:login.php');
}

$tutor_id = $_COOKIE['tutor_id'];

if(isset($_POST['submit'])){

   $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
   $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
   $playlist_id = filter_var($_POST['playlist_id'], FILTER_SANITIZE_STRING);

   $file = $_FILES['file']['name'];
   $ext = pathinfo($file, PATHINFO_EXTENSION);
   $rename = uniqid().'.'.$ext;
   $tmp_name = $_FILES['file']['tmp_name'];
   move_uploaded_file($tmp_name, '../uploaded_files/'.$rename);

   $insert = $conn->prepare("INSERT INTO materi (tutor_id, playlist_id, title, description, file) VALUES (?,?,?,?,?)");
   $insert->execute([$tutor_id, $playlist_id, $title, $description, $rename]);

   $message[] = 'Materi berhasil ditambahkan!';
}

?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
   <title>Add Materi</title>
      <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="../css/styleadmin.css">
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="form-container">

<form method="post" enctype="multipart/form-data">
   <h3>Tambah Materi</h3>

   <p>Judul Materi</p>
   <input type="text" name="title" required class="box">

   <p>Playlist</p>
   <select name="playlist_id" class="box">
      <?php
         $p = $conn->prepare("SELECT * FROM playlist WHERE tutor_id=?");
         $p->execute([$tutor_id]);
         while($row = $p->fetch(PDO::FETCH_ASSOC)){
            echo '<option value="'.$row['id'].'">'.$row['title'].'</option>';
         }
      ?>
   </select>

   <p>Deskripsi</p>
   <textarea name="description" class="box" rows="4"></textarea>

   <p>Upload File Materi (PDF/DOC/TXT)</p>
   <input type="file" name="file" accept=".pdf,.doc,.docx,.txt" required class="box">

   <input type="submit" name="submit" value="Upload Materi" class="btn">
</form>

</section>
<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>
.
</body>
</html>
