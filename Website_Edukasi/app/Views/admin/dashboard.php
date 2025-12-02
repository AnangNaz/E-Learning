<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="<?= base_url('css/styleadmin.css') ?>">
</head>

<body>

<?= $this->include('admin/components/admin_header') ?>

<section class="dashboard">

   <h1 class="heading">Dashboard</h1>

   <div class="box-container">

      <div class="box">
         <h3>Welcome!</h3>
         <p><?= esc($profile['name'] ?? '') ?></p>

         <a href="<?= base_url('admin/profile') ?>" class="btn">View profile</a>
      </div>

      <div class="box">
         <h3><?= $total_contents ?></h3>
         <p>Total Materi</p>
         <a href="<?= base_url('admin/tambah-materi') ?>" class="btn">Tambah Materi</a>
      </div>

      <div class="box">
         <h3><?= $total_mapel ?></h3>
         <p>Total Mata Pelajaran</p>
         <a href="<?= base_url('admin/tambah-mapel') ?>" class="btn">Tambah Mapel</a>
      </div>

      <div class="box">
         <h3><?= $total_comments ?></h3>
         <p>Total Komentar</p>
         <a href="<?= base_url('admin/komentar') ?>" class="btn">Lihat Komentar</a>
      </div>

   </div>

</section>

<script src="<?= base_url('js/admin_script.js') ?>"></script>

</body>
</html>
