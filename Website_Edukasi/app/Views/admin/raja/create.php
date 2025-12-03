<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('css/styleadmin.css'); ?>">
</head>
<body>

<?= view('admin/components/admin_header', ['profile' => $profile]); ?>

<section class="playlist-form">
    <h1 class="heading"><?= $title ?></h1>
    
    <form action="<?= base_url('admin/raja/store/' . $mapel['id']) ?>" method="post" enctype="multipart/form-data" class="form">
        
        <?php if (session()->has('errors')): ?>
            <?php foreach (session('errors') as $error): ?>
                <div class="error-message"><?= $error ?></div>
            <?php endforeach; ?>
        <?php endif; ?>
        
        <p>Nama Raja <span>*</span></p>
        <input type="text" name="nama" maxlength="100" placeholder="Masukkan nama raja" class="box" required>
        
        <p>Foto Raja</p>
        <input type="file" name="foto" accept="image/*" class="box">
        <p class="note">Format: jpg, jpeg, png | Maks: 2MB</p>
        
        <p>Cerita / Biografi <span>*</span></p>
        <textarea name="cerita" class="box" placeholder="Tuliskan cerita atau biografi raja..." rows="10" required></textarea>
        
        <p>Koordinat Lokasi (Opsional)</p>
        <div class="flex-form">
            <div style="flex: 1; margin-right: 10px;">
                <p>Latitude</p>
                <input type="text" name="latitude" placeholder="Contoh: -7.7956" class="box">
            </div>
            <div style="flex: 1;">
                <p>Longitude</p>
                <input type="text" name="longitude" placeholder="Contoh: 110.3695" class="box">
            </div>
        </div>
        
        <input type="submit" value="Simpan Raja" name="submit" class="btn">
        <a href="<?= base_url('admin/mapel/' . $mapel['id'] . '/raja') ?>" class="option-btn">Kembali</a>
        
        <?= csrf_field(); ?>
    </form>
</section>

<?= view('admin/components/footer'); ?>
<script src="<?= base_url('js/admin_script.js'); ?>"></script>

<style>
.flex-form {
    display: flex;
    gap: 10px;
}
.note {
    font-size: 12px;
    color: #666;
    margin-top: 5px;
}
</style>

</body>
</html>