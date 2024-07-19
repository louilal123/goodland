<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php"; ?>
<link rel="stylesheet" href="assets/css/profile.css">
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
            overflow: hidden; /* Prevents overflow */
        }

        .custom-card-body {
            display: flex;
            flex-direction: column;
            flex-grow: 1; /* Allows the card body to take up available space */
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

        .custom-card-text {
            margin-bottom: 0.5rem; /* Adds space between text elements */
        }

        .custom-card-footer {
            margin-top: auto; /* Pushes the footer to the bottom */
        }

</style>
<body class="index-page">
<?php 
include "includes/topnav.php"; 
include "classes/user_view.php";

if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header('Location: error/index.php');
    exit();
}

$userId = $_SESSION['user_id'];

$fileCounts = $mainClass->count_user_files($userId);

$userTotal = $fileCounts['user_total'] ?? 0;
$userPending = $fileCounts['user_pending'] ?? 0;
$userApproved = $fileCounts['user_approved'] ?? 0;
$userDeclined = $fileCounts['user_declined'] ?? 0;

// DOCUMENTS FETCH AND FILTER
$statusFilter = isset($_GET['status']) ? $_GET['status'] : 'All';
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$documents = $mainClass->get_user_documents($userId, 'Documents', $statusFilter, $searchTerm);
$arts = $mainClass->get_user_arts($userId, 'Arts', $statusFilter, $searchTerm);
$maps = $mainClass->get_user_documents($userId, 'Maps', $statusFilter, $searchTerm);
$images = $mainClass->get_user_documents($userId, 'Images', $statusFilter, $searchTerm);
// DOCUMENTS END
// DOCUMENTS END

?>

    <main class="main container mb-5" style="margin-top: 150px !important;">

        <div class="container emp-profile mb-5 mt-5">
            <form method="post">

                <div class="row">
                    <div class="col-md-3">
                        <div class="card" style="padding-top: 20px; padding-bottom: 20px;">
                            <img src="<?= $_SESSION['user_photo'] ?? 'uploads/try.png' ?>" class="img-fluid rounded"
                                style="display: flex; margin: auto; height: 180px; width: 180px;  
                                border: 4px solid #f0f0f0; border-radius: 230px !important;" />
                            <a href="" class="btn-secondary"></a>
                        </div> <!-- End of user photo card -->

                        <div class="card mt-3 profile-work">
                            <div class="card-body sidenavv">
                                <p>About Me</p>
                                <textarea class="form-control" id="textAreaExample3" rows="3"><?= $_SESSION['user_bio'] ?? ''; ?></textarea>
                                <button type="submit" class="btn btn-success mt-2 mb-3 float-end">Update Bio</button>
                                <br/><br/>
                                <p>Settings</p>
                                <a href="#" data-toggle="modal" data-target="#changePasswordModal">Change Password</a><br/>
                                <a href="classes/logout.php">Logout</a><br/><br/>
                                <p>Account</p>
                                <a href="classes/logout.php">Delete Account</a><br/>
                            </div> <!-- End of card-body sidenavv -->
                        </div> <!-- End of profile-work card -->
                    </div> <!-- End of col-md-4 -->

                    <div class="col-md-9 mb-5">
                        <div class="card" style="height: auto;">
                            <div class="card-body">
                                <h4>Dashboard</h4>
                                <div class="row mt-4">
                                    <div class="col-md-3">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <h4><?php echo $fileCounts['user_total'] ?? '0'; ?></h4>
                                                <p class="card-text">Total Uploads</p>
                                            </div> <!-- End of card-body -->
                                        </div> <!-- End of card -->
                                    </div> <!-- End of col-md-3 -->

                                    <div class="col-md-3">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <h4><?php echo $fileCounts['user_approved'] ?? '0'; ?></h4>
                                                <p class="card-text">Approved</p>
                                            </div> <!-- End of card-body -->
                                        </div> <!-- End of card -->
                                    </div> <!-- End of col-md-3 -->

                                    <div class="col-md-3">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <h4><?php echo $fileCounts['user_pending'] ?? '0'; ?></h4>
                                                <p class="card-text">Pending</p>
                                            </div> <!-- End of card-body -->
                                        </div> <!-- End of card -->
                                    </div> <!-- End of col-md-3 -->

                                    <div class="col-md-3">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <h4><?php echo $fileCounts['user_declined'] ?? '0'; ?></h4>
                                                <p class="card-text mt-1">Declined</p>
                                            </div> <!-- End of card-body -->
                                        </div> <!-- End of card -->
                                    </div> <!-- End of col-md-3 -->
                                </div> <!-- End of row mt-4 -->
                            </div> <!-- End of card-body -->
                        </div> <!-- End of card -->

                        <div class="card mb-5 mt-3">
                            <div class="card-body mb-5 mt-3">
                                <!-- Tabs navs -->
                                    <ul class="nav nav-tabs mb-3" id="ex-with-icons" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a data-mdb-tab-init class="nav-link active" id="ex-with-icons-tab-1" href="#ex-with-icons-tabs-1" role="tab"
                                        aria-controls="ex-with-icons-tabs-1" aria-selected="true"></i>Personal Information</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a data-mdb-tab-init class="nav-link" id="ex-with-icons-tab-2" href="#ex-with-icons-tabs-2" role="tab"
                                        aria-controls="ex-with-icons-tabs-2" aria-selected="false"><i class="bi bi-chart-line fa-fw me-2"></a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a data-mdb-tab-init class="nav-link" id="ex-with-icons-tab-3" href="#ex-with-icons-tabs-3" role="tab"
                                        aria-controls="ex-with-icons-tabs-3" aria-selected="false"><i class="fas fa-camera-retro"></i>Images</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a data-mdb-tab-init class="nav-link" id="ex-with-icons-tab-4" href="#ex-with-icons-tabs-4" role="tab"
                                        aria-controls="ex-with-icons-tabs-4" aria-selected="false"><i class="bi bi-cogs fa-fw me-2"></i>Maps</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a data-mdb-tab-init class="nav-link" id="ex-with-icons-tab-5" href="#ex-with-icons-tabs-5" role="tab"
                                        aria-controls="ex-with-icons-tabs-5" aria-selected="false"><i class="bi bi-cogs fa-fw me-2"></i>Arts</a>
                                    </li>
                                    </ul>
                                    <!-- Tabs navs -->
<!-- Tabs content -->
<div class="tab-content" id="ex-with-icons-content">
    <div class="tab-pane fade" id="ex-with-icons-tabs-2" role="tabpanel" aria-labelledby="ex-with-icons-tab-2">
        <h3>Documents</h3>

        <!-- Search Bar and Filter Dropdown -->
        <div class="mb-4 d-flex align-items-center">
            <input type="text" id="documentSearch" class="form-control me-2" placeholder="Search..." onkeyup="searchDocuments()" value="<?= htmlspecialchars($searchTerm); ?>">
            <div class="btn-group">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-filter"></i> Filter
                </button>
                <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                    <li><a class="dropdown-item" href="#" onclick="filterDocuments('All')">All</a></li>
                    <li><a class="dropdown-item" href="#" onclick="filterDocuments('Pending')">Pending</a></li>
                    <li><a class="dropdown-item" href="#" onclick="filterDocuments('Approved')">Approved</a></li>
                    <li><a class="dropdown-item" href="#" onclick="filterDocuments('Declined')">Declined</a></li>
                </ul>
            </div>
        </div>

        <div class="row" id="documentsContainer">
            <?php foreach ($documents as $file): ?>
                <?php 
                $statusClass = '';
                if ($file['status'] == 'Pending') {
                    $statusClass = 'badge bg-warning text-light';
                } elseif ($file['status'] == 'Declined') {
                    $statusClass = 'badge bg-danger text-light';
                } elseif ($file['status'] == 'Approved') {
                    $statusClass = 'badge bg-success text-light';
                }
                ?>
                <div class="col-md-3 mt-2">
                    <div class="card mb-4 shadow-sm custom-card">
                        <embed src="uploads/<?= htmlspecialchars($file['file_path']); ?>#toolbar=0&navpanes=0"
                            type="application/pdf" class="custom-card-img" style="overflow:hidden !important;">
                        <div class="custom-card-body" style="margin-left: 20px !important; margin-right: 35px !important;">
                            <h6 class="custom-card-title fw-bold"><?= htmlspecialchars($file['title']); ?></h6>
                            <p class="custom-card-text"><small class="text-muted">Upload Date: <?= htmlspecialchars($file['upload_date']); ?></small></p>
                            <p class="custom-card-text"><small class="text-muted">Status: </small><small class="text-light <?= $statusClass; ?>"><?= htmlspecialchars($file['status']); ?></small></p>
                            <div class="d-flex justify-content-between">
                                <a href="uploads/<?= htmlspecialchars($file['file_path']); ?>" class="btn-link" download="<?= htmlspecialchars($file['title']); ?>">
                                    <small class="text-primary"><i class="bi bi-arrow-down"></i> Download</small>
                                </a>
                                <a type="submit" class="btn-link" 
                                data-bs-toggle="modal" 
                                data-bs-target="#fileModal"
                                data-title="<?= htmlspecialchars($file['title']); ?>"
                                data-description="<?= htmlspecialchars($file['description']); ?>"
                                data-filetype="<?= htmlspecialchars($file['file_type']); ?>"
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

                                    <div class="tab-pane fade" id="ex-with-icons-tabs-3" role="tabpanel" aria-labelledby="ex-with-icons-tab-3">
                                    <h3>Images</h3>

<!-- Search Bar and Filter Dropdown -->
<div class="mb-4 d-flex align-items-center">
    <input type="text" id="documentSearch" class="form-control me-2" placeholder="Search..." onkeyup="searchDocuments()" value="<?= htmlspecialchars($searchTerm); ?>">
    <div class="btn-group">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-filter"></i> Filter
        </button>
        <ul class="dropdown-menu" aria-labelledby="filterDropdown">
            <li><a class="dropdown-item" href="#" onclick="filterDocuments('All')">All</a></li>
            <li><a class="dropdown-item" href="#" onclick="filterDocuments('Pending')">Pending</a></li>
            <li><a class="dropdown-item" href="#" onclick="filterDocuments('Approved')">Approved</a></li>
            <li><a class="dropdown-item" href="#" onclick="filterDocuments('Declined')">Declined</a></li>
        </ul>
    </div>
</div>

<div class="row" id="documentsContainer">
    <?php foreach ($images as $file): ?>
        <?php 
        $statusClass = '';
        if ($file['status'] == 'Pending') {
            $statusClass = 'badge bg-warning text-light';
        } elseif ($file['status'] == 'Declined') {
            $statusClass = 'badge bg-danger text-light';
        } elseif ($file['status'] == 'Approved') {
            $statusClass = 'badge bg-success text-light';
        }
        ?>
        <div class="col-md-3 mt-2">
            <div class="card mb-4 shadow-sm custom-card">
                <embed src="uploads/<?= htmlspecialchars($file['file_path']); ?>#toolbar=0&navpanes=0"
                    type="application/pdf" class="custom-card-img" style="overflow:hidden !important;">
                <div class="custom-card-body" style="margin-left: 20px !important; margin-right: 35px !important;">
                    <h6 class="custom-card-title fw-bold"><?= htmlspecialchars($file['title']); ?></h6>
                    <p class="custom-card-text"><small class="text-muted">Upload Date: <?= htmlspecialchars($file['upload_date']); ?></small></p>
                    <p class="custom-card-text"><small class="text-muted">Status: </small><small class="text-light <?= $statusClass; ?>"><?= htmlspecialchars($file['status']); ?></small></p>
                    <div class="d-flex justify-content-between">
                        <a href="uploads/<?= htmlspecialchars($file['file_path']); ?>" class="btn-link" download="<?= htmlspecialchars($file['title']); ?>">
                            <small class="text-primary"><i class="bi bi-arrow-down"></i> Download</small>
                        </a>
                        <a type="submit" class="btn-link" 
                        data-bs-toggle="modal" 
                        data-bs-target="#fileModal"
                        data-title="<?= htmlspecialchars($file['title']); ?>"
                        data-description="<?= htmlspecialchars($file['description']); ?>"
                        data-filetype="<?= htmlspecialchars($file['file_type']); ?>"
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
                                    <div class="tab-pane fade" id="ex-with-icons-tabs-4" role="tabpanel" aria-labelledby="ex-with-icons-tab-4">
                                    <h3>Maps</h3>

<!-- Search Bar and Filter Dropdown -->
<div class="mb-4 d-flex align-items-center">
    <input type="text" id="documentSearch" class="form-control me-2" placeholder="Search..." onkeyup="searchDocuments()" value="<?= htmlspecialchars($searchTerm); ?>">
    <div class="btn-group">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-filter"></i> Filter
        </button>
        <ul class="dropdown-menu" aria-labelledby="filterDropdown">
            <li><a class="dropdown-item" href="#" onclick="filterDocuments('All')">All</a></li>
            <li><a class="dropdown-item" href="#" onclick="filterDocuments('Pending')">Pending</a></li>
            <li><a class="dropdown-item" href="#" onclick="filterDocuments('Approved')">Approved</a></li>
            <li><a class="dropdown-item" href="#" onclick="filterDocuments('Declined')">Declined</a></li>
        </ul>
    </div>
</div>

<div class="row" id="documentsContainer">
    <?php foreach ($maps as $file): ?>
        <?php 
        $statusClass = '';
        if ($file['status'] == 'Pending') {
            $statusClass = 'badge bg-warning text-light';
        } elseif ($file['status'] == 'Declined') {
            $statusClass = 'badge bg-danger text-light';
        } elseif ($file['status'] == 'Approved') {
            $statusClass = 'badge bg-success text-light';
        }
        ?>
        <div class="col-md-3 mt-2">
            <div class="card mb-4 shadow-sm custom-card">
                <embed src="uploads/<?= htmlspecialchars($file['file_path']); ?>#toolbar=0&navpanes=0"
                    type="application/pdf" class="custom-card-img" style="overflow:hidden !important;">
                <div class="custom-card-body" style="margin-left: 20px !important; margin-right: 35px !important;">
                    <h6 class="custom-card-title fw-bold"><?= htmlspecialchars($file['title']); ?></h6>
                    <p class="custom-card-text"><small class="text-muted">Upload Date: <?= htmlspecialchars($file['upload_date']); ?></small></p>
                    <p class="custom-card-text"><small class="text-muted">Status: </small><small class="text-light <?= $statusClass; ?>"><?= htmlspecialchars($file['status']); ?></small></p>
                    <div class="d-flex justify-content-between">
                        <a href="uploads/<?= htmlspecialchars($file['file_path']); ?>" class="btn-link" download="<?= htmlspecialchars($file['title']); ?>">
                            <small class="text-primary"><i class="bi bi-arrow-down"></i> Download</small>
                        </a>
                        <a type="submit" class="btn-link" 
                        data-bs-toggle="modal" 
                        data-bs-target="#fileModal"
                        data-title="<?= htmlspecialchars($file['title']); ?>"
                        data-description="<?= htmlspecialchars($file['description']); ?>"
                        data-filetype="<?= htmlspecialchars($file['file_type']); ?>"
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
                                    <div class="tab-pane fade" id="ex-with-icons-tabs-5" role="tabpanel" aria-labelledby="ex-with-icons-tab-5">
                                        Tab 5 content
                                    </div>
                                    <div class="tab-pane fade show active" id="ex-with-icons-tabs-1" role="tabpanel" aria-labelledby="ex-with-icons-tab-1">
                                    <div class="row mb-2">
                                            <div class="col-md-6">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" value="<?= $_SESSION['user_fullname']; ?>" readonly>
                                            </div>
                                        </div> 

                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <label>Username</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" value="<?= $_SESSION['user_username'] ?? ''; ?>" readonly>
                                            </div>
                                        </div> 

                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="email" class="form-control" value="<?= $_SESSION['user_email']; ?>" readonly>
                                            </div>
                                        </div> 

                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <label>Phone</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" value="<?= $_SESSION['user_phone'] ?? ''; ?>" readonly>
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <label>Address</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" value="<?= $_SESSION['user_address'] ?? ''; ?>" readonly>
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <label>Birthday</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="date" class="form-control" value="<?= $_SESSION['user_birthday'] ?? ''; ?>" readonly>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <a href="#" class="btn btn-primary float-end" data-mdb-ripple-init>Update</a>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    </div>
                                  

                            </div> <!-- End of card-body -->
                        </div> <!-- End of card mb-5 mt-3 -->
                        
                    </div> <!-- End of col-md-8 mb-5 -->
                    
                </div> <!-- End of row -->
                
        </div> <!-- End emp-profile-->

        <!-- modals  -->
<div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5>File Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body mt-2">
        <embed id="fileModalPreview" src="#toolbar=0&navpanes=0" type="application/pdf" class="custom-embed-pdf" style="toolbar:0;display: flex; margin: auto;height: 400px;">
        <p><strong>Title:</strong> <span class="modal-title" id="fileModalTitle"></span></p>
        <p><strong>Description:</strong> <span id="fileModalDescription"></span></p>
        <p><strong>File Type:</strong> <span id="fileModalType"></span></p>
        <p><strong>Status:</strong> <span id="fileModalStatus"></span></p>
        <p><strong>Date Uploaded:</strong> <span id="fileModalDate"></span></p>
        <p><strong>Remarks:</strong></p>
        <textarea id="fileModalRemarks" rows="3" class="form-control" readonly></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



    </main> <!-- End of main container mb-5 mt-5 -->

    <?php include "includes/footer.php"; ?>
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
            const remarks = button.getAttribute('data-remarks');
            const path = button.getAttribute('data-path');

            const modalTitle = fileModal.querySelector('.modal-title');
            const modalPreview = fileModal.querySelector('#fileModalPreview');
            const modalDescription = fileModal.querySelector('#fileModalDescription');
            const modalType = fileModal.querySelector('#fileModalType');
            const modalStatus = fileModal.querySelector('#fileModalStatus');
            const modalDate = fileModal.querySelector('#fileModalDate');
            const modalRemarks = fileModal.querySelector('#fileModalRemarks');

            modalTitle.textContent = title;
            modalPreview.src = path;
            modalDescription.textContent = description;
            modalType.textContent = fileType;
            modalDate.textContent = date;
            modalRemarks.textContent = remarks;

            // Set status badge color
            let statusClass;
            switch (status.toLowerCase()) {
                case 'approved':
                statusClass = 'badge bg-success';
                break;
                case 'declined':
                statusClass = 'badge bg-danger';
                break;
                case 'pending':
                statusClass = 'badge bg-warning';
                break;
                default:
                statusClass = 'badge bg-secondary';
            }
            modalStatus.className = statusClass;
            modalStatus.textContent = status;
            });
        });
     </script>

</body>
</html>
