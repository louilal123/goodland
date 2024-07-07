<?php
include "classes/admindetails.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php"; ?>
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #printableArea, #printableArea * {
            visibility: visible;
        }
        #printableArea {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            padding: 10px;
            font-size: 10px;
        }
        .container-fluid {
            margin: 0;
            padding: 0;
        }
        .row, .card, table {
            margin-bottom: 10px;
        }
        .card-header, .card-body {
            padding: 5px;
        }
        h3, h4 {
            font-size: 14px;
        }
        .card-title {
            font-size: 12px;
        }
        .fw-bold {
            font-size: 12px;
        }
        .d-flex {
            font-size: 10px;
        }
        table {
            font-size: 10px;
        }
        th, td {
            font-size: 10px;
        }
    }
</style>
<body onload="window.print()">
    <div id="printableArea">
        <div class="container-fluid">
            <h4 class="text-center">GoodLand Management System</h4>
            <p class="text-center">123 Library St., Knowledge City, PH</p>
            <p class="text-center">Report Date: July 6, 2024</p>
            <p class="text-center">Report Period: From [Start Date] To [End Date]</p>

            <div class="row mt-4">
                <div class="col-lg-6">
                    <div class="card mb-4 text-bg-white shadow-sm">
                        <div class="card-header border-0">
                            <h3 class="card-title mb-0">Website Visits All Time</h3>
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
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header border-0">
                            <h3 class="card-title mb-0">Archive Files</h3>
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
                                    <td>15%</                                </tr>
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
                                    <td>10%</<td>
                                </tr>
                                <tr>
                                    <td>June</td>
                                    <td>1690</td>
                                    <td>160</td>
                                    <td>10%</<td>
                                </tr>
                                <tr>
                                    <td>July</td>
                                    <td>1850</td>
                                    <td>170</td>
                                    <td>9%</</td>
                                </tr>
                                <tr>
                                    <td>August</td>
                                    <td>2020</td>
                                    <td>180</td>
                                    <td>9%</</td>
                                </tr>
                                <tr>
                                    <td>September</td>
                                    <td>2200</td>
                                    <td>200</td>
                                    <td>10%</</td>
                                </tr>
                                <tr>
                                    <td>October</td>
                                    <td>2400</td>
                                    <td>210</td>
                                    <td>9%</</td>
                                </tr>
                                <tr>
                                    <td>November</td>
                                    <td>2610</td>
                                    <td>220</td>
                                    <td>8%</</td>
                                </tr>
                                <tr>
                                    <td>December</td>
                                    <td>2830</td>
                                    <td>230</td>
                                    <td>8%</</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
