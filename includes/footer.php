
<footer id="footer" class="footer">


    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="d-flex align-items-center">
            <span class="sitename">GOODLand</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Sitio 37, Example Brgy.</p>
            <p>Bantayan Island, Philippines</p>
            <p class="mt-3"><strong>Phone:</strong> <span>09451295199</span></p>
            <p><strong>Email:</strong> <span>goodland.phillipines@gmail.com</span></p>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="/">Home</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">About</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Projects</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Methodology</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4 style="color: #000 !important;">.</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Stories</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Story Maps</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Archives</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#contact">Contact Us</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-12">
          <h4>CONNECT WITH US</h4>
          <p>You dont have to follow us into the ocean. But you can always follow us on social media.</p>
          <div class="social-links d-flex">
            <a href="https://www.facebook.com/goodland.philippines/"><i class="bi bi-facebook"></i></a>
            <a href="https://www.youtube.com/@goodland4831"><i class="bi bi-instagram"></i></a>
            <a href="https://www.instagram.com/goodland.philippines"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">GOODLand Version 2</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Team <a href="https://bootstrapmade.com/">4SOUTH</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

  <?php if (isset($_SESSION['status']) && $_SESSION['status'] != ''): ?>
        <script>
            Swal.fire({
                icon: "<?php echo $_SESSION['status_icon']; ?>", // e.g., 'warning', 'error', 'success'
                title: "<?php echo $_SESSION['status']; ?>",    // The message (like 'Account not activated')
                confirmButtonText: "Ok"
            });
        </script>
        <?php
        // Clear the session status after showing the message
        unset($_SESSION['status']);
        unset($_SESSION['status_icon']);
        ?>
    <?php endif; ?>

    <script type="text/javascript" src="mdbfolder/mdb.umd.min.js"></script>
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

<script
    disable-devtool-auto
    src='https://cdn.jsdelivr.net/npm/disable-devtool'
    md5='xxx'
    url='xxx'
    tk-name='xxx'
    interval='xxx'
    disable-menu='xxx'
    detectors='xxx'
    clear-log='true'
    disable-select='true'
    disable-copy='true'
    disable-cut='true'
    disable-paste='true'
></script>
