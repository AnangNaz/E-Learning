<?php
// Cek apakah profile ada
$logged_in = isset($profile) && !empty($profile);
?>

<header class="header">

   <section class="flex">

      <a href="<?= base_url('admin/dashboard'); ?>" class="logo">Admin.</a>

      <form action="<?= base_url('admin/search'); ?>" method="post" class="search-form">
         <input type="text" name="search" placeholder="search here..." required maxlength="100">
         <button type="submit" class="fas fa-search" name="search_btn"></button>
      </form>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="search-btn" class="fas fa-search"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="toggle-btn" class="fas fa-sun"></div>
      </div>

      <div class="profile">

         <?php if ($logged_in): ?>

            <img src="<?= base_url('uploaded_files/' . ($profile['image'] ?? 'default.png')); ?>" alt="profile">

            <h3><?= esc($profile['name'] ?? ''); ?></h3>
            <span><?= esc($profile['profession'] ?? ''); ?></span>

            <a href="<?= base_url('admin/profile'); ?>" class="btn">view profile</a>
            <a href="<?= base_url('logout'); ?>" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>

         <?php else: ?>

            <h3>Please login or register</h3>
            <div class="flex-btn">
               <a href="<?= base_url('login'); ?>" class="option-btn">login</a>
               <a href="<?= base_url('register'); ?>" class="option-btn">register</a>
            </div>

         <?php endif; ?>

      </div>

   </section>

</header>



<!-- Side bar -->
<div class="side-bar">

   <div class="close-side-bar">
      <i class="fas fa-times"></i>
   </div>

   <div class="profile">

      <?php if ($logged_in): ?>

         <img src="<?= base_url('uploaded_files/' . ($profile['image'] ?? 'default.png')); ?>" alt="profile">

         <h3><?= esc($profile['name'] ?? ''); ?></h3>
         <span><?= esc($profile['profession'] ?? ''); ?></span>

         <a href="<?= base_url('admin/profile'); ?>" class="btn">view profile</a>

      <?php else: ?>

         <h3>Please login or register</h3>
         <div class="flex-btn">
            <a href="<?= base_url('login'); ?>" class="option-btn">login</a>
            <a href="<?= base_url('register'); ?>" class="option-btn">register</a>
         </div>

      <?php endif; ?>

   </div>

   <nav class="navbar">

      <a href="<?= base_url('admin/dashboard'); ?>">
         <i class="fas fa-home"></i><span>Dashboard</span>
      </a>

      <a href="<?= base_url('admin/mapel'); ?>">
         <i class="fa-solid fa-book"></i><span>Kerajaan</span>
      </a>

      <a href="<?= base_url('admin/materi'); ?>">
         <i class="fas fa-file-alt"></i><span>Tambah Materi</span>
      </a>

      <a href="<?= base_url('admin/komentar'); ?>">
         <i class="fas fa-comment"></i><span>Komentar</span>
      </a>

      <a href="<?= base_url('logout'); ?>" onclick="return confirm('logout?');">
         <i class="fas fa-right-from-bracket"></i><span>Logout</span>
      </a>

   </nav>

</div>

<script src="<?= base_url('js/admin_script.js'); ?>"></script>
