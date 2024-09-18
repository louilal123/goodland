<!DOCTYPE html>
<html lang="en">

<head>
<?php include "includes/header.php"; ?>
</head>
<style>
  /* General container setup */
.container {
  width: 90%;
  margin: 0 auto;
}

/* Search Section */
.search-section {
  text-align: center;
  margin-bottom: 20px;
}

.search-input {
  width: 50%;
  padding: 10px;
  margin-right: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.search-btn {
  padding: 10px 20px;
  background-color: var(--accent-color); /* Your preset accent color */
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.search-btn:hover {
  background-color: var(--contrast-color); /* Slightly different hover color */
}

.search-text {
  margin-top: 10px;
  font-size: 14px;
  color: var(--default-color); /* Your default color */
}

/* Grid Section */
.grid-section {
  display: grid;
  grid-template-columns: repeat(4, 1fr); /* 4 columns */
  gap: 20px;
}

.grid-item {
  background-color: var(--surface-color); /* Your surface color */
  padding: 20px;
  text-align: center;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s;
}

.grid-item:hover {
  transform: translateY(-5px); /* Adds a slight hover effect */
}

/* Pagination Section */
.pagination {
  display: flex;
  justify-content: center;
  margin-top: 30px;
}

.pagination a {
  padding: 10px 15px;
  margin: 0 5px;
  text-decoration: none;
  background-color: var(--accent-color); /* Pagination button color */
  color: white;
  border-radius: 5px;
}

.pagination a:hover {
  background-color: var(--contrast-color);
}

</style>
<body class="blog-page">

<?php include "includes/topnav.php";?>
  <main class="main mt-4">

    <!-- Page Title -->
    <div class="page-title mt-4">
      <div class="heading mt-4">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <br><br>
              <h1>Welcome to our online library. We strive to provide free learning materials 
              for the education of the youth and locals.</h1>
              <!-- <p class="mb-0"></p> -->
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Blogs</li>
          </ol>
        </div>
      </nav>
      
    </div><!-- End Page Title -->

    <div class="container">
      <div class="row">

        <div class="col-lg-12">

          <!-- Blog Posts Section -->
          <section id="blog-posts" class="blog-posts section">

            <div class="container">

              <div class="row gy-4">
           
              <div class="col-3">
             <div class="card" >
                <img src="uploads/default_photo.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-info">Download</a>
                  
                </div>
              </div>
             </div>

             <div class="col-3">
             <div class="card" >
                <img src="uploads/default_photo.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-info">Download</a>
                  
                </div>
              </div>
             </div>

             <div class="col-3">
             <div class="card" >
                <img src="uploads/default_photo.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-info">Download</a>
                  
                </div>
              </div>
             </div>

             <div class="col-3">
             <div class="card" >
                <img src="uploads/default_photo.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-info">Download</a>
                  
                </div>
              </div>
             </div>

              </div><!-- End blog posts list -->

            </div>

          </section><!-- /Blog Posts Section -->

          <!-- Blog Pagination Section -->
          <section id="blog-pagination" class="blog-pagination section">

            <div class="container">
              <div class="d-flex justify-content-center">
                <ul>
                  <li><a href="#"><i class="bi bi-chevron-left"></i></a></li>
                  <li><a href="#">1</a></li>
                  <li><a href="#" class="active">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li>...</li>
                  <li><a href="#">10</a></li>
                  <li><a href="#"><i class="bi bi-chevron-right"></i></a></li>
                </ul>
              </div>
            </div>

          </section><!-- /Blog Pagination Section -->

        </div>

      </div>
    </div>

  </main>

  <?php include "includes/footer.php";?>
</body>

</html>