<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Detail Mapel</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="<?= base_url('css/styleadmin.css'); ?>">
</head>
<body>

<!-- Header admin -->
<?= view('admin/components/admin_header', ['profile' => $profile]); ?>

<section class="playlist-details">
   <h1 class="heading">Detail Kerajaan</h1>

   <div class="row">

      <div class="thumb">
         <img src="<?= base_url('uploaded_files/' . $mapel['foto_raja']); ?>" alt="Foto Raja">
      </div>

      <div class="details">
         <h3 class="title"><?= $mapel['nama_kerajaan']; ?></h3>
         
         <p><strong>Tahun Berdiri:</strong> <?= $mapel['tahun_berdiri']; ?></p>
         <p><strong>Lokasi:</strong> <?= $mapel['lokasi']; ?></p>

         <p class="description"><?= $mapel['deskripsi']; ?></p>

         <p><strong>Daftar Raja:</strong><br><?= nl2br($mapel['daftar_raja']); ?></p>

         <div class="flex-btn">
            <a href="<?= base_url('admin/mapel/update/' . $mapel['id']); ?>" class="option-btn">Update Mapel</a>
         </div>
      </div>

   </div>
</section>


<!-- ========================================= -->
<!--               VIDEO PEMBELAJARAN          -->
<!-- ========================================= -->
<section class="contents">
   <h1 class="heading">Video Pembelajaran</h1>

   <div class="box-container">
      <?php if (!empty($videos)) : ?>
         <?php foreach ($videos as $v) : ?>
            <div class="box">
               <img src="<?= base_url('uploaded_files/' . $v['thumb']); ?>" class="thumb">
               <h3 class="title"><?= esc($v['title']); ?></h3>
               <a href="<?= base_url('admin/content/view/' . $v['id']); ?>" class="btn">Tonton Video</a>
            </div>
         <?php endforeach; ?>
      <?php else : ?>
         <p class="empty">Belum ada video pada mapel ini!</p>
      <?php endif; ?>
   </div>
</section>



<!-- ========================================= -->
<!--               MATERI PEMBELAJARAN         -->
<!-- ========================================= -->
<section class="contents">
   <h1 class="heading">Materi Pembelajaran</h1>

   <div class="box-container">
      <?php if (!empty($materi)) : ?>
         <?php foreach ($materi as $m) : ?>
            <div class="box">
               <h3 class="title"><?= $m['title']; ?></h3>
               <a href="<?= base_url('admin/materi/view/' . $m['id']); ?>" class="btn">Buka Materi</a>
            </div>
         <?php endforeach; ?>
      <?php else : ?>
         <p class="empty">Belum ada materi untuk mapel ini!</p>
      <?php endif; ?>
   </div>
</section>


<!-- ========================================= -->
<!--                 SOAL LATIHAN              -->
<!-- ========================================= -->
<section class="contents">
   <h1 class="heading">Soal Latihan</h1>

   <div class="box-container">
      <?php if (!empty($soal)) : ?>
         <?php foreach ($soal as $s) : ?>
            <div class="box">
               <h3 class="title">Soal ID: <?= $s['id']; ?></h3>
               <a href="<?= base_url('admin/soal/view/' . $s['id']); ?>" class="btn">Kerjakan Soal</a>
            </div>
         <?php endforeach; ?>
      <?php else : ?>
         <p class="empty">Belum ada soal pada mapel ini!</p>
      <?php endif; ?>
   </div>
</section>

<!-- ========================================= -->
<!--               DAFTAR RAJA                 -->
<!-- ========================================= -->
<section class="contents">
   <h1 class="heading">Daftar Raja-Raja</h1>

   <div class="box-container">
      <?php 
      // Anda perlu ambil data raja dari controller
      // Sementara buat tombol dulu:
      ?>
      
      <div class="box" style="text-align: center;">
         <i class="fas fa-crown" style="font-size: 50px; color: gold; margin-bottom: 20px;"></i>
         <h3 class="title">Lihat Daftar Raja</h3>
         <p>Klik untuk melihat daftar raja-raja dari kerajaan <?= $mapel['nama_kerajaan'] ?></p>
         
         <a href="<?= base_url('admin/mapel/' . $mapel['id'] . '/raja') ?>" class="btn">
            <i class="fas fa-crown"></i> Lihat Daftar Raja
         </a>
         
         <a href="<?= base_url('admin/raja/create/' . $mapel['id']) ?>" class="btn" style="background: #28a745;">
            <i class="fas fa-plus"></i> Tambah Raja Baru
         </a>
      </div>
   </div>
</section>
<!-- Footer -->
<?= view('admin/components/footer'); ?>

</body>
</html>
