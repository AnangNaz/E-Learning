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
    
    <form action="<?= base_url('admin/peristiwa/store'); ?>" method="post" enctype="multipart/form-data" class="form">
        
        <?php if (session()->has('errors')): ?>
            <div class="error-container">
                <?php foreach (session('errors') as $error): ?>
                    <div class="error-message"><?= $error ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <!-- 1. Pilih Kerajaan -->
        <p>Pilih Kerajaan <span>*</span></p>
        <select name="kerajaan_id" class="box" required>
            <option value="">-- Pilih Kerajaan --</option>
            <?php foreach ($mapelList as $mapel): ?>
                <option value="<?= $mapel['id'] ?>" <?= old('kerajaan_id') == $mapel['id'] ? 'selected' : '' ?>>
                    <?= esc($mapel['nama_kerajaan']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <!-- 2. Nama Peristiwa -->
        <p>Nama Peristiwa <span>*</span></p>
        <input type="text" name="nama_peristiwa" maxlength="255" 
               placeholder="Contoh: Perang Bubat, Sumpah Palapa, dll" 
               class="box" value="<?= old('nama_peristiwa') ?>" required>
        
        <!-- 3. Tahun -->
        <p>Tahun (Opsional)</p>
        <input type="text" name="tahun" maxlength="50"
               placeholder="Contoh: 1357, 1527, 1945" 
               class="box" value="<?= old('tahun') ?>">
        
        <!-- 4. Lokasi (Opsional) -->
        <p>Lokasi Peristiwa (Opsional)</p>
        <input type="text" name="lokasi" maxlength="255"
               placeholder="Contoh: Majapahit, Jawa Timur" 
               class="box" value="<?= old('lokasi') ?>">
        
        <!-- 5. Foto Peristiwa (Opsional) -->
        <p>Foto Peristiwa (Opsional)</p>
        <input type="file" name="foto_peristiwa" accept="image/*" class="box">
        <p class="note">Format: jpg, jpeg, png | Maks: 2MB</p>
        
        <!-- 6. Deskripsi -->
        <p>Deskripsi Peristiwa <span>*</span></p>
        <textarea name="deskripsi" class="box" 
                  placeholder="Jelaskan secara detail tentang peristiwa ini..." 
                  rows="8" required><?= old('deskripsi') ?></textarea>
        
        <!-- 7. Fakta Menarik (Opsional) -->
        <p>Fakta Menarik (Opsional)</p>
        <textarea name="fakta_menarik" class="box" 
                  placeholder="Tuliskan fakta-fakta menarik tentang peristiwa ini..." 
                  rows="6"><?= old('fakta_menarik') ?></textarea>
        
        <div class="flex-buttons">
            <input type="submit" value="Simpan Peristiwa" name="submit" class="btn">
            <a href="<?= base_url('admin/materi'); ?>" class="option-btn">Kembali</a>
        </div>
        
        <?= csrf_field(); ?>
    </form>
</section>

<?= view('admin/components/footer'); ?>
<script src="<?= base_url('js/admin_script.js'); ?>"></script>

<style>
.error-container {
    background: #fee;
    border: 1px solid #f99;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 5px;
}

.error-message {
    color: #d00;
    margin: 5px 0;
    padding: 5px 10px;
    border-left: 4px solid #d00;
}

.flex-buttons {
    display: flex;
    gap: 15px;
    margin-top: 20px;
}

.flex-buttons .btn,
.flex-buttons .option-btn {
    flex: 1;
    text-align: center;
}

.note {
    font-size: 12px;
    color: #666;
    margin-top: 5px;
    margin-bottom: 15px;
}
</style>

</body>
</html>