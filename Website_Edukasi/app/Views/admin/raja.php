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

<section class="contents">
    <h1 class="heading"><?= $title ?></h1>
    
    <div class="add-button">
        <a href="<?= base_url('admin/raja/create/' . $mapel['id']) ?>" class="btn">
            <i class="fas fa-plus"></i> Tambah Raja Baru
        </a>
        <a href="<?= base_url('admin/mapel') ?>" class="btn" style="background: #6c757d;">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Kerajaan
        </a>
    </div>

    <?php if (session()->has('success')): ?>
        <div class="success-message">
            <?= session('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->has('error')): ?>
        <div class="error-message">
            <?= session('error') ?>
        </div>
    <?php endif; ?>

    <div class="box-container">
        <?php if (!empty($raja)): ?>
            <?php foreach ($raja as $r): ?>
                <div class="box" style="text-align: center;">
                    <img src="<?= base_url('uploaded_files/raja/' . $r['foto']) ?>" 
                         alt="<?= $r['nama'] ?>" 
                         style="width: 200px; height: 200px; object-fit: cover; border-radius: 10px; margin-bottom: 15px;">
                    
                    <h3 style="margin: 10px 0;"><?= esc($r['nama']) ?></h3>
                    
                    <p style="color: #666; font-size: 14px; margin-bottom: 15px;">
                        <?= strlen($r['cerita']) > 100 ? substr($r['cerita'], 0, 100) . '...' : $r['cerita'] ?>
                    </p>
                    
                    <?php if (!empty($r['longitude']) && !empty($r['latitude'])): ?>
                        <p style="color: #4CAF50; font-size: 12px;">
                            <i class="fas fa-map-marker-alt"></i> 
                            <?= $r['latitude'] ?>, <?= $r['longitude'] ?>
                        </p>
                    <?php endif; ?>
                    
                    <div class="flex-btn" style="margin-top: 15px;">
                        <a href="<?= base_url('admin/raja/edit/' . $r['id']) ?>" class="option-btn">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="<?= base_url('admin/raja/delete/' . $r['id']) ?>" 
                           class="delete-btn" 
                           onclick="return confirm('Hapus raja <?= $r['nama'] ?>?')">
                            <i class="fas fa-trash"></i> Hapus
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty">
                <p>Belum ada raja untuk kerajaan ini.</p>
                <a href="<?= base_url('admin/raja/create/' . $mapel['id']) ?>" class="btn">Tambah Raja Pertama</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?= view('admin/components/footer'); ?>
<script src="<?= base_url('js/admin_script.js'); ?>"></script>
</body>
</html>