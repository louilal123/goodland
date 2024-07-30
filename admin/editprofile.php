<?php include "classes/admindetails.php"; ?>
<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php"; ?>
<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary">
<style>
    body{overflow: hidden;}
    .modal-label { width: 150px; }
</style>
<div class="app-wrapper">
    <?php include "includes/sidebar.php"; ?>
    <div class="app-main-wrapper">
        <?php include "includes/topnav.php"; ?>
        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Home / Profile Information </h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Profile</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-content flat">
                <div class="container-fluid">
                    <div class="row " style="min-height: 80vh;">
                        <div class="col-md-12 d-flex ms-auto">
                            <div class="card mb-4 card-outline-primary">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h3 class="card-title mb-0">Profile Information</h3>
                                    <div>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</button>
                                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change Password</button>
                                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editPhotoModal">Edit Profile Picture</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="container-fluid">
                                                <div class="row mb-3">
                                                    <div class="col text-center">
                                                        <img src="<?php echo $adminDetails['admin_photo'] ?? 'uploads/default-photo.jpg'; ?>" 
                                                        class="img-fluid rounded-circle mb-3" alt="Admin Photo" style="width: 150px;">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label for="fullname" class="form-label">Full Name</label>
                                                        <input type="text" class="form-control" id="fullname" 
                                                        value="<?php echo $adminDetails['fullname']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label for="username" class="form-label">Username</label>
                                                        <input type="text" class="form-control" id="username" 
                                                        value="<?php echo $adminDetails['username']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="text" class="form-control" id="email" 
                                                        value="<?php echo $adminDetails['email']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label for="role" class="form-label">Role</label>
                                                        <input type="text" class="form-control" id="email" 
                                                        value="<?php echo $adminDetails['role']; ?>" readonly>
                                                       <h5></h5>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label for="date_created" class="form-label">Date Created</label>
                                                        <input type="text" class="form-control" id="email" 
                                                        value="<?php echo $adminDetails['date_created']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label for="date_updated" class="form-label">Date Updated</label>
                                                        <input type="text" class="form-control" id="email" 
                                                        value="<?php echo $adminDetails['date_updated']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label for="last_signedin" class="form-label">Last Signed In</label>
                                                        <input type="text" class="form-control" id="email" 
                                                        value="<?php echo $adminDetails['last_signedin']; ?>" readonly>
                                                    </div>
                                                </div>
                                                
                                    </div>
                                </div>
                            </div> <!-- /.card -->
                        </div> 
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editProfileModalLabel">Edit Profile Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3 d-flex align-items-center">
            <label for="modalFullname" class="form-label modal-label">Full Name</label>
            <input type="text" class="form-control" id="modalFullname" value="<?php echo $adminDetails['fullname']; ?>">
          </div>
          <div class="mb-3 d-flex align-items-center">
            <label for="modalUsername" class="form-label modal-label">Username</label>
            <input type="text" class="form-control" id="modalUsername" value="<?php echo $adminDetails['username']; ?>">
          </div>
          <div class="mb-3 d-flex align-items-center">
            <label for="modalEmail" class="form-label modal-label">Email</label>
            <input type="email" class="form-control" id="modalEmail" value="<?php echo $adminDetails['email']; ?>">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

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
          <div class="mb-3 d-flex align-items-center">
            <label for="currentPassword" class="form-label modal-label">Current Password</label>
            <input type="password" class="form-control" id="currentPassword">
          </div>
          <div class="mb-3 d-flex align-items-center">
            <label for="newPassword" class="form-label modal-label">New Password</label>
            <input type="password" class="form-control" id="newPassword">
          </div>
          <div class="mb-3 d-flex align-items-center">
            <label for="confirmPassword" class="form-label modal-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirmPassword">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Change Password</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Profile Picture Modal -->
<div class="modal fade" id="editPhotoModal" tabindex="-1" aria-labelledby="editPhotoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editPhotoModalLabel">Edit Profile Picture</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3 d-flex align-items-center">
            <label for="profilePhoto" class="form-label modal-label">Profile Photo</label>
            <input type="file" class="form-control" id="profilePhoto">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<?php include "includes/footer.php"; ?>
</body>
</html>
