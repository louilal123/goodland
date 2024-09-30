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
                <div class="app-content-header"> 
                    <div class="container-fluid m-2"> <!--begin::Row-->
                        <div class="row">
                            <div class="col-sm-8">
                                <h3 class="mb-0">Welcome  <small><?php echo htmlspecialchars($user_details['username']); ?>.</small></h3>
                            </div>
                            <div class="col-sm-4">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Overview
                                    </li>
                                </ol>
                            </div>
                        </div> <!--end::Row-->
                    </div> <!--end::Container-->
                </div> 
                <div class="app-content"> 
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row"> <!--begin::Col-->
                        <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 1-->
                            <div class="small-box -primary">
                                <div class="inner p-4 pb-2">
                                    <h3 class="text-black text-lg"> <?php echo htmlspecialchars($fileCount) ?? '0'; ?> </h3>
                                    <p>All Files</p>
                                </div> 
                                <div class="small-box-icon text-primary"><i class="fas fa-folder"></i></div> 
                            </div> <!--end::Small Box Widget 1-->
                        </div> <!--end::Col-->
                        <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 2-->
                            <div class="small-box -warning">
                                <div class="inner p-4 pb-2">
                                    <h3 class="text-black text-lg"> <?php echo htmlspecialchars($pending_file) ?? '0'; ?> </h3>
                                    <p>Pending Files</p>
                                </div>
                                <div class="small-box-icon text-warning"><i class="fas fa-clock"></i></div> 
                            </div> <!--end::Small Box Widget 2-->
                        </div> <!--end::Col-->
                        <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 3-->
                            <div class="small-box  -success">
                                <div class="inner p-4 pb-2">
                                    <h3 class="text-black text-lg"> <?php echo htmlspecialchars($approved_file) ?? '0'; ?></h3>
                                    <p>Approved Files</p>
                                </div> 
                               
                                <div class="small-box-icon text-success"><i class="fas fa-check-circle"></i></div>
                            </div> <!--end::Small Box Widget 3-->
                        </div> <!--end::Col-->
                        <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 4-->
                            <div class="small-box -danger">
                                <div class="inner p-4 pb-2">
                                <h3 class="text-black text-lg"> <?php echo htmlspecialchars($declined_file) ?? '0'; ?></h3>
                                    <p>Declined Files</p>
                                </div> 
                                <div class="small-box-icon text-danger"><i class="fas fa-archive"></i></div> 
                            </div> <!--end::Small Box Widget 4-->
                        </div> <!--end::Col-->
                    </div> <!--end::Row--> <!--begin::Row-->
                    <div class="row">  
                    <div class="col-lg-12 connectedSortable">
                        <div class="card ">
                                <div class="card-body">
                                    <div class="card-title">
                                       <h3> My Recent Submissions </h3>
                                    </div>
                                    <table id="myTable123" class="table-responsive table text-sm table-hover table-striped w-100">
                                        <thead class="table-secondary fw-bold">
                                            <tr>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Cover</th>
                                                <th>File Path</th>
                                                <th>Status</th>
                                                <th width="auto">Upload Date</th>
                                                <th width="auto">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($recent_submissions as $file): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($file['title']); ?></td>
                                                <td><?php echo htmlspecialchars($file['description']); ?></td>
                                                <td><img src="<?php echo htmlspecialchars($file['cover_path']); ?>" style="height: 50px; display: flex; margin: auto;"></td>
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
                                                    <span class="badge <?php echo htmlspecialchars($badgeClass); ?>">
                                                        <?php echo $status; ?></span>
                                                </td>
                                                <td><?php echo date("M d, Y h:i A", strtotime($file['upload_date'])); ?></td>
                                                <td>
                                                    <a href="#" class="btn btn-info btn-sm viewBtn ml-1" name="viewPdf">
                                                        <i class="fas fa-eye"></i> View
                                                    </a>
                                                    <a href="#" class="btn btn-success btn-sm viewBtn ml-1" name="viewPdf">
                                                        <i class="fas fa-pencil-square"></i> Edit
                                                    </a>
                                                    <a href="#" class="btn btn-danger btn-sm viewBtn ml-1" name="viewPdf">
                                                        <i class="fas fa-trash"></i> Delete
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