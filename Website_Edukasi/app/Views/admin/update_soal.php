<?php

include '../components/connect.php';

if(!isset($_COOKIE['tutor_id'])){
   header('location:login.php');
   exit;
}

$tutor_id = $_COOKIE['tutor_id'];

if(!isset($_GET['id'])){
   header('location:contents.php');
   exit;
}

$soal_id = $_GET['id'];

// Ambil data soal
$select_soal = $conn->prepare("SELECT * FROM soal WHERE id = ? AND tutor_id = ? LIMIT 1");
$select_soal->execute([$soal_id, $tutor_id]);

if ($select_soal->rowCount() == 0) {
   echo "Soal tidak ditemukan!";
   exit;
}

$soal = $select_soal->fetch(PDO::FETCH_ASSOC);

// Update Soal
if(isset($_POST['submit'])){

   $question = filter_var($_POST['question'], FILTER_SANITIZE_STRING);
   $option_a = filter_var($_POST['option_a'], FILTER_SANITIZE_STRING);
   $option_b = filter_var($_POST['option_b'], FILTER_SANITIZE_STRING);
   $option_c = filter_var($_POST['option_c'], FILTER_SANITIZE_STRING);
   $option_d = filter_var($_POST['option_d'], FILTER_SANITIZE_STRING);
   $correct_option = filter_var($_POST['correct_option'], FILTER_SANITIZE_STRING);
   $content_id = filter_var($_POST['content_id'], FILTER_SANITIZE_STRING);

   $update = $conn->prepare("UPDATE soal SET question=?, option_a=?, option_b=?, option_c=?, option_d=?, correct_option=?, content_id=? WHERE id=? AND tutor_id=?");
   $update->execute([$question, $option_a, $option_b, $option_c, $option_d, $correct_option, $content_id, $soal_id, $tutor_id]);

   $message[] = 'Soal berhasil diperbarui!';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Update Soal</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="../css/styleadmin.css">
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="playlist-form">

<h1 class="heading">update soal</h1>

<form action="" method="post" class="form">

   <?php
      if(isset($message)){
         foreach($message as $msg){
            echo '<p class="success">'.$msg.'</p>';
         }
      }
   ?>

   <p>Pertanyaan <span>*</span></p>
   <textarea name="question" required class="box" rows="4"><?= $soal['question']; ?></textarea>

   <p>Video / Konten Terkait <span>*</span></p>
   <select name="content_id" class="box" required>
      <?php
         $videos = $conn->prepare("SELECT * FROM content WHERE tutor_id=?");
         $videos->execute([$tutor_id]);

         while($v = $videos->fetch(PDO::FETCH_ASSOC)){
      ?>
      <option value="<?= $v['id']; ?>" <?= $v['id'] == $soal['content_id'] ? 'selected' : '' ?>>
         <?= $v['title']; ?>
      </option>
      <?php } ?>
   </select>

   <p>Jawaban A <span>*</span></p>
   <input type="text" name="option_a" class="box" required value="<?= $soal['option_a']; ?>">

   <p>Jawaban B <span>*</span></p>
   <input type="text" name="option_b" class="box" required value="<?= $soal['option_b']; ?>">

   <p>Jawaban C <span>*</span></p>
   <input type="text" name="option_c" class="box" required value="<?= $soal['option_c']; ?>">

   <p>Jawaban D <span>*</span></p>
   <input type="text" name="option_d" class="box" required value="<?= $soal['option_d']; ?>">

   <p>Jawaban Benar <span>*</span></p>
   <select name="correct_option" class="box" required>
      <option value="a" <?= ($soal['correct_option'] == 'a') ? 'selected' : ''; ?>>A</option>
      <option value="b" <?= ($soal['correct_option'] == 'b') ? 'selected' : ''; ?>>B</option>
      <option value="c" <?= ($soal['correct_option'] == 'c') ? 'selected' : ''; ?>>C</option>
      <option value="d" <?= ($soal['correct_option'] == 'd') ? 'selected' : ''; ?>>D</option>
   </select>

   <input type="submit" name="submit" value="update soal" class="btn">

   <a href="view_soal.php?get_id=<?= $soal_id; ?>" class="option-btn">view soal</a>

</form>

</section>

<?php include '../components/footer.php'; ?>
<script src="../js/admin_script.js"></script>

</body>
</html>
