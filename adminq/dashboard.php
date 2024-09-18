<?php include "classes/admindetails.php" ?>

<!DOCTYPE html>
<html lang="en"> 
<?php include "includes/header.php"; ?>
</head>

<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary" style="overflow: hidden !important;" >

    <div class="app-wrapper">

       <?php include "includes/sidebar.php" ?>
        <div class="app-main-wrapper "> 
           <?php 
            include "includes/topnav.php"; ?>
            <main class="app-main bg-light opacity-90">
            <div class="app-content-header"> 
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class=" greetingmsg"> <span id="greeting"class="fw-light " ></span> 
                            <?php echo $adminDetails['username']; ?>.</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end ">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                Analytics
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-content mt-0" style="margin-bottom: 0px important;"> 
			<div class="container-fluid"> <!--begin::Row-->
                    <div class="row"> <!--begin::Col-->
                        <div class="col-lg-3 col-6"> 
                            <div class="small-box bg-warning">
                                <div class="inner text-white p-4 pb-2">
                                    <h3> <?php echo $count_files ?? '0'; ?></h3>
                                    <p>Total Files</p>
                                </div> 
                                <div class="small-box-icon texg"><i class="fas fa-folder"></i></div> 
                            </div> 
                        </div> <!--end::Col-->
					    <div class="col-lg-3 col-6"> 
                            <div class="small-box bg-success ">
                                <div class="inner text-white p-4 pb-2">
                                    <h3><?php echo $count_approved_files ?? '0'; ?></h3>
                                    <p>Approved Files</p>
                                </div>
                                <div class="small-box-icon texs"><i class="fas fa-check-circle"></i></div>
                            </div> 
                        </div> <!--end::Col-->
                        <div class="col-lg-3 col-6"> 
                            <div class="small-box bg-warning -success">
                                <div class="inner text-white p-4 pb-2">
                                    <h3> <?php echo $count_pending_files ?? '0'; ?></h3>
                                    <p>Pending Files</p>
                                </div> 
                                <div class="small-box-icon texg"><i class="fas fa-clock"></i></div> 
                            </div> 
                        </div> <!--end::Col-->
                        <div class="col-lg-3 col-6"> 
                            <div class="small-box bg-danger -warning">
                                <div class="inner text-white p-4 pb-2">
                                    <h3> <?php echo $count_declined_files ?? '0'; ?></h3>
                                    <p>Declined Files</p>
                                </div>
                                <div class="small-box-icon tex"><i class="fas fa-times-circle"></i></div> 
                            </div> 
                        </div> 
                        <div class="col-lg-3 col-6"> 
                            <div class="small-box bg-secondary -danger">
                                <div class="inner text-white p-4 pb-2">
                                    <h3><?php echo $count_recycled_files ?? '0'; ?></h3>
                                    <p>Archived Files</p>
                                </div> 
                                <div class="small-box-icon tex"><i class="fas fa-archive"></i></div> 
                            </div> 
                        </div> <!--end::Col-->
                        <div class="col-lg-3 col-6"> 
                            <div class="small-box bg-primary ">
                                <div class="inner text-white p-4 pb-2">
                                    <h3><?php echo $registeredUsersCount ?? ''; ?></h3>
                                    <p>Total Contributors</p>
                                </div> 
                                <div class="small-box-icon texy"><i class="fas fa-user-circle"></i></div> 
                            </div> 
                        </div> <!--end::Col-->

                        <div class="col-lg-3 col-6"> 
                            <div class="small-box bg-success -warning">
                                <div class="inner text-white p-4 pb-2">
                                    <h3><?php echo $downloadsCount ?? '0'; ?></h3>
                                    <p>Downloads</p>
                                </div>
                                <div class="small-box-icon text"><i class="fas fa-arrow-circle-down"></i></div> 
                            </div> 
                        </div> 
                        <div class="col-lg-3 col-6"> 
                            <div class="small-box bg-primary -danger">
                                <div class="inner text-white p-4 pb-2">
                                    <h3><?php echo $adminCount ?? '0'; ?></h3>
                                    <p>System Users</p>
                                </div> 
                                <div class="small-box-icon text"><i class="fas fa-users"></i></div> 
                            </div> 
                        </div> <!--end::Col-->
                    </div> <!--end::Row--> <!--begin::Row-->
                    <div class="row"> <!-- Start col -->
                        <div class="col-lg-12">
                            <div class="card card-outline outline-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Monthly Downloads</h3>
                                </div>
                                <div class="card-body">
                                    <div id="revenue-chart"></div>
                                </div>
                            </div> 
                        </div> 
                        <div class="col-lg-12 mt-3">
                            <div class="card card-outline outline-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Monthly Downloads</h3>
                                </div>
                                <div class="card-body">
                                    <div id="revenue-chart"></div>
                                </div>
                            </div> 
                        </div> 
                    </div> 
                </div> 
              
            </div> 
           </main>
          
        </div>
    </div>
    <script>
       document.addEventListener("DOMContentLoaded", function() {
            document.querySelector(".greetingmsg").classList.add("show");
            document.querySelector(".panel").classList.add("show");
        });

    </script>
    <?php include "includes/footer.php" ?>
	

   
</body>

</html>