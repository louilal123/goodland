<?php include "classes/admindetails.php";?>

<!DOCTYPE html>
<html lang="en"> 
<?php include "includes/header.php"; ?>

    <link rel="stylesheet" href="fullcalendar/css/bootstrap.min.css">
    <link rel="stylesheet" href="fullcalendar/fullcalendar/lib/main.min.css">
    <script src="./fullcalendar/js/bootstrap.min.js"></script>
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
                    <div class="card">
                        <div class="card-body">
                        <div class=" card-header d-flex mb-3">
                                <h1 class="fw-bold ">List Of Events</h1>
                                <button type="button" class="btn btn-sm btn-primary ms-auto btn-rounded" data-bs-toggle="modal" data-bs-target="#addItemModal">
                                    <i class="fas fa-folder-plus"></i> Add New
                                </button>
                            </div>
                            <hr>
                            <div id="calendar" style="height: 50px !important;"></div>
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
                                                    <span class="badge bg-secondary">Ongoing</span>
                                            <?php elseif ($item['status'] == 'finished'): ?>
                                                    <span class="badge bg-success">Finished</span> 
                                            <?php elseif ($item['status'] == 'cancelled'): ?>
                                                <span class="badge bg-danger">Cancelled</span>
                                            <?php endif; ?> 
                                        </td>
                                       
                                            <td>
                                                <a href="" class="btn btn-info btn-sm deleteMessageBtn" 
                                                    data-message-id="" data-bs-toggle="modal" 
                                                    data-bs-target="#deleteMessageModal">
                                                    <i class="fas fa-magnifying-glass"></i>
                                                </a>
                                                <a href="event_details.php?project_id=<?php echo $item['event_id']; ?>" class="btn btn-success btn-sm">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="#" class="btn btn-danger btn-sm deleteMessageBtn" 
                                                    data-message-id="<?php echo htmlspecialchars($item['event_id']); ?>" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteMessageModal" 
                                                    data-catchment-name="<?php echo htmlspecialchars($item['event_name']); ?>">
                                                    <i class="fas fa-trash"></i>
                                                </a>
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
                            <input type="date" class="form-control" name="date_start" id="date_start" >
                            <?php if (isset($_SESSION['error_date_start'])): ?>
                                <p class="error text-danger"><?php echo $_SESSION['error_date_start']; unset($_SESSION['error_date_start']); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="col">
                            <label for="date_end" class="form-label">End Date</label>
                            <input type="date" class="form-control" name="date_end" id="date_end" >
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
                            <label for="event_photo" class="form-label">Event Photo</label>
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
    // Prepare raw datetime for start and end in ISO format
    $row['start_datetime'] = date("Y-m-d\TH:i:s", strtotime($row['start_datetime']));
    $row['end_datetime'] = date("Y-m-d\TH:i:s", strtotime($row['end_datetime']));
    $events[] = $row;
}
?>

<script>
    // Directly pass the events to JavaScript (no need for parseJSON)
    var calendarEvents = <?= json_encode($events) ?>;
</script>

<script src="./fullcalendar/js/script.js"></script>

</body>

</html>