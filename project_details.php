<?php
session_start();
require_once __DIR__ . '/admin/classes/Main_class.php';
require_once "classes/config.php"; 
$mainClass = new Main_class();

if (isset($_GET['project_id'])) {
    $encryptedId = $_GET['project_id']; // Get the encrypted ID from the URL
    $projectId = encryptor('decrypt', $encryptedId); // Decrypt the project ID

    if ($projectId) {
        $project_details = $mainClass->getProjectById($projectId); // Fetch project details using the decrypted ID
        if ($project_details) {
            $project = $project_details[0]; // Assuming getProjectById returns an array of results
            ?>
                        
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/header.php"; ?>
    <style>
        .custom-btn {
            border-radius: 0px !important;
        }

        .uniform-image {
            width: 100%;
            max-width: 100%;
            height: 500px;
            object-fit: cover;
        }

        .video-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        iframe {
            width: 100%;
            max-width: 800px;
            height: 450px;
            border: none;
        }
    </style>
</head>

<body class="blog-page">

<?php include "includes/topnav.php"; ?>
<main class="main ">

    <div class="page-title ">
        <div class="heading " style="background-image: url('<?php echo htmlspecialchars($project['project_image']); ?>'); background-size: cover; background-position: center;">
            <div class="container ">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <br><br>
                        <h1 class="text-light bg-secondary bg-opacity-50 p-5"><?php echo htmlspecialchars($project['banner_quote']); ?></h1>
                    </div>
                </div>
            </div>
        </div>
      
    </div>

    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-12">
                <section id="projects" class="projects_details section">
                    <div class="container">
                        <div class="row gy-4">
                            <div class="col-lg-12">
                                <h1 class="text-center"><?php echo htmlspecialchars($project['title']); ?></h1>
                                <br>
                                <h3 class="mb-2"><q><?php echo htmlspecialchars($project['header']); ?></q></h3>
                                <br>
                                <img src="<?php echo htmlspecialchars($project['project_image']); ?>" alt="Project Image" 
                                class="img-fluid uniform-image mb-4">
                                <p><?php echo htmlspecialchars($project['summary']); ?></p>
                                <hr>
                                
                                <?php
                                $sectionCount = 0;
                                foreach ($project_details as $section) {
                                    if ($section['content_type'] == 'text') {
                                        echo '<p>' . htmlspecialchars($section['content']) . '</p>';
                                    } elseif ($section['content_type'] == 'image') {
                                        if ($sectionCount % 2 == 0) {
                                            echo '<img src="' . htmlspecialchars($section['content']) . '" alt="Project Section Image" 
                                            class="img-fluid uniform-image mb-4">';
                                        } else {
                                            echo '<div class="row">';
                                            echo '<div class="col-lg-6"><img src="' . htmlspecialchars($section['content']) . '" 
                                            alt="Project Section Image" class="img-fluid uniform-image mb-4"></div>';
                                            echo '</div>';
                                        }
                                    }
                                    $sectionCount++;
                                }
                                ?>
                            </div>
                        </div>
                        <hr>

                        <?php if (!empty($project['youtube_link'])) { ?>
                        <div class="video-wrapper">
                            <iframe src="<?php echo htmlspecialchars($project['youtube_link']); ?>" ></iframe>
                        </div>
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/v3KTAD1NKas?si=wU64-jNGQ5fjhvI_" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        <?php } ?>

                    </div>
                </section>
            </div>
        </div>
    </div>

    <br><br><br><br> <br><br><br>
</main>

<?php include "includes/footer.php"; ?>
</body>
</html>

<?php
        } else {
            echo '<p>Project not found.</p>';
        }
    } else {
        echo '<p>Invalid project ID.</p>';
    }
} else {
    echo '<p>No project selected.</p>';
}
?>
