<?php include "classes/admindetails.php"; ?>
<!DOCTYPE html>
<html lang="en"> 
<?php include "includes/header.php"; ?>

<link rel="stylesheet" href="dist/custom.css">

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
                            <h3 class="mb-0">Manage Members</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                Manage Members
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
                                <h3 class="card-title mb-0">List of Members</h3>
                                <a class="btn btn-primary ms-auto custombtn" data-bs-toggle="modal" data-bs-target="#addItemModal">Add New Member</a>
                            </div>
 
                                <div class="card-body">
                                    <div class="container-fluid">
                                <table id="myTable" class="table-responsive table table-hover table-bordered table-striped w-100">
                                <thead>
                                <tr>
                                    <th>Mmber Id</th>
                                    <th>Member Name</th>
                                    <th>Description</th>
                                    <th>Photo</th>
                                    <th>Date Created</th>
                                    <th>Date Updated</th>
                                   
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($members as $index => $members): ?>
                                    <tr>
                                   
                                        <td><?php echo htmlspecialchars($members['member_id']); ?></td>
                                        <td><?php echo htmlspecialchars($members['member_name']); ?></td>
                                        <td><?php echo htmlspecialchars($members['description']); ?></td>
                                        <td> <img src="<?php echo $admin['member_photo'] ?? 'uploads/default_photo.jpg'; ?>" alt="" style="width: 40px; height: 40px; "></td>
                                        <td><?php echo htmlspecialchars($members['date_created']); ?></td>
                                        <td><?php echo htmlspecialchars($members['date_updated']); ?></td>
                                       
                                        <td>
                                        <button class="btn btn-info btn-sm viewAdminDetailBtn" data-id="<?php echo $admin['admin_id']; ?>" 
                                        data-bs-toggle="modal" data-bs-target="#viewAdminModal">View</button>
                                        <a href="#" class="btn btn-success btn-sm editMemberBtn" data-bs-toggle="modal" data-bs-target="#editMemberModal"> <i class="bi bi-pencil"></i></a>
                                        
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
<!-- start  -->


                 <!-- end  -->

                <!-- View Admin Mo d starr -->
                <div class="modal" id="viewMemberModal" tabindex="-1" aria-labelledby="viewMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="viewMemberModalLabel">View Member Details</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="viewMemberForm">
                    <div class="row">
                        <div class="col">
                            <label for="view_member_name" class="form-label">Member Name</label>
                            <input type="text" class="form-control" name="member_name" id="member_name" disabled>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="view_description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" disabled></textarea>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="view_photo" class="form-label">Photo</label>
                            <img id="view_photo" class="img-fluid" src="" alt="Member Photo">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
                 <!-- end  -->
<div class="modal" id="editMemberModal" tabindex="-1" aria-labelledby="editMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="editMemberModalLabel">Edit Member</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="classes/members_crud.php" method="post" enctype="multipart/form-data">
                   <div class="row">
                        <div class="col">
                            <label for="edit_member_name" class="form-label">Member ID</label>
                            <input type="text" class="form-control" name="member_id" id="member_id" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="edit_member_name" class="form-label">Member Name</label>
                            <input type="text" class="form-control" name="member_name" id="member_name">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="edit_description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description"></textarea>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="edit_photo" class="form-label">Photo</label>
                            <input type="file" class="form-control" name="photo" id="photo">
                            <img id="photo" class="img-fluid mt-2" src="" alt="Current Member Photo">
                        </div>
                    </div>
                    <div class="modal-footer mt-4">
                        <button type="button" class="btn btn-secondary custombtn" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary custombtn" name="update_member">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>          
                <!-- start  -->
<div class="modal" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addItemModalLabel">New Member</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="classes/members_crud.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col">
                            <label for="member_name" class="form-label">Member Name</label>
                            <input type="text" class="form-control" name="member_name" id="member_name" 
                         value="<?php echo $_SESSION['form_data']['member_name'] ?? ''; ?>">
                            <?php if (isset($_SESSION['error_member_name'])): ?>
                                <p class="error text-danger"><?php echo $_SESSION['error_member_name']; unset($_SESSION['error_member_name']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description"><?php echo $_SESSION['form_data']['description'] ?? ''; ?></textarea>
                            <?php if (isset($_SESSION['error_description'])): ?>
                                <p class="error text-danger"><?php echo $_SESSION['error_description']; unset($_SESSION['error_description']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="photo" class="form-label">Photo</label>
                            <input type="file" class="form-control" name="photo" id="photo">
                        </div>
                    </div>
                    <div class="modal-footer mt-4">
                        <button type="button" class="btn btn-secondary custombtn" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary custombtn" name="add_member">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
                <!-- end  -->
            </div> 
        </main>
          
        </div>
    </div>
    <script>
   $(document).ready(function () {
    $('.editMemberBtn').on('click', function () {
        $('#editMemberModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text().trim();
        }).get();

        console.log(data); 

        $('#member_id').val(data[0]);
        $('#member_name').val(data[1]);
        $('#description').val(data[2]);
        $('#member_photo').val(data[4]);
        $('#date_created').val(data[5]);
        $('#date_updated').val(data[6]);
       
    });
});
    </script>
   
    <?php include "includes/footer.php" ?>
   
<!-- end  -->

</body>

</html>