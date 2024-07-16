<?php
if (isset($_POST['viewPdf'])) {
    $file_path = 'admin/uploads/documents/' . $_POST['file_path'];
    if (file_exists($file_path)) {
        header("Content-Type: application/pdf");
        readfile($file_path);
        exit;
    } else {
        echo "File not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include "includes/header.php"; ?>
<link rel="stylesheet" href="assets/css/style.css">

<body class="index-page">

<?php include "includes/topnav.php"; include "classes/user_view.php"; ?>

<main class="main container mt-10">
    <h1 class="text-center mt-5"><strong>BROWSE OUR ARCHIVE FILES</strong></h1>
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

            <!-- Main Content -->
            <div class="col-md-10 main-content">
                <div class="search-bar mb-4">
                    <input type="text" class="form-control search" placeholder="Search materials..." id="mainSearch">
                </div>
                <div class="row">
                    <?php foreach ($documents as $document): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card" style="height: 100%;">
                            <img src="admin/uploads/cover/<?php echo htmlspecialchars($document['cover'] ?? 'default_photo.jpg'); ?>" 
                            class="card-img-top" alt="<?php echo htmlspecialchars($document['title']); ?>" style="height: 200px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <p class="card-title" style="font-size: 16px;"><?php echo htmlspecialchars($document['title']); ?></p>
                                <div class="mt-auto">
                                   
                                    <div class="d-flex justify-content-between">
                                        <form method="post">
                                            <input type="hidden" name="file_path" value="<?php echo htmlspecialchars($document['file_path']); ?>">
                                            <button type="submit" name="viewPdf" class="btn btn-link p-0"><i class="bi bi-eye"></i> View</button>
                                        </form>
                                        <button class="btn btn-link p-0"><i class="bi bi-bookmark"></i> Bookmark</button>
                                    </div>
                                </div>
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
