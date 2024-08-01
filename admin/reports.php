<?php include "classes/admindetails.php" ?>
<?php
require_once('classes/Main_class.php');
$mainClass = new Main_class();

//for the line chart
$visitor_data = $mainClass->get_monthly_visitor_data();
$download_data = $mainClass->getDownloadData1();

$m_visitors = $mainClass->get_visitor_data_for_current_month();
$m_downloads = $mainClass->get_download_data_for_current_month();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  
    
<link rel="stylesheet" href="mdbfolder/css/mdb.min.css" />
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['line']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('number', 'Day');
        data.addColumn('number', 'Signed-Up Users');
        data.addColumn('number', 'Non-Signed-Up Users');

        var rawData = <?php echo json_encode($visitor_data); ?>;
        var formattedData = [];
        var daysInMonth = new Date(new Date().getFullYear(), new Date().getMonth() + 1, 0).getDate();

        // Initialize all days with 0 values
        for (var day = 1; day <= daysInMonth; day++) {
            formattedData.push([day, 0, 0]);
        }

        // Fill in the data from the database
        rawData.forEach(function(row) {
            formattedData[row.day - 1] = [row.day, row.signed_up, row.non_signed_up];
        });

        data.addRows(formattedData);

        var options = {
            chart: {
                title: 'Website Visitors',
                subtitle: 'Signed-Up Users vs Non-Signed-Up Users'
            },
            width: 850,
            height: 390,
            hAxis: {
                title: 'Day',
                ticks: Array.from({length: daysInMonth}, (_, i) => i + 1) // All days of the month
            },
            vAxis: {
                title: 'Visits'
            }
        };

        var chart = new google.charts.Line(document.getElementById('line_chart'));
        chart.draw(data, google.charts.Line.convertOptions(options));
    }
</script>
<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawBarColors);

    function drawBarColors() {
        var rawData = <?php echo json_encode($download_data); ?>;
        var formattedData = [['File Type', 'Signed-Up Users', 'Non-Signed-Up Users']];

        // Initialize all file types with zero downloads for both user types
        var fileTypes = ['Documents', 'Images', 'Arts', 'Maps'];
        var downloadCounts = {
            'Documents': { 'Signed-Up': 0, 'Non-Signed-Up': 0 },
            'Images': { 'Signed-Up': 0, 'Non-Signed-Up': 0 },
            'Arts': { 'Signed-Up': 0, 'Non-Signed-Up': 0 },
            'Maps': { 'Signed-Up': 0, 'Non-Signed-Up': 0 }
        };

        // Fill in the data from the database
        rawData.forEach(function(row) {
            downloadCounts[row.file_type][row.user_type] = row.download_count;
        });

        // Push the data to formattedData array
        fileTypes.forEach(function(type) {
            formattedData.push([type, downloadCounts[type]['Signed-Up'], downloadCounts[type]['Non-Signed-Up']]);
        });

        var data = google.visualization.arrayToDataTable(formattedData);

        var options = {
            title: 'Number of Downloads by File Type',
            chartArea: {width: '50%'},
            hAxis: {
                title: 'Total Downloads',
                minValue: 0
            },
            vAxis: {
                title: 'File Type'
            },
            bars: 'horizontal'
        };

        var chart = new google.visualization.BarChart(document.getElementById('side_chart'));
        chart.draw(data, options);
    }
</script>



<style>
    @page {
        margin-top: 0;
        margin-left: 1in;
        margin-right: 1in;
        margin-bottom: 2in;
    }
    body {
        margin: 1cm;
    }
    h3 {
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
            top: 0; /* Changed from 10 to 0 */
            width: 100%;
            padding: 30px;
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
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            font-size: 10px;
            padding: 5px; /* Added padding for better readability */
            text-align: left; /* Ensure text is left-aligned */
            border: 1px solid #ddd; /* Added border for better table visibility */
        }
        #reportHeader {
            position: fixed;
            top: 0;
            width: 100%;
            background: white;
            padding: 20px; /* Increased padding for better spacing */
            text-align: center;
            z-index: 1000;
        }
        .page-break {
            page-break-before: always; /* Ensures new sections start on a new page */
        }
    }
</style>


<body onload="window.print()">
    <div id="printableArea">
        <div id="reportHeader">
            <img src="uploads/logogoodland.png" style="display:flex; margin: auto; width: 150px; height:55px;">
            <h4 class="text-center">GoodLand Management System</h4>
            <h4 class="text-center">Purok Kulo 2, Atop-Atop, Bantayan 6053, Cebu</h4>
            <h4 class="text-center"><span id="reportDate"></span></h4>
            <!-- <h4 class="text-center mt-5">Report Type: Monthly</h4> -->
            
        </div>

        <div class="container-fluid" style="margin-top: 150px;"> 
                        <!-- Charts Section -->
                        <div class="row mt-5" >
                            <div class="col-md-12 mt-5">
                                <div class="card">
                                    
                                    <div class="card-body">
                                        <div id="line_chart" style="height: 390px;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Downloads for the <?php echo date("M - Y"); ?></h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="side_chart" style="width: 900px; height: 290px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tables Section -->
                        <div class="row mt-1">
                            <div class="col-md-7">
                                <div class="card">
                                    <div class="card-header">Website Visitors Details</div>
                                    <div class="card-body">
                                        <table class="table table-bordered table-sm text-sm">
                                            <thead>
                                                <tr>
                                                    <th>Fullname</th>
                                                    <th>IP</th>
                                                    <th>City</th>
                                                    <th>Region</th>
                                                    <th>Country</th> 
                                                    <th>Visit Time</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($m_visitors as $row) : ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($row['fullname'] ?? 'N/A'); ?></td>
                                                        <td><?php echo htmlspecialchars($row['ip']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['city']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['region']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['country']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['visit_time']); ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>  
                            <div class="col-md-5">
                                <div class="card">
                                    <div class="card-header">File Downloads Details</div>
                                    <div class="card-body">
                                        <table class="table text-sm table-bordered table-sm text-sm">
                                            <thead>
                                                <tr>
                                                    <th>Fullname</th>
                                                    <th>File Title</th>
                                                    <th>Download Time</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($m_downloads as $row) : ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($row['fullname'] ?? 'N/A'); ?></td>
                                                        <td><?php echo htmlspecialchars($row['title'] ?? 'N/A'); ?></td>
                                                        <td><?php echo htmlspecialchars($row['download_time'] ?? 'N/A'); ?></td>
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
