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

//for the line chart
$visitor_data = $mainClass->get_monthly_visitor_data();
$download_data = $mainClass->getDownloadData1();
?>
<!DOCTYPE html>
<html lang="en"> 
<?php include "includes/header.php"; ?>

<script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {
            var chartData = <?php echo json_encode($chartData); ?>;
            var data = google.visualization.arrayToDataTable(chartData);

            var options = {
                title: 'Monthly Website Visitors By Country',
                is3D: true,
                vAxis: {title: 'Number of Visitors'},
                hAxis: {title: 'Month'},
                seriesType: 'bars',
                series: {
                    <?php echo count($chartData[0]) - 2; ?>: {type: 'line'} // The last column (average) should be a line
                }
            };

            var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>

<style>
	 .main-blur {
            backdrop-filter: blur(5px);
			background: rgba(108, 117, 125, 0.1); 
        }
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
        /* opacity:0.8; */
    }
    .panel-footer{
        opacity: 0.8 !important;
    }

</style>

<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary" >

    <div class="app-wrapper">

       <?php include "includes/sidebar.php" ?>
        <div class="app-main-wrapper main-blur"> 
           <?php 
            include "includes/topnav.php"; ?>
            <main class="app-main ">
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
								    <!--   -->
									<div class="col-sm-6 col-lg-3">
										<div class="card text-bg-warning" style="border-radius: 5px;">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title text-light">User Uploaded Files</h5>
													</div>

													<div class="col-auto mt-4">
														<div class="stat text-primary">
															<i class="fas fa-folder small-box text-light"></i>
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
										<div class="card text-bg-success" style="border-radius: 5px;">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title text-light">Approved User Uploads</h5>
													</div>

													<div class="col-auto mt-4">
														<div class="stat text-primary">
                                                         <i class="fas fa-thumbs-up small-box text-light"></i>
														</div>
													</div>
												</div>
												<h1 class=" text-light"> <?php echo $count_approved_files ?? ''; ?></h1>
												<div class="mb-0">
												
													
												</div>
											</div>
										</div>
                                    </div>

									<div class="col-sm-6 col-lg-3">
										<div class="card text-bg-warning" style="border-radius: 5px;">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title text-light">Pending User Uploads</h5>
													</div>

													<div class="col-auto mt-4">
														<div class="stat text-primary">
                                                        <i class="fas fa-hourglass small-box text-light"></i>
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
										<div class="card text-bg-danger" style="border-radius: 5px;">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title text-light">Declined User Uploads</h5>
													</div>

													<div class="col-auto mt-4">
														<div class="stat text-primary">
                                                        <i class="fas fa-thumbs-down small-box text-light"></i>
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
										<div class="card text-bg-danger" style="border-radius: 5px;">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title text-light">Recycled Files</h5>
													</div>

													<div class="col-auto mt-4">
														<div class="stat text-primary">
                                                         <i class="fas fa-trash small-box text-light"></i>
														</div>
													</div>
												</div>
												<h1 class=" text-light"> <?php echo $count_recycled_files ?? '0'; ?></h1>
												<div class="mb-0">
												
													
												</div>
											</div>
										</div>
                                    </div>

									
					<div class="col-sm-6 col-lg-3">
								 	    <div class="card text-bg-primary bg-opacity-75" style="border-radius: 5px;">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
															<h5 class="card-title text-light">Registered Users</h5>
														</div>
														
														<div class="col-auto mt-4">
															<div class="stat text-primary">
															<i class="fas fa-users small-box text-light"></i>
															</div>
														</div>
													</div> 
													<h1 class=" text-light"> <?php echo $registeredUsersCount ?? ''; ?></h1>
												
											</div>
										</div>
									</div>

									<div class="col-sm-6 col-lg-3">
										<div class="card text-bg-info" >
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title text-light">Total Visitors</h5>
													</div>

													<div class="col-auto mt-4">
														<div class="stat text-primary">
															<i class="fas fa-users small-box text-light"></i>
														</div>
													</div>
												</div>
												<h1 class=" text-light "> <?php echo $uniqueVisitorCount ?? '0'; ?></h1>
												<div class="mb-0">
												</div>
											</div>
										</div>
									</div>  
								 

									<div class="col-sm-6 col-lg-3">
										<div class="card  text-bg-info" style="border-radius: 5px;">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title text-light">Downloads</h5>
													</div>

													<div class="col-auto mt-4">
														<div class="stat text-primary">
															<i class="fas fa-download  small-box text-light"></i>
														</div>
													</div>
												</div>
												<h1 class=" text-light"> <?php echo $downloadsCount ?? '0'; ?></h1>
												<div class="mb-0">
												
												
												</div>
											</div>
										</div>
                                    </div>

								
                                       
									

									
                                    <!-- <div class="col-sm-6 col-lg-3">
										<div class="card text-bg-info" >
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title text-light">System Users</h5>
													</div>

													<div class="col-auto mt-4">
														<div class="stat text-primary">
															<i class="fas fa-users small-box text-light"></i>
														</div>
													</div>
												</div>
												<h1 class=" text-light "> <?//php echo $adminCount ?? '0'; ?></h1>
												<div class="mb-0">
												</div>
											</div>
										</div>
									</div>   -->

					</div>

					<div class="row mt-4 ">
						

							<div class="col-md-7" >
								<div class="card" >
									<div class="card-header">
									<h5 class="mb-0"><strong>Website Visits for the <?php echo date("M - Y")."\n";?></strong></h5>
									
									</div>
									<div class="card-body">
										<div id="line_chart" style="height: 390px;">
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-5">
								<div class="card">
									<div class="card-header">
											<h5 class="mb-0"><strong>Downloads for the <?php echo date("M - Y")."\n";?></strong></h5>
											
									</div>
									<div class="card-body">
										
										<div id="side_chart" style="width: 600px; height: 390px;"></div>
									</div>
							</div>
							</div>
					</div>


<div class="row mt-4 ">
    <div class="col-lg-5 col-md-12 col-sm-12 ">
        <div class="card  bg-primary bg-opacity-10">
           <div id="piechart_3d" style=" height: 390px;"></div>
      
        </div>
    </div>

    <div class="col-lg-7 col-md-12 col-sm-12">
        <div class="card  bg-primary bg-opacity-10">
			<div id="chart_div"style=" height: 390px;"></div>
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