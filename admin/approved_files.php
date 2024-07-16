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
<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary">

    <div class="app-wrapper">

       <?php include "includes/sidebar.php" ?>
        <div class="app-main-wrapper"> 
           <?php 
            include "includes/topnav.php"; ?>
            <main class="app-main">
            <div class="app-content-header"> 
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Manage Approved Files</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                Manage Approved Files
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-content"> 
                <div class="container-fluid"> 
                    <div class="row">
                        <div class="col-md-12">
                                <div class="card mb-4 card-outline-primary">
                                    <div class="card-header d-flex ">
                                        <h3 class="card-title mb-0">List of Approved Files</h3>
                                        <a class="btn btn-primary ms-auto custombtn" data-bs-toggle="modal" data-bs-target="#addapproved_fileModal">Add New approved_file</a>
                                    </div>
    
                                    <div class="card-body">
                                        <div class="container-fluid">
                                        <table id="myTable" class="table-responsive table table-hover table-striped w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>File Path</th>
                            <th>File Type</th>
                            <th>Uploaded By</th>
                            <th>Upload Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($approved_files as $file): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($file['id']); ?></td>
                            <td><?php echo htmlspecialchars($file['title']); ?></td>
                            <td><?php echo htmlspecialchars($file['description']); ?></td>
                            <td><?php echo htmlspecialchars($file['file_path']); ?></td>
                            <td><?php echo htmlspecialchars($file['file_type']); ?></td>
                            <td><?php echo htmlspecialchars($file['fullname']); ?></td>
                            <td><?php echo htmlspecialchars($file['upload_date']); ?></td>
                            <td>
            <a href="../uploads/<?php echo htmlspecialchars($file['file_path']); ?>" class="btn btn-info btn-sm viewBtn ml-1" name="viewPdf">
                <i class="bi bi-search"></i> View
            </a>
            <button class="btn btn-success btn-sm approveBtn ml-1" 
                data-id="<?php echo $file['id']; ?>" 
                data-title="<?php echo htmlspecialchars($file['title']); ?>" 
                data-description="<?php echo htmlspecialchars($file['description']); ?>" 
                data-filepath="<?php echo htmlspecialchars($file['file_path']); ?>" 
                data-filetype="<?php echo htmlspecialchars($file['file_type']); ?>" 
                data-uploaded_by="<?php echo htmlspecialchars($file['fullname']); ?>" 
                data-upload_date="<?php echo htmlspecialchars($file['upload_date']); ?>" 
               data-bs-toggle="modal" data-bs-target="#approveModal">
                <i class="bi bi-check-lg"></i> Approve
            </button>
            <button class="btn btn-warning btn-sm declineBtn ml-1" 
                data-id="<?php echo $file['id']; ?>" 
                data-title="<?php echo htmlspecialchars($file['title']); ?>" 
                data-description="<?php echo htmlspecialchars($file['description']); ?>" 
                data-filepath="<?php echo htmlspecialchars($file['file_path']); ?>" 
                data-filetype="<?php echo htmlspecialchars($file['file_type']); ?>" 
                data-uploaded_by="<?php echo htmlspecialchars($file['fullname']); ?>" 
                data-upload_date="<?php echo htmlspecialchars($file['upload_date']); ?>" 
                data-bs-toggle="modal" data-bs-target="#declineModal">
                <i class="bi bi-hand-thumbs-down"></i> Decline
            </button>
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


            </div>
        </div>
    </div>
<!-- View Modal -->
<!-- Decline Modal -->
<div class="modal fade" id="declineModal" tabindex="-1" aria-labelledby="declineModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="declineModalLabel">Decline File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <embed src="../uploads/<?= htmlspecialchars($file['file_path']); ?>#toolbar=0&navpanes=0"
            type="application/pdf" class="custom-card-img mb-1" style="display: flex; margin: auto;overflow:hidden !important; width: 50% !important;height: 360px;">
                <p><strong>Title:</strong> <span id="declineFileTitle"></span></p>
                <p><strong>Description:</strong> <span id="declineFileDescription"></span></p>
                <p><strong>File Path:</strong> <span id="declineFilePath"></span></p>
                <p><strong>File Type:</strong> <span id="declineFileType"></span></p>
                <p><strong>Upload By:</strong> <span id="declineUploadedBy"></span></p>
                <p><strong>Upload Date:</strong> <span id="declineUploadDate"></span></p>
                <div class="mb-3">
                   <p><strong>Admin Remarks:</strong></p>
                    <textarea class="form-control" id="declineRemarks" name="remarks" rows="3" required>File declined! Your file doesnt match the details you provided.</textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="declineDeclineBtn" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning" id="declineSubmitBtn">Decline</button>
            </div>
        </div>
    </div>
</div>
<!-- View Modal -->
<!-- <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">View File Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Title:</strong> <span id="viewFileTitle"></span></p>
                <p><strong>Description:</strong> <span id="viewFileDescription"></span></p>
                <p><strong>File Path:</strong> <span id="viewFilePath"></span></p>
                <p><strong>File Type:</strong> <span id="viewFileType"></span></p>
                <p><strong>Upload Date:</strong> <span id="viewUploadDate"></span></p>
            </div>
        </div>
    </div>
</div> -->
<!-- Approve Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveModalLabel">Approve File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <embed src="../uploads/<?= htmlspecialchars($file['file_path']); ?>#toolbar=0&navpanes=0"
            type="application/pdf" class="custom-card-img mb-1" style="display: flex; margin: auto;overflow:hidden !important; width: 50% !important;height: 360px;">
                <p><strong>Title:</strong> <span id="approveFileTitle"></span></p>
                <p><strong>Description:</strong> <span id="approveFileDescription"></span></p>
                <p><strong>File Path:</strong> <span id="approveFilePath"></span></p>
                <p><strong>File Type:</strong> <span id="approveFileType"></span></p>
                <p><strong>Uploaded By:</strong> <span id="approveUploadedBy"></span></p>
                <p><strong>Upload Date:</strong> <span id="approveUploadDate"></span></p>
                <div class="mb-3">
                    <p><strong>Remarks:</strong></p>
                    <textarea class="form-control" id="approveRemarks" name="remarks" rows="3" required>
                    File Approved! Thank you for sharing your resource to our platform.
                    </textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="approveDeclineBtn" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="approveSubmitBtn">Approve</button>
            </div>
        </div>
    </div>
</div>



    </main>
</body>

<?php include "includes/footer.php"; ?>
<script type="text/javascript" src="mdbfolder/mdb.umd.min.js"></script>
<script>document.addEventListener('DOMContentLoaded', (event) => {

    document.querySelectorAll('.approveBtn').forEach(button => {
        button.addEventListener('click', function() {
            let id = this.getAttribute('data-id');
            let title = this.getAttribute('data-title');
            let description = this.getAttribute('data-description');
            let filepath = this.getAttribute('data-filepath');
            let filetype = this.getAttribute('data-filetype');
            let uploaded_by = this.getAttribute('data-uploaded_by');
            let upload_date = this.getAttribute('data-upload_date');

            document.getElementById('approveFileTitle').textContent = title;
            document.getElementById('approveFileDescription').textContent = description;
            document.getElementById('approveFilePath').textContent = filepath;
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

            document.getElementById('declineFileTitle').textContent = title;
            document.getElementById('declineFileDescription').textContent = description;
            document.getElementById('declineFilePath').textContent = filepath;
            document.getElementById('declineFileType').textContent = filetype;
            document.getElementById('declineUploadedBy').textContent = uploaded_by;
            document.getElementById('declineUploadDate').textContent = upload_date;
        });
    });

    document.getElementById('approveSubmitBtn').addEventListener('click', function() {
        let remarks = document.getElementById('approveRemarks').value.trim();
        let form = new FormData();
        form.append('file_id', document.getElementById('approveFileId').value);
        form.append('remarks', remarks);
        form.append('action', 'approve');

        if (confirm('Are you sure you want to approve this file?')) {
            fetch('classes/file_action.php', {
                method: 'POST',
                body: form
            }).then(response => response.text())
              .then(data => {
                  alert(data);
                  location.reload();
              });
        }
    });

    document.getElementById('declineSubmitBtn').addEventListener('click', function() {
        let remarks = document.getElementById('declineRemarks').value.trim();
        let form = new FormData();
        form.append('file_id', document.getElementById('declineFileId').value);
        form.append('remarks', remarks);
        form.append('action', 'decline');

        if (confirm('Are you sure you want to decline this file?')) {
            fetch('classes/file_action.php', {
                method: 'POST',
                body: form
            }).then(response => response.text())
              .then(data => {
                  alert(data);
                  location.reload();
              });
        }
    });
});

</script>