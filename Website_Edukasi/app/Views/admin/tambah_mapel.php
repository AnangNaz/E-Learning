<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tambah Kerajaan</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="<?= base_url('css/styleadmin.css'); ?>">

</head>

<body>

   <!-- Header -->
   <?= view('admin/components/admin_header', ['profile' => $profile]); ?>

   <section class="playlist-form">

      <h1 class="heading">Tambah Kerajaan</h1>

      <!-- Pesan sukses / error -->
      <?php if (session()->getFlashdata('success')): ?>
         <div class="alert alert-success" style="color: green; margin-bottom: 15px;">
            <?= session()->getFlashdata('success'); ?>
         </div>
      <?php endif; ?>

      <?php if (session()->getFlashdata('error')): ?>
         <div class="alert alert-danger" style="color: red; margin-bottom: 15px;">
            <?= session()->getFlashdata('error'); ?>
         </div>
      <?php endif; ?>

      <form action="<?= base_url('/admin/tambah-mapel'); ?>"
         method="post"
         enctype="multipart/form-data">

         <?= csrf_field(); ?>

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
         <textarea name="daftar_raja" class="box" required placeholder="Contoh:
• Raja Mulawarman
• Raja Aswawarman" maxlength="2000" rows="6"></textarea>

         <p>Foto Raja / Ikon Kerajaan <span>*</span></p>
         <input type="file" name="foto_raja" accept="image/*" required class="box">

         <p>Latitude <span>*</span></p>
         <input type="text" name="latitude" maxlength="50" required placeholder="Masukkan latitude" class="box">

         <p>Longitude <span>*</span></p>
         <input type="text" name="longitude" maxlength="50" required placeholder="Masukkan longitude" class="box">


         <input type="submit" value="Tambah Kerajaan" name="submit" class="btn">
      </form>

   </section>

   <?= view('admin/components/footer'); ?>

   <script src="<?= base_url('js/admin_script.js'); ?>"></script>

</body>

</html>