<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<!-- DataTables JavaScript -->
<script defer src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script defer src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>

 <!--end::App Wrapper--> <!--begin::Script--> <!--begin::Third Party Plugin(OverlayScrollbars)-->
 <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script> <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script> <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script> <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="dist/js/adminlte.js"></script> <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
        const Default = {
            scrollbarTheme: "os-theme-light",
            scrollbarAutoHide: "leave",
            scrollbarClickScroll: true,
        };
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (
                sidebarWrapper &&
                typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
            ) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script> <!--end::OverlayScrollbars Configure--> <!--end::Script-->
    
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawVisualization);

    function drawVisualization() {
        fetch('get_visitor_data.php')
            .then(response => response.json())
            .then(chartData => {
                var data = google.visualization.arrayToDataTable(chartData);

                var options = {
                    title: 'Monthly Website Visitors By Country',
                    vAxis: {title: 'Number of Visitors'},
                    hAxis: {title: 'Month'},
                    seriesType: 'bars',
                    series: {chartData[0].length - 1: {type: 'line'}} // Last series as line
                };

                var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            })
            .catch(error => console.error('Error fetching data:', error));
    }
</script>

     <!-- swetalert  -->
     <script>
        $(document).ready(function() {
            var currentHour = new Date().getHours();
            var greeting;

            if (currentHour < 12) {
                greeting = "Good Morning";
            } else if (currentHour < 18) {
                greeting = "Good Afternoon";
            } else {
                greeting = "Good Evening";
            }

            $('#greeting').text(greeting);
        });
    </script>
     <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation');

    forms.forEach((form) => {
        form.addEventListener('submit', (event) => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            // Only add Bootstrap's validation class if custom validation passed
            if (!form.classList.contains('was-validated')) {
                form.classList.add('was-validated');
            }
        }, false);
    });
});

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


    <script>
      document.getElementById('logout').addEventListener('click', function() {
    Swal.fire({
        title: 'Are you sure you want to logout?',
        text: "You will need to login again to access your account.",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonColor: '#3085d6',
       
         cancelButtonText: 'Cancel',
        confirmButtonText: 'Logout'
       
    }).then((result) => {
        if (result.isConfirmed) {
           
            window.location.href = 'classes/logout.php'; 
        }
    });
});

    </script>
<script>
    // Initialization for ES Users
import { Modal, Ripple, initMDB } from "mdb-ui-kit";

initMDB({ Modal, Ripple });
</script>
    
<!-- <script
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
></script> -->

