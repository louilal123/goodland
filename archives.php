<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php include "includes/header.php"; ?>
</head>
<style>
  .custom-btn{
    border-radius: 0px !important;
    
 background: linear-gradient(to right, #144D53,#0062cc) !important;
 color: #f8f8f8; 
  }
  .modal-content{
        border-radius: 0px !important;
    }
    .form-control {
        border-color: #0062cc !important;
        
        
    }
    .text-primary{
      background-image: linear-gradient(to right, #144D53, #0062cc);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
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
              <h1 class="text-dark"> <i class="bi bi-book text-secondary"></i> Archives</h1>
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
                    <button class="btn btn-primary custom-btn" 
                        data-bs-toggle="modal" 
                        data-bs-target="#fileModal"
                        data-file_id="<?php echo $file['id']; ?>"
                        data-title="<?php echo htmlspecialchars($file['title']); ?>"
                        data-file_path="admin/uploads/<?php echo urlencode($file['file_path']); ?>">
                        Request A Copy
                    </button>

                  

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



<div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary" id="fileModalLabel">Request File Copy</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h5 id="modalTitle"></h5>
        <p>To request a copy of the file, please enter your email address below:</p>
        
        <form id="requestForm" method="POST" action="request_file.php">
          <div class="mb-3">
            <label for="email" class="form-label">Your Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          
          <input type="hidden" id="file_id" name="file_id">
          <input type="hidden" id="file_title" name="file_title">
          <input type="hidden" id="file_path" name="file_path"> 
       
          <button type="submit" class="btn btn-primary d-flex ms-auto custom-btn">Send Me a Copy</button>
        </form>
      </div>
    </div>
  </div>
</div>

<br><br><br><br> <br><br><br>
<?php include "includes/footer.php";?>

<script>
  var fileModal = document.getElementById('fileModal');
  fileModal.addEventListener('show.bs.modal', function (event) {
     
      var button = event.relatedTarget;

      var file_id = button.getAttribute('data-file_id');
      var file_title = button.getAttribute('data-title');
      var file_path = button.getAttribute('data-file_path');

      var modalTitle = fileModal.querySelector('#modalTitle');
      var fileIdInput = fileModal.querySelector('#file_id');
      var fileTitleInput = fileModal.querySelector('#file_title');
      var filePathInput = fileModal.querySelector('#file_path'); 

      modalTitle.textContent = file_title;  
      fileIdInput.value = file_id;          
      fileTitleInput.value = file_title;    
      filePathInput.value = file_path;      
  });
</script>


</body>
</html>
