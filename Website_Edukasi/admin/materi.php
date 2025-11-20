<?php

include '../components/connect.php';

if(!isset($_COOKIE['tutor_id'])){
   header('location:login.php');
}

$tutor_id = $_COOKIE['tutor_id'];

/* ============================
      DELETE VIDEO
============================ */
if(isset($_POST['delete_video'])){
   $id = $_POST['video_id'];

   $check = $conn->prepare("SELECT * FROM content WHERE id=? LIMIT 1");
   $check->execute([$id]);

   if($check->rowCount() > 0){
      $file = $check->fetch(PDO::FETCH_ASSOC);

      if(!empty($file['thumb']) && file_exists("../uploaded_files/".$file['thumb'])){
         unlink("../uploaded_files/".$file['thumb']);
      }

      if(!empty($file['video']) && file_exists("../uploaded_files/".$file['video'])){
         unlink("../uploaded_files/".$file['video']);
      }

      $del_likes = $conn->prepare("DELETE FROM likes WHERE content_id=?");
      $del_likes->execute([$id]);

      $del_com = $conn->prepare("DELETE FROM comments WHERE content_id=?");
      $del_com->execute([$id]);

      $delete = $conn->prepare("DELETE FROM content WHERE id=?");
      $delete->execute([$id]);
   }
}

/* ============================
      DELETE MATERI
============================ */
if(isset($_POST['delete_materi'])){
   $id = $_POST['materi_id'];

   $check = $conn->prepare("SELECT * FROM materi WHERE id=? LIMIT 1");
   $check->execute([$id]);

   if($check->rowCount() > 0){
      $row = $check->fetch(PDO::FETCH_ASSOC);

      if(!empty($row['file']) && file_exists("../uploaded_files/".$row['file'])){
         unlink("../uploaded_files/".$row['file']);
      }

      $delete = $conn->prepare("DELETE FROM materi WHERE id=?");
      $delete->execute([$id]);
   }
}

/* ============================
      DELETE SOAL
============================ */
if(isset($_POST['delete_soal'])){
   $id = $_POST['soal_id'];

   $delete = $conn->prepare("DELETE FROM soal WHERE id=?");
   $delete->execute([$id]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Materi</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="../css/styleadmin.css">
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="contents">

<h1 class="heading">Manajemen Pembelajaran</h1>

<div class="box-container">

   <!-- Tombol tambah video -->
   <div class="box" data-type="video" style="text-align:center;">
      <h3 class="title">Video</h3>
      <a href="tambah_video.php" class="btn">Tambah Video</a>
   </div>

   <!-- Tombol tambah materi -->
   <div class="box" data-type="materi" style="text-align:center;">
      <h3 class="title">Materi</h3>
      <a href="tambah_materi.php" class="btn">Tambah Materi</a>
   </div>

   <!-- Tombol tambah soal -->
   <div class="box" data-type="soal" style="text-align:center;">
      <h3 class="title">Soal</h3>
      <a href="tambah_soal.php" class="btn">Tambah Soal</a>
   </div>

</div>

<hr><br>

<!-- =======================
       LIST VIDEO
======================= -->
<h2 class="heading">Video Pembelajaran</h2>

<div class="box-container">
<?php
$videos = $conn->prepare("SELECT * FROM content WHERE tutor_id=? ORDER BY date DESC");
$videos->execute([$tutor_id]);

if($videos->rowCount() > 0){
   while($row = $videos->fetch(PDO::FETCH_ASSOC)){
?>
   <div class="box">
      <img src="../uploaded_files/<?= $row['thumb']; ?>" class="thumb">
      <h3 class="title"><?= $row['title']; ?></h3>
      <p>Status: <?= $row['status']; ?></p>

      <form method="post" class="flex-btn">
         <input type="hidden" name="video_id" value="<?= $row['id']; ?>">
         <a href="update_video.php?id=<?= $row['id']; ?>" class="option-btn">update</a>
         <button type="submit" name="delete_video" class="delete-btn" onclick="return confirm('Hapus video ini?');">delete</button>
      </form>

      <a href="view_video.php?id=<?= $row['id']; ?>" class="btn">view</a>
   </div>
<?php
   }
}else{
   echo '<p class="empty">Belum ada video!</p>';
}
?>
</div>


<!-- =======================
       LIST MATERI
======================= -->
<h2 class="heading">Materi</h2>

<div class="box-container">
<?php
$materi = $conn->prepare("SELECT * FROM materi WHERE tutor_id=? ORDER BY date DESC");
$materi->execute([$tutor_id]);

if($materi->rowCount() > 0){
   while($row = $materi->fetch(PDO::FETCH_ASSOC)){
?>
   <div class="box">
      <h3 class="title"><?= $row['title']; ?></h3>
      <p><?= $row['description']; ?></p>

      <form method="post" class="flex-btn">
         <input type="hidden" name="materi_id" value="<?= $row['id']; ?>">
         <a href="update_materi.php?id=<?= $row['id']; ?>" class="option-btn">update</a>
         <button type="submit" name="delete_materi" class="delete-btn" onclick="return confirm('Hapus materi ini?');">delete</button>
      </form>

      <a href="view_materi.php?id=<?= $row['id']; ?>" class="btn">view</a>
   </div>
<?php
   }
}else{
   echo '<p class="empty">Belum ada materi!</p>';
}
?>
</div>


<!-- =======================
       LIST SOAL
======================= -->
<h2 class="heading">Bank Soal</h2>

<div class="box-container">
<?php
$soal = $conn->prepare("
   SELECT soal.*, content.title AS video_title
   FROM soal 
   LEFT JOIN content ON soal.content_id = content.id
   WHERE soal.tutor_id=?
   ORDER BY soal.date DESC
");
$soal->execute([$tutor_id]);

if($soal->rowCount() > 0){
   while($row = $soal->fetch(PDO::FETCH_ASSOC)){
?>
   <div class="box">
      <h3 class="title"><?= $row['question']; ?></h3>
      <p>Video terkait: <b><?= $row['video_title']; ?></b></p>
      <p>Jawaban benar: <?= $row['correct_option']; ?></p>

      <form method="post" class="flex-btn">
         <input type="hidden" name="soal_id" value="<?= $row['id']; ?>">
         <a href="update_soal.php?id=<?= $row['id']; ?>" class="option-btn">update</a>
         <button type="submit" name="delete_soal" class="delete-btn" onclick="return confirm('Hapus soal ini?');">delete</button>
      </form>

      <a href="view_soal.php?id=<?= $row['id']; ?>" class="btn">view</a>
   </div>
<?php
   }
}else{
   echo '<p class="empty">Belum ada soal!</p>';
}
?>
</div>

</section>

<?php include '../components/footer.php'; ?>
<script src="../js/admin_script.js"></script>

</body>
</html>
