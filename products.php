<?php include "classes/products_view.php"; ?>
<!DOCTYPE html>
<html lang="en">

<?php include "includes/header.php"; ?>
<style>
  .header{
    background-color: black !important;
  }
    .card:hover {
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      transform: scale(1.02);
      transition: transform 0.2s;
    }
    .star-rating {
      color: gold;
    }
  </style>

<body class="index-page">

<?php include "includes/topnav.php"; ?>

  <main class="main">

    <!-- Services Section -->
    <section id="services" class="services section" style="padding-top: 150px !important; background-color: white;  background-repeat: no-repeat; background-size: cover;">
    <!-- background: url(uploads/background-product.jpg); -->
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up" >
        <h2>Products</h2>
        <p>Check our Products</p>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="row" id="products-container">
            <?php if ($products): ?>
                <?php foreach ($products as $product): ?>
                    <div class="col-12 col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="card">
                            <img src="<?= htmlspecialchars($product["image_url"]) ?>" class="card-img-top" alt="<?= htmlspecialchars($product["product_name"]) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($product["product_name"]) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($product["description"]) ?></p>
                                <p class="card-text"><strong>Price:</strong> Pesos <?= htmlspecialchars($product["price"]) ?></p>
                                <div class="mb-2">
                                    <span class="star-rating"><?= getStarRating($product["rating"]) ?></span>
                                    <span>(<?= htmlspecialchars($product["review_count"]) ?> reviews)</span>
                                </div>
                                <a href="#" class="btn btn-secondary">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No products found.</p>
            <?php endif; ?>
        </div>
    </div>

      </div>

    </section><!-- /Services Section -->


  </main>
<?php include "includes/footer.php"; ?>
</body>

</html>