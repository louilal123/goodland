<?php include "classes/admindetails.php"; ?>
<!DOCTYPE html>
<html lang="en"> 
<?php include "includes/header.php"; ?>

<!-- <link rel="stylesheet" href="dist/custom.css"> -->

<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary">

    <div class="app-wrapper">

       <?php include "includes/sidebar.php" ?>
        <div class="app-main-wrapper main-blur"> 
           <?php 
            include "includes/topnav.php"; ?>
            <main class="app-main">
          
            <div class="app-content"> 
                <div class="container-fluid"> 
                    <div class="row mt-4">
                        <div class="col-md-12">
                       
                            <div class="card mb-4 card-outline-primary">
                               
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="fw-bold">Downloaded Files</h3>
                                    </div>
                                    <table id="myTable" class="table-responsive table text-sm table-hover table-striped w-100">
                                        <thead class="table-secondary fw-bold">
                                            <tr>
                                                <th style="font-weight: bold;">ID</th>
                                                <th style="font-weight: bold;">File Title</th>
                                                <th style="font-weight: bold;">User Fullname</th>
                                                <th style="font-weight: bold;">Download Time</th>
                                                <th style="font-weight: bold;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($downloads as $download): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($download['id']); ?></td>
                                                    <td><?php echo htmlspecialchars($download['title']); ?></td>
                                                    <td><?php echo htmlspecialchars($download['fullname']); ?></td>
                                                    <td><?php echo date("M d, Y h:i A", strtotime($download['download_time'])); ?></td>
                                                    <td>
                                                        <a href="#" class="btn btn-danger btn-sm deleteuserBtn"
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#deleteuserBtn"> 
                                                            <i class="bi bi-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
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