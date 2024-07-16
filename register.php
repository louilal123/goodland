<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<?php include "includes/header.php"; ?>
<link rel="stylesheet" href="mdbfolder/mdb.min.css">
<link rel="stylesheet" href="assets/style.css">

<body class="index-page">
    <?php include "includes/topnav.php"; ?>

    <main class="main">
        <section class="services section">
            <div class="container">
                <div class="row">
                    <!-- Add Login Form Here -->
                    <div class="col-md-6 offset-md-3 mt-3 mb-5">
                        <!-- Material form login -->
                        <div class="card">
                            <h2 class="card-header info-color white-text text-center py-4 mb-2">
                                <strong>Sign Up</strong>
                            </h2>

                            <!--Card content-->
                            <div class="card-body px-lg-5 pt-0">
                                <form style="color: #757575;" action="classes/signup.php" method="post">
                                    <div class="md-form mb-3">
                                        <label for="materialLoginFormFullname">Fullname</label>
                                        <input type="text" id="materialLoginFormFullname" class="form-control 
                                        <?php 
                                            if (!empty($_SESSION['error_fullname'])) {
                                                echo 'is-invalid';
                                            } elseif (!empty($_SESSION['form_data']['fullname'])) {
                                                echo 'is-valid';
                                            }
                                        ?>" name="fullname" 
                                        value="<?php echo $_SESSION['form_data']['fullname'] ?? ''; ?>">
                                        <?php if (!empty($_SESSION['error_fullname'])): ?>
                                            <div class="invalid-feedback mb-4"><?php echo $_SESSION['error_fullname']; unset($_SESSION['error_fullname']); ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="md-form mb-3">
                                        <label for="materialLoginFormEmail">E-mail</label>
                                        <input type="email" id="materialLoginFormEmail" class="form-control 
                                        <?php 
                                            if (!empty($_SESSION['error_email'])) {
                                                echo 'is-invalid';
                                            } elseif (!empty($_SESSION['form_data']['email'])) {
                                                echo 'is-valid';
                                            }
                                        ?>" name="email"
                                        value="<?php echo $_SESSION['form_data']['email'] ?? ''; ?>">
                                        <?php if (!empty($_SESSION['error_email'])): ?>
                                            <div class="invalid-feedback mb-4"><?php echo $_SESSION['error_email']; unset($_SESSION['error_email']); ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="md-form mb-3">
                                        <label for="materialLoginFormBirthday">Birthday</label>
                                        <input type="date" id="materialLoginFormBirthday" class="form-control 
                                        <?php 
                                            if (!empty($_SESSION['error_birthday'])) {
                                                echo 'is-invalid';
                                            } elseif (!empty($_SESSION['form_data']['bday'])) {
                                                echo 'is-valid';
                                            }
                                        ?>" name="bday"
                                        value="<?php echo $_SESSION['form_data']['bday'] ?? ''; ?>">
                                        <?php if (!empty($_SESSION['error_birthday'])): ?>
                                            <div class="invalid-feedback mb-4"><?php echo $_SESSION['error_birthday']; unset($_SESSION['error_birthday']); ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="md-form mb-3">
                                        <label for="materialLoginFormUsername">Username</label>
                                        <input type="text" id="materialLoginFormUsername" class="form-control 
                                        <?php 
                                            if (!empty($_SESSION['error_username'])) {
                                                echo 'is-invalid';
                                            } elseif (!empty($_SESSION['form_data']['username'])) {
                                                echo 'is-valid';
                                            }
                                        ?>" name="username"
                                        value="<?php echo $_SESSION['form_data']['username'] ?? ''; ?>">
                                        <?php if (!empty($_SESSION['error_username'])): ?>
                                            <div class="invalid-feedback mb-4"><?php echo $_SESSION['error_username']; unset($_SESSION['error_username']); ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="md-form mb-3">
                                        <label for="materialLoginFormPassword">Password</label>
                                        <input type="password" id="materialLoginFormPassword" class="form-control 
                                        <?php 
                                            if (!empty($_SESSION['error_password'])) {
                                                echo 'is-invalid';
                                            } elseif (!empty($_SESSION['form_data']['pswd'])) {
                                                echo 'is-valid';
                                            }
                                        ?>" name="pswd"
                                        value="<?php echo $_SESSION['form_data']['pswd'] ?? ''; ?>">
                                        <?php if (!empty($_SESSION['error_password'])): ?>
                                            <div class="invalid-feedback mb-4"><?php echo $_SESSION['error_password']; unset($_SESSION['error_password']); ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="md-form mb-3">
                                        <label for="materialLoginFormConfirmPassword">Confirm Password</label>
                                        <input type="password" id="materialLoginFormConfirmPassword" class="form-control 
                                        <?php 
                                            if (!empty($_SESSION['error_confirm_password'])) {
                                                echo 'is-invalid';
                                            } elseif (!empty($_SESSION['form_data']['cpswd'])) {
                                                echo 'is-valid';
                                            }
                                        ?>" name="cpswd"
                                        value="<?php echo $_SESSION['form_data']['cpswd'] ?? ''; ?>">
                                        <?php if (!empty($_SESSION['error_confirm_password'])): ?>
                                            <div class="invalid-feedback mb-4"><?php echo $_SESSION['error_confirm_password']; unset($_SESSION['error_confirm_password']); ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-block z-depth-0 mb-2 mt-4" data-mdb-ripple-init>Signup</button>

                                    <p class="text-center py-2">Already have an account?
                                        <a href="get-started">Signin</a>
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
      $(function() {
    var dtToday = new Date();
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();

    if (month < 10) month = '0' + month.toString();
    if (day < 10) day = '0' + day.toString();

    var maxDate = year + '-' + month + '-' + day;
    $('#materialLoginFormBirthday').attr('max', maxDate);
});

    </script>
</body>
</html>
