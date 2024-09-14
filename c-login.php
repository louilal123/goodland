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
      <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center ">
        <h1 data-aos="fade-down">Welcome Back Contributor!</h1>

        <p data-aos="fade-right text-light" data-aos-delay="100">
      Don't have an account? 
        </p>
        <div class="d-flex flex-column flex-md-row" data-aos="fade-up" data-aos-delay="200">
        <a data-mdb-ripple-init class="btn btn-outline-info btn-rounded btn-lg custom-btn text-white"
        data-mdb-ripple-color="dark" href="c-signup.php">Signup</a>

          <!-- btn-outline-info -->
        </div>
      </div>
      <div class="col-lg-6 order-2 order-lg-1 "  data-aos="fade-up" data-aos-delay="100">
               <!-- Sign Up Form -->

        <div class="card" style="border-radius: 1rem; background-color: #060606 !important; opacity: 0.9;">
          <div class="p-5 text-center">
           
              <img src="assets/img/logogoodland.png" style="width: 200px; height: 75px; margin: auto;">
              
           <h5 class="mb-5 mt-2 text-white">Sign in using your credentials.</h5>
            <form action="c-login.php" method="post" >

                  <div data-mdb-input-init class="form-outline form-white opacity-75 mb-4">
                    <input type="email" name="email" class="form-control form-control-lg"   />
                    <label class="form-label" for="typeEmailX-2">Email</label>
                  </div>

                  <div data-mdb-input-init class="form-outline form-white opacity-75 mb-4">
                    <input type="password"  name="password" class="form-control form-control-lg"  />
                    <label class="form-label" for="typePasswordX-2">Password</label>
                  </div>

                  <div class="row mb-4">
                    <div class="col-6 d-flex justify-content-center">
                      <!-- Checkbox -->
                      <div class="form-check">
                        <input class="form-check-input form-check-info bg-dark text-white outline-none" type="checkbox" value="" id="form2Example31" checked />
                        <label class="form-check-label text-white" for="form2Example31"> Show Password </label>
                      </div>
                    </div>

                    <div class="col-6">
                      <!-- Simple link -->
                      <a href="c-forgotpassword.php" class=" text-info">Forgot password?</a>
                    </div>
                  </div>

                  <button  data-mdb-ripple-init class="btn btn-info btn-lg btn-block" type="submit">Login</button>
            </form>
          </div>
        </div>
  
      </div>
    </div>
  </div>
</section>

  </main>

  <?php include "includes/footer.php"?>

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