<?php
// Load helper untuk base_url
helper('url');
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?= esc($title) ?></title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="<?= base_url('css/styleadmin.css') ?>">

</head>
<body>

<?= view('admin/components/admin_header', ['profile' => $profile]); ?>

<!-- update section starts  -->
<section class="form-container" style="min-height: calc(100vh - 19rem);">

   <?php if (session()->has('messages')): ?>
      <?php foreach (session('messages') as $message): ?>
         <div class="message form">
            <span><?= esc($message) ?></span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
      <?php endforeach; ?>
   <?php endif; ?>

   <?php if (session()->has('info')): ?>
      <div class="message form">
         <span><?= esc(session('info')) ?></span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
   <?php endif; ?>

   <form class="register" action="<?= base_url('admin/update/process') ?>" method="post" enctype="multipart/form-data">
      <h3>update profile</h3>
      <div class="flex">
         <div class="col">
            <p>your name</p>
            <input type="text" name="name" placeholder="<?= esc($profile['name']) ?>" maxlength="50" class="box" value="<?= old('name', $profile['name']) ?>">
            
            <p>your profession</p>
            <select name="profession" class="box">
               <option value="" selected><?= esc($profile['profession']) ?></option>
               <option value="developer">developer</option>>
               <option value="teacher">teacher</option>
            </select>
            
            <p>your email</p>
            <input type="email" name="email" placeholder="<?= esc($profile['email']) ?>" maxlength="20" class="box" value="<?= old('email', $profile['email']) ?>">
         </div>
         <div class="col">
            <p>old password :</p>
            <input type="password" name="old_pass" placeholder="enter your old password" maxlength="20" class="box">
            
            <p>new password :</p>
            <input type="password" name="new_pass" placeholder="enter your new password" maxlength="20" class="box">
            
            <p>confirm password :</p>
            <input type="password" name="cpass" placeholder="confirm your new password" maxlength="20" class="box">
         </div>
      </div>
      <p>update pic :</p>
      <input type="file" name="image" accept="image/*" class="box">
      <input type="submit" value="update now" class="btn">
   </form>

</section>
<!-- update section ends -->

<?= view('admin/components/footer'); ?>

<script src="<?= base_url('js/admin_script.js') ?>"></script>
   
</body>
</html>