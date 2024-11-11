<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "includes/header.php"; ?>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script defer src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script defer src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
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

    <!-- Values Section -->
    <section id="" class="values section">
      <div class="container">
        <div class="row gy-4">
          
         <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <!-- FusionCharts container -->
                <div id="container"></div>
              </div>
            </div>
          </div>
         

          
        </div>
      </div>
    </section>
   
  </main>

  <?php include "includes/footer.php"; ?>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script>
$(document).ready(function() {
    // Function to fetch and display the latest data for esawod_1
    function fetchEsawod1Data() {
        $.ajax({
            url: 'classes/fetch_esawod1.php',  // Path to the PHP file that fetches esawod_1 data
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data['esawod_1']) {
                    $('#esawod1-water-level').text('Water Level: ' + data['esawod_1'].level_cm + ' cm');
                    $('#esawod1-temp').text('Temperature: ' + data['esawod_1'].temperature + '°C');
                    $('#esawod1-humidity').text('Humidity: ' + data['esawod_1'].humidity + '%');
                } else {
                    $('#esawod1-water-level').text('No data for esawod_1');
                    $('#esawod1-temp').text('No data for esawod_1');
                    $('#esawod1-humidity').text('No data for esawod_1');
                }
            },
            error: function(err) {
                console.log('Error fetching esawod_1 data:', err);
            }
        });
    }

    // Function to fetch and display the latest data for esawod_2
    function fetchEsawod2Data() {
        $.ajax({
            url: 'classes/fetch_esawod2.php',  // Path to the PHP file that fetches esawod_2 data
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data['esawod_2']) {
                    $('#esawod2-water-level').text('Water Level: ' + data['esawod_2'].level_cm + ' cm');
                    $('#esawod2-temp').text('Temperature: ' + data['esawod_2'].temperature + '°C');
                    $('#esawod2-humidity').text('Humidity: ' + data['esawod_2'].humidity + '%');
                } else {
                    $('#esawod2-water-level').text('No data for esawod_2');
                    $('#esawod2-temp').text('No data for esawod_2');
                    $('#esawod2-humidity').text('No data for esawod_2');
                }
            },
            error: function(err) {
                console.log('Error fetching esawod_2 data:', err);
            }
        });
    }

    // Fetch data for both esawod_1 and esawod_2 on page load and update every 10 seconds
    fetchEsawod1Data();
    fetchEsawod2Data();
    setInterval(function() {
        fetchEsawod1Data();
        fetchEsawod2Data();
    }, 10000);  // Refresh every 10 seconds
});

</script>
  <script>
        // Function to load data from PHP script
        function fetchData() {
            $.ajax({
                url: 'classes/node_db.php', // PHP script that fetches data
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Clear existing table rows before inserting new data
                    $('#sensorDataTable tbody').empty();

                    // Loop through the data and append rows to the table
                    data.forEach(function(row) {
                        var newRow = '<tr>' +
                            '<td>' + row.kit_name + '</td>' +
                            '<td>' + row.level_cm + ' cm</td>' +
                            '<td>' + row.humidity + ' %</td>' +
                            '<td>' + row.temperature + ' °C</td>' +
                            '<td>' + new Date(row.timestamp).toLocaleString() + '</td>' +
                            '</tr>';
                        $('#sensorDataTable tbody').append(newRow);
                    });
                },
                error: function() {
                    console.log("Error fetching data.");
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
