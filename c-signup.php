<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "includes/header.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="mdbfolder/mdb.min.css">
    <!-- <link rel="stylesheet" href="assets/css/modalbtn.css"> -->
</head>

<style>
    .custom-btn:hover {
        background-color: var(--accent-color) !important;
        border-color: var(--accent-color) !important;
        color: var(--contrast-color) !important;
        cursor: pointer !important;
    }
    .btn-outline-info{
        color: var(--contrast-color) !important;
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
        <!-- Hero Section -->
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
                        <h1 data-aos="fade-down">Contributor - Sign Up</h1>
                        <p data-aos="fade-in" data-aos-delay="100">Join us in making a difference by sharing valuable resources and insights with the community.</p>
                        <p data-aos="fade-right " data-aos-delay="100">Already have an account?</p>
                        <div class="d-flex flex-column flex-md-row">
                            <a data-mdb-ripple-init class="btn btn-outline-info btn-rounded btn-lg custom-btn text-light"  href="c-login">Login</a>
                        </div>
                    </div>

                    <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
                        <!-- Sign Up Form -->
                        <div class="card " style="border-radius: 1rem; background-color: #060606 !important; opacity: 0.9;">
                            <div class="p-5 text-center">
                                <img src="assets/img/logogoodland.png" style="width: 150px; height: 50px;">
                                <h5 class="mb-5 mt-1">Please supply the required the fields.</h5>
                                <form action="classes/process-signup.php" method="post">
                                    <!-- Name Field -->
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="text" name="name" class="form-control form-control-lg <?php echo !empty($_SESSION['name_err']) ? 'is-invalid' : ''; ?>" value="<?php echo !empty($_SESSION['form_data']['name']) ? htmlspecialchars($_SESSION['form_data']['name']) : ''; ?>" />
                                        <label class="form-label" for="typeNameX-2">Name</label>
                                        <?php if (!empty($_SESSION['name_err'])): ?>
                                            <div class="invalid-feedback"><?php echo $_SESSION['name_err']; unset($_SESSION['name_err']); ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Email Field -->
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="text" name="email" class="form-control form-control-lg <?php echo !empty($_SESSION['email_err']) ? 'is-invalid' : ''; ?>" value="<?php echo !empty($_SESSION['form_data']['email']) ? htmlspecialchars($_SESSION['form_data']['email']) : ''; ?>" />
                                        <label class="form-label" for="typeEmailX-2">Email</label>
                                        <?php if (!empty($_SESSION['email_err'])): ?>
                                            <div class="invalid-feedback"><?php echo $_SESSION['email_err']; unset($_SESSION['email_err']); ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Password Field -->
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="password" name="password" class="form-control form-control-lg <?php echo !empty($_SESSION['password_err']) ? 'is-invalid' : ''; ?>" value="<?php echo !empty($_SESSION['form_data']['password']) ? htmlspecialchars($_SESSION['form_data']['password']) : ''; ?>" />
                                        <label class="form-label" for="typePasswordX-2">Password</label>
                                        <?php if (!empty($_SESSION['password_err'])): ?>
                                            <div class="invalid-feedback"><?php echo $_SESSION['password_err']; unset($_SESSION['password_err']); ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Password Confirmation Field -->
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="password" name="password_confirmation" class="form-control form-control-lg 
                                        <?php echo !empty($_SESSION['confirm_password_err']) ? 'is-invalid' : ''; ?>" value="<?php echo !empty($_SESSION['form_data']['password_confirmation']) ? htmlspecialchars($_SESSION['form_data']['password_confirmation']) : ''; ?>" />
                                        <label class="form-label" for="typePasswordX-2">Repeat Password</label>
                                        <?php if (!empty($_SESSION['confirm_password_err'])): ?>
                                            <div class="invalid-feedback">
                                                <?php echo $_SESSION['confirm_password_err']; unset($_SESSION['confirm_password_err']); ?></div>
                                        <?php endif; ?>
                                    </div>


                                    <div class="form-check mb-3 d-flex justify-content-center">
                                        <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" required />
                                        <label class="form-check-label" for="form2Example3">
                                            I agree all statements in   
                                            <a href="#" id="uploaderAgreementLink">Privacy Policy</a>. Ensure you have the rights to share the documents you upload.
                                            </label>
                                    </div>
                                    <!-- <input type="text" value="ph" name="country_flag"> -->

                                    <button data-mdb-input-init class="btn btna btn-info btn-lg btn-block" type="submit">Signup</button>
                                </form>
                            </div>
                        </div>

                       
                        <!-- End Modal -->
                    </div>
                </div>
            </div>
        </section>
    </main>

    
     

    <!-- SweetAlert for status messages -->
    <?php if (isset($_SESSION['status']) && $_SESSION['status'] != ''): ?>
        <script>
            Swal.fire({
                icon: "<?php echo $_SESSION['status_icon']; ?>",
                title: "<?php echo $_SESSION['status']; ?>",
                confirmButtonText: "Ok"
            });
        </script>
        <?php unset($_SESSION['status'], $_SESSION['status_icon']); ?>
    <?php endif; ?>

    <?php include "includes/footer.php"; ?>
    <script type="text/javascript" src="mdbfolder/mdb.umd.min.js"></script>
    <script>
document.getElementById('uploaderAgreementLink').addEventListener('click', function(event) {
    event.preventDefault();
    var myModal = new mdb.Modal(document.getElementById('uploaderAgreementModal'));
    myModal.show();
});
</script>
<script>
        document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('input.form-control');
    const nameInput = document.querySelector('input[name="name"]');
    const emailInput = document.querySelector('input[name="email"]');
    const passwordInput = document.querySelector('input[name="password"]');
    const confirmPasswordInput = document.querySelector('input[name="password_confirmation"]');

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
                return; // Exit early for empty fields
            }

            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
            if (feedback) {
                feedback.style.display = 'none';
            }

            // Name validation (no numbers or special characters)
            if (input === nameInput) {
                if (!/^[a-zA-Z\s]+$/.test(input.value.trim())) {
                    input.classList.remove('is-valid');
                    input.classList.add('is-invalid');
                    if (feedback) {
                        feedback.innerText = 'Name should only contain letters and spaces.';
                        feedback.style.display = 'block';
                    }
                }
            }

            // Email validation
            if (input === emailInput) {
                if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(input.value.trim())) {
                    input.classList.remove('is-valid');
                    input.classList.add('is-invalid');
                    if (feedback) {
                        feedback.innerText = 'Valid email is required.';
                        feedback.style.display = 'block';
                    }
                }
            }

            // Password validation
            if (input === passwordInput) {
                if (passwordInput.value.length < 8) {
                    input.classList.remove('is-valid');
                    input.classList.add('is-invalid');
                    if (feedback) {
                        feedback.innerText = 'Password must be at least 8 characters.';
                        feedback.style.display = 'block';
                    }
                } else if (!/[a-zA-Z]/.test(passwordInput.value)) {
                    input.classList.remove('is-valid');
                    input.classList.add('is-invalid');
                    if (feedback) {
                        feedback.innerText = 'Password must contain at least one letter.';
                        feedback.style.display = 'block';
                    }
                } else if (!/[0-9]/.test(passwordInput.value)) {
                    input.classList.remove('is-valid');
                    input.classList.add('is-invalid');
                    if (feedback) {
                        feedback.innerText = 'Password must contain at least one number.';
                        feedback.style.display = 'block';
                    }
                }
            }

            // Password confirmation validation
            if (input === confirmPasswordInput) {
                if (passwordInput.value !== confirmPasswordInput.value) {
                    confirmPasswordInput.classList.remove('is-valid');
                    confirmPasswordInput.classList.add('is-invalid');
                    const confirmPasswordFeedback = confirmPasswordInput.parentNode.querySelector('.invalid-feedback');
                    if (confirmPasswordFeedback) {
                        confirmPasswordFeedback.innerText = 'Passwords must match.';
                        confirmPasswordFeedback.style.display = 'block';
                    }
                }
            }
        });
    });
});

</script>

<script>
 document.getElementById("uploaderAgreementLink").addEventListener("click", function(e) {
  e.preventDefault();
  Swal.fire({
    title: '<img src="assets/img/logogoodland.png" style="width: 180px; height: 50px;">',
    background: '#333333',
    closeButtonColor: '#28747c',
    color: '#ffffff80',
    html: `
      <div style="text-align: left; font-size: 16px; max-height: 500px; overflow-y: auto;">
        <h4>Terms and Conditions</h4>
        <p>By signing up for GOODLand, you agree to the following terms and conditions. You confirm that you are responsible for the accuracy of the information you provide during the signup process.</p>
        <p>GOODLand reserves the right to suspend or terminate your account if any violations of the terms are detected. You also agree not to use your account for illegal activities or to violate the rights of other users.</p>
        <p>You are responsible for maintaining the confidentiality of your login credentials. You are also responsible for all activities conducted under your account.</p>
        
        <h4>Privacy Policy</h4>
        <p>GOODLand takes your privacy seriously. We collect personal information only for the purpose of providing better service and improving user experience on the platform.</p>
        <p>Your data, such as name, email, and location, may be collected during the signup process. This information will not be shared with third parties without your explicit consent.</p>
        <p>We use cookies to improve your experience. By using our website, you consent to our use of cookies. You have the right to opt out of certain cookies; however, doing so may affect the functionality of the website.</p>
        <p>Your account information is stored securely, and we take all necessary precautions to protect it from unauthorized access.</p>
        <p>We retain your personal information only for as long as necessary to fulfill the purposes outlined in this Privacy Policy, or as required by law.</p>
        <p>GOODLand may update this Privacy Policy periodically. You are encouraged to review this page for the latest updates.</p>
        <p>By continuing to use our platform, you consent to the terms of this Privacy Policy.</p>
        
        <h4>Closing Remarks</h4>
        <p>By agreeing to these terms and conditions and our privacy policy, you ensure that you are committed to contributing to the goals of GOODLand responsibly and with integrity. Thank you for joining our community!</p>
      </div>
    `,
    showConfirmButton: false,
    showCloseButton: true,
   
    width: 700 // Optional: Adjust width if needed
    
    
  });
});

</script>

</body>
</html>
