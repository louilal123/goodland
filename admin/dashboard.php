<?php include "classes/admindetails.php";
?>

<!DOCTYPE html>
<html lang="en"> 
<?php include "includes/header.php"; ?>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>

<!-- Flag sprites service provided by Martijn Lafeber,
    https://github.com/lafeber/world-flags-sprite/blob/master/LICENSE -->
    <link rel="stylesheet" type="text/css"
      href="https://cdn.jsdelivr.net/gh/lafeber/world-flags-sprite/stylesheets/flags32-both.css" />

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
                                    <p>Total Files</p>
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
                                    <h3> <?php echo $visitors_count ?? '0'; ?></h3>
                                    <p>Returning</p>
                                </div> 
                                <div class="small-box-icon text-primary"><i class="fas fa-eye"></i></div> 
                            </div> 
                        </div>
                        <div class="col-lg-3 col-md-6"> 
                            <div class="small-box bg-info1-gradient">
                                <div class="inner ml-2">
                                    <h3> <?php echo $events_count ?? '0'; ?></h3>
                                    <p>Events</p>
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
                                    <h3><?php echo $catchments_count ?? '0'; ?></h3>
                                    <p>Water Catchments</p>
                                </div> 
                                <div class="small-box-icon text-primary"><i class="fas fa-chart-line"></i></div> 
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
                    </div> <!-- Close the first row -->

                    <div class="row mt-4"> <!-- New row for the next columns -->
                        <div class="col-lg-7">
                            <div class="card char p-4">
                                <div id="container12"></div> <!-- Changed ID to be unique -->
                            </div>
                        </div> 
                        <div class="col-lg-5">
                            <div class="card char p-4">
                                <div id="container1"></div> <!-- Changed ID to be unique -->
                            </div>
                        </div> 
                    </div> 


                    
                </div> 
              
            </div> 
           </main>
          
        </div>
    </div>
    <?php include "includes/footer.php" ?>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Define custom colors for each status
        const statusColors = {
            'Unpublished': '#495057',  // bg-secondary
            // 'Declined': '#dc3545', 
            'Published': '#0062cc',  // bg-success
            // 'Archived': '#ffc107'    
        };

        // Map your data to include the colors and slicing
        const dataWithColors = <?php echo json_encode($pieChartData); ?>.map(item => ({
            name: item.name,
            y: item.y,
            color: statusColors[item.name] || '#dc3545', 
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
                text: 'Library Files Overview'
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
                colorByPoint: false, // Set to false since we are specifying colors directly
                data: dataWithColors // Use the modified data with colors and slicing
            }]
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Fetch monthly data from PHP
    let monthlyData = <?php echo json_encode($monthlyData); ?>;

    // Get the current month (0 for January, 11 for December)
    const currentMonth = new Date().getMonth(); // 0-based index for months

    // Define all month names
    const allMonths = [
        'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
        'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
    ];

    // Create a new array of categories that only includes months up to the current month
    const categories = allMonths.slice(0, currentMonth + 1); // +1 to include the current month

    // Adjust monthly data to only include the relevant months
    const adjustedWaterLevel = monthlyData.waterLevel.slice(0, currentMonth + 1);
    const adjustedTemperature = monthlyData.temperature.slice(0, currentMonth + 1);
    const adjustedHumidity = monthlyData.humidity.slice(0, currentMonth + 1);

    // Render the chart
    Highcharts.chart('containe', {
        chart: {
            zooming: {
                type: 'xy'
            },
          
                options3d: {
                enabled: true,
                alpha: 10,
                beta: 0}
        },
        title: {
            text: 'Average Monthly Data from Water Catchment',
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
                text: 'Measurements'
            },
            labels: {
                formatter: function () {
                    return this.value; // Show the raw values
                }
            }
        },
        tooltip: {
            shared: true,
            valueSuffix: ' units' // Adjust the suffix based on your data type
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
            type: 'area',
            color: '#0062cc',
            data: adjustedWaterLevel,
            tooltip: {
                valueSuffix: ' cm'
            }
        }, {
            name: 'Temperature (°C)',
            type: 'line',
            color: '#dc3545',
            data: adjustedTemperature,
            tooltip: {
                valueSuffix: ' °C'
            }
        }, {
            name: 'Humidity (%)',
            type: 'line',
           color: '#ffc107',
            data: adjustedHumidity,
            tooltip: {
                valueSuffix: ' %'
            }
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

<script>
    // Fetch data from PHP
    let monthlyData = <?php echo json_encode($this->getMonthlyData()); ?>;

    function renderChart(data) {
        Highcharts.chart('containe', {
            chart: {
                zooming: {
                    type: 'xy'
                }
            },
            title: {
                text: 'Average Monthly Data from Water Catchment Tank',
                align: 'left'
            },
            subtitle: {
                text: 'Source: <a href="#" target="_blank">GoodLand</a>',
                align: 'left'
            },
            xAxis: [{
                categories: [
                    'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                ],
                crosshair: true
            }],
            yAxis: {
                title: {
                    text: 'Measurements'
                },
                labels: {
                    formatter: function () {
                        return this.value;
                    }
                }
            },
            tooltip: {
                shared: true,
                valueSuffix: ' units'
            },
            legend: {
                align: 'center',
                verticalAlign: 'bottom',
                layout: 'horizontal',
                backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || 'rgba(255,255,255,0.25)'
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Water Level (cm)',
                type: 'column',
                data: data.waterLevel,
                color: '#0062cc',
                tooltip: {
                    valueSuffix: ' cm'
                }
            }, {
                name: 'Temperature (°C)',
                type: 'spline',
                data: data.temperature,
                color: '#dc3545',
                tooltip: {
                    valueSuffix: '°C'
                }
            }, {
                name: 'Humidity (%)',
                type: 'spline',
                data: data.humidity,
                tooltip: {
                    valueSuffix: ' %'
                }
            }]
        });
    }

    // Initial render
    renderChart(monthlyData);
</script>

<script>
    // Data retrieved from https://gs.statcounter.com/browser-market-share#monthly-202201-202201-bar

// Create the chart
Highcharts.chart('container12', {
    chart: {
        type: 'column'
    },
    title: {
        align: 'left',
        text: 'Browser market shares. January, 2022'
    },
    subtitle: {
        align: 'left',
        text: 'Click the columns to view versions. Source: <a href="http://statcounter.com" target="_blank">statcounter.com</a>'
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Total percent market share'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}%'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: ' +
            '<b>{point.y:.2f}%</b> of total<br/>'
    },

    series: [
        {
            name: 'Browsers',
            colorByPoint: true,
            data: [
                {
                    name: 'Chrome',
                    y: 63.06,
                    drilldown: 'Chrome'
                },
                {
                    name: 'Safari',
                    y: 19.84,
                    drilldown: 'Safari'
                },
                {
                    name: 'Firefox',
                    y: 4.18,
                    drilldown: 'Firefox'
                },
                {
                    name: 'Edge',
                    y: 4.12,
                    drilldown: 'Edge'
                },
                {
                    name: 'Opera',
                    y: 2.33,
                    drilldown: 'Opera'
                },
                {
                    name: 'Internet Explorer',
                    y: 0.45,
                    drilldown: 'Internet Explorer'
                },
                {
                    name: 'Other',
                    y: 1.582,
                    drilldown: null
                }
            ]
        }
    ],
    drilldown: {
        breadcrumbs: {
            position: {
                align: 'right'
            }
        },
        series: [
            {
                name: 'Chrome',
                id: 'Chrome',
                data: [
                    [
                        'v65.0',
                        0.1
                    ],
                    [
                        'v64.0',
                        1.3
                    ],
                    [
                        'v63.0',
                        53.02
                    ],
                    [
                        'v62.0',
                        1.4
                    ],
                    [
                        'v61.0',
                        0.88
                    ],
                    [
                        'v60.0',
                        0.56
                    ],
                    [
                        'v59.0',
                        0.45
                    ],
                    [
                        'v58.0',
                        0.49
                    ],
                    [
                        'v57.0',
                        0.32
                    ],
                    [
                        'v56.0',
                        0.29
                    ],
                    [
                        'v55.0',
                        0.79
                    ],
                    [
                        'v54.0',
                        0.18
                    ],
                    [
                        'v51.0',
                        0.13
                    ],
                    [
                        'v49.0',
                        2.16
                    ],
                    [
                        'v48.0',
                        0.13
                    ],
                    [
                        'v47.0',
                        0.11
                    ],
                    [
                        'v43.0',
                        0.17
                    ],
                    [
                        'v29.0',
                        0.26
                    ]
                ]
            },
            {
                name: 'Firefox',
                id: 'Firefox',
                data: [
                    [
                        'v58.0',
                        1.02
                    ],
                    [
                        'v57.0',
                        7.36
                    ],
                    [
                        'v56.0',
                        0.35
                    ],
                    [
                        'v55.0',
                        0.11
                    ],
                    [
                        'v54.0',
                        0.1
                    ],
                    [
                        'v52.0',
                        0.95
                    ],
                    [
                        'v51.0',
                        0.15
                    ],
                    [
                        'v50.0',
                        0.1
                    ],
                    [
                        'v48.0',
                        0.31
                    ],
                    [
                        'v47.0',
                        0.12
                    ]
                ]
            },
            {
                name: 'Internet Explorer',
                id: 'Internet Explorer',
                data: [
                    [
                        'v11.0',
                        6.2
                    ],
                    [
                        'v10.0',
                        0.29
                    ],
                    [
                        'v9.0',
                        0.27
                    ],
                    [
                        'v8.0',
                        0.47
                    ]
                ]
            },
            {
                name: 'Safari',
                id: 'Safari',
                data: [
                    [
                        'v11.0',
                        3.39
                    ],
                    [
                        'v10.1',
                        0.96
                    ],
                    [
                        'v10.0',
                        0.36
                    ],
                    [
                        'v9.1',
                        0.54
                    ],
                    [
                        'v9.0',
                        0.13
                    ],
                    [
                        'v5.1',
                        0.2
                    ]
                ]
            },
            {
                name: 'Edge',
                id: 'Edge',
                data: [
                    [
                        'v16',
                        2.6
                    ],
                    [
                        'v15',
                        0.92
                    ],
                    [
                        'v14',
                        0.4
                    ],
                    [
                        'v13',
                        0.1
                    ]
                ]
            },
            {
                name: 'Opera',
                id: 'Opera',
                data: [
                    [
                        'v50.0',
                        0.96
                    ],
                    [
                        'v49.0',
                        0.82
                    ],
                    [
                        'v12.1',
                        0.14
                    ]
                ]
            }
        ]
    }
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