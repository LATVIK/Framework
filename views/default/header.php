<header class="header">
  <div id="main-title">
    LATVIK
  </div>
  <div id="navigation">
    <ul>
      <li><a href="..">Main</a></li>
      <li><a href="my-posts">My posts</a></li>
      <li>
        <form id="search-posts-form" method="get">
          <label for="search-post-area"></label><input id="search-post-area" placeholder="search" type="text">
          <button id="search-posts-btn" type="submit"><img src="../../res/icons/search.svg" alt="search"></button>
        </form>
      </li>
    </ul>
  </div>

  <!--  TODO: Update after implementing user authorization -->
  <div id="gt-account-title">
      <?php
      if (!$this->user) {
          echo "<a href='/login'>Log in</a>";
      } else {
          echo '<a href="/profile">Hello, ' . $this->user->getUsername() . '</a>';
      }
      ?>
  </div>

</header>