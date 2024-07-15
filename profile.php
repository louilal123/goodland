<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php"; ?>
<link rel="stylesheet" href="assets/css/profile.css">
<body class="index-page">
<?php include "includes/topnav.php"; 
include "classes/user_view.php";
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header('Location: error/index.php');
    exit();
}?>
<main class="main container mb-5">
     
    <div class="container emp-profile mb-5">
        <form method="post">
            <div class="row">
                <div class="col-md-4">
                    <div class="card" style="padding-top: 20px; padding-bottom: 20px;">
                        <img src="<?= $_SESSION['user_photo'] ?? 'uploads/try.png' ?>" class="img-fluid rounded"
                             style="display: flex; margin: auto; height: 180px; width: 180px;  
                             border: 4px solid #f0f0f0; border-radius: 230px !important;"/>
                        <a href="" class="btn-secondary"></a>
                    </div>
                    <div class="card mt-3 profile-work">
                        <div class="card-body sidenavv">
                            <p>About Me</p>
                            <textarea class="form-control" id="textAreaExample3" rows="3">
                                <?= $_SESSION['user_bio'] ?? ''; ?>
                            </textarea>
                           
                            <button type="submit" class="btn btn-success mt-2 mb-3 float-end">Update Bio</button>
                            <br/>  <br/>
                            <p>Settings</p>
                            <a href="#" data-toggle="modal" data-target="#changePasswordModal">Change Password</a><br/>
                            <a href="classes/logout.php">Logout</a><br/><br/>
                            <p>Account</p>
                            <a href="classes/logout.php">Delete Account</a><br/>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 mb-5">
                    <div class="card" style="height: auto;">
                        <div class="card-body">
                            <h4>Dashboard</h4>
                            <div class="row mt-4">
                                <div class="col-md-3">
                                    <div class="card  text-center">
                                        <div class="card-body">
                                            <h4>0</h4>
                                            <p class="card-text">Total Uploads</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <h4>0</h4>
                                            <p class="card-text">Approved</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <h4>0</h4>
                                            <p class="card-text">Pending</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <h4>0</h4>
                                            <p class="card-text mt-1">Declined</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-5 mt-3">
                        <div class="card-body">
                            <ul class="nav nav-tabs mb-5" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" 
                                    role="tab" aria-controls="profile" aria-selected="false">My Uploads</a>
                                </li>
                            </ul>
                            <div class="tab-content profile-tab" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
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
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <!-- Timeline content here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal fade" id="changePasswordModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Change Password</h4>
                </div>
                <div class="modal-body">
                    <form action="classes/change_password.php" method="post">
                        <div class="form-group">
                            <label for="currentPassword">Current Password:</label>
                            <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                        </div>
                        <div class="form-group">
                            <label for="newPassword">New Password:</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">Confirm New Password:</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="change_password">Change Password</button>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include "includes/footer.php"; ?>
<script type="text/javascript" src="mdbfolder/mdb.umd.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
