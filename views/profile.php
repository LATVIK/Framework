<div id='profile-main-card' class="main-card">
  <div>
    <img alt="photo" src="<?=  PHOTO_ROOT. '/' . $this->user->getIcon() ?>">
  </div>
  <div id="user_info">
    <div>Username: <?= $this->user->getUsername() ?></div>
    <div>Email: <?= $this->user->getEmail() ?></div>
    <br>
    <!--    <a href="">Change data</a>-->
  </div>
</div>