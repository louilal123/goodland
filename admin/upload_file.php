
<?php include "classes/admindetails.php"; ?>
<!DOCTYPE html>
<html lang="en"> 
<?php include "includes/header.php"; ?>

<link rel="stylesheet" href="dist/custom.css">

<style>
    body{
        overflow: hidden;
    }

    .custom-close {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: #f1f1f1;
    border: 2px solid #ccc;
    border-radius: 50%;
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    color: #333;
    cursor: pointer;
    transition: background-color 0.3s ease, border-color 0.3s ease;
}

.custom-close:hover {
    background-color: #e0e0e0;
    border-color: #999;
}

.custom-close:focus {
    outline: none;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
}

</style>
<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary">

    <div class="app-wrapper">

       <?php include "includes/sidebar.php" ?>
        <div class="app-main-wrapper main-blur"> 
           <?php 
            include "includes/topnav.php"; ?>
            <main class="app-main">
            <div class="app-content"> 
                <div class="container-fluid"> 
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-body">
                                <div class="card-header d-flex ">
                                  <h3 class="fw-bold">List of Files</h3>
                                      <button type="button" class="btn btn-success ms-auto btn-rounded me-1" onclick="location.reload(); return false;">
                                          <i class="fas fa-refresh"></i> Refresh
                                      </button>
                                      <button type="button" class="btn btn-danger btn-rounded" data-bs-toggle="modal" data-bs-target="#addItemModal">
                                          <i class="fas fa-user-plus"></i> Delete All
                                      </button>
                                </div>
                                    <table id="myTable" class="table-responsive table text-sm table-hover table-striped w-100">
                                        <thead class="table-secondary fw-bold">
                                            <tr>
                                                <th style="font-weight: bold;">ID</th>
                                                <th style="font-weight: bold;">Title</th>
                                                <th style="font-weight: bold;">Description</th>
                                                <th style="font-weight: bold;">File Path</th>
                                                <th style="font-weight: bold;" >Uploaded By</th>
                                                <th style="font-weight: bold;" >Upload Date</th>
                                                <th style="font-weight: bold;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (empty($approved_files)): ?>
                                            <tr>
                                                <td colspan="8" class="text-center">
                                                    No records to show.
                                                </td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($approved_files as $file): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($file['id']); ?></td>
                                                <td><?php echo htmlspecialchars($file['title']); ?></td>
                                                <td><?php echo htmlspecialchars($file['description']); ?></td>
                                                <td><?php echo htmlspecialchars($file['file_path']); ?></td>
                                                <td><?php echo htmlspecialchars($file['fullname']); ?></td>
                                                <td><?php echo date("M d, Y h:i A", strtotime($file['upload_date'])); ?></td>
                                                <td>
                                                    <a href="../uploads/<?php echo htmlspecialchars($file['file_path']); ?>" class="btn btn-info btn-sm viewBtn ml-1" name="viewPdf">
                                                        <i class="bi bi-search"></i> View
                                                    </a>
                                                    <button class="btn btn-warning btn-sm declineBtn ml-1">
                                                        <i class="bi bi-x-lg"></i> Add to Pending
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
  

<div class="modal fade" id="declineModal" tabindex="-1" aria-labelledby="declineModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="declineModalLabel">Add To Pending</h5>
                <button type="button" class="custom-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                             <form  action="classes/upload.php" method="post" enctype="multipart/form-data">
                                    <!-- Title Field -->
                                    <div class="md-form mb-3">
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
                                    <div class="md-form mb-3">
                                        <label class="text-dark" for="materialFileDescription">Provide a brief description about the document you're submitting.</label>
                                        <textarea cols="6" class="form-control 
                                        <?php 
                                            if (!empty($_SESSION['error_description'])) {
                                                echo 'is-invalid';
                                            } elseif (!empty($_SESSION['form_data']['description'])) {
                                                echo 'is-valid';
                                            }
                                        ?>"  name="description"><?php echo $_SESSION['form_data']['description'] ?? ''; ?></textarea>
                                        <?php if (!empty($_SESSION['error_description'])): ?>
                                            <div class="invalid-feedback mb-4"><?php echo $_SESSION['error_description']; unset($_SESSION['error_description']); ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <!-- Cover Image Field -->
                                    <div class="md-form mb-3">
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
                                    <div class="md-form mb-3">
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
                                    <!-- Agreement Footer -->
                                    <div class="footer">
                                        <p class="mt">By uploading, you agree to our
                                            <a href="#" id="uploaderAgreementLink">Uploader Agreement</a>. Ensure you have the rights to share the documents you upload.
                                        </p>
                                    </div>

                                    <!-- Submit Button -->
                                    <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block btn-lg mt-4">Save <i class="fas fa-arrow-right"></i></button>
                                </form>
                                </div>
                                 </div>
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
                    <div class="mb-3">
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
document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('.approveBtn').forEach(button => {
        button.addEventListener('click', function() {
            let id = this.getAttribute('data-id');
            let title = this.getAttribute('data-title');
            let description = this.getAttribute('data-description');
            let filepath = this.getAttribute('data-filepath');
            let filetype = this.getAttribute('data-filetype');
            let uploaded_by = this.getAttribute('data-uploaded_by');
            let upload_date = this.getAttribute('data-upload_date');

            // Update elements in approve modal
            document.getElementById('approveFileId').value = id;
            document.getElementById('approveFileTitle').textContent = title;
            document.getElementById('approveFileDescription').textContent = description;
            document.getElementById('approveFilePath').textContent = filepath;
            document.getElementById('approveFilePathEmbed').src = `../uploads/${filepath}#toolbar=0&navpanes=0`;
            document.getElementById('approveFileType').textContent = filetype;
            document.getElementById('approveUploadedBy').textContent = uploaded_by;
            document.getElementById('approveUploadDate').textContent = upload_date;
        });
    });
    document.querySelectorAll('.declineBtn').forEach(button => {
        button.addEventListener('click', function() {
            let id = this.getAttribute('data-id');
            let title = this.getAttribute('data-title');
            let description = this.getAttribute('data-description');
            let filepath = this.getAttribute('data-filepath');
            let filetype = this.getAttribute('data-filetype');
            let uploaded_by = this.getAttribute('data-uploaded_by');
            let upload_date = this.getAttribute('data-upload_date');

            // Update elements in decline modal
            document.getElementById('declineFileId').value = id;
            document.getElementById('declineFileTitle').textContent = title;
            document.getElementById('declineFileDescription').textContent = description;
            document.getElementById('declineFilePath').textContent = filepath;
            document.getElementById('declineFilePathEmbed').src = `../uploads/${filepath}#toolbar=0&navpanes=0`;
            document.getElementById('declineFileType').textContent = filetype;
            document.getElementById('declineUploadedBy').textContent = uploaded_by;
            document.getElementById('declineUploadDate').textContent = upload_date;
        });
    });
});


</script>


</html>
