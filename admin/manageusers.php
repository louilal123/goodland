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
                <div class="app-content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="mb-0">Manage Registered Users</h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Registered Users</li>
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
                                    <div class="card-header d-flex">
                                        <h3 class="card-title mb-0">List of Registered Users</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="container-fluid">
                                            <table id="myTable" class="table-responsive table table-hover table-striped w-100">
                                                <thead>
                                                    <tr>
                                                        <th>User ID</th>
                                                        <th>Full Name</th>
                                                        <th>Email</th>
                                                        <th>Username</th>
                                                        <th>Birthday</th>
                                                        <th>Status</th>
                                                        <th>User Photo</th>
                                                        <th>Bio</th>
                                                        <th>Address</th>
                                                        <th>Date Created</th>
                                                        <th>Date Updated</th>
                                                        <th>Last Login</th>
                                                        <th width="170px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($registeredUsers as $user): ?>
                                                        <tr>
                                                            <td><?php echo htmlspecialchars($user['user_id']); ?></td>
                                                            <td><?php echo htmlspecialchars($user['fullname']); ?></td>
                                                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                                                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                                                            <td><?php echo htmlspecialchars($user['birthday']); ?></td>
                                                            <td>
                                                            <?php if ($user['status'] == 'enabled'): ?>
                                                                <span class="badge bg-success">Enabled</span>
                                                            <?php else: ?>
                                                                <span class="badge bg-danger">Disabled</span>
                                                            <?php endif; ?>
                                                            </td>
                                                            <td><img src="<?php echo $user['user_photo'] ?? '../uploads/default_photo.jpg'; ?>" alt="" style="width: 40px; height: 40px;"></td>
                                                            <td><?php echo htmlspecialchars($user['bio']); ?></td>
                                                            <td><?php echo htmlspecialchars($user['address']); ?></td>
                                                            <td><?php echo date("M d, Y h:i A", strtotime($user['date_created'])); ?></td>
                                                            <td><?php echo date("M d, Y h:i A", strtotime($user['date_updated'])); ?></td>
                                                            <td><?php echo date("M d, Y h:i A", strtotime($user['last_login'])); ?></td>
                                                            <td>
                                                                <button class="btn btn-info btn-sm viewMemberBtn" data-bs-toggle="modal" data-bs-target="#viewMemberModal"><i class="bi bi-eye"></i></button>
                                                                <a href="#" class="btn btn-success btn-sm editMemberBtn" data-bs-toggle="modal" data-bs-target="#editMemberModal"><i class="bi bi-pencil"></i></a>
                                                                <a href="classes/delete_member.php?id=<?=$user['user_id']; ?>" class="btn btn-danger btn-sm deleteMemberBtn"><i class="bi bi-trash"></i></a>
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

                <!-- View Member Modal -->
                <div class="modal fade" id="viewMemberModal" tabindex="-1" aria-labelledby="viewMemberModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="viewMemberModalLabel">View User Details</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="viewMemberForm">
                                    <div class="row">
                                        <div class="col">
                                            <label for="photo1" class="form-label">User Photo</label>
                                            <img id="photo1" class="img-fluid mt-2" src="" style="display: flex; flex-direction: column; margin: auto; height: 200px; width: 200px; border-radius: 200px;">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="user_id1" class="form-label">User ID</label>
                                            <input type="text" class="form-control" id="user_id1" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="fullname1" class="form-label">Full Name</label>
                                            <input type="text" class="form-control" id="fullname1" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="email1" class="form-label">Email</label>
                                            <input type="text" class="form-control" id="email1" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="username1" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="username1" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="birthday1" class="form-label">Birthday</label>
                                            <input type="text" class="form-control" id="birthday1" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="status1" class="form-label">Status</label>
                                            <input type="text" class="form-control" id="status1" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="bio1" class="form-label">Bio</label>
                                            <textarea class="form-control" id="bio1" readonly></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="address1" class="form-label">Address</label>
                                            <textarea class="form-control" id="address1" readonly></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="date_created1" class="form-label">Date Created</label>
                                            <input type="text" class="form-control" id="date_created1" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="date_updated1" class="form-label">Date Updated</label>
                                            <input type="text" class="form-control" id="date_updated1" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="last_login1" class="form-label">Last Login</label>
                                            <input type="text" class="form-control" id="last_login1" readonly>
                                        </div>
                                    </div>
                                    <div class="modal-footer mt-4">
                                        <button type="button" class="btn btn-secondary custombtn" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Member Modal -->
                <div class="modal fade" id="editMemberModal" tabindex="-1" aria-labelledby="editMemberModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="editMemberModalLabel">Edit Member</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="classes/$registeredUsers_crud.php" method="POST" id="editMemberForm" enctype="multipart/form-data">
                                    <input type="hidden" name="user_id" id="user_id2">
                                    <div class="row">
                                        <div class="col">
                                            <label for="photo2" class="form-label">User Photo</label>
                                            <input type="file" class="form-control" id="photo2" name="user_photo">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="fullname2" class="form-label">Full Name</label>
                                            <input type="text" class="form-control" id="fullname2" name="fullname">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="email2" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email2" name="email">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="username2" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="username2" name="username">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="birthday2" class="form-label">Birthday</label>
                                            <input type="date" class="form-control" id="birthday2" name="birthday">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="status2" class="form-label">Status</label>
                                            <select class="form-control" id="status2" name="status">
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="bio2" class="form-label">Bio</label>
                                            <textarea class="form-control" id="bio2" name="bio"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="address2" class="form-label">Address</label>
                                            <textarea class="form-control" id="address2" name="address"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer mt-4">
                                        <button type="button" class="btn btn-secondary custombtn" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="editRegisteredUsers" class="btn btn-primary custombtn">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>
    <?php include "includes/footer.php"; ?>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="dist/js/adminlte.min.js"></script>
    <script src="dist/js/script.js"></script>

    <script>
        $(document).ready(function() {
            $('.viewMemberBtn').click(function() {
                var tr = $(this).closest('tr');
                $('#user_id1').val(tr.find('td:eq(0)').text());
                $('#fullname1').val(tr.find('td:eq(1)').text());
                $('#email1').val(tr.find('td:eq(2)').text());
                $('#username1').val(tr.find('td:eq(3)').text());
                $('#birthday1').val(tr.find('td:eq(4)').text());
                $('#status1').val(tr.find('td:eq(5)').text());
                $('#bio1').val(tr.find('td:eq(7)').text());
                $('#address1').val(tr.find('td:eq(8)').text());
                $('#date_created1').val(tr.find('td:eq(9)').text());
                $('#date_updated1').val(tr.find('td:eq(10)').text());
                $('#last_login1').val(tr.find('td:eq(11)').text());
                var photo = tr.find('td:eq(6) img').attr('src');
                $('#photo1').attr('src', photo);
            });

            $('.editMemberBtn').click(function() {
                var tr = $(this).closest('tr');
                $('#user_id2').val(tr.find('td:eq(0)').text());
                $('#fullname2').val(tr.find('td:eq(1)').text());
                $('#email2').val(tr.find('td:eq(2)').text());
                $('#username2').val(tr.find('td:eq(3)').text());
                $('#birthday2').val(tr.find('td:eq(4)').text());
                $('#status2').val(tr.find('td:eq(5)').text());
                $('#bio2').val(tr.find('td:eq(7)').text());
                $('#address2').val(tr.find('td:eq(8)').text());
            });
        });
    </script>
</body>
</html>
