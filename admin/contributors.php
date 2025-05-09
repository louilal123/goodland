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
    .main-blur {
    background: rgba(108, 117, 125, 0.1); 
}
</style>
<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary">

    <div class="app-wrapper">

       <?php include "includes/sidebar.php" ?>
        <div class="app-main-wrapper main-blur"> 
           <?php 
            include "includes/topnav.php"; ?>
            <main class="app-main">
            <div class="app-content-header"> 
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Manage Pending Files</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                Pending Files
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
                                        <h3 class="card-title mb-0">List of Recycled Files</h3>
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
                            <th width="120px">File Type</th>
                            <th width="140px">Uploaded By</th>
                            <th width="150px">Upload Date</th>
                            <th width="320px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php foreach ($pending_files as $file): ?>
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
        <button class="btn btn-success btn-sm approveBtn ml-1"
            data-id="<?php echo htmlspecialchars($file['id']); ?>"
            data-title="<?php echo htmlspecialchars($file['title']); ?>"
            data-description="<?php echo htmlspecialchars($file['description']); ?>"
            data-filepath="<?php echo htmlspecialchars($file['file_path']); ?>"
           
            data-uploaded_by="<?php echo htmlspecialchars($file['fullname']); ?>"
            data-upload_date="<?php echo date("M d, Y h:i A", strtotime($file['upload_date'])); ?>"
            data-bs-toggle="modal"
            data-bs-target="#approveModal">
            <i class="bi bi-check-lg"></i> Approve
        </button>
        <button class="btn btn-warning btn-sm declineBtn ml-1"
            data-id="<?php echo htmlspecialchars($file['id']); ?>"
            data-title="<?php echo htmlspecialchars($file['title']); ?>"
            data-description="<?php echo htmlspecialchars($file['description']); ?>"
            data-filepath="<?php echo htmlspecialchars($file['file_path']); ?>"
           
            data-uploaded_by="<?php echo htmlspecialchars($file['fullname']); ?>"
            data-upload_date="<?php echo date("M d, Y h:i A", strtotime($file['upload_date'])); ?>"
            data-bs-toggle="modal"
            data-bs-target="#declineModal">
            <i class="bi bi-x-lg"></i> Decline
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
  
<!-- View Modal -->
<!-- Decline Modal -->
<!-- Decline Modal -->
<div class="modal fade" id="declineModal" tabindex="-1" aria-labelledby="declineModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="declineModalLabel">Decline File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <embed src="" id="declineFilePathEmbed" type="application/pdf" class="custom-card-img mb-1" style="display: flex; flex-direction: column; margin: auto; overflow: hidden !important; width: 50% !important; height: 360px;">
                <p><strong>Title:</strong> <span id="declineFileTitle"></span></p>
                <p><strong>Description:</strong> <span id="declineFileDescription"></span></p>
                <p><strong>File Path:</strong> <span id="declineFilePath"></span></p>
                <p><strong>File Type:</strong> <span id="declineFileType"></span></p>
                <p><strong>Uploaded By:</strong> <span id="declineUploadedBy"></span></p>
                <p><strong>Upload Date:</strong> <span id="declineUploadDate"></span></p>
                <form method="POST" action="classes/file_action.php">
                    <input type="hidden" name="file_id" id="declineFileId">
                    <div class="mb-3">
                        <p><strong>Remarks:</strong></p>
                        <textarea class="form-control" id="declineRemarks" name="remarks" rows="3" required>
                            Your file does not adhere to our website upload agreement policies. If you think this is wrong, you can always reupload the file again.</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning" name="declineBtn">Decline</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- View Modal -->

<!-- Approve Modal -->
<!-- Approve Modal -->
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
