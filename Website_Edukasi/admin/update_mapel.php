<?php

include '../components/connect.php';

if(!isset($_COOKIE['tutor_id'])){
    header("location: login.php");
    exit;
}

$tutor_id = $_COOKIE['tutor_id'];

if(!isset($_GET['get_id'])){
    header("location: mapel.php");
    exit;
}

$mapel_id = $_GET['get_id'];

// ==========================
// Ambil data mapel
// ==========================
$select = $conn->prepare("SELECT * FROM mapel WHERE id=? AND tutor_id=? LIMIT 1");
$select->execute([$mapel_id, $tutor_id]);
$fetch = $select->fetch(PDO::FETCH_ASSOC);

if(!$fetch){
    echo "<p class='empty'>Data mapel tidak ditemukan!</p>";
    exit;
}


// ==========================
// PROSES UPDATE
// ==========================
if(isset($_POST['submit'])){

    $nama_kerajaan = filter_var($_POST['nama_kerajaan'], FILTER_SANITIZE_STRING);
    $tahun_berdiri = filter_var($_POST['tahun_berdiri'], FILTER_SANITIZE_STRING);
    $lokasi        = filter_var($_POST['lokasi'], FILTER_SANITIZE_STRING);
    $deskripsi     = filter_var($_POST['deskripsi'], FILTER_SANITIZE_STRING);
    $daftar_raja   = filter_var($_POST['daftar_raja'], FILTER_SANITIZE_STRING);
    $status        = filter_var($_POST['status'], FILTER_SANITIZE_STRING);

    // Update tanpa gambar
    $update = $conn->prepare("
        UPDATE mapel 
        SET nama_kerajaan=?, tahun_berdiri=?, lokasi=?, deskripsi=?, daftar_raja=?, status=?
        WHERE id=? AND tutor_id=?
    ");
    $update->execute([
        $nama_kerajaan, 
        $tahun_berdiri,
        $lokasi,
        $deskripsi,
        $daftar_raja,
        $status,
        $mapel_id,
        $tutor_id
    ]);

    // ==========================
    // PROSES UPDATE FOTO
    // ==========================
    $old_foto = $fetch['foto_raja'];
    $foto = $_FILES['foto_raja']['name'];

    if(!empty($foto)){
        $ext = pathinfo($foto, PATHINFO_EXTENSION);
        $rename = unique_id().'.'.$ext;

        $tmp_name = $_FILES['foto_raja']['tmp_name'];
        $size     = $_FILES['foto_raja']['size'];

        $folder   = '../uploaded_files/'.$rename;

        if($size > 2000000){
            $message[] = 'Ukuran foto terlalu besar!';
        } else {
            move_uploaded_file($tmp_name, $folder);

            $update_img = $conn->prepare("UPDATE mapel SET foto_raja=? WHERE id=? AND tutor_id=?");
            $update_img->execute([$rename, $mapel_id, $tutor_id]);

            if($old_foto != '' && file_exists("../uploaded_files/".$old_foto)){
                unlink("../uploaded_files/".$old_foto);
            }
        }
    }

    $message[] = 'Mapel berhasil diperbarui!';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Update Mapel</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="../css/styleadmin.css">
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="playlist-form">

<h1 class="heading">Update Mapel</h1>

<form action="" method="post" enctype="multipart/form-data">

   <p>Nama Kerajaan <span>*</span></p>
   <input type="text" name="nama_kerajaan" class="box" required value="<?= $fetch['nama_kerajaan']; ?>">

   <p>Tahun Berdiri</p>
   <input type="text" name="tahun_berdiri" class="box" value="<?= $fetch['tahun_berdiri']; ?>">

   <p>Lokasi</p>
   <input type="text" name="lokasi" class="box" value="<?= $fetch['lokasi']; ?>">

   <p>Deskripsi <span>*</span></p>
   <textarea name="deskripsi" class="box" required><?= $fetch['deskripsi']; ?></textarea>

   <p>Daftar Raja</p>
   <textarea name="daftar_raja" class="box"><?= $fetch['daftar_raja']; ?></textarea>

   <p>Status Mapel</p>
   <select name="status" class="box" required>
      <option value="<?= $fetch['status']; ?>"><?= $fetch['status']; ?></option>
      <option value="active">active</option>
      <option value="deactive">deactive</option>
   </select>

   <p>Foto Raja</p>
   <div class="thumb">
      <img src="../uploaded_files/<?= $fetch['foto_raja']; ?>" width="200">
   </div>

   <input type="file" name="foto_raja" accept="image/*" class="box">

   <input type="submit" name="submit" value="Update Mapel" class="btn">

   <div class="flex-btn">
      <a href="view_mapel.php?get_id=<?= $mapel_id ?>" class="option-btn">Kembali</a>
   </div>

</form>

</section>

<?php include '../components/footer.php'; ?>

</body>
</html>
