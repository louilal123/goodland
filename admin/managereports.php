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
<?php include "includes/header.php"; ?>

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
            height: 380,
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



<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary" >

    <div class="app-wrapper">

       <?php include "includes/sidebar.php" ?>
        <div class="app-main-wrapper"> 
           <?php 
            include "includes/topnav.php"; ?>
          
            <main class="app-main">
                <div class="app-content-header"> 
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="mb-0">Manage Reports</h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Reports</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <button onclick="window.open('reports', '_blank')" class="btn btn-primary float-end">Print Report</button>
                    </div>

                <div class="app-content"> 
                    <div class="container-fluid"> 
                        <!-- Charts Section -->
                        <div class="row mt-4">
                            <div class="col-md-7">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0"><strong>Website Visits for the <?php echo date("M - Y"); ?></strong></h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="line_chart" style="height: 390px;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0"><strong>Downloads for the <?php echo date("M - Y"); ?></strong></h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="side_chart" style="width: 600px; height: 390px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tables Section -->
                        <div class="row mt-3 mb-2">
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
            </main>

          
        </div>
    </div>

    <?php include "includes/footer.php" ?>
  
   
</body>

</html>