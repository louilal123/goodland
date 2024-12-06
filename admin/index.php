<?php
session_start();

// $allowed_ips = ['124.217.17.43', '103.161.61.66', '103.161.61.64', '122.54.73.139', '111'];

// $visitor_ip = $_SERVER['REMOTE_ADDR'];

// if (!in_array($visitor_ip, $allowed_ips)) {
//     http_response_code(404);
//     include('../404.html'); 
//     exit(); 
// }

$error_message = $_SESSION['error_message'] ?? '';
unset($_SESSION['error_message']);
?>
<?php include "header.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="mdbfolder/mdb.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<style>
    body {
        overflow: hidden !important;
    }


    /* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  background-color: rgba(0, 0, 0, 0.4); /* Black with transparency */
  padding-top: 60px; /* Padding from the top */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto; /* Center the modal */
  padding: 40px;
  border: 1px solid #888;
  width: 30%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
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
.text-lg{
    font-size: 34px;
    
}
</style>
<body class="bg-light main-blur">
    <section class="vh-100 bg-light">
        <div class="container  h-100 ">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-7 col-lg-5 mt-5 mb-5">
                    <div class="card">
                        <div class="mt-4 text-center">
                            <span class="fw-bold sitename">GOOD</span><span class="fw-light text-primary text-lg"> Land</span>
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
    <i class="fas fa-eye" id="togglePassword" 
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
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="on" id="termsCheckbox" name="terms" required />
        <label class="form-check-label" for="termsCheckbox">
            <a href="javascript:void(0);" id="openModalBtn">Terms and Conditions</a>
        </label> </div>
    <a href="forgot_password">Forgot password?</a>
</div>


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

 <!-- Modal for Terms and Conditions -->
<div id="termsModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Terms and Conditions</h2>
        <p>Here are the terms and conditions...</p>
        <!-- Add more terms content here -->
    </div>
</div>

    <script>
    // Toggle Password Visibility
    document.getElementById('togglePassword').addEventListener('click', function () {
        var passwordField = document.getElementById('validationCustomPassword');
        var icon = document.getElementById('togglePassword');
        
        // Toggle visibility
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
</script>

    <script>
        // Toggle Password Visibility
        document.getElementById('togglePassword').addEventListener('click', function () {
            var passwordField = document.getElementById('validationCustomPassword');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        });

        // Terms and Conditions modal toggle
        import { Modal, Ripple, initMDB } from "mdb-ui-kit";
        initMDB({ Modal, Ripple });
    </script>

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

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script>
        // Get the modal
var modal = document.getElementById("termsModal");

// Get the button that opens the modal
var btn = document.getElementById("openModalBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

// Check if the terms checkbox is checked on form submission
document.querySelector('form').addEventListener('submit', function(event) {
    var termsCheckbox = document.getElementById('termsCheckbox');
    if (!termsCheckbox.checked) {
        alert("You must agree to the Terms and Conditions to proceed.");
        event.preventDefault();  // Prevent form submission if checkbox is not checked
    }
});

    </script>

    <script type="text/javascript" src="mdbfolder/mdb.umd.min.js"></script>
    <script>
        // Initialization for ES Users
import { Modal, Ripple, initMDB } from "mdb-ui-kit";

initMDB({ Modal, Ripple });
    </script>
</body>
</html>
