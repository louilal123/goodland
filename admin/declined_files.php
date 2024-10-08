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
<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary">

    <div class="app-wrapper">

       <?php include "includes/sidebar.php" ?>
        <div class="app-main-wrapper main-blur"> 
           <?php 
            include "includes/topnav.php"; ?>
            <main class="app-main">
            <!-- <div class="app-content-header"> 
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Manage Declined Files</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                Declined Files
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="app-content"> 
                <div class="container-fluid"> 
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="card-header d-flex ">
                                    <h3 class="fw-bold">List of Declined Files</h3>
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
                                                <th style="font-weight: bold;" width="150px">Uploaded By</th>
                                                <th style="font-weight: bold;" width="150px">Upload Date</th>
                                                <th style="font-weight: bold;" width="240px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (empty($declined_files)): ?>
                                            <tr>
                                                <td colspan="8" class="text-center">
                                                    No records to show.
                                                </td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($declined_files as $file): ?>
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
                                                    <button class="btn btn-dark btn-sm declineBtn ml-1"
                                                        data-id="<?php echo htmlspecialchars($file['id']); ?>"
                                                        data-title="<?php echo htmlspecialchars($file['title']); ?>"
                                                        data-description="<?php echo htmlspecialchars($file['description']); ?>"
                                                        data-filepath="<?php echo htmlspecialchars($file['file_path']); ?>"
                                                        data-uploaded_by="<?php echo htmlspecialchars($file['fullname']); ?>"
                                                        data-upload_date="<?php echo htmlspecialchars($file['upload_date']); ?>"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#declineModal">
                                                        <i class="bi bi-recycle"></i> Archive
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
<!-- Decline Modal -->
<div class="modal fade" id="declineModal" tabindex="-1" aria-labelledby="declineModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="declineModalLabel">Recycle File? 
                    <p class="text-muted">Note: <span class="text-danger">Recycled files will be permanently deleted after 30 days.</span></p>
                </h5>
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
                   
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" name="recycleBtn">Recycle</button>
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
