<style>
     .main-blur {
    background: rgba(108, 117, 125, 0.1); 
}

</style>
<?php $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/")+1); ?>
<aside class="app-sidebar bg-body-light" data-bs-theme="light"> 
            <div class="sidebar-brand bg-light" style="border: 2px #f0f0f; margin-top:2px;"> 
                 <a href="../index.html" class="brand-link"> 
                    <!-- admin/ -->
                    <img src="uploads/image.png" alt="AdminLTE Logo" class="brand-images shadow rounded" 
                    style=" width: 2rem ; height: 2rem; border-radius: 100px !important; "> 
                    <span class="brand-text">
                <span class="fw-bold text-info">GOOD</span><span class="fw-light text-info">Land</span>
            </span> <!--end::Brand Text-->    
                  
                 </a> <!--end::Brand Link--> </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
            <div class="sidebar-wrapper">
                <nav class="mt-2"> <!--begin::Sidebar Menu-->
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                        <li class="nav-item"> <a href="dashboard" class="nav-link active<?= $page == 'dashboard.php' ? '  bg-primary text-light  ':'' ?>"> <i class="nav-icon fas fa-dashboard"></i>
                                <p class="text">Dashboard</p>
                            </a> </li>
                            <li class="nav-header">Manage</li>
                        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon fas fa-folder"></i>
                                <p>
                                    Manage Files
                                    <i class="nav-arrow fas fa-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ">
                               
                                <li class="nav-item"> <a href="pending_files" class="nav-link <?= $page == 'pending_files.php' ? '  bg-primary text-light  ':'' ?>"> 
                                    <i class="nav-icon fas fa-hourglass"></i>
                                        <p>Pending Files</p>
                                    </a> </li>
                                <li class="nav-item"> <a href="approved_files" class="nav-link <?= $page == 'approved_files.php' ? '  bg-primary text-light  ':'' ?>"> 
                                    <i class="nav-icon fas fa-circle"></i>
                                        <p>Approved Files</p>
                                    </a> </li>
                                <li class="nav-item"> <a href="declined_files" class="nav-link <?= $page == 'declined_files.php' ? '  bg-primary text-light  ':'' ?>"> 
                                    <i class="nav-icon fas fa-x"></i>
                                        <p>Declined Files</p>
                                    </a> </li>
                              
                                <li class="nav-item"> <a href="recyled_files" class="nav-link  <?= $page == 'recycled_files.php' ? '  bg-primary text-light  ':'' ?>"> 
                                    <i class="nav-icon fas fa-bin"></i>
                                        <p>Recycled Files</p>
                                </a> </li>
                            </ul>
                        </li>
                        <li class="nav-item"> <a href="downloads" class="nav-link <?= $page == 'downloads.php' ? '  bg-primary text-light  ':'' ?>"> 
                            <i class="nav-icon fas fa-download"></i>
                                <p class="text">List of Downloads</p>
                            </a> </li>
                        <li class="nav-item"> <a href="manageusers" class="nav-link <?= $page == 'manageusers.php' ? '  bg-primary text-light  ':'' ?>"> 
                            <i class="nav-icon fas fa-users"></i>
                                <p class="text">List of Contributors</p>
                            </a> </li>
                        <li class="nav-item"> <a href="visitors" class="nav-link <?= $page == 'visitors.php' ? '  bg-primary text-light  ':'' ?>"> 
                            <i class="nav-icon fas fa-eye"></i>
                                <p class="text">List of Visitors</p>
                            </a> </li>
                            <li class="nav-item"> <a href="contributors" class="nav-link <?= $page == 'contributors.php' ? '  bg-primary text-light  ':'' ?>"> 
                            <i class="nav-icon fas fa-users"></i>
                                <p class="text">List of Users</p>
                            </a> </li>
                        <li class="nav-item"> <a href="manageadmins" class="nav-link <?= $page == 'manageadmins.php' ? '  bg-primary text-light  ':'' ?>"> 
                            <i class="nav-icon fas fa-users"></i>
                                <p class="text">List of Admins</p>
                            </a> </li>
                            <li class="nav-item"> <a href="settings" class="nav-link <?= $page == 'reports.php' ? '  bg-primary text-light  ':'' ?>"> 
                            <i class="nav-icon fas fa-folder"></i>
                                <p class="text">Manage Reports</p>
                            </a> </li>
                          
                        <li class="nav-item"> <a href="settings" class="nav-link <?= $page == 'settings.php' ? '  bg-primary text-light  ':'' ?>"> 
                            <i class="nav-icon fas fa-gear"></i>
                                <p class="text">Settings</p>
                            </a> </li>
                    </ul> <!--end::Sidebar Menu-->
                </nav>
            </div> <!--end::Sidebar Wrapper-->
        </aside> <!--end::Sidebar-->