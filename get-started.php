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
    <section class="services section">
      <div class="container mb-5 mt-2">
        <div class="row">
          
          <div class="col-md-6 offset-md-3 mt-5 mb-5">
            <div class="card">
            
            <h2 class="card-header info-color white-text text-center py-4 ">
                <strong>Sign In</strong>
              </h2>
              <div class="card-body px-lg-5 pt-0 ">

              <form style="color: #757575;" action="classes/login.php" method="post">
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

                <div class="d-flex justify-content-around text-center mt-3 mb-3">
                    <div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="showPasswordCheckbox" />
                            <label class="form-check-label" for="form1Example3">Show Password</label>
                        </div>
                    </div>
                    <div>
                        <a href="#">Forgot password?</a>
                    </div>
                </div>

                <button class="btn btn-outline-warning btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Sign in</button>

                <p>Don't have an account?
                    <a href="register">Register</a>
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
