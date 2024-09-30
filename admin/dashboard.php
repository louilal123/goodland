<?php include "classes/admindetails.php";
?>

<!DOCTYPE html>
<html lang="en"> 
<?php include "includes/header.php"; ?>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>


</head>
<style>
.highcharts-data-table table {
    min-width: 360px;
    max-width: 800px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}


</style>


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
                            <div class="small-box bg-info">
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
                            <div class="small-box bg-info -warning">
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
                        <div class="col-lg-5" >
                       <div class="card p-4">
                            <div id="container"></div>
                           
                            </div>
                        </div> 
                        <div class="col-lg-7">
                            <div class="card p-4">
                           
                                <div id="container12"></div>
                           
                                </div>
                            </div> 
                        </div> 
                        <div class="col-lg-12 mt-4">
                            <div class="card p-4">
                           
                                <div id="container1"></div>
                           
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
    document.addEventListener('DOMContentLoaded', function () {
        // Define custom colors for each status
        const statusColors = {
            'Archived': '#6c757d',  // bg-secondary
            'Declined': '#dc3545',  // bg-danger
            'Approved': '#28a745',  // bg-success
            'Pending': '#ffc107'    // bg-warning
        };

        // Map your data to include the colors and slicing
        const dataWithColors = <?php echo json_encode($pieChartData); ?>.map(item => ({
            name: item.name,
            y: item.y,
            color: statusColors[item.name] || '#dc3545', // Default color if status not matched
            sliced: item.name === 'Declined', // Example: slice the 'Approved' slice
            selected: item.name === 'Approved' // Example: select the 'Approved' slice
        }));

        Highcharts.chart('container', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'File Status Overview'
            },
            tooltip: {
                pointFormat: '{point.name}: <b>{point.y} ({point.percentage:.1f}%)</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}: {point.y} ({point.percentage:.1f}%)'
                    },
                    showInLegend: true
                }
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Files',
                colorByPoint: false, // Set to false since we are specifying colors directly
                data: dataWithColors // Use the modified data with colors and slicing
            }]
        });
    });
</script>


    <!-- container1  -->
    <script>
  Highcharts.chart('container1', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Corn vs wheat estimated production for 2023',
        align: 'left'
    },
    subtitle: {
        text:
            'Source: <a target="_blank" ' +
            'href="https://www.indexmundi.com/agriculture/?commodity=corn">indexmundi</a>',
        align: 'left'
    },
    xAxis: {
        categories: ['USA', 'China', 'Brazil', 'EU', 'Argentina', 'India'],
        crosshair: true,
        accessibility: {
            description: 'Countries'
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: '1000 metric tons (MT)'
        }
    },
    tooltip: {
        valueSuffix: ' (1000 MT)'
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    credits: {
            enabled: false
        },
    series: [
        {
            name: 'Email-Verified',
            data: [2, 4, 8, 1, 3, 2]
        },
        {
            name: 'Non-Verified',
            data: [2, 4, 5, 2, 3, 6]
        }
    ]
});

</script>

<script type="text/javascript">
// Placeholder data
const waterLevelData = [
    [0, 120], [1, 135], [2, 150], [3, 160], [4, 145], [5, 155], 
    [6, 170], [7, 165], [8, 175], [9, 180], [10, 190], [11, 185]
];

// Create the chart
Highcharts.chart('container12', {
    chart: {
        type: 'area',
        zooming: {
            type: 'x'
        },
        panning: true,
        panKey: 'shift',
        
        scrollablePlotArea: {
            minWidth: 600
        }
    },
    title: {
        text: 'Water Level Over Time',
        align: 'left'
    },
    credits: {
        enabled: false
    },
    xAxis: {
        labels: {
            format: '{value} '
        },
        title: {
            text: 'Days'
        }
    },
    yAxis: {
        title: {
            text: 'Water Level (cm)'
        },
        labels: {
            format: '{value} cm'
        }
    },
    tooltip: {
        headerFormat: 'Day: {point.x}<br>',
        pointFormat: 'Water level: {point.y} cm',
        shared: true
    },
    legend: {
        enabled: false
    },
    series: [{
        data: waterLevelData,
        lineColor: '#004d00',  // Dark green line
        color: '#80c080',      // Light green fill color for the area
        fillOpacity: 0.5,      // Semi-transparent fill
        name: 'Water Level',
        

        marker: {
            enabled: false
        },
        threshold: null
    }]
});

    </script>

    

    <script>
       document.addEventListener("DOMContentLoaded", function() {
            document.querySelector(".greetingmsg").classList.add("show");
            document.querySelector(".panel").classList.add("show");
        });

    </script>
    <?php include "includes/footer.php" ?>
	

   
</body>

</html>