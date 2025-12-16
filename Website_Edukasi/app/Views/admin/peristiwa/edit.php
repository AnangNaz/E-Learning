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
    
    <form action="<?= base_url('admin/peristiwa/update/' . $peristiwa['id']); ?>" method="post" class="form">
        
        <?php if (session()->has('errors')): ?>
            <div class="error-container">
                <?php foreach (session('errors') as $error): ?>
                    <div class="error-message"><?= $error ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <!-- Dropdown Pilih Kerajaan -->
        <p>Pilih Kerajaan <span>*</span></p>
        <select name="kerajaan_id" class="box" required>
            <option value="">-- Pilih Kerajaan --</option>
            <?php foreach ($mapelList as $mapel): ?>
                <option value="<?= $mapel['id'] ?>" 
                    <?= ($peristiwa['kerajaan_id'] == $mapel['id'] || old('kerajaan_id') == $mapel['id']) ? 'selected' : '' ?>>
                    <?= esc($mapel['nama_kerajaan']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <p>Judul Peristiwa <span>*</span></p>
        <input type="text" name="judul" maxlength="200" 
               placeholder="Contoh: Perang Bubat, Sumpah Palapa, dll" 
               class="box" value="<?= old('judul', $peristiwa['judul']) ?>" required>
        
        <p>Tahun Peristiwa <span>*</span></p>
        <input type="number" name="tahun" 
               placeholder="Contoh: 1357, 1527, 1945" 
               class="box" value="<?= old('tahun', $peristiwa['tahun']) ?>" required>
        
        <p>Deskripsi Peristiwa <span>*</span></p>
        <textarea name="deskripsi" class="box" 
                  placeholder="Jelaskan secara detail tentang peristiwa ini..." 
                  rows="10" required><?= old('deskripsi', $peristiwa['deskripsi']) ?></textarea>
        
        <div class="flex-buttons">
            <input type="submit" value="Update Peristiwa" name="submit" class="btn">
            <a href="<?= base_url('admin/mapel/' . $peristiwa['kerajaan_id'] . '/peristiwa'); ?>" class="option-btn">Kembali</a>
        </div>
        
        <?= csrf_field(); ?>
    </form>
</section>

<?= view('admin/components/footer'); ?>
<script src="<?= base_url('js/admin_script.js'); ?>"></script>

<style>
/* Sama dengan create.php */
</style>

</body>
</html>