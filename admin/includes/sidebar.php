<style>
/* Sidebar Styling */
.app-sidebar {
    top: 0;
    left: 0;
    width: 250px;
    height: 100%;
    background-color: #343a40;
    color: #fff;
    padding-bottom: 15px;
    z-index: 1000 !important;
    padding-left: 12px;
    padding-right: 20px;
}

.sidebar-brand {
    display: flex;
    align-items: center;
    padding: 10px 10px;
    text-decoration: none !important;
    
}
.brand-link{
    text-decoration: none !important;
}

.sidebar-brand .brand-link {
    display: flex;
    align-items: center;
    color: #fff;
    text-decoration: none;
}

.sidebar-brand .brand-image {
    height: 35px;
    width: 35px;
    border-radius: 50%;
    margin-right: 8px;
}

.sidebar-brand .brand-text {
    font-size: 1.5rem;
    font-weight: bold;
}

.sidebar-wrapper {
    margin-top: 20px;
    z-index: 0;
}

.nav.sidebar-menu {
    list-style: none;
    padding: 0;
}

.nav-item1 {
    margin-bottom: 8px;
   
}

.nav-link12 {
    display: flex;
    align-items: center;
    padding-left: 8px;
    padding-top: 8px;
    padding-bottom: 8px;
    padding-right: 0px; 
    color: #adb5bd;
    text-decoration: none;
    border-radius: 4px; 
    transition: background-color 0.3s, color 0.3s;
    /* font-size: 1.25rem; */
    /* opacity: 0.6; */
}

.nav-link12:hover {
    background-color: #495057;
    color: #fff;
}

.nav-link12.active {
    color: #fff;
    opacity: none !important;
    
}

.nav-link12 .icons {
    margin-right: 10px;
    font-size: 1rem;
}

.nav-header {
    margin: 10px 0 5px;
    font-size: 0.75rem;
    opacity: 0.7;
    color: #6c757d;
    text-transform: uppercase;
    padding-left: 12px;
}
.nav-arrow{
    margin-left: 4px;
}

.p-tag {
    margin: 0;
    font-size: 0.75rem;
    opacity: 0.7;
    color: white;
    text-transform: uppercase;
}

.nav-header, .nav-item1 .nav-link12, .nav-link12 .icon .logoo {
    color: #fff !important;
}

</style>
<?php  $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/")+1); ?>

<aside class="app-sidebar bg-body-light shadow" data-bs-theme="light">
    <div class="sidebar-brand">
        <a href="" class="brand-link active">
            <img src="uploads/image.png" alt="Logo" class="brand-image shadow" style="width: 34px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3), 0 6px 20px rgba(0, 0, 0, 0.2) !important;">
            <h3 class="brand-text text-start  logoo shadow mt-2 fw-light" style="color: #ffff !important;">Good<i>Land</i></h3>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column">
                <li class="nav-item1">
                    <a href="dashboard" class="nav-link12 text-bold <?= $page == 'dashboard.php' ? ' active text-bg-primary text-light':'' ?>">
                        <i class="icons bi bi-ui-checks-grid"></i>
                        <p class="p-tag">Dashboard</p>
                    </a>
                </li>
                <li class="nav-header">Manage</li>
                <li class="nav-item1">
                    <a href="pending_files" class="nav-link12 <?= $page == 'pending_files.php' ? ' active text-bg-primary text-light':'' ?>">
                        <i class="icons bi bi-hourglass-split"></i>
                        <p class="p-tag">Manage Pending Files</p>
                    </a>
                  
                </li>
                
                <li class="nav-item1">
                    <a href="approved_files" class="nav-link12 <?= $page == 'approved_files.php' ? ' active text-bg-primary text-light':'' ?>">
                        <i class="icons bi bi-check-circle-fill"></i>
                        <p class="p-tag">Manage Approved Files</p>
                    </a>
                </li>

                <li class="nav-item1">
                    <a href="declined_files" class="nav-link12 <?= $page == 'declined_files.php' ? ' active text-bg-primary text-light':'' ?>">
                        <i class="icons bi bi-x-circle-fill"></i>
                        <p class="p-tag">Manage Declined Files</p>
                    </a>
                  
                </li>

                <li class="nav-item1">
                    <a href="recycled_files" class="nav-link12 <?= $page == 'recycled_files.php' ? ' active text-bg-primary text-light':'' ?>">
                        <i class="icons bi bi-trash-fill"></i>
                        <p class="p-tag">Manage Recycled Files</p>
                    </a>
                  
                </li>

                <li class="nav-item1">
                    <a href="manageevents" class="nav-link12 <?= $page == 'manageevents.php' ? ' active text-bg-primary text-light':'' ?>">
                        <i class="icons bi bi-calendar-fill"></i>
                        <p class="p-tag">List of Events  <i class="nav-arrow bi bi-chevron-right" style="margin-left: 45px;"></i></p>
                    </a>
                </li>
             
                <li class="nav-item1">
                    <a href="manageusers" class="nav-link12 <?= $page == 'manageusers.php' ? ' active text-bg-primary text-light':'' ?>">
                        <i class="icons bi bi-people"></i>
                        <p class="p-tag">List of Users</p>
                    </a>
                </li>
                

                <li class="nav-item1">
                    <a href="manageadmins" class="nav-link12 <?= $page == 'manageadmins.php' ? ' active text-bg-primary text-light':'' ?>">
                        <i class="icons bi bi-people"></i>
                        <p class="p-tag">List of Admins</p>
                    </a>
                </li>
                <li class="nav-header">Reports</li>
                <li class="nav-item1">
                    <a href="managereports" class="nav-link12 <?= $page == 'managereports.php' ? ' active text-bg-primary text-light':'' ?>">
                        <i class="icons bi bi-file-earmark-text"></i>
                        <p class="p-tag">Reports</p>
                    </a>
                </li>
                <li class="nav-header">Maintenance</li>
                <li class="nav-item1">
                    <a href="managesettings" class="nav-link12 <?= $page == 'managesettings.php' ? ' active text-bg-primary text-light':'' ?>">
                        <i class="icons bi bi-gear"></i>
                        <p class="p-tag">Settings</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
