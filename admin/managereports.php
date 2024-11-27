<?php include "classes/admindetails.php"; ?>
<!DOCTYPE html>
<html lang="en"> 
<?php include "includes/header.php"; ?>

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
                                    <!-- Card Header -->
                                    <div class="card-header">
                                        <h3 class="fw-bold">
                                            <span class="fas fa-chart-line"></span> Manage Reports
                                        </h3>
                                    </div>

                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <!-- Date Range Form -->
                                        <form method="POST" action="generate_report.php" class="row g-3">
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

                                    <!-- Card Footer -->
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

</body>
</html>
