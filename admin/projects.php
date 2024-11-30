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
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex mb-3">
                                            <h3 class="fw-bold"><i class="fas fa-folder-plus"></i> List of Projects</h3>
                                            <button type="button" class="btn btn-sm btn-primary ms-auto btn-rounded" data-bs-toggle="modal" data-bs-target="#addProjectModal">
    <i class="fas fa-folder-plus"></i> Create New
</button>

                                        </div>
                                        <table id="myTable" class="table table-bordered table-hover table-striped text-center w-100">
                                            <thead class="table-secondary fw-bold">
                                                <tr>
                                                    <th>Title</th>
                                                    <th width="40%">Banner Quote</th>
                                                    <th>Project Image</th>
                                                    <th>Date Created</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($projects as $project): ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($project['title']); ?></td>
                                                        <td><?php echo htmlspecialchars($project['banner_quote']); ?></td>
                                                        <td>
                                                            <img src="../<?php echo htmlspecialchars($project['project_image']) ?: 'default_image.jpg'; ?>" 
                                                                style="height: 50px; width: 100px;">
                                                        </td>
                                                        <td><?php echo date("M d, Y h:i A", strtotime($project['created_at'])); ?></td>
                                                        <td>
                                                        <a href="#" 
   class="btn btn-sm btn-success editProjectBtn" 
   data-bs-toggle="modal" 
   data-bs-target="#editProjectModal"
   data-id="<?php echo htmlspecialchars($project['project_id']); ?>"
   data-title="<?php echo htmlspecialchars($project['title']); ?>"
   data-header="<?php echo htmlspecialchars($project['header']); ?>"
   data-image="<?php echo htmlspecialchars($project['project_image']); ?>"
   data-summary="<?php echo htmlspecialchars($project['summary']); ?>"
   data-quote="<?php echo htmlspecialchars($project['banner_quote']); ?>"
   data-youtube="<?php echo htmlspecialchars($project['youtube_link']); ?>">
   <i class="bi bi-pencil-square"></i> Edit
</a>


                                                      
                                                            <a href="classes/delete_project.php?project_id=
                                                                <?php echo $project['project_id']; ?>" class="btn btn-sm btn-danger btn-sm deleteBtn">
                                                                <i class="fas fa-trash"></i> Delete
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>



                            </div> <!-- /.col -->
                        </div> 
                    </div>
                </div>
            </main>
        </div>
    </div>

<!-- Modal for adding new project -->
<div class="modal fade" id="addProjectModal" tabindex="-1" aria-labelledby="addProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-gradient">
            <div class="modal-header">
                <h5 class="modal-title" id="addProjectModalLabel"><i class="fas fa-folder-plus"></i> Add New Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="classes/add_project.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <!-- Project Title -->
                    <div class="mb-4">
                        <label class="form-label text-uppercase" for="project_name">
                            <i class="fas fa-pen-square text-dark"></i> Project Title:
                        </label>
                        <input type="text" class="form-control" id="project_name" name="project_name" required>
                    </div>
                    
                    <!-- Project Header -->
                    <div class="mb-4">
                        <label class="form-label text-uppercase" for="project_header">
                            <i class="fas fa-pen-square text-dark"></i> Project Header:
                        </label>
                        <input type="text" class="form-control" id="project_header" name="project_header" required>
                    </div>
                    
                    <!-- Project Image -->
                    <div class="mb-4">
                        <label class="form-label text-uppercase" for="project_image">
                            <i class="fas fa-image text-dark"></i> Project Image:
                        </label>
                        <input type="file" class="form-control" id="project_image" name="project_image" accept="image/*" required>
                    </div>

                    <!-- Project Description -->
                    <div class="mb-4">
                        <label class="form-label text-uppercase" for="project_description">
                            <i class="fas fa-pen-square text-dark"></i> Project Description:
                        </label>
                        <textarea class="form-control" id="project_description" name="project_description" rows="4" required></textarea>
                    </div>

                    <!-- Banner Quotation -->
                    <div class="mb-4">
                        <label class="form-label text-uppercase" for="project_quotation">
                            <i class="fas fa-flag text-dark"></i> Banner Quotation:
                        </label>
                        <textarea class="form-control" id="project_quotation" name="project_quotation" rows="1" required></textarea>
                    </div>

                    <!-- YouTube Video Link (Optional) -->
                    <div class="mb-4">
                        <label class="form-label text-uppercase" for="youtube_link">
                            <i class="fas fa-play-circle text-dark"></i> YouTube Video Link (Optional):
                        </label>
                        <input type="text" class="form-control" id="youtube_link" name="youtube_link" placeholder="Enter YouTube video link">
                    </div>

                </div>
                <!-- Modal Footer with Submit Button -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary  btn-rounded">
                        <span class="fas fa-save"></span> Save
                    </button>
                    <button type="button" class="btn btn-secondary  btn-rounded" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="editProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-gradient">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="editProjectModalLabel">
                    <i class="fas fa-edit"></i> Edit Project
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Form Start -->
            <form action="classes/edit_project.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <!-- Hidden Field for Project ID -->
                    <input type="hidden" id="edit_project_id" name="project_id">

                    <!-- Project Title -->
                    <div class="mb-4">
                        <label class="form-label text-uppercase" for="edit_project_name">
                            <i class="fas fa-pen-square text-dark"></i> Project Title:
                        </label>
                        <input type="text" class="form-control" id="edit_project_name" name="project_name" required>
                    </div>

                    <!-- Project Header -->
                    <div class="mb-4">
                        <label class="form-label text-uppercase" for="edit_project_header">
                            <i class="fas fa-heading text-dark"></i> Project Header:
                        </label>
                        <input type="text" class="form-control" id="edit_project_header" name="project_header" required>
                    </div>

                   <!-- Current Project Image -->
<div class="mb-4">
    <label class="form-label text-uppercase" for="current_project_image">
        <i class="fas fa-image text-dark"></i> Current Project Image:
    </label>
    <div>
        <img id="current_project_image_preview" src="" alt="Project Image" style="height: 100px; width: auto;">
    </div>
    <!-- Hidden Input for Current Project Image Path -->
    <input type="hidden" id="current_project_image_path" name="current_project_image">
</div>

                    <!-- New Project Image -->
                    <div class="mb-4">
                        <label class="form-label text-uppercase" for="edit_project_image">
                            <i class="fas fa-upload text-dark"></i> Upload New Project Image:
                        </label>
                        <input type="file" class="form-control" id="edit_project_image" name="project_image" accept="image/*">
                    </div>

                    <!-- Project Description -->
                    <div class="mb-4">
                        <label class="form-label text-uppercase" for="edit_project_description">
                            <i class="fas fa-align-left text-dark"></i> Project Description:
                        </label>
                        <textarea class="form-control" id="edit_project_description" name="project_description" rows="4" required></textarea>
                    </div>

                    <!-- Banner Quotation -->
                    <div class="mb-4">
                        <label class="form-label text-uppercase" for="edit_project_quotation">
                            <i class="fas fa-quote-left text-dark"></i> Banner Quotation:
                        </label>
                        <textarea class="form-control" id="edit_project_quotation" name="project_quotation" rows="1" required></textarea>
                    </div>

                    <!-- YouTube Video Link -->
                    <div class="mb-4">
                        <label class="form-label text-uppercase" for="edit_youtube_link">
                            <i class="fas fa-link text-dark"></i> YouTube Video Link:
                        </label>
                        <input type="text" class="form-control" id="edit_youtube_link" name="youtube_link" placeholder="Enter YouTube video link">
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-rounded">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                    <button type="button" class="btn btn-secondary btn-rounded" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


    <?php include "includes/footer.php"; ?>

    <script>
document.addEventListener("DOMContentLoaded", function () {
    const editButtons = document.querySelectorAll(".editProjectBtn");
    
    editButtons.forEach(button => {
        button.addEventListener("click", function () {
            const projectId = button.getAttribute("data-id");
            const title = button.getAttribute("data-title");
            const header = button.getAttribute("data-header");
            const image = button.getAttribute("data-image") || "default_image.jpg";
            const summary = button.getAttribute("data-summary");
            const quote = button.getAttribute("data-quote");
            const youtubeLink = button.getAttribute("data-youtube");

            // Populate the modal fields with the project data
            document.getElementById("edit_project_id").value = projectId;
            document.getElementById("edit_project_name").value = title;
            document.getElementById("edit_project_header").value = header;
            document.getElementById("current_project_image_preview").src = "../" + image; // Update preview
            document.getElementById("current_project_image_path").value = image; // Set hidden input
            document.getElementById("edit_project_description").value = summary;
            document.getElementById("edit_project_quotation").value = quote;
            document.getElementById("edit_youtube_link").value = youtubeLink;
        });
    });
});

</script>



    <script>
    $(document).ready(function() {
        $('.deleteBtn').on('click', function(e) {
            e.preventDefault(); 

            const href = $(this).attr('href'); 

            Swal.fire({
                title: 'Are you sure?',
                text: 'This project will be deleted!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href; 
                }
            });
        });
    });
</script>

</body>
</html>
