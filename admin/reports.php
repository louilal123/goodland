<?php
include "classes/admindetails.php";
?>
<?php
require_once('classes/Main_class.php');
$mainClass = new Main_class();
$mediaCounts = $mainClass->getMediaCounts();

$mediaData = [];
foreach ($mediaCounts as $count) {
    $mediaData[] = "['" . $count['MediaType'] . "', " . $count['Count'] . "]";
}
$mediaData = implode(", ", $mediaData);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous"><!--end::Fonts--><!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous"><!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
     <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="dist/adminlte.css">
    <link rel="stylesheet" href="dist/loader.css">
    <link rel="stylesheet" href="dist/custom.css">
    <!-- font-aswesome  -->
    <link rel="stylesheet" href="dist/fontawesome-free-6.5.2-web/css/all.min.css">

    <!-- swetalert  -->
     <script  src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     
     <!-- datatable  -->
     <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">

     <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
    <script defer src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script defer src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <!-- end datatabke  -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    
<link rel="stylesheet" href="mdbfolder/css/mdb.min.css" />
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['File Type', 'Count'],
          <?php echo $mediaData; ?>
        ]);

        var options = {
          title: 'All Files',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
 <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {
            var chartData = <?php echo json_encode($chartData); ?>;
            var data = google.visualization.arrayToDataTable(chartData);

            var options = {
                title: 'Monthly Website Visitors By Country',
                is3D: true,
                vAxis: {title: 'Number of Visitors'},
                hAxis: {title: 'Month'},
                seriesType: 'bars',
                series: {
                    <?php echo count($chartData[0]) - 2; ?>: {type: 'line'} // The last column (average) should be a line
                }
            };

            var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>





<style>
    @page {
        margin: 0;
    }
    body {
        margin: 2cm;
    }
    h3{
        font-weight: bold;
    }
    .card {
        border: none;
        box-shadow: none;
        margin: 0;
        padding: 0;
    }
    #chart_div, #piechart_3d {
        border: none;
        margin: 0;
        padding: 0;
    }

    @media print {
        body * {
            visibility: hidden;
        }
        #printableArea, #printableArea * {
            visibility: visible;
        }
        #printableArea {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            padding: 10px;
            font-size: 10px;
        }
        .container-fluid {
            margin: 0;
            padding: 0;
        }
        .row, .card, table {
            margin-bottom: 10px;
        }
        .card-header, .card-body {
            padding: 5px;
        }
        h3, h4 {
            font-size: 14px;
        }
        .card-title {
            font-size: 12px;
        }
        .fw-bold {
            font-size: 12px;
        }
        .d-flex {
            font-size: 10px;
        }
        table {
            font-size: 10px;
        }
        th, td {
            font-size: 10px;
        }
        #reportHeader {
            position: fixed;
            top: 10;
            margin-top:50px;
            width: 100%;
            background: white;
            padding: 10px;
            text-align: center;
            z-index: 1000;
        }
    }
</style>

<body onload="window.print()">
    <div id="printableArea">
        <div id="reportHeader">
            <img src="uploads/logogoodland.png" style="display:flex; margin: auto; width: 150px; height:55px;">
            <h3 class="text-center">GoodLand Management System</h1>
            <h3 class="text-center">Purok Kulo 2, Atop-Atop, Bantayan 6053, Cebu</h3>
            <h3 class="text-center"><span id="reportDate"></span></h3>
        </div>
        <div class="container-fluid" style="margin-top: 300px; border: 0px;">
           
                <div class="col-lg-7 col-md-12 col-sm-12">
                    <div class="card mb-4"style="border: 0px;">
                        <div id="chart_div" style="width: 100%; margin-left:0px !important; height: 450px; margin: 0px; padding: 0px;"></div>
                    </div>
                </div>
                
                <div class="col-lg-5 col-md-12 col-sm-12">
                    <div class="card mb-4" style="border: 0px;">
                        <div id="piechart_3d" style="height: 400px;"></div>
                    </div>
                </div>
            </div>
       
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const reportDateElement = document.getElementById("reportDate");
            const today = new Date();
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            const formattedDate = today.toLocaleDateString('en-US', options);
            reportDateElement.textContent = `Report As Of: ${formattedDate}`;
        });
    </script>
</body>
</html>
