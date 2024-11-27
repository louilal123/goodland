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
                                      
                                      <button type="button" class="btn btn-danger btn-rounded ms-auto btn-rounded" data-bs-toggle="modal" data-bs-target="#deleteAllMessagesModal">
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

                                                    <button class="btn btn-success btn-sm viewMessageBtn" 
                                                            data-message-id="<?php echo htmlspecialchars($message['id']); ?>" 
                                                            data-name="<?php echo htmlspecialchars($message['name']); ?>" 
                                                            data-email="<?php echo htmlspecialchars($message['email']); ?>" 
                                                            data-subject="<?php echo htmlspecialchars($message['subject']); ?>" 
                                                            data-message="<?php echo htmlspecialchars($message['message']); ?>" 
                                                            data-date-sent="<?php echo date("M d, Y h:i A", strtotime($message['date_sent'])); ?>">
                                                        <i class="fas fa-eye"></i> View
                                                    </button>



                                                    <a href="#" class="btn btn-danger btn-sm deleteMessageBtn" 
                                                    data-message-id="<?php echo $message['id']; ?>" data-bs-toggle="modal" 
                                                    data-bs-target="#deleteMessageModal">
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
        
        <!-- Modal for Delete Confirmation -->
        <div class="modal fade" id="viewMessageModal" tabindex="-1" aria-labelledby="viewMessageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewMessageModalLabel">Message Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Name:</strong> <span id="modalName"></span></p>
                        <p><strong>Email:</strong> <span id="modalEmail"></span></p>
                        <p><strong>Subject:</strong> <span id="modalSubject"></span></p>
                        <p><strong>Date Sent:</strong> <span id="modalDateSent"></span></p>
                        <p><strong>Message:</strong> <p id="modalMessage"></p>
                        </p>
                    
                        <!-- Reply Section -->
                        <form action="classes/send_reply.php" method="POST">
    <input type="hidden" id="replyMessageId" name="id"> <!-- Updated name to "id" -->
    <input type="hidden" id="replyEmail" name="email">
    <div class="mb-3">
        <label for="replyMessage" class="form-label"><strong>Your Reply</strong></label>
        <textarea class="form-control" id="replyMessage" name="reply_message" rows="4" required></textarea>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-end">Send Reply</button>
    </div>
</form>

                    </div>
                </div>
            </div>
        </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


        <script>
    $(document).ready(function() {
        $('#myTable').DataTable({
           
        });
    });

    
</script>
       
<script>
   document.querySelectorAll('.viewMessageBtn').forEach(button => {
    button.addEventListener('click', function () {
        const messageId = this.getAttribute('data-message-id');
        const name = this.getAttribute('data-name');
        const email = this.getAttribute('data-email');
        const subject = this.getAttribute('data-subject');
        const message = this.getAttribute('data-message');
        const dateSent = this.getAttribute('data-date-sent');

        // Populate modal fields
        document.getElementById('modalName').textContent = name;
        document.getElementById('modalEmail').textContent = email;
        document.getElementById('modalSubject').textContent = subject;
        document.getElementById('modalMessage').textContent = message;
        document.getElementById('modalDateSent').textContent = dateSent;
        document.getElementById('replyMessageId').value = messageId;

        // Show the modal
        new bootstrap.Modal(document.getElementById('viewMessageModal')).show();
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
