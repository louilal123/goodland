<?php
session_start();

// Allowed IP addresses
$allowed_ips = ['112.208.72.214', '::1', '116.91.209.249'];

// Get the user's IP address
$user_ip = $_SERVER['REMOTE_ADDR'];

// Check if the user's IP address matches any allowed IPs
if (!in_array($user_ip, $allowed_ips)) {
    http_response_code(404); // Set the 404 status code
    include('../404.html'); // Include the 404 page content
    exit();
}

$error_message = $_SESSION['error_message'] ?? '';
unset($_SESSION['error_message']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="mdbfolder/mdb.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert -->
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../mdbfolder/mdb.min.css" />
</head>
<style>
    body {
        overflow: hidden !important;
    }
    .main-blur {
    background: rgba(108, 117, 125, 0.5); 
}
.card{
    border-radius: 0px;
}
.sitename{
    font-size: 44px; /* Adjust size as needed */
  background-image: linear-gradient(to right, #144D53, #0062cc);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
</style>
<body class="bg-light main-blur">
    <section class="vh-100 bg-light">
        <div class="container  h-100 ">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-7 col-lg-5   mt-5 mb-5">
                    <div class="card ">
                        <div class="mt-4 text-center">
                        <span class=" fw-bold sitename ">GOOD</strong><i class="fw-light">Land</i></span>
                      
                        </div>
                        <h2 class="info-color white-text text-center mt-2 mb-4">
                            
                            <strong>Welcome Back!</strong>
                        </h2>
                        <div class="card-body px-lg-5 pt-0 mt-2">
                            <form style="color: #757575;" action="classes/login.php" method="post">
                                <!-- Display inline error for required fields -->
                                <?php if (!empty($error_message)): ?>
                                    <div class="alert bg-danger text-white" id="alert">
                                        <i class="fas fa-triangle-exclamation"></i>
                                        <?php echo $error_message; ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Email or Username input -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <i class="fas fa-user trailing" id="toggleemail"></i>
                                    <input type="text" name="email" class="form-control form-control-lg form-icon-trailing
                                    <?php echo !empty($_SESSION['error_email']) ? 'is-invalid' : ''; ?>" id="materialLoginFormemail" 
                                    value="<?php echo $_SESSION['form_data']['email'] ?? ''; ?>" />
                                    <label class="form-label" for="materialLoginFormemail">Email or Username</label>
                                    <?php if (!empty($_SESSION['error_email'])): ?>
                                        <div class="invalid-feedback"><?php echo $_SESSION['error_email']; unset($_SESSION['error_email']); ?></div>
                                    <?php endif; ?>
                                </div>

                                <!-- Password input -->
                                <div data-mdb-input-init class="form-outline mb-4" style="position: relative;">
                                    <i class="fas fa-lock trailing" id="togglePassword" 
                                    style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; z-index: 999;"></i>
                                    <input type="password" name="password" class="form-control form-control-lg form-icon-trailing
                                    <?php echo !empty($_SESSION['error_password']) ? 'is-invalid' : ''; ?>" 
                                    id="validationCustomPassword" aria-describedby="inputGroupPrepend" />
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
                                <button type="submit" id="submitButton" class="btn btn-primary btn-lg btn-block mb-4">Sign in</button>
                            </form>

                            <div class="d-flex justify-content-around align-items-center mt-4">
                                <a href="../index">Return To Website</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SweetAlert display script -->
    <?php if (isset($_SESSION['status']) && $_SESSION['status'] != ''): ?>
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
        ?>
    <?php endif; ?>

    <script type="text/javascript" src="mdbfolder/mdb.umd.min.js"></script>
    <script>
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

            document.getElementById('showPasswordCheckbox').addEventListener('change', function () {
                var passwordInput = document.getElementById('validationCustomPassword');
                if (this.checked) {
                    passwordInput.type = 'text';
                } else {
                    passwordInput.type = 'password';
                }
            });
        });
    </script>
      
<script
    disable-devtool-auto
    src='https://cdn.jsdelivr.net/npm/disable-devtool'
    md5='xxx'
    url='xxx'
    tk-name='xxx'
    interval='xxx'
    disable-menu='xxx'
    detectors='xxx'
    clear-log='true'
    disable-select='true'
    disable-copy='true'
    disable-cut='true'
    disable-paste='true'
></script>

</body>
</html>
