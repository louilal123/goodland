<!DOCTYPE html>
<html lang="en">
<head>
<?php include "includes/header.php"?>
</head>

<body class="index-page">

 <?php include "includes/topnav.php"?>

  <main class="main">

   <!-- Hero Section -->
<section id="hero" class="hero section">
  <div class="background-video-container">
    <video autoplay muted loop id="hero-background-video">
      <source src="https://cdn.arcgis.com/sharing/rest/content/items/8af5121e605a4ae684a1862a51a68b26/resources/6Kc_MpmZPtZWn8QiKobhi.mp4" type="video/mp4">
      Your browser does not support the video tag.
    </video>
  </div>
  
  <div class="container">
    <div class="row gy-4">
      <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center ">
        <h1 data-aos="fade-up "> FINDING LOCAL SOLUTIONS TO GLOBAL PROBLEMS<span style="font-size: 80px !important; color:#28747c !important; font-weight: bold !important;">.</span></h1>
        <p data-aos="fade-up" data-aos-delay="100">
        Our mission is to facilitate the realization of an empowered, self-sufficient, and resilient community by using art and collaborations to address the social, economic, and environmental issues on Bantayan Island. ​
</p>
        <div class="d-flex flex-column flex-md-row" data-aos="fade-up" data-aos-delay="200">
          <a href="#about" class="btn-get-started me-4">Explore <i class="bi bi-arrow-right"></i></a>
          <a href="#about" class="btn-get-started2 me-4">Watch Video <i class="bi bi-play-circle"></i></a>
        </div>
      </div>
      <div class="col-lg-6 order-1 order-lg-2 hero-img d-flex flex-column justify-content-center" data-aos="zoom-out">
        <img src="assets/img/landingbg.png"  class="img-fluid" >
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
            <div class="card bg-dark ">
              <img src="images/vision.jpg" style="height: 375px !important;" class="img-fluid" alt="">
              <h3>Our vision is an empowered community of Bantayan islanders enjoying the quality of life in an ecologically balanced environment through their shared dreams.</h3>
               </div>
          </div><!-- End Card Item -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="card bg-dark">
              <img src="images/missionn.jpg"style="height: 375px !important;" class="img-fluid" alt="">
              <h3>Our mission is to facilitate the realization of an empowered, self-sufficient, and resilient community by using art and collaborations to address the social, economic, and environmental issues on Bantayan Island.</h3>
            </div>
          </div><!-- End Card Item -->

        </div>

      </div>

    </section><!-- /Values Section -->


    <!-- Contact Section -->
    <section id="contact" class="contact section">

      
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Contact Us</p>
      </div>

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-6">

            <div class="row gy-4">
              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="200">
                  <i class="bi bi-geo-alt"></i>
                  <h3>Purok Brgy Mambacayao</h3>
                  <p>A108 Adam Street</p>
                  <p>Bantayan Island Philipppines</p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="300">
                  <i class="bi bi-telephone"></i>
                  <h3>Call Us</h3>
                  <p>+1 5589 55488 55</p>
                  <p>+1 6678 254445 41</p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="400">
                  <i class="bi bi-envelope"></i>
                  <h3>Email Us</h3>
                  <p>info@goodlandv2@gmail.com</p>
                  <p>contact@example.com</p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="500">
                  <i class="bi bi-clock"></i>
                  <h3>Open Hours</h3>
                  <p>Monday - Friday</p>
                  <p>9:00AM - 05:00PM</p>
                </div>
              </div><!-- End Info Item -->

            </div>

          </div>

          <div class="col-lg-6">
            <form action="classes/contact.php" method="post"  data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                </div>

                <div class="col-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                </div>

                <div class="col-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                </div>

                <div class="col-12 text-center">
                  <button type="submit">Send Message</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->

  <!-- </main> -->

  <?php include "includes/footer.php"?>

</body>

</html>