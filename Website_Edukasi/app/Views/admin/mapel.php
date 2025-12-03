<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="<?= base_url('css/styleadmin.css') ?>">
</head>

<body>




<?= view('admin/components/admin_header', ['profile' => $profile]); ?>


<section class="playlists">

   <h1 class="heading">Daftar Kerajaan</h1>

   <div class="box-container">

      <!-- Tombol Tambah -->
      <div class="box" style="text-align: center;">
         <h3 class="title">Tambah Kerajaan</h3>
         <a href="<?= base_url('admin/tambah-mapel'); ?>" class="btn">Tambah Kerajaan</a>

      </div>

      <?php if(!empty($mapel)): ?>
         <?php foreach($mapel as $row): ?>
            
         <div class="box">

            <div class="flex">
               <div>
                  <i class="fas fa-circle-dot"
                     style="color:<?= $row['status']=='active'?'limegreen':'red' ?>"></i>
                  <span style="color:<?= $row['status']=='active'?'limegreen':'red' ?>">
                     <?= esc($row['status']); ?>
                  </span>
               </div>

               <div>
                  <i class="fas fa-calendar"></i>
                  <span><?= esc($row['date']); ?></span>
               </div>
            </div>

            <div class="thumb">
               <img src="<?= base_url('uploaded_files/'.$row['foto_raja']); ?>" alt="">
            </div>

            <h3 class="title"><?= esc($row['nama_kerajaan']); ?></h3>
            <p class="description"><?= esc($row['deskripsi']); ?></p>

            <!-- Tombol Update & Delete -->
            <div class="flex-btn">
               <a href="<?= base_url('admin/update-mapel/'.$row['id']); ?>" class="option-btn">Update</a>
               <a href="<?= base_url('admin/mapel/delete/'.$row['id']); ?>"
                  onclick="return confirm('Hapus kerajaan ini?');"
                  class="delete-btn">Delete</a>
            </div>

            <a href="<?= base_url('admin/mapel/view/' . $row['id']); ?>" class="btn">Lihat Detail</a>
         </div>

         <?php endforeach; ?>

      <?php else: ?>
         <p class="empty">Belum ada kerajaan yang ditambahkan!</p>
      <?php endif; ?>

   </div>

</section>

<?= view('admin/components/footer'); ?>
<script src="<?= base_url('js/admin_script.js'); ?>"></script>

</body>
</html>
