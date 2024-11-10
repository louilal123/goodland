<?php include "classes/user_view.php";?>
<?php include "classes/visitor_logs.php";?>
<?php $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/")+1); ?>
<style>

.header{
  background-color: #262525 !important; 
   color:#f8f8f8 !important;
    border-bottom: 1px solid rgba(38, 37, 37, 0.2) !important; 
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important; 
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
  background: linear-gradient(to top, rgba(38, 37, 37, 1), rgba(22, 22, 22, 0.7)); 
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
  background-color: #0062cc !important;
  color: #f8f8f8; 
}
.custom-btn:hover{
  border: 1px solid #0062cc !important;
  background-color: transparent !important;
  color: #141414 !important;
}
.header .btn-getstarted:hover{
  background-color: #0062cc !important;
  color: #f8f8f8; 
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


</style>
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="" class="logo d-flex align-items-center me-auto">
        <h1 class="sitename"><span class="fw-bold  text-light">GOOD</span><span class="fw-light text-light"><i>Land</i></span></h1>
      </a>

      <nav id="navmenu" class="navmenu mx-auto">
        <ul>
          <li><a href="index"  class=" <?= $page == 'index.php' ? 'active':'' ?>">HOME<br></a></li>
          <li><a href="about" class=" <?= $page == 'about.php' ? 'active':'' ?>">ABOUT US</a></li>
          <li><a href="project" class=" <?= $page == 'project.php' ? 'active':'' ?>">PROJECTS</a></li>
          <li><a href="methodology" class=" <?= $page == 'methodology.php' ? 'active':'' ?>">METHODOLOGY</a></li>
         
        <li><a href="e-sawod-sensor" class=" <?= $page == 'e-sawod-sensor.php' ? 'active':'' ?>" >E-SAWOD</a> </li>
        <li><a href="events" class=" <?= $page == 'events.php' ? 'active':'' ?>">EVENTS</a></li>
          <li><a href="archives" class=" <?= $page == 'archives.php' ? 'active':'' ?>">ARCHIVES</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      
      <div class="d-flex align-items-center">
    
 <a class="btn btn-getstarted "  
 style="font-weight: 500 !important; background-color: linear-gradient(to right, #144D53,#0062cc) !important;opacity: 0.8; " 
 href="contactus"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"  viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="butt" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
 <polyline points="20,6 12,13 2,6"></polyline></svg> CONTACT US</a>
      </div>
    </div>
  </header>
