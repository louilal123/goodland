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
                <div class="md-form mb-4">
                  <label for="materialLoginFormEmail">E-mail</label>
                  <input type="email" id="materialLoginFormEmail" class="form-control 
                  <?php echo !empty($_SESSION['error_email']) ? 'is-invalid' : 'is-valid'; ?>" 
                  name="email" value="<?php echo $_SESSION['form_data']['email'] ?? ''; ?>">
                  <?php if (!empty($_SESSION['error_email'])): ?>
                    <div class="invalid-feedback mb-4"><?php echo $_SESSION['error_email']; unset($_SESSION['error_email']); ?></div>
                  <?php endif; ?>
                </div>

                <div class="md-form mb-4">
                  <label for="materialLoginFormPassword">Password</label>
                  <input type="password" id="validationCustomPassword" class="form-control 
                  <?php echo !empty($_SESSION['error_password']) ? 'is-invalid' : ''; ?>" 
                  name="password">
                  <?php if (!empty($_SESSION['error_password'])): ?>
                    <div class="invalid-feedback mb-4"><?php echo $_SESSION['error_password']; unset($_SESSION['error_password']); ?></div>
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
<!-- what -->
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
