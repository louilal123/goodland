<?php include "classes/admindetails.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/header.php"; ?>
    <title>E-Sawod Data Report</title>
    
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
</head>
<style>
  .text-primary{color: #0062cc !important;}
</style>
<body>
    <section>
    <div class="container py-4">
        <header class="text-center mb-4">
            <h1 class="text-primary"> GOOD</strong><i class="fw-light">Land</i></h1>
            <h5>E-Sawod Data Report</h5>
            <p>37 St., Brgy Atop-Atop, Bantayan Island, Cebu </p>
            <p>Date From: 01/11/2024<span id="modal-dateFrom"></span> - Date To: 27/11/2024<span id="modal-dateTo"></span></p>
        </header>

        <!-- Charts Section -->
        <section>
            <div class="card mb-2">
                <div class="card-body">
                    <div id="kit1"></div> <!-- Placeholder for Highcharts -->
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-body">
                    <div id="kit2"></div> <!-- Placeholder for Highcharts -->
                </div>
            </div>
        </section>

<!-- Summary Table Section -->

    <div class="card">
        <div class="card-body">
            <table class="table table-sm table-bordered" id="summaryTable">
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
                <tbody>
                    <tr>
                        <td>E-Sawod1</td>
                        <td>30</td> <!-- Highest Water Level for E-SAWOD1 -->
                        <td>0</td>  <!-- Lowest Water Level for E-SAWOD1 -->
                        <td>28</td> <!-- Highest Temperature for E-SAWOD1 -->
                        <td>20</td> <!-- Lowest Temperature for E-SAWOD1 -->
                        <td>30</td> <!-- Highest Humidity for E-SAWOD1 -->
                        <td>23</td> <!-- Lowest Humidity for E-SAWOD1 -->
                    </tr>
                    <tr>
                        <td>E-Sawod2</td>
                        <td>31</td> <!-- Highest Water Level for E-SAWOD2 -->
                        <td>16</td> <!-- Lowest Water Level for E-SAWOD2 -->
                        <td>33</td> <!-- Highest Temperature for E-SAWOD2 -->
                        <td>18</td> <!-- Lowest Temperature for E-SAWOD2 -->
                        <td>29</td> <!-- Highest Humidity for E-SAWOD2 -->
                        <td>22</td> <!-- Lowest Humidity for E-SAWOD2 -->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</section>

    </div>
    <?php include "includes/footer.php"; ?>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  
  <script type="text/javascript">
    window.onload = function () {
        window.print();
    };
</script>

<script type="text/javascript">
    Highcharts.chart('kit1', {
        chart: {
            type: 'line'
        },
        title: {
            text: '-'
        },
        subtitle: {
     text: 'E-SAWOD2 Average Data'
   
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
            color: '#0d6efd',
            data: [15, 20, 18, 22, 25, 30, 28, 26, 20, 18, 24, 29, 15, 18, 21, 
            25, 30, 27, 23, 19, 18, 20, 22, 25, 29, 30, 27, 22, 21, 19, 15]
        }, {
            name: 'Humidity (%)',
            color: '#6c757d',
            data: [23, 25, 24, 26, 27, 29, 28, 27, 25, 24, 26, 28, 23, 
            24, 25, 27, 29, 28, 26, 24, 24, 25, 26, 27, 28, 29, 28, 26, 25, 24, 23]   
        }, {
            name: 'Temperature (°C)',
            color: '#dc3545',
            data: [22, 24, 23, 25, 26, 28, 27, 26, 24, 23, 25, 27, 22, 23, 24, 26, 28, 
            27, 25, 23, 23, 24, 25, 26, 27, 28, 27, 25, 24, 23, 22]
        }],
        tooltip: {
            shared: true,
            valueSuffix: ' units'
        }
    });

    // Chart for Kit 2 (E-SAWOD2)
    Highcharts.chart('kit2', {
        chart: {
            type: 'line'
        },
        title: {
            text: '-'
        },
        subtitle: {
     text: 'E-SAWOD2 Average Data'
   
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
            color: '#0d6efd',
            data: [16, 21, 19, 23, 26, 31, 29, 27, 21, 19, 25, 30, 16, 19, 22, 26, 31, 28, 24, 20, 19, 21, 23, 26, 30, 31, 28, 23, 22, 20, 16]
        }, {
            name: 'Humidity (%)',
            color: '#6c757d',
            data: [22, 24, 23, 25, 26, 28, 27, 26, 24, 23, 25, 27, 22, 23, 24, 26, 28, 27, 25, 23, 23, 24, 25, 26, 27, 28, 27, 25, 24, 23, 22]
        }, {
            name: 'Temperature (°C)',
            color: '#dc3545',
            data: [23, 25, 24, 26, 27, 29, 28, 27, 25, 24, 26, 28, 23, 24, 25, 27, 29, 28, 26, 24, 24, 25, 26, 27, 28, 29, 28, 26, 25, 24, 23]
        }],
        tooltip: {
            shared: true,
            valueSuffix: ' units'
        }
    });
</script>


</body>
</html>
