
<footer id="footer" class="footer">


    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="d-flex align-items-center">
            <span class=" text-light">GOODLand</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Sitio 37st, Atop Atop</p>
            <p>Bantayan Island, Cebu, Philippines</p>
            <p class="mt-3"><strong>Phone:</strong> <span>09451295199</span></p>
            <p><strong>Email:</strong> <span>goodland.phillipines@gmail.com</span></p>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4 class="text-light">Useful Links</h4>
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
            <li><i class="bi bi-chevron-right"></i> <a href="#">E-SAWOD</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Events</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Archives</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#contact">Contact Us</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-12">
          <h4 class="text-light">CONNECT WITH US</h4>
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
      <p>© <span>Copyright</span> <strong class="px-1 ">GOODLand Version 2</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        Team <a href="">4SOUTH</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center" 
  style="background-color: #0062cc !important;"><i class="bi bi-arrow-up-short"></i></a>
<!-- Cookie Banner -->

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- <script src="assets/vendor/php-email-form/validate.js"></script> -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <script src="assets/js/main.js"></script>

  <?php if (isset($_SESSION['status']) && $_SESSION['status'] != ''): ?>
        <script>
            Swal.fire({
                icon: "<?php echo $_SESSION['status_icon']; ?>",
                title: "<?php echo $_SESSION['status']; ?>",
                color: '#0062cc',  
                background: '#fff',
                confirmButtonColor: "#0062cc",  
                confirmButtonText: "Ok"
            });
        </script>
        <?php
        unset($_SESSION['status']);
        unset($_SESSION['status_icon']);
        ?>
    <?php endif; ?>




<!-- crud sweetalerts  this is included inside all the pages below uaing include-->
<?php
if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
?>
<script>
Swal.fire({
    icon: "<?php echo $_SESSION['status_icon']; ?>",
    title: "<?php echo $_SESSION['status']; ?>",
    confirmButtonText: "Ok"
});
</script>
<?php
unset($_SESSION['status']);
unset($_SESSION['status_icon']);
}
?>

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

   
