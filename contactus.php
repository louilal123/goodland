
<?php 
session_start();
require_once "classes/config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php include "includes/header.php"; ?>
<title>Contact Us</title>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert -->
</head>
<style>
  .custom-btn{
    border-radius: 0px !important;
  }
</style>
<body class="blog-page">

<?php include "includes/topnav.php";?>
  <main class="main ">

  
    <!-- Page Title -->
    <div class="page-title">
      <div class="heading "style="background-size: cover; background-position: center;background: linear-gradient(to top, rgba(38, 37, 37, 0.1), rgba(22, 22, 22, 0.1));z-index: -1;">
        <div class="container ">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <br><br>
              <h1 class="text-dark">Contact Us</h1>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Page Title -->

    <div class="container">
      <div class="row">


      
        <div class="col-lg-12">


    <!-- Contact Section -->
    <section id="contact" class="contact section">


      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
        <div class="col-lg-6">

<div class="row gy-4">
  <div class="col-md-6">
      <div class="info-item" data-aos="fade" data-aos-delay="200">
          <i class="bi bi-geo-alt"></i>
          <h3>Address</h3>
          <p><?php echo htmlspecialchars($settings['address'] ?? 'Not Available'); ?></p>
          
      </div>
  </div><!-- End Info Item -->

  <!-- Facebook and Contact Section -->
  <div class="col-md-6">
      <div class="info-item" data-aos="fade" data-aos-delay="300">
          <i class="bi bi-facebook"></i>
          <h3>Social Media</h3>
          <p><?php echo htmlspecialchars($settings['facebook_url'] ?? '@notavailable'); ?></p>
          <p><?php echo htmlspecialchars($settings['contact'] ?? 'No Contact'); ?></p>
      </div>
  </div><!-- End Info Item -->

  <!-- Email Section -->
  <div class="col-md-6">
      <div class="info-item" data-aos="fade" data-aos-delay="400">
          <i class="bi bi-envelope"></i>
          <h3>Email Us</h3>
          <p><?php echo htmlspecialchars($settings['email'] ?? 'No Email'); ?></p>
      </div>
  </div><!-- End Info Item -->
</div>

</div>
          <div class="col-lg-6">

            <form action="contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
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
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">Send Message</button>
                </div>

              </div>
            </form>
          </div>
          
        </div>

      </div>

    </section><!-- /Contact Section -->

        </div>

      </div>
    </div>
<br><br><br><br><br><br><br><br>
  </main>

  <?php include "includes/footer.php";?>
  <?php
if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
?>
<script>
Swal.fire({
    icon: "<?php echo $_SESSION['status_icon']; ?>",
    title: "<?php echo $_SESSION['status']; ?>",
    confirmButtonText: "Ok"
});
</script>
<?php
unset($_SESSION['status']);
unset($_SESSION['status_icon']);
}
?>
</body>

</html>