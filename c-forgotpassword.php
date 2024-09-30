<!DOCTYPE html>
<html lang="en">
<head>
<?php include "includes/header.php"?>
<link rel="stylesheet" href="mdbfolder/mdb.min.css">

</head>
<style>
  
.custom-btn:hover{
  background-color: var(--accent-color) !important;
  color: var(--contrast-color) !important;
}
.header, .footer, .background-video-container{
  display: none !important;
}

</style>

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
     
      <div class="col-lg-12 d-flex justify-content-center"  data-aos="fade-up" data-aos-delay="100">
               <!-- Sign Up Form -->

        <div class="card" style="border-radius: 1rem; background-color: #060606 !important; opacity: 0.9;">
          <div class="p-5 text-center">
           
              <img src="assets/img/logogoodland.png" style="width: 200px; height: 55px; margin: auto;">
              <h2>Reset Password</h2>
           <h5 class="mb-5 mt-2 text-white">Well send a password reset link to your email.</h5>
            <form action="send-password-reset.php" method="post" >

                  <div data-mdb-input-init class="form-outline form-white opacity-75 mb-4">
                    <input type="email" name="email" class="form-control form-control-lg "   />
                    <label class="form-label" for="typeEmailX-2">Email</label>
                  </div>


                  <button  data-mdb-ripple-init class="btn btn-info btn-lg btn-block" type="submit">Send Reset Link</button>
                  <p class="mt-3"><a href="c-login">Return</a></p>
            </form>
          </div>
        </div>
  
      </div>
    </div>
  </div>
</section>
<?php include "includes/footer.php"?>
  </main>
  <script type="text/javascript" src="mdbfolder/mdb.umd.min.js"></script>
     <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
// import { Input, Ripple, initMDB } from "mdb-ui-kit";

// initMDB({ Input, Ripple });

// (() => {
//   'use strict';

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  // const forms = document.querySelectorAll('.needs-validation');

  // Loop over them and prevent submission
//   Array.prototype.slice.call(forms).forEach((form) => {
//     form.addEventListener('submit', (event) => {
//       if (!form.checkValidity()) {
//         event.preventDefault();
//         event.stopPropagation();
//       }
//       form.classList.add('was-validated');
//     }, false);
//   });
// })();
   </script>

</body>

</html>