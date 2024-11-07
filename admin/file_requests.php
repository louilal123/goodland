<?php include "classes/admindetails.php"; ?>
<!DOCTYPE html>
<html lang="en"> 
<?php include "includes/header.php"; ?>

<link rel="stylesheet" href="dist/custom.css">

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
                       <!-- HTML Table -->
                            <div class="card mb-4 card-outline-primary">
                                
                            <div class="card-body">
    <div class="d-flex">
        <h3 class="fw-bold">List of File Requests</h3>
    </div>
    <table id="myTable" class="table table-bordered table-hover table-striped text-center w-100">
        <thead class="table-secondary">
            <tr class="text-black fw-bold">
                <th>#</th>
                <th>Title</th>
               
                <th>Email</th>
                <th>Request Date</th>
               
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pending_request as $index => $request): ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo htmlspecialchars($request['title']); ?></td>
                    
                    <td><?php echo htmlspecialchars($request['email']); ?></td>
                    <td><?php echo date("M d, Y h:i A", strtotime($request['request_date'])); ?></td>
                   
                   
                    <td>
                        <!-- Example action buttons -->
                        <button class="btn btn-info btn-sm viewFileRequestBtn" data-id="<?php echo $request['request_id']; ?>" 
                                data-bs-toggle="modal" data-bs-target="#viewFileRequestModal">
                            <i class="bi bi-eye-fill"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

                            </div> <!-- /.card -->
                        
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