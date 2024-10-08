<?php include "classes/admindetails.php";
?>

<!DOCTYPE html>
<html lang="en"> 
<?php include "includes/header.php"; ?>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<!-- Flag sprites service provided by Martijn Lafeber,
    https://github.com/lafeber/world-flags-sprite/blob/master/LICENSE -->
    <link rel="stylesheet" type="text/css"
      href="https://cdn.jsdelivr.net/gh/lafeber/world-flags-sprite/stylesheets/flags32-both.css" />

</head>
<style>

#containe {
   
    height: 280px;
    margin: 0 auto;
}

    
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

#containe {
    min-width: 310px;
    max-width: 800px;
    height: 400px;
    margin: 0 auto;
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
                                Dashboard
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
                        <div class="col-lg-5">
                            <div class="card p-4">
                                <div id="container"></div>
                            </div>
                        </div> 
                        <div class="col-lg-7 bg-light p-0">
                                    <div class='buttons'>
                                    <button id='2000'>
                                        2000
                                    </button>
                                    <button id='2004'>
                                        2004
                                    </button>
                                    <button id='2008'>
                                        2008
                                    </button>
                                    <button id='2012'>
                                        2012
                                    </button>
                                    <button id='2016'>
                                        2016
                                    </button>
                                    <button id='2020' class='active'>
                                        2020
                                    </button>
                                    </div>
                                <div id="containe"></div> <!-- Changed ID to be unique -->
                           
                        </div> 
                    </div> <!-- Close the first row -->

                    <div class="row mt-4"> <!-- New row for the next columns -->
                        <div class="col-lg-7">
                            <div class="card p-4">
                                <div id="container12"></div> <!-- Changed ID to be unique -->
                            </div>
                        </div> 
                        <div class="col-lg-5">
                            <div class="card p-4">
                                <div id="container1"></div> <!-- Changed ID to be unique -->
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
    const dataPrev = {
    2020: [
        ['kr', 9],
        ['jp', 12],
        ['au', 8],
        ['de', 17],
        ['ru', 19],
        ['cn', 26],
        ['gb', 27],
        ['us', 46]
    ],
    2016: [
        ['kr', 13],
        ['jp', 7],
        ['au', 8],
        ['de', 11],
        ['ru', 20],
        ['cn', 38],
        ['gb', 29],
        ['us', 47]
    ],
    2012: [
        ['kr', 13],
        ['jp', 9],
        ['au', 14],
        ['de', 16],
        ['ru', 24],
        ['cn', 48],
        ['gb', 19],
        ['us', 36]
    ],
    2008: [
        ['kr', 9],
        ['jp', 17],
        ['au', 18],
        ['de', 13],
        ['ru', 29],
        ['cn', 33],
        ['gb', 9],
        ['us', 37]
    ],
    2004: [
        ['kr', 8],
        ['jp', 5],
        ['au', 16],
        ['de', 13],
        ['ru', 32],
        ['cn', 28],
        ['gb', 11],
        ['us', 37]
    ],
    2000: [
        ['kr', 7],
        ['jp', 3],
        ['au', 9],
        ['de', 20],
        ['ru', 26],
        ['cn', 16],
        ['gb', 1],
        ['us', 44]
    ]
};

const data = {
    2020: [
        ['kr', 6],
        ['jp', 27],
        ['au', 17],
        ['de', 10],
        ['ru', 20],
        ['cn', 38],
        ['gb', 22],
        ['us', 39]
    ],
    2016: [
        ['kr', 9],
        ['jp', 12],
        ['au', 8],
        ['de', 17],
        ['ru', 19],
        ['cn', 26],
        ['gb', 27],
        ['us', 46]
    ],
    2012: [
        ['kr', 13],
        ['jp', 7],
        ['au', 8],
        ['de', 11],
        ['ru', 20],
        ['cn', 38],
        ['gb', 29],
        ['us', 47]
    ],
    2008: [
        ['kr', 13],
        ['jp', 9],
        ['au', 14],
        ['de', 16],
        ['ru', 24],
        ['cn', 48],
        ['gb', 19],
        ['us', 36]
    ],
    2004: [
        ['kr', 9],
        ['jp', 17],
        ['au', 18],
        ['de', 13],
        ['ru', 29],
        ['cn', 33],
        ['gb', 9],
        ['us', 37]
    ],
    2000: [
        ['kr', 8],
        ['jp', 5],
        ['au', 16],
        ['de', 13],
        ['ru', 32],
        ['cn', 28],
        ['gb', 11],
        ['us', 37]
    ]
};

const countries = {
    kr: {
        name: 'South Korea',
        color: '#FE2371'
    },
    jp: {
        name: 'Japan',
        color: '#544FC5'
    },
    au: {
        name: 'Australia',
        color: '#2CAFFE'
    },
    de: {
        name: 'Germany',
        color: '#FE6A35'
    },
    ru: {
        name: 'Russia',
        color: '#6B8ABC'
    },
    cn: {
        name: 'China',
        color: '#1C74BD'
    },
    gb: {
        name: 'Great Britain',
        color: '#00A6A6'
    },
    us: {
        name: 'United States',
        color: '#D568FB'
    }
};

// Add upper case country code
for (const [key, value] of Object.entries(countries)) {
    value.ucCode = key.toUpperCase();
}


const getData = data => data.map(point => ({
    name: point[0],
    y: point[1],
    color: countries[point[0]].color
}));

const chart = Highcharts.chart('containe', {
    chart: {
        type: 'column'
    },
    // Custom option for templates
    countries,
    title: {
        text: 'Summer Olympics 2020 - Top 5 countries by Gold medals',
        align: 'left'
    },
    subtitle: {
        text: 'Comparing to results from Summer Olympics 2016 - Source: <a ' +
            'href="https://olympics.com/en/olympic-games/tokyo-2020/medals"' +
            'target="_blank">Olympics</a>',
        align: 'left'
    },
    plotOptions: {
        series: {
            grouping: false,
            borderWidth: 0
        }
    },
    legend: {
        enabled: false
    },
    tooltip: {
        shared: true,
        headerFormat: '<span style="font-size: 15px">' +
            '{series.chart.options.countries.(point.key).name}' +
            '</span><br/>',
        pointFormat: '<span style="color:{point.color}">\u25CF</span> ' +
            '{series.name}: <b>{point.y} medals</b><br/>'
    },
    xAxis: {
        type: 'category',
        accessibility: {
            description: 'Countries'
        },
        max: 4,
        labels: {
            useHTML: true,
            animate: true,
            format: '{chart.options.countries.(value).ucCode}<br>' +
                '<span class="f32">' +
                '<span style="display:inline-block;height:32px;' +
                'vertical-align:text-top;" class="flag {value}">' +
                '</span></span>',
            style: {
                textAlign: 'center'
            }
        }
    },
    yAxis: [{
        title: {
            text: 'Gold medals'
        },
        showFirstLabel: false
    }],
    series: [{
        color: 'rgba(158, 159, 163, 0.5)',
        pointPlacement: -0.2,
        linkedTo: 'main',
        data: dataPrev[2020].slice(),
        name: '2016'
    }, {
        name: '2020',
        id: 'main',
        dataSorting: {
            enabled: true,
            matchByName: true
        },
        dataLabels: [{
            enabled: true,
            inside: true,
            style: {
                fontSize: '16px'
            }
        }],
        data: getData(data[2020]).slice()
    }],
    exporting: {
        allowHTML: true
    }
});

const locations = [
    {
        city: 'Tokyo',
        year: 2020
    }, {
        city: 'Rio',
        year: 2016
    }, {
        city: 'London',
        year: 2012
    }, {
        city: 'Beijing',
        year: 2008
    }, {
        city: 'Athens',
        year: 2004
    }, {
        city: 'Sydney',
        year: 2000
    }
];

locations.forEach(location => {
    const btn = document.getElementById(location.year);

    btn.addEventListener('click', () => {

        document.querySelectorAll('.buttons button.active')
            .forEach(active => {
                active.className = '';
            });
        btn.className = 'active';

        chart.update({
            title: {
                text: 'Summer Olympics ' + location.year +
                    ' - Top 5 countries by Gold medals'
            },
            subtitle: {
                text: 'Comparing to results from Summer Olympics ' +
                    (location.year - 4) +
                    ' - Source: <a href="https://olympics.com/en/olympic-games/' +
                    (location.city.toLowerCase()) +
                    '-' + (location.year) +
                    '/medals" target="_blank">Olympics</a>'
            },
            series: [{
                name: location.year - 4,
                data: dataPrev[location.year].slice()
            }, {
                name: location.year,
                data: getData(data[location.year]).slice()
            }]
        }, true, false, {
            duration: 800
        });
    });
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