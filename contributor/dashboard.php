<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
<?php include "includes/header.php";?>
</head> 

<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary"> 
    <div class="app-wrapper">
    <?php include "includes/sidebar.php";?>
        <div class="app-main-wrapper">
        <?php include "includes/topnav.php";?>
            
            <main class="app-main">
                <div class="app-content-header"> 
                    <div class="container-fluid"> <!--begin::Row-->
                        <div class="row">
                            <div class="col-sm-8">
                                <h3 class="mb-0">Welcome  <small><?php echo $user_details['username']; ?>.</small></h3>
                            </div>
                            <div class="col-sm-4">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Overview
                                    </li>
                                </ol>
                            </div>
                        </div> <!--end::Row-->
                    </div> <!--end::Container-->
                </div> 
                <div class="app-content"> 
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row"> <!--begin::Col-->
                        <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 1-->
                            <div class="small-box text-bg-primary">
                                <div class="inner text-white p-4 pb-2">
                                    <h3> <?php echo htmlspecialchars($fileCount) ?? '0'; ?> </h3>
                                    <p>All Files</p>
                                </div> 
                                <div class="small-box-icon texg"><i class="fas fa-folder"></i></div> 
                            </div> <!--end::Small Box Widget 1-->
                        </div> <!--end::Col-->
                        <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 2-->
                            <div class="small-box text-bg-success">
                                <div class="inner text-white p-4 pb-2">
                                    <h3><?php echo $pending_file ?? '0'; ?> </h3>
                                    <p>Pending Files</p>
                                </div>
                                <div class="small-box-icon texs"><i class="fas fa-check-circle"></i></div>
                            </div> <!--end::Small Box Widget 2-->
                        </div> <!--end::Col-->
                        <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 3-->
                            <div class="small-box text-bg-warning">
                                <div class="inner text-white p-4 pb-2">
                                    <h3><?php echo $approved_file ?? '0'; ?></h3>
                                    <p>Approved Files</p>
                                </div> 
                                <div class="small-box-icon texg"><i class="fas fa-clock"></i></div> 
                            </div> <!--end::Small Box Widget 3-->
                        </div> <!--end::Col-->
                        <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 4-->
                            <div class="small-box text-bg-danger">
                                <div class="inner text-white p-4 pb-2">
                                <h3><?php echo $declined_file ?? '0'; ?></h3>
                                    <p>Declined Files</p>
                                </div> 
                                <div class="small-box-icon tex"><i class="fas fa-archive"></i></div> 
                            </div> <!--end::Small Box Widget 4-->
                        </div> <!--end::Col-->
                    </div> <!--end::Row--> <!--begin::Row-->
                    <div class="row"> <!-- Start col -->
                        <div class="col-lg-12 connectedSortable">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h3 class="card-title">Sales Value</h3>
                                </div>
                                <div class="card-body">
                                    <div id="revenue-chart"></div>
                                </div>
                            </div> 

                        </div> 

                    </div> <!-- /.row (main row) -->
                </div> <!--end::Container-->
                </div> <!--end::App Content-->
            </main>
            <?php include "includes/footer.php";?>
</body><!--end::Body-->

</html>