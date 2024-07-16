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
                                        aria-controls="ex-with-icons-tabs-2" aria-selected="false"><i class="bi bi-chart-line fa-fw me-2"></i>
                                        Documents <span class="badge bg-info" style=" color: #fff !important;">4</span></a>
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
                    <?= htmlspecialchars($statusFilter); ?>
                </button>
                <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                    <li><a class="dropdown-item" href="#" onclick="applyFilter('All')">All</a></li>
                    <li><a class="dropdown-item" href="#" onclick="applyFilter('Pending')">Pending</a></li>
                    <li><a class="dropdown-item" href="#" onclick="applyFilter('Approved')">Approved</a></li>
                    <li><a class="dropdown-item" href="#" onclick="applyFilter('Declined')">Declined</a></li>
                </ul>
            </div>
        </div>

        <!-- Documents List -->
        <div class="row" id="documentList">
            <?php foreach ($documents as $doc): ?>
                <div class="col-md-3 mb-4">
                    <div class="card custom-card">
                        <div class="card-img-top">
                            <?php if ($doc['file_type'] === 'pdf'): ?>
                                <embed src="<?= htmlspecialchars($doc['file_path']); ?>" class="img-fluid custom-embed-pdf" />
                            <?php else: ?>
                                <img src="<?= htmlspecialchars($doc['file_path']); ?>" class="img-fluid custom-card-img" alt="Document Image" />
                            <?php endif; ?>
                        </div>
                        <div class="card-body custom-card-body">
                            <h5 class="card-title custom-card-title"><?= htmlspecialchars($doc['file_name']); ?></h5>
                            <p class="card-text custom-card-text">Uploaded on: <?= htmlspecialchars($doc['upload_date']); ?></p>
                            <p class="card-text custom-card-text">Status: <?= htmlspecialchars($doc['status']); ?></p>
                            <div class="custom-card-footer">
                                <a href="<?= htmlspecialchars($doc['file_path']); ?>" class="btn btn-primary">View</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="tab-pane fade show active" id="ex-with-icons-tabs-1" role="tabpanel" aria-labelledby="ex-with-icons-tab-1">
        <div class="row">
            <div class="col-md-6">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" value="John Doe">
            </div>
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="text" class="form-control" value="john.doe@example.com">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <label class="form-label">Phone</label>
                <input type="text" class="form-control" value="123-456-7890">
            </div>
            <div class="col-md-6">
                <label class="form-label">Address</label>
                <input type="text" class="form-control" value="123 Main St, Springfield">
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="ex-with-icons-tabs-3" role="tabpanel" aria-labelledby="ex-with-icons-tab-3">
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Image 1">
                    <div class="card-body">
                        <h5 class="card-title">Image 1</h5>
                        <p class="card-text">Description of image 1.</p>
                        <a href="#" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Image 2">
                    <div class="card-body">
                        <h5 class="card-title">Image 2</h5>
                        <p class="card-text">Description of image 2.</p>
                        <a href="#" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Image 3">
                    <div class="card-body">
                        <h5 class="card-title">Image 3</h5>
                        <p class="card-text">Description of image 3.</p>
                        <a href="#" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Image 4">
                    <div class="card-body">
                        <h5 class="card-title">Image 4</h5>
                        <p class="card-text">Description of image 4.</p>
                        <a href="#" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="ex-with-icons-tabs-4" role="tabpanel" aria-labelledby="ex-with-icons-tab-4">
        <p>Content for Maps tab.</p>
    </div>
    <div class="tab-pane fade" id="ex-with-icons-tabs-5" role="tabpanel" aria-labelledby="ex-with-icons-tab-5">
        <p>Content for Arts tab.</p>
    </div>
</div>
<!-- Tabs content -->
                            </div> <!-- End of card-body -->
                        </div> <!-- End of card -->
                    </div> <!-- End of col-md-8 -->
                </div> <!-- End of row -->
            </form> <!-- End of form -->
        </div> <!-- End of container emp-profile mb-5 mt-5 -->
    </main> <!-- End of main container mb-5 -->

    <!-- Change Password Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="currentPassword" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="currentPassword">
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newPassword">
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirmPassword">
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- End of Change Password Modal -->

    <?php include "includes/footer.php"; ?>

    <script>
        // Function to filter documents by status
        function applyFilter(status) {
            window.location.href = `?status=${status}&search=${document.getElementById('documentSearch').value}`;
        }

        // Function to search documents by name
        function searchDocuments() {
            const searchTerm = document.getElementById('documentSearch').value;
            const statusFilter = "<?= htmlspecialchars($statusFilter); ?>";
            window.location.href = `?status=${statusFilter}&search=${searchTerm}`;
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
