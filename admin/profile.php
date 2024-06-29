<?php include "classes/admindetails.php"; ?>
<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php"; ?>
<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary">

<div class="app-wrapper">
    <?php include "includes/sidebar.php"; ?>
    <div class="app-main-wrapper">
        <?php include "includes/topnav.php"; ?>
        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Profile Information</h3>
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
                    <div class="row d-flex justify-content-center align-items-center" style="min-height: 80vh;">
                        <div class="col-md-8">
                            <div class="card mb-4 card-outline-primary">
                                <div class="card-header d-flex">
                                    <h3 class="card-title mb-0">Profile Information</h3>
                                </div>
                                <div class="card-body">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-8 text-center">
                                                <img src="<?php echo $adminDetails['admin_photo'] ?? 'uploads/default-photo.jpg'; ?>" class="img-fluid rounded-circle mb-3" alt="Admin Photo" style="width: 150px;">
                                            </div>
                                            <div class="col-md-8">
                                                
                                                <p class="card-text"><strong>Full Name:</strong> <?php echo $adminDetails['full_name'] ?? 'N/A'; ?></p>
                                                <p class="card-text"><strong>Email:</strong> <?php echo $adminDetails['email'] ?? 'N/A'; ?></p>
                                                <p class="card-text"><strong>Full Name:</strong> <?php echo $adminDetails['username'] ?? 'N/A'; ?></p>
                                               
                                                <p class="card-text"><strong>Phone:</strong> <?php echo $adminDetails['phone'] ?? 'N/A'; ?></p>
                                                <p class="card-text"><strong>Address:</strong> <?php echo $adminDetails['address'] ?? 'N/A'; ?></p>
                                                <p class="card-text"><strong>Role:</strong> <?php echo $adminDetails['role'] ?? 'N/A'; ?></p>
                                                <p class="card-text"><strong>Department:</strong> <?php echo $adminDetails['department'] ?? 'N/A'; ?></p>
                                                <p class="card-text"><strong>Date of Joining:</strong> <?php echo $adminDetails['date_of_joining'] ?? 'N/A'; ?></p>
                                                <p class="card-text"><strong>Last Login:</strong> <?php echo $adminDetails['last_login'] ?? 'N/A'; ?></p>
                                                <p class="card-text"><strong>Last Updated:</strong> <?php echo $adminDetails['last_updated'] ?? 'N/A'; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- /.card -->
                        </div> <!-- /.col -->
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php include "includes/footer.php"; ?>
</body>
</html>
