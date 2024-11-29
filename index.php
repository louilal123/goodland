<?php
 ini_set('display_errors', 1); 
 ini_set('display_startup_errors', 1); 
 error_reporting(E_ALL); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Welcome To Goodland</title>
<?php include "includes/header.php"?>

</head>
<style>
  /* Real-Time Data trrrrry Section */
.real-time-data {
  background: black !important;
  border: 1px solid rgba(0, 0, 0, 0.1);
  border-radius: 10px;
  /* padding-top: 40px;
  margin-top: 80px; */
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  text-align: center;
}

.real-time-data h2 {
  color: var(--accent-color);
  font-weight: 700;
  font-size: 24px;
  /* margin-bottom: 20px; */
}

.sensor-data {
  display: flex;
  justify-content:center;
  gap: 20px;
  flex-wrap: wrap;
}

.sensor {
  flex: 1;
  min-width: 180px;
  background:none;
  padding: 10px;
  border-radius: 8px;
  border: 1px solid rgba(0, 98, 204, 0.3);
}

.sensor h4 {
  font-size: 18px;
  font-weight: 600;
  color: var(--contrast-color);
  margin-bottom: 10px;
}

.sensor p {
  font-size: 14px;
  color: var(--default-color);
  margin: 5px 0;
}

.sensor p strong {
  color: white;
}
.overlap-cards {
  margin-top: -50px; /* Adjust this value based on how much overlap you want */
}

.card {
  border-radius: 10px;
  z-index: 1;
}

.card-title {
  font-weight: bold;
  color: var(--primary-color);
}

</style>
<body class="index-page in">

 <?php include "includes/topnav.php"?>

  <main class="main">

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
        <h1 data-aos="fade-up "> <span class="text-warning"><strong>FINDING</strong></span> <strong>LOCAL SOLUTIONS TO GLOBAL PROBLEMS</strong><span style="font-size: 80px !important; color:#0062cc !important; font-weight: bold !important;">.</span></h1>
        <p data-aos="fade-up" data-aos-delay="100">
       
       Our mission is to facilitate the realization of an empowered, self-sufficient, and resilient community by using art and collaborations to address the social, economic, and environmental issues on Bantayan Island. ​
        
       </p>
        <div class="d-flex flex-column flex-md-row" data-aos="fade-up" data-aos-delay="200">
        <a href="#about" class="btn-get-started btn" style="background: linear-gradient(to right, #144D53,#0062cc) !important;"
         data-aos="fade-in" data-aos-delay="200">EXPLORE<i class="bi bi-arrow-right"></i></a>
              <a href="https://youtu.be/v3KTAD1NKas?si=vMHL--EJXYfbwqbx" 
              class="glightbox btn-watch-video d-flex align-items-center justify-content-center ms-0 ms-md-4 mt-4 mt-md-0 text-light">
              <i class="bi bi-play-circle"></i><span>WATCH VIDEO</span></a>
           </div>
      </div>
      <div class="col-lg-6 order-1 order-lg-2 hero-img d-flex flex-column justify-content-center" data-aos="zoom-out">
      <div class="lightning-strike"></div>
        <img src="assets/img/landingbg.png"  class="img-fluid broken-img " >
      </div>


     

    </div>
  </div>
 


</section>
<div class="section">
<div class="container">
    <div class="row gy-4">
    <div class="container mt-5">
  <div class="row overlap-cards">
    <!-- Card 1 -->
    <div class="col-lg-6 col-md-6 col-sm-12 " data-aos="slide-right">
      <div class="card bg-dark text-light shadow">
        <div class="card-body text-center">
          <h4 class="card-title">E-SAWOD 1</h4>
          <p><strong>Water Level:</strong> <span id="waterlevel1" class="text-danger fw-bold">6 cm</span></p>
          <p><strong>Humidity:</strong> <span id="humidity1" class="text-secondary fw-bold">9 RH</span></p>
          <p><strong>Temperature:</strong> <span id="temperature1" class="text-warning fw-bold">34 °C</span></p>
        </div>
      </div>
    </div>

    <!-- Card 2 -->
    <div class="col-lg-6 col-md-6 col-sm-12" data-aos="slide-left">
      <div class="card bg-dark text-light shadow">
        <div class="card-body text-center">
          <h4 class="card-title">E-SAWOD 2</h4>
          <p><strong>Water Level:</strong> <span id="waterlevel2" class="text-danger fw-bold">6 cm</span></p>
          <p><strong>Humidity:</strong> <span id="humidity2" class="text-secondary fw-bold">9 RH</span></p>
          <p><strong>Temperature:</strong> <span id="temperature2" class="text-warning fw-bold">34 °C</span></p>
        </div>
      </div>
      
    </div>
  </div>
</div>

  </div>
</div>
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
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="card ">
              <img src="images/missionn.jpg"style="height: 375px !important;" class="img-fluid" alt="">
              <h3>Our mission is to facilitate the realization of an empowered, self-sufficient, and resilient community by using art and collaborations to address the social, economic, and environmental issues on Bantayan Island.</h3>
            </div>
          </div>

        </div>

      </div>

    </section>

<!-- End of Cookie Banner -->
  <?php include "includes/footer.php"?>


<!-- Modal frame bottom example-->

</body>

</html>
