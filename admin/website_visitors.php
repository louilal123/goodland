<?php include "classes/admindetails.php"; ?>
<!DOCTYPE html>
<html lang="en"> 
<?php include "includes/header.php"; ?>
<link rel="stylesheet" href="dist/custom.css">

<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary">
    <div class="app-wrapper">
        <?php include "includes/sidebar.php"; ?>
        <div class="app-main-wrapper main-blur">
            <?php include "includes/topnav.php"; ?>
            <main class="app-main">

                <div class="app-content">
                    <div class="container-fluid">
                        <div class="row mt-4">
                            <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                <div class="d-flex ">
                                  <h3 class="fw-bold">Website Visitors</h3>
                                      <button  class="btn btn-success ms-auto btn-rounded me-1" onclick="location.reload(); return false;">
                                          <i class="fas fa-refresh"></i> Refresh
                                      </button>
                                      <button class="btn btn-danger btn-rounded" data-bs-toggle="modal" data-bs-target="#deleteAllMessagesModal">
                                          <i class="fas fa-trash"></i> Delete All
                                      </button>

                                </div>
                                    <table id="myTable" class="table-responsive table table-bordered table-hover table-stripe w-100">
                                        <thead class="table-secondary fw-bold">
                                            <tr>
                                                <th>Visitor_id</th>
                                                <th>Ip_address</th>
                                                <th>User_agent</th>
                                                <th>Country</th>
                                                <th width="15%">Date added</th>
                                                <th width="auto">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                       <!-- //SELECT `visitor_id`, `ip_address`, `user_agent`, `country`, `date_added` FROM `visitor_logs` WHERE 1 -->
                                            <?php foreach ($visitors as $items): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($items['visitor_id']); ?></td>
                                                    <td><?php echo htmlspecialchars($items['ip_address']); ?></td>
                                                    <td><?php echo htmlspecialchars($items['user_agent']); ?></td>
                                                    <td><?php echo htmlspecialchars($items['country']); ?></td>
                                                    <td><?php echo date("M d, Y h:i A", strtotime($items['date_added'])); ?></td>
                                                    <td>
                                                    <a href="#" class="btn btn-danger btn-sm deleteMessageBtn" 
                                                    data-message-id="<?php echo $items['visitor_id']; ?>" data-bs-toggle="modal" 
                                                    data-bs-target="#deleteMessageModal">
                                                        <i class="fas fa-trash" style="display: flex; justify-content: center;"></i>
                                                    </a>
                                                
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            </div> <!-- /.col -->
                        </div> 
                    </div>
                </div>

        <!-- Modal for Delete Confirmation -->
<!-- Modal for Individual Delete Confirmation -->
<div class="modal fade" id="deleteMessageModal" data-mdb-backdrop="static" data-mdb-keyboard="false" tabindex="-1" aria-labelledby="deleteMessageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="deleteMessageModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body fw-bold">
        Are you sure you want to delete this message?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-rounded" data-mdb-dismiss="modal"> <span class="fas fa-x"></span> Cancel</button>
        <form method="POST" action="classes/delete_message.php">
          <input type="hidden" name="delete_message_id" id="delete_message_id">
          <button type="submit" class="btn btn-danger btn-rounded "> <span class="fas fa-trash"></span> Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal for Deleting All Messages -->
<div class="modal fade" id="deleteAllMessagesModal" data-mdb-backdrop="static" data-mdb-keyboard="false" tabindex="-1" aria-labelledby="deleteAllMessagesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAllMessagesModalLabel">Confirm Deletion of All Messages</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete all messages? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Cancel</button>
                <form method="POST" action="classes/delete_message.php">
                    <input type="hidden" name="delete_all" value="1">
                    <button type="submit" class="btn btn-danger">Delete All</button>
                </form>
            </div>
        </div>
    </div>
</div>




            </main>
        </div>
    </div>
    <?php include "includes/footer.php"; ?>
  
    <script>
document.querySelectorAll('.deleteMessageBtn').forEach(button => {
    button.addEventListener('click', function() {
        var messageId = this.getAttribute('data-message-id');
        document.getElementById('delete_message_id').value = messageId;
        document.getElementById('delete_all').value = ''; // Clear the delete all flag
        document.getElementById('modal-body-text').textContent = 'Are you sure you want to delete this message?';
    });
});

// For deleting all messages
document.querySelector('.deleteAllMessagesBtn').addEventListener('click', function() {
    document.getElementById('delete_message_id').value = ''; // Clear individual message ID
    document.getElementById('delete_all').value = 'true'; // Set flag for deleting all
    document.getElementById('modal-body-text').textContent = 'Are you sure you want to delete all messages?';
});
</script>

<script>
//     const data = {
//   columns: [
//     {
//       label: 'Name',
//       field: 'name'
//     },
//     'Position',
//     'Office',
//     'Age',
//     'Start date',
//     'Salary',
//   ],
//   rows: [
//     ["Tiger Nixon", "System Architect", "Edinburgh", "61", "2011/04/25", "$320,800"],
//     ["Garrett Winters", "Accountant", "Tokyo", "63", "2011/07/25", "$170,750"],
//     ["Ashton Cox", "Junior Technical Author", "San Francisco", "66", "2009/01/12", "$86,000"],
//     ["Cedric Kelly", "Senior Javascript Developer", "Edinburgh", "22", "2012/03/29", "$433,060"],
//     ["Airi Satou", "Accountant", "Tokyo", "33", "2008/11/28", "$162,700"],
//     ["Brielle Williamson", "Integration Specialist", "New York", "61", "2012/12/02", "$372,000"],
//     ["Herrod Chandler", "Sales Assistant", "San Francisco", "59", "2012/08/06", "$137,500"],
//     ["Rhona Davidson", "Integration Specialist", "Tokyo", "55", "2010/10/14", "$327,900"],
//     ["Colleen Hurst", "Javascript Developer", "San Francisco", "39", "2009/09/15", "$205,500"],
//     ["Sonya Frost", "Software Engineer", "Edinburgh", "23", "2008/12/13", "$103,600"],
//     ["Jena Gaines", "Office Manager", "London", "30", "2008/12/19", "$90,560"],
//     ["Quinn Flynn", "Support Lead", "Edinburgh", "22", "2013/03/03", "$342,000"],
//     ["Charde Marshall", "Regional Director", "San Francisco", "36", "2008/10/16", "$470,600"],
//     ["Haley Kennedy", "Senior Marketing Designer", "London", "43", "2012/12/18", "$313,500"]
//   ],
// };

const instance = new mdb.Datatable(document.getElementById('datatable'), data)
const advancedSearchInput = document.getElementById('advanced-search-input');

const search = (value) => {
  let [phrase, columns] = value.split(' in:').map((str) => str.trim());

  if (columns) {
    columns = columns.split(',').map((str) => str.toLowerCase().trim());
  }

  instance.search(phrase, columns);
}

document.getElementById('advanced-search-button').addEventListener('click', (e) => {
  search(advancedSearchInput.value)
});

advancedSearchInput.addEventListener('keydown', (e) => {
  if (e.keyCode === 13) {
    search(e.target.value);
  }
})
</script>

</body>
</html>
