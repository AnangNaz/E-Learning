<?php

include '../components/connect.php';

if(!isset($_COOKIE['tutor_id'])){
    header("location: login.php");
    exit;
}

$tutor_id = $_COOKIE['tutor_id'];

if(!isset($_GET['get_id'])){
    header("location: mapel.php");
    exit;
}

$playlist_id = $_GET['get_id']; // mapel_id = playlist_id



// ==========================
// Ambil detail mapel / playlist
// ==========================
$select_mapel = $conn->prepare("SELECT * FROM mapel WHERE id = ? AND tutor_id = ?");
$select_mapel->execute([$playlist_id, $tutor_id]);
$fetch_mapel = $select_mapel->fetch(PDO::FETCH_ASSOC);

if(!$fetch_mapel){
    echo "<p class='empty'>Mapel / Playlist tidak ditemukan!</p>";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Detail Mapel</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="../css/styleadmin.css">
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="playlist-details">
   <h1 class="heading">Detail Kerajaan</h1>

   <div class="row">
      <div class="thumb">
         <img src="../uploaded_files/<?= $fetch_mapel['foto_raja']; ?>">
      </div>

      <div class="details">
         <h3 class="title"><?= $fetch_mapel['nama_kerajaan']; ?></h3>
         
         <p><b>Tahun Berdiri:</b> <?= $fetch_mapel['tahun_berdiri']; ?></p>
         <p><b>Lokasi:</b> <?= $fetch_mapel['lokasi']; ?></p>

         <p class="description"><?= $fetch_mapel['deskripsi']; ?></p>

         <p><b>Daftar Raja:</b><br><?= nl2br($fetch_mapel['daftar_raja']); ?></p>

         <div class="flex-btn">
            <a href="update_mapel.php?get_id=<?= $playlist_id ?>" class="option-btn">Update Mapel</a>
         </div>
      </div>
   </div>
</section>






<!-- ========================================= -->
<!--               VIDEO PEMBELAJARAN          -->
<!-- ========================================= -->

<section class="contents">
   <h1 class="heading">Video Pembelajaran</h1>
   <div class="box-container">

<?php

$video = $conn->prepare("SELECT * FROM content WHERE playlist_id = ? AND tutor_id = ?");
$video->execute([$playlist_id, $tutor_id]);

if($video->rowCount() > 0){
    while($v = $video->fetch(PDO::FETCH_ASSOC)){
?>

      <div class="box">
         <img src="../uploaded_files/<?= $v['thumb']; ?>" class="thumb">
         <h3 class="title"><?= $v['title']; ?></h3>
         <a href="view_content.php?get_id=<?= $v['id']; ?>" class="btn">Tonton Video</a>
      </div>

<?php
    }
} else {
    echo "<p class='empty'>Belum ada video pada mapel ini!</p>";
}

?>

   </div>
</section>






<!-- ========================================= -->
<!--               MATERI PEMBELAJARAN         -->
<!-- ========================================= -->

<section class="contents">
   <h1 class="heading">Materi Pembelajaran</h1>
   <div class="box-container">

<?php

$materi = $conn->prepare("SELECT * FROM materi WHERE playlist_id = ? AND tutor_id = ?");
$materi->execute([$playlist_id, $tutor_id]);

if($materi->rowCount() > 0){
    while($m = $materi->fetch(PDO::FETCH_ASSOC)){
?>

      <div class="box">
         <h3 class="title"><?= $m['title']; ?></h3>

         <!-- Arahkan ke halaman view materi -->
         <a href="view_materi.php?id=<?= $m['id']; ?>" class="btn">Buka Materi</a>
      </div>

<?php
    }
} else {
    echo "<p class='empty'>Belum ada materi untuk mapel ini!</p>";
}

?>

   </div>
</section>






<!-- ========================================= -->
<!--                 SOAL LATIHAN              -->
<!-- ========================================= -->

<section class="contents">
   <h1 class="heading">Soal Latihan</h1>
   <div class="box-container">

<?php

$soal = $conn->prepare("
   SELECT soal.*, content.title 
   FROM soal
   INNER JOIN content ON soal.content_id = content.id
   WHERE content.playlist_id = ? 
     AND soal.tutor_id = ?
");
$soal->execute([$playlist_id, $tutor_id]);



if($soal->rowCount() > 0){
    while($s = $soal->fetch(PDO::FETCH_ASSOC)){
?>

      <div class="box">
         <h3 class="title">Soal ID: <?= $s['id']; ?></h3>
         <a href="view_soal.php?get_id=<?= $s['id']; ?>" class="btn">Kerjakan Soal</a>
      </div>

<?php
    }
} else {
    echo "<p class='empty'>Belum ada soal pada mapel ini!</p>";
}

?>

   </div>
</section>

<?php include '../components/footer.php'; ?>

</body>
</html>
