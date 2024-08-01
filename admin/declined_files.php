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
        <div class="app-main-wrapper"> 
           <?php include "includes/topnav.php"; ?>
            <main class="app-main">
            <div class="app-content-header"> 
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Manage Declined Files</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Declined Files</li>
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
                                    <h3 class="card-title mb-0">List of Declined Files</h3>
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
                                                    <th width="240px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($declined_files as $file): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($file['id']); ?></td>
                                                    <td><?php echo htmlspecialchars($file['title']); ?></td>
                                                    <td><?php echo htmlspecialchars($file['description']); ?></td>
                                                    <td><?php echo htmlspecialchars($file['file_path']); ?></td>
                                                    <td><?php echo htmlspecialchars($file['file_type']); ?></td>
                                                    <td><?php echo htmlspecialchars($file['fullname']); ?></td>
                                                    <td><?php echo date("M d, Y h:i A", strtotime($file['upload_date'])); ?></td>
                                                    <td>
                                                        <a href="../uploads/<?php echo htmlspecialchars($file['file_path']); ?>" class="btn btn-info btn-sm viewBtn ml-1" name="viewPdf">
                                                            <i class="bi bi-search"></i> View
                                                        </a>
                                                        <button class="btn btn-warning btn-sm addToPendingBtn ml-1"
                                                            data-id="<?php echo htmlspecialchars($file['id']); ?>"
                                                            data-title="<?php echo htmlspecialchars($file['title']); ?>"
                                                            data-description="<?php echo htmlspecialchars($file['description']); ?>"
                                                            data-filepath="<?php echo htmlspecialchars($file['file_path']); ?>"
                                                            data-filetype="<?php echo htmlspecialchars($file['file_type']); ?>"
                                                            data-uploaded_by="<?php echo htmlspecialchars($file['fullname']); ?>"
                                                            data-upload_date="<?php echo htmlspecialchars($file['upload_date']); ?>"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#addToPendingModal">
                                                            <i class="bi bi-arrow-clockwise"></i> Add to Pending
                                                        </button>
                                                        <button class="btn btn-warning btn-sm declineBtn ml-1"
                                                            data-id="<?php echo htmlspecialchars($file['id']); ?>"
                                                            data-title="<?php echo htmlspecialchars($file['title']); ?>"
                                                            data-description="<?php echo htmlspecialchars($file['description']); ?>"
                                                            data-filepath="<?php echo htmlspecialchars($file['file_path']); ?>"
                                                            data-filetype="<?php echo htmlspecialchars($file['file_type']); ?>"
                                                            data-uploaded_by="<?php echo htmlspecialchars($file['fullname']); ?>"
                                                            data-upload_date="<?php echo htmlspecialchars($file['upload_date']); ?>"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#declineModal">
                                                            <i class="bi bi-recycle"></i> Recycle
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
<!-- Add to Pending Modal -->
<div class="modal fade" id="addToPendingModal" tabindex="-1" aria-labelledby="addToPendingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addToPendingModalLabel">Add to Pending</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <embed src="" id="pendingFilePathEmbed" type="application/pdf" class="custom-card-img mb-1" style="display: flex; flex-direction: column; margin: auto; overflow: hidden !important; width: 50% !important; height: 360px;">
                <p><strong>Title:</strong> <span id="pendingFileTitle"></span></p>
                <p><strong>Description:</strong> <span id="pendingFileDescription"></span></p>
                <p><strong>File Path:</strong> <span id="pendingFilePath"></span></p>
                <p><strong>File Type:</strong> <span id="pendingFileType"></span></p>
                <p><strong>Uploaded By:</strong> <span id="pendingUploadedBy"></span></p>
                <p><strong>Upload Date:</strong> <span id="pendingUploadDate"></span></p>
                <form method="POST" action="classes/file_action.php">
                    <input type="hidden" name="file_id" id="pendingFileId">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="moveToPendingBtn">Add to Pending</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="recycleFileBtn">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>
<script>
    $(document).ready(function() {
        $('.addToPendingBtn').on('click', function() {
            var fileId = $(this).data('id');
            var fileTitle = $(this).data('title');
            var fileDescription = $(this).data('description');
            var filePath = $(this).data('filepath');
            var fileType = $(this).data('filetype');
            var uploadedBy = $(this).data('uploaded_by');
            var uploadDate = $(this).data('upload_date');
            
            $('#pendingFileId').val(fileId);
            $('#pendingFileTitle').text(fileTitle);
            $('#pendingFileDescription').text(fileDescription);
            $('#pendingFilePath').text(filePath);
            $('#pendingFilePathEmbed').attr('src', '../uploads/' + filePath);
            $('#pendingFileType').text(fileType);
            $('#pendingUploadedBy').text(uploadedBy);
            $('#pendingUploadDate').text(uploadDate);
        });
        
        $('.declineBtn').on('click', function() {
            var fileId = $(this).data('id');
            var fileTitle = $(this).data('title');
            var fileDescription = $(this).data('description');
            var filePath = $(this).data('filepath');
            var fileType = $(this).data('filetype');
            var uploadedBy = $(this).data('uploaded_by');
            var uploadDate = $(this).data('upload_date');
            
            $('#declineFileId').val(fileId);
            $('#declineFileTitle').text(fileTitle);
            $('#declineFileDescription').text(fileDescription);
            $('#declineFilePath').text(filePath);
            $('#declineFilePathEmbed').attr('src', '../uploads/' + filePath);
            $('#declineFileType').text(fileType);
            $('#declineUploadedBy').text(uploadedBy);
            $('#declineUploadDate').text(uploadDate);
        });
    });
</script>
</body>
</html>
