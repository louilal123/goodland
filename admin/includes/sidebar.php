<style>
    .main{
    background: rgba(108, 117, 125, 0.5) !important; 
}
.sidebar-wrapper {
        padding: 0; /* Remove any padding */
        margin: 0; /* Remove any margin */
    }

    .nav-sidebar {
        padding: 0; /* Ensure no padding on the sidebar */
    }
.nav-link {
        border-radius: 0 !important; /* Remove rounded edges */
        display: block; /* Ensure the link behaves like a block element */
        width: 100%; /* Occupy full width */
    }
    .sidebar-wrapper.collapsed .nav-link {
        padding: 0 rem; /* Adjust padding when collapsed to minimize space */
    }
 

</style>

<?php $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/")+1); ?>
<aside class="app-sidebar bg-dark" data-bs-theme="dark"> 
            <div class="sidebar-brand  " > 
                 <a href="" class="brand-link"> 
                    <!-- admin/ -->
                    <img src="uploads/image.png" alt="AdminLTE Logo" class="brand-images shadow rounded" 
                    style=" width: 2rem ; height: 2rem; border-radius: 100px !important; "> 
                    <span class="brand-text">
                        <span class="fw-bold text-light">GOOD</span><i class="fw-light text-light">Land</i>
                    </span> <!--end::Brand Text-->  
                 </a> <!--end::Brand Link--> 
            </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
            <div class="sidebar-wrapper">
                <nav class="mt-4"> <!--begin::Sidebar Menu-->
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                        <li class="nav-item pb-1"> <a href="dashboard" class="nav-link text-light  <?= $page == 'dashboard.php' ? '  bg-primary  ':'' ?>"> <i class="nav-icon fas fa-dashboard"></i>
                                <p class="text-light">Dashboard</p>
                            </a> </li>
                            <li class="nav-item pb-1"> <a href="water_data" class="nav-link text-light  <?= $page == 'water_data.php' ? '  bg-primary  ':'' ?>"> 
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p class="text-light">Water Level Data</p>
                            </a> </li>
                            <li class="nav-header text-light">Manage</li>
                        <li class="nav-item pb-1"> <a href="#" class="nav-link text-light "> <i class="nav-icon fas fa-folder"></i>
                                <p>
                                    Manage Files
                                    <i class="nav-arrow fas fa-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ">
                               
                                <li class="nav-item"> <a href="pending_files" class="nav-link text-light  <?= $page == 'pending_files.php' ? '
                                  bg-primary  ':'' ?>"> 
                                    <i class="nav-icon fas fa-hourglass"></i>
                                        <p>Pending Files</p>
                                    </a> </li>
                                <li class="nav-item"> <a href="approved_files" class="nav-link text-light  <?= $page == 'approved_files.php' ? '  bg-primary  ':'' ?>"> 
                                    <i class="nav-icon fas fa-circle"></i>
                                        <p>Approved Files</p>
                                    </a> </li>
                                <li class="nav-item"> <a href="declined_files" class="nav-link text-light  <?= $page == 'declined_files.php' ? '  bg-primary  ':'' ?>"> 
                                    <i class="nav-icon fas fa-x"></i>
                                        <p>Declined Files</p>
                                    </a> </li>
                              
                                <li class="nav-item"> <a href="archived_files.php" class="nav-link text-light   <?= $page == 'archived_files.php' ? '  bg-primary  ':'' ?>"> 
                                    <i class="nav-icon fas fa-book"></i>
                                        <p>Archived Files</p>
                                </a> </li>
                            </ul>
                        </li>
                        <li class="nav-item pb-1"> <a href="downloads" class="nav-link text-light  <?= $page == 'downloads.php' ? '  bg-primary  ':'' ?>"> 
                            <i class="nav-icon fas fa-download"></i>
                                <p class="text-light">List of Projects</p>
                            </a> </li>
                        <li class="nav-item pb-1"> <a href="manageusers" class="nav-link text-light  <?= $page == 'manageusers.php' ? '  bg-primary  ':'' ?>"> 
                            <i class="nav-icon fas fa-users"></i>
                                <p class="text-light">List of Contributors</p>
                            </a> </li>
                        <li class="nav-item pb-1"> <a href="visitors" class="nav-link text-light  <?= $page == 'visitors.php' ? '  bg-primary  ':'' ?>"> 
                            <i class="nav-icon fas fa-eye"></i>
                                <p class="text-light">List of Visitors</p>
                            </a> </li>
                            <li class="nav-item pb-1"> <a href="messages" class="nav-link text-light  <?= $page == 'messages.php' ? '  bg-primary  ':'' ?>"> 
                            <i class="nav-icon fas fa-envelope fa-lg"></i>
                                <p class="text-light">List of Messages</p>
                            </a> </li>
                        <li class="nav-item pb-1"> <a href="manageadmins" class="nav-link text-light  <?= $page == 'manageadmins.php' ? '  bg-primary  ':'' ?>"> 
                            <i class="nav-icon fas fa-users"></i>
                                <p class="text-light">List of Admins</p>
                            </a> </li>
                            <li class="nav-item pb-1"> <a href="settings" class="nav-link text-light  <?= $page == 'reports.php' ? '  bg-primary  ':'' ?>"> 
                            <i class="nav-icon fas fa-folder"></i>
                                <p class="text-light">Manage Reports</p>
                            </a> </li>
                          
                        <li class="nav-item pb-1"> <a href="settings" class="nav-link text-light  <?= $page == 'settings.php' ? '  bg-primary  ':'' ?>"> 
                            <i class="nav-icon fas fa-gear"></i>
                                <p class="text-light">Settings</p>
                            </a> </li>
                    </ul> <!--end::Sidebar Menu-->
                </nav>
            </div> <!--end::Sidebar Wrapper-->
        </aside> <!--end::Sidebar-->