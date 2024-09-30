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
               
                <div class="app-content"> 
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row"> <!-- Start col -->
                        <div class="col-lg-12 connectedSortable">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h3 class="card-title">Recently Deleted Files</h3>
                                </div>
                                <div class="card-body">
                                <table id="myTable" class="table-responsive table table-hover table-striped w-100">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                           <th>Cover </th>
                           <th>File Path</th>
                           <th>Status</th>
                            <th width="150px">Upload Date</th>
                            <th width="500px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($deleted_files as $file): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($file['title']); ?></td>
                            <td><?php echo htmlspecialchars($file['description']); ?></td>
                            <td><img src="<?php echo htmlspecialchars($file['cover_path']); ?>" style="height: 50px; display: flex; margin: auto;" ></td>
                            <td><?php echo htmlspecialchars($file['file_path']); ?></td>
                            <td>
                                <?php
                                $status = htmlspecialchars($file['status']);
                                $badgeClass = '';
                                
                                if ($status === 'Pending') {
                                    $badgeClass = 'badge-warning';
                                } elseif ($status === 'Approved') {
                                    $badgeClass = 'badge-success';
                                } elseif ($status === 'Declined') {
                                    $badgeClass = 'badge-danger';
                                }
                                ?>
                                <span class="badge <?php echo $badgeClass; ?>"><?php echo $status; ?></span>
                            </td>
                            <td><?php echo date("M d, Y h:i A", strtotime($file['upload_date'])); ?></td>
                            <td>
                            <a href="#" class="btn btn-danger btn-sm viewBtn ml-1" name="viewPdf">
                                <i class="bi bi-Trash"></i> Delete
                            </a>
                        </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>


                </table>
                                </div>
                            </div> 

                        </div> 

                    </div> <!-- /.row (main row) -->
                </div> <!--end::Container-->
                </div> <!--end::App Content-->
            </main>
            <?php include "includes/footer.php";?>
</body><!--end::Body-->

</html>