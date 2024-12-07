<?php
session_start();
require_once "classes/Main_class.php";

// Get email and OTP from the URL
$email = isset($_GET['email']) ? trim($_GET['email']) : null;
$otp = isset($_GET['otp']) ? trim($_GET['otp']) : null;

if (!$email || !$otp) {
    $_SESSION['status'] = "Invalid or missing link parameters.";
    $_SESSION['status_icon'] = "error";
    header("Location: forgot_password.php");
    exit;
}

// You can also hash the OTP here for security if needed, e.g., $hashedOtp = hash('sha256', $otp);
// You may choose to compare this hash with the stored OTP in your database later

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Create New Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="mdbfolder/mdb.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert -->
</head>
<style>
    body {
        overflow: hidden !important;
    }
    .main-blur {
        background: rgba(108, 117, 125, 0.5); 
    }
    .card {
        border-radius: 0px;
    }
</style>
<body class="bg-light main-blur">
    <section class="vh-100 bg-light">
        <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1 mt-5 mb-5">
                    <div class="card">
                        <h2 class="info-color text-success text-center py-4">
                            <strong>Create A New Password</strong>
                        </h2>
                        <div class="card-body px-lg-5 pt-0 mt-2">
                            <form action="classes/reset_password_process.php" method="POST">
                                <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                                <input type="hidden" name="otp" value="<?php echo htmlspecialchars($otp); ?>">

                                <div class="form-outline mb-4">
                                    <i class="fas fa-lock trailing"></i>
                                    <input type="password" name="password" class="form-control form-control-lg form-icon-trailing" required />
                                    <label class="form-label" for="newPassword">New Password</label>
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg btn-block mb-4">Create a New Password</button>
                            </form>

                            <div class="d-flex justify-content-around align-items-center mt-4">
                                <a href="index">Return</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include "includes/footer.php"; ?>

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
    <script src="https://www.google.com/recaptcha/api.js?render=6Lep8ZIqAAAAAMwIexA0yySzdpGQ_Z0qvSQtjXkv"></script>
<script>
      function onClick(e) {
        e.preventDefault();
        grecaptcha.ready(function() {
          grecaptcha.execute('6Lep8ZIqAAAAAMwIexA0yySzdpGQ_Z0qvSQtjXkv', {action: 'submit'}).then(function(token) {
          });
        });
      }
  </script>
</body>
</html>
