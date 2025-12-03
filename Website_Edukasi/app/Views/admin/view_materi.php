<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>View Materi</title>
   
   <!-- CSS -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="<?= base_url('css/styleadmin.css'); ?>">
</head>
<body>

<?= view('admin/components/admin_header', ['profile' => $profile]); ?>

<section class="view-container">

   <h1 class="heading"><?= esc($materi['title']); ?></h1>

   <div class="box">
      <p><strong>Deskripsi:</strong></p>
      <p><?= nl2br(esc($materi['description'])); ?></p>

      <br>

      <p><strong>Materi Lengkap:</strong></p>
      <div class="materi-text" style="white-space:pre-wrap; line-height:1.7; font-size:15px;">
         <?= nl2br(esc($materi['materi'])); ?>
      </div>

      <a href="<?= base_url('admin/update-materi/' . $materi['id']); ?>" class="option-btn">Update</a>
   </div>

</section>

<?= view('admin/components/footer'); ?>
<script src="<?= base_url('js/admin_script.js'); ?>"></script>

</body>
</html>
