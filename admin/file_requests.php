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
                <!-- View Request Button -->
                <button class="btn btn-info btn-sm viewFileRequestBtn" data-id="<?php echo $request['request_id']; ?>" 
                        data-bs-toggle="modal" data-bs-target="#viewFileRequestModal">
                    <i class="bi bi-eye-fill"></i>
                </button>

                <!-- Delete Request Button -->
                <button class="btn btn-danger btn-sm deleteRequestBtn" data-id="<?php echo $request['request_id']; ?>" 
                        data-bs-toggle="modal" data-bs-target="#deleteRequestModal">
                    <i class="bi bi-trash-fill"></i>
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

              <!-- Delete Request Modal -->
<div class="modal fade" id="deleteRequestModal" tabindex="-1" role="dialog" aria-labelledby="deleteRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteRequestModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete the request for the file <strong id="request-title"></strong>?
                <input type="hidden" id="request-id" name="request_id" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-danger" id="confirm-delete-request-btn">Delete</a>
            </div>
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
        // When the delete button is clicked
        $('.deleteRequestBtn').on('click', function() {
            var requestId = $(this).data('id'); // Get the request ID from the button's data attribute
            var requestTitle = $(this).closest('tr').find('td').eq(1).text(); // Get the title from the table row

            // Set the request ID and title in the modal
            $('#request-id').val(requestId);
            $('#request-title').text(requestTitle);
        });

        // Confirm request deletion
        $('#confirm-delete-request-btn').on('click', function() {
            var requestId = $('#request-id').val(); // Get the request ID from the hidden input
            // Redirect to the delete_file_request.php with the request ID
            window.location.href = 'classes/delete_file_request.php?id=' + requestId;
        });
    });
</script>

<!-- end  -->

</body>

</html>