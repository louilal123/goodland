<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
<?php include "includes/header.php";?>
</head> 

<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary"> 
    <div class="app-wrapper">
    <?php include "includes/sidebar.php";?>
        <div class="app-main-wrapper">
        <?php include "includes/topnav.php";?>
            
            <main class="app-main">
                <div class="app-content"> 
               <div class="row">
               <div class="card p-5 h-full">
                        <div class="card-header"> 
                                <h3 class="fw-bold text-center">Submit A Document</h3>
                                <p class="card-text text-center ">
                                    Contribute to our open source library. Once approved by our system, your document will be visible to our website.
                                </p></div>
                                <div class="card-body">
                                <form  action="classes/upload.php" method="post" enctype="multipart/form-data">
                                    <!-- Title Field -->
                                    <div class="md-form mb-3">
                                        <label class="text-dark" for="materialFileTitle">Title</label>
                                        <input type="text" id="materialFileTitle" class="form-control 
                                        <?php 
                                            if (!empty($_SESSION['error_title'])) {
                                                echo 'is-invalid';
                                            } elseif (!empty($_SESSION['form_data']['title'])) {
                                                echo 'is-valid';
                                            }
                                        ?>" name="title" value="<?php echo $_SESSION['form_data']['title'] ?? ''; ?>">
                                        <?php if (!empty($_SESSION['error_title'])): ?>
                                            <div class="invalid-feedback mb-4"><?php echo $_SESSION['error_title']; unset($_SESSION['error_title']); ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <!-- Description Field -->
                                    <div class="md-form mb-3">
                                        <label class="text-dark" for="materialFileDescription">Provide a brief description about the document you're submitting.</label>
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
                                    <!-- Cover Image Field -->
                                    <div class="md-form mb-3">
                                        <label class="text-dark" for="coverImage">Cover Image</label>
                                        <input type="file" id="coverImage" class="form-control 
                                        <?php 
                                            if (!empty($_SESSION['error_cover'])) {
                                                echo 'is-invalid';
                                            } elseif (!empty($_SESSION['form_data']['cover'])) {
                                                echo 'is-valid';
                                            }
                                        ?>" name="cover">
                                        <?php if (!empty($_SESSION['error_cover'])): ?>
                                            <div class="invalid-feedback mb-4"><?php echo $_SESSION['error_cover']; unset($_SESSION['error_cover']); ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <!-- File Field -->
                                    <div class="md-form mb-3">
                                        <label class="text-dark" for="file">File</label>
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
                                    <!-- Agreement Footer -->
                                    <div class="footer">
                                        <p class="mt">By uploading, you agree to our
                                            <a href="#" id="uploaderAgreementLink">Uploader Agreement</a>. Ensure you have the rights to share the documents you upload.
                                        </p>
                                    </div>

                                    <!-- Submit Button -->
                                    <button data-mdb-ripple-init type="submit" class="btn btn-info btn-block btn-lg mt-4">Submit <i class="fas fa-arrow-right"></i></button>
                                </form>

                        </div>
                    </div>
                    </div>
                </div> <!--end::App Content-->
               </div>
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
                <p><strong>Introduction</strong><br>By uploading content to GoodlandPh, you agree to the following terms.</p>
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
<script type="text/javascript" src="../mdbfolder/mdb.umd.min.js"></script>
    <script>
document.getElementById('uploaderAgreementLink').addEventListener('click', function(event) {
    event.preventDefault();
    var myModal = new mdb.Modal(document.getElementById('uploaderAgreementModal'));
    myModal.show();
});
</script>
            <?php include "includes/footer.php";?>
            
            
</body><!--end::Body-->

</html>