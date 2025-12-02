<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Update Materi</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="<?= base_url('css/styleadmin.css'); ?>">
</head>
<body>

<?= view('admin/components/admin_header', ['profile' => $profile]); ?>

<section class="form-container">

<form action="<?= base_url('admin/update-materi/'.$materi['id']); ?>" method="post">
   <h3>Update Materi</h3>

   <?php if(session()->getFlashdata('success')): ?>
      <p class="message"><?= session()->getFlashdata('success'); ?></p>
   <?php endif; ?>

   <p>Judul Materi <span>*</span></p>
   <input type="text" name="title" class="box" required value="<?= esc($materi['title']); ?>">

   <p>Deskripsi <span>*</span></p>
   <textarea name="description" class="box" rows="4" required><?= esc($materi['description']); ?></textarea>

   <p>Isi Materi (Teks Panjang) <span>*</span></p>
   <textarea name="materi" class="box" rows="15" required><?= esc($materi['materi']); ?></textarea>

   <input type="submit" name="submit" value="Update Materi" class="btn">
</form>

</section>

<?= view('admin/components/footer'); ?>
<script src="<?= base_url('js/admin_script.js'); ?>"></script>

</body>
</html>
