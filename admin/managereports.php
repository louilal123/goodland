<?php include "classes/admindetails.php"; ?>
<!DOCTYPE html>
<html lang="en"> 
<?php include "includes/header.php"; ?>

<link rel="stylesheet" href="dist/custom.css">
 <style>body{
    overflow: hidden;
 }
 </style>
<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary">

          

    <div class="app-wrapper">

       <?php include "includes/sidebar.php" ?>
        <div class="app-main-wrapper"> 
           <?php 
            include "includes/topnav.php"; ?>
            <main class="app-main">
                  <!-- <div id="loader" >
                    <div class="spinner"></div>
                </div> -->
            <div class="app-content-header"> 
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Manage Reports</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                Reports
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <button onclick="window.location.href='reports.php'" class="btn btn-primary float-end">Print Report</button>
            </div>
            <div class="app-content"> 
               
            
                
                <div class="container-fluid"> 
                    
                <div class="row mt-4">
    <div class="col-lg-6">
        <div class="card mb-4 text-bg-white shadow-sm">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Website Visits All Time</h3>
                    <a href="javascript:void(0);" class="text-light">View Report</a>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex">
                    <p class="d-flex flex-column"> 
                        <span class="fw-bold fs-5">820</span> 
                        <span>Website Visitors Over Time</span> 
                    </p>
                    <p class="ms-auto d-flex flex-column text-end"> 
                        <span class="text-success"> 
                            <i class="bi bi-arrow-up"></i> 12.5%
                        </span> 
                        <span class="text-secondary">Since last week</span> 
                    </p>
                </div>
                <div class="position-relative mb-4">
                    <div id="visitors-chart"></div>
                </div>
                <div class="d-flex flex-row justify-content-end">
                    <span class="me-2">
                        <i class="bi bi-square-fill text-primary"></i> This Week
                    </span>
                    <span>
                        <i class="bi bi-square-fill text-secondary"></i> Last Week
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card mb-4 shadow-sm">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Archive Files</h3>
                    <a href="javascript:void(0);" class="text-light">View Report</a>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex">
                    <p class="d-flex flex-column"> 
                        <span class="fw-bold fs-5">1200</span> 
                        <span>Files Over Time</span> 
                    </p>
                    <p class="ms-auto d-flex flex-column text-end"> 
                        <span class="text-success"> 
                            <i class="bi bi-arrow-up"></i> 15.3%
                        </span> 
                        <span class="text-secondary">Since last month</span> 
                    </p>
                </div>
                <div class="position-relative mb-4">
                    <div id="documents-chart"></div>
                </div>
                <div class="d-flex flex-row justify-content-end">
                    <span class="me-2">
                        <i class="bi bi-square-fill text-primary"></i> This Month
                    </span>
                    <span>
                        <i class="bi bi-square-fill text-secondary"></i> Last Month
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="container-fluid">
        <div class="card">
        <h4 class="text-center">User Registration Table</h4>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Total Registrations</th>
                                                    <th>New Registrations</th>
                                                    <th>Growth (%)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>January</td>
                                                    <td>1000</td>
                                                    <td>150</td>
                                                    <td>15%</td>
                                                </tr>
                                                <tr>
                                                    <td>February</td>
                                                    <td>1150</td>
                                                    <td>120</td>
                                                    <td>10%</td>
                                                </tr>
                                                <tr>
                                                    <td>March</td>
                                                    <td>1270</td>
                                                    <td>130</td>
                                                    <td>11%</td>
                                                </tr>
                                                <tr>
                                                    <td>April</td>
                                                    <td>1400</td>
                                                    <td>140</td>
                                                    <td>11%</td>
                                                </tr>
                                                <tr>
                                                    <td>May</td>
                                                    <td>1540</td>
                                                    <td>150</td>
                                                    <td>10%</td>
                                                </tr>
                                                <tr>
                                                    <td>June</td>
                                                    <td>1690</td>
                                                    <td>160</td>
                                                    <td>10%</td>
                                                </tr>
                                                <tr>
                                                    <td>July</td>
                                                    <td>1850</td>
                                                    <td>170</td>
                                                    <td>9%</td>
                                                </tr>
                                                <tr>
                                                    <td>August</td>
                                                    <td>2020</td>
                                                    <td>180</td>
                                                    <td>9%</td>
                                                </tr>
                                                <tr>
                                                    <td>September</td>
                                                    <td>2200</td>
                                                    <td>200</td>
                                                    <td>10%</td>
                                                </tr>
                                                <tr>
                                                    <td>October</td>
                                                    <td>2400</td>
                                                    <td>210</td>
                                                    <td>9%</td>
                                                </tr>
                                                <tr>
                                                    <td>November</td>
                                                    <td>2610</td>
                                                    <td>220</td>
                                                    <td>8%</td>
                                                </tr>
                                                <tr>
                                                    <td>December</td>
                                                    <td>2830</td>
                                                    <td>230</td>
                                                    <td>8%</td>
                                                </tr>
                                            </tbody>
                                        </table>
        </div>
    </div>
</div>

                </div>

              

            </div> 
        </main>
          
        </div>
    </div>
   
    <?php include "includes/footer.php" ?>
   
<!-- end  -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>

<script>
    const visitors_chart_options = {
        series: [{
                name: "High - 2023",
                data: [100, 120, 170, 167, 180, 177, 160],
            },
            {
                name: "Low - 2023",
                data: [60, 80, 70, 67, 80, 77, 100],
            },
        ],
        chart: {
            height: 200,
            type: "line",
            toolbar: {
                show: false,
            },
        },
        colors: ["#0d6efd", "#adb5bd"],
        stroke: {
            curve: "smooth",
        },
        grid: {
            borderColor: "#e7e7e7",
            row: {
                colors: ["#f3f3f3", "transparent"],
                opacity: 0.5,
            },
        },
        legend: {
            show: false,
        },
        markers: {
            size: 1,
        },
        xaxis: {
            categories: ["22th", "23th", "24th", "25th", "26th", "27th", "28th"],
        },
    };

    const visitors_chart = new ApexCharts(
        document.querySelector("#visitors-chart"),
        visitors_chart_options
    );
    visitors_chart.render();

    const documents_chart_options = {
        series: [{
                name: "Uploaded Documents",
                data: [44, 55, 57, 56, 61, 58, 63, 60, 66, 63, 60, 66],
            },
            {
                name: "Reviewed Documents",
                data: [76, 85, 101, 98, 87, 105, 91, 114, 94, 63, 60, 66],
            },
        ],
        chart: {
            type: "bar",
            height: 200,
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "55%",
                endingShape: "rounded",
            },
        },
        legend: {
            show: false,
        },
        colors: ["#0d6efd", "#20c997"],
        dataLabels: {
            enabled: false,
        },
        stroke: {
            show: true,
            width: 2,
            colors: ["transparent"],
        },
        xaxis: {
            categories: [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec",
            ],
        },
        fill: {
            opacity: 1,
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val + " documents";
                },
            },
        },
    };

    const documents_chart = new ApexCharts(
        document.querySelector("#documents-chart"),
        documents_chart_options
    );
    documents_chart.render();
</script>

   
</body>

</html>