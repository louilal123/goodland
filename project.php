<?php include "classes/config.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/header.php"; ?>
</head>
<style>
    .custom-btn {
        border-radius: 0px !important;
    }
</style>

<body class="blog-page">

<?php include "includes/topnav.php"; ?>

<main class="main">
    <!-- Page Title -->
    <div class="page-title">
        <div class="heading" style="background-size: cover; background-position: center; background: linear-gradient(to top, rgba(38, 37, 37, 0.1), rgba(22, 22, 22, 0.1)); z-index: -1;">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <br><br>
                        <h1 class="text-dark"><i class="bi bi-bag text-secondary"></i> Projects</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Title -->
<section class="section values">


<div class="container">
        <div class="row">
            <div class="col-lg-12">
                <section id="projects" class="projects section">
                    <div class="container">
                        <?php foreach ($projects as $index => $project): ?>
                            <div class="row gy-4">
                                <?php if ($index % 2 == 0): ?>
                                    <!-- Even projects: Image on the left, text on the right -->
                                    <div class="col-lg-6 order-1 d-flex flex-column justify-content-center">
                                        <img src="<?php echo $project['project_image']; ?>" class="img-fluid" alt="Project Image">
                                    </div>
                                    <div class="col-lg-6 order-2 d-flex flex-column justify-content-center">
                                        <h1 data-aos="fade-up" style="font-weight: bold !important;">
                                            <?php echo htmlspecialchars($project['title']); ?>
                                        </h1>
                                        <h3 data-aos="fade-up" data-aos-delay="50" style="font-style: italic;">
                                            <?php echo htmlspecialchars($project['header']); ?>
                                        </h3>
                                        <p data-aos="fade-up" data-aos-delay="100">
                                            <?php echo htmlspecialchars($project['summary']); ?>
                                        </p>
                                       
                                        <div class="d-flex flex-column flex-md-row" data-aos="fade-up" data-aos-delay="200">
                                            <span class="badge-secondary">
                                                <a href="project_details.php?project_id=<?php echo encryptor('encrypt', $project['project_id']); ?>" class="btn custom-btn">
                                                    Learn More <i class="bi bi-arrow-right"></i>
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <!-- Odd projects: Text on the left, image on the right -->
                                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                                        <h1 data-aos="fade-up" style="font-weight: bold !important;">
                                            <?php echo htmlspecialchars($project['title']); ?>
                                        </h1>
                                        <h3 data-aos="fade-up" data-aos-delay="50" style="font-style: italic;">
                                            <?php echo htmlspecialchars($project['header']); ?>
                                        </h3>
                                        <p data-aos="fade-up" data-aos-delay="100">
                                            <?php echo htmlspecialchars($project['summary']); ?>
                                        </p>
                                        <!-- YouTube Link -->
                                       
                                        <div class="d-flex flex-column flex-md-row" data-aos="fade-up" data-aos-delay="200">
                                            <span class="badge-secondary">
                                                <a href="project_details.php?project_id=<?php echo encryptor('encrypt', $project['project_id']); ?>" class="btn custom-btn">
                                                    Learn More <i class="bi bi-arrow-right"></i>
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 order-1 order-lg-2 d-flex flex-column justify-content-center">
                                        <img src="<?php echo htmlspecialchars($project['project_image']); ?>" class="img-fluid" alt="Project Image">
                                    </div>
                                <?php endif; ?>
                            </div>
                            <hr> <!-- Optional: separator between projects -->
                        <?php endforeach; ?>
                    </div>
                </section>
            </div>
        </div>
    </div>

</section>
    <br><br><br><br><br><br><br><br><br>
</main>

<?php include "includes/footer.php"; ?>

</body>
</html>
