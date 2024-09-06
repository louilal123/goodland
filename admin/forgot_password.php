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
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"/>
    <!-- MDB -->
    <link rel="stylesheet" href="mdbfolder/css/mdb.min.css" />
  </head>
  <body>
    <!-- Start your project here-->
    <section class="vh-100">
      <div class="container py-5 h-100">
        <div class="row d-flex align-items-center justify-content-center h-100">
          <div class="col-md-8 col-lg-7 col-xl-6">
            <img src="bac.png"
              class="img-fluid" style="height: max-content;" alt="Phone image">
          </div>

          <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
            <div class="card-body p-5 shadow-5 text-center">
              <h4 class="fw-bold mb-3">Forgot Password</h4>
              <h5 class="fw-light mb-5">Enter your email address and we'll send otp code to your email address.</h5>
             
            <form action="classes/request_reset.php" method="post">
              <!-- Email input -->
              <div data-mdb-input-init class="form-outline mb-4">
                <input type="email" id="form1Example13" name="email" class="form-control form-control-lg" />
                <label class="form-label" for="form1Example13">Email address</label>
              </div>
    
              <!-- Submit button -->
              <button type="submit" class="btn btn-primary btn-lg btn-block mb-4">Submit</button>
    
              <div class="d-flex justify-content-around align-items-center mb-4">
              
                <a href="index">Back to Login</a>
              </div>
            </form>
          </div>
        </div>
        </div>
      </div>
    </section>
    <!-- End e-->

    <script type="text/javascript" src="mdbfolder/js/mdb.umd.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
  </body>
</html>
