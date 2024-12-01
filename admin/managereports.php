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
                                        <!-- Update form action to point to print_report.php -->
                                        <form id="dateRangeForm" class="row g-3" action="print_report.php" method="get">
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

 

    <?php include "includes/footer.php"; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
