<?php
session_start();
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
                    <div class="card bg-outline-primary">
                        <div class="mt-4 text-center">
                            <!-- <img src="uploads/logogoodland.png" style="display: flex; margin: auto; width: 150px; height: 60px;"> -->
                        </div>
                        <h2 class="info-color text-primary text-center py-4">
                            <strong>Forgot Password</strong>
                            
                        </h2>
                        <p class="text-dark text-center  mb-4">Enter your email address, and we'll send you an OTP to reset your password.</p>
                        <div class="card-body px-lg-5 pt-0 mt-2">
                         <form action="classes/request_otp.php" method="POST">
      
                            <!-- Email or Username input -->
                            <div data-mdb-input-init class="form-outline mb-4 ">
                                    <i class="fas fa-envelope trailing" id="toggleEmailOrUsername"></i>
                                    <input type="text" name="email" class="form-control form-control-lg form-icon-trailing" />
                                    <label class="form-label" for="materialLoginFormEmailOrUsername">Email</label>
                                   
                                </div>
                                
                        <button type="submit" name="send_otp" class="btn btn-success btn-lg btn-block mt-4">Send Otp</button>
                        
                        <button type="submit" name="send_link" class="btn btn-danger btn-lg btn-block mb-4">Send Reset Link</button>

                                </form>
                            <!-- <div class="d-flex justify-content-around align-items-center mt-4">
                                <a href="forgot_password">Return</a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php include "includes/footer.php" ?>

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
