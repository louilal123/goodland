<?php include "classes/admindetails.php"; ?>
<!DOCTYPE html>
<html lang="en"> 
<?php include "includes/header.php"; ?>
<title>E Sawod Data</title>
<!-- <link rel="stylesheet" href="dist/custom.css"> -->

<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.dataTables.css"> -->
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
                                        <h3 class="fw-bold">List Of Water Readings</h3>
                                        <button class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#adddataModal">
                                             Refresh
                                        </button>
                                    </div>
                                <div class="card-body">
                                    
                                <!-- example -->
                                    <table id="example" class="table table-hover table-striped text-center w-100">
                                        <thead class="table-head">
                                            <tr>
                                                <th style="font-weight: bold;">Time Stamp</th>
                                                <th style="font-weight: bold;">Kit Name</th>
                                                <th style="font-weight: bold;">Water Level</th>
                                                <th style="font-weight: bold;">Humidity</th>
                                                <th style="font-weight: bold;">Temperature</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                                // Include the database connection
                                                include '../classes/connection.php';

                                                // Fetch data from the sensor_data table
                                                $sql = "SELECT `id`, `kit_name`, `level_cm`, `humidity`, `temperature`, `timestamp` FROM `sensor_data` ORDER BY `timestamp` DESC";
                                                $result = $conn->query($sql);

                                                // Check if data exists
                                                $data = [];
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        $data[] = $row;
                                                    }
                                                }
                                                ?>

                                            <?php if (!empty($data)): ?>
                                                <?php foreach ($data as $entry): ?>
                                                    <tr>
                                                    <td><?php echo date("M d, h:i:s A", strtotime($entry['timestamp'])); ?></td>

                                                        <td><?php echo htmlspecialchars($entry['kit_name']); ?> cm</td>
                                                        <td><?php echo htmlspecialchars($entry['level_cm']); ?> cm</td>
                                                        <td><?php echo htmlspecialchars($entry['humidity']); ?>%</td>
                                                        <td><?php echo htmlspecialchars($entry['temperature']); ?>°C</td>
                                                       
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="5">No data available</td>
                                                </tr>
                                            <?php endif; ?>
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
    $(document).ready(function () {
        new DataTable('#example', {
         
    layout: {
        topEnd: { 
            buttons: [ 
            { extend: 'copy', className: 'btn btn-dark btn-sm' },  
            { extend: 'excel', className: 'btn btn-dark btn-sm' },  
            { extend: 'pdf', className: 'btn btn-dark btn-sm' },  
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