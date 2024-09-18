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
          

                <div class="row">

                    <div class="col-md-3">
                    <div class="card  " style="padding-top: 20px; padding-bottom: 0px;">
                    <img src="uploads/<?= htmlspecialchars($_SESSION['user_photo']  ?? 'uploads/25-Picture.png'); ?>" class="img-fluid rounded"
                        style="display: flex; margin: auto; height: 180px; width: 180px;  
                        border: 4px solid #f0f0f0; border-radius: 230px !important;" id="profileImage" />
                    <a href="#" class="btn btn-secondary mt-4 mb-0" data-bs-toggle="modal" data-bs-target="#editProfilePhotoModal">
                        <i class="bi bi-camera"></i> Edit Profile Picture
                    </a>
                </div>
                <?//php  var_dump($_SESSION);?> <!-- End of user photo card -->

                        <div class="card mt-3 profile-work  ">
                            <div class="card-body sidenavv">
                                <p>About Me</p>
                                 <form action="classes/update_bio.php" method="post">
                                <textarea class="form-control" name="bio" id="textAreaExample3" rows="3"><?= $_SESSION['user_bio'] ?? ''; ?></textarea>
                              
                                <button type="submit" class="btn btn-success mt-2 mb-3 float-end">Update Bio</button>
                                </form><br/><br/>
                                <p>Settings</p>
                                <a href="#" class="btn-link text-info" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change Password</a><br/>
                                <a href="classes/logout.php">Logout</a><br/><br/>
                                <p>Account</p>
                                <a href="classes/logout.php">Delete Account</a><br/>
                            </div> 
                        </div> 
                    </div> <!-- End of col-md-4 -->

                    <div class="col-md-9 mb-5">
                        <div class="card  " style="height: auto;">
                            <div class="card-body">
                                <h4>Dashboard</h4>
                                <div class="row mt-4">
                                    <div class="col-md-3">
                                        <div class="card text-center text-white bg-primary bg-opacity-75">
                                            <div class="card-body">
                                                <h3 class="text-white" class="text-white"><?php echo $fileCounts['user_total'] ?? '0'; ?></h4>
                                                <p class="card-text text-white"><i class="bi bi-upload"></i> Total Uploads</p>
                                            </div> 
                                        </div> 
                                    </div> 

                                    <div class="col-md-3">
                                        <div class="card text-center text-white bg-success bg-opacity-75">
                                            <div class="card-body">
                                                <h3 class="text-white"><?php echo $fileCounts['user_approved'] ?? '0'; ?></h4>
                                                <p class="card-text"><i class="bi bi-check-circle-fill"></i> Approved Files</p>
                                                	<!-- bi-check-circle-fill <i class="bi bi-hourglass-split -->
                                            </div> 
                                        </div> 
                                    </div> 

                                    <div class="col-md-3">
                                        <div class="card text-center text-white bg-warning bg-opacity-75">
                                            <div class="card-body ">
                                                <h3 class="text-white"><?php echo $fileCounts['user_pending'] ?? '0'; ?></h4>
                                                <p class="card-text "><i class="bi bi-hourglass-split"></i> Pending Files</p>
                                            </div> 
                                        </div> 
                                    </div> 

                                    <div class="col-md-3">
                                        <div class="card text-center text-white bg-danger bg-opacity-75">
                                            <div class="card-body">
                                                <h3 class="text-white"><?php echo $fileCounts['user_declined'] ?? '0'; ?></h4>
                                                <p class="card-text mt-1"><i class="bi bi-x-circle-fill"></i> Declined Files</p>
                                            </div> 
                                        </div> 
                                    </div> 
                                </div> <!-- End of row mt-4 -->
                            </div> 
                        </div> 

                        <div class="card mb-5 mt-3  ">
                            <div class="card-body mb-5 mt-3">
                                <!-- Tabs navs -->
                                    <ul class="nav nav-tabs mb-3" id="ex-with-icons" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a data-mdb-tab-init class="nav-link active" id="ex-with-icons-tab-1" href="#ex-with-icons-tabs-1" role="tab"
                                        aria-controls="ex-with-icons-tabs-1" aria-selected="true"><i class="bi bi-info-circle-fill"></i>  Personal Information</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a data-mdb-tab-init class="nav-link" id="ex-with-icons-tab-2" href="#ex-with-icons-tabs-2" role="tab"
                                        aria-controls="ex-with-icons-tabs-2" aria-selected="false"><i class="bi bi-folder-fill fa-fw me-2"></i>Documents</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a data-mdb-tab-init class="nav-link" id="ex-with-icons-tab-3" href="#ex-with-icons-tabs-3" role="tab"
                                        aria-controls="ex-with-icons-tabs-3" aria-selected="false"><i class="bi bi-image-fill"></i> Images</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a data-mdb-tab-init class="nav-link" id="ex-with-icons-tab-4" href="#ex-with-icons-tabs-4" role="tab"
                                        aria-controls="ex-with-icons-tabs-4" aria-selected="false"><i class="bi bi-map-fill fa-fw me-2"></i>Maps</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a data-mdb-tab-init class="nav-link" id="ex-with-icons-tab-5" href="#ex-with-icons-tabs-5" role="tab"
                                        aria-controls="ex-with-icons-tabs-5" aria-selected="false"><i class="bi bi-palette2 fa-fw me-2"></i> Arts</a>
                                    </li>
                                    </ul>
                                    <!-- Tabs navs -->
                                <div class="tab-content" id="ex-with-icons-content">
                                    <div class="tab-pane fade" id="ex-with-icons-tabs-2" role="tabpanel" aria-labelledby="ex-with-icons-tab-2">
                                        <h3>Documents</h3>
                                        <div class="search-bar mb-4">
                                            <div class="input-group">
                                                <input type="text" class="form-control search w-50" placeholder="Search materials..." id="documentsSearch">
                                                <div class="input-group-append ">
                                                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                                                </div>
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
                                                <div class="col-md-3 mt-2 document-item">
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
                                        <div class="search-bar mb-4">
                                            <div class="input-group">
                                                <input type="text" class="form-control search w-50" placeholder="Search materials..." id="imagesSearch">
                                                <div class="input-group-append ">
                                                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                                                </div>
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
                                                <div class="col-md-3 mt-2 document-item">
                                                    <div class="card mb-4 shadow-sm custom-card">
                                                        <img src="uploads/<?= htmlspecialchars($file['file_path']); ?>#toolbar=0&navpanes=0"
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
                                        <div class="search-bar mb-4">
                                            <div class="input-group">
                                                <input type="text" class="form-control search w-50" placeholder="Search materials..." id="mapsSearch">
                                                <div class="input-group-append ">
                                                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                                                </div>
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
                                                <div class="col-md-3 mt-2 document-item">
                                                    <div class="card mb-4 shadow-sm custom-card">
                                                        <img src="uploads/<?= htmlspecialchars($file['file_path']); ?>"
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
                                        <h3>Arts</h3>
                                        <div class="search-bar mb-4">
                                            <div class="input-group">
                                                <input type="text" class="form-control search w-50" placeholder="Search materials..." id="artsSearch">
                                                <div class="input-group-append ">
                                                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" id="documentsContainer">
                                            <?php foreach ($arts as $file): ?>
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
                                                <div class="col-md-3 mt-2 document-item">
                                                    <div class="card mb-4 shadow-sm custom-card">
                                                        <img src="uploads/<?= htmlspecialchars($file['file_path']); ?>"
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

                                    <div class="tab-pane fade show active" id="ex-with-icons-tabs-1" role="tabpanel" aria-labelledby="ex-with-icons-tab-1">
                                 
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="fullname" class="form-control" value="<?= $_SESSION['user_fullname']; ?>" readonly>
                                            </div>
                                        </div> 

                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <label>Username</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="username" class="form-control" value="<?= $_SESSION['user_username'] ?? ''; ?>" readonly>
                                            </div>
                                        </div> 

                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="email" name="email" class="form-control" value="<?= $_SESSION['user_email']; ?>" readonly>
                                            </div>
                                        </div> 

                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <label>Address</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="address" class="form-control" value="<?= $_SESSION['user_address'] ?? ''; ?>" readonly>
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <label>Birthday</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="date" name="birthday" class="form-control" value="<?= $_SESSION['user_birthday'] ?? ''; ?>" readonly>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#updateProfileModal">Update</button>
                                            </div>
                                        </div>
                                      
                                    </div>
                                </div>
                            </div> 
                        </div> <!-- End of card mb-5 mt-3 -->
                        
                    </div>
                    
                </div> 
                
        </div> <!-- End emp-profile-->

        <!-- modals  -->
<!-- Profile Update Modal -->
<div class="modal fade" id="updateProfileModal" tabindex="-1" aria-labelledby="updateProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateProfileModalLabel">Update Profile Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="classes/update_profile.php" method="post">
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label for="fullname">Full Name</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" value="<?= $_SESSION['user_fullname'] ?? ''; ?>" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= $_SESSION['user_username'] ?? ''; ?>" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= $_SESSION['user_email'] ?? ''; ?>" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?= $_SESSION['user_address'] ?? ''; ?>">
                    </div>
                    <div class="form-group mb-2">
                        <label for="birthday">Birthday</label>
                        <input type="date" class="form-control" id="birthday" name="birthday" value="<?= $_SESSION['user_birthday'] ?? ''; ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


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
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="classes/change_password.php" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="currentPassword">Current Password</label>
                        <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                    </div>
                    <div class="form-group">
                        <label for="newPassword">New Password</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="change_password">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Profile Photo Modal -->
<div class="modal fade" id="editProfilePhotoModal" tabindex="-1" aria-labelledby="editProfilePhotoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfilePhotoModalLabel">Edit Profile Picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="classes/update_profile_photo.php" method="post" enctype="multipart/form-data">
                <div class="modal-body text-center">
                    <img src="<?= $_SESSION['user_photo'] ?? 'uploads/try.png' ?>" class="img-fluid rounded mb-3"
                        style="display: flex; margin: auto; height: 180px; width: 180px;  
                        border: 4px solid #f0f0f0; border-radius: 230px !important;" id="modalProfileImage" />
                    <input type="file" id="fileInput" name="profile_photo" accept="image/*" style="display: block; margin: auto;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

    </main> 

    <?php include "includes/footer.php"; ?>
    <script>
document.getElementById('fileInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('modalProfileImage').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});
</script>

    
    <script>
document.getElementById('artsSearch').addEventListener('input', function() {
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

    <script>
document.getElementById('mapsSearch').addEventListener('input', function() {
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

    <script>
document.getElementById('imagesSearch').addEventListener('input', function() {
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

    <script>
document.getElementById('documentsSearch').addEventListener('input', function() {
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
