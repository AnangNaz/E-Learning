<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
   <title>Tambah Soal</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="<?= base_url('css/styleadmin.css'); ?>">
</head>
<body>

<?= view('admin/components/admin_header', ['profile' => $profile]); ?>

<section class="form-container">

<form action="<?= base_url('admin/tambah-soal/simpan'); ?>" method="post">

   <h3>Tambah Soal</h3>

   <p>Pilih Materi (Video)</p>
   <select name="materi_id" class="box" required>
      <?php foreach ($materi as $row): ?>
         <option value="<?= $row['id']; ?>">
            <?= esc($row['title']); ?>
         </option>
      <?php endforeach; ?>
   </select>

   <p>Pertanyaan</p>
   <textarea name="question" class="box" rows="3" required></textarea>

   <p>Pilihan Jawaban</p>
   <input type="text" name="option_a" placeholder="Pilihan A" class="box" required>
   <input type="text" name="option_b" placeholder="Pilihan B" class="box" required>
   <input type="text" name="option_c" placeholder="Pilihan C" class="box" required>
   <input type="text" name="option_d" placeholder="Pilihan D" class="box" required>

   <p>Jawaban Benar</p>
   <select name="correct" class="box">
      <option value="A">A</option>
      <option value="B">B</option>
      <option value="C">C</option>
      <option value="D">D</option>
   </select>

   <input type="submit" value="Tambah Soal" class="btn">

</form>

</section>

<script src="<?= base_url('js/admin_script.js'); ?>"></script>

</body>
</html>
