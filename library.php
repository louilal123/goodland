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
    .card-img{
      height: 200px;
    }
    .services{
      background-color: white;  background-repeat: no-repeat; background-size: cover;
    }
    @media (min-width: 1200px) {
      .services{
        padding-top: 150px !important; 
      }
    }
    @media (max-width: 768px) {
      .services {
        padding-top: 100px; 
      }
    }
   
  </style>

<body class="index-page">

<?php include "includes/topnav.php"; ?>

  <main class="main">

    <!-- Services Section -->
    <section class="services section" style="">
    <!-- background: url(uploads/background-product.jpg); -->
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up" >
        <h2>Products</h2>
        <p>Library</p>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="row" id="products-container">
            
        </div>
    </div>

      </div>

    </section><!-- /Services Section -->


  </main>
<?php include "includes/footer.php"; ?>
</body>

</html>