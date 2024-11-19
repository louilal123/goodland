<style>
    .main{
    background: rgba(108, 117, 125, 0.5) !important; 
}
.sidebar-wrapper {
        padding: 0; /* Remove any padding */
        margin: 0; /* Remove any margin */
        font-family:sans-serif;
    }

    .nav-sidebar {
        padding: 0; /* Ensure no padding on the sidebar */
    }
.nav-link {
        border-radius: 0 !important; /* Remove rounded edges */
        display: block; /* Ensure the link behaves like a block element */
        width: 100%; /* Occupy full width */
    }
    .sidebar-wrapper.collapsed .nav-link {
        padding: 0 rem; /* Adjust padding when collapsed to minimize space */
    }
 
    .sidebar-mini.sidebar-collapse .sidebar-menu .nav-link{
        width: 100%;
    }
    .sidebar-wrapper .nav-icon {
        display:flex;
        justify-content:end !important;
        
    }
    .sidebar-wrapper  .nav-item pl-2 .nav-link:hover{
        background-color: #0062cc !important;
    }
    .nav-item pl-2{
        color: #b3ffed !important;
    }
    .bg-primary,  .btn-primary{
        background-color: #0062cc !important;
    }
    .text-primary{color: #0062cc !important;}
</style>

<?php $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/")+1); ?>
        <aside class="app-sidebar bg-black" data-bs-theme="dark"> 

            <div class="sidebar-brand  " > 
            <h3> <a href="" class="brand-link fw-bold text-primary mt-2">GO<span class="brand-text" style="margin-left: -1px;">ODLand
                   </span></h3> <!--end::Brand Text-->  
                 </a> <!--end::Brand Link--> 
            </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
            <div class="sidebar-wrapper">
                <nav class="mt-4"> <!--begin::Sidebar Menu-->
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                        <li class="nav-item pl-2  pb-1 "> 
                            <a href="dashboard" class="nav-link   <?= $page == 'dashboard.php' ? '  bg-primary text-white  ':'' ?>"> 
                                <i class="nav-icon ml-2 "><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                                stroke="#FAF9F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></i>
                                <p class="">Dashboard</p>
                            </a> </li>
                            <li class="nav-item pl-2 pb-1"> <a href="manage_water_catchments"
                             class="nav-link   <?= $page == 'manage_water_catchments.php' ? '  bg-primary text-white  ':'' ?>"> 
                           <i class="nav-icon ml-2"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="#FAF9F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/>
                            <path d="M18.7 8l-5.1 5.2-2.8-2.7L7 14.3"/></svg></i>    <p class="">E-Sawod Readings</p>
                            </a> </li>
                        
                        <li class="nav-item pl-2 pb-1"> <a href="all_files" class="nav-link  <?= $page == 'all_files.php' ? '  bg-primary text-white  ':'' ?>"> <i class="nav-icon ml-2 "><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#FAF9F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg></i>
                                <p>
                                    Archive Files
                                    
                                </p>
                            </a>
                        </li>

                        <li class="nav-item pl-2 pb-1"> <a href="projects" class="nav-link  <?= $page == 'projects.php' ? ' bg-primary text-white  ':'' ?>"> 
                            <i class="nav-icon ml-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#FAF9F6"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                             <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                             <line x1="12" y1="11" x2="12" y2="17"></line><line x1="9" y1="14" x2="15" y2="14"></line></svg></i> <p class="">Projects
                               
                                </p>
                            </a> 
                        </li>
                        
                            <li class="nav-item pl-2 pb-1"> <a href="events" class="nav-link   <?= $page == 'events.php' ? '  bg-primary text-white  ':'' ?>"> 
                            <i class="nav-icon ml-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#FAF9F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg></i>
                                <p class="">Events</p>
                            </a> </li>
                            <li class="nav-item pl-2 pb-1"> <a href="website_visitors" class="nav-link  <?= $page == 'website_visitors.php' ? '  bg-primary text-white  ':'' ?>"> 
                            <i class="nav-icon ml-2 "><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#FAF9F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></i>
                                <p class="">Website Visitors</p>
                            </a> </li>
                            <li class="nav-item pl-2 pb-1"> <a href="messages" class="nav-link   <?= $page == 'messages.php' ? '  bg-primary text-white  ':'' ?>"> 
                            <i class="nav-icon ml-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#FAF9F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg></i>
                                <p class="">Messages</p>
                            </a> </li>
                          
                            <li class="nav-item pl-2 pb-1"> <a href="#" class="nav-link "> 
                            <i class="nav-icon ml-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#FAF9F6" 
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/>
                            <path d="M18.7 14.3L15 10.5l-2.7 2.7L7 8"/></svg> </i>
                                <p class="">Manage Reports</p>
                                <i class="nav-arrow fas fa-chevron-right"></i>
                                </p>
                            </a> 
                            <ul class="nav nav-treeview ">
                               
                               <li class="nav-item pl-2"> <a href="" class="nav-link   <?= $page == '.php' ? '
                                 bg-primary text-white  ':'' ?>"> 
                                   <!-- <i class="nav-icon ml-2 fas fa-hourglass"></i> -->
                                       <p>Daily</p>
                                   </a> </li>
                               <li class="nav-item pl-2"> <a href="" class="nav-link   <?= $page == '.php' ? '  bg-primary text-white  ':'' ?>"> 
                                   <!-- <i class="nav-icon ml-2 fas fa-circle"></i> -->
                                       <p>Monthly</p>
                                   </a> </li>
                               <li class="nav-item pl-2"> <a href="" class="nav-link   <?= $page == '.php' ? '  bg-primary text-white  ':'' ?>"> 
                                   <!-- <i class="nav-icon ml-2 fas fa-circle"></i> -->
                                       <p>Yearly</p>
                                   </a> </li>
                               
                           </ul>
                        </li>
                        
                        <li class="nav-item pl-2 pb-1"> <a href="manageadmins" class="nav-link   <?= $page == 'manageadmins.php' ? '  bg-primary text-white  ':'' ?>"> 
                            <i class="nav-icon ml-2 "><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg></i>
                                <p class="">System Users</p>
                            </a> </li>

                          
                        <li class="nav-item pl-2 pb-1"> <a href="settings" class="nav-link   <?= $page == 'settings.php' ? '  bg-primary text-white  ':'' ?>"> 
                            <i class="nav-icon ml-2 "><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#FAF9F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg></i>
                                <p class="">Settings</p>
                            </a> </li>
                    </ul> <!--end::Sidebar Menu-->
                </nav>
            </div> <!--end::Sidebar Wrapper-->
        </aside> <!--end::Sidebar-->