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
                                  <h3 class="fw-bold">List of subscribers</h3>
                                      <button type="button" class="btn btn-sm btn-success ms-auto btn-rounded me-1" onclick="location.reload(); return false;">
                                          <i class="fas fa-refresh"></i> Refresh
                                      </button>
                                      <button type="button" class="btn btn-danger btn-rounded" data-bs-toggle="modal" data-bs-target="#deleteAllsubscribersModal">
                                          <i class="fas fa-trash"></i> Delete All
                                      </button>

                                </div>
                                    <table id="myTable" class="table table-bordered table-hover table-stripe text-center w-100">
                                        <thead class="table-secondary">
                                            <tr>
                                                <th>Subscriber ID</th>
                                                <th >Full Name</th>
                                                <th >Email</th>
                                                <th >Subject</th>
                                                <th >subscriber</th>
                                                <th >Date Sent</th>
                                                <th  width="auto">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <!-- SELECT `id`, `visitor_id`, `email`, `is_active`, `subscribed_at` FROM `subscriptions` WHERE 1 -->
                                            <?php foreach ($subscribers as $subscriber): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($subscriber['id']); ?></td>
                                                    <td><?php echo htmlspecialchars($subscriber['name']); ?></td>
                                                    <td><?php echo htmlspecialchars($subscriber['email']); ?></td>
                                                    <td><?php echo htmlspecialchars($subscriber['subject']); ?></td>
                                                    <td><?php echo htmlspecialchars($subscriber['subscriber']); ?></td>
                                                    <td><?php echo date("M d, Y h:i A", strtotime($subscriber['date_sent'])); ?></td>
                                                    
                                                    <td>
                                                    <a href="#" class="btn btn-danger btn-sm deletesubscriberBtn" 
                                                    data-subscriber-id="<?php echo $subscriber['id']; ?>" data-bs-toggle="modal" 
                                                    data-bs-target="#deletesubscriberModal">
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
document.querySelectorAll('.deletesubscriberBtn').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault(); // Prevent default form submission

        var subscriberId = this.getAttribute('data-subscriber-id');

        Swal.fire({
            title: 'Are you sure?',
            text: 'You are about to delete this subscriber!',
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
                form.action = 'classes/delete_subscriber.php';
                
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'delete_subscriber_id';
                input.value = subscriberId;
                form.appendChild(input);
                
                document.body.appendChild(form);
                form.submit(); // Submit the form
            }
        });
    });
});

// For deleting all subscribers
document.querySelector('.deleteAllsubscribersBtn').addEventListener('click', function(e) {
    e.preventDefault(); // Prevent default form submission

    Swal.fire({
        title: 'Are you sure?',
        text: 'You are about to delete all subscribers! This action cannot be undone.',
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
            form.action = 'classes/delete_subscriber.php';
            
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

</body>
</html>
