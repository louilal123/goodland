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
        <h4 class="filter-title">Refine Results</h4>
        <div class="mb-3">
          <label for="searchWithin" class="form-label">Search within results</label>
          <input type="text" class="form-control" id="searchWithin" placeholder="Search...">
        </div>
        <div class="mb-3">
          <label for="contentType" class="form-label">Content Type</label>
          <select class="form-control" id="contentType">
            <option>All Types</option>
            <option>Images</option>
            <option>Panoramas</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="imageResolution" class="form-label">Image Resolution</label>
          <select class="form-control" id="imageResolution">
            <option>All Resolutions</option>
            <option>High</option>
            <option>Medium</option>
            <option>Low</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="dateRange" class="form-label">Date</label>
          <input type="date" class="form-control" id="dateRange">
        </div>
        <div class="mb-3">
          <label for="classification" class="form-label">Classification</label>
          <select class="form-control" id="classification">
            <option>All Classifications</option>
            <option>Photographs</option>
            <option>Drawings and Watercolors</option>
            <option>Prints</option>
          </select>
        </div>
      </div>

      <!-- Main Content -->
      <div class="col-md-9 main-content">
        <div class="search-bar mb-4">
          <input type="text" class="form-control" placeholder="Search materials...">
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
