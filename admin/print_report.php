<?php 
include 'classes/admindetails.php';

// Fetch date range from GET parameters
$dateFrom = isset($_GET['date_from']) ? $_GET['date_from'] : null;
$dateTo = isset($_GET['date_to']) ? $_GET['date_to'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Sawod Data Report</title>
    <?php include "includes/header.php"; ?>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <style>
        body {
            padding-top: 10px !important;
        }
        header, footer {
            display: none;
        }
        .print-button {
            margin-bottom: 20px;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        .print-button:hover {
            background-color: #0056b3;
        }
        body {
            padding: 20px;
        }
    </style>
</head>
<body>
 <section>
 <div class="card">
        <div class="card-body text-center">
            <h4>GoodLand Association</h4>
            <h5>E-Sawod Data Report</h5>
            <p>Date From: <span id="modal-dateFrom"><?php echo htmlspecialchars($dateFrom); ?></span> - Date To: 
            <span id="modal-dateTo"><?php echo htmlspecialchars($dateTo); ?></span></p>
           <section>
         
           </section>
        <?php     
            $dateFrom = isset($_GET['date_from']) ? $_GET['date_from'] : null;
            $dateTo = isset($_GET['date_to']) ? $_GET['date_to'] : null;
        ?>
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
                        <!-- Data will be injected here via JS -->
                    </tbody>
                </table>
            </div>
           </div>
            <center>
                <br><br>
                <button class="print-button" id="printButton">Print Report</button>
                </center>
            </center>
        </div>
    </div>
 </section>

    <?php include "includes/footer.php"; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            const printButton = document.getElementById('printButton');
            printButton.addEventListener('click', function() {
                window.print(); 
            });
        });
    </script>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var dateFrom = "<?php echo $dateFrom; ?>";
        var dateTo = "<?php echo $dateTo; ?>";

        document.getElementById('modal-dateFrom').textContent = dateFrom;
        document.getElementById('modal-dateTo').textContent = dateTo;

        var formData = new FormData();
        formData.append('date_from', dateFrom);
        formData.append('date_to', dateTo);

        fetch('generate_report.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            var tableBody = document.querySelector('#summaryTable tbody');
            tableBody.innerHTML = '';  

            if (data.error) {
                alert(data.error);
            } else {
                data.forEach(row => {
                    var tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${row.kit_name}</td>
                        <td>${row.highest_wl} cm</td>
                        <td>${row.lowest_wl} cm</td>
                        <td>${row.highest_temp} °C</td>
                        <td>${row.lowest_temp} °C</td>
                        <td>${row.highest_humidity} %</td>
                        <td>${row.lowest_humidity} %</td>
                    `;
                    tableBody.appendChild(tr);
                });
            }
        })
        .catch(error => {
            console.error('Error fetching the data:', error);
        });
    });
</script>


    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var dateFrom = "<?php echo $dateFrom; ?>";
            var dateTo = "<?php echo $dateTo; ?>";

            document.getElementById('modal-dateFrom').textContent = dateFrom;
            document.getElementById('modal-dateTo').textContent = dateTo;

            var formData = new FormData();
            formData.append('date_from', dateFrom);
            formData.append('date_to', dateTo);

            fetch('get_esawod_1_data.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    throw new Error(data.error);
                }
                Highcharts.chart('kit1', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'E-SAWOD1 Average Data'
                    },
                    xAxis: {
                        categories: data.days,
                        title: {
                            text: 'Day of the Month'
                        }
                    },
                    yAxis: {
                        title: {
                            text: 'Values'
                        }
                    },
                    series: [{
                        name: 'Water Level (cm)',
                        type: 'column',
                        data: data.level_data
                    }, {
                        name: 'Temperature (°C)',
                        data: data.temperature_data
                    }, {
                        name: 'Humidity (%)',
                        data: data.humidity_data
                    }]
                });

                return fetch('get_esawod_2_data.php', {
                    method: 'POST',
                    body: formData
                });
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    throw new Error(data.error);
                }
                Highcharts.chart('kit2', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'E-SAWOD2 Average Data'
                    },
                    xAxis: {
                        categories: data.days,
                        title: {
                            text: 'Day of the Month'
                        }
                    },
                    yAxis: {
                        title: {
                            text: 'Values'
                        }
                    },
                    series: [{
                        name: 'Water Level (cm)',
                        type: 'column',
                        data: data.level_data
                    }, {
                        name: 'Temperature (°C)',
                        data: data.temperature_data
                    }, {
                        name: 'Humidity (%)',
                        data: data.humidity_data
                    }]
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
        });
    </script>

</body>
</html>
