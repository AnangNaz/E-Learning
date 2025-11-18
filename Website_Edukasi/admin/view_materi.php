<?php

include '../components/connect.php';

if(!isset($_COOKIE['tutor_id'])){
   header('location:login.php');
}

if(!isset($_GET['id'])){
    header('location:contents.php');
}

$id = $_GET['id'];

$materi = $conn->prepare("SELECT * FROM materi WHERE id=? LIMIT 1");
$materi->execute([$id]);

if($materi->rowCount() == 0){
    header('location:contents.php');
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

   <h1 class="heading"><?= $data['title']; ?></h1>

   <div class="box">
      <p><strong>Deskripsi:</strong></p>
      <p><?= $data['description']; ?></p>

      <a href="../uploaded_files/<?= $data['file']; ?>" target="_blank" class="btn">Download / View File</a>
      <a href="update_materi.php?id=<?= $data['id']; ?>" class="option-btn">Update</a>
   </div>

</section>

<?php include '../components/footer.php'; ?>
<script src="../js/admin_script.js"></script>
</body>
</html>
