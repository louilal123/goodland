<?php include "classes/admindetails.php" ?>

<!DOCTYPE html>
<html lang="en"> 
<?php include "includes/header.php"; ?>
<link rel="stylesheet" href="dist/all.min.css">
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
    margin-top: 10px !important;
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
                            <h3 class="mb-0 greetingmsg"> <span id="greeting"></span> <strong><?php echo $adminDetails['fullname']; ?></strong>.</h3>
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
													<div class="col mt-0">
														<h5 class="card-title text-light">Registered Users</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
                                                        <i class="bi bi-person-plus small-box text-light"></i>
                                                    	</div>
													</div>
												</div>
												<h1 class=" text-light"> <?php echo $registeredUsersCount ?? '0'; ?></h1>
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
														<h5 class="card-title text-light">Uploaded Documents</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
                                                         <i class="bi bi-book small-box text-light"></i>
														</div>
													</div>
												</div>
												<h1 class=" text-light"> <?php echo $uploadedDocumentsCount ?? '0'; ?></h1>
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
														<h5 class="card-title text-light">Total Folders</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
                                                        <i class="bi bi-folder small-box text-light"></i>
                                                    	</div>
													</div>
												</div>
												<h1 class=" text-light">0</h1>
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
								 

									<div class="col-sm-6 col-lg-3">
										<div class="card  text-bg-info" >
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title text-light">Categories</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="bi bi-calendar small-box text-light"></i>
														</div>
													</div>
												</div>
												<h1 class=" text-light">5</h1>
												<div class="mb-0">
												
												
												</div>
											</div>
										</div>
                                    </div>

									<div class="col-sm-6 col-lg-3">
										<div class="card text-bg-primary" >
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title text-light">Recently Deleted Files</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
                                                         <i class="bi bi-book small-box text-light"></i>
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
										<div class="card  text-bg-success" >
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title text-light">Members</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="bi bi-book small-box text-light"></i>
														</div>
													</div>
												</div>
												<h1 class=" text-light"><?php echo $memberCount ?? '0'; ?></h1>
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
														<h5 class="card-title text-light">Projects</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="bi bi-people small-box text-light"></i>
														</div>
													</div>
												</div>
												<h1 class=" text-light"> <?php echo $adminCount ?? '0'; ?></h1>
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
        <div id="chart_div" style="width: 100%; margin-left:0px !important; height: 450px;"></div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-lg-7 col-md-12 col-sm-12">
        <div class="card mb-4 shadow-sm">
        <div id="columnchart_material" style="height: 450px;"></div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card mb-4 text-bg-white shadow-sm">
           <div id="piechart_3d" style=" height: 450px;"></div>
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
  
	<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>

<script>
    const visitors_chart_options = {
        series: [{
                name: "High - 2023",
                data: [100, 120, 170, 167, 180, 177, 160],
            },
            {
                name: "Low - 2023",
                data: [60, 80, 70, 67, 80, 77, 100],
            },
        ],
        chart: {
            height: 200,
            type: "line",
            toolbar: {
                show: false,
            },
        },
        colors: ["#0d6efd", "#adb5bd"],
        stroke: {
            curve: "smooth",
        },
        grid: {
            borderColor: "#e7e7e7",
            row: {
                colors: ["#f3f3f3", "transparent"],
                opacity: 0.5,
            },
        },
        legend: {
            show: false,
        },
        markers: {
            size: 1,
        },
        xaxis: {
            categories: ["22th", "23th", "24th", "25th", "26th", "27th", "28th"],
        },
    };

    const visitors_chart = new ApexCharts(
        document.querySelector("#visitors-chart"),
        visitors_chart_options
    );
    visitors_chart.render();

    const documents_chart_options = {
        series: [{
                name: "Uploaded Documents",
                data: [44, 55, 57, 56, 61, 58, 63, 60, 66, 63, 60, 66],
            },
            {
                name: "Reviewed Documents",
                data: [76, 85, 101, 98, 87, 105, 91, 114, 94, 63, 60, 66],
            },
        ],
        chart: {
            type: "bar",
            height: 200,
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "55%",
                endingShape: "rounded",
            },
        },
        legend: {
            show: false,
        },
        colors: ["#0d6efd", "#20c997"],
        dataLabels: {
            enabled: false,
        },
        stroke: {
            show: true,
            width: 2,
            colors: ["transparent"],
        },
        xaxis: {
            categories: [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec",
            ],
        },
        fill: {
            opacity: 1,
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val + " documents";
                },
            },
        },
    };

    const documents_chart = new ApexCharts(
        document.querySelector("#documents-chart"),
        documents_chart_options
    );
    documents_chart.render();
</script>

   
</body>

</html>