<?php include "classes/admindetails.php"; ?>
<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php"; ?>

<link rel="stylesheet" href="dist/custom.css">

<style>
    body {
        overflow: hidden;
    }
</style>
<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini">

    <div class="app-wrapper">

       <?php include "includes/sidebar.php"; ?>
        <div class="app-main-wrapper main-blur">
           <?php include "includes/topnav.php"; ?>
            <main class="app-main">
            <div class="app-content">
                <div class="container-fluid">
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="card mt-2">
                                <div class="card-body">
                                    <div class="d-flex mb-3">
                                        <h3 class="fw-bold">Website Visitors</h3>
                                        <button type="button" class="btn btn-success ms-auto me-1" onclick="location.reload(); return false;">
                                            <i class="fas fa-refresh"></i> Refresh
                                        </button>
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAllMessagesModal">
                                            <i class="fas fa-trash"></i> Delete All
                                        </button>
                                    </div>
                                    <table id="myTable" class="table table-bordered table-hover table-striped text-center w-100">
                                        <thead class="table-secondary fw-bold">
                                            <tr>
                                                <th>Visitor ID</th>
                                                <th>IP Address</th>
                                                <th>User Agent</th>
                                                <th>Country</th>
                                                <th width="15%">Date Added</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (empty($visitors)): ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">
                                                        No records to show.
                                                    </td>
                                                </tr>
                                            <?php else: ?>
                                                <?php foreach ($visitors as $visitor): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($visitor['visitor_id']); ?></td>
                                                    <td><?php echo htmlspecialchars($visitor['ip_address']); ?></td>
                                                    <td><?php echo htmlspecialchars($visitor['user_agent']); ?></td>
                                                    <td><?php echo htmlspecialchars($visitor['country']); ?></td>
                                                    <td><?php echo date("M d, Y h:i A", strtotime($visitor['date_added'])); ?></td>
                                                    <td>
                                                        <button class="btn btn-danger btn-sm deleteBtn" data-message-id="<?php echo $visitor['visitor_id']; ?>" data-bs-toggle="modal" data-bs-target="#deleteMessageModal">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for Deleting All Messages -->
            <div class="modal fade" id="deleteAllMessagesModal" tabindex="-1" aria-labelledby="deleteAllMessagesModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteAllMessagesModalLabel">Confirm Deletion of All Messages</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete all messages? This action cannot be undone.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <form method="POST" action="classes/delete_message.php">
                                <input type="hidden" name="delete_all" value="1">
                                <button type="submit" class="btn btn-danger">Delete All</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for Individual Delete Confirmation -->
            <div class="modal fade" id="deleteMessageModal" tabindex="-1" aria-labelledby="deleteMessageModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteMessageModalLabel">Confirm Deletion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this message?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <form method="POST" action="classes/delete_message.php">
                                <input type="hidden" name="delete_message_id" id="delete_message_id">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
</body>

<?php include "includes/footer.php"; ?>
<script type="text/javascript" src="mdbfolder/mdb.umd.min.js"></script>

</html>
