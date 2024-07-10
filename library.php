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
<h1 class="text-center mt-5 mb-6"> <strong>BROWSE OUR LIBRARY</strong> </h1>
  <div class="container-fluid mt-10">
    <div class="row justify-content-center">

      <!-- Sidebar -->
      <div class="col-md-3 sidebar">
        <h4 class="filter-title">Browse Sections</h4>
        <ul class="list-unstyled">
          <li><a href="#historical-events" class="d-block mb-2"></a></li>
          <li><a href="#notable-figures" class="d-block mb-2">Notable Figures</a></li>
          <li><a href="#cultural-traditions" class="d-block mb-2">Cultural Traditions</a></li>
          <li><a href="#personal-stories" class="d-block mb-2">Personal Stories</a></li>
        </ul>
      </div>

      <div class="col-md-9 main-content">
        <div class="search-bar mb-4">
          <input type="text" class="form-control" placeholder="Search materials..." id="mainSearch">
        </div>
        <div class="d-flex justify-content-between align-items-center mb-4">
          <div class="results-count">44,953 results</div>
          <select class="form-control" style="width: 200px;">
            <option>Sort by Relevance</option>
            <option>Sort by Date</option>
            <option>Sort by Popularity</option>
          </select>
        </div>
        <div class="row">
          <div class="col-md-6 mb-4">
            <div class="card">
              <img src="admin/uploads/sample1.jpg" class="card-img-top" alt="Sample Material 1">
              <div class="card-body">
                <h5 class="card-title">Sample Material 1</h5>
                <p class="card-text">A brief description of the material.</p>
                <a href="#" class="btn btn-primary">Download</a>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="card">
              <img src="admin/uploads/sample2.jpg" class="card-img-top" alt="Sample Material 2">
              <div class="card-body">
                <h5 class="card-title">Sample Material 2</h5>
                <p class="card-text">A brief description of the material.</p>
                <a href="#" class="btn btn-primary">Download</a>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

</main>
<?php include "includes/footer.php"; ?>
</body>

</html>
