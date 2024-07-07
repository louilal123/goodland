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
    <div class="app-main-wrapper">
        <?php include "includes/topnav.php"; ?>
        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Profile Information / Edit Profile</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-content flat">
                <div class="container-fluid">
                    <div class="row" style="min-height: 80vh;">
                        <div class="col-md-6">
                            <div class="card mb-4 card-outline-primary">
                                <div class="card-header d-flex">
                                    <h3 class="card-title mb-0">Edit Profile Information </h3>
                                </div>
                                <div class="card-body">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col text-center">
                                                <img src="<?php echo $adminDetails['admin_photo'] ?? 'uploads/default-photo.jpg'; ?>" 
                                                class="img-fluid rounded-circle mb-3" alt="Admin Photo" style="width: 150px;">
                                               
                                            </div>
                                            <div class="col-md-8">
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label for="fullname" class="form-label">Full Name</label>
                                                        <input type="text" class="form-control" id="fullname" 
                                                        value="<?php echo $adminDetails['fullname']; ?>" >
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label for="username" class="form-label">Username</label>
                                                        <input type="text" class="form-control" id="username" value="<?php echo $adminDetails['username']; ?>" >
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="text" class="form-control" id="email" value="<?php echo $adminDetails['email']; ?>" >
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary ms-auto float-end ">Update</button>
                                                <a href="profile" class="btn btn-secondary btn-danger btn-outline me-2 float-end">Back</a>
                                               
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

<!-- Edit Profile Photo Modal -->
<div id="editPhotoModal" class="modal">
    <div class="modal-content">
        <span onclick="document.getElementById('editPhotoModal').style.display='none'" class="close">&times;</span>
        <h2>Edit Profile Photo</h2>
        <form action="update_photo.php" method="post" enctype="multipart/form-data">
            <input type="file" name="admin_photo" required>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
</div>

<!-- Change Password Modal -->
<div id="changePasswordModal" class="modal">
    <div class="modal-content">
        <span onclick="document.getElementById('changePasswordModal').style.display='none'" class="close">&times;</span>
        <h2>Change Password</h2>
        <form action="change_password.php" method="post">
            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" name="current_password" id="current_password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" name="new_password" id="new_password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Change Password</button>
        </form>
    </div>
</div>

<?php include "includes/footer.php"; ?>
</body>
</html>
