<?php
  $creator = $post->getAuthor();
?>
<div class="main-card post">
  <div>
    <div class="post-creator"><?= $creator->getUsername() ?></div>
    <img alt="photo" src="<?= PHOTO_ROOT. '/' .$creator->getIcon() ?>">
  </div>
  <div>
    <h3><?= $post->getTitle()?></h3>
    <h4><?= $post->getCreatedDt();?></h4>
    <br>
      <?= $post->getText(); ?>
  </div>
</div>