<?php 
require_once "classes/user_view.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php include "includes/header.php"; ?>
</head>
<style>
  .custom-btn{
    border-radius: 0px !important;
  }
</style>
<body class="blog-page">

<?php include "includes/topnav.php";?>
  <main class="main ">

    <!-- Page Title -->
    <div class="page-title  ">
    <div class="heading "style="background-size: cover; background-position: center;background: linear-gradient(to top, rgba(38, 37, 37, 1), rgba(22, 22, 22, 0.8));z-index: -1;">
    <div class="container ">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <br><br>
              <h1 class="text-warning">Events</h1>
              <!-- <p class="mb-0"></p> -->
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs ">
        <div class="container">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Events</li>
          </ol>
        </div>
      </nav>
      
    </div><!-- End Page Title -->

    <div class="container">
    <h2 class="text-warning">Incoming Events</h2>
    <?php if (!empty($scheduledEvents)): ?>
        <?php foreach ($scheduledEvents as $event): ?>
            <div class="event-card">
                <h3><?= htmlspecialchars($event['event_name']) ?></h3>
                <p><?= htmlspecialchars($event['description']) ?></p>
                <p><strong>Date:</strong> <?= htmlspecialchars($event['event_date']) ?></p>
                <p><strong>Location:</strong> <?= htmlspecialchars($event['location']) ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No incoming events.</p>
    <?php endif; ?>

    <h2 class="text-warning">Ongoing Events</h2>
    <?php if (!empty($ongoingEvents)): ?>
        <?php foreach ($ongoingEvents as $event): ?>
            <div class="event-card">
                <h3><?= htmlspecialchars($event['event_name']) ?></h3>
                <p><?= htmlspecialchars($event['description']) ?></p>
                <p><strong>Start:</strong> <?= htmlspecialchars($event['date_start']) ?></p>
                <p><strong>End:</strong> <?= htmlspecialchars($event['date_end']) ?></p>
                <p><strong>Location:</strong> <?= htmlspecialchars($event['location']) ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No ongoing events.</p>
    <?php endif; ?>

    <h2 class="text-warning">Finished Events</h2>
    <?php if (!empty($finishedEvents)): ?>
        <?php foreach ($finishedEvents as $event): ?>
            <div class="event-card">
                <h3><?= htmlspecialchars($event['event_name']) ?></h3>
                <p><?= htmlspecialchars($event['description']) ?></p>
                <p><strong>Date:</strong> <?= htmlspecialchars($event['event_date']) ?></p>
                <p><strong>Location:</strong> <?= htmlspecialchars($event['location']) ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No finished events.</p>
    <?php endif; ?>
</div>


  </main>

  <?php include "includes/footer.php";?>
</body>

</html>