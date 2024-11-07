<?php include "classes/admindetails.php"; ?>
<!DOCTYPE html>
<html lang="en"> 
<?php include "includes/header.php"; ?>
<link rel="stylesheet" href="dist/custom.css">

<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary">
    <div class="app-wrapper">
        <?php include "includes/sidebar.php"; ?>
        <div class="app-main-wrapper">
            <?php include "includes/topnav.php"; ?>
            <main class="app-main">

                <div class="app-content">
                    <div class="container-fluid">
                        <div class="row mt-4">
                            <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                <div class="d-flex mb-3">
                                  <h3 class="fw-bold">List of Messages</h3>
                                      <button type="button" class="btn btn-sm btn-success ms-auto btn-rounded me-1" onclick="location.reload(); return false;">
                                          <i class="fas fa-refresh"></i> Refresh
                                      </button>
                                      <button type="button" class="btn btn-danger btn-rounded" data-bs-toggle="modal" data-bs-target="#deleteAllMessagesModal">
                                          <i class="fas fa-trash"></i> Delete All
                                      </button>

                                </div>
                                    <table id="myTable" class="table table-bordered table-hover table-stripe text-center w-100">
                                        <thead class="table-secondary">
                                            <tr>
                                                <th >Message ID</th>
                                                <th >Full Name</th>
                                                <th >Email</th>
                                                <th >Subject</th>
                                                <th >Message</th>
                                                <th >Date Sent</th>
                                                <th  width="auto">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                       
                                            <?php foreach ($messages as $message): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($message['id']); ?></td>
                                                    <td><?php echo htmlspecialchars($message['name']); ?></td>
                                                    <td><?php echo htmlspecialchars($message['email']); ?></td>
                                                    <td><?php echo htmlspecialchars($message['subject']); ?></td>
                                                    <td><?php echo htmlspecialchars($message['message']); ?></td>
                                                    <td><?php echo date("M d, Y h:i A", strtotime($message['date_sent'])); ?></td>
                                                    
                                                    <td>
                                                    <a href="#" class="btn btn-danger btn-sm deleteMessageBtn" 
                                                    data-message-id="<?php echo $message['id']; ?>" data-bs-toggle="modal" 
                                                    data-bs-target="#deleteMessageModal">
                                                        <i class="fas fa-trash"></i>
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

        <!-- Modal for Delete Confirmation -->
        <script>
    $(document).ready(function() {
        $('#myTable').DataTable({
           
        });
    });

    
</script>
        <script>
document.querySelectorAll('.deleteMessageBtn').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault(); // Prevent default form submission

        var messageId = this.getAttribute('data-message-id');

        Swal.fire({
            title: 'Are you sure?',
            text: 'You are about to delete this message!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, create a form and submit it
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'classes/delete_message.php';
                
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'delete_message_id';
                input.value = messageId;
                form.appendChild(input);
                
                document.body.appendChild(form);
                form.submit(); // Submit the form
            }
        });
    });
});

// For deleting all messages
document.querySelector('.deleteAllMessagesBtn').addEventListener('click', function(e) {
    e.preventDefault(); // Prevent default form submission

    Swal.fire({
        title: 'Are you sure?',
        text: 'You are about to delete all messages! This action cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Delete All',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // If confirmed, create a form and submit it
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = 'classes/delete_message.php';
            
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'delete_all';
            input.value = '1';
            form.appendChild(input);
            
            document.body.appendChild(form);
            form.submit(); // Submit the form
        }
    });
});
</script>
<?php
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
