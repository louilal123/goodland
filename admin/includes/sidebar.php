<style>
 /* Sidebar Styling */
.app-sidebar {
    top: 0;
    width: 250px;
    height: 100%;
    background-color: #343a40;
    color: #fff;
    padding-left: 12px;
    padding-bottom: 15px;
    padding-right: 20px;
}

.sidebar-brand {
    display: flex;
    align-items: center;
    padding: 10px 10px;
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
}

.nav.sidebar-menu {
    list-style: none;
    padding: 0;
}

.nav-item1 {
    margin-bottom: 8px; 
    margin-right: 5px;
}

.nav-link1 {
    display: flex;
    align-items: center;
    padding: 2px 10px; 
    color: #adb5bd;
    text-decoration: none;
    border-radius: 2px;
    transition: background-color 0.3s, color 0.3s;
    font-size: 1.25rem;
}

.nav-link1:hover {
    background-color: #495057;
    color: #fff;
}

.nav-link1.active {
    background-color: Teal;
    color: #fff;
}

.nav-link1 .icons {
    margin-right: 8px;
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

.p-tag {
    margin: 4px;
    font-size: 1rem;
    /* text-transform: uppercase; */
}
.nav-header, .nav-item1 .nav-link1, .nav-link1 .icon .logoo{
    color: #ffffff !important;
}

</style>
<?php  $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/")+1); ?>

<aside class="app-sidebar bg-body-light shadow" data-bs-theme="light">
    <div class="sidebar-brand mt-2">
        <a href="" class="brand-link active">
            <img src="uploads/image.png" alt="Logo" class="brand-image shadow" style="width: 34px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3), 0 6px 20px rgba(0, 0, 0, 0.2) !important;">
            <h3 class="brand-text text-start mt-2 logoo shadow" style="color: #ffff !important;"><b>Good</b><i>Land</i></h3>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column">
                <li class="nav-item1">
                    <a href="dashboard.php" class="nav-link1 text-bold <?= $page == 'dashboard.php' ? ' active':'' ?>">
                        <i class="icons bi bi-ui-checks-grid"></i>
                        <p class="p-tag">Dashboard</p>
                    </a>
                </li>
                <li class="nav-header">Manage</li>
                <li class="nav-item1">
                    <a href="manageevents.php" class="nav-link1 <?= $page == 'manageevents.php' ? ' active':'' ?>">
                        <i class="icons bi bi-calendar-fill"></i>
                        <p class="p-tag">List of Events  <i class="nav-arrow bi bi-chevron-right" style="margin-left: 60px;"></i></p>
                    </a>
                </li>
                <li class="nav-item1">
                    <a href="manageproducts.php" class="nav-link1 <?= $page == 'manageproducts.php' ? ' active':'' ?>">
                        <i class="icons bi bi-box-seam"></i>
                        <p class="p-tag">List of Products</p>
                    </a>
                </li>
                <li class="nav-item1">
                    <a href="#" class="nav-link1">
                        <i class="icons bi bi-briefcase"></i>
                        <p class="p-tag">List of Projects</p>
                    </a>
                </li>
                <li class="nav-item1">
                    <a href="managemembers.php" class="nav-link1 <?= $page == 'managemembers.php' ? ' active':'' ?>">
                        <i class="icons bi bi-people"></i>
                        <p class="p-tag">List of Members</p>
                    </a>
                </li>
                <li class="nav-item1">
                    <a href="#" class="nav-link1">
                        <i class="icons bi bi-shop"></i>
                        <p class="p-tag">List of Workshops</p>
                    </a>
                </li>
                <li class="nav-item1">
                    <a href="managecategories.php" class="nav-link1 <?= $page == 'managecategories.php' ? ' active':'' ?>">
                        <i class="icons bi bi-grid"></i>
                        <p class="p-tag">List of Categories</p>
                    </a>
                </li>

                <li class="nav-item1">
                    <a href="manageadmins.php" class="nav-link1 <?= $page == 'manageadmins.php' ? ' active':'' ?>">
                        <i class="icons bi bi-shield-lock"></i>
                        <p class="p-tag">List of Admins</p>
                    </a>
                </li>
                <li class="nav-header">Reports</li>
                <li class="nav-item1">
                    <a href="managereports.php" class="nav-link1 <?= $page == 'managereports.php' ? ' active':'' ?>">
                        <i class="icons bi bi-file-earmark-text"></i>
                        <p class="p-tag">Reports</p>
                    </a>
                </li>
                <li class="nav-header">Maintenance</li>
                <li class="nav-item1">
                    <a href="managesettings.php" class="nav-link1 <?= $page == 'managesettings.php' ? ' active':'' ?>">
                        <i class="icons bi bi-gear"></i>
                        <p class="p-tag">Settings</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>



        <!-- /* .custombg{
        color: rgb(50, 150, 200) !important;
        background-color: none !important;
        
    }
    .nav-item11, .nav-link1:hover {
        background-color: transparent !important;
        color: rgb(50, 150, 200) !important;
    }
    .nav-arrow1{
        margin-left: 60px !important;
        
    }
    .icon{
        
    }
    .nav-item11:hover{
        background-color: none !important;
    }
    .p-tag{
        font-family: 'Roboto', sans-serif !important;
        font-size:16px !important;
       
        
    } 
     */ -->