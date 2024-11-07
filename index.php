<!DOCTYPE html>
<html lang="en">
<head>
<?php include "includes/header.php"?>
<title>Welcome to Goodland</title>
</head>

<body class="index-page">

 <?php include "includes/topnav.php"?>

  <main class="main">

   <!-- Hero Section -->
<section id="hero" class="hero section">
  <div class="background-video-container">
    <video autoplay muted loop id="hero-background-video">
      <source src="https://cdn.arcgis.com/sharing/rest/content/items/6c20302d52284f858afbb2ace066abb4/resources/2Dc0FAcVaYwjGSXsz8kpz.mp4" type="video/mp4">
      Your browser does not support the video tag.
    </video>
  </div>
  
  <div class="container">
    <div class="row gy-4">
      <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center ">
        <h1 data-aos="fade-up "> <span class="text-warning">FINDING</span> LOCAL SOLUTIONS TO GLOBAL PROBLEMS<span style="font-size: 80px !important; color:#0062cc !important; font-weight: bold !important;">.</span></h1>
        <p data-aos="fade-up" data-aos-delay="100">
        Our mission is to facilitate the realization of an empowered, self-sufficient, and resilient community by using art and collaborations to address the social, economic, and environmental issues on Bantayan Island. ​
</p>
        <div class="d-flex flex-column flex-md-row" data-aos="fade-up" data-aos-delay="200">
        <a href="#about" class="btn-get-started" style="background: linear-gradient(to right, #144D53,#0062cc) !important;"
         data-aos="fade-in" data-aos-delay="200">EXPLORE <i class="bi bi-arrow-right"></i></a>
              <a href="https://youtu.be/v3KTAD1NKas?si=vMHL--EJXYfbwqbx" 
              class="glightbox btn-watch-video d-flex align-items-center justify-content-center ms-0 ms-md-4 mt-4 mt-md-0 text-light">
              <i class="bi bi-play-circle"></i><span>WATCH VIDEO</span></a>
           </div>
      </div>
      <div class="col-lg-6 order-1 order-lg-2 hero-img d-flex flex-column justify-content-center" data-aos="zoom-out">
      <div class="lightning-strike"></div>
        <img src="assets/img/landingbg.png"  class="img-fluid broken-img" >
      </div>
    </div>
  </div>
</section>
<!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container" data-aos="fade-up">
        <div class="row gx-0">

          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
              <h3>Who We Are</h3>
              <h2>We are a Non-Government(NGO) asssociation, based on Bantayan Island, Cebu who aims to help the community through community based projects and programs.</h2>
              <p>
                Through our community based projects, we invesion to contribute to the community and environmental preservation, and also youth education.
              </p>
              <div class="text-center text-lg-start">
                <a href="about" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                  <span>Read More</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
            <img src="assets/img/backgroun.jpg" class="img-fluid" alt="">
          </div>

        </div>
      </div>

    </section><!-- /About Section -->

    <!-- Values Section -->
    <section id="values" class="values section">

    <div class="container section-title" data-aos="fade-up">
        <h2>Mission and Vision</h2>
        <p>Our Mission and Vision</p>
      </div>

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-6 " data-aos="fade-up" data-aos-delay="100">
            <div class="card  ">
              <img src="images/vision.jpg" style="height: 375px !important;" class="img-fluid" alt="">
              <h3>Our vision is an empowered community of Bantayan islanders enjoying the quality of life in an ecologically balanced environment through their shared dreams.</h3>
               </div>
          </div><!-- End Card Item -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="card ">
              <img src="images/missionn.jpg"style="height: 375px !important;" class="img-fluid" alt="">
              <h3>Our mission is to facilitate the realization of an empowered, self-sufficient, and resilient community by using art and collaborations to address the social, economic, and environmental issues on Bantayan Island.</h3>
            </div>
          </div><!-- End Card Item -->

        </div>

      </div>

    </section>

<!-- End of Cookie Banner -->
  <?php include "includes/footer.php"?>


<!-- Modal frame bottom example-->

</body>

</html>