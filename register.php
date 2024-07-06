<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<?php include "includes/header.php"; ?>
<link rel="stylesheet" href="mdbfolder/mdb.min.css">
<style>
  .header {
    background-color: black !important;
  }
  .card:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transform: scale(1.02);
    transition: transform 0.2s;
  }
  .star-rating {
    color: gold;
  }
  .card-img {
    height: 200px;
  }
  .services {
    background-color: white; 
    background-repeat: no-repeat; 
    background-size: cover;
  }
  @media (min-width: 1200px) {
    .services {
      padding-top: 150px !important; 
    }
  }
  @media (max-width: 768px) {
    .services {
      padding-top: 100px; 
    }
  }
</style>

<body class="index-page">

<?php include "includes/topnav.php"; ?>

  <main class="main">
    <section class="services section ">
      <div class="container">
        <div class="row">
          <!-- Add Login Form Here -->
          <div class="col-md-6 offset-md-3 mt-3 mb-5">
            <!-- Material form login -->
            <div class="card">
              <h2 class="card-header info-color white-text text-center py-4">
                <strong>Sign Up</strong>
              </h2>

              <!--Card content-->
              <div class="card-body px-lg-5 pt-0">
              <form style="color: #757575;" action="classes/signup.php" method="post">

                  <div class="md-form mt-2">
                    <label for="materialLoginFormFullname">Fullname</label>
                    <input type="text" id="materialLoginFormFullname" class="form-control 
                    <?php echo !empty($_SESSION['error_fullname']) ? 'is-invalid' : ''; ?>" name="fullname">
                    <?php if (!empty($_SESSION['error_fullname'])): ?>
                        <div class="invalid-feedback mb-2"><?php echo $_SESSION['error_fullname']; unset($_SESSION['error_fullname']); ?></div>
                    <?php endif; ?>
                  </div>

                  <div class="md-form mb-2">
                    <label for="materialLoginFormEmail">E-mail</label>
                    <input type="email" id="materialLoginFormEmail" class="form-control <?php echo !empty($_SESSION['error_email']) ? 'is-invalid' : ''; ?>" name="email">
                    <?php if (!empty($_SESSION['error_email'])): ?>
                        <div class="invalid-feedback mb-2"><?php echo $_SESSION['error_email']; unset($_SESSION['error_email']); ?></div>
                    <?php endif; ?>
                  </div>

                  <div class="md-form mb-2">
                    <label for="materialLoginFormBirthday">Birthday</label>
                    <input type="date" id="materialLoginFormBirthday" class="form-control <?php echo !empty($_SESSION['error_birthday']) ? 'is-invalid' : ''; ?>" name="bday">
                    <?php if (!empty($_SESSION['error_birthday'])): ?>
                        <div class="invalid-feedback mb-2"><?php echo $_SESSION['error_birthday']; unset($_SESSION['error_birthday']); ?></div>
                    <?php endif; ?>
                  </div>

                  <div class="md-form mb-2">
                    <label for="materialLoginFormUsername">Username</label>
                    <input type="text" id="materialLoginFormUsername" class="form-control <?php echo !empty($_SESSION['error_username']) ? 'is-invalid' : ''; ?>" name="username">
                    <?php if (!empty($_SESSION['error_username'])): ?>
                        <div class="invalid-feedback mb-2"><?php echo $_SESSION['error_username']; unset($_SESSION['error_username']); ?></div>
                    <?php endif; ?>
                  </div>

                  <div class="md-form mb-2">
                    <label for="materialLoginFormPassword">Password</label>
                    <input type="password" id="materialLoginFormPassword" class="form-control <?php echo !empty($_SESSION['error_password']) ? 'is-invalid' : ''; ?>" name="pswd">
                    <?php if (!empty($_SESSION['error_password'])): ?>
                        <div class="invalid-feedback mb-2"><?php echo $_SESSION['error_password']; unset($_SESSION['error_password']); ?></div>
                    <?php endif; ?>
                  </div>

                  <div class="md-form mb-4">
                    <label for="materialLoginFormConfirmPassword">Confirm Password</label>
                    <input type="password" id="materialLoginFormConfirmPassword" class="form-control <?php echo !empty($_SESSION['error_confirm_password']) ? 'is-invalid' : ''; ?>" name="cpswd">
                    <?php if (!empty($_SESSION['error_confirm_password'])): ?>
                        <div class="invalid-feedback mb-2"><?php echo $_SESSION['error_confirm_password']; unset($_SESSION['error_confirm_password']); ?></div>
                    <?php endif; ?>
                  </div>

                  <button type="submit" class="btn btn-primary btn-block z-depth-0 mb-2"  data-mdb-ripple-init>Signup</button>
                  <!-- <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Signup</button> -->

                  <p class="text-center py-2"> Already have an account?
                    <a href="get-started" >Signin</a>
                  </p>
                  </form>


              </div>

            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

<?php include "includes/footer.php"; ?>
<script type="text/javascript" src="mdbfolder/mdb.umd.min.js"></script>
</body>
</html>
