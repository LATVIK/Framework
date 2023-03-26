<?php
/**
 * @var models\Post $post
 */
$creator = $post->getAuthor();
?>
<div class="main-card post" id="post-<?= $post->getId() ?>">
  <div>
    <div class="post-creator"><?= $creator->getUsername() ?></div>
    <img id="creator-photo" alt="photo" src="<?= PHOTO_ROOT . '/' . $creator->getIcon() ?>">
  </div>
  <div>
    <h3><?= $post->getTitle() ?></h3>
      <?php
      if ($this->user->getId() == $creator->getID()) : ?>
        <button class="delete">
          <img src="../res/icons/delete.svg" onclick="deletePost(<?= $post->getId() ?>)" alt="x">
        </button>
      <?php endif; ?>
    <h4><?= $post->getCreatedDt(); ?></h4>


    <br>
      <?= $post->getText(); ?>
  </div>
</div>