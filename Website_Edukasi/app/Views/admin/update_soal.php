<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Update Soal</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="<?= base_url('css/styleadmin.css'); ?>">
</head>
<body>

<?= view('admin/components/admin_header', ['profile' => $profile]); ?>

<section class="playlist-form">

<h1 class="heading">Update Soal</h1>

<form action="<?= base_url('admin/update-soal/' . $soal['id']); ?>" method="post" class="form">

   <?php if (session()->has('success')): ?>
      <p class="success"><?= session('success'); ?></p>
   <?php endif; ?>

   <?php if (session()->has('error')): ?>
      <p class="error"><?= session('error'); ?></p>
   <?php endif; ?>

   <?php if (session()->has('errors')): ?>
      <?php foreach (session('errors') as $error): ?>
         <p class="error"><?= $error; ?></p>
      <?php endforeach; ?>
   <?php endif; ?>

   <p>Pertanyaan <span>*</span></p>
   <textarea name="question" required class="box" rows="4"><?= old('question', esc($soal['question'])); ?></textarea>

   <p>Video / Konten Terkait <span>*</span></p>
   <select name="content_id" class="box" required>
      <option value="">Pilih Video</option>
      <?php foreach ($videos as $video): ?>
      <option value="<?= $video['id']; ?>" 
         <?= old('content_id', $soal['content_id']) == $video['id'] ? 'selected' : '' ?>>
         <?= esc($video['title']); ?>
      </option>
      <?php endforeach; ?>
   </select>

   <p>Jawaban A <span>*</span></p>
   <input type="text" name="option_a" class="box" required value="<?= old('option_a', esc($soal['option_a'])); ?>">

   <p>Jawaban B <span>*</span></p>
   <input type="text" name="option_b" class="box" required value="<?= old('option_b', esc($soal['option_b'])); ?>">

   <p>Jawaban C <span>*</span></p>
   <input type="text" name="option_c" class="box" required value="<?= old('option_c', esc($soal['option_c'])); ?>">

   <p>Jawaban D <span>*</span></p>
   <input type="text" name="option_d" class="box" required value="<?= old('option_d', esc($soal['option_d'])); ?>">

   <p>Jawaban Benar <span>*</span></p>
   <select name="correct_option" class="box" required>
      <option value="a" <?= old('correct_option', $soal['correct_option']) == 'a' ? 'selected' : ''; ?>>A</option>
      <option value="b" <?= old('correct_option', $soal['correct_option']) == 'b' ? 'selected' : ''; ?>>B</option>
      <option value="c" <?= old('correct_option', $soal['correct_option']) == 'c' ? 'selected' : ''; ?>>C</option>
      <option value="d" <?= old('correct_option', $soal['correct_option']) == 'd' ? 'selected' : ''; ?>>D</option>
   </select>

   <?= csrf_field(); ?>
   
   <input type="submit" name="submit" value="Update Soal" class="btn">

   <a href="<?= base_url('admin/soal/view/' . $soal['id']); ?>" class="option-btn">View Soal</a>

</form>

</section>

<?= view('admin/components/footer'); ?>
<script src="<?= base_url('js/admin_script.js'); ?>"></script>

</body>
</html>