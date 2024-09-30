
<?php $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1); ?>
<aside class="app-sidebar bg-black" data-bs-theme="dark"> 
    <div class="sidebar-brand bg-black" style="border: 2px #f0f0f; margin-top:2px;"> 
        <a href="../index.html" class="brand-link"> 
        <img src="../admin/uploads/landingbg.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow rounded" 
        style=" width: 2.5rem ; height: 2rem;border-radius: 100% "> 
            <span class="brand-text">
                <span class="fw-bold text-white">GOOD</span><span class="fw-light text-white">Land</span>
            </span> <!--end::Brand Text--> 
        </a> <!--end::Brand Link--> 
    </div> <!--end::Sidebar Brand-->
    
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="dashboard" class="nav-link <?= $page == 'dashboard.php' ? ' bg-subtle text-info' : '' ?>">
                        <i class="nav-icon fas fa-dashboard"></i>
                        <p class="text">Overview</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="upload_file" class="nav-link <?= $page == 'upload_file.php' ? ' bg-subtle text-info' : '' ?>">
                        <i class="nav-icon fas fa-arrow-up"></i>
                        <p>New File</i></p>
                    </a>
                  
                </li>
                
                <li class="nav-header">Manage</li>
                
                <li class="nav-item">
                    <a href="all_files" class="nav-link <?= $page == 'all_files.php' ? ' bg-subtle text-info' : '' ?>">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>Manage Files</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="history" class="nav-link <?= $page == 'history.php' ? ' bg-subtle text-info' : '' ?>">
                        <i class="nav-icon fas fa-history"></i>
                        <p>History</i></p>
                    </a>
                  
                </li>
                
                <li class="nav-item">
                    <a href="settings" class="nav-link <?= $page == 'settings.php' ? ' bg-subtle text-info' : '' ?>">
                        <i class="nav-icon fas fa-gear"></i>
                        <p class="text">Settings</p>
                    </a>
                </li>
            </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
</aside> <!--end::Sidebar-->
