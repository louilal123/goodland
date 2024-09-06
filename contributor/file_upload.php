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
                                <h3 class="mb-0 ">Upload Contributor</h3>
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
                       

                               <div class="row mt-0">
								    <!--   -->
									<div class="col-sm-6 col-lg-3">
										<div class="card text-bg-light" style="border-radius: 5px;">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title text-dark">Uploaded Files</h5>
													</div>

													<div class="col-auto mt-4">
														<div class="stat text-primary">
															<i class="fas fa-arrow-up small-box text-success"></i>
														</div>
													</div>
												</div>
												<h1 class=" text-dark"> <?php echo $count_files ?? '0'; ?></h1>
												<div class="mb-0">
											</div>
											</div>
										</div>
									</div>  
									<div class="col-sm-6 col-lg-3">
										<div class="card text-bg-light" style="border-radius: 5px;">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title text-dark">Approved Files</h5>
													</div>

													<div class="col-auto mt-4">
														<div class="stat text-primary">
                                                         <i class="fas fa-check small-box text-primary"></i>
														</div>
													</div>
												</div>
												<h1 class=" text-dark"> <?php echo $count_approved_files ?? '0'; ?></h1>
												<div class="mb-0">
												
													
												</div>
											</div>
										</div>
                                    </div>

									<div class="col-sm-6 col-lg-3">
										<div class="card text-bg-light" style="border-radius: 5px;">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title text-dark">Pending Files</h5>
													</div>

													<div class="col-auto mt-4">
														<div class="stat text-primary">
                                                        <i class="fas fa-hourglass small-box text-warning"></i>
                                                    	</div>
													</div>
												</div>
												<h1 class=" text-dark"> <?php echo $count_pending_files ?? '0'; ?></h1>
												<div class="mb-0">
												
												</div>
											</div>
										</div>
									</div>

									<div class="col-sm-6 col-lg-3">
										<div class="card text-bg-light" style="border-radius: 5px;">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title text-dark">Declined Uploads</h5>
													</div>

													<div class="col-auto mt-4">
														<div class="stat text-primary">
                                                        <i class="fas fa-x small-box text-danger"></i>
                                                    	</div>
													</div>
												</div>
												<h1 class=" text-dark"> <?php echo $count_declined_files ?? '0'; ?></h1>
												<div class="mb-0">
												
												</div>
											</div>
										</div>
									</div>
                          
					            </div>                

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