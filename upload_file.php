<?php
include "classes/user_view.php";
?>
<!DOCTYPE html>
<html lang="en">

<?php include "includes/header.php"; ?>
<link rel="stylesheet" href="mdbfolder/mdb.min.css">
<link rel="stylesheet" href="assets/style.css">

<body class="index-page">
<?php include "includes/topnav.php"; 
include "classes/user_view.php";
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header('Location: error/index.php');
    exit();
}?>
    <main class="main">
        <section class="services section">
            <div class="container">
                <div class="row">
                    <!-- Upload Form -->
                    <div class="col-md-8 offset-md-2 mt-2 mb-5">
                        <div class="card shadow-lg">
                        <div class="card-body">
                            <h3 class="card-title text-center">Share Your Knowledge</h3>
                            <p class="card-text text-center">
                                Contribute to our library with your valuable documents and resources
                            </p>
 <form style="color: #757575;" action="classes/upload.php" method="post" enctype="multipart/form-data">
    <div class="md-form mb-3">
        <label for="materialFileTitle">Title</label>
        <input type="text" id="materialFileTitle" class="form-control 
        <?php 
            if (!empty($_SESSION['error_title'])) {
                echo 'is-invalid';
            } elseif (!empty($_SESSION['form_data']['title'])) {
                echo 'is-valid';
            }
        ?>" name="title" 
        value="<?php echo $_SESSION['form_data']['title'] ?? ''; ?>">
        <?php if (!empty($_SESSION['error_title'])): ?>
            <div class="invalid-feedback mb-4"><?php echo $_SESSION['error_title']; unset($_SESSION['error_title']); ?></div>
        <?php endif; ?>
    </div>

    <div class="md-form mb-3">
        <label for="materialFileDescription">Description</label>
        <textarea id="materialFileDescription" class="form-control 
        <?php 
            if (!empty($_SESSION['error_description'])) {
                echo 'is-invalid';
            } elseif (!empty($_SESSION['form_data']['description'])) {
                echo 'is-valid';
            }
        ?>" name="description"><?php echo $_SESSION['form_data']['description'] ?? ''; ?></textarea>
        <?php if (!empty($_SESSION['error_description'])): ?>
            <div class="invalid-feedback mb-4"><?php echo $_SESSION['error_description']; unset($_SESSION['error_description']); ?></div>
        <?php endif; ?>
    </div>

    <div class="md-form mb-3">
        <label for="materialFileType">File Type</label>
        <select id="materialFileType" class="form-control 
        <?php 
            if (!empty($_SESSION['error_file_type'])) {
                echo 'is-invalid';
            } elseif (!empty($_SESSION['form_data']['file_type'])) {
                echo 'is-valid';
            }
        ?>" name="file_type">
            <option value="" disabled selected>Select file type</option>
            <option value="Documents" <?php echo (isset($_SESSION['form_data']['file_type']) && $_SESSION['form_data']['file_type'] == 'Documents') ? 'selected' : ''; ?>>Documents</option>
            <option value="Images" <?php echo (isset($_SESSION['form_data']['file_type']) && $_SESSION['form_data']['file_type'] == 'Images') ? 'selected' : ''; ?>>Images</option>
            <option value="Audio" <?php echo (isset($_SESSION['form_data']['file_type']) && $_SESSION['form_data']['file_type'] == 'Audio') ? 'selected' : ''; ?>>Audio</option>
            <option value="Maps" <?php echo (isset($_SESSION['form_data']['file_type']) && $_SESSION['form_data']['file_type'] == 'Maps') ? 'selected' : ''; ?>>Maps</option>
            <option value="Arts" <?php echo (isset($_SESSION['form_data']['file_type']) && $_SESSION['form_data']['file_type'] == 'Arts') ? 'selected' : ''; ?>>Arts</option>
        </select>
        <?php if (!empty($_SESSION['error_file_type'])): ?>
            <div class="invalid-feedback mb-4"><?php echo $_SESSION['error_file_type']; unset($_SESSION['error_file_type']); ?></div>
        <?php endif; ?>
    </div>

    <div class="md-form mb-3">
        <label for="file">File</label>
        <input type="file" id="file" class="form-control 
        <?php 
            if (!empty($_SESSION['error_file'])) {
                echo 'is-invalid';
            } elseif (!empty($_SESSION['form_data']['file'])) {
                echo 'is-valid';
            }
        ?>" name="file">
        <?php if (!empty($_SESSION['error_file'])): ?>
            <div class="invalid-feedback mb-4"><?php echo $_SESSION['error_file']; unset($_SESSION['error_file']); ?></div>
        <?php endif; ?>
    </div>

    <button type="submit" class="btn btn-primary btn-block z-depth-0 mb-2 mt-4" data-mdb-ripple-init>Upload</button>
</form>

                               
                        </div>
                        <div class="footer text-center mt-5">
                                    <p class="text-center mt-5">By uploading, you agree to our <a href="#">Uploader Agreement</a></p>
                                    <p class="text-center">Ensure you have the rights to share the documents you upload.</p>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include "includes/footer.php"; ?>
    <script type="text/javascript" src="mdbfolder/mdb.umd.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('file');
            const fileNameDisplay = document.getElementById('file-name');

            // Restore the file input state from session storage
            if (sessionStorage.getItem('fileName')) {
                fileNameDisplay.textContent = sessionStorage.getItem('fileName');
            }

            // Save the file input state to session storage before form submission
            fileInput.addEventListener('change', function() {
                if (fileInput.files.length > 0) {
                    const fileName = fileInput.files[0].name;
                    fileNameDisplay.textContent = fileName;
                    sessionStorage.setItem('fileName', fileName);
                } else {
                    fileNameDisplay.textContent = '';
                    sessionStorage.removeItem('fileName');
                }
            });

            document.getElementById('uploadForm').addEventListener('submit', function() {
                if (fileInput.files.length > 0) {
                    sessionStorage.setItem('fileName', fileInput.files[0].name);
                } else {
                    sessionStorage.removeItem('fileName');
                }
            });
        });
    </script>

</body>
</html>
