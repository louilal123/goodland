<style>
   
    .app-main{
    background: rgba(108, 117, 125, 0.2) !important; 
}
body{
        overflow: hidden !important;
    }

</style>
<nav class="app-header navbar navbar-expand bg-white" > <!--begin::Container-->
                <div class="container-fluid" style="border: 0px !important;"> <!--begin::Start Navbar Links-->
                    <ul class="navbar-nav">
                        <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> <i class="fas fa-bars"></i> </a> </li>
                        <li class="nav-item d-none d-md-block"> <a href="#" class="nav-link"></a> </li>
                       
                    </ul>
        <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown  me-3"> 
                       <a class="nav-link" data-bs-toggle="dropdown" href="#"> 
                            <i class="fas fa-envelope fa-lg"></i> 
                            <span class="badge rounded-pill badge-notification bg-danger"><?php echo htmlspecialchars($unread_msgs_count) ?? ''; ?></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-4 bg-white" style="width: 800px !important;">
                                <div class="d-flex justify-content-between align-items-center w-100">
                                    <h4 class="fw-bold text-dark">New Messages</h4>
                                    <h4><span class="fas fa-envelope fa-lg"></span></h4>
                                </div>

                            <div class="dropdown-divider"></div>
                            
                          <?php if (!empty($unread_msgs)): ?>
                                <?php foreach ($unread_msgs as $message): ?>
                                    <a href="#" class="dropdown-item" data-timestamp="<?= htmlspecialchars($message['date_sent']); ?>">
                                        <div class="d-flex">
                                            <div class="flex-grow-1 bg-secondary">
                                                <h3 class="dropdown-item-title">
                                                    <?= htmlspecialchars($message['name']); ?>
                                                    <span class="float-end fs-7 text-danger"><i class="fas fa-star-fill"></i></span>
                                                </h3>
                                                <p class="fs-7"><?= htmlspecialchars($message['message']); ?></p>
                                                <p class="fs-7 text-secondary  d-flex justify-content-end time-ago" data-datesent="<?= $message['date_sent']; ?>"></p>
                                            </div>
                                        </div> 
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <div class="dropdown-divider"></div> 
                            <a href="messages.php" class="btn btn-rounded btn-primary d-flex justify-content-center">See All Messages</a>
                      
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="dropdown-item d-flex justify-content-center p-4">No unread messages</p>
                            <?php endif; ?>

                            
                              </div>

                    </li> 
                    <li class="nav-item dropdown  me-3"> 
                       <a class="nav-link" data-bs-toggle="dropdown" href="#"> 
                            <i class="fas fa-bell fa-lg"></i> 
                            <span class="badge rounded-pill badge-notification bg-danger">1</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-4" style="width: 800px !important;">
                                <div class="d-flex justify-content-between align-items-center w-100">
                                    <h4 class="fw-bold text-primary"> Notification</h4>
                                    <span class="fas fa-bell fa-lg"></span>
                                </div>

                            <div class="dropdown-divider"></div>
                            
                            <a href="#" class="dropdown-item"> <!--begin::Message-->
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h3 class="dropdown-item-title">
                                            Brad Diesel
                                            <span class="float-end fs-7 text-danger"><i class="fas fa-star-fill"></i></span>
                                        </h3>
                                        <p class="fs-7">Call me whenever you can...</p>
                                        <p class="fs-7 text-secondary"> <i class="fas fa-clock me-1"></i> 4 Hours Ago</p>
                                    </div>
                                </div> 
                            </a>
                            
                            <div class="dropdown-divider"></div> 
                            <a href="#" class="dropdown-item dropdown-footer text-primary justify-content-center">See All Notification</a>
                        </div>

                    </li> 

            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="<?php echo htmlspecialchars($adminDetails['admin_photo']) ?: 'default_photo.jpg'; ?>" class="user-image rounded-circle shadow" style="width: 40px; height: 40px;">
                    <span class="d-none d-md-inline"> <?php echo htmlspecialchars($adminDetails['fullname']); ?></span> 
                    <i class="fas fa-chevron-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end" style="width: 300px !important;">
                    <li class="d-flex flex-column align-items-center text-center">
                        <a class="dropdown-item text-center mt-2" href="#">
                            <img class="logo" src="<?php echo htmlspecialchars($adminDetails['admin_photo']) ?: 'default_photo.jpg'; ?>" style="width: 70px; height: 70px; border-radius: 50%;">
                            <h4 class="mt-2 mb-0"><small><?php echo htmlspecialchars($adminDetails['fullname']); ?></small></h4>
                            <p class="mt-2 mb-0"><small><?php echo htmlspecialchars($adminDetails['role']); ?></small></p>
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-start" href="profile.php"><i class="fa fas-person"></i> Profile</a></li>
                    <li><a class="dropdown-item mb-2" href="classes/logout.php"><i class="fa fas-power"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header text-bg-danger">
                <h4 class="modal-title" id="addItemModalLabel">Confirm Logout</h4>
            </div>
            <div class="modal-body">
                <h4>Are you sure you want to logout?</h4>
                <div class="modal-footer mt-4">
                    <button type="button" class="btn btn-secondary btn-outline-danger custombtn" data-bs-dismiss="modal">Cancel</button>
                    <a href="classes/logout.php" class="btn btn-danger btn-outline">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
   function timeAgoFromDatesent(datesent) {
    const now = new Date();
    const sentDate = new Date(datesent);
    
    const secondsPast = Math.floor((now.getTime() - sentDate.getTime()) / 1000);
    
    if (secondsPast < 60) {
        return `${secondsPast} second${secondsPast !== 1 ? 's' : ''} ago`;
    } else if (secondsPast < 3600) {
        const minutes = Math.floor(secondsPast / 60);
        return `${minutes} minute${minutes !== 1 ? 's' : ''} ago`;
    } else if (secondsPast < 86400) {
        const hours = Math.floor(secondsPast / 3600);
        return `${hours} hour${hours !== 1 ? 's' : ''} ago`;
    } else if (secondsPast < 2592000) { // Less than 30 days
        const days = Math.floor(secondsPast / 86400);
        return `${days} day${days !== 1 ? 's' : ''} ago`;
    } else {
        // If older than 30 days, show the actual date
        return sentDate.toLocaleDateString();
    }
}

function updateTimes() {
    const elements = document.querySelectorAll('.time-ago');
    elements.forEach(function (element) {
        const datesent = element.getAttribute('data-datesent');
        if (datesent) {
            element.textContent = timeAgoFromDatesent(datesent);
        }
    });
}

// Update time ago on page load
updateTimes();

// Optional: You can also call this function periodically to update times in real-time
setInterval(updateTimes, 60000); // Update every 60 seconds

</script>

<script>
import { Input, Ripple, initMDB } from "mdb-ui-kit";
initMDB({ Input, Ripple });
initMDB({ Modal, Ripple });
initMDB({ Modal, Ripple });
</script>
