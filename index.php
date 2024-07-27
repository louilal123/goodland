
<!DOCTYPE html>
<html lang="en">

<?php include "includes/header.php"; ?>

<style>
  .custom-card{
    border-radius: 0px !important;
  }
</style>

<body class="index-page">

<?php include "includes/topnav.php"; 

include "classes/location.php";?>
<?php include "classes/user_view.php"; ?>
  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background"> 
    <!-- light-background -->

      <img src="uploads/mambacayao.png" alt="" data-aos="fade-in">

      <div class="container">

      <div class="row justify-content-center text-center" data-aos="fade-up" data-aos-delay="100">
          <div class="col-xl-12 col-lg-12">
          
            <h2><span style="font-weight: lighter !important; color: white;">Welcome To </span>Good<i>Land</i></h2>
            <!-- <span>.</span> -->
            <p>FINDING LOCAL SOLUTIONS TO GLOBAL PROBLEMS.</p>
           
          </div>
         <div class="container mt-5">
          <a href="aboutus"class="btn btn-primary btn-outline" style="width: 200px; border-radius: 0px; color: white;">LEARN MORE</a></button>
      
       </div>

      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section class="about section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="row gy-4 align-items-center">
          <div class="col-lg-6 order-2 order-lg-1">
              <img src="assets/img/landingbg.png" class="img-fluid" alt="Photo by John Doe">
              <p style="font-size: 1em; text-align: start; color: #999; margin-top:10px ;">Courtesy: Photo by Martha Atienza</p>
       
          </div>
          <div class="col-lg-6 order-1 order-lg-2 content d-flex flex-column justify-content-center">
              <p style="font-size: 1.5em; font-style: italic; margin-bottom: 20px; color: #555; text-align: center;">
                  Our mission is to facilitate the realization of an empowered, self-sufficient, and resilient community by using art and collaborations to address the social, economic, and environmental issues on Bantayan Island.
              </p>
                </div>
      </div>

      </div>

    </section><!-- /About Section -->


    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Contact Us</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="mb-4" data-aos="fade-up" data-aos-delay="200">
       
        
  <iframe style="border:0; width: 100%; height: 270px;"  src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d15653.151528180906!2d123.74171731128504!3d11.240220319206975!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sPurok%20Kulo%202%2C%20Atop-Atop%20%20Bantayan%206053%2C%20Cebu!5e0!3m2!1sen!2sph!4v1720150598052!5m2!1sen!2sph"  frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div><!-- End Google Maps -->

        <div class="row gy-4 align-items-center">

          <div class="col-lg-4 ">
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
              <div>
                <h3>Message Us</h3>
              
              </div>
            </div><!-- End Info Item -->

          </div>

          <div class="col-lg-8">
            <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">Send Message</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>
<?php include "includes/footer.php"; ?>
</body>

</html>