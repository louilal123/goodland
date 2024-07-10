

<footer id="footer" class="footer dark-background">

<div class="footer-top">
  <div class="container">
    <div class="row ms-auto">
      <div class="col-lg-12 col-md-12 footer-about">
        <a href="index.php" class="logo d-flex align-items-center">
          <span class="sitename">GoodLand</span>
        </a>
        <div class="footer-contact pt-3">
          <p>Purok Kulo 2, Atop-Atop</p>
          <p>Bantayan 6053, Cebu </p>
          <p class="mt-3"><strong>Phone:</strong> <span>+31613413084</span></p>
          <p><strong>Email:</strong> <span>goodland.philippines@gmail.com</span></p>
        </div>
        <div class="social-links d-flex mt-4">
          <a href=""><i class="bi bi-twitter-x"></i></a>
          <a href=""><i class="bi bi-facebook"></i></a>
          <a href=""><i class="bi bi-instagram"></i></a>
          <a href=""><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
<!-- 
      <div class="col-lg-2 col-md-3 footer-links">
        <h4>Useful Links</h4>
        <ul>
          <li><i class="bi bi-chevron-right"></i> <a href="#"> Home</a></li>
          <li><i class="bi bi-chevron-right"></i> <a href="#"> About us</a></li>
          <li><i class="bi bi-chevron-right"></i> <a href="#"> Services</a></li>
          <li><i class="bi bi-chevron-right"></i> <a href="#"> Terms of service</a></li>
          <li><i class="bi bi-chevron-right"></i> <a href="#"> Privacy policy</a></li>
        </ul>
      </div>

      <div class="col-lg-2 col-md-3 footer-links">
        <h4>Our Services</h4>
        <ul>
          <li><i class="bi bi-chevron-right"></i> <a href="#"> Web Design</a></li>
          <li><i class="bi bi-chevron-right"></i> <a href="#"> Web Development</a></li>
          <li><i class="bi bi-chevron-right"></i> <a href="#"> Product Management</a></li>
          <li><i class="bi bi-chevron-right"></i> <a href="#"> Marketing</a></li>
          <li><i class="bi bi-chevron-right"></i> <a href="#"> Graphic Design</a></li>
        </ul>
      </div> -->
<!-- 
      <div class="col-lg-4 col-md-12 footer-newsletter">
        <h4>Our Newsletter</h4>
        <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>
        <form action="forms/newsletter.php" method="post" class="php-email-form">
          <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
          <div class="loading">Loading</div>
          <div class="error-message"></div>
          <div class="sent-message">Your subscription request has been sent. Thank you!</div>
        </form>
      </div> -->

    </div>
  </div>
</div>

<div class="copyright">
  <div class="container text-center">
    <p>© <span>Copyright 2024</span> <strong class="px-1 sitename">GoodLand</strong> <span>All Rights Reserved</span></p>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you've purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
      <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
    </div>
  </div>
</div>

</footer>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<!-- <div id="preloader"></div> -->

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>

<!-- Main JS File -->
<script src="assets/js/main.js"></script>


<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
     <!-- swetalert  -->
     <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
     <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
import { Input, Ripple, initMDB } from "mdb-ui-kit";

initMDB({ Input, Ripple });

(() => {
  'use strict';

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation');

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms).forEach((form) => {
    form.addEventListener('submit', (event) => {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  });
})();
   </script>
<!-- ajax codes  for viwing modals etc autopopulate-->
<script src="dist\js\customajax.js"></script>

   <script>
  $(window).on('load', function() {
    setTimeout(function() {
      $('#loader').fadeOut('slow');
    }, 1000); 
  });
</script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
           
        });
    });

    
</script>

<!-- modal sweet alert  -->


<!-- crud sweetalerts  this is included inside all the pages below uaing include-->
<script>
 document.addEventListener("DOMContentLoaded", function() {
                <?php if (!empty($_SESSION['status']) && !empty($_SESSION['status_icon'])): ?>
                    Swal.fire({
                        icon: '<?php echo $_SESSION['status_icon']; ?>',
                        title: '<?php echo $_SESSION['status']; ?>',
                    });
                    <?php
                    unset($_SESSION['status']);
                    unset($_SESSION['status_icon']);
                    ?>
                <?php endif; ?>
            });
        </script>

<!-- end  -->

<?php if (isset($_SESSION['status1']) && $_SESSION['status1'] != '') { ?>
  <script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: false,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        }
    });

    Toast.fire({
      icon: "<?php echo $_SESSION['status_icon1']; ?>",
        title: "<?php echo $_SESSION['status1']; ?>"
    });
</script>
        <?php
        unset($_SESSION['status1']);
        unset($_SESSION['status_icon1']);
    }
    ?> 