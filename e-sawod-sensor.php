<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "includes/header.php"; ?>
  <script defer src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script defer src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://code.highcharts.com/stock/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>

</head>
<style>
 

  .highcharts-figure,
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

.nav-link {
        font-size: 18px;
        color: gray;
    }

</style>
<body class="blog-page">
  <?php include "includes/topnav.php"; ?>
  <?php include "classes/fetch_last_minute_data.php"; ?>
  <main class="main">
    <!-- Page Title -->
    <div class="page-title">
      <br><br>
    
    </div><!-- End Page Title -->
    <!-- Values Section -->
    
    <section id="" class="values">
  <div class="container">
    <div class="row gy-4">
      <!-- Title Section -->
      <div class="col-md-12">
        <div class="card bg-body-secondary text-center">
          <h1><span class="bi bi-chart"></span> E-SAWOD SENSOR REAL-TIME DATA</h1>
        </div>
      </div>

      <!-- E-SAWOD 1 -->
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center">E-SAWOD 1</h5>
            <!-- Cylinder Chart -->
            <div id="cylinder1" class="mb-4"></div>
            <!-- Temperature and Humidity Charts -->
            <div class="row">
              <div class="col-md-6">
                <div id="temperature1"></div>
              </div>
              <div class="col-md-6">
                <div id="humidity1"></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- E-SAWOD 2 -->
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center">E-SAWOD 2</h5>
            <!-- Cylinder Chart -->
            <div id="cylinder2" class="mb-4"></div>
            <!-- Temperature and Humidity Charts -->
            <div class="row">
              <div class="col-md-6">
                <div id="temperature2"></div>
              </div>
              <div class="col-md-6">
                <div id="humidity2"></div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


<section id="charts" class="section values">
    <div class="container">
        <div class="row gy-4">
        <div class="col-md-12">
            <div class="card">
                <ul class="nav nav-underline">
                    <li class="nav-item">
                        <a class="nav-link disabled text-primary fw-bold" id="selectTab" href="#">Select:</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="lastMinuteTab" href="#" data-timeframe="lastminute">Last Minute</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="lastHourTab" href="#" data-timeframe="last24hours">Last Hour</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="lastDayTab" href="#" data-timeframe="last7days">Last Day</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="lastWeekTab" href="#" data-timeframe="lastweek">Last Week</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="lastMonthTab" href="#" data-timeframe="lastmonth">Last Month</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="allTimeTab" href="#" data-timeframe="alltime">All Time</a>
                    </li>
                </ul>
                <hr>
                <div class="tab-content mt-3">
                    <!-- Last Minute Content -->
                    <div class="tab-pane fade show active" id="lastMinuteContent" role="tabpanel">
                        <h5>Last Minute Data</h5>
                        <div id="kit1_minute" style="height: 400px;"></div> 
                        <div id="kit2_minute" style="height: 400px;"></div> 
                    </div>

                    <!-- Last Hour Content -->
                    <div class="tab-pane fade" id="lastHourContent" role="tabpanel">
                        <h5>Last Hour Data</h5>
                        <div id="kit1-hour" style="height: 400px;"></div> 
                        <div id="kit2-hour" style="height: 400px;"></div> 
                    </div>

                    <!-- Last Day Content -->
                    <div class="tab-pane fade" id="lastDayContent" role="tabpanel">
                        <h5>Last Day Data</h5>
                        <div id="kit1-day" style="height: 400px;"></div> 
                        <div id="kit2-day" style="height: 400px;"></div> 
                    </div>

                    <!-- Last Week Content -->
                    <div class="tab-pane fade" id="lastWeekContent" role="tabpanel">
                        <h5>Last Week Data</h5>
                        <div id="kit1-week" style="height: 400px;"></div> 
                        <div id="kit2-week" style="height: 400px;"></div> 
                    </div>

                    <!-- Last Month Content -->
                    <div class="tab-pane fade" id="lastMonthContent" role="tabpanel">
                        <h5>Last Month Data</h5>
                        <div id="kit1-month" style="height: 400px;"></div> 
                        <div id="kit2-month" style="height: 400px;"></div> 
                    </div>

                    <!-- All Time Content -->
                    <div class="tab-pane fade" id="allTimeContent" role="tabpanel">
                        <h5>All Time Data</h5>
                        <div id="kit1-alltime" style="height: 400px;"></div> 
                        <div id="kit2-alltime" style="height: 400px;"></div> 
                    </div>
                </div>
            </div>
        </div>

        </div>
    </div>
</section>

  </main>

  <?php include "includes/footer.php"; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>

  <script>
    document.querySelectorAll('.nav-link').forEach(function(tab) {
    tab.addEventListener('click', function(event) {
        event.preventDefault();

        document.querySelectorAll('.nav-link').forEach(function(link) {
            link.classList.remove('active');
        });

        tab.classList.add('active');

        var timeframe = tab.getAttribute('data-timeframe');

        document.querySelectorAll('.tab-pane').forEach(function(content) {
            content.classList.remove('show', 'active');
        });

        var contentId = `#${tab.id.replace('Tab', 'Content')}`;
        document.querySelector(contentId).classList.add('show', 'active');

        fetchDataForTimeframe(timeframe, contentId);
    });
});
  </script>

<script type="text/javascript">
   
    const chart1 = Highcharts.chart('kit1_minute', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'E-SAWOD1'
        },
        xAxis: {
            categories: ['Last Minute'],
            title: {
                text: 'Time'
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
            color: '#0d6efd',
            data: []
        }, {
            name: 'Humidity (%)',
            type: 'column',
            color: '#6c757d',
            data: []
        }, {
            name: 'Temperature (°C)',
            type: 'column', 
            color: '#dc3545',
            data: []
        }],
        tooltip: {
            shared: true,
            valueSuffix: ' units'
        }
    });

    const chart2 = Highcharts.chart('kit2_minute', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'E-SAWOD2'
        },
        xAxis: {
            categories: ['Last Minute'],
            title: {
                text: 'Time'
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
            color: '#0d6efd',
            data: []
        }, {
            name: 'Humidity (%)',
            type: 'column',
            color: '#6c757d',
            data: []
        }, {
            name: 'Temperature (°C)',
            type: 'column', 
            color: '#dc3545',
            data: []
        }],
        tooltip: {
            shared: true,
            valueSuffix: ' units'
        }
    });

    // Function to fetch the last minute's data and update the charts
    function fetchAndUpdateCharts() {
        // Send an AJAX request to the PHP endpoint
        $.ajax({
            url: 'classes/fetch_last_minute_data.php', // PHP script to fetch last minute data
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                // Update Kit 1 chart
                chart1.series[0].setData(response.kit1.level_data); // Update Water Level
                chart1.series[1].setData(response.kit1.humidity_data); // Update Humidity
                chart1.series[2].setData(response.kit1.temperature_data); // Update Temperature

                // Update Kit 2 chart
                chart2.series[0].setData(response.kit2.level_data); // Update Water Level
                chart2.series[1].setData(response.kit2.humidity_data); // Update Humidity
                chart2.series[2].setData(response.kit2.temperature_data); // Update Temperature
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    setInterval(fetchAndUpdateCharts, 1000); 

    fetchAndUpdateCharts();
</script>

<script type="text/javascript">
    FusionCharts.ready(function () {
        // Initialize the chart
        var chartObj = new FusionCharts({
            type: 'angulargauge',
            renderAt: 'humidity1', // ID of the container div
            width: '100%', // Makes the chart responsive
            height: '300', // Chart height
            dataFormat: 'json',
            dataSource: {
                "chart": {
                    "caption": "Humidity Level",
                    "subcaption": "Real-Time Monitor",
                    "lowerLimit": "0",
                    "upperLimit": "70",
                    "numberSuffix": "%",
                    "theme": "fusion",
                    "showValue": "1", // Show value on the gauge
                    "valueFontSize": "14" // Font size for the displayed value
                },
                "colorRange": {
                    "color": [
                        {
                            "minValue": "0",
                            "maxValue": "30",
                            "code": "#e44a00" // Red for low humidity
                        },
                        {
                            "minValue": "30",
                            "maxValue": "60",
                            "code": "#f8bd19" // Yellow for moderate humidity
                        },
                        {
                            "minValue": "60",
                            "maxValue": "100",
                            "code": "#6baa01" // Green for high humidity
                        }
                    ]
                },
                "dials": {
                    "dial": [
                        {
                            "value": "0" // Initial value; this will update dynamically
                        }
                    ]
                }
            }
        });

        // Render the chart
        chartObj.render();

        // Real-time update mechanism
        setInterval(() => {
            fetch('classes/speedometer1.php') // Path to the PHP file providing real-time data
                .then(response => {
                    // Check if response is OK (status 200)
                    if (!response.ok) {
                        throw new Error("Network response was not ok " + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    // Validate the returned data
                    if (data.humidity !== undefined && !isNaN(data.humidity)) {
                        var newHumidity = data.humidity;

                        // Update the gauge value
                        chartObj.feedData("&value=" + newHumidity);
                        console.log("Updated Humidity:", newHumidity);
                    } else {
                        console.error("Invalid humidity data:", data);
                    }
                })
                .catch(error => {
                    console.error("Error fetching humidity data:", error);
                });
        }, 3000); // Fetch new data every 3 seconds
    });
</script>


<script type="text/javascript">
    FusionCharts.ready(function () {
        
        var chartObj = new FusionCharts({
            type: 'angulargauge',
            renderAt: 'humidity2', 
            width: '100%', 
            height: '300', 
            dataFormat: 'json',
            dataSource: {
                "chart": {
                    "caption": "Humidity Level",
                    "subcaption": "Real-Time Monitor",
                    "lowerLimit": "0",
                    "upperLimit": "70",
                    "numberSuffix": "%",
                    "theme": "fusion",
                    "showValue": "1", // Show value on the gauge
                    "valueFontSize": "14" // Font size for the displayed value
                },
                "colorRange": {
                    "color": [
                        {
                            "minValue": "0",
                            "maxValue": "30",
                            "code": "#e44a00" // Red for low humidity
                        },
                        {
                            "minValue": "30",
                            "maxValue": "60",
                            "code": "#f8bd19" // Yellow for moderate humidity
                        },
                        {
                            "minValue": "60",
                            "maxValue": "100",
                            "code": "#6baa01" // Green for high humidity
                        }
                    ]
                },
                "dials": {
                    "dial": [
                        {
                            "value": "0" // Initial value; this will update dynamically
                        }
                    ]
                }
            }
        });

        // Render the chart
        chartObj.render();

        // Real-time update mechanism
        setInterval(() => {
            fetch('classes/speedometer1.php') // Path to the PHP file providing real-time data
                .then(response => {
                    // Check if response is OK (status 200)
                    if (!response.ok) {
                        throw new Error("Network response was not ok " + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    // Validate the returned data
                    if (data.humidity !== undefined && !isNaN(data.humidity)) {
                        var newHumidity = data.humidity;

                        // Update the gauge value
                        chartObj.feedData("&value=" + newHumidity);
                        console.log("Updated Humidity:", newHumidity);
                    } else {
                        console.error("Invalid humidity data:", data);
                    }
                })
                .catch(error => {
                    console.error("Error fetching humidity data:", error);
                });
        }, 3000); // Fetch new data every 3 seconds
    });
</script>



<script type="text/javascript">
    FusionCharts.ready(function(){
        var chartObj = new FusionCharts({
            type: 'thermometer',
            renderAt: 'temperature2',
            width: '240',
            height: '310',
            dataFormat: 'json',
            dataSource: {
                "chart": {
                    "caption": "E-SAWOD 1",
                    "subcaption": "TEMPERATURE",
                    "lowerLimit": "0",
                    "upperLimit": "50",
                    "decimals": "1",
                    "numberSuffix": "°C",
                    "showhovereffect": "1",
                    "thmFillColor": "#008ee4",
                    "showGaugeBorder": "1",
                    "gaugeBorderColor": "#008ee4",
                    "gaugeBorderThickness": "2",
                    "gaugeBorderAlpha": "30",
                    "thmOriginX": "100",
                    "chartBottomMargin": "20",
                    "valueFontColor": "#000000",
                    "theme": "fusion"
                },
                // Initial temperature value fetched from PHP
                "value": 0,
                "annotations": {
                    "showbelow": "0",
                    "groups": [{
                        "id": "indicator",
                        "items": [
                            {
                                "id": "background",
                                "type": "rectangle",
                                "alpha": "50",
                                "fillColor": "#AABBCC",
                                "x": "$gaugeEndX-40",
                                "tox": "$gaugeEndX",
                                "y": "$gaugeEndY+54",
                                "toy": "$gaugeEndY+72"
                            }
                        ]
                    }]
                },
            },
           "events": {
    "rendered": function(evt, arg) {
        // Fetch new temperature data every 3 seconds from PHP
        evt.sender.dataUpdate = setInterval(function() {
            fetch('classes/thermometer2.php')  // Fetch latest temperature from PHP
                .then(response => response.json())
                .then(data => {
                    // Update the thermometer value with the fetched data
                    var newTemp = data.value;
                    evt.sender.feedData("&value=" + newTemp);

                    // Update the annotation color based on the temperature value
                    var code;
                    if (newTemp >= 30) {
                        code = "#FF0000";  // Red for high temperatures (above 30°C)
                    } else if (newTemp >= 20) {
                        code = "#FF9900";  // Yellow for moderate temperatures (20°C to 29°C)
                    } else {
                        code = "#00FF00";  // Green for low temperatures (below 20°C)
                    }

                    // Update the annotation background color
                    evt.sender.updateAnnotation("background", {
                        "fillColor": code
                    });
                });
        });
    },

                'renderComplete': function(evt, arg) {
                    evt.sender.updateAnnotation(evt, arg);
                },
                'realtimeUpdateComplete': function(evt, arg) {
                    evt.sender.updateAnnotation(evt, arg);
                },
                'disposed': function(evt, arg) {
                    clearInterval(evt.sender.dataUpdate);
                }
            }
        });
        chartObj.render();
    });
</script>


<script type="text/javascript">
    FusionCharts.ready(function(){
        var chartObj = new FusionCharts({
            type: 'thermometer',
            renderAt: 'temperature1',
            width: '240',
            height: '310',
            dataFormat: 'json',
            dataSource: {
                "chart": {
                    "caption": "E-SAWOD 1",
                    "subcaption": "TEMPERATURE",
                    "lowerLimit": "0",
                    "upperLimit": "50",
                    "decimals": "1",
                    "numberSuffix": "°C",
                    "showhovereffect": "1",
                    "thmFillColor": "#008ee4",
                    "showGaugeBorder": "1",
                    "gaugeBorderColor": "#008ee4",
                    "gaugeBorderThickness": "2",
                    "gaugeBorderAlpha": "30",
                    "thmOriginX": "100",
                    "chartBottomMargin": "20",
                    "valueFontColor": "#000000",
                    "theme": "fusion"
                },
                // Initial temperature value fetched from PHP
                "value": 0,
                "annotations": {
                    "showbelow": "0",
                    "groups": [{
                        "id": "indicator",
                        "items": [
                            {
                                "id": "background",
                                "type": "rectangle",
                                "alpha": "50",
                                "fillColor": "#AABBCC",
                                "x": "$gaugeEndX-40",
                                "tox": "$gaugeEndX",
                                "y": "$gaugeEndY+54",
                                "toy": "$gaugeEndY+72"
                            }
                        ]
                    }]
                },
            },
           "events": {
    "rendered": function(evt, arg) {
        // Fetch new temperature data every 3 seconds from PHP
        evt.sender.dataUpdate = setInterval(function() {
            fetch('classes/thermometer1.php')  // Fetch latest temperature from PHP
                .then(response => response.json())
                .then(data => {
                    // Update the thermometer value with the fetched data
                    var newTemp = data.value;
                    evt.sender.feedData("&value=" + newTemp);

                    // Update the annotation color based on the temperature value
                    var code;
                    if (newTemp >= 30) {
                        code = "#FF0000";  // Red for high temperatures (above 30°C)
                    } else if (newTemp >= 20) {
                        code = "#FF9900";  // Yellow for moderate temperatures (20°C to 29°C)
                    } else {
                        code = "#00FF00";  // Green for low temperatures (below 20°C)
                    }

                    // Update the annotation background color
                    evt.sender.updateAnnotation("background", {
                        "fillColor": code
                    });
                });
        });
    },

                'renderComplete': function(evt, arg) {
                    evt.sender.updateAnnotation(evt, arg);
                },
                'realtimeUpdateComplete': function(evt, arg) {
                    evt.sender.updateAnnotation(evt, arg);
                },
                'disposed': function(evt, arg) {
                    clearInterval(evt.sender.dataUpdate);
                }
            }
        });
        chartObj.render();
    });
</script>


 <script>
$(document).ready(function() {
    // Function to fetch and display the latest data for esawod_1
    function fetchEsawod1Data() {
        $.ajax({
            url: 'classes/fetch_esawod1.php',  // Path to the PHP file that fetches esawod_1 data
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
            url: 'classes/fetch_esawod2.php',  // Path to the PHP file that fetches esawod_2 data
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

    // Fetch data for both esawod_1 and esawod_2 on page load and update every 10 seconds
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
            url: 'classes/node_db.php', // PHP script that fetches data
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
<!-- //FUSISION CAHRT -->
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
                    "caption": "E-SAWOD 1 LIVE MONITORING",
                    "captionFontColor": "#0062cc",
                    "subcaption": "WATER LEVEL",
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
                            url: 'classes/fetch1.php',  // PHP file for e-sawod_1 data
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

<script type="text/javascript">
    FusionCharts.ready(function(){
        var chartObj = new FusionCharts({
            type: 'cylinder',
            dataFormat: 'json',
            renderAt: 'cylinder2',
            width: '200',
            height: '350',
            dataSource: {
                "chart": {
                    "theme": "fusion",
                    "caption": "E-SAWOD 2",
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
                            url: 'classes/fetch2.php',  // PHP file for e-sawod_1 data
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


<!-- STARTTT HERE  -->


</body>

</html>
