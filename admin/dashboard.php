<?php include "classes/admindetails.php" ?>

<!DOCTYPE html>
<html lang="en"> 
<?php include "includes/header.php"; ?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
        ]);

        var options = {
          title: 'My Daily Activities',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
  
      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Bolivia', 'Ecuador', 'Madagascar', 'Papua New Guinea', 'Rwanda', 'Average'],
          ['2004/05',  165,      938,         522,             998,           450,      614.6],
          ['2005/06',  135,      1120,        599,             1268,          288,      682],
          ['2006/07',  157,      1167,        587,             807,           397,      623],
          ['2007/08',  139,      1110,        615,             968,           215,      609.4],
          ['2008/09',  136,      691,         629,             1026,          366,      569.6]
        ]);

        var options = {
          title : 'Monthly Coffee Production by Country',
          vAxis: {title: 'Cups'},
          hAxis: {title: 'Month'},
          seriesType: 'bars',
          series: {5: {type: 'line'}}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>

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
                        <div class="col-lg-6" >
                            <div class="card card-outline outline-primary" >
                              <div class="card-body">
                                <div id="piechart_3d" style="height: 440px;"></div>
                                </div>
                            </div> 
                        </div> 
                        <div class="col-lg-6">
                            <div class="card card-outline outline-primary">
                                
                                <div class="card-body">
                                <div id="chart_div" style="height: 440px !important;"></div>
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