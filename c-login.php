<?php
session_start();
$error_message = $_SESSION['error_message'] ?? '';
unset($_SESSION['error_message']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "includes/header.php"; ?>
    <link rel="stylesheet" href="mdbfolder/mdb.min.css">
</head>
<style>
    .custom-btn:hover {
        background-color: var(--accent-color) !important;
        border-color: var(--accent-color) !important;
        color: var(--contrast-color) !important;
        cursor: pointer !important;
    }
    /* .header, .footer, .background-video-container {
        display: none !important;
    } */

      .footer {
        display: none !important;
    }
    /* .section {
        background-color: #161616;
    } */
</style>
<body class="index-page">
    <?php include "includes/topnav.php"; ?>

    <main class="main">
        <section id="hero" class="hero section">
            <div class="background-video-container">
                <video autoplay muted loop id="hero-background-video">
                    <source src="https://cdn.arcgis.com/sharing/rest/content/items/8af5121e605a4ae684a1862a51a68b26/resources/6Kc_MpmZPtZWn8QiKobhi.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        <h1>Welcome Back Contributor!</h1>
                        <p data-aos="fade-right text-light">Don't have an account?</p>
                        <div class="d-flex flex-column flex-md-row">
                            <a data-mdb-ripple-init class="btn btn-outline-info btn-rounded btn-lg custom-btn text-light"  href="c-signup">Signup</a>
                        </div>
                    </div>
                    <div class="col-lg-6 order-2 order-lg-1">
                        <!-- Sign In Form -->
                        <div class="card" style="border-radius: 1rem; background-color: #060606 !important; opacity: 0.9;">
                            <div class="p-5 text-center">
                                <img src="assets/img/logogoodland.png" style="width: 200px; height: 75px; margin: auto;">
                                <h5 class="mb-5 mt-2 text-white">Sign in using your credentials.</h5>
                                <form action="contributor/login.php" method="post">
                                    <!-- Email or Username input -->
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <i class="fas fa-user trailing" id="toggleEmailOrUsername"></i>
                                        <input type="text" name="emailOrUsername" class="form-control text-white form-control-lg form-icon-trailing 
                                        <?php echo !empty($_SESSION['error_emailOrUsername']) ? 'is-invalid' : ''; ?>" id="materialLoginFormEmailOrUsername" value="<?php echo $_SESSION['form_data']['emailOrUsername'] ?? ''; ?>" />
                                        <label class="form-label" for="materialLoginFormEmailOrUsername">Email</label>
                                        <?php if (!empty($_SESSION['error_emailOrUsername'])): ?>
                                            <div class="invalid-feedback"><?php echo $_SESSION['error_emailOrUsername']; unset($_SESSION['error_emailOrUsername']); ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Password input -->
                                    <div data-mdb-input-init class="form-outline mb-4" style="position: relative;">
                                        <i class="fas fa-lock trailing" id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; z-index: 999;"></i>
                                        <input type="password" name="password" 
                                        class="form-control text-white form-control-lg form-icon-trailing <?php echo !empty($_SESSION['error_password']) ? 'is-invalid' : ''; ?>" id="validationCustomPassword" aria-describedby="inputGroupPrepend" />
                                        <label class="form-label" for="validationCustomPassword">Password</label>
                                        <?php if (!empty($_SESSION['error_password'])): ?>
                                            <div class="invalid-feedback"><?php echo $_SESSION['error_password']; unset($_SESSION['error_password']); ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-6 d-flex justify-content-center">
                                            <div class="form-check">
                                                <input class="form-check-input form-check-info bg-dark text-white outline-none" type="checkbox" value="" id="showPasswordCheckbox" />
                                                <label class="form-check-label text-white" for="form2Example31"> Show Password </label>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <!-- Simple link -->
                                            <!-- <a href="c-forgotpassword" target="_blank" class="text-info">Forgot password?</a> -->
                                        </div>
                                    </div>

                                    <button data-mdb-ripple-init class="btn custom-btn btn-info btn-lg btn-block" type="submit">Login</button>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const emailOrUsernameInput = document.querySelector('input[name="emailOrUsername"]');
    const passwordInput = document.querySelector('input[name="password"]');
    
    const inputs = [emailOrUsernameInput, passwordInput];

    inputs.forEach(input => {
        input.addEventListener('input', function() {
            const feedback = input.parentNode.querySelector('.invalid-feedback');
            
            // Check if the input is empty
            if (input.value.trim() === '') {
                input.classList.remove('is-valid');
                input.classList.add('is-invalid');
                if (feedback) {
                    feedback.innerText = 'This field is required';
                    feedback.style.display = 'block';
                }
                return; // Exit early if the field is empty
            }

            // For non-empty fields
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
            if (feedback) {
                feedback.style.display = 'none';
            }

            // Email validation (only if this is the email/username input)
            if (input === emailOrUsernameInput && input.value.includes('@')) {
                if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(input.value.trim())) {
                    input.classList.remove('is-valid');
                    input.classList.add('is-invalid');
                    if (feedback) {
                        feedback.innerText = 'Valid email is required';
                        feedback.style.display = 'block';
                    }
                }
            }
        });
    });
});

    </script>
</body>
</html>
