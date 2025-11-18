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

/* UPDATE DATA */
if(isset($_POST['update'])){

   $title = $_POST['title'];
   $desc  = $_POST['description'];

   $update = $conn->prepare("UPDATE materi SET title=?, description=? WHERE id=?");
   $update->execute([$title, $desc, $id]);

   // File baru
   if(!empty($_FILES['file']['name'])){
      $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
      $rename = 'materi_'.time().'.'.$ext;

      move_uploaded_file($_FILES['file']['tmp_name'], "../uploaded_files/".$rename);

      // Hapus file lama
      if(file_exists("../uploaded_files/".$data['file'])){
         unlink("../uploaded_files/".$data['file']);
      }

      $update_file = $conn->prepare("UPDATE materi SET file=? WHERE id=?");
      $update_file->execute([$rename, $id]);
   }

   $success = "Materi berhasil diperbarui!";
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
<section class="playlist-form">

   <h1 class="heading">Update Materi</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <?php if(isset($success)): ?>
         <p class="success"><?= $success; ?></p>
      <?php endif; ?>

      <p>Judul Materi</p>
      <input type="text" name="title" class="box" value="<?= $data['title']; ?>" required>

      <p>Deskripsi</p>
      <textarea name="description" class="box" rows="5" required><?= $data['description']; ?></textarea>

      <p>File Materi (PDF/DOC) - opsional</p>
      <input type="file" name="file" class="box">

      <input type="submit" name="update" value="Update Materi" class="btn">
   </form>

</section>


<?php include '../components/footer.php'; ?>
<script src="../js/admin_script.js"></script>
</body>
</html>
