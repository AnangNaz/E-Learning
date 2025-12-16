<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register Tutor</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="<?= base_url('css/styleadmin.css'); ?>">

</head>
<body style="padding-left: 0;">

<?php if (session()->has('success')): ?>
   <div class="message form">
      <span><?= session('success') ?></span>
      <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
   </div>
<?php endif; ?>

<?php if (session()->has('error')): ?>
   <div class="message form">
      <span><?= session('error') ?></span>
      <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
   </div>
<?php endif; ?>

<?php if (session()->has('errors')): ?>
   <?php foreach (session('errors') as $error): ?>
      <div class="message form">
         <span><?= $error ?></span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
   <?php endforeach; ?>
<?php endif; ?>

<!-- register section starts  -->
<section class="form-container">
   <form class="register" action="<?= base_url('register/process') ?>" method="post" enctype="multipart/form-data">
      <h3>register new</h3>
      <div class="flex">
         <div class="col">
            <p>your name <span>*</span></p>
            <input type="text" name="name" placeholder="enter your name" maxlength="50" required class="box" value="<?= old('name') ?>">
            
            <p>your profession <span>*</span></p>
            <select name="profession" class="box" required>
               <option value="" disabled selected>-- select your profession</option>
               <option value="developer" <?= old('profession') == 'developer' ? 'selected' : '' ?>>developer</option>
               <option value="teacher" <?= old('profession') == 'teacher' ? 'selected' : '' ?>>teacher</option>
            </select>
            
            <p>your email <span>*</span></p>
            <input type="email" name="email" placeholder="enter your email" maxlength="20" required class="box" value="<?= old('email') ?>">
         </div>
         <div class="col">
            <p>your password <span>*</span></p>
            <input type="password" name="pass" placeholder="enter your password" maxlength="20" required class="box">
            
            <p>confirm password <span>*</span></p>
            <input type="password" name="cpass" placeholder="confirm your password" maxlength="20" required class="box">
            
            <p>select pic <span>*</span></p>
            <input type="file" name="image" accept="image/*" required class="box">
         </div>
      </div>
      <p class="link">already have an account? <a href="<?= base_url('login') ?>">login now</a></p>
      <input type="submit" value="register now" class="btn">
   </form>
</section>
<!-- register section ends -->

<script>
let darkMode = localStorage.getItem('dark-mode');
let body = document.body;

const enableDarkMode = () => {
   body.classList.add('dark');
   localStorage.setItem('dark-mode', 'enabled');
}

const disableDarkMode = () => {
   body.classList.remove('dark');
   localStorage.setItem('dark-mode', 'disabled');
}

if(darkMode === 'enabled'){
   enableDarkMode();
}else{
   disableDarkMode();
}
</script>
   
</body>
</html>