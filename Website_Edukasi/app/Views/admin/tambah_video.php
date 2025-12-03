<!DOCTYPE html>
<html lang="id">
<head>
   <meta charset="UTF-8">
   <title>Tambah Video</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="<?= base_url('css/styleadmin.css'); ?>">
</head>
<body>

<?= view('admin/components/admin_header', ['profile' => $profile]); ?>

<section class="video-form">

   <h1 class="heading">Tambah Video</h1>

   <?php if (session()->getFlashdata('success')): ?>
      <p class="success"><?= session()->getFlashdata('success'); ?></p>
   <?php endif; ?>

   <?php if (session()->getFlashdata('error')): ?>
      <p class="error"><?= session()->getFlashdata('error'); ?></p>
   <?php endif; ?>

   <form action="<?= base_url('admin/tambah-video'); ?>" method="post" enctype="multipart/form-data">

      <p>Status Video <span>*</span></p>
      <select name="status" class="box" required>
         <option value="" disabled selected>-- pilih status --</option>
         <option value="active">active</option>
         <option value="deactive">deactive</option>
      </select>

      <p>Judul Video <span>*</span></p>
      <input type="text" name="title" maxlength="100" required class="box"
             placeholder="Masukkan judul video">

      <p>Deskripsi Video <span>*</span></p>
      <textarea name="description" class="box" required maxlength="1000" cols="30" 
                rows="6" placeholder="Tulis deskripsi"></textarea>

      <p>Mata Pelajaran (Mapel) <span>*</span></p>
      <select name="playlist" class="box" required>
         <option value="" disabled selected>-- pilih mata pelajaran --</option>

         <?php foreach ($mapel as $mp): ?>
            <option value="<?= esc($mp['id']); ?>">
               <?= esc($mp['nama_kerajaan']); ?>
            </option>
         <?php endforeach; ?>

      </select>

      <p>Pilih Thumbnail <span>*</span></p>
      <input type="file" name="thumb" accept="image/*" required class="box">

      <p>Pilih File Video <span>*</span></p>
      <input type="file" name="video" accept="video/*" required class="box">

      <input type="submit" name="submit" value="Upload Video" class="btn">
   </form>

</section>

<?= view('admin/components/footer'); ?>

<script src="<?= base_url('js/admin_script.js'); ?>"></script>
</body>
</html>
