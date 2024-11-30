<?php include "classes/admindetails.php"; ?>
<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php"; ?>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>

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

                                    <div class="card-header">
                                        <h3 class="fw-bold">
                                            <span class="fas fa-chart-line"></span> Manage Reports
                                        </h3>
                                    </div>

                                    <div class="card-body">
                                        <form id="dateRangeForm" class="row g-3">
                                            <div class="col-md-4">
                                                <label for="dateFrom" class="form-label">Date From</label>
                                                <input type="date" id="dateFrom" name="date_from" class="form-control" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="dateTo" class="form-label">Date To</label>
                                                <input type="date" id="dateTo" name="date_to" class="form-control" required>
                                            </div>
                                            <div class="col-md-4 d-flex align-items-end">
                                                <button type="submit" class="btn btn-primary w-100">
                                                    <i class="fas fa-file-alt"></i> Create Report
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="card-footer text-muted">
                                        Select a date range to generate a report of the desired period.
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </main>
        </div>
    </div>

    <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true" role="document">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="reportModalLabel">E-Sawod Data Report</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class=" modal-body text-center">
                    <h4>GoodLand Philippines</h4>
                    <h5>E-Sawod Data Report</h5>
                    <p>Date From: <span id="modal-dateFrom"></span> - Date To: <span id="modal-dateTo"></span></p>

                    <div class="card mb-2">
                    <div id="kit1"></div>
                    </div>
                    <div class="card mb-2">
                    <div id="kit2"></div>
                    </div>

                    <div class="card">
                        
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
                                                </tbody>
                                            </table>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary print" >Generate PDF</button>
                    </div>
                </div>
        </div>
    </div>

    <?php include "includes/footer.php"; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>


    <script type="text/javascript">
    document.getElementById('dateRangeForm').addEventListener('submit', function(e) {
        e.preventDefault(); 
        var dateFrom = document.getElementById('dateFrom').value;
        var dateTo = document.getElementById('dateTo').value;

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
                    type: 'line'
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
                    data: data.level_data
                }, {
                    name: 'Temperature (°C)',
                    color: '#495057',
                    data: data.temperature_data
                }, {
                    name: 'Humidity (%)',
                    data: data.humidity_data
                }],
                tooltip: {
                    shared: true,
                    valueSuffix: ' units'
                }
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
                    type: 'line'
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
                    data: data.level_data
                }, {
                    name: 'Temperature (°C)',
                    color: '#495057',
                    data: data.temperature_data
                }, {
                    name: 'Humidity (%)',
                    data: data.humidity_data
                }],
                tooltip: {
                    shared: true,
                    valueSuffix: ' units'
                }
            });

            var modal = new bootstrap.Modal(document.getElementById('reportModal'));
            modal.show();
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            alert("An error occurred: " + error.message);
        });
    });
</script>


<script>
document.querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault(); 
    var dateFrom = document.getElementById('dateFrom').value;
    var dateTo = document.getElementById('dateTo').value;

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

        var modal = new bootstrap.Modal(document.getElementById('reportModal'));
        modal.show();
    })
    .catch(error => {
        console.error('Error fetching the data:', error);
    });
});
</script>


 <script>
    $(document).on("click", ".print", function () {
  const section = $("section");
  const modalBody = $(".modal-body").detach();

  const content = $(".app-wrapper").detach();
  section.append(modalBody);
  window.print();
  section.empty();
  section.append(content);
  $(".modal-body-wrapper").append(modalBody);
});

 </script>
</body>
</html>
