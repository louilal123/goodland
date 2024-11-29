<?php include "classes/admindetails.php"; ?>
<?php
include 'classes/average_chart.php';
?>
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
    <div class="container my-4">
        <header class="text-center mb-4">
            <h1 class="text-primary"> GOOD</strong><i class="fw-light">Land</i></h1>
            <h5>Monthly Website Statistics Report</h5>
            <p>37 St., Brgy Atop-Atop, Bantayan Island, Cebu </p>
            
        </header>

        <!-- Charts Section -->
        <section>
            <div class="card mb-2">
                <div class="card-body">
                    <div id="containe"></div> <!-- Placeholder for Highcharts -->
                </div>
            
            </div>
        </section>

    </div>
    <?php include "includes/footer.php"; ?>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  
  <script type="text/javascript">
    // Automatically trigger print dialog when the page loads
    window.onload = function () {
        window.print();
    };
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get the number of days in the current month
        const daysInMonth = new Date(new Date().getFullYear(), new Date().getMonth() + 1, 0).getDate();

        // Generate categories for days of the month
        const categories = Array.from({ length: daysInMonth }, (_, i) => (i + 1).toString());

        // Static data for New Visitors and Returning Visitors
        const newVisitorsData = [3, 5, 7, 2, 4, 8, 6, 9, 1, 4, 5, 6, 7, 8, 2, 3, 4, 5, 6, 7, 3, 5, 6, 7, 8, 2, 3, 4, 5, 6, 7];
        const returningVisitorsData = [6, 4, 5, 8, 7, 9, 3, 6, 2, 8, 5, 3, 6, 7, 4, 5, 9, 6, 4, 3, 5, 7, 6, 8, 4, 3, 6, 7, 8, 2, 5];

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
                data: newVisitorsData,
                tooltip: {
                    valueSuffix: ' visitors'
                }
            }, {
                name: 'Returning Visitors',
                type: 'line',
                color: '#0062cc',
                data: returningVisitorsData,
                tooltip: {
                    valueSuffix: ' visitors'
                }
            }]
        });
    });
</script>



</body>
</html>
