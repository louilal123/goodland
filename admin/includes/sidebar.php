<style>
.app-sidebar {
    top: 0;
    left: 0;
    width: 100%; 
    height: 100%;
    /* background-color: #343a40; */
    /* color: black; */
    padding-bottom: 15px;
    z-index: 1000 !important;
    font-family: 'Roboto', sans-serif;
    transition: width 0.3s ease; 
}
.bg-primary1{
    padding-right: 0px !important;
    border-radius:0px;
    color: #fff !important;
}

.app-sidebar.collapsed {
    width: 80px; 
}

.sidebar-brand {
    display: flex;
    align-items: center;
    padding: 0 10px; 
    text-decoration: none !important;
}

/* .brand-link {
    text-decoration: none !important;
    display: flex;
    align-items: center;
    color: #fff;
} */

.brand-image {
    height: 35px;
    width: 35px;
    border-radius: 50%;
    margin-right: 8px;
}

.brand-text {
    font-size: 1.2rem; 
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

.nav-link12,
.nav-link123 {
    display: flex;
    align-items: center;
    padding: 8px 16px;
    /* color: #adb5bd; */
    text-decoration: none;
    border-radius: 4px;
    position: relative;
    transition: color 0.3s;
    font-family: 'Roboto', sans-serif; 
}

.nav-link12 .icons,
.nav-link123 .icons {
    margin-right: 0px;
    font-size: 16px; 
}

.nav-link12 .p-tag,
.nav-link123 .p-tag {
    font-size: 1rem; 
    margin-left: 16px; /* Adjust margin for text */
    flex-grow: 1;
}

.nav-link12::before,
.nav-link123::before {
    content: "";
    position: absolute;
    padding: 8px 16px;
    top: 50%;
    left: 0;
    right: 0;
    height: calc(100% - 4px); 
    transform: translateY(-50%);
    background-color: transparent;
    border-radius: 4px;
    z-index: -1;
    transition: background-color 0.3s;
}


.nav-header {
    margin: 10px 0 5px;
    font-size: 1rem;
    color: #fff;
    padding-left: 16px;
}

.nav-arrow {
    margin-left: auto;
}

.p-tag {
    margin: 0;
    font-size: 1rem;
}

.nav-header, .nav-item1 .nav-link12, .nav-link12 .icon .logoo {
    /* color: #333 !important; */
}

.collapse .nav-link12 {
    padding-left: 70px; 
}

.collapse.show {
    display: block !important;
}

.app-sidebar.collapsed .nav-link12 .p-tag,
.app-sidebar.collapsed .nav-link123 .p-tag,
.app-sidebar.collapsed .nav-header {
    display: none;
}

.app-sidebar.collapsed .nav-link12,
.app-sidebar.collapsed .nav-link123 {
    padding: 8px 16px; 
    margin-left: 12px;
}

.app-sidebar.collapsed .brand-text {
    display: none;
}

.app-sidebar.collapsed .brand-image {
    margin-right: 0;
}

.app-sidebar.collapsed .nav-arrow {
    display: none;
}

.app-sidebar .nav-link12 .arrow-icon,
.app-sidebar .nav-link123 .arrow-icon {
    transition: transform 0.3s ease !important;
}


.app-sidebar .nav-link12 .arrow-icon,
.app-sidebar .nav-link123 .arrow-icon {
    position: relative;
    right: 0;
}
.nav-link12{
    /* opacity: .8; */
}
.nav-link123{
    /* opacity: 0.7; */
    margin-left:18px;
}


</style>
<?php $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/")+1); ?>

<aside class="app-sidebar bg-body-light light" data-bs-theme="light">
    <div class="sidebar-brand">
        <a href="" class="brand-link">
            <img src="uploads/image.png" alt="Logo" class="brand-image shadow" style="width: 34px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3), 0 6px 20px rgba(0, 0, 0, 0.2) !important;">
            <h4 class="text-dark mt-2">Good<i>Land</i></h3>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column">
                <li class="nav-item1">
                    <a href="dashboard" class="nav-link12 text-bold <?= $page == 'dashboard.php' ? '  bg-primary bg-primary1 ':'' ?>">
                        <i class="icons fas fa-dashboard"></i>
                        <p class="p-tag">Dashboard</p>
                    </a>
                </li>
                <li class="nav-header">Manage</li>
                <li class="nav-item1">
                    <a href="#pendingFilesSubmenu" class="nav-link12" data-bs-toggle="collapse" aria-expanded="<?= in_array($page, ['pending_files.php', 'approved_files.php', 'declined_files.php', 'recycled_files.php']) ? 'true' : 'false' ?>">
                        <i class="icons fas fa-folder"></i>
                        <p class="p-tag">Manage User Files <i class="nav-arrow fas fa-chevron-right" style="margin-left: 25px;"></i></p>
                    </a>
                    <div id="pendingFilesSubmenu" class="collapse <?= in_array($page, ['pending_files.php', 'approved_files.php', 'declined_files.php', 'recycled_files.php']) ? 'show' : '' ?>">
                        <ul class="nav flex-column">
                            <li class="nav-item12">
                                <a href="pending_files" class="nav-link123 <?= $page == 'pending_files.php' ? ' active bg-primary bg-primary1 ':'' ?>">
                                    <p class="p-tag">Pending Files 
                                        <span class="badge bg-warning text-light"><?php echo $count_pending_files ?? ''; ?></span></p>
                                </a>
                            </li>
                            <li class="nav-item12">
                                <a href="approved_files" class="nav-link123 <?= $page == 'approved_files.php' ? ' active bg-primary bg-primary1 ':'' ?>">
                                    <p class="p-tag">Approved Files
                                    <span class="badge bg-success text-light"><?php echo $count_approved_files ?? ''; ?></span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item12">
                                <a href="declined_files" class="nav-link123 <?= $page == 'declined_files.php' ? ' active bg-primary bg-primary1 ':'' ?>">
                                    <p class="p-tag">Archived Files
                                    <span class="badge bg-danger text-light"><?php echo $count_declined_files ?? ''; ?></span>  
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item12">
                                <a href="recycled_files" class="nav-link123 <?= $page == 'recycled_files.php' ? ' active bg-primary bg-primary1 ':'' ?>">
                                    <p class="p-tag">Recycled Files
                                    <span class="badge bg-danger text-light"><?php echo $count_recycled_files ?? ''; ?></span>
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item1">
                    <a href="visitors" class="nav-link12 <?= $page == 'visitors.php' ? ' active bg-primary bg-primary1 ':'' ?>">
                        <i class="icons fas fa-user-plus"></i>
                        <p class="p-tag">List of Visitors</p>
                    </a>
                </li>
               <li class="nav-item1">
                    <a href="downloads" class="nav-link12 <?= $page == 'downloads.php' ? ' active bg-primary bg-primary1 ':'' ?>">
                        <i class="icons fas fa-download"></i>
                        <p class="p-tag">List of Downloads</p>
                    </a>
                </li>
                <li class="nav-item1">
                    <a href="manageusers" class="nav-link12 <?= $page == 'manageusers.php' ? ' active bg-primary bg-primary1 ':'' ?>">
                        <i class="icons fas fa-users"></i>
                        <p class="p-tag">List of Users</p>
                    </a>
                </li>
                <li class="nav-item1">
                    <a href="manageadmins" class="nav-link12 <?= $page == 'manageadmins.php' ? ' active bg-primary bg-primary1 ':'' ?>">
                        <i class="icons fas fa-users"></i>
                        <p class="p-tag">List of Admins</p>
                    </a>
                </li>
                <li class="nav-header">Reports</li>
                <li class="nav-item1">
                    <a href="managereports" class="nav-link12 <?= $page == 'managereports.php' ? ' active bg-primary bg-primary1 ':'' ?>">
                        <i class="icons fas fa-folder"></i>
                        <p class="p-tag">Reports</p>
                    </a>
                </li>
                <li class="nav-header">Maintenance</li>
                <li class="nav-item1">
                    <a href="managesettings" class="nav-link12 <?= $page == 'managesettings.php' ? ' active bg-primary bg-primary1 ':'' ?>">
                        <i class="icons fas fa-gear"></i>
                        <p class="p-tag">Settings</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
