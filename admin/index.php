<?php
session_start();
$error_message = $_SESSION['error_message'] ?? '';
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
  <style>
    body{
      oveflow: hidden !important;
    }
  </style>
  <body class="bg-light bg-opacity-50" style="oveflow: hidden !important; ">

    <!-- Start your project here-->
    <section class="vh-100" style="oveflow: hidden !important; ">
      <div class="container py-5 h-100">
        <div class="row d-flex align-items-center justify-content-center h-100">
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1 mt-5 mb-5">
    <div class="card">
        <div class="card-header text-center">
            <img src="uploads/logogoodland.png" style="display: flex; margin: auto; width: 150px; height: 60px;">
        </div>
        <h2 class="info-color white-text text-center py-4">
            <strong>Sign In</strong>
        </h2>
        <div class="card-body px-lg-5 pt-0">
            <form style="color: #757575;" action="classes/login.php" method="post">
                <?php if (!empty($error_message)): ?>
                    <div class="alert bg-danger text-white" id="alert">
                        <i class="fas fa-triangle-exclamation"></i>
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>

                <!-- Email or Username input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <i class="fas fa-user trailing" id="toggleEmailOrUsername"></i>
                    <input type="text" name="emailOrUsername" class="form-control form-control-lg form-icon-trailing
                    <?php echo !empty($_SESSION['error_emailOrUsername']) ? 'is-invalid' : ''; ?>" id="materialLoginFormEmailOrUsername" 
                    value="<?php echo $_SESSION['form_data']['emailOrUsername'] ?? ''; ?>" />
                    <label class="form-label" for="materialLoginFormEmailOrUsername">Email or Username</label>
                    <?php if (!empty($_SESSION['error_emailOrUsername'])): ?>
                        <div class="invalid-feedback"><?php echo $_SESSION['error_emailOrUsername']; unset($_SESSION['error_emailOrUsername']); ?></div>
                    <?php endif; ?>
                </div>

                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4" style="position: relative;">
                    <i class="fas fa-lock trailing" id="togglePassword" style="position: absolute; right: 10px; top: 50%;
                    transform: translateY(-50%); cursor: pointer; z-index: 999;"></i>
                    <input type="password" name="password" class="form-control form-control-lg form-icon-trailing
                    <?php echo !empty($_SESSION['error_password']) ? 'is-invalid' : ''; ?>" 
                    id="validationCustomPassword" aria-describedby="inputGroupPrepend" style="cursor: pointer !important;" />
                    <label class="form-label" for="validationCustomPassword">Password</label>
                    <?php if (!empty($_SESSION['error_password'])): ?>
                        <div class="invalid-feedback"><?php echo $_SESSION['error_password']; unset($_SESSION['error_password']); ?></div>
                    <?php endif; ?>
                </div>

                <div class="d-flex justify-content-around align-items-center mb-4">
                    <!-- Checkbox -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="showPasswordCheckbox" />
                        <label class="form-check-label" for="showPasswordCheckbox">Show Password</label>
                    </div>
                    <a href="forgot_password.php">Forgot password?</a>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-lg btn-block mb-4">Sign in</button>
            </form>

            <div class="d-flex justify-content-around align-items-center mt-4">
                <a href="../index">Go To Website</a>
            </div>
        </div>
    </div>
</div>

        </div>
      </div>
    </section>

    <!-- end  -->
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

<script>
    document.getElementById('showPasswordCheckbox').addEventListener('change', function () {
        var passwordInput = document.getElementById('validationCustomPassword');
        if (this.checked) {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    });
</script>

  </body>
</html>
