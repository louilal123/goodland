
<!DOCTYPE html>
<html lang="en">

<?php include "includes/header.php"; ?>
<link rel="stylesheet" href="assets/css/style.css">
<body class="index-page">

<?php include "includes/topnav.php";
include "classes/user_view.php"; ?>

<main class="main container mt-10">
<h1 class="text-center mt-5 "> <strong>BROWSE OUR ARCHIVE FILES</strong> </h1>
<h6 class="text-center mb-6">Explore the rich culture and heritage of Bantayan Island</h6>
  <div class="container-fluid mt-10">
    <div class="row justify-content-center">

      <!-- Sidebar -->
      <div class="col-md-2 sidebar mr-5">
        <h4 class="filter-title">Browse Sections</h4>
        <ul class="list-unstyled">
          <li><a href="#notable-figures" class="d-block mb-2 text-dark">Documents</a></li>
          <li><a href="#cultural-traditions" class="d-block mb-2 text-dark">Images</a></li>
          <li><a href="#personal-stories" class="d-block mb-2 text-dark">Stories</a></li>
          <li><a href="#notable-figures" class="d-block mb-2 text-dark">Maps</a></li>
        </ul>
      </div>

      <div class="col-md-9 main-content">
        <div class="search-bar mb-4">
          <input type="text" class="form-control search" placeholder="Search materials..." id="mainSearch">
        </div>
        <!-- <div class="d-flex justify-content-between align-items-center mb-4"> -->
          <!-- <div class="results-count">44,953 results</div> -->
          <!-- <select class="form-control" style="width: 200px;">
            <option>Sort by Relevance</option>
            <option>Sort by Date</option>
            <option>Sort by Popularity</option>
          </select>
        </div> -->
        <div class="row">
          <?php foreach ($documents as $document): ?>
          <div class="col-md-4 mb-4">
            <div class="card">
              <img src="admin/uploads/cover/<?php echo htmlspecialchars($document['cover'] ?? 'default_photo.jpg'); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($document['title']); ?>">
              <div class="card-body">
                <h6 class="card-title"><?php echo htmlspecialchars($document['title']); ?></h5>
               
                <a href="admin/uploads/documents/<?php echo htmlspecialchars($document['file_path']); ?>" class="btn btn-primary" download>Download</a>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

    </div>
  </div>

</main>
<?php include "includes/footer.php"; ?>
</body>

</html>
