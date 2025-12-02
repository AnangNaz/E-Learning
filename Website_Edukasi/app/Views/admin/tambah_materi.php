<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Materi</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('css/styleadmin.css'); ?>">
</head>
<body>

<!-- Header -->
<?= view('admin/components/admin_header', ['profile' => $profile]); ?>

<section class="form-container">

<form action="<?= base_url('admin/tambah-materi'); ?>" method="post">
    <h3>Tambah Materi</h3>

    <!-- Pesan notifikasi -->
    <?php if (session()->getFlashdata('success')): ?>
        <p class="success"><?= session()->getFlashdata('success'); ?></p>
    <?php elseif (session()->getFlashdata('error')): ?>
        <p class="error"><?= session()->getFlashdata('error'); ?></p>
    <?php endif; ?>

    <p>Judul Materi</p>
    <input type="text" name="title" required class="box">

    <p>Pilih Mapel (Kerajaan)</p>
    <select name="mapel_id" class="box" required>
        <?php foreach ($mapel as $row): ?>
            <option value="<?= $row['id']; ?>"><?= $row['nama_kerajaan']; ?></option>
        <?php endforeach; ?>
    </select>

    <p>Deskripsi</p>
    <textarea name="description" class="box" rows="4" required></textarea>

    <p>Isi Materi (Teks Panjang)</p>
    <textarea name="materi" class="box" rows="12" required placeholder="Tulis materi lengkap di sini..."></textarea>

    <input type="submit" value="Simpan Materi" class="btn">
</form>

</section>

<?= view('admin/components/footer'); ?>

<script src="<?= base_url('js/admin_script.js'); ?>"></script>

</body>
</html>
