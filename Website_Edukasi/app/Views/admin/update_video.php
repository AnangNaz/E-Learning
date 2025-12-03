<!DOCTYPE html>
<html lang="id">
<head>
   <meta charset="UTF-8">
   <title>Update Video</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="<?= base_url('css/styleadmin.css'); ?>">
</head>
<body>

<?= view('admin/components/admin_header', ['profile' => $profile]); ?>

<section class="video-form">

   <h1 class="heading">Update Content</h1>

   <?php if (session()->getFlashdata('success')): ?>
      <p class="success"><?= session()->getFlashdata('success'); ?></p>
   <?php endif; ?>

   <?php if (session()->getFlashdata('error')): ?>
      <p class="error"><?= session()->getFlashdata('error'); ?></p>
   <?php endif; ?>

   <form action="<?= base_url('admin/update-video/update/' . $video['id']); ?>" 
         method="post" enctype="multipart/form-data">

      <input type="hidden" name="old_thumb" value="<?= $video['thumb']; ?>">
      <input type="hidden" name="old_video" value="<?= $video['video']; ?>">

      <p>Update Status <span>*</span></p>
      <select name="status" class="box" required>
         <option selected><?= esc($video['status']); ?></option>
         <option value="active">active</option>
         <option value="deactive">deactive</option>
      </select>

      <p>Update Title <span>*</span></p>
      <input type="text" name="title" maxlength="100" required 
             class="box" value="<?= esc($video['title']); ?>">

      <p>Update Description <span>*</span></p>
      <textarea name="description" class="box" required maxlength="1000" cols="30" rows="10">
<?= esc($video['description']); ?>
      </textarea>

      <p>Update Mapel</p>
      <select name="playlist" class="box">
         <option value="<?= $video['playlist_id']; ?>" selected>-- pilih mapel --</option>

         <?php foreach ($mapel as $mp): ?>
            <option value="<?= $mp['id']; ?>">
               <?= esc($mp['nama_kerajaan']); ?>
            </option>
         <?php endforeach; ?>
      </select>

      <!-- Thumbnail -->
      <img src="<?= base_url('uploaded_files/' . $video['thumb']); ?>" 
           alt="" style="max-width:200px">

      <p>Update Thumbnail</p>
      <input type="file" name="thumb" accept="image/*" class="box">

      <!-- Video -->
      <video src="<?= base_url('uploaded_files/' . $video['video']); ?>" 
             controls style="max-width:300px"></video>

      <p>Update Video</p>
      <input type="file" name="video" accept="video/*" class="box">

      <input type="submit" value="Update Content" class="btn">

   </form>

</section>

<?= view('admin/components/footer'); ?>

<script src="<?= base_url('js/admin_script.js'); ?>"></script>

</body>
</html>
