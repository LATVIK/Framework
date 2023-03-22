<div class="column center">
    <?php
    if (!empty($error)) :?>
      <div class="main-card error new-user-card">
          <?= $error; ?>
      </div>
    <?php endif; ?>

    <?php
    if (!empty($success)) :?>
      <div class="main-card success new-user-card">
          <?= $success; ?>
      </div>
    <?php endif; ?>
  <div class="main-card">
    <form id="new-user-form" class="card-form new-user-card" action="/sign-up" method="post"
          enctype="multipart/form-data">
      <label class="center-text">New account</label>

      <div>
        <label for="new-username">Username</label>
        <input id="new-username" autofocus type="text" name="username" value="<?= $_POST['username'] ?? '' ?>">
      </div>

      <div>
        <label for="new-email">Email </label>
        <input id="new-email" type="email" name="email" value="<?= $_POST['email'] ?? '' ?>">
      </div>

      <div>
        <label for="new-password">Password </label>
        <input id="new-password" type="password" name="password" autocomplete="new-password"
               value="<?= $_POST['password'] ?? '' ?>">
      </div>

      <div>
        <label for="clone-password">Repeat password </label>
        <input id="clone-password" type="password" name="repeat_password" autocomplete="new-password"
               value="<?= $_POST['repeat_password'] ?? '' ?>">
      </div>

      <div>
        <label for="file">Icon</label>
        <input id="file" type="file" accept="image/*" name="icon" value="<?= $_POST['icon'] ?? '' ?>">
      </div>

      <button class="submit-button" type="submit">Create</button>
    </form>
  </div>
</div>
