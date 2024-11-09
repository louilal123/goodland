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
                                                    <?php if ($file['status'] == 'Active'): ?>
                                <span class="badge bg-success">Published</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Unpublished</span>
                            <?php endif; ?>
                                                    <td><?php echo date("M d, Y h:i A", strtotime($file['upload_date'])); ?></td>
                                                    <td>
                                                        <a href="../uploads/<?php echo htmlspecialchars($file['file_path']); ?>" class="btn btn-info btn-sm viewBtn" name="viewPdf">
                                                            <i class="bi bi-search"></i> 
                                                        </a>
                                                        <button class="btn btn-success btn-sm editBtn" 
            data-id="<?php echo htmlspecialchars($file['id']); ?>"
            data-title="<?php echo htmlspecialchars($file['title']); ?>"
            data-description="<?php echo htmlspecialchars($file['description']); ?>"
            data-cover="<?php echo htmlspecialchars($file['cover_path']); ?>"
            data-file="<?php echo htmlspecialchars($file['file_path']); ?>"
            data-status="<?php echo htmlspecialchars($file['status']); ?>">
        <i class="bi bi-pencil-square fw-bold"></i> 
                    </button>
                    <a href="classes/delete_file.php?id=<?php echo $file['id']; ?>" class="btn btn-danger btn-sm deleteBtn">
                    <i class="bi bi-trash"></i>
                </a>


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
  <!-- edit modal  -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h4 class="modal-title">Edit Library File</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close-circle"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST" action="classes/update_file.php" enctype="multipart/form-data">
                    <!-- ID (Hidden) -->
                    <input type="hidden" name="id" id="editId">

                    <!-- Title Field -->
                    <div class="md-form mb-2">
                        <label class="text-dark" for="editTitle">Title</label>
                        <input type="text" id="editTitle" class="form-control" name="title">
                    </div>

                    <!-- Description Field -->
                    <div class="md-form mb-2">
                        <label class="text-dark" for="editDescription">Description</label>
                        <textarea id="editDescription" rows="6" class="form-control" name="description"></textarea>
                    </div>

                    <!-- Cover Image Preview -->
                    <div class="mb-2">
                        <label class="text-dark">Current Cover Image</label>
                        <div>
                            <img id="editCoverPreview" src="#" alt="Cover Image" class="img-fluid mb-3" style="max-width: 200px; max-height: 200px;">
                        </div>
                        <label class="text-dark" for="editCover">Change Cover Image</label>
                        <input type="file" id="editCover" class="form-control" name="cover">
                    </div>

                    <!-- File Path Display -->
                    <div class="md-form mb-2">
                        <label class="text-dark">Current File</label>
                        <p id="editFilePath" class="form-control" readonly></p>
                    </div>

                    <!-- File Upload -->
                    <div class="md-form mb-2">
                        <label class="text-dark" for="editFile">Change File</label>
                        <input type="file" id="editFile" class="form-control" name="file">
                    </div>

                    <!-- Status Field -->
                    <div class="md-form mb-2">
                        <label for="editStatus" class="form-label">Status</label>
                        <select id="editStatus" name="status" class="form-control form-select">
                            <option value="published">Published</option>
                            <option value="unpublished">Unpublished</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-lg btn-primary btn-end">Save Changes <i class="fas fa-arrow-right"></i></button>
                    </div>
                </form>
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
                    <div class="md-form mb-2">
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
                            <div class="invalid-feedback mb-2"><?php echo $_SESSION['error_title']; unset($_SESSION['error_title']); ?></div>
                        <?php endif; ?>
                    </div>
                    <!-- Description Field -->
                    <div class="md-form mb-2">
                        <label class="text-dark" for="materialFileDescription">Description</label>
                        <textarea id="materialFileDescription" rows="" class="form-control 
                        <?php 
                            if (!empty($_SESSION['error_description'])) {
                                echo 'is-invalid';
                            } elseif (!empty($_SESSION['form_data']['description'])) {
                                echo 'is-valid';
                            }
                        ?>" name="description"><?php echo $_SESSION['form_data']['description'] ?? ''; ?></textarea>
                        <?php if (!empty($_SESSION['error_description'])): ?>
                            <div class="invalid-feedback mb-2"><?php echo $_SESSION['error_description']; unset($_SESSION['error_description']); ?></div>
                        <?php endif; ?>
                    </div>
                    <!-- Cover Image Field -->
                    <div class="md-form mb-2">
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
                            <div class="invalid-feedback mb-2"><?php echo $_SESSION['error_cover']; unset($_SESSION['error_cover']); ?></div>
                        <?php endif; ?>
                    </div>
                    <!-- File Field -->
                    <div class="md-form mb-2">
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
                            <div class="invalid-feedback mb-2"><?php echo $_SESSION['error_file']; unset($_SESSION['error_file']); ?></div>
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


</div>



    </main>
</body>

<?php include "includes/footer.php"; ?>
<script type="text/javascript" src="mdbfolder/mdb.umd.min.js"></script>
<script>
   document.addEventListener('DOMContentLoaded', function () {
    // Edit Button Click Event
    document.querySelectorAll('.editBtn').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const title = this.getAttribute('data-title');
            const description = this.getAttribute('data-description');
            const cover = this.getAttribute('data-cover');
            const file = this.getAttribute('data-file');
            const status = this.getAttribute('data-status');

            // Set modal fields
            document.getElementById('editId').value = id;
            document.getElementById('editTitle').value = title;
            document.getElementById('editDescription').value = description;
            document.getElementById('editStatus').value = status;

            // Display file path
            document.getElementById('editFilePath').textContent = file;

            // Display cover image
            document.getElementById('editCoverPreview').src = `${cover}`;

            // Show the modal
            new bootstrap.Modal(document.getElementById('editModal')).show();
        });
    });
});

</script>
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
<script>
    $(document).ready(function() {
    $('.deleteBtn').on('click', function(e) {
        e.preventDefault(); 

        const href = $(this).attr('href'); 
        Swal.fire({
            title: 'Are you sure?',
            text: 'This file will be deleted!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = href;
            }
        });
    });
});

</script>





</html>
