<?php

include '../components/connect.php';

if(!isset($_COOKIE['tutor_id'])){
   header('location:login.php');
}

$tutor_id = $_COOKIE['tutor_id'];

if(isset($_POST['submit'])){
   
   $content_id = $_POST['content_id'];
   $question = $_POST['question'];
   $option_a = $_POST['option_a'];
   $option_b = $_POST['option_b'];
   $option_c = $_POST['option_c'];
   $option_d = $_POST['option_d'];
   $correct = $_POST['correct'];

   $insert = $conn->prepare("
      INSERT INTO soal (tutor_id, content_id, question, option_a, option_b, option_c, option_d, correct_option)
      VALUES (?,?,?,?,?,?,?,?)
   ");

   $insert->execute([
      $tutor_id,
      $content_id,
      $question,
      $option_a,
      $option_b,
      $option_c,
      $option_d,
      $correct
   ]);

   $message[] = 'Soal berhasil ditambahkan!';
}

?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
   <title>Add Soal</title>
      <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
      <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/styleadmin.css">
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="form-container">

<form method="post">
   <h3>Tambah Soal</h3>

   <p>Pilih Video</p>
   <select name="content_id" class="box">
      <?php
         $videos = $conn->prepare("SELECT * FROM content WHERE tutor_id=?");
         $videos->execute([$tutor_id]);
         while($row = $videos->fetch(PDO::FETCH_ASSOC)){
            echo '<option value="'.$row['id'].'">'.$row['title'].'</option>';
         }
      ?>
   </select>

   <p>Pertanyaan</p>
   <textarea name="question" class="box" rows="3" required></textarea>

   <p>Pilihan Jawaban</p>
   <input type="text" name="option_a" placeholder="Pilihan A" class="box" required>
   <input type="text" name="option_b" placeholder="Pilihan B" class="box" required>
   <input type="text" name="option_c" placeholder="Pilihan C" class="box" required>
   <input type="text" name="option_d" placeholder="Pilihan D" class="box" required>

   <p>Jawaban Benar</p>
   <select name="correct" class="box">
      <option value="A">A</option>
      <option value="B">B</option>
      <option value="C">C</option>
      <option value="D">D</option>
   </select>

   <input type="submit" name="submit" value="Tambah Soal" class="btn">
</form>

</section>
<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>

</html>
