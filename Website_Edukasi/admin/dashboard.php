<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

// Ambil data profile untuk "welcome"
$select_profile = $conn->prepare("SELECT * FROM `tutors` WHERE id = ?");
$select_profile->execute([$tutor_id]);
$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

// Hitung total materi (content)
$select_contents = $conn->prepare("SELECT * FROM `materi` WHERE tutor_id = ?");
$select_contents->execute([$tutor_id]);
$total_contents = $select_contents->rowCount();

// Hitung total mapel
$select_mapel = $conn->prepare("SELECT * FROM `mapel` WHERE tutor_id = ?");
$select_mapel->execute([$tutor_id]);
$total_mapel = $select_mapel->rowCount();

// likes (jika tidak dipakai, tetap biarkan)
$select_likes = $conn->prepare("SELECT * FROM `likes` WHERE tutor_id = ?");
$select_likes->execute([$tutor_id]);
$total_likes = $select_likes->rowCount();

// komentar
$select_comments = $conn->prepare("SELECT * FROM `comments` WHERE tutor_id = ?");
$select_comments->execute([$tutor_id]);
$total_comments = $select_comments->rowCount();

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="../css/styleadmin.css">
</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="dashboard">

   <h1 class="heading">Dashboard</h1>

   <div class="box-container">

      <div class="box">
         <h3>Welcome!</h3>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="profile.php" class="btn">View profile</a>
      </div>

      <div class="box">
         <h3><?= $total_contents; ?></h3>
         <p>Total Materi</p>
         <a href="tambah_materi.php" class="btn">Tambah Materi</a>
      </div>

      <div class="box">
         <h3><?= $total_mapel; ?></h3>
         <p>Total Mata Pelajaran</p>
         <a href="tambah_mapel.php" class="btn">Tambah kerajaan</a>
      </div>

      <div class="box">
         <h3><?= $total_likes; ?></h3>
         <p>Total Likes</p>
         <a href="mapel.php" class="btn">Lihat kerajaan</a>
      </div>

      <div class="box">
         <h3><?= $total_comments; ?></h3>
         <p>Total Komentar</p>
         <a href="komentar.php" class="btn">Lihat Komentar</a>
      </div>
   </div>

</section>

<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>
