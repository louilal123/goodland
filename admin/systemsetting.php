<?php include "classes/admindetails.php"; ?>
<!DOCTYPE html>
<html lang="en"> 
<?php include "includes/header.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary">

    <div class="app-wrapper">
       <?php include "includes/sidebar.php" ?>
        <div class="app-main-wrapper"> 
           <?php include "includes/topnav.php"; ?>
            <main class="app-main">

            <div class="app-content"> 
                <div class="container-fluid"> 
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="card">
                                    <div class="card-header bg-light d-flex ">
                                        <h3 class="fw-bold"><span class="fas fa-gear"></span> System Setting </h3>
                                        <button type="button" class="btn btn-primary ms-auto me-1" data-bs-toggle="modal" data-bs-target="#backupModal">
                                            <i class="fas fa-folder-plus"></i> Create Backup
                                        </button>
                                    </div>
                                <div class="card-body">
                               
                                    <table id="myTable" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>File Name</th>
                                                <th>Backup Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($backups as $backup): ?>
                                            <tr>
                                                <td><?= $backup['backup_id'] ?></td>
                                                <td><?= $backup['file_name'] ?></td>
                                                <td><?= $backup['backup_date'] ?></td>
                                                <td>
                                                    <a href="classes/<?= $backup['file_path'] ?>" download class="btn btn-primary btn-sm">Download</a>
                                                    
                                                    <a href="classes/delete_backup.php?id=<?= $backup['backup_id'] ?>" class="btn btn-danger btn-sm deleteBtn">Delete</a>

                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>

                                </div>
                              
                            </div>
                        </div>
                    </div>
                   
                    <div class="row mt-2">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h3 class="fw-bold"> <i class="fas fa-info-circle"></i> Website Information</h3>
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" 
                            value="<?php echo htmlspecialchars($settings['address'] ?? 'Not Available'); ?>" readonly>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <label for="contact" class="form-label">Contact Form</label>
                        <input type="text" class="form-control" id="contact" 
                            value="<?php echo htmlspecialchars($settings['contact'] ?? 'No Contact'); ?>" readonly>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" 
                            value="<?php echo htmlspecialchars($settings['email'] ?? 'No Email'); ?>" readonly>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <label for="facebook_url" class="form-label">Facebook</label>
                        <input type="text" class="form-control" id="facebook_url" 
                            value="<?php echo htmlspecialchars($settings['facebook_url'] ?? '@notavailable'); ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button type="button" class="btn btn-primary btn" data-bs-toggle="modal" data-bs-target="#editSettingsModal">
                    <i class="fas fa-edit"></i> Update
                </button>
            </div>
        </div>
    </div>
</div>

        

<!-- Modal for updating website details -->
<div class="modal fade" id="editSettingsModal" tabindex="-1" aria-labelledby="editSettingsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="classes/update_settings.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSettingsModalLabel">Edit Website Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" id="address" value="<?php echo htmlspecialchars($_SESSION['form_data']['address'] ?? $settings['address'] ?? ''); ?>" required>
                        <?php if (isset($_SESSION['error_address'])) { ?>
                            <small class="text-danger"><?php echo $_SESSION['error_address']; ?></small>
                        <?php } ?>
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact</label>
                        <input type="text" class="form-control" name="contact" id="contact" value="<?php echo htmlspecialchars($_SESSION['form_data']['contact'] ?? $settings['contact'] ?? ''); ?>">
                        <?php if (isset($_SESSION['error_contact'])) { ?>
                            <small class="text-danger"><?php echo $_SESSION['error_contact']; ?></small>
                        <?php } ?>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?php echo htmlspecialchars($_SESSION['form_data']['email'] ?? $settings['email'] ?? ''); ?>">
                        <?php if (isset($_SESSION['error_email'])) { ?>
                            <small class="text-danger"><?php echo $_SESSION['error_email']; ?></small>
                        <?php } ?>
                        <?php if (isset($_SESSION['error_email_format'])) { ?>
                            <small class="text-danger"><?php echo $_SESSION['error_email_format']; ?></small>
                        <?php } ?>
                    </div>
                    <div class="mb-3">
                        <label for="facebook_url" class="form-label">Facebook URL</label>
                        <input type="text" class="form-control" name="facebook_url" id="facebook_url" value="<?php echo htmlspecialchars($_SESSION['form_data']['facebook_url'] ?? $settings['facebook_url'] ?? ''); ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="update_settings" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


                    </div> 
                </div>

            </div> 
        </main>
          
        </div>
    </div>

    

    <!-- Modal for creating backup -->
    <div class="modal fade" id="backupModal" tabindex="-1" aria-labelledby="backupModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="backupModalLabel">Create Database Backup</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Click the button below to create a full backup of your database. This will generate a .sql file containing all tables and data.</p>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form method="POST" action="classes/create_backup.php">
                        <button type="submit" class="btn btn-success">Create Backup</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
  
    <?php include "includes/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Listen for click events on delete buttons
        $('.deleteBtn').on('click', function(e) {
            e.preventDefault(); // Prevent the default link action

            const href = $(this).attr('href'); // Get the URL to the delete page

            // Show SweetAlert confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: 'This backup file will be deleted!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                // If confirmed, redirect to the delete backup page
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });
        });
    });
</script>


</body>

</html>
