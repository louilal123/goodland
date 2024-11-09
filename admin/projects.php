<?php include "classes/admindetails.php"; ?>
<!DOCTYPE html>
<html lang="en"> 
<?php include "includes/header.php"; ?>
<link rel="stylesheet" href="dist/custom.css">

<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary">
    <div class="app-wrapper">
        <?php include "includes/sidebar.php"; ?>
        <div class="app-main-wrapper main-blur">
            <?php include "includes/topnav.php"; ?>
            <main class="app-main">
              
                <div class="app-content">
                    <div class="container-fluid">
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="card">
                                <div class="d-flex mb-3">
                                            <h3 class="fw-bold"><i class="fas fa-folder-plus"></i> List of Projects</h3>
                                            <button type="button" class="btn btn-primary ms-auto btn-rounded" onclick="window.location.href='project_add'">
                                                <i class="fas fa-folder-plus"></i> Create New
                                            </button>
                                        </div>
                                    <div class="card-body">
                                       
                                        <table id="myTable" class="table table-bordered table-hover table-striped text-center w-100">
                                            <thead class="table-secondary fw-bold">
                                                <tr>
                                                    <th>Title</th>
                                                    <th width="40%">Banner Quote</th>
                                                    <th>Project Image</th>
                                                    <th>Date Created</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($projects as $project): ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($project['title']); ?></td>
                                                        <td><?php echo htmlspecialchars($project['banner_quote']); ?></td>
                                                        <td>
                                                            <img src="../<?php echo htmlspecialchars($project['project_image']) ?: 'default_image.jpg'; ?>" 
                                                                style="height: 50px; width: 100px;">
                                                        </td>
                                                        <td><?php echo date("M d, Y h:i A", strtotime($project['created_at'])); ?></td>
                                                        <td>
                                                            <button class="btn btn-info btn-sm viewProjectBtn" data-bs-toggle="modal" data-bs-target="#viewProjectModal">
                                                                <i class="bi bi-search"></i>
                                                            </button>
                                                            <a href="#" class="btn btn-success btn-sm editProjectBtn" data-bs-toggle="modal" data-bs-target="#editProjectModal">
                                                                <i class="bi bi-pencil-square"></i>
                                                            </a>
                                                            <a href="#" class="btn btn-danger btn-sm deleteProjectBtn" data-bs-toggle="modal" data-bs-target="#deleteProjectModal">
                                                                <i class="bi bi-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>



                            </div> <!-- /.col -->
                        </div> 
                    </div>
                </div>
            </main>
        </div>
    </div>
    <?php include "includes/footer.php"; ?>
    <?php
    // session_start();
if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
?>
<script>
Swal.fire({
    icon: "<?php echo $_SESSION['status_icon']; ?>",
    title: "<?php echo $_SESSION['status']; ?>",
    confirmButtonText: "Ok"
});
</script>
<?php
unset($_SESSION['status']);
unset($_SESSION['status_icon']);
}
?>
</body>
</html>
