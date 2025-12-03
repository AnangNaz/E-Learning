<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Soal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('css/styleadmin.css'); ?>">
</head>
<body>

<?= view('admin/components/admin_header', ['profile' => $profile]); ?>

<section class="view-container">

<h1 class="heading">Detail Soal</h1>

<div class="box">
    <h3><?= esc($data['question']); ?></h3>

    <p><b>Materi terkait:</b> <?= esc($data['materi_title'] ?? 'Tidak ada materi'); ?></p>

    <div class="options">
        <p><strong>A.</strong> <?= esc($data['option_a']); ?></p>
        <p><strong>B.</strong> <?= esc($data['option_b']); ?></p>
        <p><strong>C.</strong> <?= esc($data['option_c']); ?></p>
        <p><strong>D.</strong> <?= esc($data['option_d']); ?></p>
    </div>

    <p><b>Jawaban Benar:</b> <?= strtoupper(esc($data['correct_option'])); ?></p>

    <br>
    <a href="<?= base_url('admin/materi'); ?>" class="btn">Kembali ke Materi</a>
    <a href="<?= base_url('admin/soal'); ?>" class="btn">Kembali ke Soal</a>
</div>

</section>

<?= view('admin/components/footer'); ?>
<script src="<?= base_url('js/admin_script.js'); ?>"></script>
</body>
</html>