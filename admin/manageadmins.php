<?php include "classes/admindetails.php"; ?>
<!DOCTYPE html>
<html lang="en"> 
<?php include "includes/header.php"; ?>
<link rel="stylesheet" href="dist/custom.css">
<style>
     body{
		overflow:hidden;
	}
   
    .modal{
        border-radius: 0px !important;
    }
</style>
<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary">

          

    <div class="app-wrapper">

       <?php include "includes/sidebar.php" ?>
        <div class="app-main-wrapper"> 
           <?php 
            include "includes/topnav.php"; ?>
            <main class="app-main">
                  <!-- <div id="loader" >
                    <div class="spinner"></div>
                </div> -->
            <div class="app-content-header"> 
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Manage Admins</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                Manage Admins
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-content"> 
                <div class="container-fluid"> 
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4 card-outline-primary">
                            <div class="card-header d-flex ">
                                <h3 class="card-title mb-0">List of Admins</h3>
                                <a class="btn btn-primary ms-auto custombtn" data-bs-toggle="modal" data-bs-target="#addItemModal">Add New Admin</a>
                            </div>
 
                                <div class="card-body">
                                    <div class="container-fluid">
                                <table id="myTable" class="table-responsive table table-hover table-bordered table-striped w-100">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fullname</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Photo</th>
                                    <th>Date_created</th>
                                    <th>Modified</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($admins as $index => $admin): ?>
                                    <tr>
                                    <td><?php echo $index + 1; ?></td>
                                        <td><?php echo htmlspecialchars($admin['fullname']); ?></td>
                                        <td><?php echo htmlspecialchars($admin['username']); ?></td>
                                        <td><?php echo htmlspecialchars($admin['email']); ?></td>
                                        <td> <img src="<?php echo $admin['admin_photo'] ?? 'uploads/default_photo.jpg'; ?>" alt="" style="width: 40px; height: 40px; "></td>
                                        <td><?php echo htmlspecialchars($admin['date_created']); ?></td>
                                        <td><?php echo htmlspecialchars($admin['date_updated']); ?></td>
                                        <td>
                                            <?php if ($admin['status'] == 'Active'): ?>
                                                <span class="badge bg-success">Active</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Inactive</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                        <button class="btn btn-info btn-sm viewAdminDetailBtn " data-id="<?php echo $admin['admin_id']; ?>" 
                                        data-bs-toggle="modal" data-bs-target="#viewAdminModal">View</button>
                                        <a href="#" class="btn btn-success btn-sm editAdminBtn" data-bs-toggle="modal" data-bs-target="#editAdminModal">Edit</a>
                                        
                                            <a href="classes/delete_admin.php?id=<?=$admin['admin_id']; ?>" class="btn btn-danger btn-sm deleteBtn">Delete</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                           
                            </table>
                                </div> 
                                </div>
                            </div> <!-- /.card -->
                        </div> <!-- /.col -->
                        
                    </div> 
                </div>

               <!-- Edit Admin Modal --><!-- Edit Admin Modal -->
<!-- Edit Admin Modal -->
<div class="modal fade" id="editAdminModal" tabindex="-1" aria-labelledby="editAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAdminModalLabel">Update Admin Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="classes/admin_crud.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col">
                            <label for="editfullname" class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="fullname" id="editfullname" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="editusername" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="editusername" readonly>
                        </div>
                        <div class="col-6">
                            <label for="editemail" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="editemail" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="editstatus" class="form-label">Status</label>
                            <select class="form-control" name="status" id="editstatus">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="update_admin_status" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

                 <!-- end  -->

                <!-- View Admin Mo d starr -->
                <div class="modal fade" id="viewAdminModal" tabindex="-1" aria-labelledby="viewAdminModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="viewAdminModalLabel">Admin Details</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div id="adminDetailsContent" class="container-fluid">
                                
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary custombtn" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div> 
                <!-- end  -->
           
           <!-- Modal HTML -->
<!-- Modal HTML -->
<div class="modal" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Admin</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="classes/admin_crud.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="fullname" id="fullname" 
                         value="<?php echo $_SESSION['form_data']['fullname'] ?? ''; ?>">
                            <?php if (isset($_SESSION['error_fullname'])): ?>
                                <p class="error text-danger"><?php echo $_SESSION['error_fullname']; unset($_SESSION['error_fullname']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="username" value="<?php echo $_SESSION['form_data']['username'] ?? ''; ?>">
                            <?php if (isset($_SESSION['error_username'])): ?>
                                <p class="error text-danger"><?php echo $_SESSION['error_username']; unset($_SESSION['error_username']); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="col-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="<?php echo $_SESSION['form_data']['email'] ?? ''; ?>">
                            <?php if (isset($_SESSION['error_email'])): ?>
                                <p class="error text-danger"><?php echo $_SESSION['error_email']; unset($_SESSION['error_email']); ?></p>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['error_email_format'])): ?>
                                <p class="error text-danger"><?php echo $_SESSION['error_email_format']; unset($_SESSION['error_email_format']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="photo" class="form-label">Photo</label>
                            <input type="file" class="form-control" name="photo" id="photo">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" >
                            <?php if (isset($_SESSION['error_pswd'])): ?>
                                <p class="error text-danger"><?php echo $_SESSION['error_pswd']; unset($_SESSION['error_pswd']); ?></p>
                            <?php endif; ?>
                            
                            <?php if (isset($_SESSION['error_pswd_match'])): ?>
                                <p class="error text-danger"><?php echo $_SESSION['error_pswd_match']; unset($_SESSION['error_pswd_match']); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="col-6">
                            <label for="cPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="cPassword" id="cPassword" >
                            <?php if (isset($_SESSION['error_cpswd'])): ?>
                                <p class="error text-danger"><?php echo $_SESSION['error_cpswd']; unset($_SESSION['error_cpswd']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="modal-footer mt-4">
                        <button type="button" class="btn btn-secondary custombtn" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary custombtn" name="add_admin">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


            </div> 
        </main>
          
        </div>
    </div>
    <script>
   $(document).ready(function () {
    $('.editAdminBtn').on('click', function () {
        $('#editAdminModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text().trim();
        }).get();

        console.log(data); 

        $('#editfullname').val(data[1]);
        $('#editusername').val(data[2]);
        $('#editemail').val(data[3]);
       
        
         var status = data[7].includes('Active') ? 'Active' : 'Inactive';
        $('#editstatus').val(status);

        if (status === 'Active') {
            $('#editstatus option[value="Active"]').hide();
            $('#editstatus option[value="Inactive"]').show();
        } else {
            $('#editstatus option[value="Active"]').show();
            $('#editstatus option[value="Inactive"]').hide();
        }
    });
});


    </script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    <?php if (isset($_SESSION['form_data'])): ?>
    var myModal = new bootstrap.Modal(document.getElementById('addItemModal'), {
        backdrop: 'static'
    });
    myModal.show();
    <?php unset($_SESSION['form_data']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['status2'])): ?>
    Swal.fire({
        icon: '<?php echo $_SESSION['status2']; ?>',
        title: '<?php echo $_SESSION['status_icon2']; ?>',
        showConfirmButton: false,
        timer: 1500
    });
    <?php unset($_SESSION['status2']); unset($_SESSION['status_icon2']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['status2'])): ?>
    Swal.fire({
        icon: '<?php echo $_SESSION['status_icon2']; ?>',
        title: '<?php echo $_SESSION['status2']; ?>',
        showConfirmButton: false,
        timer: 1500
    });
    <?php unset($_SESSION['status2']); unset($_SESSION['status_icon2']); ?>
    <?php endif; ?>
});
</script>

    <?php include "includes/footer.php" ?>
   
<!-- end  -->

</body>

</html>