<?php

include '../components/connect.php';

if(!isset($_COOKIE['tutor_id'])){
   header('location:login.php');
   exit;
}

$id = $_GET['id'];

$materi = $conn->prepare("SELECT * FROM materi WHERE id=? LIMIT 1");
$materi->execute([$id]);

if($materi->rowCount() == 0){
    header('location:mapel.php');
    exit;
}

$data = $materi->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>View Materi</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="../css/styleadmin.css">
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="view-container">

   <h1 class="heading"><?= htmlspecialchars($data['title']); ?></h1>

   <div class="box">
      <p><strong>Deskripsi:</strong></p>
      <p><?= nl2br(htmlspecialchars($data['description'])); ?></p>

      <br>

      <p><strong>Materi Lengkap:</strong></p>
      <div class="materi-text" style="white-space:pre-wrap; line-height:1.7; font-size:15px;">
          <?= nl2br(htmlspecialchars($data['materi'])); ?>
      </div>

      <a href="update_materi.php?id=<?= $data['id']; ?>" class="option-btn">Update</a>
   </div>

</section>

<?php include '../components/footer.php'; ?>
<script src="../js/admin_script.js"></script>
</body>
</html>

