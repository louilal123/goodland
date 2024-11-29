<?php include "classes/admindetails.php"; ?>
<!DOCTYPE html>
<html lang="en"> 
<?php include "includes/header.php"; ?>
<title>E Sawod Data</title>
</head>
<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary">

<div class="app-wrapper">
    <?php include "includes/sidebar.php"; ?>
    
    <div class="app-main-wrapper">
        <?php include "includes/topnav.php"; ?>
        
        <main class="app-main">
            <div class="app-content">
                <div class="container-fluid">
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header d-flex">
                                    <h3 class="fw-bold">Esawod Readings</h3>
                                    <a href="sensor_delete.php" class="btn btn-danger ms-auto deleteBtn"><i class="fas fa-trash"></i> Delete All</a>
                                </div>

                                <div class="card-body">
                                    <form method="POST" action="">
                                        <div class="row mb-3">
                                            <div class="col-md-2">
                                                <label for="dateFrom" class="form-label">Date From</label>
                                                <input type="date" id="dateFrom" name="date_from" class="form-control" required value="<?php echo isset($_POST['date_from']) ? $_POST['date_from'] : '' ?>">
                                            </div>
                                            <div class="col-md-2">
                                                <label for="dateTo" class="form-label">Date To</label>
                                                <input type="date" id="dateTo" name="date_to" class="form-control" required value="<?php echo isset($_POST['date_to']) ? $_POST['date_to'] : '' ?>">
                                            </div>
                                            <div class="col-md-2 d-flex align-items-end">
                                                <button type="submit" name="filter" class="btn btn-primary w-100">Filter</button>
                                            </div>
                                        </div>
                                    </form>

                                    <table id="example" class="table table-hover table-bordered table-striped text-center w-100">
                                        <thead>
                                            <tr>
                                                <th>Time Stamp</th>
                                                <th>Kit Name</th>
                                                <th>Water Level</th>
                                                <th>Humidity</th>
                                                <th>Temperature</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php include 'livedta.php'; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div> 
        </main>
    </div>
</div>

<?php include "includes/footer.php" ?>
<script type="module" src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.min.js"></script>
<script type="module" src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.js"></script>
<script type="module" src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.dataTables.js"></script>
<script type="module" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script type="module" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script type="module" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script type="module" src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.min.js"></script>

<script>
    $(document).ready(function() {
        $('.deleteBtn').on('click', function(e) {
            e.preventDefault(); // Prevent default link behavior

            const href = $(this).attr('href'); // Get the link

            Swal.fire({
                title: 'Are you sure?',
                text: 'All sensor data will be deleted!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href; // Redirect to delete script
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function () {
        new DataTable('#example', {
         
    layout: {
        topEnd: { 
            buttons: [ 
          
            { extend: 'excel', className: 'btn btn-dark btn-sm' },  
          
            { extend: 'csv', className: 'btn btn-dark btn-sm' },  
            { extend: 'print', className: 'btn btn-dark btn-sm' } 
        ]
        }
    }
});
    });
</script>

<!-- end  -->

</body>

</html>