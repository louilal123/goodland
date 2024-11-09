
<footer id="footer" class="footer">


    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="d-flex align-items-center">
            <span class="sitename">GOODLand</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Sitio 37st, Atop Atop</p>
            <p>Bantayan Island, Cebu, Philippines</p>
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
            <li><i class="bi bi-chevron-right"></i> <a href="#">Water Data</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Events</a></li>
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
        Team <a href="https://bootstrapmade.com/">4SOUTH</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center" 
  style="background-color: #0062cc !important;"><i class="bi bi-arrow-up-short"></i></a>
<!-- Cookie Banner -->
<div id="cb-cookie-banner" class="alert alert-dark text-center mb-0 bg-dark text-white" role="alert" data-aos="fade-up">
    🍪 We use cookies to ensure you get the best experience on our website.
    <a href="#" data-bs-toggle="modal" data-bs-target="#cookieModal">Learn more</a>
    <br><br>
    <button type="button" class="btn btn-success btn-sm ms-3" onclick="window.cb_acceptAllCookies()">
        Accept All
    </button>
    
    <button type="button" class="btn btn-danger btn-sm ms-3" onclick="window.cb_declineCookies()">
        Decline
    </button>
</div>

<!-- Bootstrap Modal -->
<div class="modal fade" id="cookieModal" tabindex="-1" aria-labelledby="cookieModalLabel" aria-hidden="true" data-aos="slide-up"data-aos-delay="100">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header text-light">
                <h5 class="modal-title" id="cookieModalLabel">What are Cookies?</h5>
                <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Cookies are small text files stored on your browser. They help enhance user experience by remembering preferences, login information, and other settings.</p>
                <p>Some cookies are essential for the website's functionality, while others help us analyze how visitors use the website.</p>
                <p>By accepting cookies, you help us provide a more personalized and functional experience.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- <script src="assets/vendor/php-email-form/validate.js"></script> -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <!-- <script src="mdbfolder\mdb.umd.min.js"></script> -->

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

  <?php if (isset($_SESSION['status']) && $_SESSION['status'] != ''): ?>
        <script>
            Swal.fire({
                icon: "<?php echo $_SESSION['status_icon']; ?>", // e.g., 'warning', 'error', 'success'
                title: "<?php echo $_SESSION['status']; ?>",
                color: 'white',  
                background: '#161616',
                confirmButtonColor: "#0062cc",  // The message (like 'Account not activated')
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

<script>
  function showCookieBanner() {
    let cookieBanner = document.getElementById("cb-cookie-banner");
    cookieBanner.style.display = "block";
    cookieBanner.classList.add("slide-in");
   
   

}

function hideCookieBanner(choice) {
    localStorage.setItem("cb_isCookieAccepted", choice);
    let cookieBanner = document.getElementById("cb-cookie-banner");
    cookieBanner.style.display = "none";
}

function initializeCookieBanner() {
    let isCookieAccepted = localStorage.getItem("cb_isCookieAccepted");
    if (isCookieAccepted === null) {
        localStorage.setItem("cb_isCookieAccepted", "no");
        setTimeout(showCookieBanner, 2000);
    }
    if (isCookieAccepted === "no") {
        setTimeout(showCookieBanner, 2000);
    }
}

window.onload = initializeCookieBanner();
window.cb_acceptAllCookies = () => hideCookieBanner("all");
window.cb_acceptNecessaryCookies = () => hideCookieBanner("necessary");
window.cb_declineCookies = () => hideCookieBanner("decline");

</script>

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
    <!-- end  -->


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
