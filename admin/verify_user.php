<?php
session_start();

if (!isset($_SESSION['email']) || !isset($_SESSION['otp'])) {
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
</style>
<body class="bg-light main-blur">
    <section class="vh-100 bg-light">
        <div class="container py-5 h-100 ">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1 mt-5 mb-5">
                    <div class="card ">
                        <div class="mt-4 text-center">
                            <!-- <img src="uploads/logogoodland.png" style="display: flex; margin: auto; width: 150px; height: 60px;"> -->
                        </div>
                        <h2 class="info-color text-success text-center py-4">
                            <strong>Verify Your Email</strong>
                        </h2>
                        <p class="text-dark text-center mb-4">We have sent a 6-digit OTP to your email.</p>
                        <div class="card-body px-lg-5 pt-0 mt-2">
                            <form action="classes/validate_otp.php" method="POST">
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <i class="fas fa-lock trailing"></i>
                                    <input type="text" name="otp" class="form-control form-control-lg form-icon-trailing" />
                                    <label class="form-label" for="materialLoginFormOtp">Enter OTP</label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block mb-4">Verify OTP</button>
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

    <?php include "includes/footer.php" ?>
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
</body>
</html>
