<?php

include '../components/connect.php';

if(!isset($_COOKIE['tutor_id'])){
   header('location:login.php');
   exit;
}

$tutor_id = $_COOKIE['tutor_id'];

if(!isset($_GET['id'])){
   header('location:materi.php');
   exit;
}

$id = $_GET['id'];

$materi = $conn->prepare("SELECT * FROM materi WHERE id = ? LIMIT 1");
$materi->execute([$id]);

if($materi->rowCount() == 0){
   header('location:materi.php');
   exit;
}

$data = $materi->fetch(PDO::FETCH_ASSOC);

/* ===============================
      PROSES UPDATE
================================*/
if(isset($_POST['submit'])){

   $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
   $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
   $isi_materi = $_POST['materi']; // longtext, jangan disanitasi ketat agar format tetap

   $update = $conn->prepare("
      UPDATE materi SET 
         title = ?, 
         description = ?, 
         materi = ?
      WHERE id = ?
   ");

   $update->execute([$title, $description, $isi_materi, $id]);

   $message[] = 'Materi berhasil diperbarui!';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Update Materi</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="../css/styleadmin.css">
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="form-container">

   <form action="" method="post">
      <h3>Update Materi</h3>

      <?php 
      if(isset($message)){
         foreach($message as $msg){
            echo '<p class="message">'.$msg.'</p>';
         }
      }
      ?>

      <p>Judul Materi <span>*</span></p>
      <input type="text" name="title" class="box" required value="<?= $data['title']; ?>">

      <p>Deskripsi <span>*</span></p>
      <textarea name="description" class="box" rows="4" required><?= $data['description']; ?></textarea>

      <p>Isi Materi (Teks Panjang) <span>*</span></p>
      <textarea name="materi" class="box" rows="15" required><?= $data['materi']; ?></textarea>

      <input type="submit" name="submit" value="Update Materi" class="btn">
   </form>

</section>

<?php include '../components/footer.php'; ?>
<script src="../js/admin_script.js"></script>

</body>
</html>
