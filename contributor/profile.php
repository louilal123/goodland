<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
<?php include "includes/header.php";?>
</head> 

<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary"> 
    <div class="app-wrapper">
    <?php include "includes/sidebar.php";?>
        <div class="app-main-wrapper">
        <?php include "includes/topnav.php";?>
            
            <main class="app-main">
             
                <div class="app-content flat">
                <div class="container-fluid">
                    <div class="row mt-2" >
                        <div class="col-md-12">
                            <div class="card  card-outline-primary">
                                <div class="card-header d-flex">
                                    <h2 class="card-title mb-0">Profile Information</h2>
                                    
                                </div>
                                <div class="card-body">
                                    <div class="container-fluid">
                                          <div class="row mb-2">
                                                    <div class="col text-center">
                                                        <img src="uploads/<?php echo $user_details['user_photo'] ?? '../admin/uploads/default-photo.jpg'; ?>" 
                                                        class="img-fluid rounded-circle mb-3" alt="Admin Photo" style="height: 150px;width: 150px;">
                                                        
                                                    </div>
                                                    <button class="btn btn-light "  data-bs-toggle="modal" data-bs-target="#editProfilePicModal"
                                                    style="position: relative; margin-top: -20px; background-color: white;"><i class="fas fa-camera" style=""></i> Edit Profile Picture</button>
                                    
                                                    
                                                    <!-- <i class="fas fa-camera" style=""></i> -->
                                                  
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <label for="fullname" class="form-label "><small>Full Name</small></label>
                                                        <input type="text" class="form-control " id="fullname" 
                                                        value="<?php echo $user_details['fullname']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <label for="username" class="form-label "><small>Username</small></label>
                                                        <input type="text" class="form-control " id="username" 
                                                        value="<?php echo $user_details['username']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <label for="email" class="form-label "><small>Email</small></label>
                                                        <input type="text" class="form-control " id="email" 
                                                        value="<?php echo $user_details['email']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <label for="date_created" class="form-label "><small>Date Created</small></label>
                                                        <input type="text" class="form-control " id="email" 
                                                        value="<?php echo $user_details['date_created']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <label for="date_updated" class="form-label "><small>Date Updated</small></label>
                                                        <input type="text" class="form-control " id="email" 
                                                        value="<?php echo $user_details['date_updated']; ?>" readonly>
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
            <?php include "includes/footer.php";?>
</body><!--end::Body-->

</html>