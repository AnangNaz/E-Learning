<!DOCTYPE html>
<html lang="id">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cari Kerajaan</title>
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="<?= base_url('css/styleadmin.css'); ?>">
</head>
<body>

<?= view('admin/components/admin_header', ['profile' => $profile ?? null]); ?>

<section class="search-mapel" style="padding: 2rem;">
   
   <h1 class="heading">Cari Kerajaan</h1>
   
   <!-- Search Form -->
   <div class="search-form" style="background: #fff; border-radius: .5rem; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 .5rem 1rem rgba(0,0,0,.1);">
      <form action="<?= base_url('admin/search-mapel') ?>" method="get" class="flex" style="display: flex; gap: 1rem;">
         <input type="text" name="search" placeholder="Cari berdasarkan nama, lokasi, atau tahun..." 
                class="box" value="<?= esc($search ?? '') ?>" maxlength="100" style="flex: 1; padding: 1.2rem; font-size: 1.6rem; border: .1rem solid #aaa; border-radius: .5rem;">
         <button type="submit" class="fas fa-search" style="background: var(--main-color); color: #fff; border: none; border-radius: .5rem; width: 4.5rem; font-size: 2rem; cursor: pointer;"></button>
      </form>
      <p style="margin-top: .5rem; color: #666; font-size: 1.3rem;">Cari berdasarkan: nama kerajaan, lokasi, atau tahun berdiri</p>
   </div>
   
   <!-- Messages -->
   <?php if (session()->getFlashdata('success')): ?>
      <div class="message success" style="padding: 1.5rem; margin-bottom: 1.5rem; background: #d4edda; color: #155724; border-radius: .5rem; display: flex; justify-content: space-between; align-items: center;">
         <span><?= session()->getFlashdata('success') ?></span>
         <i class="fas fa-times" onclick="this.parentElement.remove();" style="cursor: pointer;"></i>
      </div>
   <?php endif; ?>
   
   <?php if (session()->getFlashdata('error')): ?>
      <div class="message error" style="padding: 1.5rem; margin-bottom: 1.5rem; background: #f8d7da; color: #721c24; border-radius: .5rem; display: flex; justify-content: space-between; align-items: center;">
         <span><?= session()->getFlashdata('error') ?></span>
         <i class="fas fa-times" onclick="this.parentElement.remove();" style="cursor: pointer;"></i>
      </div>
   <?php endif; ?>
   
   <!-- Results -->
   <?php if (!empty($search)): ?>
      
      <?php if (!empty($mapels)): ?>
         
         <div class="mapel-stats" style="background: #f8f9fa; padding: 1rem; border-radius: .5rem; margin-bottom: 2rem; border-left: 4px solid var(--main-color);">
            <p style="margin: 0; font-size: 1.6rem;">Ditemukan <strong><?= count($mapels) ?></strong> kerajaan untuk kata kunci: <strong>"<?= esc($search) ?>"</strong></p>
         </div>
         
         <div class="box-container" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
            
            <?php foreach ($mapels as $mapel): ?>
               <div class="box" style="background: #fff; border-radius: .5rem; padding: 2rem; box-shadow: 0 .5rem 1rem rgba(0,0,0,.1); transition: transform .3s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                  
                  <!-- Status -->
                  <div class="flex" style="display: flex; justify-content: space-between; margin-bottom: 1rem; font-size: 1.4rem;">
                     <div>
                        <i class="fas fa-circle" style="color: <?= $mapel['status'] == 'active' ? '#28a745' : '#dc3545' ?>"></i>
                        <span style="color: <?= $mapel['status'] == 'active' ? '#28a745' : '#dc3545' ?>">
                           <?= ucfirst($mapel['status']) ?>
                        </span>
                     </div>
                     <div>
                        <i class="fas fa-calendar"></i>
                        <span><?= date('d M Y') ?></span>
                     </div>
                  </div>
                  
                  <!-- Thumbnail -->
                  <?php
                  $fotoPath = 'uploaded_files/' . ($mapel['foto_raja'] ?? 'default.jpg');
                  $fotoUrl = (file_exists($fotoPath) && !empty($mapel['foto_raja'])) ? 
                             base_url($fotoPath) : base_url('uploaded_files/default.jpg');
                  ?>
                  <div class="thumb" style="text-align: center; margin-bottom: 1.5rem;">
                     <img src="<?= $fotoUrl ?>" alt="<?= esc($mapel['nama_kerajaan']) ?>"
                          style="width: 100%; height: 200px; object-fit: cover; border-radius: .5rem;"
                          onerror="this.src='<?= base_url('uploaded_files/mapel/default.jpg') ?>'">
                  </div>
                  
                  <!-- Info -->
                  <h3 class="title" style="font-size: 2rem; color: var(--black); margin-bottom: .5rem;"><?= esc($mapel['nama_kerajaan']) ?></h3>
                  <p class="info" style="font-size: 1.4rem; color: #666; margin-bottom: .5rem;">
                     <i class="fas fa-map-marker-alt"></i> <?= esc($mapel['lokasi']) ?>
                  </p>
                  <p class="info" style="font-size: 1.4rem; color: #666; margin-bottom: .5rem;">
                     <i class="fas fa-calendar-alt"></i> <?= esc($mapel['tahun_berdiri']) ?>
                  </p>
                  
                  <!-- Stats -->
                  <div class="stats" style="display: flex; gap: 2rem; margin: 1rem 0; padding: 1rem 0; border-top: 1px solid #eee; border-bottom: 1px solid #eee;">
                     <?php if(isset($mapel['total_materi'])): ?>
                     <div class="stat" style="display: flex; align-items: center; gap: .5rem; font-size: 1.4rem;">
                        <i class="fas fa-book" style="color: var(--main-color);"></i>
                        <span><?= $mapel['total_materi'] ?> Materi</span>
                     </div>
                     <?php endif; ?>
                     
                     <?php if(isset($mapel['total_raja'])): ?>
                     <div class="stat" style="display: flex; align-items: center; gap: .5rem; font-size: 1.4rem;">
                        <i class="fas fa-crown" style="color: var(--main-color);"></i>
                        <span><?= $mapel['total_raja'] ?> Raja</span>
                     </div>
                     <?php endif; ?>
                  </div>
                  
                  <!-- Deskripsi singkat -->
                  <p class="description" style="font-size: 1.4rem; color: #555; line-height: 1.6; margin: 1rem 0;">
                     <?= strlen($mapel['deskripsi'] ?? '') > 150 ? 
                        substr(strip_tags($mapel['deskripsi']), 0, 150) . '...' : 
                        strip_tags($mapel['deskripsi'] ?? '') ?>
                  </p>
                  
                  <!-- Action Buttons -->
                  <div class="action-buttons" style="display: flex; gap: .5rem; margin-top: 1.5rem;">
                     <a href="<?= base_url('admin/mapel/view/' . $mapel['id']) ?>" class="btn" style="padding: .8rem 1.5rem; background: var(--main-color); color: #fff; border-radius: .5rem; font-size: 1.4rem; text-decoration: none; display: inline-flex; align-items: center; gap: .5rem;">
                        <i class="fas fa-eye"></i> Lihat
                     </a>
                     
                     <a href="<?= base_url('admin/mapel/update/' . $mapel['id']) ?>" class="option-btn" style="padding: .8rem 1.5rem; background: #ffc107; color: #000; border-radius: .5rem; font-size: 1.4rem; text-decoration: none; display: inline-flex; align-items: center; gap: .5rem;">
                        <i class="fas fa-edit"></i> Edit
                     </a>
                     
                     <form action="<?= base_url('admin/search-mapel/delete/' . $mapel['id']) ?>" 
                           method="post" class="inline-form" 
                           onsubmit="return confirm('Hapus kerajaan <?= esc($mapel['nama_kerajaan']) ?>? Semua raja juga akan terhapus!');" style="display: inline;">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="delete-btn" style="padding: .8rem 1.5rem; background: #dc3545; color: #fff; border: none; border-radius: .5rem; font-size: 1.4rem; cursor: pointer; display: inline-flex; align-items: center; gap: .5rem;">
                           <i class="fas fa-trash"></i> Hapus
                        </button>
                     </form>
                  </div>
               </div>
            <?php endforeach; ?>
            
         </div>
         
      <?php else: ?>
         <div class="empty" style="text-align: center; padding: 3rem; background: #f8f9fa; border-radius: .5rem; margin-top: 2rem;">
            <p style="font-size: 1.6rem; color: #666; margin-bottom: 1.5rem;">Tidak ditemukan kerajaan untuk kata kunci: "<?= esc($search) ?>"</p>
            <a href="<?= base_url('admin/tambah-mapel') ?>" class="btn" style="padding: 1rem 2rem; background: var(--main-color); color: #fff; border-radius: .5rem; font-size: 1.6rem; text-decoration: none;">Tambah Kerajaan Baru</a>
         </div>
      <?php endif; ?>
      
   <?php else: ?>
      <div class="empty" style="text-align: center; padding: 3rem; background: #f8f9fa; border-radius: .5rem; margin-top: 2rem;">
         <p style="font-size: 1.6rem; color: #666;">Silakan masukkan kata kunci pencarian di atas</p>
      </div>
   <?php endif; ?>
   
</section>

<?= view('admin/components/footer'); ?>

<script src="<?= base_url('js/admin_script.js'); ?>"></script>

<script>
// Handle image error
document.addEventListener('DOMContentLoaded', function() {
   document.querySelectorAll('.thumb img').forEach(img => {
      img.addEventListener('error', function() {
         this.src = '<?= base_url('uploaded_files/mapel/default.jpg') ?>';
      });
   });
});
</script>

</body>
</html>