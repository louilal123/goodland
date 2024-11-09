<?php
if (isset($_GET['viewPdf']) && isset($_GET['file_path'])) {
    $file_path = 'uploads/' . htmlspecialchars($_GET['file_path']);
    if (file_exists($file_path)) {
        header("Content-Type: application/pdf");
        readfile($file_path);
        exit;
    } else {
        echo "File not found.";
    }
}
?>
<?php include "classes/admindetails.php"; ?>
<!DOCTYPE html>
<html lang="en"> 
<?php include "includes/header.php"; ?>

<link rel="stylesheet" href="dist/custom.css">

<style>
    body{
        overflow: hidden;
    }
</style>
<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini">

    <div class="app-wrapper">

       <?php include "includes/sidebar.php" ?>
        <div class="app-main-wrapper main-blur"> 
           <?php 
            include "includes/topnav.php"; ?>
            <main class="app-main">
            <div class="app-content"> 
                <div class="container-fluid"> 
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="card mt-2">
                                <div class="card-body">
                                    <div class="d-flex mb-3">
                                        <h3 class="fw-bold">List of Library Files</h3>
                                        <button type="button" class="btn btn-primary ms-auto me-1" data-bs-toggle="modal" data-bs-target="#addItemModal">
                                            <i class="fas fa-folder-plus"></i> ADD NEW
                                        </button>
                                    </div>
                                    <table id="myTable" class="table table-bordered table-hover table-striped text-center w-100">
                                        <thead class="table-secondary fw-bold">
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Image</th>
                                                <th>File Path</th>
                                                <th>Uploaded By</th>
                                                <th width="15%">Upload Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (empty($all_files)): ?>
                                                <tr>
                                                    <td colspan="7" class="text-center">
                                                        No records to show.
                                                    </td>
                                                </tr>
                                            <?php else: ?>
                                                <?php foreach ($all_files as $file): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($file['id']); ?></td>
                                                    <td><?php echo htmlspecialchars($file['title']); ?></td>
                                                    <td><img src="<?php echo htmlspecialchars($file['cover_path']); ?>" style="width: 60px; height: 35px;"></td>
                                                    <td><?php echo htmlspecialchars($file['file_path']); ?></td>
                                                    <td><?php echo htmlspecialchars($file['fullname']); ?></td>
                                                    <td><?php echo date("M d, Y h:i A", strtotime($file['upload_date'])); ?></td>
                                                    <td>
                                                        <a href="../uploads/<?php echo htmlspecialchars($file['file_path']); ?>" class="btn btn-info btn-sm viewBtn" name="viewPdf">
                                                            <i class="bi bi-search"></i> 
                                                        </a>
                                                        <button class="btn btn-success btn-sm editBtn">
                                                            <i class="bi bi-pencil-square fw-bold"></i> 
                                                        </button>
                                                        <button class="btn btn-danger btn-sm deleteBtn">
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
        </div>
  
<!-- View Modal -->
<div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h4 class="modal-title">Add New Library File</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close-circle"></button>
            </div>
            <div class="modal-body">
                <form  action="classes/upload.php" method="post" enctype="multipart/form-data">
                    <!-- Title Field -->
                    <div class="md-form mb-4">
                        <label class="text-dark" for="materialFileTitle">Title</label>
                        <input type="text" id="materialFileTitle" class="form-control 
                        <?php 
                            if (!empty($_SESSION['error_title'])) {
                                echo 'is-invalid';
                            } elseif (!empty($_SESSION['form_data']['title'])) {
                                echo 'is-valid';
                            }
                        ?>" name="title" value="<?php echo $_SESSION['form_data']['title'] ?? ''; ?>">
                        <?php if (!empty($_SESSION['error_title'])): ?>
                            <div class="invalid-feedback mb-4"><?php echo $_SESSION['error_title']; unset($_SESSION['error_title']); ?></div>
                        <?php endif; ?>
                    </div>
                    <!-- Description Field -->
                    <div class="md-form mb-4">
                        <label class="text-dark" for="materialFileDescription">Description</label>
                        <textarea id="materialFileDescription" rows="6" class="form-control 
                        <?php 
                            if (!empty($_SESSION['error_description'])) {
                                echo 'is-invalid';
                            } elseif (!empty($_SESSION['form_data']['description'])) {
                                echo 'is-valid';
                            }
                        ?>" name="description"><?php echo $_SESSION['form_data']['description'] ?? ''; ?></textarea>
                        <?php if (!empty($_SESSION['error_description'])): ?>
                            <div class="invalid-feedback mb-4"><?php echo $_SESSION['error_description']; unset($_SESSION['error_description']); ?></div>
                        <?php endif; ?>
                    </div>
                    <!-- Cover Image Field -->
                    <div class="md-form mb-4">
                        <label class="text-dark" for="coverImage">Cover Image</label>
                        <input type="file" id="coverImage" class="form-control 
                        <?php 
                            if (!empty($_SESSION['error_cover'])) {
                                echo 'is-invalid';
                            } elseif (!empty($_SESSION['form_data']['cover'])) {
                                echo 'is-valid';
                            }
                        ?>" name="cover">
                        <?php if (!empty($_SESSION['error_cover'])): ?>
                            <div class="invalid-feedback mb-4"><?php echo $_SESSION['error_cover']; unset($_SESSION['error_cover']); ?></div>
                        <?php endif; ?>
                    </div>
                    <!-- File Field -->
                    <div class="md-form mb-4">
                        <label class="text-dark" for="file">File</label>
                        <input type="file" id="file" class="form-control 
                        <?php 
                            if (!empty($_SESSION['error_file'])) {
                                echo 'is-invalid';
                            } elseif (!empty($_SESSION['form_data']['file'])) {
                                echo 'is-valid';
                            }
                        ?>" name="file">
                        <?php if (!empty($_SESSION['error_file'])): ?>
                            <div class="invalid-feedback mb-4"><?php echo $_SESSION['error_file']; unset($_SESSION['error_file']); ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="md-form mb">
                        <label for="status" class="form-label">Status:</label>
                        <select id="status" name="status" class="form-control form-select   <?php 
                            if (!empty($_SESSION['error_status'])) {
                                echo 'is-invalid';
                            } elseif (!empty($_SESSION['form_data']['status'])) {
                                echo 'is-valid';
                            }
                        ?>">
                            <option value="published">Published</option>
                            <option value="unpublished">Unpublished</option>
                        </select>
                        <?php if (!empty($_SESSION['error_status'])): ?>
                            <div class="invalid-feedback "><?php echo $_SESSION['error_status']; unset($_SESSION['error_status']); ?></div>
                        <?php endif; ?>
                       
                    </div>

                    <div class="modal-footer">
                    <button  type="submit" class="btn btn-lg btn-primary btn-end">Save <i class="fas fa-arrow-right"></i></button>
              
                    </div>

                    <!-- Submit Button -->
                     </form>
            </div>
        </div>
    </div>
</div>

<!-- View Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveModalLabel">Approve File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <embed src="" id="approveFilePathEmbed" type="application/pdf" class="custom-card-img mb-1" style="display: flex; margin: auto; overflow: hidden !important; width: 50% !important; height: 360px;">
                <p><strong>Title:</strong> <span id="approveFileTitle"></span></p>
                <p><strong>Description:</strong> <span id="approveFileDescription"></span></p>
                <p><strong>File Path:</strong> <span id="approveFilePath"></span></p>
                <p><strong>File Type:</strong> <span id="approveFileType"></span></p>
                <p><strong>Uploaded By:</strong> <span id="approveUploadedBy"></span></p>
                <p><strong>Upload Date:</strong> <span id="approveUploadDate"></span></p>
                <form method="POST" action="classes/file_action.php">
                    <input type="hidden" name="file_id" id="approveFileId">
                    <div class="mb-4">
                        <p><strong>Remarks:</strong></p>
                        <textarea class="form-control" id="approveRemarks" name="remarks" rows="3" required>File Approved! Thank you for sharing your resource on our platform.</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="approveBtn">Approve</button>
                    </div>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Show the modal if there is form data from session
        <?php if (isset($_SESSION['form_data'])): ?>
        var myModal = new bootstrap.Modal(document.getElementById('addItemModal'), {
            backdrop: 'static'
        });
        myModal.show();
        <?php 
        unset($_SESSION['form_data']);
        endif; ?>
    });
</script>




</html>
