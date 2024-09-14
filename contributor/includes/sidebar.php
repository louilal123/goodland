
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
                    <a href="dashboard" class="nav-link <?= $page == 'dashboard.php' ? 'bg-info text-light' : '' ?>">
                        <i class="nav-icon fas fa-dashboard"></i>
                        <p class="text">Overview</p>
                    </a>
                </li>
                
                <li class="nav-header">Manage</li>
                
                <li class="nav-item">
                    <a href="#" class="nav-link <?= in_array($page, ['file_archive.php', 'file_published.php', 'file_unpublished.php']) ? 'bg-info text-light' : '' ?>">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>Manage Files<i class="nav-arrow fas fa-chevron-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="file_archive" class="nav-link <?= $page == 'file_archive.php' ? 'bg-info text-light' : '' ?>">
                                <i class="nav-icon fas fa-archive"></i>
                                <p>Archived Files</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="file_published" class="nav-link <?= $page == 'file_published.php' ? 'bg-info text-light' : '' ?>">
                                <i class="nav-icon fas fa-check-circle"></i>
                                <p>Published Files</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="file_unpublished" class="nav-link <?= $page == 'file_unpublished.php' ? 'bg-info text-light' : '' ?>">
                                <i class="nav-icon fas fa-times-circle"></i>
                                <p>Unpublished Files</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a href="#" class="nav-link <?= in_array($page, ['file_history.php', 'file_recent_activity.php']) ? 'bg-info text-light' : '' ?>">
                        <i class="nav-icon fas fa-history"></i>
                        <p>History<i class="nav-arrow fas fa-chevron-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="file_history" class="nav-link <?= $page == 'file_history.php' ? 'bg-info text-light' : '' ?>">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Document History</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="file_recent_activity" class="nav-link <?= $page == 'file_recent_activity.php' ? 'bg-info text-light' : '' ?>">
                                <i class="nav-icon fas fa-clock"></i>
                                <p>Recent Activity</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a href="settings" class="nav-link <?= $page == 'settings.php' ? 'bg-info text-light' : '' ?>">
                        <i class="nav-icon fas fa-gear"></i>
                        <p class="text">Settings</p>
                    </a>
                </li>
            </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
</aside> <!--end::Sidebar-->
