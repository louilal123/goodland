
<?php  $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/")+1); ?>


  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h4 class="sitename" style="color: #fff !important; padding-top: 8px ;"><strong>GOOD</strong><i>Land</i></h4>
        <!-- <span>.</span> -->
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="home" class="<?= $page == 'home.php' ? 'active':'' ?>">HOME<br></a></li>
          <li><a href="#">ABOUT US</a></li>
          <li><a href="#">PROJECTS</a></li>
          <li><a href="#">METHODOLOGY</a></li>
          <li><a href="#">STORIES</a></li>
          <li><a href="products" class="<?= $page == 'products.php' ? 'active':'' ?>">PRODUCTS</a></li>
          <li><a href="#">MEMBERS</a></li>
          <li><a href="#">CONTACT</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="index.html#about">Sign Up</a>

    </div>
  </header>