<!DOCTYPE html>
<html lang="en">

<head>
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
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
  </style>
</head>

<body class="blog-page">
  <?php include "includes/topnav.php";?>
  
  <main class="main">
    <div class="page-title">
      <div class="heading" style="background-size: cover; background-position: center; background: linear-gradient(to top, rgba(38, 37, 37, 1), rgba(22, 22, 22, 0.8)); z-index: -1;">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <br><br>
              <h1 class="text-warning">Water Catchment Data</h1>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="index">Home</a></li>
            <li class="current">Water Catchment Data</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->
<!-- Values Section -->
<section id="" class="values section">
  <div class="container">
    <div class="row gy-4">

     <div class="col-md-12">
<div class="card">
  <div class="card-body">
    <div id="containe"></div>
  </div>
</div>
     </div>
     <div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div id="dailyChart"></div> <!-- Daily chart -->
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div id="hourlyChart"></div> <!-- Hourly chart -->
        </div>
    </div>
</div>
     
    
    </div>
  </div>
</section>

   
  </main>

  <?php include "includes/footer.php";?>
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
            // text: 'Source: <a href="#" target="_blank">GoodLand</a>',
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
            type: 'column',
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Fetch daily data from PHP
    let dailyData = <?php echo json_encode($dailyData); ?>;

    // Prepare categories for the days of the current month (1 to 31)
    const daysInMonth = new Date().getDate(); // Get current day of the month
    const dailyCategories = Array.from({ length: daysInMonth }, (_, i) => i + 1);

    // Adjust daily data: If no data for a day, the value will be 0
    const dailyWaterLevel = dailyData.waterLevel.slice(0, daysInMonth);
    const dailyTemperature = dailyData.temperature.slice(0, daysInMonth);
    const dailyHumidity = dailyData.humidity.slice(0, daysInMonth);

    // Render the daily chart
    Highcharts.chart('dailyChart', {
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
            text: 'Daily Average Data from Water Catchment',
            align: 'center'
        },
        subtitle: {
            // text: 'Source: <a href="#" target="_blank">GoodLand</a>',
            align: 'center'
        },
        xAxis: {
            categories: dailyCategories,
            title: { text: 'Day of the Month' },
            crosshair: true
        },
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
        credits: {
            enabled: false
        },
        series: [{
            name: 'Water Level (cm)',
            type: 'area',
            color: '#0062cc',
            data: dailyWaterLevel,
            tooltip: {
                valueSuffix: ' cm'
            }
        }, {
            name: 'Temperature (°C)',
            type: 'column',
            color: '#dc3545',
            data: dailyTemperature,
            tooltip: {
                valueSuffix: ' °C'
            }
        }, {
            name: 'Humidity (%)',
            type: 'line',
            color: '#ffc107',
            data: dailyHumidity,
            tooltip: {
                valueSuffix: ' %'
            }
        }]
    });

    let hourlyData = <?php echo json_encode($hourlyData); ?>;
const currentHour = new Date().getHours();
const hourlyCategories = Array.from({ length: currentHour + 1 }, (_, i) => i);
const hourlyWaterLevel = hourlyData.waterLevel.slice(0, currentHour + 1);
const hourlyTemperature = hourlyData.temperature.slice(0, currentHour + 1);
const hourlyHumidity = hourlyData.humidity.slice(0, currentHour + 1);

Highcharts.chart('hourlyChart', {
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
        text: 'Hourly Average Data from Water Catchment',
        align: 'center'
    },
    subtitle: {
        // text: 'Source: <a href="#" target="_blank">GoodLand</a>',
        align: 'center'
    },
    xAxis: {
        categories: hourlyCategories,
        title: { text: 'Hour of the Day' },
        crosshair: true
    },
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
    credits: {
        enabled: false
    },
    series: [{
        name: 'Water Level (cm)',
        color: '#0062cc',
        type: 'area',
        data: hourlyWaterLevel,
        tooltip: {
            valueSuffix: ' cm'
        }
    }, {
        name: 'Temperature (°C)',
        type: 'column',
        color: '#dc3545',
        data: hourlyTemperature,
        tooltip: {
            valueSuffix: ' °C'
        }
    }, {
        name: 'Humidity (%)',
        data: hourlyHumidity,
        color: '#ffc107',
        tooltip: {
            valueSuffix: ' %'
        }
    }]
});

});
</script>
</body>

</html>
