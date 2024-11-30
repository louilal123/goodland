<?php include "classes/admindetails.php"; ?>
<!DOCTYPE html>
<html lang="en"> 
<?php include "includes/header.php"; ?>
<link rel="stylesheet" href="dist/custom.css">

<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary">
    <div class="app-wrapper">
        <?php include "includes/sidebar.php"; ?>
        <div class="app-main-wrapper main-blur">
            <?php include "includes/topnav.php"; ?>
            <main class="app-main">
              
                <div class="app-content">
                    <div class="container-fluid">
                        <div class="row mt-4">
                            <div class="col-md-12">
                            <div class="card bg-gradient">
                                <div class="card-body">
                                    <div class="card-header d-flex mb-4 ml-0 pl-0">
                                        <h3 class="fw-bold"><i class="fas fa-folder-plus"></i> Add New Project</h3>
                                        <button type="button" class="btn btn-danger ms-auto btn-rounded" onclick="window.location.href='projects'">
                                            <i class="fas fa-arrow-left"></i>  
                                        </button>
                                    </div>
                                    <form action="classes/add_project.php" method="POST" enctype="multipart/form-data">
                                        <div class="row mb-3">
                                            <label class=" text-uppercase col-sm-2 col-form-label" for="project_name">
                                                <i class="fas fa-pen-square text-dark"></i> Project Title:
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="project_name" name="project_name" required>
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-3">
                                            <label class="text-uppercase col-sm-2 col-form-label" for="project_header">
                                                <i class="fas fa-pen-square text-dark"></i> Project Header:
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="project_header" name="project_header" required>
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-3">
                                            <label class="text-uppercase col-sm-2 col-form-label" for="project_image">
                                                <i class="fas fa-image text-dark"></i> Project Image:
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="file" class="form-control" id="project_image" name="project_image" accept="image/*" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="text-uppercase col-sm-2 col-form-label" for="project_description">
                                                <i class="fas fa-pen-square text-dark"></i> Project Description:
                                            </label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="project_description" name="project_description" rows="4" required></textarea>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="text-uppercase col-sm-2 col-form-label" for="project_quotation">
                                                <i class="fas fa-flag text-dark"></i> Banner Quotation:
                                            </label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="project_quotation" name="project_quotation" rows="1" required></textarea>
                                            </div>
                                        </div>

                                        <h5>PROJECT DETAILS:</h5>
                                        <div id="sections">
                                            <div class="section">
                                                <div class="row">
                                                    <label class="text-uppercase col-sm-2 col-form-label" for="content_type_1">Section 1</label>
                                                </div>
                                                <div class="row mb-1">
                                                    <label class="text-uppercase col-sm-2 col-form-label" for="content_1">Content:</label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" id="content_1" name="content[]" rows="4" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>


                                        <div class="row mb-3 mt-2">
                                            <label class="col-sm-2 col-form-label" for="youtube_link">
                                                <i class="fas fa-play-circle text-dark"></i> YouTube Video Link (Optional):
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="youtube_link" name="youtube_link" placeholder="Enter YouTube video link">
                                            </div>
                                        </div>

                                        <div class="card-footer">
                                            <div class="d-flex justify-content-end mt-3">
                                                <button type="submit" class="btn btn-primary btn-lg btn-rounded">
                                                    <span class="fas fa-save fa-lg"></span> Publish
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
 
                            </div> <!-- /.card -->
                            </div> <!-- /.col -->
                        </div> 
                    </div>
                </div>
            </main>
        </div>
    </div>
    <?php include "includes/footer.php"; ?>

</body>
</html>
