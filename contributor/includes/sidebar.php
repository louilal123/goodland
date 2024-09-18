
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
                    <a href="dashboard.php" class="nav-link <?= $page == 'dashboard.php' ? ' bg-subtle text-info' : '' ?>">
                        <i class="nav-icon fas fa-dashboard"></i>
                        <p class="text">Overview</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="upload_file.php" class="nav-link <?= $page == 'upload_file.php' ? ' bg-subtle text-info' : '' ?>">
                        <i class="nav-icon fas fa-arrow-up"></i>
                        <p>New File</i></p>
                    </a>
                  
                </li>
                
                <li class="nav-header">Manage</li>
                
                <li class="nav-item">
                    <a href="#" class="nav-link <?= in_array($page, ['file_archive.php', 'file_published.php', 'file_unpublished.php']) ? ' bg-subtle text-info' : '' ?>">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>Manage Files<i class="nav-arrow fas fa-chevron-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="published.php" class="nav-link <?= $page == 'published.php' ? ' bg-subtle text-info' : '' ?>">
                                <i class="nav-icon fas fa-check-circle"></i>
                                <p>Pending Files</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="approved_files.php" class="nav-link <?= $page == 'approved_files.php' ? ' bg-subtle text-info' : '' ?>">
                                <i class="nav-icon fas fa-times-circle"></i>
                                <p>Approved Files</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="declined_files.php" class="nav-link <?= $page == 'declined_files.php' ? ' bg-subtle text-info' : '' ?>">
                                <i class="nav-icon fas fa-times-circle"></i>
                                <p>Declined Files</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="recently_deleted.php" class="nav-link <?= $page == 'recently_deleted.php' ? ' bg-subtle text-info' : '' ?>">
                                <i class="nav-icon fas fa-trash"></i>
                                <p>Recently Deleted</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a href="#" class="nav-link <?= in_array($page, ['file_history.php', 'file_recent_activity.php']) ? ' bg-subtle text-info' : '' ?>">
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
