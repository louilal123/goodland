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

                                <button type="submit" class="btn btn-primary btn-block z-depth-0 mb-2 mt-4" >Upload</button>
                            </form>

                        </div>
                        <div class="footer text-center mt-5">
                            <p class="text-center mt-5">By uploading, you agree to our
                                <a href="#" id="uploaderAgreementLink">Uploader Agreement</a>
                            </p>
                            <p class="text-center">Ensure you have the rights to share the documents you upload.</p>
                        </div>

                    </div>
                </div>
            </div>


            
        </section>


    </main>
    
<!-- Modal -->
<div class="modal fade" id="uploaderAgreementModal" tabindex="-1" aria-labelledby="uploaderAgreementModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-center" id="uploaderAgreementModalLabel">Goodland Uploader Agreement</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Effective Date:</strong> July 2024</p>
                <p><strong>Introduction</strong><br>By uploading content to GoodlandPh ("Platform"), you agree to the following terms.</p>
                <p><strong>Grant of License</strong><br>You grant GoodlandPh a non-exclusive, worldwide, royalty-free license to use, reproduce, distribute, and display your content.</p>
                <p><strong>Ownership and Rights</strong><br>You retain ownership of your content. You confirm that:
                    <ul>
                        <li>You own the content or have permission to upload it.</li>
                        <li>Your content does not violate any third-party rights.</li>
                    </ul>
                </p>
                <p><strong>Content Guidelines</strong><br>Do not upload content that:
                    <ul>
                        <li>Is illegal, harmful, or abusive.</li>
                        <li>Contains viruses or malware.</li>
                        <li>Violates laws or regulations.</li>
                    </ul>
                </p>
                <p><strong>Indemnification</strong><br>You agree to indemnify GoodlandPh from any claims or damages resulting from your content or violation of this agreement.</p>
                <p><strong>Termination</strong><br>GoodlandPh may remove content or terminate your access if you violate this agreement.</p>
                <p><strong>Changes to the Agreement</strong><br>We may update this agreement and will notify you of any changes. Continued use of the platform means you accept the new terms.</p>
                <p><strong>Governing Law</strong><br>This agreement is governed by the laws of [Your Jurisdiction].</p>
                <p><strong>Contact Information</strong><br>For questions, contact us at goodland.phillipines@gmail.com.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



    <?php include "includes/footer.php"; ?>
    <script type="text/javascript" src="mdbfolder/mdb.umd.min.js"></script>
    <script>
document.getElementById('uploaderAgreementLink').addEventListener('click', function(event) {
    event.preventDefault();
    var myModal = new mdb.Modal(document.getElementById('uploaderAgreementModal'));
    myModal.show();
});
</script>

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
