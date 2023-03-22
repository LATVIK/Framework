<header class="header">
  <div id="main-title">
    LATVIK
  </div>
  <div id="navigation">
    <ul>
      <li><a href="..">Main</a></li>
      <li><a href="my-posts">My posts</a></li>
      <li>
        <form id="search-posts-form" method="GET">
          <label for="search-post-area"></label>
          <input id="search-post-area" placeholder="search" type="text" name="search"
                 value="<?= $_GET['search'] ?? '' ?>">
          <button id="search-posts-btn" type="submit"><img src="../../res/icons/search.svg" alt="search"></button>
        </form>
      </li>
      <li>
        <a href="profile">Profile</a>
      </li>
    </ul>
  </div>

  <!--  TODO: Update after implementing user authorization -->
  <div id="gt-account-title">
      <?php
      if (!$this->user) {
          echo "<a href='/login'>Log in</a>";
      } else {
          echo '</a> <span><a href="/exit" >Log out</a></span>';
      }
                 ?>
  </div>

</header>