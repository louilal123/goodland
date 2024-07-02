<?php
session_start();

$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';
unset($_SESSION['error_message']);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Login </title>
    <!-- MDB icon -->
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"/>
    <!-- MDB -->
    <link rel="stylesheet" href="mdbfolder/css/mdb.min.css" />
  </head>
  <body>
 <!-- Image and text -->
<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img
        src="uploads/default_photo.png"
        class="me-2"
        height="20"
        alt="GOODLAND"
        loading="lazy"
      />
     
    </a>
  </div>
</nav>
    <!-- Start your project here-->
    <section class="vh-100">
      <div class="container py-5 h-100">
        <div class="row d-flex align-items-center justify-content-center h-100">
          <div class="col-md-8 col-lg-7 col-xl-6">
            <img src="uploads/image.png" class="img-fluid" style="height: max-content;" alt="Phone image">
          </div>

          <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
            <div class="card-body p-5 shadow-5 text-center">
              <h2 class="fw-bold mb-5">GoodLand Management System</h2>
              <h4 class="fw-light mb-5">Login Administrator</h4>
             
              <form action="classes/login.php" method="post">
                <?php if ($error_message): ?>
                  <div class="alert bg-danger text-white" id="alert">
                  <i class="fas fa-triangle-exclamation"></i>
                    <?php echo $error_message; ?>
                  </div>
                <?php endif; ?>
                
                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                  <input type="email" name="email" class="form-control form-control-lg"  id="validationCustomUsername" aria-describedby="inputGroupPrepend" required/>
                  <label class="form-label" for="form1Example13">Email address</label>
                  <div class="invalid-feedback">Please choose a username.</div>
                </div>
    
                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                  <input type="password" name="password" class="form-control form-control-lg"  id="validationCustomPassword" aria-describedby="inputGroupPrepend" required/>
                  <label class="form-label" for="form1Example23">Password</label>
                  <div class="invalid-feedback">Please choose a username.</div>
                </div>
    
                <div class="d-flex justify-content-around align-items-center mb-4">
                  <!-- Checkbox -->
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                    <label class="form-check-label" for="form1Example3"> Remember me </label>
                  </div>
                  <a href="forgot_password.php">Forgot password?</a>
                </div>
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
    
              </form>
              <div class="d-flex justify-content-around align-items-center mb-4">
                
                  <a href="../index">Go To Website</a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End your project here-->
   <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
import { Input, Ripple, initMDB } from "mdb-ui-kit";

initMDB({ Input, Ripple });

(() => {
  'use strict';

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation');

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms).forEach((form) => {
    form.addEventListener('submit', (event) => {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  });
})();
   </script>
    <script type="text/javascript" src="mdbfolder/js/mdb.umd.min.js"></script>

    <!-- Custom scripts -->
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            var alertElement = document.getElementById('alert');

            if (alertElement) {
                setTimeout(function () {
                    alertElement.classList.remove('show');
                    alertElement.classList.add('fade-out'); 

                    setTimeout(function () {
                        alertElement.remove();
                    }, 500); 
                }, 5000); 
            }
        });
    </script>
  </body>
</html>
