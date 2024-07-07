
<?php  $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/")+1); ?>


  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-lg-0">
        <h4 class="sitename" style="color: #fff !important; padding-top: 8px ;"><strong>GOOD</strong><i>Land</i></h4>

      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index" class="<?= $page == 'index.php' ? 'active':'' ?>">HOME<br></a></li>
          <li><a href="#" class="<?= $page == 'about.php' ? 'active':'' ?>">ABOUT US</a></li>
          <li><a href="projects.php" class="<?= $page == 'projects.php' ? 'active':'' ?>">PROJECTS</a></li>
          <li><a href="#" class="<?= $page == 'methodology.php' ? 'active':'' ?>">METHODOLOGY</a></li>
          <li><a href="#" class="<?= $page == 'stories.php' ? 'active':'' ?>">STORIES</a></li>
          <li><a href="library" class="<?= $page == 'library.php' ? 'active':'' ?>">LIBRARY</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <!-- Get Started Button -->
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#authModal">
        <a href="get-started" style="color: white;">Get Started</a>
      </button>

      </div>
  </header>

