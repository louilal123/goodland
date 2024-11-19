<?php 
require_once "classes/user_view.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "includes/header.php"; ?>
  <title>Goodland - Events</title>
</head>
<style>
  
  .event-card {
    /* background-color: #f8f9fa; */
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}


.date-box {
  background: linear-gradient(to right, #144D53,#0062cc) !important;
    color: white;
    text-align: center;
    padding: 30px;
}
.date-box:hover{
  background-color: #0062cc;
}

.date-number {
    font-size: 48px;
    font-weight: bold;
    color: white;
}

.date-month {
    font-size: 20px;
    color: white;
}

.content-box {
    padding: 20px;
}

.content-box h4 {
    margin-bottom: 15px;
}

.btn-primary {
    background-color: #0062cc;
    border-color: #0062cc;
}

</style>

<body class="blog-page">
  <?php include "includes/topnav.php";?>
  <main class="main ">

    <!-- Page Title -->
    <div class="page-title">
      <div class="heading "style="background-size: cover; background-position: center;background: linear-gradient(to top, rgba(38, 37, 37, 0.1), rgba(22, 22, 22, 0.1));z-index: -1;">
        <div class="container ">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <br><br>
              <h1 class="text-dark"> <i class="bi bi-calendar-check text-secondary"></i> GoodLand Events</h1>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Page Title -->
    <section>

    <div class="container">
      <div class="row gy-4">

      <section class="section values">
      <div class="container mt-2">
          <h2 class="mb-4 text-center">
            
              <span class="text-dark "><strong>ONGOING EVENTS</strong></span>
          </h2>
<br><br>
          <?php if (!empty($ongoing_events)): ?>
              <?php foreach ($ongoing_events as $event): ?>
                  <div class="row event-card mb-4 align-items-center">
                      <div class="col-md-3 date-box text-center ">
                          <?php
                              // Extract day and month from date_start and date_end
                              $startDate = strtotime($event['date_start']);
                              $endDate = strtotime($event['date_end']);
                              
                              $startDay = date("d", $startDate);
                              $startMonth = date("F", $startDate);
                              
                              $endDay = date("d", $endDate);
                              $endMonth = date("F", $endDate);
                          ?>
                          <h1 class="date-number">
                              <?php echo $startDay; ?><?php if ($startMonth != $endMonth): ?><span class="small">-<?php echo $endDay; ?></span><?php endif; ?>
                          </h1>
                          <p class="date-month">
                              <?php echo $startMonth; ?>
                              <?php if ($startMonth != $endMonth): ?> to <?php echo $endMonth; ?><?php endif; ?>
                          </p>
                      </div>
                      <div class="col-md-9 content-box">
                          <h4><?php echo htmlspecialchars($event['event_name']); ?></h4>
                          <p><?php echo htmlspecialchars($event['description']); ?></p>
                          <small>
                              Event Duration: <?php echo date("M d, Y", $startDate); ?> - <?php echo date("M d, Y", $endDate); ?>
                          </small>
                          <a href="event_details.php?event_id=<?php echo $event['event_id']; ?>" class="btn btn-primary mt-2">View Details</a>
                      </div>
                  </div>
              <?php endforeach; ?>
          <?php else: ?>
              <h4 class="text-center">Coming Soon..</h4>
          <?php endif; ?>
      </div>
      </section>
<br><br>
      <div class="container mt-5">
          <h2 class="mb-4"><span class="text-dark"><strong>UPCOMING EVENTS</strong></span></h2>
        
        <?php if (!empty($upcoming_events)): ?>
            <?php foreach ($upcoming_events as $event): ?>
                <div class="row event-card mb-4 align-items-center">
                    <div class="col-md-3 date-box text-center">
                        <?php
                            // Extract day and month from date_start and date_end
                            $startDate = strtotime($event['date_start']);
                            $endDate = strtotime($event['date_end']);
                            
                            $startDay = date("d", $startDate);
                            $startMonth = date("F", $startDate);
                            
                            $endDay = date("d", $endDate);
                            $endMonth = date("F", $endDate);
                        ?>
                        <h1 class="date-number">
                            <?php echo $startDay; ?><?php if ($startMonth != $endMonth): ?><span class="small">-<?php echo $endDay; ?></span><?php endif; ?>
                        </h1>
                        <p class="date-month">
                            <?php echo $startMonth; ?>
                            <?php if ($startMonth != $endMonth): ?> to <?php echo $endMonth; ?><?php endif; ?>
                        </p>
                    </div>
                    <div class="col-md-9 content-box">
                        <h4><?php echo htmlspecialchars($event['event_name']); ?></h4>
                        <p><?php echo htmlspecialchars($event['description']); ?> <br><small>
                          <?php echo date("M d, Y", $startDate); ?> - <?php echo date("M d, Y", $endDate); ?>
                        </small></p>
                        
                        <a href="event_details.php?event_id=<?php echo $event['event_id']; ?>" class="btn btn-primary mt-2">View Details</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <h4 class="text-center">No upcoming events at the moment.</h4>
        <?php endif; ?>
    </div>


    <br><br>
    <div class="container mt-5">
    <h2 class="mb-4">
       
        <span class="text-dark"><strong>FINISHED EVENTS</strong></span>
    </h2>

    <?php if (!empty($finished_events)): ?>
        <?php foreach ($finished_events as $event): ?>
            <div class="row event-card mb-4 align-items-center">
                <div class="col-md-3 date-box text-center">
                    <?php
                        // Extract day and month from date_start and date_end
                        $startDate = strtotime($event['date_start']);
                        $endDate = strtotime($event['date_end']);
                        
                        $startDay = date("d", $startDate);
                        $startMonth = date("F", $startDate);
                        
                        $endDay = date("d", $endDate);
                        $endMonth = date("F", $endDate);
                    ?>
                    <h1 class="date-number">
                        <?php echo $startDay; ?><?php if ($startMonth != $endMonth): ?><span class="small">-<?php echo $endDay; ?></span><?php endif; ?>
                    </h1>
                    <p class="date-month">
                        <?php echo $startMonth; ?>
                        <?php if ($startMonth != $endMonth): ?> to <?php echo $endMonth; ?><?php endif; ?>
                    </p>
                </div>
                <div class="col-md-9 content-box">
                    <h4><?php echo htmlspecialchars($event['event_name']); ?></h4>
                    <p><?php echo htmlspecialchars($event['description']); ?></p>
                    <small>
                        Event Duration: <?php echo date("M d, Y", $startDate); ?> - <?php echo date("M d, Y", $endDate); ?>
                    </small>
                    <a href="event_details.php?event_id=<?php echo $event['event_id']; ?>" class="btn btn-primary mt-2">View Details</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <h4 class="text-center">No finished events at the moment.</h4>
    <?php endif; ?>
</div>


    


      </div>
    </div>

    </section>
    <br><br><br><br><br><br><br><br><br><br><br>
  </main>

  <?php include "includes/footer.php";?>
</body>
</html>
