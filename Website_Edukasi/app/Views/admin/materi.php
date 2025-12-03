<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Materi</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="<?= base_url('css/styleadmin.css') ?>">
</head>
<body>

<?= view('admin/components/admin_header', ['profile' => $profile]); ?>

<section class="contents">

<h1 class="heading">Manajemen Pembelajaran</h1>

<div class="box-container">

   <!-- Tombol tambah video -->
   <div class="box" data-type="video" style="text-align:center;">
      <h3 class="title">Video</h3>
     <a href="<?= base_url('admin/tambah-video'); ?>" class="btn">Tambah Video</a>

   </div>

   <!-- Tombol tambah materi -->
   <div class="box" data-type="materi" style="text-align:center;">
      <h3 class="title">Materi</h3>
      <a href="<?= base_url('admin/tambah-materi'); ?>" class="btn">Tambah Materi</a>
   </div>

   <!-- Tombol tambah soal -->
   <div class="box" data-type="soal" style="text-align:center;">
      <h3 class="title">Soal</h3>
      <a href="<?= base_url('admin/tambah-soal'); ?>" class="btn">Tambah Soal</a>
   </div>

</div>

<hr><br>

<!-- =======================
       LIST VIDEO
======================== -->
<h2 class="heading">Video Pembelajaran</h2>

<div class="box-container">
<?php if(!empty($videos)): ?>
   <?php foreach($videos as $row): ?>
      <div class="box">

         <!-- Thumbnail -->
         <img src="<?= base_url('uploaded_files/' . $row['thumb']); ?>" class="thumb">

         <!-- Judul -->
         <h3 class="title"><?= esc($row['title']); ?></h3>

         <!-- Status -->
         <p>Status: <?= esc($row['status']); ?></p>

         <!-- Tombol Update + Delete -->
         <form action="<?= base_url('admin/delete-video'); ?>" method="post" class="flex-btn">
            <?= csrf_field(); ?>
            <input type="hidden" name="video_id" value="<?= $row['id']; ?>">

            <a href="<?= base_url('admin/update-video/' . $row['id']); ?>" class="option-btn">Update</a>

            <button type="submit" class="delete-btn" onclick="return confirm('Hapus video ini?');">
               Delete
            </button>
         </form>

         <!-- Tombol Lihat Video --> <!-- PERBAIKAN DI SINI: $row, bukan $v -->
         <a href="<?= base_url('admin/view-video/' . $row['id']); ?>" class="btn">Tonton Video</a>

      </div>
   <?php endforeach; ?>
<?php else: ?>
   <p class="empty">Belum ada video!</p>
<?php endif; ?>
</div>


<!-- =======================
       LIST MATERI
======================== -->
<h2 class="heading">Materi</h2>

<div class="box-container">
<?php if(!empty($materi)): ?>
   <?php foreach($materi as $row): ?>
      <div class="box">
         <h3 class="title"><?= esc($row['title']); ?></h3>
         <p><?= esc($row['description']); ?></p>

         <form method="post" action="<?= base_url('admin/delete_materi'); ?>" class="flex-btn">
            <input type="hidden" name="materi_id" value="<?= $row['id']; ?>">
            <a href="<?= base_url('admin/update-materi/'.$row['id']); ?>" class="option-btn">Update Materi</a>
            <button type="submit" class="delete-btn" onclick="return confirm('Hapus materi ini?');">delete</button>
         </form>

         <a href="<?= base_url('admin/view-materi/'.$row['id']); ?>" class="btn">view</a>

      </div>
   <?php endforeach; ?>
<?php else: ?>
   <p class="empty">Belum ada materi!</p>
<?php endif; ?>
</div>


<!-- =======================
       LIST SOAL
======================== -->
<h2 class="heading">Bank Soal</h2>

<div class="box-container">

<?php if(!empty($soal)): ?>
   <?php foreach($soal as $row): ?>
      <div class="box">
         <h3 class="title"><?= esc($row['question']); ?></h3>
         <p>Video terkait: <b><?= esc($row['video_title']); ?></b></p>
         <p>Jawaban benar: <?= esc($row['correct_option']); ?></p>

<form method="post" action="<?= base_url('admin/delete-soal'); ?>" class="flex-btn">
    <!-- input hidden untuk ID soal -->
    <input type="hidden" name="id" value="<?= $row['id']; ?>">

    <a href="<?= base_url('admin/update-soal/' . $row['id']); ?>" class="option-btn">update</a>
    <button type="submit" class="delete-btn" onclick="return confirm('Hapus soal ini?');">delete</button>
</form>


        <a href="<?= base_url('admin/view-soal/' . $row['id']); ?>" class="btn">Lihat Detail</a>

      </div>
   <?php endforeach; ?>
<?php else: ?>
   <p class="empty">Belum ada soal!</p>
<?php endif; ?>

</div>

</section>

<?= view('admin/components/footer'); ?>

<script src="<?= base_url('js/admin_script.js'); ?>"></script>

</body>
</html>
