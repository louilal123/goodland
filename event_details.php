<?php 
require_once __DIR__ . '/admin/classes/Main_class.php';
require_once "classes/config.php"; 
$mainClass = new Main_class();

if (isset($_GET['event_id'])) {
    $encryptedId = $_GET['event_id'];
    $eventId = encryptor('decrypt', $encryptedId);

    if ($eventId) {
        $event_details = $mainClass->getEventById($eventId);
        if ($event_details) {
            $event = $event_details[0]; // Assuming `getEventById` returns an array of results
            ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/header.php"; ?>
    <style>
        .uniform-image {
            width: 100%;
            max-width: 100%;
            height: 500px;
            object-fit: cover;
        }
    </style>
</head>

<body>
<?php include "includes/topnav.php"; ?>
<main class="main">

   <section class="section">


   <div class="page-title">
        <div class="heading" >
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="text-light bg-secondary bg-opacity-50 p-5"><?php echo htmlspecialchars($event['event_name']); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <p><strong>Description:</strong> <?php echo htmlspecialchars($event['description']); ?></p>
        <p><strong>Location:</strong> <?php echo htmlspecialchars($event['location']); ?></p>
        <p><strong>Organizer:</strong> <?php echo htmlspecialchars($event['organizer']); ?></p>
        <p><strong>Duration:</strong> <?php echo date("M d, Y", strtotime($event['date_start'])); ?> 
            - <?php echo date("M d, Y", strtotime($event['date_end'])); ?></p>

        <hr>

        <img src="admin/<?php echo htmlspecialchars($event['event_photo']); ?>" alt="Event Image" class="img-fluid uniform-image mb-4">
    <br> <br><br>
    
 <a href="events" class="btn btn-dark btn-lg justify-content-center"><i class="bi bi-arrow-left"></i> Return</a>
    </div>


   </section>
 <br><br><br><br>
 <br><br><br>
</main>
<?php include "includes/footer.php"; ?>
</body>
</html>

<?php
        } else {
            echo '<p>Event not found.</p>';
        }
    } else {
        echo '<p>Invalid event ID.</p>';
    }
} else {
    echo '<p>No event selected.</p>';
}
?>
