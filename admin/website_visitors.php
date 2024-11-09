<?php include "classes/admindetails.php"; ?>
<!DOCTYPE html>
<html lang="en"> 
<?php include "includes/header.php"; ?>
<link rel="stylesheet" href="dist/custom.css">

<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary">
    <div class="app-wrapper">
        <?php include "includes/sidebar.php"; ?>
        <div class="app-main-wrapper main-blur">
            <?php include "includes/topnav.php"; ?>
            <main class="app-main">

                <div class="app-content">
                    <div class="container-fluid">
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <h3 class="fw-bold">Website Visitors</h3>
                                            <button class="btn btn-success ms-auto btn-rounded me-1" onclick="location.reload(); return false;">
                                                <i class="fas fa-refresh"></i> Refresh
                                            </button>
                                            <button class="btn btn-danger btn-rounded" data-bs-toggle="modal" data-bs-target="#deleteAllMessagesModal">
                                                <i class="fas fa-trash"></i> Delete All
                                            </button>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="myTable" class="table table-bordered table-hover table-striped w-100">
                                                <thead class="table-secondary fw-bold">
                                                    <tr>
                                                        <th>Visitor ID</th>
                                                        <th>IP Address</th>
                                                        <th>User Agent</th>
                                                        <th>Country</th>
                                                        <th>Date Added</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- PHP code to generate table rows -->
                                                    <?php foreach ($visitors as $items): ?>
                                                        <tr>
                                                            <td><?php echo htmlspecialchars($items['visitor_id']); ?></td>
                                                            <td><?php echo htmlspecialchars($items['ip_address']); ?></td>
                                                            <td><?php echo htmlspecialchars($items['user_agent']); ?></td>
                                                            <td><?php echo htmlspecialchars($items['country']); ?></td>
                                                            <td><?php echo date("M d, Y h:i A", strtotime($items['date_added'])); ?></td>
                                                            <td>
                                                                <a href="#" class="btn btn-danger btn-sm deleteMessageBtn" 
                                                                   data-message-id="<?php echo $items['visitor_id']; ?>" 
                                                                   data-bs-toggle="modal" 
                                                                   data-bs-target="#deleteMessageModal">
                                                                    <i class="fas fa-trash" style="display: flex; justify-content: center;"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- /.col -->
                        </div> 
                    </div>
                </div>

                <!-- Modal for Delete Confirmation -->
                <!-- Your modal code here -->

            </main>
        </div>
    </div>
    <?php include "includes/footer.php"; ?>
</body>
</html>
