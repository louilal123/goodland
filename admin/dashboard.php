<?php include "classes/admindetails.php";
?>
<?php
include 'classes/average_chart.php';
?>
<!DOCTYPE html>
<html lang="en"> 
<?php include "includes/header.php"; ?>
<title>Admin-Panel</title>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>

<!-- Flag sprites service provided by Martijn Lafeber,
    https://github.com/lafeber/world-flags-sprite/blob/master/LICENSE -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/lafeber/world-flags-sprite/stylesheets/flags32-both.css" />
      <script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>
 <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
   
</head>
<style>

.highcharts-data-table table {
    min-width: 500px;
    max-width: 1500px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 1000px;
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



.buttons {
    min-width: 310px;
    text-align: center;
    margin: 1rem 0;
    font-size: 0;
}

.buttons button {
    cursor: pointer;
    border: 1px solid silver;
    border-right-width: 0;
    background-color: #f8f8f8;
    font-size: 1rem;
    padding: 0.5rem;
    transition-duration: 0.3s;
    margin: 0;
}

.buttons button:first-child {
    border-top-left-radius: 0.3em;
    border-bottom-left-radius: 0.3em;
}

.buttons button:last-child {
    border-top-right-radius: 0.3em;
    border-bottom-right-radius: 0.3em;
    border-right-width: 1px;
}

.buttons button:hover {
    color: white;
    background-color: rgb(158 159 163);
    outline: none;
}

.buttons button.active {
    background-color: #0051b4;
    color: white;
}

/* crds  */
.small-box {
    background-color: #fff;
    /* background: linear-gradient(to top, #144D57,#0062cc) !important; */

    border-radius: 10px !important;
    border: none;
    position: relative;
    margin-bottom: 30px;
    box-shadow: 0 0.46875rem 2.1875rem rgba(90,97,105,0.1), 0 0.9375rem 1.40625rem rgba(90,97,105,0.1), 0 0.25rem 0.53125rem rgba(90,97,105,0.12), 0 0.125rem 0.1875rem rgba(90,97,105,0.1);
}
.small-box h3 p{
    color: #f8f8f8;
}


.char {
    background-color: #fff;
    border-radius: 10px !important;
    border: none;
    position: relative;
    margin-bottom: 30px;
    box-shadow: 0 0.46875rem 2.1875rem rgba(90,97,105,0.1), 0 0.9375rem 1.40625rem rgba(90,97,105,0.1), 0 0.25rem 0.53125rem rgba(90,97,105,0.12), 0 0.125rem 0.1875rem rgba(90,97,105,0.1);
}



</style>


<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary" style="overflow: hidden !important;" >

    <div class="app-wrapper">

       <?php include "includes/sidebar.php" ?>
        <div class="app-main-wrapper "> 
           <?php 
            include "includes/topnav.php"; ?>
            <main class="app-main ">
            <div class="app-content-header"> 
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class=" greetingmsg"> <span id="greeting"class="fw-light " ></span> 
                            <?php echo htmlspecialchars($adminDetails['fullname']); ?>.</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb bg-light float-sm-end ">
                                <li class="breadcrumb-item "><a href="#" class="text-primary">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                Dashboard
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-content mt-0" style="margin-bottom: 0px important;"> 
			<div class="container-fluid"> <!--begin::Row-->
                    <div class="row "> <!--begin::Col-->
                        <div class="col-lg-3 col-md-6"> 
                            <div class="small-box">
                                <div class="inner ml-2">
                                    <h3> <?php echo $count_files ?? '0'; ?></h3>
                                    <p>Archive Files</p>
                                </div> 
                                <div class="small-box-icon text-primary"><i class="fas fa-folder"></i></div> 
                            </div> 
                        </div>
                        <div class="col-lg-3 col-md-6"> 
                            <div class="small-box">
                                <div class="inner ml-2">
                                    <h3> <?php echo $visitors_count ?? '0'; ?></h3>
                                    <p>Website Visitors</p>
                                </div> 
                                <div class="small-box-icon text-primary"><i class="fas fa-eye"></i></div> 
                            </div> 
                        </div>
                        <div class="col-lg-3 col-md-6"> 
                            <div class="small-box">
                                <div class="inner ml-2">
                                    <h3> <?php echo $totalReturningVisitors ?? '0'; ?></h3>
                                    <p>Returning</p>
                                </div> 
                                <div class="small-box-icon text-primary"><i class="fas fa-eye"></i></div> 
                            </div> 
                        </div>
                        <div class="col-lg-3 col-md-6"> 
                            <div class="small-box bg-info1-gradient">
                                <div class="inner ml-2">
                                    <h3> <?php echo $events_count ?? '0'; ?></h3>
                                    <p>Upcoming Events</p>
                                </div> 
                                <div class="small-box-icon text-primary"><i class="fas fa-chart-line"></i></div> 
                            </div> 
                        </div>
                      
                    </div>
                    <div class="row ">
                        <div class="col-lg-3 col-md-6"> 
                            <div class="small-box">
                                <div class="inner ml-2">
                                    <h3><?php echo $request_count ?? '0'; ?></h3>
                                    <p> File Requests</p>
                                </div> 
                                <div class="small-box-icon text-primary"> 
                               <i class="fas fa-arrow-turn-down"></i></div> 
                            </div> 
                        </div>
                       
                        <div class="col-lg-3 col-md-6"> 
                            <div class="small-box">
                                <div class="inner ml-2">
                                    <h3><?php echo $projectsCount ?? '0'; ?></h3>
                                    <p>Total Projects</p>
                                </div>
                                <div class="small-box-icon text-primary"><i class="fas fa-folder-plus"></i></div> 
                            </div> 
                        </div> 
                      
                        <div class="col-lg-3 col-md-6"> 
                            <div class="small-box">
                                <div class="inner ml-2">
                                    <h3><?php echo $unread_msgs_count ?? '0'; ?></h3>
                                    <p>Messages</p>
                                </div> 
                                <div class="small-box-icon text-primary"><i class="fas fa-message"></i></div> 
                            </div> 
                        </div> 
                        <div class="col-lg-3 col-md-6"> 
                            <div class="small-box">
                                <div class="inner ml-2">
                                    <h3><?php echo $adminCount ?? '0'; ?></h3>
                                    <p>System Users</p>
                                </div> 
                                <div class="small-box-icon text-primary"><i class="fas fa-users"></i></div> 
                            </div> 
                        </div> 
                    </div> <!--end::Row--> <!--begin::Row-->
         

<div class="row">
    <div class="col-lg-6">
        <div class="card p-2 pt-4 char">
            <div id="kit1"></div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card p-2 pt-4 char">
            <div id="kit2"></div>
        </div>
    </div>
</div>


                    <div class="row"> <!-- Start col -->
                        <div class="col-lg-5">
                            <div class="card char p-2 pt-4">
                                <div id="container"></div>
                            </div>
                        </div> 
                        <div class="col-lg-7">
                            <div class="card p-2 pt-4 char">
                            
                                
                                <div id="containe" >
                                
                                </div> 
                            </div>
                        </div> 
                    </div> 

                    
                </div> 
              
            </div> 
           </main>
          
        </div>
    </div>
    <?php include "includes/footer.php" ?>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
   
<script type="text/javascript">
    // Chart for Kit 1 (esawod_1)
    Highcharts.chart('kit1', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'E-SAWOD1 Average Data for <?php echo $monthName; ?>'
        },
        xAxis: {
            categories: Array.from({ length: 31 }, (v, k) => k + 1), // Create an array from 1 to 31
            title: {
                text: 'Day of the Month'
            }
        },
        yAxis: {
            title: {
                text: 'Values'
            }
        },
        legend: {
                align: 'center',
                verticalAlign: 'top',
                layout: 'horizontal',
                backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || 'rgba(255,255,255,0.25)'
            },
            credits: {
                enabled: false
            },
        series: [{
            name: 'Water Level (cm)',
            type: 'column',
            data: <?php echo json_encode($chart_data_1['level_data']); ?>
        }, {
            name: 'Humidity (%)',
            data: <?php echo json_encode($chart_data_1['humidity_data']); ?>
        }, {
            name: 'Temperature (°C)',
            color: '#495057',
            data: <?php echo json_encode($chart_data_1['temperature_data']); ?>
        }],
        tooltip: {
            shared: true,
            valueSuffix: ' units'
        }
    });

    Highcharts.chart('kit2', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'E-SAWOD2 Average Data for <?php echo $monthName; ?>'
        },
        xAxis: {
            categories: Array.from({ length: 31 }, (v, k) => k + 1), // Create an array from 1 to 31
            title: {
                text: 'Day of the Month'
            }
        },
        yAxis: {
            title: {
                text: 'Values'
            }
        },
        legend: {
                align: 'center',
                verticalAlign: 'top',
                layout: 'horizontal',
                backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || 'rgba(255,255,255,0.25)'
            },
            credits: {
                enabled: false
            },
        series: [{
            name: 'Water Level (cm)',
            type: 'column',
            data: <?php echo json_encode($chart_data_2['level_data']); ?>
        }, {
            name: 'Humidity (%)',
            data: <?php echo json_encode($chart_data_2['humidity_data']); ?>
        }, {
            name: 'Temperature (°C)',
            color: '#495057',
            data: <?php echo json_encode($chart_data_2['temperature_data']); ?>
        }],
        tooltip: {
            shared: true,
            valueSuffix: ' units'
        }
    });
</script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Define custom colors for each status
            const statusColors = {
                'Unpublished': '#495057',  // bg-secondary
                // 'Declined': '#dc3545', 
                'Published': '#0062cc',  // bg-success
                // 'Archived': '#ffc107'    
            };

            // Your original pie chart data
            const pieChartData = <?php echo json_encode($pieChartData); ?>;

            // Ensure both "Unpublished" and "Published" statuses are always included
            const statuses = ['Unpublished', 'Published'];  // Add other statuses if needed
            statuses.forEach(status => {
                if (!pieChartData.some(item => item.name === status)) {
                    // Add the status with 0 if it's not in the data
                    pieChartData.push({ name: status, y: 0 });
                }
            });

            // Map your data to include the colors and slicing
            const dataWithColors = pieChartData.map(item => ({
                name: item.name,
                y: item.y,
                color: statusColors[item.name] || '#dc3545',  // Default color if no match
                sliced: item.name === 'Unpublished', 
                selected: item.name === 'Published'
            }));

            Highcharts.chart('container', {
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 10,
                        beta: 0
                    }
                },
                title: {
                    text: 'Archive Files Overview'
                },
                tooltip: {
                    pointFormat: '{point.name}: <b>{point.y} ({point.percentage:.1f}%)</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        depth: 70,
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
                    colorByPoint: false,  // Set to false since we are specifying colors directly
                    data: dataWithColors  // Use the modified data with colors and slicing
                }]
            });
        });

    </script>



<script>
    // Pass the PHP data to JavaScript
    let visitorDailyData = <?php echo json_encode($visitorDailyData); ?>;

    document.addEventListener('DOMContentLoaded', function () {
        // Get the number of days in the current month
        const daysInMonth = new Date(new Date().getFullYear(), new Date().getMonth() + 1, 0).getDate();

        // Generate categories for days of the month
        const categories = Array.from({ length: daysInMonth }, (_, i) => (i + 1).toString());

        // Render the chart
        Highcharts.chart('containe', {
            chart: {
                zooming: {
                    type: 'xy'
                },
                options3d: {
                    enabled: true,
                    alpha: 10,
                    beta: 0
                }
            },
            title: {
                text: 'Daily Visitors (New vs Returning)',
                align: 'center'
            },
            subtitle: {
                text: 'Source: <a href="#" target="_blank">GoodLand</a>',
                align: 'center'
            },
            xAxis: [{
                categories: categories,
                crosshair: true
            }],
            yAxis: {
                title: {
                    text: 'Visitor Count'
                },
                labels: {
                    formatter: function () {
                        return this.value; // Show the raw values
                    }
                }
            },
            tooltip: {
                shared: true,
                valueSuffix: ' visitors'
            },
            legend: {
                align: 'center',
                verticalAlign: 'top',
                layout: 'horizontal',
                backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || 'rgba(255,255,255,0.25)'
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'New Visitors',
                type: 'line',
                color: '#495057',
                data: visitorDailyData.newVisitors,
                tooltip: {
                    valueSuffix: ' visitors'
                }
            }, {
                name: 'Returning Visitors',
                type: 'line',
                color: '#0062cc',
                data: visitorDailyData.returningVisitors,
                tooltip: {
                    valueSuffix: ' visitors'
                }
            }]
        });
    });
</script>


    <script>
       document.addEventListener("DOMContentLoaded", function() {
            document.querySelector(".greetingmsg").classList.add("show");
            document.querySelector(".panel").classList.add("show");
        });

    </script>
  
	

   
</body>

</html>