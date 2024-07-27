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
                            <h3 class="mb-0">Website Visitors</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                Visitors
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
                       <!-- HTML Table -->
                            <div class="card mb-4 card-outline-primary">
                                <div class="card-header d-flex">
                                    <h3 class="card-title mb-0">List of Website Visitors</h3>
                                </div>
                                <div class="card-body">
                                    <div class="container-fluid">
                                        <table id="myTable" class="table-responsive table table-hover table-striped w-100">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Full Name</th>
                                                    <th>IP</th>
                                                    <th>City</th>
                                                    <th>Region</th>
                                                    <th>Country</th>
                                                    <th>Latitude</th>
                                                    <th>Longitude</th>
                                                    <th>Visit Time</th>
                                                    <th>Visit Count</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($visitors as $visitor): ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($visitor['id']); ?></td>
                                                        <td><?php echo htmlspecialchars($visitor['fullname']); ?></td>
                                                        <td><?php echo htmlspecialchars($visitor['ip']); ?></td>
                                                        <td><?php echo htmlspecialchars($visitor['city']); ?></td>
                                                        <td><?php echo htmlspecialchars($visitor['region']); ?></td>
                                                        <td><?php echo htmlspecialchars($visitor['country']); ?></td>
                                                        <td><?php echo htmlspecialchars($visitor['latitude']); ?></td>
                                                        <td><?php echo htmlspecialchars($visitor['longitude']); ?></td>
                                                        <td><?php echo htmlspecialchars($visitor['visit_time']); ?></td>
                                                        <td><?php echo htmlspecialchars($visitor['visit_count']); ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
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