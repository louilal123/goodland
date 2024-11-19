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
                    <img src="admin/<?php echo $file['cover_path']; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($file['title']); ?>" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo htmlspecialchars($file['title']); ?></h5>
                      <input type="hidden"  value="<?php echo htmlspecialchars($file['file_path']); ?>">
                      <p class="card-text"><i><?php echo htmlspecialchars($file['description']); ?></i></p>
                     <button data-toggle="modal" 
        data-target="#requestModal" 
        data-file-id="<?php echo $file['id']; ?>" 
        data-file-path="<?php echo $file['file_path']; ?>"
        data-file-title="<?php echo htmlspecialchars($file['title']); ?>"
        class="btn custom-btn request-copy-btn">
    Request a Copy  <i class="bi bi-arrow-right"></i>
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


<br><br><br><br> <br><br><br>
<?php include "includes/footer.php";?>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    <?php if (isset($_SESSION['form_data'])): ?>
    
    if (window.location.hash === '#requestModal') {
        // Ensure the modal is triggered
        var myModal = new bootstrap.Modal(document.getElementById('requestModal'), {
            backdrop: 'static', // Prevents closing the modal by clicking outside
            keyboard: false // Prevents closing the modal by pressing the keyboard
        });
        myModal.show();
        <?php unset($_SESSION['form_data']); // Clear form data after showing modal ?>
        <?php endif; ?>
    }
});
</script>
<script>
    // When the page loads, check if the URL contains the error hash
    window.onload = function() {
        if (window.location.hash === '#error#requestModal') {
            // Open the modal if the error fragment is present
            $('#requestModal').modal('show');
        }
    };
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const requestButtons = document.querySelectorAll('.request-copy-btn');  // Select all request buttons
  const fileIdInput = document.getElementById('fileId');
  const filePathInput = document.getElementById('filePath');
  const fileTitleInput = document.getElementById('file-title');  // Hidden input for file title
  const fileTitleElement = document.getElementById('file-title-element');  // Element where file title is displayed in modal

  // Iterate through all buttons
  requestButtons.forEach(button => {
    button.addEventListener('click', function() {
      // Get the data attributes from the button
      const fileId = this.getAttribute('data-file-id');
      const filePath = this.getAttribute('data-file-path');
      const fileTitle = this.getAttribute('data-file-title');  // Getting file title

      // Set the values to the hidden inputs and modal display elements
      fileIdInput.value = fileId;         // Set file ID
      filePathInput.value = filePath;     // Set file path
      fileTitleInput.value = fileTitle;   // Set the hidden input for file title
      fileTitleElement.textContent = fileTitle;  // Set the file title in the modal display

      // Optionally, also update the visible title in the modal
      document.getElementById('file-title-display').textContent = fileTitle;
    });
  });
});

</script>



</body>
</html>
