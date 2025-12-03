<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="<?= base_url('css/admin_style.css'); ?>">

</head>
<body style="padding-left: 0;">

<?php if (session()->has('error')): ?>
   <div class="message form">
      <span><?= session('error'); ?></span>
      <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
   </div>
<?php endif; ?>

<?php if (session()->has('success')): ?>
   <div class="message form success">
      <span><?= session('success'); ?></span>
      <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
   </div>
<?php endif; ?>

<?php if (session()->has('errors')): ?>
   <?php foreach (session('errors') as $error): ?>
   <div class="message form">
      <span><?= $error; ?></span>
      <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
   </div>
   <?php endforeach; ?>
<?php endif; ?>

<!-- register section starts  -->

<section class="form-container">

   <form action="<?= base_url('login/process'); ?>" method="post" enctype="multipart/form-data" class="login">
      <h3>Welcome Back!</h3>
      <p>Your Email <span>*</span></p>
      <input type="email" name="email" placeholder="Enter your email" maxlength="50" required class="box" 
             value="<?= old('email'); ?>">
      <p>Your Password <span>*</span></p>
      <input type="password" name="pass" placeholder="Enter your password" maxlength="20" required class="box">
      
      <p class="link">Don't have an account? <a href="<?= base_url('register'); ?>">Register New</a></p>
      
      <?= csrf_field(); ?>
      <input type="submit" name="submit" value="Login Now" class="btn">
   </form>

</section>

<!-- registe section ends -->

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
} else {
   disableDarkMode();
}
</script>
   
</body>
</html>