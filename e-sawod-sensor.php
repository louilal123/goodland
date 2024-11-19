<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "includes/header.php"; ?>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
  #water_level {
    height: 400px;
    min-width: 310px;
}

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

</style>
<body class="blog-page">
  <?php include "includes/topnav.php"; ?>
  
  <main class="main">
    <!-- Page Title -->
    <div class="page-title">
      <div class="heading "style="background-size: cover; background-position: center;background: linear-gradient(to top, rgba(38, 37, 37, 0.1), rgba(22, 22, 22, 0.1));z-index: -1;">
        <div class="container ">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <br><br>
              <h1 class="text-dark"> <i class="bi bi-measure text-secondary"></i>E-Sawod</h1>
            </div>
          </div>
        </div>
      </div>
    
    </div><!-- End Page Title -->
    <!-- Values Section -->
<section id="" class="values section">
  <div class="container">
    <div class="row gy-4">
   
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
</section>

    <!-- Values Section -->
    <section id="" class="values section">
      <div class="container">
        <div class="row gy-4">
          
         <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                     <div id="water_level"></div>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                     <div id="humidity"></div>
              </div>
            </div>
   
   
          </div>

          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                     <div id="temperature"></div>
              </div>
            </div>
   
   
          </div>
         
          <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h3>Complete Data Table</h3>
            <!-- Data Table container -->
            <table id="sensorDataTable" border="1" class="table table-responsive">
                <thead>
                    <tr>
                        <th>Kit Name</th>
                        <th>Water Level (cm)</th>
                        <th>Humidity (%)</th>
                        <th>Temperature (°C)</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data rows will be inserted here -->
                </tbody>
            </table>
  
          </div>
        </div>
      </div>
          
        </div>
      </div>
    </section>
   
  </main>

  <?php include "includes/footer.php"; ?>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
        (async () => {
            // Fetch temperature data from PHP
            const response = await fetch('classes/fetchtemperature.php');
            const data = await response.json();

            if (!data || data.length === 0) {
                console.error('No data found.');
                return;
            }

            // Process the data to adjust timestamps and organize by kit_name
            const esawod1Temp = [];
            const esawod2Temp = [];

            data.forEach(entry => {
                const timestamp = new Date(entry.timestamp);
                timestamp.setHours(timestamp.getHours() + 7); // Add 7 hours

                // Structure data for each kit
                if (entry.kit_name === 'esawod_1') {
                    esawod1Temp.push([timestamp.getTime(), entry.temperature]);
                } else if (entry.kit_name === 'esawod_2') {
                    esawod2Temp.push([timestamp.getTime(), entry.temperature]);
                }
            });

            // Create the chart for temperature comparison
            Highcharts.stockChart('temperature', {
                rangeSelector: {
                    selected: 1
                },

                title: {
                    text: 'Temperature Comparison - esawod_1 vs esawod_2'
                },

                yAxis: {
                    title: {
                        text: 'Temperature (°C)'
                    },
                    labels: {
                        formatter: function () {
                            return this.value + ' °C';
                        }
                    }
                },

                tooltip: {
                    pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y} °C</b><br/>',
                    valueDecimals: 2,
                    split: true
                },

                series: [
                    {
                        name: 'esawod_1 Temperature',
                        data: esawod1Temp,
                        tooltip: { valueSuffix: ' °C' }
                    },
                    {
                        name: 'esawod_2 Temperature',
                        data: esawod2Temp,
                        tooltip: { valueSuffix: ' °C' }
                    }
                ]
            });
        })();
    </script>
  <script>
        (async () => {
            // Fetch humidity data from PHP
            const response = await fetch('classes/fetchhumidity.php');
            const data = await response.json();

            if (!data || data.length === 0) {
                console.error('No data found.');
                return;
            }

            // Process the data to adjust timestamp and organize by kit_name
            const esawod1Humidity = [];
            const esawod2Humidity = [];

            data.forEach(entry => {
                const timestamp = new Date(entry.timestamp);
                timestamp.setHours(timestamp.getHours() + 7); // Add 7 hours

                // Structure data for each kit
                if (entry.kit_name === 'esawod_1') {
                    esawod1Humidity.push([timestamp.getTime(), entry.humidity]);
                } else if (entry.kit_name === 'esawod_2') {
                    esawod2Humidity.push([timestamp.getTime(), entry.humidity]);
                }
            });

            // Create the chart for humidity comparison
            Highcharts.stockChart('humidity', {
                rangeSelector: {
                    selected: 1
                },

                title: {
                    text: 'Humidity Comparison - esawod_1 vs esawod_2'
                },

                yAxis: {
                    title: {
                        text: 'Humidity (%)'
                    },
                    labels: {
                        formatter: function () {
                            return this.value + ' %';
                        }
                    }
                },

                tooltip: {
                    pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y} %</b><br/>',
                    valueDecimals: 2,
                    split: true
                },

                series: [
                    {
                        name: 'esawod_1 Humidity',
                        data: esawod1Humidity,
                        tooltip: { valueSuffix: ' %' }
                    },
                    {
                        name: 'esawod_2 Humidity',
                        data: esawod2Humidity,
                        tooltip: { valueSuffix: ' %' }
                    }
                ]
            });
        })();
    </script>
<script>
        (async () => {
            // Fetch water level data from PHP
            const response = await fetch('classes/fetchwaterlevel.php');
            const data = await response.json();

            // Check if data is available
            if (!data || data.length === 0) {
                console.error('No data found.');
                return;
            }

            // Process the data to add 7 hours to the timestamp and organize by kit_name
            const esawod1Data = [];
            const esawod2Data = [];

            data.forEach(entry => {
                // Add 7 hours to timestamp
                const timestamp = new Date(entry.timestamp);
                timestamp.setHours(timestamp.getHours() + 8);

                // Structure data based on kit_name
                if (entry.kit_name === 'esawod_1') {
                    esawod1Data.push([timestamp.getTime(), entry.level_cm]);
                } else if (entry.kit_name === 'esawod_2') {
                    esawod2Data.push([timestamp.getTime(), entry.level_cm]);
                }
            });

            // Create the chart
            Highcharts.stockChart('water_level', {
                rangeSelector: {
                    selected: 1
                },

                title: {
                    text: 'Water Level Comparison - esawod_1 vs esawod_2'
                },

                yAxis: {
                    title: {
                        text: 'Water Level (cm)'
                    },
                    labels: {
                        formatter: function () {
                            return this.value + ' cm';
                        }
                    }
                },

                tooltip: {
                    pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y} cm</b><br/>',
                    valueDecimals: 2,
                    split: true
                },

                series: [
                    {
                        name: 'esawod_1',
                        data: esawod1Data,
                        tooltip: {
                            valueSuffix: ' cm'
                        }
                    },
                    {
                        name: 'esawod_2',
                        data: esawod2Data,
                        tooltip: {
                            valueSuffix: ' cm'
                        }
                    }
                ]
            });
        })();
    
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


</body>

</html>
