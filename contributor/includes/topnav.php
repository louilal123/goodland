<style>
    .nav-link.active {
        background-color: #262626 !important;
       color: #17a2b8 !important;
       font-weight: bold !important;
        border-color: #17a2b8 !important;
    }
    .nav-link:hover {
    background-color: #262626 !important; /* Changes to a blue background on hover */
    color: #17a2b8 !important; /* Ensures the text stays readable */
    border-color: #17a2b8 !important;
}
    .btn-info{
        background-color: #17a2b8 !important;  /* Change to your preferred color */
        color: white !important;
        font-weight: bold !important;
        border-color: #17a2b8 !important;
    }
 
  
    /* .app-main{
    background: rgba(108, 117, 125, 0.1) !important; 
} */
</style>
<nav class="app-header navbar navbar-expand bg-white opacity-90" > <!--begin::Container-->
                <div class="container-fluid" style="border: 0px !important;"> <!--begin::Start Navbar Links-->
                    <ul class="navbar-nav">
                        <li class="nav-item"> <a class="nav-link text-black" data-lte-toggle="sidebar" href="#" role="button"> <i class="fas fa-bars"></i> </a> </li>
                        <li class="nav-item d-none d-md-block"> <a href="#" class="nav-link text-black"></a> </li>
                       
                    </ul>
                    <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="uploads/<?php echo $user_details['user_photo']; ?>" class="user-image rounded-circle shadow" style="width: 40px; height: 40px;">
                            <span class="d-none d-md-inline"> <?php echo $user_details['username']; ?></span> 
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end" style="width: 300px !important;">
                            <li><a class="dropdown-item text-start" href="profile.php"><i class="bi bi-person"></i> Profile</a></li>
                            <li><a class="dropdown-item mb-2" href="classes/logout.php"><i class="bi bi-power"></i> Logout</a></li>
                        </ul>
                    </li>
      </ul>
                </div> <!--end::Container-->
            </nav> <!--end::Header--> <!--begin::App Main-->