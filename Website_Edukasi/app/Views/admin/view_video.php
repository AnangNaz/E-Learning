<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>View Video</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="<?= base_url('css/styleadmin.css'); ?>">

</head>
<body>

<?= view('admin/components/admin_header', ['profile' => $profile]); ?>

<section class="view-content">

   <?php if ($video): ?>
      <?php
      $video_id = $video['id'];
      ?>
   <div class="container">
      <video src="<?= base_url('uploaded_files/' . $video['video']); ?>" 
             autoplay controls 
             poster="<?= base_url('uploaded_files/' . $video['thumb']); ?>" 
             class="video"></video>
      <div class="date">
         <i class="fas fa-calendar"></i>
         <span><?= $video['date'] ?? date('Y-m-d'); ?></span>
      </div>
      <h3 class="title"><?= esc($video['title']); ?></h3>
      <div class="flex">
         <div><i class="fas fa-heart"></i><span><?= $total_likes; ?></span></div>
         <div><i class="fas fa-comment"></i><span><?= $total_comments; ?></span></div>
      </div>
      <div class="description"><?= esc($video['description']); ?></div>
      <form action="<?= base_url('admin/video/delete'); ?>" method="post">
         <?= csrf_field(); ?>
         <div class="flex-btn">
            <input type="hidden" name="video_id" value="<?= $video_id; ?>">
            <a href="<?= base_url('admin/video/update/' . $video_id); ?>" class="option-btn">Update</a>
            <input type="submit" value="Delete" class="delete-btn" 
                   onclick="return confirm('Delete this video?');" name="delete_video">
         </div>
      </form>
   </div>
   <?php else: ?>
      <p class="empty">No contents added yet! 
         <a href="<?= base_url('admin/video/add'); ?>" class="btn" style="margin-top: 1.5rem;">Add Video</a>
      </p>
   <?php endif; ?>

</section>

<section class="comments">

   <h1 class="heading">User Comments</h1>

   <div class="show-comments">
      <?php if (!empty($comments)): ?>
         <?php foreach ($comments as $comment): ?>
         <div class="box">
            <div class="user">
               <img src="<?= base_url('uploaded_files/' . ($comment['image'] ?? 'default.jpg')); ?>" alt="">
               <div>
                  <h3><?= esc($comment['name'] ?? 'Unknown'); ?></h3>
                  <span><?= $comment['date'] ?? date('Y-m-d'); ?></span>
               </div>
            </div>
            <p class="text"><?= esc($comment['comment']); ?></p>
            <form action="<?= base_url('admin/video/delete-comment'); ?>" method="post" class="flex-btn">
               <?= csrf_field(); ?>
               <input type="hidden" name="comment_id" value="<?= $comment['id']; ?>">
               <button type="submit" name="delete_comment" class="inline-delete-btn" 
                       onclick="return confirm('Delete this comment?');">Delete Comment</button>
            </form>
         </div>
         <?php endforeach; ?>
      <?php else: ?>
         <p class="empty">No comments added yet!</p>
      <?php endif; ?>
   </div>

</section>

<?= view('admin/components/footer'); ?>

<script src="<?= base_url('js/admin_script.js'); ?>"></script>

</body>
</html>