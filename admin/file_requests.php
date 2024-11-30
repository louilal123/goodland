<?php include "classes/admindetails.php"; ?>
<!DOCTYPE html>
<html lang="en"> 
<?php include "includes/header.php"; ?>

<link rel="stylesheet" href="dist/custom.css">

<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary">

    <div class="app-wrapper">
       <?php include "includes/sidebar.php" ?>
        <div class="app-main-wrapper main-blur"> 
           <?php include "includes/topnav.php"; ?>
            <main class="app-main">
            
            <div class="app-content"> 
                <div class="container-fluid"> 
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <!-- HTML Table -->
                            <div class="card mb-4 card-outline-primary">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <h4 class="fw-bold">List of File Requests</h4>
                                        <!-- Button to delete all file requests with the deleteAllBtn class -->
                                        <a href="#" class="btn btn-danger btn-sm ms-auto deleteAllBtn">
                                            <i class="fas fa-trash"></i> Delete All
                                        </a>
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
                                            <?php foreach ($requests as $index => $request): ?> 
                                                <tr>
                                                    <td><?php echo $index + 1; ?></td>
                                                    <td><?php echo htmlspecialchars($request['title']); ?></td>
                                                    <td><?php echo htmlspecialchars($request['email']); ?></td>
                                                    <td><?php echo date("M d, Y h:i A", strtotime($request['request_date'])); ?></td>
                                                    <td>
                                                        <!-- Delete Request Button -->
                                                        <a href="classes/delete_file_request.php?id=<?php echo $request['request_id']; ?>" class="btn btn-danger btn-sm deleteBtn">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- /.card -->
                        </div> 
                    </div>
                </div> 
            </div> 
        </main>
    </div>
</div>

<?php include "includes/footer.php" ?>

<script>
    $(document).ready(function() {
        // Event handler for Delete All button
        $('.deleteAllBtn').on('click', function(e) {
            e.preventDefault(); // Prevent the default behavior (i.e., redirect)

            // Show SweetAlert confirmation
            Swal.fire({
                title: 'Are you sure?',
                text: 'This will delete all file requests!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete all',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If the user confirms, redirect to the delete all URL
                    window.location.href = 'classes/delete_allfilerequest.php'; // Perform the redirection to delete all file requests
                }
            });
        });

        // Event handler for Delete Request button (individual)
        $('.deleteBtn').on('click', function(e) {
            e.preventDefault(); // Prevent the default link action (i.e., redirection)
            
            const href = $(this).attr('href');  // Get the href (link) of the delete button
            
            // Show confirmation popup using SweetAlert
            Swal.fire({
                title: 'Are you sure?',
                text: 'This file request will be deleted!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                // If user confirms the deletion
                if (result.isConfirmed) {
                    window.location.href = href; // Redirect to the link (delete action)
                }
            });
        });
    });
</script>

</body>
</html>
