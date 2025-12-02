<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Mapel</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="<?= base_url('css/styleadmin.css'); ?>">
</head>
<body>

<!-- Header -->
<?= view('admin/components/admin_header', ['profile' => $profile]); ?>

<section class="playlist-form">

   <h1 class="heading">Update Mapel</h1>

   <!-- Pesan Flash -->
   <?php if(session()->getFlashdata('success')): ?>
      <div class="success-msg"><?= session()->getFlashdata('success'); ?></div>
   <?php endif; ?>

   <?php if(session()->getFlashdata('error')): ?>
      <div class="error-msg"><?= session()->getFlashdata('error'); ?></div>
   <?php endif; ?>

   <form action="<?= base_url('admin/update-mapel/'.$mapel['id']); ?>" method="post" enctype="multipart/form-data">
      <p>Nama Kerajaan <span>*</span></p>
      <input type="text" name="nama_kerajaan" class="box" required value="<?= $mapel['nama_kerajaan']; ?>">

      <p>Tahun Berdiri</p>
      <input type="text" name="tahun_berdiri" class="box" value="<?= $mapel['tahun_berdiri']; ?>">

      <p>Lokasi</p>
      <input type="text" name="lokasi" class="box" value="<?= $mapel['lokasi']; ?>">

      <p>Deskripsi <span>*</span></p>
      <textarea name="deskripsi" class="box" required><?= $mapel['deskripsi']; ?></textarea>

      <p>Daftar Raja</p>
      <textarea name="daftar_raja" class="box"><?= $mapel['daftar_raja']; ?></textarea>

      <p>Status Mapel</p>
      <select name="status" class="box" required>
         <option value="<?= $mapel['status']; ?>"><?= $mapel['status']; ?></option>
         <option value="active">active</option>
         <option value="deactive">deactive</option>
      </select>

      <p>Foto Raja</p>
      <div class="thumb">
         <img src="<?= base_url('uploaded_files/'.$mapel['foto_raja']); ?>" width="200">
      </div>

      <input type="file" name="foto_raja" accept="image/*" class="box">

      <input type="submit" value="Update Mapel" class="btn">

      <div class="flex-btn">
         <a href="<?= base_url('admin/mapel'); ?>" class="option-btn">Kembali</a>
      </div>

   </form>

</section>

<?= view('admin/components/footer'); ?>

</body>
</html>
