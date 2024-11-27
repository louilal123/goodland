<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php include "includes/header.php"; ?>
</head>
<style>
  .custom-btn{
    border-radius: 0px !important;
  }
  .modal-content{
        border-radius: 0px !important;
    }
    .form-control {
        border-color: #0062cc !important;
        
        
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
              <h1 class="text-dark"> <i class="bi bi-paper text-secondary"></i> Archives</h1>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Page Title -->

  <div class="container mt-5">
    <div class="row">
      <div class="col-lg-12">
       
          <div class="container">
            <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php foreach ($approvedFiles as $file): ?>
              <div class="col">
                <div class="card h-100">
                  <img src="admin/<?php echo $file['cover_path']; ?>" class="card-img card-img-top" alt="<?php echo htmlspecialchars($file['title']); ?>" style="height: 250px; object-fit: cover;">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($file['title']); ?></h5>
                    <p class="card-text"><i><?php echo htmlspecialchars($file['description']); ?></i></p>
                   
                    <a href="goodland_studies/<?php echo urlencode($file['file_path']); ?>" target="_blank" class="btn btn-primary custom-btn">
    View File <i class="bi bi-eye"></i>
</a>



                  </div>
                </div>
              </div>
            <?php endforeach; ?>

            </div>
          </div>
        <!-- </section> -->
      </div>
    </div>
  </div>

</main>

    </div>
  </div>
</div>

<br><br><br><br> <br><br><br>
<?php include "includes/footer.php";?>

</body>
</html>
