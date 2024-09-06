<!DOCTYPE html>
<html lang="en"> 
 
<?php include "includes/header.php"?>
<style>
     .panel {
    opacity: 0;
    transition: opacity 2s ease-in-out;
    }

    .panel.show {
        opacity: 1;
    }
    .small-box{
        position :absolute;
        height: 0px;
        width: 0px;
        margin-top: 0px !important;
        font-size: 50px;
        left: 0px;
        margin-right: 50px !important; 
    margin-left: 300px !important;
        align-items: end;
        justify-content: end;
        color: navy; 
        /* opacity:0.8; */
    }
    .panel-footer{
        opacity: 0.8 !important;
    }
    .main-blur {
    background: rgba(108, 117, 125, 0.1); 
}
</style>

<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary"> 
    <div class="app-wrapper"> 

       <?php include "includes/sidebar.php"?>

        <div class="app-main-wrapper">
          
        <?php include "includes/topnav.php"?>

            <main class="app-main main-blur"> 
                <div class="app-content-header mb-0" style="margin-bottom: 0px !important;">
                    <div class="container-fluid"> 
                        <div class="row">
                            <div class="col-sm-8">
                                <h3 class="mb-0 ">Pedning Contributor</h3>
                            </div>
                            <div class="col-sm-4">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Dashboard
                                    </li>
                                </ol>
                            </div>
                        </div> 
                    </div> 
                </div> 
                <div class="app-content">
                    <div class="container-fluid"> 
                        <h1>SETTINGS PAGE</h1>
                    </div> 
                </div> <!--end::App Content-->
            </main>
            
          
            <footer class="app-footer"> 
                <div class="float-end d-none d-sm-inline">GoodLand Team</div><strong>
                    Copyright &copy; 2024&nbsp;
                    <a href="https://goodlandv2.com" class="text-decoration-none">GoodLand</a>.
                </strong>
                All rights reserved.
            </footer> <!--end::Footer-->
        </div>
    </div>

    <?php include "includes/footer.php" ?>
</body><!--end::Body-->

</html>