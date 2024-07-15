<?php include "classes/admindetails.php"; ?>
<!DOCTYPE html>
<html lang="en"> 
<?php include "includes/header.php"; ?>

<link rel="stylesheet" href="dist/custom.css">

<style>
    body{
        overflow: hidden;
    }
</style>
<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary">

    <div class="app-wrapper">

       <?php include "includes/sidebar.php" ?>
        <div class="app-main-wrapper"> 
           <?php 
            include "includes/topnav.php"; ?>
            <main class="app-main">
            <div class="app-content-header"> 
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Manage Approved Files</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                Manage Approved Files
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
                                        <h3 class="card-title mb-0">List of Approved Files</h3>
                                        <a class="btn btn-primary ms-auto custombtn" data-bs-toggle="modal" data-bs-target="#addapproved_fileModal">Add New approved_file</a>
                                    </div>
    
                                    <div class="card-body">
                                        <div class="container-fluid">
                                        <table id="myTable" class="table-responsive table table-hover table-striped w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>File Path</th>
                            <th>File Type</th>
                            <th>Uploaded By</th>
                            <th>Upload Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($approved_files as $file): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($file['id']); ?></td>
                            <td><?php echo htmlspecialchars($file['title']); ?></td>
                            <td><?php echo htmlspecialchars($file['description']); ?></td>
                            <td><?php echo htmlspecialchars($file['file_path']); ?></td>
                            <td><?php echo htmlspecialchars($file['file_type']); ?></td>
                            <td><?php echo htmlspecialchars($file['fullname']); ?></td>
                            <td><?php echo htmlspecialchars($file['upload_date']); ?></td>
                            <td>
                                <a href="view_file.php?id=<?php echo $file['id']; ?>" class="btn btn-info btn-sm">
                                    <i class="bi bi-eye-fill"></i> View</a>
                                <a href="delete_file.php?id=<?php echo $file['id']; ?>" class="btn btn-success btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit</a>
                                <a href="delete_file.php?id=<?php echo $file['id']; ?>" class="btn btn-success btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit</a>                         
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                                        </div> 
                                    </div>
                                </div> 
                        </div>
                        
                    </div> 
                </div>


            </div>
        </div>
    </div>
    </main>
</body>

<?php include "includes/footer.php"; ?>
<script type="text/javascript" src="mdbfolder/mdb.umd.min.js"></script>
    <script>
      $(function() {
    var dtToday = new Date();
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();

    if (month < 10) month = '0' + month.toString();
    if (day < 10) day = '0' + day.toString();

    var maxDate = year + '-' + month + '-' + day;
    $('#materialLoginFormBirthday').attr('max', maxDate);
});

    </script>

</html>
