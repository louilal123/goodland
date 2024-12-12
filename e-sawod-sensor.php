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
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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
    
    <section id="" class="section">
  <div class="container">
    <div class="row gy-4">
      <!-- Title Section -->
      <div class="col-md-12">
        <div class=" btn-primary text-center">
            
          <h1><span class="bi bi-chart"></span> <strong>"E-SAWOD SENSOR DATA"</strong></h1>
        </div>
      </div>

<!-- E-SAWOD 1 -->
<div class="col-md-6">
  <div class="card">
  <div class="card-header bg-dark text-center">
    <h3 class="text-light">E-SAWOD 1</h3>
    </div>
    <div class="card-body">
      <!-- Centered Cylinder Chart -->
      <div id="cylinder1" class="mb-4 d-flex justify-content-center"></div>
     
    </div>
  </div>
</div>

   <!-- E-SAWOD 2 -->
<div class="col-md-6">
  <div class="card">
    <div class="card-header bg-dark text-center">
    <h3 class="text-light">E-SAWOD 2</h3>
    </div>
    <div class="card-body">
      
      <!-- Centered Cylinder Chart -->
      <div id="cylinder2" class="mb-4 d-flex justify-content-center"></div>
      <!-- Temperature and Humidity Table -->
      
    </div>
  </div>
</div>
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
        <table id="sensorDataTable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Kit Name</th>
           
            <th>Humidity (%)</th>
            <th>Temperature (°C)</th>
            <th>Timestamp</th>
        </tr>
    </thead>
    <tbody>
        <!-- Data rows will be populated here -->
    </tbody>
</table>
        </div>
    </div>
</div>


    </div>
  </div>
</section>


<section id="charts" class="section  " style="margin-top: -60px;">
    <div class="container">
        <div class="row gy-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
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

                        <div class="tab-pane fade show active" id="lastMinuteContent" role="tabpanel">
                        
                        <div class="d-flex ms-auto">
                            <div class="col-6">
                                
                        <div id="kit1_minute" style="height: 400px;"></div> 
                            </div>
                        <div class="col-6">
                        <div id="kit2_minute" style="height: 400px;"></div> 
                        </div>
                        </div>
                        </div>

                        <div class="tab-pane fade" id="lastHourContent" role="tabpanel">
                        <div class="d-flex ms-auto">
                        <div class="col-6">
                        <div id="kit1_hour" style="height: 400px;"></div> 
                        </div>
                        <div class="col-6">
                        <div id="kit2_hour" style="height: 400px;"></div> 
                        </div>
                        </div>
                        </div>

                        <div class="tab-pane fade" id="lastDayContent" role="tabpanel">
                        
                        <div class="d-flex ms-auto">
                        <div class="col-6">
                        <div id="kit1_day" style="height: 400px;"></div> 
                        </div>
                        <div class="col-6">
                        <div id="kit2_day" style="height: 400px;"></div> 
                        </div>
                        </div>
                        </div>

                        <div class="tab-pane fade" id="lastWeekContent" role="tabpanel">
                        <div class="d-flex ms-auto">
                        <div class="col-6">
                            <div id="kit1_week" style="height: 400px;"></div> 
                            </div>
                            <div class="col-6">
                            <div id="kit2_week" style="height: 400px;"></div> 
                            </div>
                        </div>
                        </div>

                        <div class="tab-pane fade" id="lastMonthContent" role="tabpanel">
                            <div class="d-flex ms-auto">
                                <div class="col-6">
                                <div id="kit1_month" style="height: 400px;"></div> 
                                </div>
                                <div class="col-6">
                                <div id="kit2_month" style="height: 400px;"></div>
                                </div>
                            </div> 
                        </div>

                        <div class="tab-pane fade" id="allTimeContent" role="tabpanel">
                        <div class="d-flex ms-auto">

                        
                        <div class="col-6">
                            <div id="kit1_alltime" style="height: 400px;"></div> 
                            </div>
                            <div class="col-6">
                            <div id="kit2_alltime" style="height: 400px;"></div> 
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

                              

        </div>
    </div>
  
</section>
<section class="section"  style="margin-top: -60px;">
    <div class="container">
        <div class="row gy-4">
            <div class="col-md-12">

            <div class="card">
                                    <div class="card-body">
                                                <form id="monthYearFilterForm" class="row">
                                                            <div class="col-md-5">
                                                        <div class="d-flex align-items-center">
                                                            <label for="monthYearInput" class="text-dark mb-0 me-2">Month:</label>
                                                            <input type="month" 
                                                                name="month_of" 
                                                                id="monthYearInput" 
                                                                class="form-control" 
                                                                value="<?php echo isset($month_of) ? $month_of : date('Y-m'); ?>" 
                                                                required 
                                                                title="Select a month for the report">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2 d-flex align-items-center">
                                                        <button type="submit" class="btn btn-dark w-100" title="Filter data based on the selected month">
                                                            <i class="bi bi-filter"></i> Filter
                                                        </button>
                                                    </div>

                                                    <div class="col-md-5 d-flex align-items-center justify-content-end">
                                                      
                                                    </div>
                                                </form>
                                                </div>
                                                    
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex ms-auto">
                                                    <div class="col-6">
                                                        <div id="kit1" style="height: 400px;"></div> 
                                                    </div>
                                                    <div class="col-6">
                                                        <div id="kit2" style="height: 400px;"></div> 
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="card-body">
                                            <div class=" table table-responsive">
                                            <table class="table  table-sm table-bordered" id="summaryTable">
                                                <thead>
                                                    <tr>
                                                        <th rowspan="2">Kit Name</th>
                                                        <th colspan="2" class="text-center">Water Level (cm)</th>
                                                        <th colspan="2" class="text-center">Temperature (°C)</th>
                                                        <th colspan="2" class="text-center">Humidity (%)</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Highest</th>
                                                        <th>Lowest</th>
                                                        <th>Highest</th>
                                                        <th>Lowest</th>
                                                        <th>Highest</th>
                                                        <th>Lowest</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="esawodTableBody">
                                                
                                                </tbody>
                                            </table>
                                            </div>
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
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  
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

<!-- week  -->
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
<!-- hour  -->
<script type="text/javascript">
   
    const chart3 = Highcharts.chart('kit1_hour', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'E-SAWOD1'
        },
        xAxis: {
            categories: ['Last Hour'],
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

    const chart4 = Highcharts.chart('kit2_hour', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'E-SAWOD2'
        },
        xAxis: {
            categories: ['Last Hour'],
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
            url: 'classes/fetch_last_hour_data.php', // PHP script to fetch last minute data
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                // Update Kit 1 chart
                chart3.series[0].setData(response.kit1.level_data); // Update Water Level
                chart3.series[1].setData(response.kit1.humidity_data); // Update Humidity
                chart3.series[2].setData(response.kit1.temperature_data); // Update Temperature

                // Update Kit 2 chart
                chart4.series[0].setData(response.kit2.level_data); // Update Water Level
                chart4.series[1].setData(response.kit2.humidity_data); // Update Humidity
                chart4.series[2].setData(response.kit2.temperature_data); // Update Temperature
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    setInterval(fetchAndUpdateCharts, 1000); 
    fetchAndUpdateCharts();
</script>
<!-- day  -->
<script type="text/javascript">
   
    const chart5 = Highcharts.chart('kit1_day', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'E-SAWOD1'
        },
        xAxis: {
            categories: ['Last Day'],
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

    const chart6 = Highcharts.chart('kit2_day', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'E-SAWOD2'
        },
        xAxis: {
            categories: ['Last Day'],
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
            url: 'classes/fetch_last_day_data.php', // PHP script to fetch last minute data
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                // Update Kit 1 chart
                chart5.series[0].setData(response.kit1.level_data); // Update Water Level
                chart5.series[1].setData(response.kit1.humidity_data); // Update Humidity
                chart5.series[2].setData(response.kit1.temperature_data); // Update Temperature

                // Update Kit 2 chart
                chart6.series[0].setData(response.kit2.level_data); // Update Water Level
                chart6.series[1].setData(response.kit2.humidity_data); // Update Humidity
                chart6.series[2].setData(response.kit2.temperature_data); // Update Temperature
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    setInterval(fetchAndUpdateCharts, 1000); 
    fetchAndUpdateCharts();
</script>
<!-- week  -->
<script type="text/javascript">
   
   const chart7 = Highcharts.chart('kit1_week', {
       chart: {
           type: 'line'
       },
       title: {
           text: 'E-SAWOD1'
       },
       xAxis: {
           categories: ['Last Week'],
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

   const chart8 = Highcharts.chart('kit2_week', {
       chart: {
           type: 'line'
       },
       title: {
           text: 'E-SAWOD2'
       },
       xAxis: {
           categories: ['Last Week'],
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
           url: 'classes/fetch_last_week_data.php', // PHP script to fetch last minute data
           method: 'GET',
           dataType: 'json',
           success: function(response) {
               // Update Kit 1 chart
               chart7.series[0].setData(response.kit1.level_data); // Update Water Level
               chart7.series[1].setData(response.kit1.humidity_data); // Update Humidity
               chart7.series[2].setData(response.kit1.temperature_data); // Update Temperature

               // Update Kit 2 chart
               chart8.series[0].setData(response.kit2.level_data); // Update Water Level
               chart8.series[1].setData(response.kit2.humidity_data); // Update Humidity
               chart8.series[2].setData(response.kit2.temperature_data); // Update Temperature
           },
           error: function(xhr, status, error) {
               console.error('Error fetching data:', error);
           }
       });
   }

   setInterval(fetchAndUpdateCharts, 1000); 

   fetchAndUpdateCharts();
</script>

<!-- month  -->
<script type="text/javascript">
   
   const chart9 = Highcharts.chart('kit1_month', {
       chart: {
           type: 'line'
       },
       title: {
           text: 'E-SAWOD1'
       },
       xAxis: {
           categories: ['Last Month'],
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

   const chart10 = Highcharts.chart('kit2_month', {
       chart: {
           type: 'line'
       },
       title: {
           text: 'E-SAWOD2'
       },
       xAxis: {
           categories: ['Last Month'],
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
           url: 'classes/fetch_last_month_data.php', // PHP script to fetch last minute data
           method: 'GET',
           dataType: 'json',
           success: function(response) {
               // Update Kit 1 chart
               chart9.series[0].setData(response.kit1.level_data); // Update Water Level
               chart9.series[1].setData(response.kit1.humidity_data); // Update Humidity
               chart9.series[2].setData(response.kit1.temperature_data); // Update Temperature

               // Update Kit 2 chart
               chart10.series[0].setData(response.kit2.level_data); // Update Water Level
               chart10.series[1].setData(response.kit2.humidity_data); // Update Humidity
               chart10.series[2].setData(response.kit2.temperature_data); // Update Temperature
           },
           error: function(xhr, status, error) {
               console.error('Error fetching data:', error);
           }
       });
   }

   setInterval(fetchAndUpdateCharts, 1000); 

   fetchAndUpdateCharts();
</script>

<!-- all time  -->
<script type="text/javascript">
   
   const chart11 = Highcharts.chart('kit1_alltime', {
       chart: {
           type: 'line'
       },
       title: {
           text: 'E-SAWOD1'
       },
       xAxis: {
           categories: ['All Time'],
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

   const chart12 = Highcharts.chart('kit2_alltime', {
       chart: {
           type: 'line'
       },
       title: {
           text: 'E-SAWOD2'
       },
       xAxis: {
           categories: ['All Time'],
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
           url: 'classes/fetch_last_all_data.php', // PHP script to fetch last minute data
           method: 'GET',
           dataType: 'json',
           success: function(response) {
               // Update Kit 1 chart
               chart11.series[0].setData(response.kit1.level_data); // Update Water Level
               chart11.series[1].setData(response.kit1.humidity_data); // Update Humidity
               chart11.series[2].setData(response.kit1.temperature_data); // Update Temperature

               // Update Kit 2 chart
               chart12.series[0].setData(response.kit2.level_data); // Update Water Level
               chart12.series[1].setData(response.kit2.humidity_data); // Update Humidity
               chart12.series[2].setData(response.kit2.temperature_data); // Update Temperature
           },
           error: function(xhr, status, error) {
               console.error('Error fetching data:', error);
           }
       });
   }

   setInterval(fetchAndUpdateCharts, 1000); 

   fetchAndUpdateCharts();
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
                    "caption": "-",
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
                    "caption": "-",
                    "captionFontColor": "#0062cc",
                    "subcaption": "WATER LEVEL",
                    "lowerLimit": "0",
                    "upperLimit": "40", // Maximum water level of 30 cm
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
 
   <!-- Scripts -->
   <script type="text/javascript">
   document.addEventListener('DOMContentLoaded', function () {
       const monthInput = document.getElementById('monthYearInput');
       let monthOf = monthInput.value;

       const formData = new FormData();
       formData.append('month_of', monthOf);

       function fetchDataForKit1() {
           fetch('admin/get_esawod_1_data.php', {
               method: 'POST',
               body: formData
           })
               .then(response => response.json())
               .then(data => {
                   console.log(data); 

                   if (data.error) {
                       throw new Error(data.error);
                   }

                   Highcharts.chart('kit1', {
                       chart: {
                           type: 'column'
                       },
                       title: {
                           text: 'E-SAWOD1'
                       },
                       xAxis: {
                           categories: data.days, 
                           title: {
                               text: 'Day of the Month'
                           }
                       },
                       yAxis: {
                           title: {
                               text: 'Measurements'
                           },
                           labels: {
                               format: '{value}'
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
                       series: [
                           {
                               name: 'Water Level (cm)',
                               type: 'area',
                               color: '#0d6efd',
                               data: data.level_data.map(Number) 
                           },
                           {
                               name: 'Temperature (°C)',
                               type: 'line',
                               color: '#dc3545',
                               data: data.temperature_data
                           },
                           {
                               name: 'Humidity (%)',
                               type: 'line',
                               color: '#6c757d',
                               data: data.humidity_data
                           }
                       ],
                       tooltip: {
                           shared: true,
                           formatter: function () {
                               let tooltip = '<b>Day: ' + this.x + '</b><br>';
                               this.points.forEach(point => {
                                   tooltip += point.series.name + ': ' + point.y + '<br>';
                               });
                               return tooltip;
                           }
                       }
                   });
               })
               .catch(error => {
                   console.error('Error fetching data for E-SAWOD1:', error);
               });
       }

       function fetchDataForKit2() {
           fetch('admin/get_esawod_2_data.php', {
               method: 'POST',
               body: formData
           })
               .then(response => response.json())
               .then(data => {
                   console.log(data); 

                   if (data.error) {
                       throw new Error(data.error);
                   }

                   Highcharts.chart('kit2', {
                       chart: {
                           type: 'column'
                       },
                       title: {
                           text: 'E-SAWOD2'
                       },
                       xAxis: {
                           categories: data.days, 
                           title: {
                               text: 'Day of the Month'
                           }
                       },
                       yAxis: {
                           title: {
                               text: 'Measurements'
                           },
                           labels: {
                               format: '{value}'
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
                       series: [
                           {
                               name: 'Water Level (cm)',
                               type: 'area',
                               color: '#0d6efd',
                               data: data.level_data.map(Number) 
                           },
                           {
                               name: 'Temperature (°C)',
                               type: 'line',
                               color: '#dc3545',
                               data: data.temperature_data
                           },
                           {
                               name: 'Humidity (%)',
                               type: 'line',
                               color: '#6c757d',
                               data: data.humidity_data
                           }
                       ],
                       tooltip: {
                           shared: true,
                           formatter: function () {
                               let tooltip = '<b>Day: ' + this.x + '</b><br>';
                               this.points.forEach(point => {
                                   tooltip += point.series.name + ': ' + point.y + '<br>';
                               });
                               return tooltip;
                           }
                       }
                   });
               })
               .catch(error => {
                   console.error('Error fetching data for E-SAWOD1:', error);
               });
       }

       fetchDataForKit1();
       fetchDataForKit2();
       document.getElementById('monthYearFilterForm').addEventListener('submit', function (event) {
           event.preventDefault();
           monthOf = monthInput.value;
           formData.set('month_of', monthOf);
           fetchDataForKit1();
           fetchDataForKit2();
       });



   });
</script>

<script type="text/javascript">
   document.addEventListener('DOMContentLoaded', function () {
       const monthInput = document.getElementById('monthYearInput');
       let monthOf = monthInput.value;

       const formData = new FormData();
       formData.append('month_of', monthOf);

       function fetchSummaryData() {
           fetch('admin/generate_report.php', {
               method: 'POST',
               body: formData
           })
               .then(response => response.json())
               .then(data => {
                   console.log(data); 

                   if (data.error) {
                       throw new Error(data.error);
                   }

                   const esawodTableBody = document.getElementById('esawodTableBody');
                   esawodTableBody.innerHTML = '';

                   data.forEach(item => {
                       const row = document.createElement('tr');
                       row.innerHTML = `
                           <td>${item.kit_name}</td>
                           <td>${item.highest_wl}</td>
                           <td>${item.lowest_wl}</td>
                           <td>${item.highest_temp}</td>
                           <td>${item.lowest_temp}</td>
                           <td>${item.highest_humidity}</td>
                           <td>${item.lowest_humidity}</td>
                       `;
                       esawodTableBody.appendChild(row);
                   });
               })
               .catch(error => {
                   console.error('Error fetching summary data:', error);
               });
       }

       fetchSummaryData();

       document.getElementById('monthYearFilterForm').addEventListener('submit', function (event) {
           event.preventDefault();
           monthOf = monthInput.value;
           formData.set('month_of', monthOf);
           fetchSummaryData();
       });

       document.getElementById('printButton').addEventListener('click', function () {
           window.print();
       });
   });
</script>



</body>

</html>
