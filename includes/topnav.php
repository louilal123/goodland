<?php $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/")+1); ?>
<style>
  .header{
    background: #161616 !important;
  }
  .background-video-container {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
  z-index: -2; /* Video behind everything */
}

#hero-background-video {
  position: absolute;
  top: 50%;
  left: 50%;
  min-width: 100%;
  min-height: 100%;
  width: auto;
  height: auto;
  transform: translate(-50%, -50%);
  z-index: -2; /* Keep the video in the background */
  object-fit: cover;
}

/* Darker gradient overlay from bottom to top */
.hero::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(to top, rgba(22, 22, 22, 1), rgba(22, 22, 22, 0.9)); 
  z-index: -1; 
}
</style>
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt="">#4154f1; -->
        <h1 class="sitename"><span class="fw-bold  text-light">GOOD</span><span class="fw-light text-light"><i>Land</i></span></h1>
      </a>

      <nav id="navmenu" class="navmenu mx-auto">
        <ul>
          <li><a href="index.php"  class=" <?= $page == 'index.php' ? 'active':'' ?>">Home<br></a></li>
          <li><a href="#">About Us</a></li>
          <li><a href="#">Projects</a></li>
          <li><a href="#">Methodology</a></li>
          <li><a href="stories.php" class=" <?= $page == 'stories.php' ? 'active':'' ?>" >Stories</a></li>
        <li class="dropdown"><a href="#"><span>Story Maps </span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Mambacayao Dako</a></li>
            
              <li><a href="#">Bihiya</a></li>
              <li><a href="#">Purok #37</a></li>
              <li><a href="#">Dropdown 4</a></li>
            </ul>
          </li>
          <li><a href="archives.php" class=" <?= $page == 'archives.php' ? 'active':'' ?>">Archives</a></li>
          <!-- -->
          
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      
      <div class="d-flex align-items-center buttonss">
        <a class="text-light lognin-btn fw-bold" href="c-login.php">Login</a>
        <a class="btn-getstarted flex-md-shrink-0 fw-bold" href="c-signup.php">Get Started</a>
      </div>
    </div>
  </header>