<?php include "classes/admindetails.php"; ?>
<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php"; ?>

<!-- Chart Libraries -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<style>
    #kit1, #kit2{
         width: 330px !important; 
        height: 400px !important;
    }
    @media (max-width: 480px) {
                    #kit1, #kit2 {
                        width: 400px !important;
                        height: 400px !important;
                    }
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
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header bg-light text-dark">
                                        <h3 class="fw-bold">
                                            <span class="fas fa-chart-line"></span> Reports
                                        </h3>
                                    </div>
                                    <div class="card-body text-center">
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
                                                <button id="printButton" type="button" target="_blank" class="btn btn-success" title="Print the report">
                                                    <i class="fas fa-print"></i> Print Report
                                                </button>
                                            </div>
                                        </form>
                                        <hr>
                                            <div class="d-flex ms-auto">
                                                <div class="col-6">
                                                <div id="kit1" style="height: 400px;"></div> 
                                                </div>
                                                <div class="col-6">
                                                <div id="kit2" style="height: 400px;"></div> 
                                                </div>
                                            </div>

                                        <hr>
                                    </div>

                                   <div class="card">
                                   <div class="card-header">
                                        Data Summary 
                                    </div>

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
            </main>
        </div>
    </div>

    <?php include "includes/footer.php"; ?>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
   
    <!-- Scripts -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        const monthInput = document.getElementById('monthYearInput');
        let monthOf = monthInput.value;

        const formData = new FormData();
        formData.append('month_of', monthOf);

        function fetchDataForKit1() {
            fetch('get_esawod_1_data.php', {
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
                                type: 'column',
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
            fetch('get_esawod_2_data.php', {
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
                                type: 'column',
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

        document.getElementById('printButton').addEventListener('click', function () {
    document.getElementById('monthYearFilterForm').style.display = 'none';
    document.getElementById('printButton').style.display = 'none';

    const navLinks = document.querySelectorAll('.app-header .nav-link');
    const navItems = document.querySelectorAll('.app-header .nav-item');
    navLinks.forEach(link => link.style.display = 'none');
    navItems.forEach(item => item.style.display = 'none');

    const reportHeader = document.querySelector('.card-header.bg-light.text-dark');
    if (reportHeader) {
        reportHeader.style.display = 'none';
    }

    const monthYearInput = document.getElementById('monthYearInput');
    const monthYearText = new Date(monthYearInput.value).toLocaleString('default', { month: 'long', year: 'numeric' });

    const style = document.createElement('style');
    style.innerHTML = `
        @media print {
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
            }
            .print-header {
                text-align: center;
                margin-bottom: 20px;
                z-index: 1000;
                position: relative;
            }
            .print-header h1 {
                font-size: 2em;
                color: #007bff;
            }
            .print-header p {
                font-size: 1.2em;
            }
        }
    `;
    document.head.appendChild(style);

    const printHeader = `
        <div class="print-header">
            <h1 class="text-primary">GOOD<i class="fw-light">Land</i></h1>
            <h5>ESAWOD DATA Report</h5>
            <p>37 St., Brgy Atop-Atop, Bantayan Island, Cebu</p>
            <p>${monthYearText}</p>
        </div>
    `;

    const bodyContent = document.body.innerHTML;
    document.body.innerHTML = printHeader + bodyContent;

    window.print();

    window.onafterprint = function () {
        document.body.innerHTML = bodyContent;

        document.getElementById('monthYearFilterForm').style.display = '';
        document.getElementById('printButton').style.display = '';
        navLinks.forEach(link => link.style.display = '');
        navItems.forEach(item => item.style.display = '');
        
        if (reportHeader) {
            reportHeader.style.display = '';
        }

        document.head.removeChild(style);
    };
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
            fetch('generate_report.php', {
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
