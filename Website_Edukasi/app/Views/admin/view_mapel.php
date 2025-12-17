<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Detail Mapel</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="<?= base_url('css/styleadmin.css'); ?>">
   
   <style>
      /* CSS Tambahan untuk Peristiwa */
      .peristiwa-card {
         background: #fff;
         border: 1px solid #ddd;
         border-radius: 8px;
         padding: 20px;
         margin-bottom: 15px;
         box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      }
      
      .peristiwa-card h4 {
         color: #333;
         margin-bottom: 10px;
         font-size: 1.2rem;
         border-bottom: 2px solid #007bff;
         padding-bottom: 5px;
      }
      
      .peristiwa-meta {
         display: flex;
         gap: 15px;
         margin-bottom: 10px;
         color: #666;
         font-size: 0.9rem;
      }
      
      .peristiwa-meta span {
         background: #f8f9fa;
         padding: 3px 8px;
         border-radius: 4px;
      }
      
      .fakta-menarik {
         background: #e7f3ff;
         border-left: 4px solid #007bff;
         padding: 10px 15px;
         margin: 15px 0;
         border-radius: 0 4px 4px 0;
      }
      
      .fakta-menarik strong {
         color: #0056b3;
      }
      
      .peristiwa-img {
         max-width: 300px;
         max-height: 200px;
         border-radius: 8px;
         margin-top: 15px;
         border: 3px solid #eee;
      }
      
      .empty-peristiwa {
         text-align: center;
         padding: 40px;
         color: #666;
         background: #f9f9f9;
         border-radius: 8px;
         border: 2px dashed #ddd;
      }
      
      .empty-peristiwa i {
         font-size: 50px;
         color: #ccc;
         margin-bottom: 15px;
      }
      
      .add-peristiwa-btn {
         display: inline-block;
         background: #28a745;
         color: white;
         padding: 10px 20px;
         border-radius: 5px;
         text-decoration: none;
         margin-top: 20px;
         transition: background 0.3s;
      }
      
      .add-peristiwa-btn:hover {
         background: #218838;
      }
   </style>
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
            <a href="<?= base_url('admin/update-mapel/' . $mapel['id']); ?>" class="option-btn">Update Mapel</a>
         </div>
      </div>

   </div>
</section>



<!-- ========================================= -->
<!--               PERISTIWA KERAJAAN          -->
<!-- ========================================= -->
 <section class="contents">
   <h1 class="heading">Peristiwa Kerajaan 
      <?php if (!empty($peristiwa)): ?>
         <span class="badge"><?= count($peristiwa); ?> Peristiwa</span>
      <?php endif; ?>
   </h1>

   <div class="peristiwa-container">
      <?php if (!empty($peristiwa)) : ?>
         <?php foreach ($peristiwa as $p) : ?>
            <div class="peristiwa-card">
               <h4><?= esc($p['nama_peristiwa']); ?></h4>
               
               <div class="peristiwa-meta">
                  <?php if ($p['tahun']): ?>
                     <span><i class="fas fa-calendar-alt"></i> Tahun: <?= esc($p['tahun']); ?></span>
                  <?php endif; ?>
                  
                  <?php if ($p['lokasi']): ?>
                     <span><i class="fas fa-map-marker-alt"></i> Lokasi: <?= esc($p['lokasi']); ?></span>
                  <?php endif; ?>
               </div>
               
               <div class="peristiwa-deskripsi">
                  <p><?= nl2br(esc($p['deskripsi'])); ?></p>
               </div>
               
               <?php if ($p['fakta_menarik']): ?>
                  <div class="fakta-menarik">
                     <strong><i class="fas fa-star"></i> Fakta Menarik:</strong>
                     <p><?= nl2br(esc($p['fakta_menarik'])); ?></p>
                  </div>
               <?php endif; ?>
               
               <?php if ($p['foto_peristiwa'] && $p['foto_peristiwa'] != 'default.jpg'): ?>
                  <img src="<?= base_url('uploaded_files/peristiwa/' . $p['foto_peristiwa']); ?>" 
                       alt="<?= esc($p['nama_peristiwa']); ?>" 
                       class="peristiwa-img">
               <?php endif; ?>
               
               <div class="flex-btn" style="margin-top: 15px;">
                  <a href="<?= base_url('admin/peristiwa/edit/' . $p['id']); ?>" class="option-btn">Edit</a>
                  
                  <a href="<?= base_url('admin/peristiwa/delete/' . $p['id']); ?>" 
                     class="delete-btn" 
                     onclick="return confirm('Hapus peristiwa ini?');">Hapus</a>
               </div>
            </div>
         <?php endforeach; ?>
      <?php else : ?>
         <div class="empty-peristiwa">
            <i class="fas fa-history"></i>
            <h3>Belum Ada Peristiwa</h3>
            <p>Belum ada peristiwa yang tercatat untuk kerajaan ini.</p>
         </div>
      <?php endif; ?>
   </div>
   
   </div>
</section>


<!-- Bagian soal di view_mapel.php -->
 <section class="contents">
<?php if(!empty($soal)): ?>
    <h2 class="heading">Soal Quiz</h2>
    <div class="box-container">
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

                <form method="post" action="<?= base_url('admin/delete-soal'); ?>" class="flex-btn">
                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                    <a href="<?= base_url('admin/soal/edit/' . $row['id']); ?>" class="option-btn">update</a>
                    <button type="submit" class="delete-btn" onclick="return confirm('Hapus soal ini?');">delete</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p class="empty">Belum ada soal untuk mapel ini!</p>
<?php endif; ?>
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
