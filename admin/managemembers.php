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
                            <h3 class="mb-0">Manage Categories</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                Manage Categories
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
                                <h3 class="card-title mb-0">List of Categories</h3>
                                <a class="btn btn-primary ms-auto custombtn" data-bs-toggle="modal" data-bs-target="#addItemModal">Add New Admin</a>
                            </div>
 
                                <div class="card-body">
                                    <div class="container-fluid">
                                <table id="myTable" class="table-responsive table table-hover table-bordered table-striped w-100">
                                <thead>
                                <tr>
                                    <th>Category Id</th>
                                    <th>Category Name</th>
                                    <th>Description</th>
                                    <th>Date Created</th>
                                    <th>Date Updated</th>
                                   
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($admins as $index => $admin): ?>
                                    <tr>
                                   
                                        <td><?php echo htmlspecialchars($admin['fullname']); ?></td>
                                        <td><?php echo htmlspecialchars($admin['username']); ?></td>
                                        <td><?php echo htmlspecialchars($admin['email']); ?></td>
                                       <td><?php echo htmlspecialchars($admin['date_created']); ?></td>
                                        <td><?php echo htmlspecialchars($admin['date_updated']); ?></td>
                                       
                                        <td>
                                        <button class="btn btn-info btn-sm viewAdminDetailBtn" data-id="<?php echo $admin['admin_id']; ?>" 
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

                <!-- status moda  -->
           

                 <!-- end  -->

                <!-- View Admin Mo d starr -->
             
                <!-- end  -->
           
                <!-- start  -->

                <!-- end  -->
            

            </div> 
        </main>
          
        </div>
    </div>
   
    <?php include "includes/footer.php" ?>
   
<!-- end  -->

</body>

</html>