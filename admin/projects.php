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
                                    <div class="card-body">
                                        <div class="d-flex mb-3">
                                            <h3 class="fw-bold"><i class="fas fa-folder-plus"></i> List of Projects</h3>
                                            <button type="button" class="btn btn-sm btn-primary ms-auto btn-rounded" onclick="window.location.href='project_add'">
                                                <i class="fas fa-folder-plus"></i> Create New
                                            </button>
                                        </div>
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
                                                            <button class="btn btn-sm btn-info btn-sm viewProjectBtn" data-bs-toggle="modal" data-bs-target="#viewProjectModal">
                                                                <i class="bi bi-search"></i> View
                                                            </button>
                                                            <a href="#" class="btn btn-sm btn-success btn-sm editProjectBtn" 
                                                            data-bs-toggle="modal" data-bs-target="#editProjectModal">
                                                                <i class="bi bi-pencil-square"></i> Edit
                                                            </a>
                                                            <a href="classes/delete_project.php?project_id=
                                                            <?php echo $project['project_id']; ?>" class="btn btn-sm btn-danger btn-sm deleteBtn">
        <i class="fas fa-trash"></i> Delete
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
    <script>
    $(document).ready(function() {
        $('.deleteBtn').on('click', function(e) {
            e.preventDefault(); // Prevent default link behavior

            const href = $(this).attr('href'); // Get the href of the delete button (delete URL)

            // Trigger SweetAlert confirmation
            Swal.fire({
                title: 'Are you sure?',
                text: 'This project will be deleted!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href; // Redirect to delete_project.php if confirmed
                }
            });
        });
    });
</script>

</body>
</html>
