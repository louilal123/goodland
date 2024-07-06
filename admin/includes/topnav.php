
<nav class="app-header navbar navbar-expand bg-body "> 
                <div class="container-fluid ">
                    <ul class="navbar-nav">
                        <li class="nav-item1 mt-1 ms-1"> 
                            <a class="nav-link1 mb-2" data-lte-toggle="sidebar" href="#" role="button"> 
                            <i class="bi bi-list" style="margin: auto; color: #333;"></i> 
                        </a> 
                    </li>    
                    </ul> 
          
                    <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
           
              <ul
                class="dropdown-menu dropdown-menu-end"
                aria-labelledby="bd-theme-text"
                style="--bs-dropdown-min-width: 8rem;"
              >
                <li>
          </li>
          <li>
          </li>
          <li>
          </li>
        </ul>
      </li>
                       
                        <li class="nav-item dropdown"> <a class="nav-link" data-bs-toggle="dropdown" href="#"> <i class="bi bi-bell"></i> 
                        <!-- <span class="navbar-badge badge text-bg-danger">15</span> -->
                        </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end"> <span class="dropdown-item dropdown-header">15 Notifications</span>
                                <div class="dropdown-divider"></div> <a href="#" class="dropdown-item"> <i class="bi bi-envelope me-2"></i> 4 new messages
                                    <span class="float-end text-secondary fs-7">3 mins</span> </a>
                                <div class="dropdown-divider"></div> <a href="#" class="dropdown-item"> <i class="bi bi-people-fill me-2"></i> 8 friend requests
                                    <span class="float-end text-secondary fs-7">12 hours</span> </a>
                                <div class="dropdown-divider"></div> <a href="#" class="dropdown-item"> <i class="bi bi-file-earmark-fill me-2"></i> 3 new reports
                                    <span class="float-end text-secondary fs-7">2 days</span> </a>
                                <div class="dropdown-divider"></div> <a href="#" class="dropdown-item dropdown-footer">
                                    See All Notifications
                                </a>
                            </div>
                        </li> <!--end::Notifications Dropdown Menu--> <!--begin::Fullscreen Toggle-->
                      <li class="nav-item dropdown user-menu">
                          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                              <img src="<?php echo $adminDetails['admin_photo']; ?>" class="user-image rounded-circle shadow" style="width: 40px; height: 40px;">
                              <span class="d-none d-md-inline">  <?php echo $adminDetails['fullname']; ?></span>
                          </a>
                          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end" style="width: 200px !important;">
                              <li class="d-flex flex-column align-items-center text-center">
                                  <a class="dropdown-item text-center mt-2" href="#">
                                      <img class="logo" src="<?php echo $adminDetails['admin_photo']; ?>" style="width: 70px; height: 70px; border-radius: 50%;">
                                      <h4 class="mt-2 mb-0"><small><?php echo $adminDetails['fullname']; ?></small></h4>
                                      <p class="mt-2 mb-0" style=""><small><?php echo $adminDetails['role']; ?></small></p>
                              
                                  </a>
                              </li>
                              <li><hr class="dropdown-divider"></li>
                              <li><a class="dropdown-item text-start" href="profile.php"><i class="bi bi-person"></i> Profile</a></li>
                              <li><a class="dropdown-item mb-2" id="logout" href="#"><i class="bi bi-power"></i> Logout</a></li>
                          </ul>
                      </li>
                    </ul>
                </div> 
            </nav>

         
        