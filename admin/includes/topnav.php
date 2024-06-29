
<nav class="app-header navbar navbar-expand bg-body "> 
                <div class="container-fluid ">
                    <ul class="navbar-nav">
                        <li class="nav-item"> <a class="nav-link mb-2" data-lte-toggle="sidebar" href="#" role="button"> 
                            <i class="bi bi-list" style="font-weight: bold; font-size: 20px; "></i> 
                    </a> </li>
                        
                        </ul> 
          
                    <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
              <button
                class="btn btn-link nav-link py-2 px-0 px-lg-2 dropdown-toggle d-flex align-items-center"
                id="bd-theme"
                type="button"
                aria-expanded="false"
                data-bs-toggle="dropdown"
                data-bs-display="static"
              >
                <span class="theme-icon-active">
                  <i class="my-1"></i>
                </span>
                <span class="d-lg-none ms-2" id="bd-theme-text">Toggle theme</span>
              </button>
              <ul
                class="dropdown-menu dropdown-menu-end"
                aria-labelledby="bd-theme-text"
                style="--bs-dropdown-min-width: 8rem;"
              >
                <li>
              <button
              type="button"
              class="dropdown-item d-flex align-items-center active"
              data-bs-theme-value="light"
              aria-pressed="false"
            >
              <i class="bi bi-sun-fill me-2"></i>
              Light
              <i class="bi bi-check-lg ms-auto d-none"></i>
            </button>
          </li>
          <li>
            <button
              type="button"
              class="dropdown-item d-flex align-items-center"
              data-bs-theme-value="dark"
              aria-pressed="false"
            >
              <i class="bi bi-moon-fill me-2"></i>
              Dark
              <i class="bi bi-check-lg ms-auto d-none"></i>
            </button>
          </li>
          <li>
            <button
              type="button"
              class="dropdown-item d-flex align-items-center"
              data-bs-theme-value="auto"
              aria-pressed="true"
            >
              <i class="bi bi-circle-fill-half-stroke me-2"></i>
              Auto
              <i class="bi bi-check-lg ms-auto d-none"></i>
            </button>
          </li>
        </ul>
      </li>
                       
                        <li class="nav-item dropdown"> <a class="nav-link" data-bs-toggle="dropdown" href="#"> <i class="bi bi-bell-fill"></i> 
                        <span class="navbar-badge badge text-bg-danger">15</span> </a>
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
                        <li class="nav-item"> 
                          <a class="nav-link" href="#" data-lte-toggle="fullscreen"> <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i> 
                          <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i> </a> </li> 
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

                          <!-- <ul class="dropdown-menu dropdown-menu-end">
                              <li class="user-header text-bg-primary">
                                  <img src="<?php //echo $adminDetails['admin_photo']; ?>" class="rounded-circle shadow" alt="User Image">
                                  <p>
                                  
                                      <small><?php //echo $adminDetails['role']; ?></small>
                                  </p>
                              </li>
                              <li class="user-footer">
                                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                                  <a id="logout" class="btn btn-default btn-flat float-end">Sign out</a>
                              </li>
                          </ul> -->
                      </li>
                    </ul>
                </div> 
            </nav>

         
        