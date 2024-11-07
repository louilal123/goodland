<?php include "classes/admindetails.php"; ?>
<!DOCTYPE html>
<html lang="en"> 
<?php include "includes/header.php"; ?>
<!-- <link rel="stylesheet" href="dist/custom.css"> -->
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
</style>
<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary">

<div class="app-wrapper">
    <?php include "includes/sidebar.php"; ?>
    
    <div class="app-main-wrapper">
        <?php include "includes/topnav.php"; ?>
        
        <main class="app-main">
            <div class="app-content">
                <div class="container-fluid">
                    <div class="row mt-3">
                      
                        
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <h3 class="fw-bold">List Of Water Readings</h3>
                                        <button class="btn btn-primary ms-auto btn-rounded btn-sm" data-bs-toggle="modal" data-bs-target="#adddataModal">
                                            <i class="fas fa-sync-alt"></i> Refresh
                                        </button>
                                    </div>
                                    
                                    <table id="myTable" class="table table-bordered table-hover table-striped text-center w-100">
                                        <thead class="table-secondary">
                                            <tr>
                                                <th style="font-weight: bold;">Time Stamp</th>
                                                <th style="font-weight: bold;">Water Level</th>
                                                <th style="font-weight: bold;">Humidity</th>
                                                <th style="font-weight: bold;">Temperature</th>
                                                <th style="font-weight: bold;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data as $entry): ?>
                                                <tr>
                                                    <td><?php echo date("M d, h:i A", strtotime($entry['date_time'])); ?></td>
                                                    <td><?php echo htmlspecialchars($entry['water_level']); ?></td>
                                                    <td><?php echo htmlspecialchars($entry['humidity']); ?></td>
                                                    <td><?php echo htmlspecialchars($entry['temperature']); ?></td>
                                                    <td>
                                                        <a href="classes/delete_data.php?id=<?php echo $entry['data_id']; ?>" class="btn btn-danger btn-sm deleteBtn">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
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
   </script>
<!-- end  -->

</body>

</html>