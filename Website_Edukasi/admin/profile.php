<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

// --- TOTAL MAPEL ---
$select_mapel = $conn->prepare("SELECT * FROM mapel WHERE tutor_id = ?");
$select_mapel->execute([$tutor_id]);
$total_mapel = $select_mapel->rowCount();

// --- TOTAL MATERI / VIDEO ---
$select_materi = $conn->prepare("SELECT * FROM content WHERE tutor_id = ?");
$select_materi->execute([$tutor_id]);
$total_materi = $select_materi->rowCount();

// --- TOTAL LIKE ---
$select_likes = $conn->prepare("SELECT * FROM likes WHERE tutor_id = ?");
$select_likes->execute([$tutor_id]);
$total_likes = $select_likes->rowCount();

// --- TOTAL KOMENTAR ---
$select_comments = $conn->prepare("SELECT * FROM comments WHERE tutor_id = ?");
$select_comments->execute([$tutor_id]);
$total_comments = $select_comments->rowCount();

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Profile</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="../css/styleadmin.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="tutor-profile" style="min-height: calc(100vh - 19rem);"> 

   <h1 class="heading">profile details</h1>

   <div class="details">
      <div class="tutor">
         <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" alt="">
         <h3><?= $fetch_profile['name']; ?></h3>
         <span><?= $fetch_profile['profession']; ?></span>
         <a href="update.php" class="inline-btn">update profile</a>
      </div>

      <div class="flex">

         <div class="box">
            <span><?= $total_mapel; ?></span>
            <p>Total Mapel</p>
            <a href="mapel.php" class="btn">Lihat mapel</a>
         </div>

         <div class="box">
            <span><?= $total_materi; ?></span>
            <p>Total Materi / Video</p>
            <a href="materi.php" class="btn">lihat materi</a>
         </div>

         <div class="box">
            <span><?= $total_likes; ?></span>
            <p>Total Likes</p>
            <a href="materi.php" class="btn">lihat materi</a>
         </div>

         <div class="box">
            <span><?= $total_comments; ?></span>
            <p>Total komentar</p>
            <a href="komentar.php" class="btn">lihat komentar</a>
         </div>

      </div>
   </div>

</section>

<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>
