<?php include "classes/user_view.php";?>
<?php $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/")+1); ?>
<style>
/* Fonts */
:root {
  --default-font: "Montserrat",  system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
  --heading-font: "Nunito",  sans-serif;
  --nav-font: "Poppins",  sans-serif;
}

/* Global Colors - The following color variables are used throughout the website. Updating them here will change the color scheme of the entire website */
:root { 
  --background-color: #161616; /* Background color for the entire website, including individual sections */
  --default-color: #f3f3f3; /* Default color used for the majority of the text content across the entire website */
  --heading-color: #f3f3f3; /* Color for headings, subheadings and title throughout the website */
  --accent-color: #28747c !important; /* Accent color that represents your brand on the website. It's used for buttons, links, and other elements that need to stand out */
  --surface-color: #ffffff; /* The surface color is used as a background of boxed elements within sections, such as cards, icon boxes, or other elements that require a visual separation from the global background. */
  --contrast-color: #ffffff; /* Contrast color for text, ensuring readability against backgrounds of accent, heading, or default colors. */
}


/* Nav Menu Colors - The following color variables are used specifically for the navigation menu. They are separate from the global colors to allow for more customization options */
:root {
  --nav-color: #f3f3f3;  /* The default color of the main navmenu links */
  --nav-hover-color: #28747c; /* Applied to main navmenu links when they are hovered over or active */
  --nav-mobile-background-color: #161616; /* Used as the background color for mobile navigation menu */
  --nav-dropdown-background-color: #161616; /* Used as the background color for dropdown items that appear when hovering over primary navigation items */
  --nav-dropdown-color: #f3f3f3; /* Used for navigation links of the dropdown items in the navigation menu. */
  --nav-dropdown-hover-color: #28747c; /* Similar to --nav-hover-color, this color is applied to dropdown navigation links when they are hovered over. */
}

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
  background: linear-gradient(to top, rgba(22, 22, 22, 1), rgba(22, 22, 22, 0.8)); 
  z-index: -1; 
}

  .heading{
    position: relative;
    z-index: 1;
  }
  
  /* Add the gradient overlay */
  .heading::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to top, rgba(22, 22, 22, 1), rgba(22, 22, 22, 0.8));
    z-index: -1; /* Place the gradient below the content but above the background image */
  }

  /* .custom-btn:hover {
    border-color: ;
        background-color: var(--accent-color) !important;
        color: var(--contrast-color) !important;
    } */
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
          <li><a href="index"  class=" <?= $page == 'index.php' ? 'active':'' ?>">Home<br></a></li>
          <li><a href="about" class=" <?= $page == 'about.php' ? 'active':'' ?>">About Us</a></li>
          <li><a href="projects" class=" <?= $page == 'projects.php' ? 'active':'' ?>">Projects</a></li>
          <li><a href="methodology" class=" <?= $page == 'methodology.php' ? 'active':'' ?>">Methodology</a></li>
          <!-- <li><a href="stories" class=" <?//= $page == 'stories.php' ? 'active':'' ?>" >Stories</a></li> -->
        <li class="dropdown"><a href="#"><span>Story Maps </span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Mambacayao Dako</a></li>
            
              <li><a href="#">Bihiya</a></li>
              <li><a href="#">Purok #37</a></li>
              <li><a href="#">Dropdown 4</a></li>
            </ul>
          </li>
          <li><a href="archive" class=" <?= $page == 'archive.php' ? 'active':'' ?>">Archives</a></li>
          <!-- -->
          
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      
      <div class="d-flex align-items-center buttonss">
        <a class="text-light lognin-btn fw-bold" href="admin/">Login</a>
        <a class="btn-getstarted flex-md-shrink-0 fw-bold" href="admin/">Get Started</a>
      </div>
    </div>
  </header>