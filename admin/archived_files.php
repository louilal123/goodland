<?php
if (isset($_GET['viewPdf']) && isset($_GET['file_path'])) {
    $file_path = '../uploads/' . htmlspecialchars($_GET['file_path']);
    if (file_exists($file_path)) {
        header("Content-Type: application/pdf");
        readfile($file_path);
        exit;
    } else {
        $_SESSION['status'] = "Error fetching file";
        $_SESSION['status_icon'] = "error";
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
                            <h3 class="mb-0">Manage Archived Files</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                Archived Files
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
                                        <h3 class="card-title mb-0">List of Archived Files</h3>
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
                            <th width="150px">File Type</th>
                            <th width="150px">Uploaded By</th>
                            <th width="150px">Upload Date</th>
                            <th width="315px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php foreach ($Archived_files as $file): ?>
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
       
        <button class="btn btn-danger btn-sm declineBtn ml-1"
            data-id="<?php echo htmlspecialchars($file['id']); ?>"
            data-title="<?php echo htmlspecialchars($file['title']); ?>"
            data-description="<?php echo htmlspecialchars($file['description']); ?>"
            data-filepath="<?php echo htmlspecialchars($file['file_path']); ?>"
            data-filetype="<?php echo htmlspecialchars($file['file_type']); ?>"
            data-uploaded_by="<?php echo htmlspecialchars($file['fullname']); ?>"
            data-upload_date="<?php echo htmlspecialchars($file['upload_date']); ?>"
            data-bs-toggle="modal"
            data-bs-target="#declineModal">
            <i class="bi bi-trash-fill"></i> Delete
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
                <h5 class="modal-title" id="declineModalLabel">Delete this File?</h5>
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
                        <textarea class="form-control" id="declineRemarks" name="remarks" rows="3" required>Please provide your reason for declining this file.</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" name="deleteBtn"><i class="fas fa-trash"></i> Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- View Modal -->

<!-- Approve Modal -->



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
            document.getElementById('approveFilePathEmbed').src = `uploads/${filepath}#toolbar=0&navpanes=0`;
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
            document.getElementById('declineFilePathEmbed').src = `uploads/${filepath}#toolbar=0&navpanes=0`;
            document.getElementById('declineFileType').textContent = filetype;
            document.getElementById('declineUploadedBy').textContent = uploaded_by;
            document.getElementById('declineUploadDate').textContent = upload_date;
        });
    });
});


</script>


</html>
