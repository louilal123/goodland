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
                                    <p>Unread Messages</p>
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
                    <div class="col-md-6 d-flex">
      <div class="card">
      <div  id="cylinder1"></div>
      </div>
      <div class="card ">
          <div class="card-body">
          
              <!-- <p id="esawod1-water-level">Water Level: -- cm</p> -->
              <h5 id="esawod1-temp"><span class="text-danger">Temperature: -- °C</span> </h5>
              <h5 id="esawod1-humidity" ><span class="text-warning">Humidity: -- %</span></h5>
          </div>
      </div>
  </div>

<div class="col-md-6">
    <div class="card ">
        <div class="card-body">
            <h5>E-SAWOD 2</h5>
            <p id="esawod2-water-level">Water Level: -- cm</p>
            <p id="esawod2-temp">Temperature: -- °C</p>
            <p id="esawod2-humidity">Humidity: -- RH %</p>
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
    let visitorMonthlyData = <?php echo json_encode($visitorMonthlyData); ?>;
    
    // Fetch monthly data from PHP
    document.addEventListener('DOMContentLoaded', function () {
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
        const adjustedNewVisitors = visitorMonthlyData.newVisitors.slice(0, currentMonth + 1);
        const adjustedReturningVisitors = visitorMonthlyData.returningVisitors.slice(0, currentMonth + 1);

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
                text: 'Monthly Visitors (New vs Returning)',
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
                valueSuffix: ' visitors' // Adjust the suffix based on your data type
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
                type: 'column',
                color: '#495057', // Green for new visitors
                data: adjustedNewVisitors,
                tooltip: {
                    valueSuffix: ' visitors'
                }
            }, {
                name: 'Returning Visitors',
                type: 'column',
                color: '#0062cc', // Red for returning visitors
                data: adjustedReturningVisitors,
                tooltip: {
                    valueSuffix: ' visitors'
                }
            }]
        });
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


<!-- FusionCharts -->
<script type="text/javascript">
    FusionCharts.ready(function(){
        var chartObj = new FusionCharts({
            type: 'cylinder',
            dataFormat: 'json',
            renderAt: 'cylinder1',
            width: '200',
            height: '350',
            dataSource: {
                "chart": {
                    "theme": "fusion",
                    "caption": "E-SAWOD 1",
                    "captionFontColor": "#0062cc",
                    "subcaption": "Live Monitoring",
                    "lowerLimit": "0",
                    "upperLimit": "30", // Maximum water level of 30 cm
                    "lowerLimitDisplay": "Empty",
                    "upperLimitDisplay": "Full",
                    "numberSuffix": " cm",
                    "showValue": "1",
                    "valueFontSize": "18",
                    "chartBottomMargin": "45",
                    "cylFillColor": "#87CEEB", // Sky Blue color
                    "cyloriginy": "300",
                    "use3DLighting": "0"
                },
                "value": "18", // Initial value
                "annotations": {
                    "origw": "500",
                    "origh": "40",
                    "autoscale": "1",
                    "groups": [{
                        "id": "range",
                        "items": [{
                            "id": "rangeBg",
                            "type": "rectangle",
                            "x": "$canvasCenterX-45",
                            "y": "$chartEndY-30",
                            "tox": "$canvasCenterX +45",
                            "toy": "$chartEndY-75",
                            "fillcolor": "#0062cc"
                        }, {
                            "id": "rangeText",
                            "type": "Text",
                            "fontSize": "11",
                            "fillcolor": "#333333",
                            "text": "Current Level",
                            "x": "$chartCenterX-45",
                            "y": "$chartEndY-50"
                        }]
                    }]
                }
            },
            "events": {
                "rendered": function(evtObj, argObj) {
                    var gaugeRef = evtObj.sender;

                    // Function to update the water level on the FusionCharts cylinder
                    function updateWaterLevel() {
                        $.ajax({
                            url: '../classes/fetch1.php',  // PHP file for e-sawod_1 data
                            type: 'GET',
                            success: function(response) {
                                var data = JSON.parse(response);
                                var newLevel = data.value;  // The water level data returned from PHP
                                
                                // Ensure the value is within the acceptable range (0–30)
                                if (newLevel < 0) newLevel = 0;
                                if (newLevel > 30) newLevel = 30;

                                // Update the FusionCharts gauge with the new water level value
                                gaugeRef.feedData("&value=" + newLevel);
                                updateAnnotations(gaugeRef, newLevel);  // Update annotations (optional)
                            }
                        });
                    }

                    // Initial update
                    updateWaterLevel();

                    // Update the water level every 5 seconds (5000ms)
                    setInterval(updateWaterLevel, 5000);  // Update every 5 seconds
                },
                "realTimeUpdateComplete": function(evt, arg) {
                    // This function updates the annotation and color based on the water level value
                    var annotations = evt.sender.annotations,
                        dataVal = evt.sender.getData(),
                        colorVal;

                    // Assign colors based on water level
                    if (dataVal >= 30) {
                        colorVal = "#dc3545"; // Red for full level
                    } else if (dataVal <= 12) {
                        colorVal = "#ffc107"; // Yellow for low level
                    } else {
                        colorVal = "#28a745"; // Green for mid level
                    }

                    // Update annotations and background color of the cylinder
                    annotations && annotations.update('rangeText', {
                        "text": "WL: " + dataVal + " cm",
                        "bgAlpha": "100",
                        "bgColor": colorVal
                    });
                    
                    annotations && annotations.update('rangeBg', {
                        "fillcolor": colorVal
                    });
                },
                "disposed": function(evt, arg) {
                    clearInterval(evt.sender.chartInterval);
                }
            }
        });

        // Render the FusionCharts gauge
        chartObj.render();
    });
</script>

<script>
$(document).ready(function() {
    // Function to fetch and display the latest data for esawod_1
    function fetchEsawod1Data() {
        $.ajax({
            url: '/../classes/fetch_esawod1.php',  // Path to the PHP file that fetches esawod_1 data
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data['esawod_1']) {
                    $('#esawod1-water-level').text('Water Level: ' + data['esawod_1'].level_cm + ' cm');
                    $('#esawod1-temp').text('Temperature: ' + data['esawod_1'].temperature + '°C');
                    $('#esawod1-humidity').text('Humidity: ' + data['esawod_1'].humidity + '%');
                } else {
                    $('#esawod1-water-level').text('No data for esawod_1');
                    $('#esawod1-temp').text('No data for esawod_1');
                    $('#esawod1-humidity').text('No data for esawod_1');
                }
            },
            error: function(err) {
                console.log('Error fetching esawod_1 data:', err);
            }
        });
    }

    // Function to fetch and display the latest data for esawod_2
    function fetchEsawod2Data() {
        $.ajax({
            url: '/../classes/fetch_esawod2.php',  // Path to the PHP file that fetches esawod_2 data
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data['esawod_2']) {
                    $('#esawod2-water-level').text('Water Level: ' + data['esawod_2'].level_cm + ' cm');
                    $('#esawod2-temp').text('Temperature: ' + data['esawod_2'].temperature + '°C');
                    $('#esawod2-humidity').text('Humidity: ' + data['esawod_2'].humidity + '%');
                } else {
                    $('#esawod2-water-level').text('No data for esawod_2');
                    $('#esawod2-temp').text('No data for esawod_2');
                    $('#esawod2-humidity').text('No data for esawod_2');
                }
            },
            error: function(err) {
                console.log('Error fetching esawod_2 data:', err);
            }
        });
    }

    fetchEsawod1Data();
    fetchEsawod2Data();
    setInterval(function() {
        fetchEsawod1Data();
        fetchEsawod2Data();
    }, 5000);  // Refresh every 10 seconds
});

</script>
<script>
    // Function to load data from PHP script
    function fetchData() {
        $.ajax({
            url: '../classes/node_db.php', // PHP script that fetches data
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                // Clear existing table rows before inserting new data
                $('#sensorDataTable tbody').empty();

                // Loop through the data and append rows to the table
                data.forEach(function(row) {
                    // Convert UTC timestamp to Cebu local time (UTC+8)
                    var localTime = new Date(row.timestamp);
                    localTime.setHours(localTime.getHours() + 8); // Add 8 hours to convert to UTC+8

                    var newRow = '<tr>' +
                        '<td>' + row.kit_name + '</td>' +
                        '<td>' + row.level_cm + ' cm</td>' +
                        '<td>' + row.humidity + ' %</td>' +
                        '<td>' + row.temperature + ' °C</td>' +
                        '<td>' + localTime.toLocaleString() + '</td>' + // Show local time
                        '</tr>';
                    $('#sensorDataTable tbody').append(newRow);
                });
            },
            error: function() {
                console.log("Error fetching data.");
            }
        });
    }

    // Fetch data initially
    fetchData();

    // Fetch new data every 5 seconds to keep the table updated
    setInterval(fetchData, 5000);
</script>


    <script>
       document.addEventListener("DOMContentLoaded", function() {
            document.querySelector(".greetingmsg").classList.add("show");
            document.querySelector(".panel").classList.add("show");
        });

    </script>
  
	

   
</body>

</html>