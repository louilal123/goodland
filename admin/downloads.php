<?php include "classes/admindetails.php"; ?>
<!DOCTYPE html>
<html lang="en"> 
<?php include "includes/header.php"; ?>
<style>
    body{
        overflow: hidden;
        
    }
    .main-blur {
    background: rgba(108, 117, 125, 0.1); 
}
</style>

<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary">

    <div class="app-wrapper">

       <?php include "includes/sidebar.php" ?>
        <div class="app-main-wrapper main-blur"> 
           <?php 
            include "includes/topnav.php"; ?>
            <main class="app-main">
            <div class="app-content-header"> 
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Manage File Downloads</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                Downloads
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
                                <div class="card-header d-flex">
                                    <h3 class="card-title mb-0">List of Downloads</h3>
                                    <a class="btn btn-danger ms-auto custombtn" data-bs-toggle="modal" data-bs-target="#addItemModal"><i class="fas fa-trash"></i> Delete All</a>
                          
                                </div>
                                <div class="card-body">
                                    <div class="container-fluid">
                                        <table id="myTable" class="table-responsive table table-hover table-striped w-100">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                   
                                                    <th>File Title</th>
                                                   
                                                    <th>User Fullname</th>
                                                    <th>Download Time</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($downloads as $download): ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($download['id']); ?></td>
                                                      
                                                        <td><?php echo htmlspecialchars($download['title']); ?></td>
                                                        
                                                        <td><?php echo htmlspecialchars($download['fullname']); ?></td>
                                                        <td><?php echo date("M d, Y h:i A", strtotime($download['download_time'])); ?></td>
                                                        <td> <a href="#" class="btn btn-danger btn-sm deleteuserBtn"
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#deleteuserBtn"> 
                                                            <i class="bi bi-trash"></i>
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
            

            </div> 
        </main>
          
        </div>
    </div>
   
    <?php include "includes/footer.php" ?>
   
<!-- end  -->

</body>

</html>