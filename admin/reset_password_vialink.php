<?php
session_start();
require_once "classes/Main_class.php"; 
require_once "classes/config.php"; 

if (isset($_GET['otp'])) {
    $otp_from_url = urldecode(htmlspecialchars($_GET['otp']));

    $mainClass = new Main_class();

    $is_valid_otp = $mainClass->validateURLOTP($otp_from_url);

    if (!$is_valid_otp) {
        echo "";
    } else {
        session_destroy();
        http_response_code(404); 
        include('../404.html');
        exit();
    }
} else {
    http_response_code(404); 
    include('../404.html');
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="mdbfolder/mdb.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../mdbfolder/mdb.min.css" />
</head>
<body>
    <section class="vh-100 bg-light">
        <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1 mt-5 mb-5">
                    <div class="card">
                    <h2 class="info-color text-success text-center py-4 mb-3">
                            <strong>Email Verified.</strong>
                        </h2>
                        <h4 class="info-color text-dark text-center py-4 p-4">
                          Please proceed with resetting your password
                        </h4>
                        <div class="card-body px-lg-5 pt-0 mt-2">
                            <form action="classes/reset_password_process1.php" method="POST">
                                <!-- Hidden input to pass decrypted OTP -->
                                <input type="hidden" name="otp" value="<?php echo htmlspecialchars($otp_from_url); ?>">

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <i class="fas fa-lock trailing"></i>
                                    <input type="password" name="password" class="form-control form-control-lg form-icon-trailing" required />
                                    <label class="form-label" for="materialLoginFormOtp">New Password</label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block mb-4">Create a new password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
</body>
</html>
