<?php
require_once __DIR__ . '/admin/classes/Main_class.php';

$mainClass = new Main_class();

if (isset($_GET['catchment_id'])) {
    $catchment_id = $_GET['catchment_id'];  // Fix variable name to $catchment_id
    $catchment_details = $mainClass->getCatchmentById($catchment_id);  // Corrected function name and variable

    if ($catchment_details) {
        $catchment = $catchment_details[0]; // Fetch the first result from the returned array
        ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "includes/header.php"; ?>
    <style>
        .custom-btn {
            border-radius: 0px !important;
        }
    </style>
</head>
<body class="blog-page">

    <?php include "includes/topnav.php";?>

    <main class="main ">
        <!-- Page Title -->
        <div class="page-title ">
            <div class="heading " style="background-image: url('projects/projectsimg.png'); background-size: cover; background-position: center;">
                <div class="container ">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <br><br>
                            <!-- Echo the catchment name here based on catchment_id -->
                            <h1><?php echo htmlspecialchars($catchment['catchment_name']); ?></h1>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs ">
                <div class="container">
                    <ol>
                        <li><a href="index.php">Home</a></li>
                        <li class="current">Catchment Details</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <section id="catchment_details" class="projects section">
                        <div class="container">
                            <div class="row gy-4">
                                <!-- Catchment Image -->
                                <div class="col-lg-6">
                                    <img src="<?php echo htmlspecialchars($catchment['catchment_img']); ?>" class="img-fluid" alt="Catchment Image">
                                </div>
                                <!-- Catchment Description -->
                                <div class="col-lg-6 d-flex flex-column justify-content-center">
                                    <h3><?php echo htmlspecialchars($catchment['catchment_name']); ?></h3>
                                    <p><?php echo htmlspecialchars($catchment['description']); ?></p>
                                    <p><strong>Location:</strong> <?php echo htmlspecialchars($catchment['location']); ?></p>
                                    <p><strong>Date Added:</strong> <?php echo htmlspecialchars($catchment['date_added']); ?></p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>

    <?php include "includes/footer.php";?>
</body>
</html>

<?php
    } else {
        echo '<p>Catchment details not found.</p>';
    }
} else {
    echo '<p>No Catchment selected.</p>';
}
?>
