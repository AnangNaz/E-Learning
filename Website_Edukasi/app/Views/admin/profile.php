<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Profile</title>

   <link rel="stylesheet" 
         href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="<?= base_url('css/styleadmin.css') ?>">

</head>
<body>

<?= view('admin/components/admin_header', ['profile' => $profile]); ?>

<section class="tutor-profile" style="min-height: calc(100vh - 19rem);"> 

   <h1 class="heading">Profile Details</h1>

   <div class="details">

      <div class="tutor">
         <img src="<?= base_url('uploaded_files/' . ($profile['image'] ?? 'default.png')); ?>" alt="">
         <h3><?= esc($profile['name']); ?></h3>
         <span><?= esc($profile['profession']); ?></span>
         <a href="<?= base_url('admin/update_profile'); ?>" class="inline-btn">Update Profile</a>
      </div>

      <div class="flex">

         <div class="box">
            <span><?= $total_mapel; ?></span>
            <p>Total Mapel</p>
            <a href="<?= base_url('admin/mapel'); ?>" class="btn">Lihat Mapel</a>
         </div>

         <div class="box">
            <span><?= $total_materi; ?></span>
            <p>Total Materi / Video</p>
            <a href="<?= base_url('admin/materi'); ?>" class="btn">Lihat Materi</a>
         </div>

         <div class="box">
            <span><?= $total_likes; ?></span>
            <p>Total Likes</p>
            <a href="<?= base_url('admin/materi'); ?>" class="btn">Lihat Materi</a>
         </div>

         <div class="box">
            <span><?= $total_comments; ?></span>
            <p>Total Komentar</p>
            <a href="<?= base_url('admin/komentar'); ?>" class="btn">Lihat Komentar</a>
         </div>

      </div>
   </div>

</section>

<?= view('admin/components/footer'); ?>

<script src="<?= base_url('js/admin_script.js'); ?>"></script>

</body>
</html>
