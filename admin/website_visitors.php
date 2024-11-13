<?php include "classes/admindetails.php"; ?>
<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php"; ?>

<style>
    body {
        overflow: hidden;
    }
</style>
<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini">

    <div class="app-wrapper">

       <?php include "includes/sidebar.php"; ?>
        <div class="app-main-wrapper main-blur">
           <?php include "includes/topnav.php"; ?>
            <main class="app-main">
            <div class="app-content">
                <div class="container-fluid">
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="card mt-2">
                                <div class="card-body">
                                    <div class="d-flex mb-3">
                                        <h3 class="fw-bold">Website Visitors</h3>
                                        <button type="button" class="btn btn-success ms-auto me-1" onclick="location.reload(); return false;">
                                            <i class="fas fa-refresh"></i> Refresh
                                        </button>
                                        <button class="btn btn-danger" id="deleteAllBtn">
    <i class="fas fa-trash"></i> Delete All
</button>

                                    </div>
                                    <table id="myTable" class="table table-bordered table-hover table-striped text-center w-100">
                                        <thead class="table-secondary fw-bold">
                                            <tr>
                                                <th>Visitor ID</th>
                                                <!-- <th >IP Address</th> -->
                                                <th >User Agent</th>
                                                <th >Country</th>
                                                <th>Date Added</th>
                                                <th >Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="">
                                           
                                                <?php foreach ($visitors as $visitor): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($visitor['visitor_id']); ?></td>
                                                    <td><?php echo htmlspecialchars($visitor['user_agent']); ?></td>
                                                    <td><?php echo htmlspecialchars($visitor['country']); ?></td>
                                                    <td><?php echo date("M d, Y h:i A", strtotime($visitor['date_added'])); ?></td>
                                                    <td>
                                                    <a href="classes/delete_visitor.php?visitor_id=<?php echo $visitor['visitor_id']; ?>" class="btn btn-danger btn-sm deleteBtn">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </main>
</body>

<?php include "includes/footer.php"; ?><script>
$(document).ready(function() {
    $('.deleteBtn').on('click', function(e) {
        e.preventDefault(); // Prevent default link behavior

        const href = $(this).attr('href'); // Get the href of the delete button (delete URL)

        // Trigger SweetAlert confirmation
        Swal.fire({
            title: 'Are you sure?',
            text: 'This visitor record and associated sessions will be deleted!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = href; // Redirect to delete_visitor.php if confirmed
            }
        });
    });
});
</script>
<script>
    $(document).ready(function() {
        $('#deleteAllBtn').on('click', function(e) {
            e.preventDefault(); // Prevent default button behavior

            // Trigger SweetAlert confirmation
            Swal.fire({
                title: 'Are you sure?',
                text: 'This will delete all records!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete All'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to delete_all.php to delete all records
                    window.location.href = 'classes/delete_all.php';
                }
            });
        });
    });
</script>





</html>
