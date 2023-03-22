<div class="column center">
    <?php
    if (!empty($error)) :?>
      <div class="main-card error new-user-card">
          <?= $error; ?>
      </div>
    <?php endif; ?>

  <div class="main-card">
    <form id="login-input" class="card-form" method="post">
      <label class="center-text">Login</label>

      <div>
        <label for="email-login">Email</label>
        <input id="email-login" autofocus type="email" name="email">
      </div>

      <div>
        <label for="password-login">Password</label>
        <input id="password-login" type="password" name="password">
      </div>

      <button class="submit-button" type="submit">Submit</button>
    </form>

  </div>
  <div id="gt-registration" class="main-card">
    New user?&nbsp&nbsp
    <a href="/sign-up"> Create account!)</a>

  </div>
</div>