<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   header('location:login.php');
   exit;
}

// DELETE KERAJAAN
if(isset($_POST['delete'])){
   $delete_id = $_POST['mapel_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

   $verify = $conn->prepare("SELECT * FROM `mapel` WHERE id = ? AND tutor_id = ? LIMIT 1");
   $verify->execute([$delete_id, $tutor_id]);

   if($verify->rowCount() > 0){

      // hapus foto kerajaan
      $select_thumb = $conn->prepare("SELECT foto_raja FROM `mapel` WHERE id = ?");
      $select_thumb->execute([$delete_id]);
      $fetch_thumb = $select_thumb->fetch(PDO::FETCH_ASSOC);

      if($fetch_thumb['foto_raja'] != '' && file_exists('../uploaded_files/'.$fetch_thumb['foto_raja'])){
         unlink('../uploaded_files/'.$fetch_thumb['foto_raja']);
      }

      // hapus data kerajaan
      $delete_mapel = $conn->prepare("DELETE FROM `mapel` WHERE id = ?");
      $delete_mapel->execute([$delete_id]);

      $message[] = 'Kerajaan berhasil dihapus!';
   }else{
      $message[] = 'Kerajaan tidak ditemukan!';
   }
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Daftar Kerajaan</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="../css/styleadmin.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="playlists">

   <h1 class="heading">Daftar Kerajaan</h1>

   <div class="box-container">
   
      <div class="box" style="text-align: center;">
         <h3 class="title">Tambah Kerajaan</h3>
         <a href="tambah_mapel.php" class="btn">Tambah Kerajaan</a>
      </div>

      <?php
         $select_mapel = $conn->prepare("SELECT * FROM `mapel` WHERE tutor_id = ? ORDER BY date DESC");
         $select_mapel->execute([$tutor_id]);

         if($select_mapel->rowCount() > 0){
         while($row = $select_mapel->fetch(PDO::FETCH_ASSOC)){
      ?>
      <div class="box">
         <div class="flex">
            <div>
               <i class="fas fa-circle-dot" style="color:<?= $row['status']=='active'?'limegreen':'red' ?>"></i>
               <span style="color:<?= $row['status']=='active'?'limegreen':'red' ?>"><?= $row['status']; ?></span>
            </div>

            <div>
               <i class="fas fa-calendar"></i>
               <span><?= $row['date']; ?></span>
            </div>
         </div>

         <div class="thumb">
            <img src="../uploaded_files/<?= $row['foto_raja']; ?>" alt="">
         </div>

         <h3 class="title"><?= $row['nama_kerajaan']; ?></h3>
         <p class="description"><?= $row['deskripsi']; ?></p>

         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="mapel_id" value="<?= $row['id']; ?>">
            <a href="update_mapel.php?get_id=<?= $row['id']; ?>" class="option-btn">Update</a>
            <input type="submit" value="Delete" class="delete-btn" onclick="return confirm('Hapus kerajaan ini?');" name="delete">
         </form>

         <a href="view_mapel.php?get_id=<?= $row['id']; ?>" class="btn">Lihat Detail</a>
      </div>

      <?php } } else { echo '<p class="empty">Belum ada kerajaan yang ditambahkan!</p>'; } ?>

   </div>

</section>

<?php include '../components/footer.php'; ?>
<script src="../js/admin_script.js"></script>

</body>
</html>
