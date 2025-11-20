<?php

// Pastikan $tutor_id aman
if (!isset($tutor_id)) {
    $tutor_id = $_COOKIE['tutor_id'] ?? '';
}

if(isset($message)){
   foreach($message as $msg){
      echo '
      <div class="message">
         <span>'.$msg.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <section class="flex">

      <a href="dashboard.php" class="logo">Admin.</a>

      <form action="search_page.php" method="post" class="search-form">
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
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `tutors` WHERE id = ?");
            $select_profile->execute([$tutor_id]);
            
            if($select_profile->rowCount() > 0){
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" alt="">
         <h3><?= $fetch_profile['name']; ?></h3>
         <span><?= $fetch_profile['profession']; ?></span>
         <a href="profile.php" class="btn">view profile</a>
         <a href="../components/admin_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
         <?php } else { ?>
         <h3>Please login or register</h3>
         <div class="flex-btn">
            <a href="login.php" class="option-btn">login</a>
            <a href="register.php" class="option-btn">register</a>
         </div>
         <?php } ?>
      </div>

   </section>

</header>

<!-- Side bar -->
<div class="side-bar">

   <div class="close-side-bar">
      <i class="fas fa-times"></i>
   </div>

   <div class="profile">
      <?php
         if($select_profile->rowCount() > 0){
      ?>
      <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" alt="">
      <h3><?= $fetch_profile['name']; ?></h3>
      <span><?= $fetch_profile['profession']; ?></span>
      <a href="profile.php" class="btn">view profile</a>
      <?php } else { ?>
      <h3>Please login or register</h3>
      <div class="flex-btn">
         <a href="login.php" class="option-btn">login</a>
         <a href="register.php" class="option-btn">register</a>
      </div>
      <?php } ?>
   </div>

   <nav class="navbar">
      <a href="dashboard.php"><i class="fas fa-home"></i><span>Dashboard</span></a>

      <!-- Playlist → Mata Pelajaran -->
      <a href="mapel.php"><i class="fa-solid fa-book"></i><span>Kerajaan</span></a>

      <!-- Materi -->
      <a href="materi.php"><i class="fas fa-file-alt"></i><span>Tambah Materi</span></a>

      <a href="komentar.php"><i class="fas fa-comment"></i><span>Komentar</span></a>

      <a href="../components/admin_logout.php" onclick="return confirm('logout?');">
         <i class="fas fa-right-from-bracket"></i><span>Logout</span>
      </a>
   </nav>

</div>

<script src="../js/admin_script.js"></script>
