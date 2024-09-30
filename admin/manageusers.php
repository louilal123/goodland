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
                <div class="app-content-header">
                    <div class="container-fluid">
                        <div class="row">
                        <div class="col-sm-6">
                                <h3 class="mb-0">Manage Contributors</h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Contributors</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="app-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4 card-outline-primary">
                                  
                                    <div class="card-body">
                                        <div class="container-fluid">
                                            <table id="myTable" class="table-responsive table table-hover table-striped w-100">
                                                <thead>
                                                    <tr>
                                                        <th>User ID</th>
                                                        <th>Full Name</th>
                                                        <th>Email</th>
                                                        <th>Username</th>
                                                        <th>Status</th>
                                                        <th>Date Created</th>
                                                        <th>Last Login</th>
                                                        <th width="170px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($registeredUsers as $user): ?>
                                                        <tr>
                                                            <td><?php echo htmlspecialchars($user['user_id']); ?></td>
                                                            <td><img src="../uploads/<?php echo $user['user_photo'] ?: 'default_photo.jpg'; ?>" alt="" style="width: 40px; height: 40px;"> <?php echo htmlspecialchars($user['fullname']); ?></td>
                                                            <td>
                                                              <?php echo htmlspecialchars($user['email']); ?></td>
                                                            <td>  <img src="../assets/flags/<?php echo $user['country_flag'] . '.png'; ?> " 
                                                            alt="" style="width: 20px; height: 20px;">  <?php echo htmlspecialchars($user['username']); ?></td>
                                                            <td>
                                                            <?php if ($user['status'] == 'enabled'): ?>
                                                                <span class="badge bg-success">Enabled</span>
                                                            <?php else: ?>
                                                                <span class="badge bg-danger">Disabled</span>
                                                            <?php endif; ?>
                                                            </td>
                                                            <td><?php echo date("M d, Y h:i A", strtotime($user['date_created'])); ?></td>
                                                            <td>
                                                              <?php 
                                                              echo (empty($user['last_login'])) ? '' : date("M d, Y h:i A", strtotime($user['last_login'])); 
                                                              ?>
                                                          </td>

                                                            <td>
                                                                <button class="btn btn-info btn-sm viewMemberBtn" 
                                                                data-bs-toggle="modal" data-bs-target="#viewMemberModal"><i class="bi bi-search"></i></button>
                                                                <a href="#" class="btn btn-success btn-sm editMemberBtn" 
                                                                data-bs-toggle="modal" data-bs-target="#editMemberStatusModal">
                                                                <i class="bi bi-pencil-square"></i></a>
                                                                <a href="#" class="btn btn-danger btn-sm deleteuserBtn"
                                                                  data-bs-toggle="modal" 
                                                                  data-bs-target="#deleteuserBtn"> 
                                                                  <i class="bi bi-trash"></i>
                                                                </a>

                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
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
<div class="modal fade" id="deleteuserBtn" tabindex="-1" aria-labelledby="editMemberStatusModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editMemberStatusModalLabel">Confirm?</h5>
        <p>All data related to this user will be deleted.</p>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editMemberStatusForm" method="post" action="classes/delete_user.php">
          <input type="hidden" id="UserId" name="user_id">
          <div class="mb-3">
            <label for="editUserPhoto" class="form-label">User Photo</label>
            <div id="editUserPhotoContainer">
              <img id="UserPhoto" src="" alt="User Photo" style="display: flex; margin:auto; width: 100px; height: 100px;">
            </div>
          </div>
          <div class="mb-3">
            <label for="UserName" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="UserName" readonly>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i> Delete</button>
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
   
</body>
</html>
