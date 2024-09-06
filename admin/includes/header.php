
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Admin-Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous"><!--end::Fonts--><!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous"><!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous"><!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="dist/css/adminlte.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../admin/mdbfolder/css/mdb.min.css" />

    
<link rel="stylesheet" href="dist/custom.css">
    <!-- font-aswesome  -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- swetalert  -->
     <script  src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     
     <!-- datatable  -->
     <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">

     <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
    <script defer src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script defer src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <!-- end datatabke  -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw=="
    crossorigin="anonymous"></script>


    
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['File Type', 'Count'],
          <?php echo $mediaData; ?>
        ]);

        var options = {
          title: 'All Files',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['line']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('number', 'Day');
        data.addColumn('number', 'Signed-Up Users');
        data.addColumn('number', 'Non-Signed-Up Users');

        var rawData = <?php echo json_encode($visitor_data); ?>;
        var formattedData = [];
        var daysInMonth = new Date(new Date().getFullYear(), new Date().getMonth() + 1, 0).getDate();

        // Initialize all days with 0 values
        for (var day = 1; day <= daysInMonth; day++) {
            formattedData.push([day, 0, 0]);
        }

        // Fill in the data from the database
        rawData.forEach(function(row) {
            formattedData[row.day - 1] = [row.day, row.signed_up, row.non_signed_up];
        });

        data.addRows(formattedData);

        var options = {
            chart: {
                title: 'Website Visitors',
                subtitle: 'Signed-Up Users vs Non-Signed-Up Users'
            },
            height: 380,
            hAxis: {
                title: 'Day',
                ticks: Array.from({length: daysInMonth}, (_, i) => i + 1) // All days of the month
            },
            vAxis: {
                title: 'Visits'
            }
        };

        var chart = new google.charts.Line(document.getElementById('line_chart'));
        chart.draw(data, google.charts.Line.convertOptions(options));
    }
</script>
<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawBarColors);

    function drawBarColors() {
        var rawData = <?php echo json_encode($download_data); ?>;
        var formattedData = [['File Type', 'Signed-Up Users', 'Non-Signed-Up Users']];

        // Initialize all file types with zero downloads for both user types
        var fileTypes = ['Documents', 'Images', 'Arts', 'Maps'];
        var downloadCounts = {
            'Documents': { 'Signed-Up': 0, 'Non-Signed-Up': 0 },
            'Images': { 'Signed-Up': 0, 'Non-Signed-Up': 0 },
            'Arts': { 'Signed-Up': 0, 'Non-Signed-Up': 0 },
            'Maps': { 'Signed-Up': 0, 'Non-Signed-Up': 0 }
        };

        // Fill in the data from the database
        rawData.forEach(function(row) {
            downloadCounts[row.file_type][row.user_type] = row.download_count;
        });

        // Push the data to formattedData array
        fileTypes.forEach(function(type) {
            formattedData.push([type, downloadCounts[type]['Signed-Up'], downloadCounts[type]['Non-Signed-Up']]);
        });

        var data = google.visualization.arrayToDataTable(formattedData);

        var options = {
            title: 'Number of Downloads by File Type',
            chartArea: {width: '50%'},
            hAxis: {
                title: 'Total Downloads',
                minValue: 0
            },
            vAxis: {
                title: 'File Type'
            },
            bars: 'horizontal'
        };

        var chart = new google.visualization.BarChart(document.getElementById('side_chart'));
        chart.draw(data, options);
    }
</script>
</head>