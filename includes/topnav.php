<?php include "classes/user_view.php";?>
<?php include "classes/visitor_logs.php";?>
<?php $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/")+1); ?>
<style>
.header {
  color: white !important;
 
  transition: all 0.3s ease;
  padding: 15px 0;

}

.header.scrolled {
  background-color: rgba(0, 0, 0, 0.95) !important; /* Brand color when scrolled with slight transparency */
  padding: 10px 0;
}

/* Logo styling */
.header .sitename {
  font-family: var(--nav-font);
  color: #0dcaf0 !important; /* Light blue for "GOOD" */
  font-size: 24px;
  letter-spacing: 0.5px;
}

.header .sitename .fw-light {
  color: white !important; /* White for "Land" */
  font-style: italic;
}

/* Navigation menu styling */
.navmenu ul {
  display: flex;
  list-style: none;
  margin: 0;
  padding: 0;
}

.navmenu ul li {
  position: relative;
  margin: 0 15px;
}

.navmenu ul li a {
  color: rgba(255, 255, 255, 0.8) !important;
  font-size: 14px;
  font-weight: 500;
  text-decoration: none;
  transition: all 0.3s ease;
  padding: 10px 0;
  position: relative;
}

.navmenu ul li a:hover, 
.navmenu ul li a.active {
  color: white !important;
}

/* Active item indicator */
.navmenu ul li a.active::after,
.navmenu ul li a:hover::after {
  content: '';
  position: absolute;
  left: 0;
  bottom: 5px;
  width: 100%;
  height: 2px;
  background: linear-gradient(to right, #0dcaf0, #0062cc);
  transform: scaleX(1);
  transition: transform 0.3s ease;
}

/* Contact Us button styling */
.header .btn-getstarted {
  font-weight: 500 !important;
  background: linear-gradient(to right, #144D53, #0062cc) !important;
  color: white !important;
  font-size: 14px;
  padding: 8px 25px;
  border-radius: 4px;
  transition: all 0.3s ease;
  border: none;
  box-shadow: 0 4px 15px rgba(0, 98, 204, 0.3);
}

.header .btn-getstarted:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(0, 98, 204, 0.4);
}

/* Mobile navigation */
.mobile-nav-toggle {
  color: white;
  font-size: 28px;
  cursor: pointer;
  line-height: 0;
  transition: 0.5s;
  margin-left: auto;
  display: none;
}

@media (max-width: 1199px) {
  .mobile-nav-toggle {
    display: block;
  }
  
  .navmenu {
    position: fixed;
    top: 70px;
    right: -100%;
    width: 280px;
    height: 100%;
    background-color: rgba(20, 77, 83, 0.95);
    box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
    transition: 0.4s;
    padding: 20px 0;
    z-index: 9999;
  }
  
  .navmenu.mobile-menu-active {
    right: 0;
  }
  
  .navmenu ul {
    flex-direction: column;
  }
  
  .navmenu ul li {
    margin: 5px 15px;
  }
  
  .navmenu ul li a {
    display: block;
    padding: 10px 0;
  }
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
  background: linear-gradient(to top, rgba(38, 37, 37, 1), rgba(0, 0, 0, 0.2)); 
  z-index: -1; 
}


/* cookie here */
.blur {
    filter: blur(2px); 
    pointer-events: none; 
}

#cb-cookie-banner {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    z-index: 99999; 
    border-radius: 0;
    display: none;
    opacity: 0;
    transform: translateY(100%);
    transition: transform 0.5s ease-out, opacity 0.5s ease-out;
}


#cb-cookie-banner.slide-in {
    opacity: 1;
    transform: translateY(0);
}
.custom-btn{
  background: linear-gradient(to right, #144D53,#0062cc) !important;
  color: #f8f8f8; 
}
.custom-btn:hover{
  border: 1px solid #0062cc !important;
  background-color: #0062cc !important;
  color: #141414 !important;
}

.header .btn-hide{
  font-weight: 500 !important;
  color: white;
  background: transparent !important;
  font-size: 15px;
  opacity: 0.8;
  padding: 8px 25px;
  margin: 0 0 0 30px;
  border-radius: 4px;
  border: 0.8px solid white;
  transition: 0.3s;
}
.header .btn-hide:hover{
  background: linear-gradient(to right, #144D53,#0062cc) !important;
  color: #f8f8f8; 
}

.card {
      border: none;
      border-radius: 0px; /* Smooth rounded corners */
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3); /* Enhanced shadow on hover */
      transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth hover effect */
    }
   
.card-header {
  color: white;
  border-radius: 0px !important;
}
.card-body {
  padding: 20px;
  background-color: #f9f9f9; /* Light background for contrast */
}
</style>
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index" class="logo d-flex align-items-center me-auto">
        <h1 class="text-light fw-bold"><span class="fw-bold">GOOD</span><span class="fw-light"><i>Land</i></span></h1>
      </a>

      <nav id="navmenu" class="navmenu mx-auto">
        <ul>
          <li><a href="index" class="<?= $page == 'index.php' ? 'active':'' ?>"><strong>HOME</strong></a></li>
          <li><a href="about" class="<?= $page == 'about.php' ? 'active':'' ?>"><strong>ABOUT US</strong></a></li>
          <li><a href="project" class="<?= $page == 'project.php' ? 'active':'' ?>"><strong>PROJECTS</strong></a></li>
          <li><a href="methodology" class="<?= $page == 'methodology.php' ? 'active':'' ?>"><strong>METHODOLOGY</strong></a></li>
          <li><a href="e-sawod-sensor" class="<?= $page == 'e-sawod-sensor.php' ? 'active':'' ?>"><strong>E-SAWOD</strong></a></li>
          <li><a href="events" class="<?= $page == 'events.php' ? 'active':'' ?>"><strong>EVENTS</strong></a></li>
          <li><a href="archives" class="<?= $page == 'archives.php' ? 'active':'' ?>"><strong>ARCHIVES</strong></a></li>
        </ul>
      </nav>
      
      <div class="d-flex align-items-center">
        <a class="btn btn-getstarted" href="contactus"><strong>CONTACT US</strong></a>
      </div>
      
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </div>
  </header>

<script>
// Add scroll event listener to add dark background when scrolled
window.addEventListener('scroll', function() {
  const header = document.getElementById('header');
  if (window.scrollY > 10) {
    header.classList.add('scrolled');
  } else {
    header.classList.remove('scrolled');
  }
});

// Mobile menu toggle
document.addEventListener('DOMContentLoaded', function() {
  const mobileNavToggle = document.querySelector('.mobile-nav-toggle');
  const navMenu = document.getElementById('navmenu');
  
  if (mobileNavToggle) {
    mobileNavToggle.addEventListener('click', function() {
      navMenu.classList.toggle('mobile-menu-active');
      mobileNavToggle.classList.toggle('bi-list');
      mobileNavToggle.classList.toggle('bi-x');
    });
  }
});
</script>