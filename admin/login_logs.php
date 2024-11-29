<?php include "classes/admindetails.php"; ?>
<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php"; ?>
<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary">

<div class="app-wrapper">
    <?php include "includes/sidebar.php"; ?>
    <div class="app-main-wrapper">
        <?php include "includes/topnav.php"; ?>
        <main class="app-main">
    <div class="app-content flat">
        <div class="container-fluid">
            <div class="row" style="min-height: 80vh;">
                <div class="col-md-12">
                  
                    <!-- Login History Section -->
                    <div class="card mt-4 mb-4">
                        <div class="card-header">
                            <h4>Login History</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <div class="table-responsive">
        
<?php $current_ip = $_SERVER['REMOTE_ADDR'];?>
                            <table class="table table-striped">
                              <thead>
                                  <tr>
                                      <th>Full Name</th>
                                      <th>Email</th>
                                      
                                     
                                      <th>IP Address</th>
                                      <th>User Agent</th>
                                      <th>Login Time</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php foreach ($loginLogs as $log): ?>
                                      <tr>
                                          <td><?php echo htmlspecialchars($log['fullname']); ?></td>
                                          <td><?php echo htmlspecialchars($log['admin_email']); ?></td>
                                         
                                          <td><?php echo htmlspecialchars($log['ip_address']); ?>   <?php if ($log['ip_address'] === $current_ip): ?>
                                                  <span class="badge bg-success">This device</span>
                                              <?php endif; ?></td>
                                          <td><?php echo htmlspecialchars($log['user_agent']); ?></td>
                                          <td><?php echo date("M d, Y h:i A", strtotime($log['login_time'])); ?></td>
                                         
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
    </div>
</main>

    </div>
</div>


<?php include "includes/footer.php"; ?>
</body>
</html>
