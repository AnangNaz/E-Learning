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
   <a href="<?= base_url('admin/soal/create'); ?>" class="btn">Tambah Soal</a>
</div>

<!-- Tombol tambah Raja -->
<div class="box" data-type="raja" style="text-align:center;">
   <h3 class="title">Raja</h3>
   
   <a href="<?= base_url('admin/raja/create/' . $mapel['id']); ?>" class="btn">Tambah Raja</a>
</div>
<!-- Tombol tambah Peristiwa -->
<div class="box" data-type="peristiwa" style="text-align:center;">
   <h3 class="title">Peristiwa Sejarah</h3>
   <a href="<?= base_url('admin/peristiwa/create'); ?>" class="btn">Tambah Peristiwa</a>
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
   <?php $counter = 1; ?>
   <?php foreach($soal as $row): ?>
      <div class="box">
         <div class="question-number">Soal #<?= $counter++; ?></div>
         <h3 class="title"><?= esc($row['pertanyaan']); ?></h3>
         
         <div class="options-preview">
            <p><strong>A.</strong> <?= esc($row['pilihan_a']); ?></p>
            <p><strong>B.</strong> <?= esc($row['pilihan_b']); ?></p>
            <p><strong>C.</strong> <?= esc($row['pilihan_c']); ?></p>
            <p><strong>D.</strong> <?= esc($row['pilihan_d']); ?></p>
         </div>
         
         <div class="answer-info">
            <p class="correct-answer">
               <i class="fas fa-check-circle"></i> Jawaban benar: 
               <strong class="answer-<?= $row['jawaban_benar']; ?>">
                   <?= strtoupper($row['jawaban_benar']); ?>
               </strong>
            </p>
            <p class="mapel-info">
               <i class="fas fa-book"></i> Mapel ID: <?= esc($row['mapel_id']); ?>
            </p>
            <p class="date-info">
               <i class="fas fa-calendar"></i> Dibuat: <?= date('d/m/Y', strtotime($row['dibuat_pada'])); ?>
            </p>
         </div>

         <form method="post" action="<?= base_url('admin/soal/delete/' . $row['id']); ?>" class="flex-btn">
             <input type="hidden" name="id" value="<?= $row['id']; ?>">
             <a href="<?= base_url('admin/soal/edit/' . $row['id']); ?>" class="option-btn">update</a>
             <button type="submit" class="delete-btn" onclick="return confirm('Hapus soal ini?');">delete</button>
         </form>
      </div>
   <?php endforeach; ?>
<?php else: ?>
   <p class="empty">Belum ada soal!</p>
<?php endif; ?>

</div>
<!-- Tempatkan di halaman materi.php, misal setelah LIST SOAL -->

<!-- =======================
       LIST RAJA
======================== -->
<h2 class="heading">Daftar Raja</h2>

<div class="box-container">
<?php if(!empty($raja)): ?>
   <?php foreach($raja as $row): ?>
      <div class="box">
         <!-- Foto Raja -->
         <?php if(!empty($row['foto']) && $row['foto'] !== 'default.jpg'): ?>
            <div class="image-preview">
               <img src="<?= base_url('uploaded_files/raja/' . $row['foto']); ?>" 
                    alt="<?= esc($row['nama']); ?>" 
                    class="raja-image">
            </div>
         <?php endif; ?>
         
         <h3 class="title"><?= esc($row['nama']); ?></h3>
         
         <!-- Info Kerajaan -->
         <div class="mapel-info">
            <i class="fas fa-landmark"></i> 
            Kerajaan: <?= esc($row['mapel_nama'] ?? 'Tidak diketahui'); ?>
         </div>
         
         <!-- Preview Cerita -->
         <div class="cerita-preview">
            <?php 
            $cerita = strip_tags($row['cerita']);
            echo strlen($cerita) > 100 ? substr($cerita, 0, 100) . '...' : $cerita;
            ?>
         </div>         
<!-- Action Buttons untuk RAJA (sama dengan SOAL) -->
<form method="post" action="<?= base_url('admin/raja/delete/' . $row['id']); ?>" class="flex-btn">
    <input type="hidden" name="id" value="<?= $row['id']; ?>">
    <a href="<?= base_url('admin/raja/edit/' . $row['id']); ?>" class="option-btn">Edit</a>
    <button type="submit" class="delete-btn" onclick="return confirm('Hapus raja ini?');">Delete</button>
</form>
      </div>
   <?php endforeach; ?>
<?php else: ?>
   <p class="empty">Belum ada data raja! 
   </p>
<?php endif; ?>
</div>
<!-- =======================
       LIST PERISTIWA
======================== -->
<h2 class="heading">Daftar Peristiwa Sejarah</h2>

<div class="box-container">
<?php if(!empty($peristiwa)): ?>
   <?php foreach($peristiwa as $row): ?>
      <div class="box">
         <!-- Foto Peristiwa -->
         <?php if(!empty($row['foto_peristiwa'])): ?>
            <div class="image-preview">
               <img src="<?= base_url('uploaded_files/peristiwa/' . $row['foto_peristiwa']); ?>" 
                    alt="<?= esc($row['nama_peristiwa']); ?>" 
                    class="peristiwa-image">
            </div>
         <?php endif; ?>
         
         <h3 class="title"><?= esc($row['nama_peristiwa']); ?></h3>
         
         <!-- Info Kerajaan -->
         <div class="mapel-info">
            <i class="fas fa-landmark"></i> 
            Kerajaan: <?= esc($row['mapel_nama'] ?? 'Tidak diketahui'); ?>
         </div>
         
         <!-- Info Tahun -->
         <?php if(!empty($row['tahun'])): ?>
            <div class="tahun-info">
               <i class="fas fa-calendar"></i> 
               Tahun: <?= esc($row['tahun']); ?>
            </div>
         <?php endif; ?>
         
         <!-- Info Lokasi -->
         <?php if(!empty($row['lokasi'])): ?>
            <div class="lokasi-info">
               <i class="fas fa-map-marker-alt"></i> 
               Lokasi: <?= esc($row['lokasi']); ?>
            </div>
         <?php endif; ?>
         
         <!-- Preview Deskripsi -->
         <div class="deskripsi-preview">
            <?php 
            $deskripsi = strip_tags($row['deskripsi']);
            echo strlen($deskripsi) > 100 ? substr($deskripsi, 0, 100) . '...' : $deskripsi;
            ?>
         </div>
         
         <!-- Action Buttons untuk PERISTIWA (sama dengan RAJA dan SOAL) -->
         <form method="post" action="<?= base_url('admin/peristiwa/delete/' . $row['id']); ?>" class="flex-btn">
             <input type="hidden" name="id" value="<?= $row['id']; ?>">
             <a href="<?= base_url('admin/peristiwa/edit/' . $row['id']); ?>" class="option-btn">Edit</a>
             <button type="submit" class="delete-btn" onclick="return confirm('Hapus peristiwa ini?');">Delete</button>
         </form>
      </div>
   <?php endforeach; ?>
<?php else: ?>
   <p class="empty">Belum ada data peristiwa!</p>
<?php endif; ?>
</div>

<style>
.raja-image {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 10px;
}

.cerita-preview {
    color: #666;
    font-size: 14px;
    line-height: 1.5;
    margin: 10px 0;
    padding: 10px;
    background: #f9f9f9;
    border-radius: 5px;
}

.mapel-info {
    background: #e8f4fc;
    padding: 5px 10px;
    border-radius: 5px;
    margin: 10px 0;
    font-size: 14px;
    color: #2980b9;
}

.mapel-info i {
    margin-right: 5px;
}
</style>
</section>

<?= view('admin/components/footer'); ?>

<script src="<?= base_url('js/admin_script.js'); ?>"></script>

</body>
</html>
