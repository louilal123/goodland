<style>
    .custombg{
        color: rgb(50, 150, 200) !important;
        background-color: none !important;
        
    }
    .nav-item1, .nav-link:hover {
        background-color: transparent !important;
        color: rgb(50, 150, 200) !important;
    }
    .nav-arrow1{
        margin-left: 60px !important;
        
    }
    .icon{
        
    }
    .nav-item1:hover{
        background-color: none !important;
    }
    .p-tag{
        font-family: 'Roboto', sans-serif !important;
        font-size:16px !important;
        
    } 
</style>
<?php  $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/")+1); ?>

<aside class="app-sidebar bg-body-primary shadow" data-bs-theme="auto"  > 
<!-- style="background-color: black !important; color: white !important;"  -->
            <div class="sidebar-brand mt-2">  
                <a href="" class="brand-link active" > 
                <img src="uploads/image.png" style="height: 35px !important;width: 35px !important; border-radius: 100px; box-shadow: 2px 8px 16px #fff;" 
                class="brand-image opacity-75 shadow">
                <!-- <img src="assets/images/Goodland.png" style="border-radius: 100px; box-shadow: 2px 8px 16px #fff;" 
                class="brand-image opacity-75 shadow"> -->
                    <h3 class="brand-text text-start mt-2" ><b>Good</b><i>Land</i></h3> 
                </a> 
            </div> 
            <div class="sidebar-wrapper">
                <nav class="mt-2 "> 
                    <ul class="nav sidebar-menu flex-column" >
                        <li class="nav-item1"> 
                            <a href="dashboard" class="nav-link text-bold <?= $page == 'dashboard.php' ? ' custombg':'' ?>"> 
                                <i class="icon bi bi-ui-checks-grid"></i>
                               
                                <p class="p-tag">Dashboard </p>
                            </a> 
                        </li>
                        <li class="nav-header">Manage</li>
                        <li class="nav-item11"> <a href="manageevents" class="nav-link <?= $page == 'manageevents.php' ? ' custombg':'' ?>">
                             <i class="icon bi bi-calendar-fill"></i>
                                <p class="p-tag">Manage Events</p>
                            </a> </li>
                        <li class="nav-item11"> <a href="manageproducts" class="nav-link <?= $page == 'manageproducts.php' ? ' custombg':'' ?>">
                             <i class="icon bi bi-people"></i>
                                <p class="p-tag">Manage Products</p>
                            </a> </li>
                        <li class="nav-item11"> <a href="#" class="nav-link"> <i class="icon bi bi-backpack"></i>
                                <p class="p-tag">Manage Projects</p>
                            </a> 
                        </li>
                        <li class="nav-item11"> <a href="managemembers" class="nav-link <?= $page == 'managemembers.php' ? ' custombg':'' ?>">
                             <i class="icon bi bi-people"></i>
                                <p class="p-tag">Manage Members</p>
                            </a> </li>
                        <li class="nav-item11"> <a href="#" class="nav-link"> <i class="icon bi bi-shop"></i>
                            <p class="p-tag">Manage Workshops</p>
                        </a> </li>
                        <li class="nav-item11"> <a href="managecategories" class="nav-link <?= $page == 'managecategories.php' ? ' custombg':'' ?>"> 
                            <i class="icon bi bi-search"></i>
                            <p class="p-tag">Manage Categories</p>
                        </a> </li>
                        <li class="nav-item11"> <a href="manageadmins" class="nav-link <?= $page == 'manageadmins.php' ? ' custombg':'' ?>"> <i class="icon bi bi-people"></i>
                            <p class="p-tag">Manage Admins</p>
                        </a> </li>
                        <li class="nav-header">Reports</li>
                        <li class="nav-item11"> <a href="#" class="nav-link <?= $page == 'managereports.php' ? ' custombg':'' ?>"> 
                            <i class="icon bi bi-calendar"></i>
                            <p class="p-tag">Reports</p>
                        </a> </li>
                        <li class="nav-header">Maintenance</li>
                        <li class="nav-item11"> <a href="managesettings" class="nav-link <?= $page == 'managesettings.php' ? ' custombg':'' ?>"> 
                            <i class="icon bi bi-gear"></i>
                            <p class="p-tag">Settings</p>
                        </a> </li>
                    </ul> 
                </nav>
            </div> 
        </aside> 
        