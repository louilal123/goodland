<?php include "classes/admindetails.php" ?>
<?php
require_once('classes/Main_class.php');
$mainClass = new Main_class();
$mediaCounts = $mainClass->getMediaCounts();

$mediaData = [];
foreach ($mediaCounts as $count) {
    $mediaData[] = "['" . $count['MediaType'] . "', " . $count['Count'] . "]";
}
$mediaData = implode(", ", $mediaData);
?>
<!DOCTYPE html>
<html lang="en"> 
<?php include "includes/header.php"; ?>

<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary" >

    <div class="app-wrapper">

       <?php include "includes/sidebar.php" ?>
        <div class="app-main-wrapper"> 
           <?php 
            include "includes/topnav.php"; ?>
            <main class="app-main">
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
    <div class="col-lg-5 col-md-12 col-sm-12">
        <div class="card mb-4 text-bg-white shadow-sm">
           <div id="piechart_3d" style=" height: 450px;"></div>
      
        </div>
    </div>

    <div class="col-lg-7 col-md-12 col-sm-12">
        <div class="card mb-4 shadow-sm ms-0">
			<div id="chart_div" style="width: 100%; margin-left:0px !important; height: 450px; margin: 0px; padding: 0px;"></div>
		</div>
   	</div>
</div>
 
                </div>
            </div> 
           </main>
          
        </div>
    </div>

    <?php include "includes/footer.php" ?>
  
   
</body>

</html>