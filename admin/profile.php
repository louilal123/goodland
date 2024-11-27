<?php include "classes/admindetails.php"; ?>
<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php"; ?>
<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary">
<style>
    body{overflow: hidden;
    }</style>
<div class="app-wrapper">
    <?php include "includes/sidebar.php"; ?>
    <div class="app-main-wrappe main-blurr">
        <?php include "includes/topnav.php"; ?>
        <main class="app-main">
          
            <div class="app-content flat">
                <div class="container-fluid">
                    <div class="row" style="min-height: 80vh;">
                        <div class="col-md-12">
                            <div class="card  card-outline-primary">
                                <div class="card-header d-flex">
                                    <h2 > <span class="bi bi-info"></span>Profile Information</h2>
                                    <a data-bs-toggle="modal" data-bs-target="#editProfileModal"  class="btn btn-success ms-auto btn-end">Edit Profile</a>
                                      
                                </div>
                                <div class="card-body">
                                    <div class="container-fluid">
                                          <div class="row mb-2">
                                                    <div class="col text-center">
                                                        <img src="uploads/<?php echo $adminDetails['admin_photo'] ?? 'uploads/default-photo.jpg'; ?>" 
                                                        class="img-fluid rounded-circle mb-3" alt="Admin Photo" style="height: 150px;width: 150px;">
                                                        
                                                    </div>
                                                    <button class="btn btn-light "  data-bs-toggle="modal" data-bs-target="#editProfilePicModal"
                                                    style="position: relative; margin-top: -20px; background-color: white;"><i class="fas fa-camera" style=""></i> Edit Profile Picture</button>
                                    
                                                    
                                                    <!-- <i class="fas fa-camera" style=""></i> -->
                                                  
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <label for="fullname" class="form-label">Full Name</label>
                                                        <input type="text" class="form-control" id="fullname" 
                                                        value="<?php echo $adminDetails['fullname']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <label for="username" class="form-label">Username</label>
                                                        <input type="text" class="form-control" id="username" 
                                                        value="<?php echo $adminDetails['username']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="text" class="form-control" id="email" 
                                                        value="<?php echo $adminDetails['email']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <label for="role" class="form-label">Role</label>
                                                        <input type="text" class="form-control" id="email" 
                                                        value="<?php echo $adminDetails['role']; ?>" readonly>
                                                       <h5></h5>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <label for="date_created" class="form-label">Date Created</label>
                                                        <input type="text" class="form-control" id="email" 
                                                        value="<?php echo $adminDetails['date_created']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <label for="date_updated" class="form-label">Date Updated</label>
                                                        <input type="text" class="form-control" id="email" 
                                                        value="<?php echo $adminDetails['date_updated']; ?>" readonly>
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <div class="col">
                                                    <button class="btn btn-primary btn-end " data-bs-toggle="modal" 
                                                    data-bs-target="#changePasswordModal"> <i class="fas fa-lock"></i> Change Password</button>
                                      
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
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editProfileModalLabel">Edit Profile Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="classes/update_admin_info.php" method="post">
          <div class="mb-3">
            <label for="modalFullname" class="form-label modal-label">Full Name</label>
            <input type="text" class="form-control" id="modalFullname" name="fullname" value="<?php echo $adminDetails['fullname']; ?>">
          </div>
          <div class="mb-3">
            <label for="modalUsername" class="form-label modal-label">Username</label>
            <input type="text" class="form-control" id="modalUsername" name="username" value="<?php echo $adminDetails['username']; ?>">
          </div>
          <div class="mb-3">
            <label for="modalEmail" class="form-label modal-label">Email</label>
            <input type="email" class="form-control" id="modalEmail" name="email" value="<?php echo $adminDetails['email']; ?>">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changePasswordModalLabel"><span class="bi bi-lock"></span> Change Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="classes/update_admin_pswd.php" method="post">
          <div class="mb-3">
            <label for="currentPassword" class="form-label modal-label">Current Password</label>
            <input type="password" class="form-control" id="currentPassword" name="currentPassword">
          </div>
          <div class="mb-3">
            <label for="newPassword" class="form-label modal-label">New Password</label>
            <input type="password" class="form-control" id="newPassword" name="newPassword">
          </div>
          <div class="mb-3">
            <label for="confirmPassword" class="form-label modal-label">Confirm New Password</label>
            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit Profile Picture Modal -->
<div class="modal fade" id="editProfilePicModal" tabindex="-1" aria-labelledby="editProfilePicModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editProfilePicModalLabel">Edit Profile Picture</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="classes/update_admin_photo.php" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="profilePic" class="form-label modal-label">Profile Picture</label>
            <input type="file" class="form-control" id="profilePic" name="photo">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<?php include "includes/footer.php"; ?>
</body>
</html>
