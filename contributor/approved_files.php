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
                <div class="row">  
                        <div class="col-lg-12 connectedSortable">
                            <div class="card p-0">
                                <ul class="nav nav-tabs bg- bg-primary-subtle " id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="all-files-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" 
                                        aria-controls="all-files-tab-pane" aria-selected="true">All Files</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending-tab-pane" type="button" role="tab" 
                                        aria-controls="pending-tab-pane" aria-selected="false">Pending</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" 
                                        aria-controls="contact-tab-pane" aria-selected="false">Contact</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane" type="button" role="tab" 
                                        aria-controls="disabled-tab-pane" aria-selected="false" disabled>Disabled</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="all-files-tab-pane" role="tabpanel" aria-labelledby="all-files-tab" tabindex="0">
                                        <div class="col-lg-12 connectedSortable">
                                                <div class="card-body">
                                                    <table id="myTable" class="table-responsive table text-sm table-hover table-striped w-100">
                                                        <thead>
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
                                                            <?php foreach ($get_all_files as $file): ?>
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
                                                                    <span class="badge <?php echo $badgeClass; ?>"><?php echo $status; ?></span>
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
                                    </div>
                                    <div class="tab-pane fade" id="pending-tab-pane" role="tabpanel" aria-labelledby="pending-tab" tabindex="0">
                                        <p>Pending files will be listed here.</p>
                                    </div>
                                    <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                                        <p>Contact details can be displayed here.</p>
                                    </div>
                                    <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">
                                        <p>This tab is disabled.</p>
                                    </div>
                                </div>
                            </div> 


                        </div> <!-- /.row (main row) -->
                    </div> <!--end::Container-->
                </div> <!--end::Container-->
                </div> <!--end::App Content-->
            </main>
            <?php include "includes/footer.php";?>
</body><!--end::Body-->

</html>