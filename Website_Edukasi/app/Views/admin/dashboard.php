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

<?= view('admin/components/admin_header', ['profile' => $profile]); ?>

<section class="dashboard">

   <h1 class="heading">Dashboard</h1>

<div class="box-container">
    <div class="box">
        <h3>Welcome!</h3>
        <p><?= esc($profile['name'] ?? '') ?></p>
        <a href="<?= base_url('admin/profile') ?>" class="btn">View profile</a>
    </div>

    <div class="box">
        <h3><?= $total_mapel ?></h3>
        <p>Total Kerajaan</p>
        <a href="<?= base_url('admin/mapel') ?>" class="btn">Lihat Kerajaan</a>
    </div>

    <div class="box">
        <h3><?= $total_raja ?></h3>
        <p>Total Raja</p>
        <a href="<?= base_url('admin/materi') ?>" class="btn">Lihat Raja</a>
    </div>


    <div class="box">
        <h3><?= $total_peristiwa ?></h3>
        <p>Total Peristiwa</p>
        <a href="<?= base_url('admin/materi') ?>" class="btn">Lihat Peristiwa</a>
    </div>

    <div class="box">
        <h3><?= $total_soal ?></h3>
        <p>Total Soal Quiz</p>
        <a href="<?= base_url('admin/materi') ?>" class="btn">Lihat Soal</a>
    </div>
</div>

</section>

<script src="<?= base_url('js/admin_script.js') ?>"></script>

</body>
</html>
