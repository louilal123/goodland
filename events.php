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
    background-color: #f8f9fa;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}


.date-box {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 20px;
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
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
            </div>
          </div>
        </div>
      </div>
      
    </div><!-- End Page Title -->
    <section>

    <div class="container">
      <div class="row gy-4">

   
      <div class="row event-card mb-4 align-items-center">
            <div class="col-md-3 date-box">
                <h1 class="date-number">27</h1>
                <p class="date-month">May</p>
            </div>
            <div class="col-md-9 content-box">
                <h4>Where is the event happening?</h4>
                <p>Join us to explore the future of AI and technology in the industry. A day full of insightful talks and networking...</p>
                <a href="#" class="btn btn-primary">View Details</a>
            </div>
        </div>

        <!-- Event Card 3 -->
        <div class="row event-card mb-4 align-items-center">
            <div class="col-md-3 date-box">
                <h1 class="date-number">12</h1>
                <p class="date-month">August</p>
            </div>
            <div class="col-md-9 content-box">
                <h4>Where is the event happening?</h4>
                <p>Experience the best in tech with hands-on workshops and keynote speeches from industry experts...</p>
                <a href="#" class="btn btn-primary">View Details</a>
            </div>
        </div>
    


      </div>
    </div>

    </section>
  </main>

  <?php include "includes/footer.php";?>
</body>
</html>
