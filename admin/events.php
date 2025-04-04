﻿<?php include "classes/admindetails.php";?>

<!DOCTYPE html>
<html lang="en"> 
<?php include "includes/header.php"; ?>

    <!-- <link rel="stylesheet" href="fullcalendar/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="fullcalendar/fullcalendar/lib/main.min.css">
    <!-- <script src="./fullcalendar/js/bootstrap.min.js"></script> -->
    <script src="./fullcalendar/fullcalendar/lib/main.min.js"></script>
   
</head>
<style>
    .btn-info.text-light:hover,
        .btn-info.text-light:focus {
            background: #000;
        }
        table, tbody, td, tfoot, th, thead, tr {
            border-color: #ededed !important;
            border-style: solid;
            border-width: 1px !important;
        }
</style>
<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary" style="overflow: hidden !important;" >

    <div class="app-wrapper">

       <?php include "includes/sidebar.php" ?>
        <div class="app-main-wrapper "> 
           <?php 
            include "includes/topnav.php"; ?>
        <main class="app-main">
    <div class="app-content" style="margin-bottom: 0px important;"> 
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row mt-2">
                <!-- Calendar Section -->
                <div class="col-md-12">
                    <div class="card ">
                    <div class=" card-header d-flex mb-3">
                                <h3 class="fw-bold ">List Of Events</h3>
                                <button type="button" class="btn btn-sm btn-primary ms-auto btn-rounded" data-bs-toggle="modal" data-bs-target="#addItemModal">
                                    <i class="fas fa-folder-plus"></i> Add New
                                </button>
                            </div>
                        <div class="card-body ">
                      
                            <hr>
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                 <!-- Event List Section -->
                 <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            
                            <table id="myTable" class="table ed table-hover table-striped text-center w-100">
                                <thead class="table-secondary">
                                    <tr class="text-black fw-bold">
                                      
                                        <th style="font-weight: bold !important;">Event Name</th>
                                      
                                        <th style="font-weight: bold !important;">Start Date</th>
                                        <th style="font-weight: bold !important;">End Date</th>
                                        <th style="font-weight: bold !important;">Status</th>
                                      
                                        <th style="font-weight: bold !important;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($events_list as $item): ?>
                                        <tr>
                                            <!-- SELECT `event_id`, `event_name`, `description`, `location`, `created_at`, `updated_at`, `event_photo`, `status`, `date_start`, `date_end` FROM `events` WHERE 1 -->
                                           
                                            <td><?php echo htmlspecialchars($item['event_name']); ?></td>
                                           <td><?php echo date("M d, Y", strtotime($item['date_start'])); ?></td>
                                            <td><?php echo date("M d, Y", strtotime($item['date_end'])); ?></td>
                                           
                                            <td>  
                                            <?php if ($item['status'] == 'upcoming'): ?>
                                                <span class="badge bg-success">Upcoming</span>
                                            <?php elseif ($item['status'] == 'ongoing'): ?>
                                                    <span class="badge bg-primary">Ongoing</span>
                                            <?php elseif ($item['status'] == 'finished'): ?>
                                                    <span class="badge bg-secondary">Finished</span> 
                                            <?php elseif ($item['status'] == 'cancelled'): ?>
                                                <span class="badge bg-danger">Cancelled</span>
                                            <?php endif; ?> 
                                        </td>
                                       
                                            <td>
                                               
                                                <button class="btn btn-sm btn-success editBtn" 
                                                    data-id="<?php echo htmlspecialchars($item['event_id']); ?>"
                                                    data-name="<?php echo htmlspecialchars($item['event_name']); ?>"
                                                    data-description="<?php echo htmlspecialchars($item['description']); ?>"
                                                    data-location="<?php echo htmlspecialchars($item['location']); ?>"
                                                    data-start="<?php echo htmlspecialchars($item['date_start']); ?>"
                                                    data-end="<?php echo htmlspecialchars($item['date_end']); ?>"
                                                    
                                                    data-status="<?php echo htmlspecialchars($item['status']); ?>"
                                                    data-organizer="<?php echo htmlspecialchars($item['organizer']); ?>"
                                                    data-photo="<?php echo htmlspecialchars($item['event_photo']); ?>">
                                                    <i class="bi bi-pencil-square fw-bold"></i> Edit
                                                </button>



                                                    <button  class="btn btn-sm btn-danger deleteMessageBtn " 
                                                    data-event-id="<?php echo htmlspecialchars($item['event_id']); ?>" 
                                                    data-event-name="<?php echo htmlspecialchars($item['event_name']); ?>" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteMessageModal"> 
                                                    <i class="fas fa-trash"></i> Delete
                                                    </button>
                                            </td>
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
</main>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h4 class="modal-title">
                    Edit Event Details 
                    <span id="statusBadge" class="badge">Status: Pending</span>
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close-circle"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST" action="classes/update_event.php" enctype="multipart/form-data">
                    <input type="hidden" name="event_id" id="editEventId">
                    <div class="md-form">
            <!-- Display the current photo if available -->
            <img id="editPhotoPreview" src="<?php echo isset($_SESSION['photo_path']) ? $_SESSION['photo_path'] : '#'; ?>" alt="Event Photo" class="img-fluid mb-3" style="display: flex; margin: auto; max-width: 400px; max-height: 300px;">
        </div>
                    <!-- Event Name Field -->
                    <div class="md-form mb-2">
                        <label class="text-dark" for="editEventName">Event Name</label>
                        <input type="text" id="editEventName" class="form-control" name="event_name" 
                               value="<?php echo $_SESSION['form_data']['event_name'] ?? ''; ?>">
                        <?php if (isset($_SESSION['error_event_name'])): ?>
                            <p class="error text-danger"><?php echo $_SESSION['error_event_name']; unset($_SESSION['error_event_name']); ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Event Description Field -->
                    <div class="md-form mb-2">
                        <label class="text-dark" for="editDescription">Description</label>
                        <textarea id="editDescription" rows="2" class="form-control" name="description"><?php echo $_SESSION['form_data']['description'] ?? ''; ?></textarea>
                        <?php if (isset($_SESSION['error_description'])): ?>
                            <p class="error text-danger"><?php echo $_SESSION['error_description']; unset($_SESSION['error_description']); ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Event Location Field -->
                    <div class="md-form mb-2">
                        <label class="text-dark" for="editLocation">Location</label>
                        <input type="text" id="editLocation" class="form-control" name="location" 
                               value="<?php echo $_SESSION['form_data']['location'] ?? ''; ?>">
                        <?php if (isset($_SESSION['error_location'])): ?>
                            <p class="error text-danger"><?php echo $_SESSION['error_location']; unset($_SESSION['error_location']); ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Event Start Date -->
                    <div class="md-form mb-2">
                        <label class="text-dark" for="editStartDate">Start Date</label>
                        <input type="datetime-local" id="editStartDate" class="form-control" name="start_date"
                               value="<?php echo $_SESSION['form_data']['start_date'] ?? ''; ?>">
                        <?php if (isset($_SESSION['error_start_date'])): ?>
                            <p class="error text-danger"><?php echo $_SESSION['error_start_date']; unset($_SESSION['error_start_date']); ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Event End Date -->
                    <div class="md-form mb-2">
                        <label class="text-dark" for="editEndDate">End Date</label>
                        <input type="datetime-local" id="editEndDate" class="form-control" name="end_date"
                               value="<?php echo $_SESSION['form_data']['end_date'] ?? ''; ?>">
                        <?php if (isset($_SESSION['error_end_date'])): ?>
                            <p class="error text-danger"><?php echo $_SESSION['error_end_date']; unset($_SESSION['error_end_date']); ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Current Event Photo Preview -->
                    <div class="mb-2">
                       
                        <label class="text-dark" for="editEventPhoto">Change Event Photo</label>
                        <input type="file" id="editEventPhoto" class="form-control" name="event_photo">
                        <?php if (isset($_SESSION['error_event_photo'])): ?>
                            <p class="error text-danger"><?php echo $_SESSION['error_event_photo']; unset($_SESSION['error_event_photo']); ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Event Organizer Field -->
                    <div class="md-form mb-2">
                        <label class="text-dark" for="editOrganizer">Organizer</label>
                        <input type="text" id="editOrganizer" class="form-control" name="organizer"
                               value="<?php echo $_SESSION['form_data']['organizer'] ?? ''; ?>">
                        <?php if (isset($_SESSION['error_organizer'])): ?>
                            <p class="error text-danger"><?php echo $_SESSION['error_organizer']; unset($_SESSION['error_organizer']); ?></p>
                        <?php endif; ?>
                    </div>
                     <!-- Hidden status input field -->
                     <input type="hidden" id="editStatus" name="status">


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>    
                        <button type="submit" name="edit_event" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Event</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="classes/events_crud.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col">
                            <label for="event_name" class="form-label">Event Name</label>
                            <input type="text" class="form-control" name="event_name" id="event_name" 
                                   value="<?php echo $_SESSION['form_data']['event_name'] ?? ''; ?>">
                            <?php if (isset($_SESSION['error_event_name'])): ?>
                                <p class="error text-danger"><?php echo $_SESSION['error_event_name']; unset($_SESSION['error_event_name']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description"><?php echo $_SESSION['form_data']['description'] ?? ''; ?></textarea>
                            <?php if (isset($_SESSION['error_description'])): ?>
                                <p class="error text-danger"><?php echo $_SESSION['error_description']; unset($_SESSION['error_description']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col">
                            <label for="date_start" class="form-label">Start Date</label>
                            <input type="datetime-local" class="form-control" name="date_start" id="date_start" >
                            <?php if (isset($_SESSION['error_date_start'])): ?>
                                <p class="error text-danger"><?php echo $_SESSION['error_date_start']; unset($_SESSION['error_date_start']); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="col">
                            <label for="date_end" class="form-label">End Date</label>
                            <input type="datetime-local" class="form-control" name="date_end" id="date_end" >
                            <?php if (isset($_SESSION['error_date_end'])): ?>
                                <p class="error text-danger"><?php echo $_SESSION['error_date_end']; unset($_SESSION['error_date_end']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" name="location" id="location" 
                                   value="<?php echo $_SESSION['form_data']['location'] ?? ''; ?>">
                            <?php if (isset($_SESSION['error_location'])): ?>
                                <p class="error text-danger"><?php echo $_SESSION['error_location']; unset($_SESSION['error_location']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="organizer" class="form-label">Organized By: </label>
                            <input type="text" class="form-control" name="organizer" id="organizer" 
                                   value="<?php echo $_SESSION['form_data']['organizer'] ?? ''; ?>">
                            <?php if (isset($_SESSION['error_organizer'])): ?>
                                <p class="error text-danger"><?php echo $_SESSION['error_organizer']; unset($_SESSION['error_organizer']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                  
                    
                    <div class="row mt-3">
                        <div class="col">
                            <label for="event_photo" class="form-label">Event banner</label>
                            <input type="file" class="form-control" name="event_photo" id="event_photo" >
                            <?php if (isset($_SESSION['error_event_photo'])): ?>
                                <p class="error text-danger"><?php echo $_SESSION['error_event_photo']; unset($_SESSION['error_event_photo']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>


                    <div class="modal-footer mt-4">
                        <button type="button" class="btn btn-secondary custombtn" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="add_event" class="btn btn-primary custombtn" name="add_event">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

        </div>
    </div>
    <?php include "includes/footer.php" ?>
    <script>
    
    document.addEventListener('DOMContentLoaded', function () {
    // Edit Button Click Event
    document.querySelectorAll('.editBtn').forEach(button => {
        button.addEventListener('click', function () {
            const eventId = this.getAttribute('data-id');
            const eventName = this.getAttribute('data-name');
            const eventDescription = this.getAttribute('data-description');
            const eventLocation = this.getAttribute('data-location');
            const eventStart = this.getAttribute('data-start');
            const eventEnd = this.getAttribute('data-end');
            const eventStatus = this.getAttribute('data-status');
            const eventOrganizer = this.getAttribute('data-organizer');
            const eventPhoto = this.getAttribute('data-photo');

            // Set modal fields
            document.getElementById('editEventId').value = eventId;
            document.getElementById('editEventName').value = eventName;
            document.getElementById('editDescription').value = eventDescription;
            document.getElementById('editLocation').value = eventLocation;
            document.getElementById('editStartDate').value = eventStart;
            document.getElementById('editEndDate').value = eventEnd;
            document.getElementById('editStatus').value = eventStatus;
            document.getElementById('editOrganizer').value = eventOrganizer;

            // Display event photo preview
            document.getElementById('editPhotoPreview').src = eventPhoto;

            // Set the status badge dynamically
            const statusBadge = document.getElementById('statusBadge');
            if (eventStatus === 'upcoming') {
                statusBadge.textContent = "Upcoming";
                statusBadge.className = "badge bg-success"; // Green
            } else if (eventStatus === 'ongoing') {
                statusBadge.textContent = "Ongoing";
                statusBadge.className = "badge bg-primary"; // Blue
            } else if (eventStatus === 'finished') {
                statusBadge.textContent = "Finished";
                statusBadge.className = "badge bg-secondary"; // Grey
            } else if (eventStatus === 'cancelled') {
                statusBadge.textContent = "Cancelled";
                statusBadge.className = "badge bg-danger"; // Red
            }

            // Show the modal
            new bootstrap.Modal(document.getElementById('editModal')).show();
        });
    });
});


    </script>
    <script>
$(document).ready(function() {
    $('.deleteMessageBtn').on('click', function(e) {
        e.preventDefault();

        const eventId = $(this).data('event-id');
        const eventName = $(this).data('event-name');
        
        Swal.fire({
            title: 'Are you sure?',
            text: `Event "${eventName}" will be deleted!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to delete_event.php with the event ID
                window.location.href = "classes/delete_event.php?id=" + eventId;
            }
        });
    });
});
</script>
 <script>
        document.addEventListener('DOMContentLoaded', function() {
   
   <?php if (isset($_SESSION['form_data'])): ?>
   var myModal = new bootstrap.Modal(document.getElementById('editModal'), {
       backdrop: 'static'
   });
   myModal.show();
   <?php 
   unset($_SESSION['form_data']);
   endif; 
   ?>
});

</script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
   
   <?php if (isset($_SESSION['form_data'])): ?>
   var myModal = new bootstrap.Modal(document.getElementById('addItemModal'), {
       backdrop: 'static'
   });
   myModal.show();
   <?php 
   unset($_SESSION['form_data']);
   endif; 
   ?>
});

</script>
<?php
$event = $mainClass->fetchEvents();
$events = [];
foreach($event as $row){
    $row['start_datetime'] = date("Y-m-d\TH:i:s", strtotime($row['start_datetime']));
    $row['end_datetime'] = date("Y-m-d\TH:i:s", strtotime($row['end_datetime']));
    $events[] = $row;
}
?>

<script>
    var calendarEvents = <?= json_encode($events) ?>;
</script>

<script src="./fullcalendar/js/script.js"></script>

</body>

</html>