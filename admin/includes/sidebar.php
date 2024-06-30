<style>
    .custombg{
      
        border: 0px !important;
        border-radius: 5px !important;
        font-weight: bolder !important;
        color: rgb(50, 150, 200) !important;
        font-weight: bolder; 
        background-color:none !important;
    }
    .nav-item1 .nav-link:hover {
    background-color: transparent !important;
    color: rgb(50, 150, 200) !important;

}
.nav-item1:hover{
    background-color: transparent !important;
}

    p{
        font-family: 'Roboto', sans-serif !important;
          font-size:16px !important;
        
       
    }

    
</style>
<?php  $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/")+1); ?>

<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="auto"  > 
<!-- style="background-color: black !important; color: white !important;"  -->
            <div class="sidebar-brand mt-2">  
                <a href="" class="brand-link active"> 
                <img src="uploads/image.png" style="height: 35px !important;width: 35px !important; border-radius: 100px; box-shadow: 2px 8px 16px #fff;" 
                class="brand-image opacity-75 shadow">
                <!-- <img src="assets/images/Goodland.png" style="border-radius: 100px; box-shadow: 2px 8px 16px #fff;" 
                class="brand-image opacity-75 shadow"> -->
                    <h3 class="brand-text text-start mt-2"><b>Good</b><i>Land</i></h3> 
                </a> 
            </div> 
            <div class="sidebar-wrapper">
                <nav class="mt-2 "> 
                    <ul class="nav sidebar-menu flex-column" >
                        <li class="nav-item1"> 
                            <a href="dashboard" class="nav-link text-bold <?= $page == 'dashboard.php' ? ' custombg':'' ?>"> 
                                <i class="nav-icon bi bi-ui-checks-grid"></i>
                               
                                <p style="font-weight:lighter;">Dashboard </p>
                            </a> 
                        </li>
                        <li class="nav-header" style="font-weight:bolder !important;">Manage</li>
                        <li class="nav-item1"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-book"></i>
                                <p style="font-weight:lighter;">Archive Files
                                <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a> 
                        </li>
                        <li class="nav-item1"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-backpack"></i>
                                <p style="font-weight:lighter;">Projects</p>
                            </a> 
                        </li>
                        <li class="nav-item1"> <a href="managemembers" class="nav-link"> <i class="nav-icon bi bi-people"></i>
                                <p style="font-weight:lighter;">Members</p>
                            </a> </li>
                        <li class="nav-item1"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-shop"></i>
                            <p style="font-weight:lighter;">Workshops</p>
                        </a> </li>
                        <li class="nav-item1"> <a href="managecategories" class="nav-link <?= $page == 'managecategories.php' ? ' custombg':'' ?>"> 
                            <i class="nav-icon bi bi-search"></i>
                            <p style="font-weight:lighter;">Categories</p>
                        </a> </li>
                        <li class="nav-item1"> <a href="manageadmins" class="nav-link <?= $page == 'manageadmins.php' ? ' custombg':'' ?>"> <i class="nav-icon bi bi-people"></i>
                            <p style="font-weight:lighter;">Manage Admins</p>
                        </a> </li>
                        <li class="nav-header" style="font-weight:bolder !important;">Reports</li>
                        <li class="nav-item1"> <a href="#" class="nav-link <?= $page == 'managereports.php' ? ' custombg':'' ?>"> 
                            <i class="nav-icon bi bi-calendar"></i>
                            <p style="font-weight:lighter;">Reports</p>
                        </a> </li>
                        <li class="nav-header" style="font-weight:bolder !important;">Maintenance</li>
                        <li class="nav-item1"> <a href="managesettings" class="nav-link <?= $page == 'managesettings.php' ? ' custombg':'' ?>"> 
                            <i class="nav-icon bi bi-gear"></i>
                            <p style="font-weight:lighter;">Settings</p>
                        </a> </li>
                    </ul> 
                </nav>
            </div> 
        </aside> 
        