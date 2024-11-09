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
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="card-header d-flex ">
                                            <h3 class="fw-bold text-primary p-0 m-0 "><span class="fas fa-hourglass"></span> Website Visitors</h3>
                                            <button type="button" class="btn btn-danger ms-auto btn-rounded" data-bs-toggle="modal" data-bs-target="#deleteAllMessagesModal">
                                                <i class="fas fa-trash"></i> Delete All
                                            </button>
                                        </div>
                                        <table id="myTable" class="table-responsive table text-sm table-hover table-striped w-100">
                                            <thead class="table-secondary fw-bold">
                                                <tr>
                                                    <th style="font-weight: bold;">Visitor_id</th>
                                                    <th style="font-weight: bold;">Ip_address</th>
                                                    <th style="font-weight: bold;">User_agent</th>
                                                    <th style="font-weight: bold;">Country</th>
                                                    <th style="font-weight: bold;" width="15%">Date added</th>
                                                    <th style="font-weight: bold;" width="auto">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($visitors as $items): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($items['visitor_id']); ?></td>
                                                    <td><?php echo htmlspecialchars($items['ip_address']); ?></td>
                                                    <td><?php echo htmlspecialchars($items['user_agent']); ?></td>
                                                    <td><?php echo htmlspecialchars($items['country']); ?></td>
                                                    <td><?php echo date("M d, Y h:i A", strtotime($items['date_added'])); ?></td>
                                                    <td>
                                                        <a href="#" class="btn btn-danger btn-sm btn-rounded deleteMessageBtn" 
                                                            data-message-id="<?php echo $items['visitor_id']; ?>" 
                                                            data-bs-toggle="modal" data-bs-target="#deleteMessageModal">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </a>
                                                    </td>
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

                <!-- Modals -->
                <div class="modal fade" id="deleteMessageModal" tabindex="-1" aria-labelledby="deleteMessageModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold" id="deleteMessageModalLabel">Confirm Deletion</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body fw-bold">Are you sure you want to delete this message?</div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-rounded" data-bs-dismiss="modal">Cancel</button>
                                <form method="POST" action="classes/delete_message.php">
                                    <input type="hidden" name="delete_message_id" id="delete_message_id">
                                    <button type="submit" class="btn btn-danger btn-rounded">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="deleteAllMessagesModal" tabindex="-1" aria-labelledby="deleteAllMessagesModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteAllMessagesModalLabel">Confirm Deletion of All Messages</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">Are you sure you want to delete all messages? This action cannot be undone.</div>
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

            </main>
        </div>
    </div>
    
    <?php include "includes/footer.php"; ?>

    <script type="text/javascript" src="mdbfolder/mdb.umd.min.js"></script>

</body>
</html>
