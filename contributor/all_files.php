<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
<?php include "includes/header.php";?>
</head> 
   

<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini"> 
    <div class="app-wrapper">
    <?php include "includes/sidebar.php";?>
        <div class="app-main-wrapper">
        <?php include "includes/topnav.php";?>
            
            <main class="app-main">
            <div class="app-content-header"> 
                    <div class="container-fluid"> <!--begin::Row-->
                        <div class="row">
                            <div class="col-sm-8">
                                <h3 class="mb-0">My Submissions</h3>
                            </div>
                            <div class="col-sm-4">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Manage Files
                                    </li>
                                </ol>
                            </div>
                        </div> <!--end::Row-->
                    </div> <!--end::Container-->
                </div>
                <div class="app-content"> 
                <div class="container-fluid m-1 bg-"> 
                    <!--begin::Row-->
                    <div class="row">  
                       <div class="card bg-body-secondary">
                            <ul class="nav nav-tabs bg-dark" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link text-white active " id="all-files-tab" data-bs-toggle="tab" data-bs-target="#all-files-tab-pane" type="button" role="tab" 
                                    aria-controls="all-files-tab-pane" aria-selected="true">All Files</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link text-white" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending-tab-pane" type="button" role="tab" 
                                    aria-controls="pending-tab-pane" aria-selected="false">Pending</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link text-white" id="approved-tab" data-bs-toggle="tab" data-bs-target="#approved-tab-pane" type="button" role="tab" 
                                    aria-controls="approved-tab-pane" aria-selected="false">Approved</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link text-white" id="declined-tab" data-bs-toggle="tab" data-bs-target="#declined-tab-pane" type="button" role="tab" 
                                    aria-controls="declined-tab-pane" aria-selected="false">Declined</button>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="all-files-tab-pane" role="tabpanel" aria-labelledby="all-files-tab" tabindex="0">
                                    <div class="card-body">
                                        <table id="myTable" class="table-responsive w-100">
                                            <thead class="bg-primary text-white">
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
                                                    <td><i class="nav-icon fas fa-sharp fa-solid fa-file-pdf text-lg"></i> <?php echo htmlspecialchars($file['title']); ?></td>
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
                                                            <i class="fas fa-magnifying-glass text-lg"></i> View
                                                        </a>
                                                         <a href="#" class="btn btn-danger btn-sm viewBtn ml-1" name="viewPdf">
                                                            <i class="fas fa-trash text-lg"></i> Delete
                                                        </a>
                                                     
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>    
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pending-tab-pane" role="tabpanel" aria-labelledby="pending-tab" tabindex="0">
                                    <div class="card-body">
                                        <table id="myTable1" class="table-responsive w-100">
                                            <thead class="bg-primary text-white">
                                                <tr>
                                                  
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <th>Cover</th>
                                                    <th>File Path</th>
                                                    <th>Status</th>
                                                    <th width="auto">Upload Date</th>
                                                    <th width="150px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($pending_files as $file): ?>
                                                <tr>
                                                    
                                                    <td><i class="nav-icon fas fa-sharp fa-solid fa-file-pdf text-lg"></i> <?php echo htmlspecialchars($file['title']); ?></td>
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
                                                            <i class="fas fa-magnifying-glass text-lg"></i> View
                                                        </a>
                                                         <a href="#" class="btn btn-danger btn-sm viewBtn ml-1" name="viewPdf">
                                                            <i class="fas fa-trash text-lg"></i> Delete
                                                        </a>
                                                      
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>    
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="approved-tab-pane" role="tabpanel" aria-labelledby="approved-tab" tabindex="0">
                                <div class="card-body">
                                        <table id="myTable2" class="table-responsive w-100">
                                            <thead class="bg-primary text-white">
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
                                                <?php foreach ($approved_files as $file): ?>
                                                <tr>
                                                    
                                                    <td><i class="nav-icon fas fa-sharp fa-solid fa-file-pdf text-lg"></i> <?php echo htmlspecialchars($file['title']); ?></td>
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
                                                            <i class="fas fa-magnifying-glass text-lg"></i> View
                                                        </a>
                                                         <a href="#" class="btn btn-danger btn-sm viewBtn ml-1" name="viewPdf">
                                                            <i class="fas fa-trash text-lg"></i> Delete
                                                        </a>
                                                     
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>    
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="declined-tab-pane" role="tabpanel" aria-labelledby="declined-tab" tabindex="0">
                                <div class="card-body">
                                        <table id="myTable3" class="table-responsive w-100">
                                            <thead class="bg-primary text-white">
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
                                                <?php foreach ($declined_files as $file): ?>
                                                <tr>
                                                    <td><i class="nav-icon fas fa-sharp fa-solid fa-file-pdf text-lg"></i> <?php echo htmlspecialchars($file['title']); ?></td>
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
                                                            <i class="fas fa-magnifying-glass text-lg"></i> View
                                                        </a>
                                                         <a href="#" class="btn btn-danger btn-sm viewBtn ml-1" name="viewPdf">
                                                            <i class="fas fa-trash text-lg"></i> Delete
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
                      

            </div> <!--end::Container-->
        </div> <!--end::App Content-->
    </main>
            <?php include "includes/footer.php";?>
</body><!--end::Body-->

</html>