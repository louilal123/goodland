<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "includes/header.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="mdbfolder/mdb.min.css">
</head>

<style>
    .custom-btn:hover {
        background-color: var(--accent-color) !important;
        color: var(--contrast-color) !important;
    }
    .header, .footer, .background-video-container {
        display: none !important;
    }
    .section {
        background-color: #161616;
    }
</style>

<body class="index-page">
    <?php include "includes/topnav.php"; ?>

    <main class="main">
        <!-- Hero Section -->
        <section id="hero" class="hero section">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        <h1 data-aos="fade-down">Contributor - Sign Up</h1>
                        <p data-aos="fade-right" data-aos-delay="100">Join us in making a difference by sharing valuable resources and insights with the community.</p>
                        <p data-aos="fade-right text-light" data-aos-delay="100">Already have an account?</p>
                        <div class="d-flex flex-column flex-md-row" data-aos="fade-up" data-aos-delay="200">
                            <a class="btn btn-outline-info btn-rounded btn-lg custom-btn" href="c-login">Login</a>
                        </div>
                    </div>
                    <div class="col-lg-6 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="100">
                        <!-- Sign Up Form -->
                        <div class="card" style="border-radius: 1rem; background-color: #060606 !important; opacity: 0.9;">
                            <div class="p-4 text-center">
                                <img src="assets/img/logogoodland.png" style="width: 150px; height: 50px;">
                                <h5 class="mb-5 mt-1 text-white">Please fill the fields.</h5>
                                <form action="classes/process-signup.php" method="post">
                                    <!-- Name Field -->
                                    <div data-mdb-input-init class="form-outline form-white opacity-75 mb-4">
                                        <input type="text" name="name" class="form-control form-control-lg <?php echo !empty($_SESSION['name_err']) ? 'is-invalid' : ''; ?>" />
                                        <label class="form-label" for="typeNameX-2">Name</label>
                                        <?php if (!empty($_SESSION['name_err'])): ?>
                                            <div class="invalid-feedback"><?php echo $_SESSION['name_err']; unset($_SESSION['name_err']); ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Email Field -->
                                    <div data-mdb-input-init class="form-outline form-white opacity-75 mb-4">
                                        <input type="text" name="email" class="form-control form-control-lg <?php echo !empty($_SESSION['email_err']) ? 'is-invalid' : ''; ?>" />
                                        <label class="form-label" for="typeEmailX-2">Email</label>
                                        <?php if (!empty($_SESSION['email_err'])): ?>
                                            <div class="invalid-feedback"><?php echo $_SESSION['email_err']; unset($_SESSION['email_err']); ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Password Field -->
                                    <div data-mdb-input-init class="form-outline form-white opacity-75 mb-4">
                                        <input type="password" name="password" class="form-control form-control-lg <?php echo !empty($_SESSION['password_err']) ? 'is-invalid' : ''; ?>" />
                                        <label class="form-label" for="typePasswordX-2">Password</label>
                                        <?php if (!empty($_SESSION['password_err'])): ?>
                                            <div class="invalid-feedback"><?php echo $_SESSION['password_err']; unset($_SESSION['password_err']); ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Password Confirmation Field -->
                                    <div data-mdb-input-init class="form-outline form-white opacity-75 mb-4">
                                        <input type="password" name="password_confirmation" class="form-control form-control-lg <?php echo !empty($_SESSION['confirm_password_err']) ? 'is-invalid' : ''; ?>" />
                                        <label class="form-label" for="typePasswordX-2">Repeat Password</label>
                                        <?php if (!empty($_SESSION['confirm_password_err'])): ?>
                                            <div class="invalid-feedback"><?php echo $_SESSION['confirm_password_err']; unset($_SESSION['confirm_password_err']); ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <button data-mdb-input-init class="btn btn-info btn-lg btn-block" type="submit">Signup</button>
                                </form>
                            </div>
                        </div>
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
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('input.form-control');

    inputs.forEach(input => {
        input.addEventListener('input', function() {
            const feedback = input.parentNode.querySelector('.invalid-feedback');

            if (input.value.trim() !== '') {
                input.classList.add('is-valid');
                input.classList.remove('is-invalid');

                if (feedback) {
                    feedback.style.display = 'none';
                }
            } else {
                input.classList.remove('is-valid');

                // Show the feedback again if it's empty and the error exists
                if (feedback) {
                    feedback.style.display = 'block';
                }
            }
        });
    });
});
</script>

</body>
</html>
