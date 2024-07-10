<?php
session_start();
$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1);
?>

<style>
    .itemsnav{
        font-size: 18px !important;
    }
</style>

<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center me-auto me-lg-0">
            <h4 class="sitename" style="color: #fff !important; padding-top: 5px;"><strong>GOOD</strong><i>Land</i></h4>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="index" class="itemsnav <?= $page == 'index.php' ? 'active' : '' ?>">HOME</a></li>
                <li><a href="aboutus" class="itemsnav <?= $page == 'aboutus.php' ? 'active' : '' ?>">ABOUT US</a></li>
                <li><a href="projects" class="itemsnav <?= $page == 'projects.php' ? 'active' : '' ?>">PROJECTS</a></li>
                <li><a href="methodology" class="itemsnav <?= $page == 'methodology.php' ? 'active' : '' ?>">METHODOLOGY</a></li>
                <li><a href="stories" class="itemsnav <?= $page == 'stories.php' ? 'active' : '' ?>">STORIES</a></li>
                <li><a href="library" class="itemsnav <?= $page == 'library.php' ? 'active' : '' ?>">RESOURCES</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true): ?>
            <!-- User Dropdown -->
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" style="margin-top: -15px;">
                    <img src="<?= $_SESSION['user_photo'] ?: 'uploads/basket.jpg'; ?>" class="user-image rounded-circle shadow" style="width: 40px; height: 40px;">
                    <span class="d-none d-md-inline text-light "><?= $_SESSION['user_fullname']; ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end bg-light" style="width: 300px !important; color: white;">
                    <li class="d-flex flex-column align-items-center text-center">
                        <a class="dropdown-item text-center mt-2" href="#" style="color: black;">
                        <img src="<?= $_SESSION['user_photo'] ?: 'uploads/basket.jpg'; ?>" style="width: 70px; height: 70px; border-radius: 50%;">
                            <h4 class="mt-2 mb-0 text-dark">Signed in as:</h4>
                            <h4 class="mt-2 mb-0 text-dark" ><small style="color: black;"><?= $_SESSION['user_fullname']; ?></small></h4>
                            <p class="mt-2 mb-0"><small style="color: black;"><?= $_SESSION['user_email']; ?></small></p>
                        </a>
                    </li>
                    <li><hr class="dropdown-divider" style="border-color: white;"></li>
                    <li><a class="dropdown-item text-start" href="profile.php" style="color: black;"><i class="bi bi-person"></i> Profile</a></li>
                    <li><a class="dropdown-item mb-2" href="classes/logout.php" style="color: black;"><i class="bi bi-power"></i> Logout</a></li>
                </ul>
            </li>
            <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
        <?php else: ?>
            <!-- Get Started Button -->
            <button type="button" class="btn btn-primary">
                <a href="get-started" style="color: white;">Get Started</a>
            </button>
        <?php endif; ?>
       </div>
    </div>
</header>
