<div class="main-card post">
  <div>
    <div class="post-creator"><?= $post['creator_name'] ?></div>
    <img alt="photo" src="<?= $post['creator_photo'] ?>">
  </div>
  <div>
    <h3><?= $post['title'] ?></h3>
    <h4><?= $post['creation_date'] ?></h4>
    <br>
      <?= $post['text'] ?>
  </div>
</div>