<?php include "classes/admindetails.php"; ?>
<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php"; ?>

<style>
    body {
        overflow: hidden;
    }
</style>
<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini">

    <div class="app-wrapper">

       <?php include "includes/sidebar.php"; ?>
        <div class="app-main-wrapper main-blur">
           <?php include "includes/topnav.php"; ?>
            <main class="app-main">
            <div class="app-content">
                <div class="container-fluid">
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="card mt-2">
                                <div class="card-body">
                                    <div class="d-flex mb-3">
                                        <h3 class="fw-bold">Website Visitors</h3>
                                        <button type="button" class="btn btn-success ms-auto me-1" onclick="location.reload(); return false;">
                                            <i class="fas fa-refresh"></i> Refresh
                                        </button>
                                        <button class="btn btn-danger" id="deleteAllBtn">
    <i class="fas fa-trash"></i> Delete All
</button>

                                    </div>
                                    <table id="myTable" class="table  table-hover table-striped text-center w-100">
                                        <thead class="bg-primary fw-bold">
                                            <tr>
                                            <th>Session ID</th>
                                            <th>Ip Addr</th>
                                                <th>User Agent</th>
                                                <th>Country</th>
                                                
                                                <th>Visit Time</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($visitors as $visitor): ?>
                                                <tr>
                                                <td><?php echo htmlspecialchars($visitor['session_id']); ?></td>
                                                <td><?php echo htmlspecialchars($visitor['ip_address']); ?></td> <!-- IP address column -->
                   
                                                <td><?php echo htmlspecialchars($visitor['user_agent']); ?></td>
                                                   
                                                    <td><?php echo htmlspecialchars($visitor['country']); ?></td>
                                                  
                                                    <td><?php echo date("M d, Y h:i A", strtotime($visitor['visit_time'])); ?></td>
                                                  
                                                    <td>
                                                        <a href="classes/delete_visitor.php?visitor_id=<?php echo $visitor['visitor_id']; ?>" class="btn btn-danger btn-sm deleteBtn">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                        <button class="btn btn-info btn-sm infoBtn" 
                            data-session-id="<?php echo htmlspecialchars($visitor['session_id']); ?>"
                            data-user-agent="<?php echo htmlspecialchars($visitor['user_agent']); ?>"
                            data-ip-address="<?php echo htmlspecialchars($visitor['ip_address']); ?>"  
                            data-country="<?php echo htmlspecialchars($visitor['country']); ?>"
                            data-visit-time="<?php echo date("M d, Y h:i A", strtotime($visitor['visit_time'])); ?>"
                            data-last-visit="<?php echo date("M d, Y h:i A", strtotime($visitor['last_visit'])); ?>"
                            data-visit-count="<?php echo htmlspecialchars($visitor['visit_count']); ?>"
                            data-visitor-id="<?php echo htmlspecialchars($visitor['visitor_id']); ?>">
                        <i class="fas fa-info-circle"></i> Info
                    </button>
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
    </main>

<!-- Modal for viewing visitor details -->
<div class="modal fade" id="visitorModal" tabindex="-1" aria-labelledby="visitorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="visitorModalLabel">Visitor Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Visitor Info -->
        <p><strong>IP Address:</strong> <span id="modalIpAddress"></span></p>
        <p><strong>Session ID:</strong> <span id="modalSessionId"></span></p>
        <p><strong>User Agent:</strong> <span id="modalUserAgent"></span></p>
        <p><strong>Country:</strong> <span id="modalCountry"></span></p>
        <p><strong>Visit Time:</strong> <span id="modalVisitTime"></span></p>
        <p><strong>Last Visit:</strong> <span id="modalLastVisit"></span></p>
        
        <!-- Messages Table -->
        <h6>Messages</h6>
        <p id="messagesNotice" class="text-muted"></p> <!-- No messages notice -->
        <table id="modalMessagesTable" class="table table-bordered">
          <thead>
            <tr>
              <th>Subject</th>
              <th>Message</th>
              <th>Date Sent</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>

        <!-- File Requests Table -->
        <h6>File Requests</h6>
        <p id="fileRequestsNotice" class="text-muted"></p> <!-- No file requests notice -->
        <table id="modalFileRequestsTable" class="table table-bordered">
          <thead>
            <tr>
              <th>File Title</th>
              <th>Email</th>
              <th>Request Date</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Attach event listeners to all "Info" buttons
        document.querySelectorAll('.infoBtn').forEach(button => {
            button.addEventListener('click', function () {
                const visitorId = this.getAttribute('data-visitor-id'); // Get visitor ID
                
                // Fetch data for messages and file requests using AJAX
                fetchMessagesAndFiles(visitorId);
                
                // Get data attributes from the clicked button
                const sessionId = this.getAttribute('data-session-id');
                const ipAddress = this.getAttribute('data-ip-address');
                const userAgent = this.getAttribute('data-user-agent');
                const country = this.getAttribute('data-country');
                const visitTime = this.getAttribute('data-visit-time');
                const lastVisit = this.getAttribute('data-last-visit');
                
                // Set the modal fields with the corresponding data
                document.getElementById('modalIpAddress').textContent = ipAddress;
                document.getElementById('modalSessionId').textContent = sessionId;
                document.getElementById('modalUserAgent').textContent = userAgent;
                document.getElementById('modalCountry').textContent = country;
                document.getElementById('modalVisitTime').textContent = visitTime;
                document.getElementById('modalLastVisit').textContent = lastVisit;

                // Show the modal
                new bootstrap.Modal(document.getElementById('visitorModal')).show();
            });
        });
    });

    function fetchMessagesAndFiles(visitorId) {
        // Fetch messages
        fetch('getMessages.php?visitor_id=' + visitorId)
            .then(response => response.json())
            .then(messages => {
                const messagesTableBody = document.getElementById('modalMessagesTable');
                const messagesNotice = document.getElementById('messagesNotice');
                messagesTableBody.innerHTML = ''; // Clear previous data
                if (messages.length === 0) {
                    messagesNotice.textContent = "This visitor has no messages yet.";
                } else {
                    messagesNotice.textContent = ""; // Clear "no messages" notice
                    messages.forEach(message => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td>${message.subject}</td>
                            <td>${message.message}</td>
                            <td>${new Date(message.date_sent).toLocaleString()}</td>
                        `;
                        messagesTableBody.appendChild(tr);
                    });
                }
            })
            .catch(error => console.error('Error fetching messages:', error));
        
        // Fetch file requests
        fetch('getFileRequests.php?visitor_id=' + visitorId)
            .then(response => response.json())
            .then(fileRequests => {
                const fileRequestsTableBody = document.getElementById('modalFileRequestsTable');
                const fileRequestsNotice = document.getElementById('fileRequestsNotice');
                fileRequestsTableBody.innerHTML = ''; // Clear previous data
                if (fileRequests.length === 0) {
                    fileRequestsNotice.textContent = "This visitor has no file requests yet.";
                } else {
                    fileRequestsNotice.textContent = ""; // Clear "no file requests" notice
                    fileRequests.forEach(request => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td>${request.title}</td> <!-- Assuming 'title' is the field in file requests -->
                            <td>${request.email}</td>
                            <td>${new Date(request.request_date).toLocaleString()}</td>
                        `;
                        fileRequestsTableBody.appendChild(tr);
                    });
                }
            })
            .catch(error => console.error('Error fetching file requests:', error));
    }
</script>


</body>

<?php include "includes/footer.php"; ?><script>
    
    
$(document).ready(function() {
    $('.deleteBtn').on('click', function(e) {
        e.preventDefault(); // Prevent default link behavior

        const href = $(this).attr('href'); // Get the href of the delete button (delete URL)

        // Trigger SweetAlert confirmation
        Swal.fire({
            title: 'Are you sure?',
            text: 'This visitor record and associated sessions will be deleted!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = href; // Redirect to delete_visitor.php if confirmed
            }
        });
    });
});
</script>
<script>
    $(document).ready(function() {
        $('#deleteAllBtn').on('click', function(e) {
            e.preventDefault(); // Prevent default button behavior

            // Trigger SweetAlert confirmation
            Swal.fire({
                title: 'Are you sure?',
                text: 'This will delete all records!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete All'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to delete_all.php to delete all records
                    window.location.href = 'classes/delete_all.php';
                }
            });
        });
    });
</script>





</html>
