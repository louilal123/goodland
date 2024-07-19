<?php
include "classes/user_view.php";
?>
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


<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php"; ?>
<link rel="stylesheet" href="assets/css/style.css">
<style>
     .custom-card {
            display: flex;
            flex-direction: column;
            height: 100%; /* Ensure uniform height for all cards */
            overflow: hidden; /* Prevents content from overflowing */
        }

        .custom-card-img {
            object-fit: cover; /* Ensures the image fits within its container */
            height: 190px; /* Fixed height for uniformity */
            overflow-y: hidden; /* Prevents overflow */
        }


        .custom-card-title {
            margin-top: 15px;
           
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
          
        }

        .custom-embed-pdf {
            pointer-events: none !important;
            object-fit: cover; /* Ensures the image fits within its container */
            height: 250px !important; /* Fixed height for uniformity */
            overflow: hidden !important; /* Prevents overflow */
        }


        .custom-card-footer {
            margin-top: auto; /* Pushes the footer to the bottom */
        }
</style>
<body class="index-page">
<?php include "includes/topnav.php"; ?>

<main class="main container mt-10 mb-5" style="margin-bottom: 150px important;">
    <div class="card" style="border-radius:0px;">
        <div class="card-body" style="border-radius:0px;">
    <h1 class="text-center mt-5"><strong>BROWSE OUR ARCHIVE FILES</strong></h1>
    <h6 class="text-center mb-6">Explore the rich culture and heritage of Bantayan Island</h6>
    <div class="container-fluid mt-10">
        <div class="row justify-content-center">
           
            <div class="col-md-2 sidebar mr-5">
                <h4 class="filter-title">Browse Sections</h4>
                <ul class="list-unstyled">
                    <li><a href="library" class="d-block mb-2 text-dark">Documents</a></li>
                    <li><a href="images" class="d-block mb-2 text-dark">Images</a></li>
                    <!-- <li><a href="arts" class="d-block mb-2 active btn-link">Arts</a></li> -->
                    <li><a href="maps" class="d-block mb-2  text-dark">Maps</a></li>
                    <li><a href="audio_recordings" class="d-block mb-2 active btn-link">Audio Recordings</a></li>
                </ul>
            </div>

            <div class="col-md-10 main-content">
                <div class="search-bar mb-4">
                    <div class="input-group">
                        <input type="text" class="form-control search w-50" placeholder="Search materials..." id="mainSearch">
                        <div class="input-group-append ">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row" id="documentsContainer">
                    <?php foreach ($audio as $file): ?>
               
                    <div class="col-md-3 mt-2 document-item">
                        <div class="card mb-4 shadow-sm custom-card" style="height: 400px;">
                        <img src="uploads/<?= htmlspecialchars($file['file_path']); ?>"
                        class="custom-embed-pdf"
                                style="overflow-y:hidden !important; overflow-x: hidden !important;">

                            <div class="custom-card-body" style="margin-left: 20px !important; margin-right: 20px !important;">
                                <h6 class="custom-card-title fw-bold mt-2"><?= htmlspecialchars($file['title']); ?></h6>
                                <!-- <p class="custom-card-text"><small class="text-muted">Upload Date: <?//= htmlspecialchars($file['upload_date']); ?></small></p> -->
                                <p class="custom-card-title"><small class="text-muted"> </small><small class="text-muted">
                                    <?= htmlspecialchars($file['description']); ?></small></p>
                                    <p class="custom-card-text"><small class="text-muted"> </small><small class="text-muted">
                                    <?= htmlspecialchars($file['file_type']); ?></small></p>
                                      <p class="custom-card-text"><small class="text-muted">Added By: 
                                      <?= htmlspecialchars($file['uploader_fullname']); ?></small></p>
                                <div class="d-flex justify-content-between custom-card-footer mb-3">
                                <a href="uploads/<?= htmlspecialchars($file['file_path']); ?>" class="btn-link custom-card-footer download-btn" download="<?= htmlspecialchars($file['title']); ?>">
                                    <small class="text-primary"><i class="bi bi-arrow-down"></i> Download</small>
                                </a>

                                    <a href="#" class="btn-link custom-card-footer"
                                        data-bs-toggle="modal"
                                        data-bs-target="#fileModal"
                                        data-title="<?= htmlspecialchars($file['title']); ?>"
                                        data-description="<?= htmlspecialchars($file['description']); ?>"
                                        data-filetype="<?= htmlspecialchars($file['file_type']); ?>"
                                        data-uploadedby=  <?= htmlspecialchars($file['uploader_fullname']); ?>
                                        data-status="<?= htmlspecialchars($file['status']); ?>"
                                        data-date="<?= htmlspecialchars($file['upload_date']); ?>"
                                        data-remarks="<?= htmlspecialchars($file['remarks']); ?>"
                                        data-path="uploads/<?= htmlspecialchars($file['file_path']); ?>">
                                        <small class="text-primary"><i class="bi bi-eye"></i> View</small>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
               
            </div>
        </div>
    </div>
    </div>
    </div>

    <!-- modals  -->
<!-- Modal -->
<div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fileModalLabel">File Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" >
                <div class="embed-responsive embed-responsive-16by9">
                    <embed id="fileModalPreview" src=""class="embed-responsive-item" style="display:flex; height: 250px; width: auto; margin: auto;"></embed>
                </div>
                <p><strong>Title:</strong> <span id="fileModalTitle"></span></p>
                <p><strong>Description:</strong> <span id="fileModalDescription"></span></p>
                <p><strong>File Type:</strong> <span id="fileModalType"></span></p>
                <!-- <p><strong>Status:</strong> <span id="fileModalStatus"></span></p> -->
                <p><strong>Added By:</strong> <span id="fileModalUploadedBy"></span></p>
                <p><strong>Date Uploaded:</strong> <span id="fileModalDate"></span></p>
                <!-- <p><strong>Remarks:</strong></p> -->
                <!-- <textarea id="fileModalRemarks" rows="3" class="form-control" readonly></textarea> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="viewFileBtn">View File</button>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="downloadModal" tabindex="-1" aria-labelledby="downloadModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="downloadModalLabel">Confirm Download</h5>
      </div>
      <div class="modal-body">
        Are you sure you want to download this file?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="confirmDownloadBtn">Download</button>
      </div>
    </div>
  </div>
</div>


</main>
<?php include "includes/footer.php"; ?>
<script>
document.addEventListener('DOMContentLoaded', (event) => {
    let downloadLink = '';
    let fileId = '';
    let fileName = '';

    document.querySelectorAll('.download-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            downloadLink = this.getAttribute('href');
            fileId = this.getAttribute('data-file-id');
            fileName = this.getAttribute('download');
            let downloadModal = new bootstrap.Modal(document.getElementById('downloadModal'));
            downloadModal.show();
        });
    });

    document.getElementById('confirmDownloadBtn').addEventListener('click', function() {
        let a = document.createElement('a');
        a.href = downloadLink;
        a.download = fileName;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);

        let downloadModal = bootstrap.Modal.getInstance(document.getElementById('downloadModal'));
        downloadModal.hide();
        
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'classes/record_download.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('file_id=' + fileId);
    });
});
</script>



<script>
function filterDocuments(status) {
    const searchTerm = document.getElementById('documentSearch').value;
    window.location.href = `profile.php?status=${status}&search=${searchTerm}`;
}

function searchDocuments() {
    const status = document.querySelector('.dropdown-menu .active') ? document.querySelector('.dropdown-menu .active').innerText : 'All';
    const searchTerm = document.getElementById('documentSearch').value;
    window.location.href = `profile.php?status=${status}&search=${searchTerm}`;
}
</script>
    
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const fileModal = document.getElementById('fileModal');
        fileModal.addEventListener('show.bs.modal', (event) => {
            const button = event.relatedTarget;
            const title = button.getAttribute('data-title');
            const description = button.getAttribute('data-description');
            const fileType = button.getAttribute('data-filetype');
            const status = button.getAttribute('data-status');
            const date = button.getAttribute('data-date');
            const uploadedby = button.getAttribute('data-uploadedby');
            const remarks = button.getAttribute('data-remarks');
            const path = button.getAttribute('data-path');

            const modalTitle = fileModal.querySelector('#fileModalTitle');
            const modalPreview = fileModal.querySelector('#fileModalPreview');
            const modalDescription = fileModal.querySelector('#fileModalDescription');
            const modalType = fileModal.querySelector('#fileModalType');
            const modalStatus = fileModal.querySelector('#fileModalStatus');
            const modalUploadedBy = fileModal.querySelector('#fileModalUploadedBy');
            const modalDate = fileModal.querySelector('#fileModalDate');
            const modalRemarks = fileModal.querySelector('#fileModalRemarks');
            const viewFileBtn = fileModal.querySelector('#viewFileBtn');

            modalTitle.textContent = title;
            modalPreview.src = path;
            modalDescription.textContent = description;
            modalType.textContent = fileType;
            // modalStatus.textContent = status; // Update this line if status is available
            modalUploadedBy.textContent = uploadedby; 
            modalDate.textContent = date; // Update this line if date is available
            // modalRemarks.textContent = remarks;

            viewFileBtn.addEventListener('click', () => {
                // Redirect to view the file directly if needed
                window.location.href = path; // Replace with appropriate action
            });
        });
    });
</script>

<script>
document.getElementById('mainSearch').addEventListener('input', function() {
    let filter = this.value.toLowerCase();
    let items = document.querySelectorAll('.document-item');
    let visibleCount = 0;
    items.forEach(function(item) {
        let title = item.querySelector('.custom-card-title').textContent.toLowerCase();
        if (title.includes(filter)) {
            item.style.display = '';
            visibleCount++;
        } else {
            item.style.display = 'none';
        }
    });
    document.getElementById('entryInfo').textContent = `Showing ${visibleCount} of ${items.length} total entries`;
});
</script>
</body>
</html>