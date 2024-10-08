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
                        <div class="row mt-4">
                            <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                <div class="card-header d-flex ">
                                  <h3 class="fw-bold">List of Messages</h3>
                                      <button type="button" class="btn btn-success ms-auto btn-rounded me-1" onclick="location.reload(); return false;">
                                          <i class="fas fa-refresh"></i> Refresh
                                      </button>
                                      <button type="button" class="btn btn-danger btn-rounded" data-bs-toggle="modal" data-bs-target="#deleteAllMessagesModal">
    <i class="fas fa-trash"></i> Delete All
</button>

                                </div>
                                    <table id="myTable" class="table-responsive table text-sm table-hover table-striped w-100">
                                        <thead class="table-secondary fw-bold">
                                            <tr>
                                                <th style="font-weight: bold;">Message ID</th>
                                                <th style="font-weight: bold;">Full Name</th>
                                                <th style="font-weight: bold;">Email</th>
                                                <th style="font-weight: bold;">Subject</th>
                                                <th style="font-weight: bold;">Message</th>
                                                <th style="font-weight: bold;">Date Sent</th>
                                                <th style="font-weight: bold;" width="auto">Action</th>
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
<!-- Modal for Individual Delete Confirmation -->
<div class="modal fade" id="deleteMessageModal" data-mdb-backdrop="static" data-mdb-keyboard="false" tabindex="-1" aria-labelledby="deleteMessageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="deleteMessageModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body fw-bold">
        Are you sure you want to delete this message?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-rounded" data-mdb-dismiss="modal"> <span class="fas fa-x"></span> Cancel</button>
        <form method="POST" action="classes/delete_message.php">
          <input type="hidden" name="delete_message_id" id="delete_message_id">
          <button type="submit" class="btn btn-danger btn-rounded "> <span class="fas fa-trash"></span> Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal for Deleting All Messages -->
<div class="modal fade" id="deleteAllMessagesModal" data-mdb-backdrop="static" data-mdb-keyboard="false" tabindex="-1" aria-labelledby="deleteAllMessagesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAllMessagesModalLabel">Confirm Deletion of All Messages</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete all messages? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Cancel</button>
                <form method="POST" action="classes/delete_message.php">
                    <input type="hidden" name="delete_all" value="1">
                    <button type="submit" class="btn btn-danger">Delete All</button>
                </form>
            </div>
        </div>
    </div>
</div>




            </main>
        </div>
    </div>
    <?php include "includes/footer.php"; ?>
  
    <script>
document.querySelectorAll('.deleteMessageBtn').forEach(button => {
    button.addEventListener('click', function() {
        var messageId = this.getAttribute('data-message-id');
        document.getElementById('delete_message_id').value = messageId;
        document.getElementById('delete_all').value = ''; // Clear the delete all flag
        document.getElementById('modal-body-text').textContent = 'Are you sure you want to delete this message?';
    });
});

// For deleting all messages
document.querySelector('.deleteAllMessagesBtn').addEventListener('click', function() {
    document.getElementById('delete_message_id').value = ''; // Clear individual message ID
    document.getElementById('delete_all').value = 'true'; // Set flag for deleting all
    document.getElementById('modal-body-text').textContent = 'Are you sure you want to delete all messages?';
});
</script>

</body>
</html>
