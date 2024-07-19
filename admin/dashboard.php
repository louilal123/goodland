<?php include "classes/admindetails.php" ?>
<?php
require_once('classes/Main_class.php');
$mainClass = new Main_class();
$mediaCounts = $mainClass->getMediaCounts();

$mediaData = [];
foreach ($mediaCounts as $count) {
    $mediaData[] = "['" . $count['MediaType'] . "', " . $count['Count'] . "]";
}
$mediaData = implode(", ", $mediaData);
?>
<!DOCTYPE html>
<html lang="en"> 
<?php include "includes/header.php"; ?>
<style>
    body{
        overflow:hidden !important;
    }
    h5{
        opacity: 0.7 !important;
    }
    .greetingmsg {
    opacity: 0;
    transition: opacity 2s ease-in-out;
    }

    .greetingmsg.show {
        opacity: 1;
    }
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
        opacity:0.8;
    }
    .panel-footer{
        opacity: 0.8 !important;
    }

</style>

<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary" >

    <div class="app-wrapper">

       <?php include "includes/sidebar.php" ?>
        <div class="app-main-wrapper"> 
           <?php 
            include "includes/topnav.php"; ?>
            <main class="app-main">
            <div class="app-content-header mb-0"> 
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0 greetingmsg fw-bold"> <span id="greeting"class="fw-light " ></span> 
                            <?php echo $adminDetails['fullname']; ?>.</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                Analytics
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-content"> 
                <div class="container-fluid"> 
                    <div class="row mt-0">
								    <div class="col-sm-6 col-lg-3">
								 	    <div class="card text-bg-primary" >
											<div class="card-body">
												<div class="row">
												<div class="col mt-2">
														<h5 class="card-title text-light">Registered Users</h5>
													</div>
													
													<div class="col-auto">
														<div class="stat text-primary">
                                                        <i class="bi bi-person-plus small-box text-light"></i>
                                                    	</div>
													</div>
												</div> 
												<h1 class=" text-light"> <?php echo $registeredUsersCount ?? '0'; ?></h1>
												

											</div>
										</div>
									</div> 
									<div class="col-sm-6 col-lg-3">
										<div class="card text-bg-success" >
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title text-light">Approved User Uploads</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
                                                         <i class="bi bi-check-circle-fill small-box text-light"></i>
														</div>
													</div>
												</div>
												<h1 class=" text-light"> <?php echo $count_approved_files ?? '0'; ?></h1>
												<div class="mb-0">
												
													
												</div>
											</div>
										</div>
                                    </div>

									<div class="col-sm-6 col-lg-3">
										<div class="card text-bg-warning" >
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title text-light">Pending User Uploads</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
                                                        <i class="bi bi-hourglass-split small-box text-light"></i>
                                                    	</div>
													</div>
												</div>
												<h1 class=" text-light"> <?php echo $count_pending_files ?? '0'; ?></h1>
												<div class="mb-0">
												
												</div>
											</div>
										</div>
									</div>

									<div class="col-sm-6 col-lg-3">
										<div class="card text-bg-danger" >
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title text-light">Declined User Uploads</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
                                                        <i class="bi bi-x-circle-fill small-box text-light"></i>
                                                    	</div>
													</div>
												</div>
												<h1 class=" text-light"> <?php echo $count_declined_files ?? '0'; ?></h1>
												<div class="mb-0">
												
												</div>
											</div>
										</div>
									</div>
                                       

					</div>
					<div class="row mt-4">

									<div class="col-sm-6 col-lg-3">
										<div class="card text-bg-warning" >
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title text-light">Total Files</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="bi bi-folder-fill small-box text-light"></i>
														</div>
													</div>
												</div>
												<h1 class=" text-light"> <?php echo $count_files ?? '0'; ?></h1>
												<div class="mb-0">
											</div>
											</div>
										</div>
									</div>  

								 

									<div class="col-sm-6 col-lg-3">
										<div class="card  text-bg-info" >
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title text-light">File Types</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="bi bi-file-earmark-text-fill  small-box text-light"></i>
														</div>
													</div>
												</div>
												<h1 class=" text-light"> <?php echo $count_files_types ?? '0'; ?></h1>
												<div class="mb-0">
												
												
												</div>
											</div>
										</div>
                                    </div>

									<div class="col-sm-6 col-lg-3">
										<div class="card text-bg-danger" >
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title text-light">Recycled Files</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
                                                         <i class="bi bi-trash-fill small-box text-light"></i>
														</div>
													</div>
												</div>
												<h1 class=" text-light">45</h1>
												<div class="mb-0">
												
													
												</div>
											</div>
										</div>
                                    </div>
                                       
									

									
                                    <div class="col-sm-6 col-lg-3">
										<div class="card text-bg-info" >
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title text-light">System Users</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="bi bi-people small-box text-light"></i>
														</div>
													</div>
												</div>
												<h1 class=" text-light "> <?php echo $adminCount ?? '0'; ?></h1>
												<div class="mb-0">
												</div>
											</div>
										</div>
									</div>  

					</div>
<div class="row mt-4">
    <div class="col-lg-5 col-md-12 col-sm-12">
        <div class="card mb-4 text-bg-white shadow-sm">
           <div id="piechart_3d" style=" height: 450px;"></div>
      
        </div>
    </div>

    <div class="col-lg-7 col-md-12 col-sm-12">
        <div class="card mb-4 shadow-sm ms-0">
        <div id="chart_div" style="width: 100%; margin-left:0px !important; height: 450px; margin: 0px; padding: 0px;"></div>
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