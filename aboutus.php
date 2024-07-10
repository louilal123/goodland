<?php
include "classes/user_view.php";
?>
<!DOCTYPE html>
<html lang="en">

<?php include "includes/header.php"; ?>
<style>
  .header {
    background-color: black !important;
  }
  .main {
    margin-top: 150px; 
  }
  .sidebar {
    border-right: 1px solid #ddd;
    padding-right: 20px;
  }
  .sidebar .filter-title {
    font-size: 1.25rem;
    font-weight: bold;
    margin-bottom: 10px;
  }
  .main-content .search-bar {
    margin-bottom: 20px;
  }
  .main-content .results-count {
    font-size: 1.25rem;
    font-weight: bold;
    margin-bottom: 20px;
  }
  .main-content .card {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 15px;
    margin-bottom: 20px;
    background-color: #f9f9f9;
  }
  .main-content .card img {
    height: 200px;
    object-fit: cover;
    margin-bottom: 15px;
  }
  .main-content .card-title {
    font-size: 1.25rem;
    font-weight: bold;
    margin-bottom: 10px;
  }
  .main-content .card-text {
    font-size: 1rem;
    color: #555;
  }
</style>

<body class="index-page">

<?php include "includes/topnav.php"; ?>

<main class="main container mt-10">
<h1 class="text-center mt-5 mb-6 text-info" style="serif"> <strong>MEET OUR MEMBERS</strong> </h1>
 

<section class="about section" data-aos="fade-up" data-aos-delay="100">
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    
  <div class="row">
    <?php foreach ($members as $member): ?>
    <div class=" col-md-4 custom-card mb-4" style="border-radius: 0px !important;">
      <div class="card h-100">
        <img src="<?php echo htmlspecialchars($member['member_photo']) ? 'admin/' . htmlspecialchars($member['member_photo']) : 'admin/uploads/default_photo.jpg'; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($member['member_name']); ?>" style="height: 200px; object-fit: cover;">
        <div class="card-body">
          <h5 class="card-title  fw-bold text-center"><?php echo htmlspecialchars($member['member_name']); ?></h5>
          <p class="card-text"><?php echo htmlspecialchars($member['description']); ?></p>
          <a href="#" class="btn btn-primary">Learn More</a>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>


</main>
<?php include "includes/footer.php"; ?>
</body>

</html>
