<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
   exit;
}

if(isset($_POST['submit'])){

   $id = unique_id();

   $nama = $_POST['nama_kerajaan'];
   $nama = filter_var($nama, FILTER_SANITIZE_STRING);

   $tahun = $_POST['tahun_berdiri'];
   $tahun = filter_var($tahun, FILTER_SANITIZE_STRING);

   $lokasi = $_POST['lokasi'];
   $lokasi = filter_var($lokasi, FILTER_SANITIZE_STRING);

   $deskripsi = $_POST['deskripsi'];
   $deskripsi = filter_var($deskripsi, FILTER_SANITIZE_STRING);

   $daftar_raja = $_POST['daftar_raja'];
   $daftar_raja = filter_var($daftar_raja, FILTER_SANITIZE_STRING);

   $status = $_POST['status'];
   $status = filter_var($status, FILTER_SANITIZE_STRING);

   // foto raja
   $image = $_FILES['foto_raja']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename = unique_id().'.'.$ext;
   $image_tmp_name = $_FILES['foto_raja']['tmp_name'];
   $image_folder = '../uploaded_files/'.$rename;

   // INSERT ke tabel mapel yang sudah berubah menjadi kerajaan
   $add = $conn->prepare("
      INSERT INTO `mapel`
      (id, tutor_id, nama_kerajaan, tahun_berdiri, lokasi, deskripsi, daftar_raja, foto_raja, status)
      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
   ");

   $add->execute([
      $id,
      $tutor_id,
      $nama,
      $tahun,
      $lokasi,
      $deskripsi,
      $daftar_raja,
      $rename,
      $status
   ]);

   move_uploaded_file($image_tmp_name, $image_folder);

   $message[] = 'Kerajaan berhasil ditambahkan!';
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tambah Kerajaan</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="../css/styleadmin.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="playlist-form">

   <h1 class="heading">Tambah Kerajaan</h1>

   <form action="" method="post" enctype="multipart/form-data">

      <p>Status <span>*</span></p>
      <select name="status" class="box" required>
         <option value="" selected disabled>-- pilih status --</option>
         <option value="active">Active</option>
         <option value="deactive">Deactive</option>
      </select>

      <p>Nama Kerajaan <span>*</span></p>
      <input type="text" name="nama_kerajaan" maxlength="100" required placeholder="Masukkan nama kerajaan" class="box">

      <p>Tahun Berdiri <span>*</span></p>
      <input type="text" name="tahun_berdiri" maxlength="50" required placeholder="Contoh: 400 M" class="box">

      <p>Lokasi Kerajaan <span>*</span></p>
      <input type="text" name="lokasi" maxlength="150" required placeholder="Masukkan lokasi kerajaan" class="box">

      <p>Deskripsi Kerajaan <span>*</span></p>
      <textarea name="deskripsi" class="box" required placeholder="Tulis deskripsi lengkap kerajaan" maxlength="2000" rows="6"></textarea>

      <p>Daftar Raja <span>*</span></p>
      <textarea name="daftar_raja" class="box" required placeholder="Contoh:\n• Raja Mulawarman\n• Raja Aswawarman" maxlength="2000" rows="6"></textarea>

      <p>Foto Raja / Ikon Kerajaan <span>*</span></p>
      <input type="file" name="foto_raja" accept="image/*" required class="box">

      <input type="submit" value="Tambah Kerajaan" name="submit" class="btn">
   </form>

</section>

<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>
