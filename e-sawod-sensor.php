<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "includes/header.php"; ?>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="blog-page">
  <?php include "includes/topnav.php"; ?>
  
  <main class="main">
    <div class="page-title">
      <div class="heading" style="background-size: cover; background-position: center; background: linear-gradient(to top, rgba(38, 37, 37, 1), rgba(22, 22, 22, 0.8)); z-index: -1;">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <br><br>
              <h1 class="text-warning">Sensor Data</h1>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="index">Home</a></li>
            <li class="current">Sensor Data</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->
    <!-- Values Section -->
<section id="" class="values section">
  <div class="container">
    <div class="row gy-4">

    <div class="col-md-6">
    <div class="card ">
        <div class="card-body">
            <h5>E-SAWOD 1</h5>
            <p id="esawod1-water-level">Water Level: -- cm</p>
            <p id="esawod1-temp">Temperature: -- °C</p>
            <p id="esawod1-humidity">Humidity: -- %</p>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="card ">
        <div class="card-body">
            <h5>E-SAWOD 2</h5>
            <p id="esawod2-water-level">Water Level: -- cm</p>
            <p id="esawod2-temp">Temperature: -- °C</p>
            <p id="esawod2-humidity">Humidity: -- %</p>
        </div>
    </div>
</div>


      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h3>Database Data Table</h3>
            <!-- Data Table container -->
            <table id="sensorDataTable" border="1" class="table table-responsive">
        <thead>
            <tr>
                <th>Kit Name</th>
                <th>Water Level (cm)</th>
                <th>Humidity (%)</th>
                <th>Temperature (°C)</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data rows will be inserted here -->
        </tbody>
    </table>
  
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

    

          
        </div>
      </div>
    </section>
   
  </main>

  <?php include "includes/footer.php"; ?>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
       // Function to load data from PHP script
function fetchData() {
    $.ajax({
        url: '/classes/node_db.php', // PHP script that fetches data
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            // Log the data for debugging
            console.log('Data fetched from node_db.php:', data);
            
            // Clear existing table rows before inserting new data
            $('#sensorDataTable tbody').empty();

            // Check if data is an array and contains items
            if (Array.isArray(data) && data.length > 0) {
                // Loop through the data and append rows to the table
                data.forEach(function(row) {
                    var newRow = '<tr>' +
                        '<td>' + row.kit_name + '</td>' +
                        '<td>' + (row.level_cm !== null ? row.level_cm + ' cm' : '--') + '</td>' +
                        '<td>' + (row.humidity !== null ? row.humidity + ' %' : '--') + '</td>' +
                        '<td>' + (row.temperature !== null ? row.temperature + ' °C' : '--') + '</td>' +
                        '<td>' + new Date(row.timestamp).toLocaleString() + '</td>' +
                        '</tr>';
                    $('#sensorDataTable tbody').append(newRow);
                });
            } else {
                console.log("No data to display.");
            }
        },
        error: function(xhr, status, error) {
            console.log("Error fetching data:", error);
        }
    });
}


        // Fetch data initially
        fetchData();

        // Fetch new data every 5 seconds to keep the table updated
        setInterval(fetchData, 5000);
    </script>

  
 

</body>

</html>
