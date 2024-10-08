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
                                <h3 class="fw-bold">Registered Users</h3>
                                      <button type="button" class="btn btn-success ms-auto btn-rounded me-1" onclick="location.reload(); return false;">
                                          <i class="fas fa-refresh"></i> Refresh
                                      </button>
                                      <button type="button" class="btn btn-danger btn-rounded" data-bs-toggle="modal" data-bs-target="#addItemModal">
                                          <i class="fas fa-trash"></i> Delete All
                                      </button>
                                </div>
                                    <table id="myTable" class="table-responsive table text-sm table-hover table-striped w-100">
                                        <thead class="table-secondary fw-bold">
                                            <tr>
                                            <th style="font-weight: bold;">User ID</th>
                                            <th style="font-weight: bold;">Full Name</th>
                                            <th style="font-weight: bold;">Email</th>
                                            <th style="font-weight: bold;">Username</th>
                                            <th style="font-weight: bold;">Status</th>
                                            <th style="font-weight: bold;">Date Created</th>
                                            <th style="font-weight: bold;">Last Login</th>
                                            <th style="font-weight: bold;" width="auto">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($registeredUsers as $user): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($user['user_id']); ?></td>
                                                    <td>
                                                        <img src="../uploads/<?php echo $user['user_photo'] ?: 'default_photo.jpg'; ?>" 
                                                            style="height: 35px;">  <?php echo htmlspecialchars($user['fullname']); ?>
                                                       
                                                    </td>
                                                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                                                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                                                    <td>
                                                        <?php if ($user['status'] == 'enabled'): ?>
                                                            <span class="badge bg-success">Enabled</span>
                                                        <?php else: ?>
                                                            <span class="badge bg-danger">Disabled</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo date("M d, Y h:i A", strtotime($user['date_created'])); ?></td>
                                                    <td><?php echo (empty($user['last_login'])) ? '' : date("M d, Y h:i A", strtotime($user['last_login'])); ?></td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm viewMemberBtn" 
                                                                data-bs-toggle="modal" data-bs-target="#viewMemberModal">
                                                            <i class="bi bi-search"></i>
                                                        </button>
                                                        <a href="#" class="btn btn-success btn-sm editMemberBtn" 
                                                          data-bs-toggle="modal" data-bs-target="#editMemberStatusModal">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-danger btn-sm deleteuserBtn" 
                                                          data-bs-toggle="modal" data-bs-target="#deleteuserBtn">
                                                            <i class="bi bi-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- /.card -->

                            </div> <!-- /.col -->
                        </div> 
                    </div>
                </div>

<!-- Edit Member Status Modal -->
<div class="modal fade" id="editMemberStatusModal" tabindex="-1" aria-labelledby="editMemberStatusModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editMemberStatusModalLabel">Edit User Status</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editMemberStatusForm" method="post" action="classes/update_user_status.php">
          <input type="hidden" id="editUserId" name="user_id">
          <div class="mb-3">
            <label for="editUserPhoto" class="form-label">User Photo</label>
            <div id="editUserPhotoContainer">
              <img id="editUserPhoto" src="" alt="User Photo" style="display: flex; margin:auto; width: 100px; height: 100px;">
            </div>
          </div>
          <div class="mb-3">
            <label for="editUserName" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="editUserName" readonly>
          </div>
          
          <div class="mb-3">
            <label for="editStatus" class="form-label">Status</label>
            <select class="form-select" id="editStatus" name="status">
              <option value="enabled">Enabled</option>
              <option value="disabled">Disabled</option>
            </select>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit Member Status Modal -->
<!-- Edit Member Status Modal -->
<div class="modal fade" id="editMemberStatusModal" tabindex="-1" aria-labelledby="editMemberStatusModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editMemberStatusModalLabel">Edit User Status</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editMemberStatusForm" method="post" action="classes/update_user_status.php">
          <input type="hidden" id="editUserId" name="user_id">
          <div class="mb-3">
            <label for="editUserPhoto" class="form-label">User Photo</label>
            <div id="editUserPhotoContainer">
              <img id="editUserPhoto" src="" alt="User Photo" style="display: flex; margin:auto; width: 100px; height: 100px;">
            </div>
          </div>
          <div class="mb-3">
            <label for="editUserName" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="editUserName" readonly>
          </div>
          
          <div class="mb-3">
            <label for="editStatus" class="form-label">Status</label>
            <select class="form-select" id="editStatus" name="status">
              <option value="enabled">Enabled</option>
              <option value="disabled">Disabled</option>
            </select>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- View Member Modal -->
<div class="modal fade" id="viewMemberModal" tabindex="-1" aria-labelledby="viewMemberModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-lg modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewMemberModalLabel">View User Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="viewUserName" class="form-label">Full Name</label>
          <input type="text" class="form-control" id="viewUserName" disabled>
        </div>
        <div class="mb-3">
          <label for="viewUserPhoto" class="form-label">User Photo</label>
          <div id="viewUserPhotoContainer">
            <img id="viewUserPhoto" src="" alt="User Photo" style="width: 100px; height: 100px;">
          </div>
        </div>
        <div class="mb-3">
          <label for="viewUserEmail" class="form-label">Email</label>
          <input type="text" class="form-control" id="viewUserEmail" disabled>
        </div>
        <div class="mb-3">
          <label for="viewUserUsername" class="form-label">Username</label>
          <input type="text" class="form-control" id="viewUserUsername" disabled>
        </div>
        <div class="mb-3">
          <label for="viewUserBirthday" class="form-label">Birthday</label>
          <input type="text" class="form-control" id="viewUserBirthday" disabled>
        </div>
        <div class="mb-3">
          <label for="viewUserStatus" class="form-label">Status</label>
          <input type="text" class="form-control" id="viewUserStatus" disabled>
        </div>
        <div class="mb-3">
          <label for="viewUserBio" class="form-label">Bio</label>
          <textarea class="form-control" id="viewUserBio" rows="3" disabled></textarea>
        </div>
        <div class="mb-3">
          <label for="viewUserAddress" class="form-label">Address</label>
          <input type="text" class="form-control" id="viewUserAddress" disabled>
        </div>
        <div class="mb-3">
          <label for="viewDateCreated" class="form-label">Date Created</label>
          <input type="text" class="form-control" id="viewDateCreated" disabled>
        </div>
        <div class="mb-3">
          <label for="viewDateUpdated" class="form-label">Date Updated</label>
          <input type="text" class="form-control" id="viewDateUpdated" disabled>
        </div>
        <div class="mb-3">
          <label for="viewLastLogin" class="form-label">Last Login</label>
          <input type="text" class="form-control" id="viewLastLogin" disabled>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


            </main>
        </div>
    </div>
    <?php include "includes/footer.php"; ?>
   <script>

$(document).on('click', '.editMemberBtn', function() {
    // Get the current row data
    var row = $(this).closest('tr');
    var userId = row.find('td:eq(0)').text().trim(); // Get the User ID
    
    // Use this to get the text after the image in the Full Name cell
    var userName = row.find('td:eq(1)').contents().filter(function() {
        return this.nodeType === Node.TEXT_NODE;
    }).text().trim(); // Get Full Name after the image

    var userPhoto = row.find('td:eq(1) img').attr('src'); // Get the User Photo source
    var userStatus = row.find('td:eq(4)').text().trim(); // Get the Status (Enabled/Disabled)

    // Set the data to the modal
    $('#editUserId').val(userId);
    $('#editUserPhoto').attr('src', userPhoto);
    $('#editUserName').val(userName);
    
    // Select the status in the dropdown
    if (userStatus === 'Enabled') {
        $('#editStatus').val('enabled');
    } else {
        $('#editStatus').val('disabled');
    }

    // Show the modal
    $('#editMemberStatusModal').modal('show');
});


   </script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
    // View Member Modal
    document.querySelectorAll('.viewMemberBtn').forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-id');
            const fullname = this.getAttribute('data-fullname');
            const photo = this.getAttribute('data-photo');
            const email = this.getAttribute('data-email');
            const username = this.getAttribute('data-username');
            const status = this.getAttribute('data-status');
            const dateCreated = this.getAttribute('data-date-created');
            const lastLogin = this.getAttribute('data-last-login');

            // Populate the modal fields
            document.getElementById('viewUserName').value = fullname;
            document.getElementById('viewUserPhoto').src = '../uploads/' + photo;
            document.getElementById('viewUserEmail').value = email;
            document.getElementById('viewUserUsername').value = username;
            document.getElementById('viewUserStatus').value = status;
            document.getElementById('viewDateCreated').value = dateCreated;
            document.getElementById('viewLastLogin').value = lastLogin;
        });
    });



    // Delete Member Modal
    document.querySelectorAll('.deleteuserBtn').forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-id');
            const fullname = this.getAttribute('data-fullname');
            const photo = this.getAttribute('data-photo');

            // Populate the modal fields
            document.getElementById('UserId').value = userId;
            document.getElementById('UserName').value = fullname;
            document.getElementById('UserPhoto').src = '../uploads/' + photo;
        });
    });
});

    </script>
</body>
</html>
