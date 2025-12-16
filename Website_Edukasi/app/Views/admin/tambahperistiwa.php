<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peristiwa</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('css/styleadmin.css'); ?>">
</head>

<body>

    <!-- Header -->
    <?= view('admin/components/admin_header', ['profile' => $profile]); ?>

    <section class="playlist-form">

        <h1 class="heading">Tambah Peristiwa</h1>

        <!-- Pesan sukses / error -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success" style="color: green; margin-bottom: 15px;">
                <?= session()->getFlashdata('success'); ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger" style="color: red; margin-bottom: 15px;">
                <?= session()->getFlashdata('error'); ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('/admin/tambah-peristiwa'); ?>" method="post">
            <?= csrf_field(); ?>

            <!-- Kerajaan -->
            <p>Pilih Kerajaan <span>*</span></p>
            <select name="kerajaan_id" class="box" required>
                <option value="" disabled selected>-- pilih kerajaan --</option>
                <?php foreach ($kerajaan as $k): ?>
                    <option value="<?= $k['id']; ?>"><?= esc($k['nama_kerajaan']); ?></option>
                <?php endforeach; ?>
            </select>

            <!-- Nama Peristiwa -->
            <p>Nama Peristiwa <span>*</span></p>
            <input type="text" name="nama_peristiwa" maxlength="150" required placeholder="Masukkan nama peristiwa" class="box">

            <!-- Tahun -->
            <p>Tahun Peristiwa <span>*</span></p>
            <input type="text" name="tahun" maxlength="50" required placeholder="Contoh: 1293 M" class="box">

            <!-- Lokasi -->
            <p>Lokasi Peristiwa <span>*</span></p>
            <input type="text" name="lokasi" maxlength="200" required placeholder="Masukkan lokasi peristiwa" class="box">

            <!-- Deskripsi -->
            <p>Deskripsi Peristiwa <span>*</span></p>
            <textarea name="deskripsi" class="box" required placeholder="Tulis deskripsi lengkap peristiwa" maxlength="2000" rows="6"></textarea>

            <!-- Fakta Menarik -->
            <p>Fakta Menarik <span>*</span></p>
            <textarea
                name="fakta_menarik"
                class="box"
                required
                placeholder="Contoh:
• Peristiwa ini terjadi saat masa pemerintahan ...
• Berdampak besar pada perkembangan kerajaan ..."
                maxlength="2000"
                rows="6"></textarea>

            <input type="submit" value="Tambah Peristiwa" class="btn">
        </form>

    </section>

    <?= view('admin/components/footer'); ?>

    <script src="<?= base_url('js/admin_script.js'); ?>"></script>

</body>

</html>