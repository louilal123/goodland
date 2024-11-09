<style>
   
   body{
        overflow: hidden !important;
        font-family:sans-serif;
        font-size: 600;
    }
   
    .form-control {
        border-color: gray !important;
        
        
    }
    .modal-dialog .modal .modal-body .modal-content{
       border: 0px;
        border-radius: 0px !important;
    }
   .card,  .small-box{
    border-radius: 0px !important;
   }
   
    .modal-content{
        border-radius: 0px !important;
    }
</style>

</style>
<nav class="app-header navbar navbar-expand " > <!--begin::Container-->
                <div class="container-fluid" style="border: 0px !important;"> <!--begin::Start Navbar Links-->
                    <ul class="navbar-nav">
                        <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#141414" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg> </a> </li>
                        <li class="nav-item d-none d-md-block"> <a href="#" class="nav-link"></a> </li>
                
                    </ul>
                 <ul class="navbar-nav " >
                <li class="nav-item">
                <div class="input-group d-flex" style="max-width: 400px; ">
                        <input id="searchBar" type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" autocomplete="off" />
                        <button id="searchButton" type="button" class="btn btn-primary bg-primary" data-mdb-ripple-init>
                            <i class="fas fa-magnifying-glass"></i>
                        </button>
                    </div>
                </li>
                </ul>

        <ul class="navbar-nav ms-auto">

                    <li class="nav-item dropdown"> 
                       <a class="nav-link" data-bs-toggle="dropdown" href="#"> 
                            <i class="fas fa-envelope fa-lg"></i> 
                            <span class="badge rounded-pill badge-notification bg-danger"><?php if (isset($unread_msgs_count) && $unread_msgs_count > 0): ?>
    <?php echo htmlspecialchars($unread_msgs_count); ?>
<?php endif; ?>
</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-4 bg-white" style="width: 800px !important;">
                                <div class="d-flex justify-content-between align-items-center w-100">
                                    <h4 class="fw-bold text-dark">New Messages</h4>
                                    <h4><span class="fas fa-envelope fa-lg"></span></h4>
                                </div>

                            <div class="dropdown-divider"></div>
                            
                          <?php if (!empty($unread_msgs)): ?>
                                <?php foreach ($unread_msgs as $message): ?>
                                    <a href="#" class="dropdown-item bg-secondary-subtle" data-timestamp="<?= htmlspecialchars($message['date_sent']); ?>">
                                        <div class="d-flex ">
                                            <div class="flex-grow-1 ">
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
                           
                                <?php endforeach; ?>
                                <a href="messages.php" class="btn btn-rounded btn-primary d-flex justify-content-center pt-2">See All Messages</a>
                      
                            <?php else: ?>
                                <p class="dropdown-item d-flex justify-content-center p-4">No unread messages</p>
                            <?php endif; ?>

                            
                              </div>

                    </li> 
                    <li class="nav-item dropdown"> 
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

<script>
    // Define a map of keywords and the corresponding admin pages
const pageRoutes = {
    'dashboard': 'dashboard.php',
    'messages': 'messages.php',
    'users': 'user_list.php',
    'settings': 'settings.php',
    'profile': 'profile.php',
    'notifications': 'notifications.php',
    'contributors': 'manageusers.php',
    'admins': 'manageadmins',
    'projects': 'projects.php',
    'water catchments': 'manage_water_catchments.php'
    
};

// Capture references to DOM elements
const searchBar = document.getElementById('searchBar');
const searchButton = document.getElementById('searchButton');
const suggestionsBox = document.getElementById('suggestions');

// Listen for user input to provide real-time suggestions
searchBar.addEventListener('input', function() {
    let query = this.value.toLowerCase();
    suggestionsBox.innerHTML = ''; // Clear previous suggestions

    // Get matching suggestions based on input
    let suggestions = Object.keys(pageRoutes).filter(page => page.includes(query));

    if (suggestions.length > 0) {
        suggestionsBox.style.display = 'block'; // Show the suggestions dropdown
        suggestions.forEach(suggestion => {
            let suggestionItem = document.createElement('li');
            suggestionItem.className = 'list-group-item list-group-item-action';
            suggestionItem.textContent = suggestion;

            // When a suggestion is clicked, redirect to the page
            suggestionItem.addEventListener('click', function() {
                window.location.href = pageRoutes[suggestion];
            });

            suggestionsBox.appendChild(suggestionItem);
        });
    } else {
        suggestionsBox.style.display = 'none'; // Hide the suggestions if none are found
    }
});

// Handle the search button click or "Enter" keypress for redirect
searchButton.addEventListener('click', performSearch);
searchBar.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        performSearch();
    }
});

// Function to perform the search and handle redirects
function performSearch() {
    let query = searchBar.value.toLowerCase();
    
    // If there's a matching page, redirect; otherwise, stay on the current page
    if (pageRoutes[query]) {
        window.location.href = pageRoutes[query];
    } else {
        // Optionally show an alert or notification if no match is found
        alert('No matching page found. Staying on the current page.');
    }
}

</script>
