
<?php $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/")+1); ?>

<aside class="app-sidebar bg-body-light light" data-bs-theme="light"> 
            <div class="sidebar-brand"> <!--begin::Brand Link-->
                 <a href="../index.html" class="brand-link"> 
                    <!--begin::Brand Image--> 
                    <img src="dist/assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow"> 
                    <!--end::Brand Image--> <!--begin::Brand Text--> 
                    <span class="brand-text"><span class="fw-bold text-info">GOOD</span><span class="fw-light text-info">Land</span></span> <!--end::Brand Text--> </a> <!--end::Brand Link--> </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
            <div class="sidebar-wrapper">
                <nav class="mt-2"> <!--begin::Sidebar Menu-->
                <li class="nav-item"> <a href="dashboard" class="nav-link <?= $page == 'dashboard.php' ? '  bg-primary bg-primary1 ':'' ?>"> 
                    <i class="nav-icon fas fa-dashboard"></i>
                                <p class="text">Dashboard</p>
                            </a> </li>
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon fas fa-dashboard"></i>
                                <p>
                                    Dashboard
                                    <i class="nav-arrow fas fa-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"> <a href="../index.html" class="nav-link"> <i class="nav-icon fas fa-circle"></i>
                                        <p>Dashboard v1</p>
                                    </a> </li>
                                <li class="nav-item"> <a href="../index2.html" class="nav-link"> <i class="nav-icon fas fa-circle"></i>
                                        <p>Dashboard v2</p>
                                    </a> </li>
                                <li class="nav-item"> <a href="../index3.html" class="nav-link"> <i class="nav-icon fas fa-circle"></i>
                                        <p>Dashboard v3</p>
                                    </a> </li>
                            </ul>
                        </li>
                       
                        
                        
                       
                        <li class="nav-header">MULTI LEVEL EXAMPLE</li>
                        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon fas fa-circle-fill"></i>
                                <p>Level 1</p>
                            </a> </li>
                        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon fas fa-circle-fill"></i>
                                <p>
                                    Level 1
                                    <i class="nav-arrow fas fa-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon fas fa-circle"></i>
                                        <p>Level 2</p>
                                    </a> </li>
                                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon fas fa-circle"></i>
                                        <p>
                                            Level 2
                                            <i class="nav-arrow fas fa-chevron-right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon fas fa-record-circle-fill"></i>
                                                <p>Level 3</p>
                                            </a> </li>
                                        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon fas fa-record-circle-fill"></i>
                                                <p>Level 3</p>
                                            </a> </li>
                                        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon fas fa-record-circle-fill"></i>
                                                <p>Level 3</p>
                                            </a> </li>
                                    </ul>
                                </li>
                                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon fas fa-circle"></i>
                                        <p>Level 2</p>
                                    </a> </li>
                            </ul>
                        </li>
                        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon fas fa-circle-fill"></i>
                                <p>Level 1</p>
                            </a> </li>
                        <li class="nav-header">LABELS</li>
                        
                        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon fas fa-circle text-warning"></i>
                                <p>Warning</p>
                            </a> </li>
                        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon fas fa-circle text-info"></i>
                                <p>Informational</p>
                            </a> </li>
                    </ul> <!--end::Sidebar Menu-->
                </nav>
            </div> <!--end::Sidebar Wrapper-->
        </aside> <!--end::Sidebar-->