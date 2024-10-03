<style>
    .app-main{
    background: rgba(108, 117, 125, 0.2) !important; 
}

</style>
<nav class="app-header navbar navbar-expand bg-white" > <!--begin::Container-->
                <div class="container-fluid" style="border: 0px !important;"> <!--begin::Start Navbar Links-->
                    <ul class="navbar-nav">
                        <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> <i class="fas fa-bars"></i> </a> </li>
                        <li class="nav-item d-none d-md-block"> <a href="#" class="nav-link"></a> </li>
                       
                    </ul>
        <ul class="navbar-nav ms-auto">
          


            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="<?php echo htmlspecialchars($adminDetails['admin_photo']) ?: 'default_photo.jpg'; ?>" class="user-image rounded-circle shadow" style="width: 40px; height: 40px;">
                    <span class="d-none d-md-inline"> <?php echo htmlspecialchars($adminDetails['fullname']); ?></span> 
                    <i class="fas fa-chevron-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end" style="width: 300px !important;">
                    <li class="d-flex flex-column align-items-center text-center">
                        <a class="dropdown-item text-center mt-2" href="#">
                            <img class="logo" src="<?php echo htmlspecialchars($adminDetails['admin_photo']) ?: 'default_photo.jpg'; ?>" style="width: 70px; height: 70px; border-radius: 50%;">
                            <h4 class="mt-2 mb-0"><small><?php echo htmlspecialchars($adminDetails['fullname']); ?></small></h4>
                            <p class="mt-2 mb-0"><small><?php echo htmlspecialchars($adminDetails['role']); ?></small></p>
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-start" href="profile.php"><i class="bi bi-person"></i> Profile</a></li>
                    <li><a class="dropdown-item mb-2" href="classes/logout.php"><i class="bi bi-power"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header text-bg-danger">
                <h4 class="modal-title" id="addItemModalLabel">Confirm Logout</h4>
            </div>
            <div class="modal-body">
                <h4>Are you sure you want to logout?</h4>
                <div class="modal-footer mt-4">
                    <button type="button" class="btn btn-secondary btn-outline-danger custombtn" data-bs-dismiss="modal">Cancel</button>
                    <a href="classes/logout.php" class="btn btn-danger btn-outline">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>
