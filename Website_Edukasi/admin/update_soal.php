<?php
include '../components/connect.php';

if (!isset($_COOKIE['tutor_id'])) {
   header('location:login.php');
}

$tutor_id = $_COOKIE['tutor_id'];

if (!isset($_GET['id'])) {
   echo "ID soal tidak ditemukan!";
   exit;
}

$soal_id = $_GET['id'];

// Ambil data soal
$query = $conn->prepare("SELECT * FROM soal WHERE id = ? AND tutor_id = ? LIMIT 1");
$query->execute([$soal_id, $tutor_id]);

if ($query->rowCount() == 0) {
   echo "Soal tidak ditemukan!";
   exit;
}

$soal = $query->fetch(PDO::FETCH_ASSOC);

// Update Soal
if (isset($_POST['update_soal'])) {

   $question = $_POST['question'];
   $option_a = $_POST['option_a'];
   $option_b = $_POST['option_b'];
   $option_c = $_POST['option_c'];
   $option_d = $_POST['option_d'];
   $correct_option = $_POST['correct_option'];
   $content_id = $_POST['content_id'];

   $update = $conn->prepare("
      UPDATE soal 
      SET question=?, option_a=?, option_b=?, option_c=?, option_d=?, correct_option=?, content_id=? 
      WHERE id=? AND tutor_id=?
   ");

   $update->execute([
      $question,
      $option_a,
      $option_b,
      $option_c,
      $option_d,
      $correct_option,
      $content_id,
      $soal_id,
      $tutor_id
   ]);

   $success = "Soal berhasil diperbarui!";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Update Soal</title>
      <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="../css/styleadmin.css">
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="playlist-form">

<h1 class="heading">Update Soal</h1>

<?php if(isset($success)) echo "<p class='success'>$success</p>"; ?>

<form method="post" class="form">

   <p class="label">Pertanyaan:</p>
   <textarea name="question" required class="box"><?= $soal['question']; ?></textarea>

   <p class="label">Video Terkait:</p>
   <select name="content_id" class="box" required>
      <?php
         $videos = $conn->prepare("SELECT id, title FROM content WHERE tutor_id=?");
         $videos->execute([$tutor_id]);

         while ($vid = $videos->fetch(PDO::FETCH_ASSOC)) {
      ?>
      <option value="<?= $vid['id']; ?>" 
         <?= ($vid['id'] == $soal['content_id']) ? 'selected' : '' ?>>
         <?= $vid['title']; ?>
      </option>
      <?php } ?>
   </select>

   <p class="label">A:</p>
   <input type="text" name="option_a" value="<?= $soal['option_a']; ?>" required class="box">

   <p class="label">B:</p>
   <input type="text" name="option_b" value="<?= $soal['option_b']; ?>" required class="box">

   <p class="label">C:</p>
   <input type="text" name="option_c" value="<?= $soal['option_c']; ?>" required class="box">

   <p class="label">D:</p>
   <input type="text" name="option_d" value="<?= $soal['option_d']; ?>" required class="box">

   <p class="label">Jawaban Benar:</p>
   <select name="correct_option" class="box" required>
      <option value="a" <?= ($soal['correct_option'] == 'a') ? 'selected' : ''; ?>>A</option>
      <option value="b" <?= ($soal['correct_option'] == 'b') ? 'selected' : ''; ?>>B</option>
      <option value="c" <?= ($soal['correct_option'] == 'c') ? 'selected' : ''; ?>>C</option>
      <option value="d" <?= ($soal['correct_option'] == 'd') ? 'selected' : ''; ?>>D</option>
   </select>

   <button type="submit" name="update_soal" class="btn">Update</button>
   <a href="contents.php" class="option-btn">Kembali</a>

</form>

</section>

<?php include '../components/footer.php'; ?>
<script src="../js/admin_script.js"></script>
</body>
</html>
