<?php include "classes/admindetails.php"; ?>
<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php"; ?>
<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>

<script type="text/javascript">
    FusionCharts.ready(function(){
        var chartObj = new FusionCharts({
            type: 'cylinder',
            dataFormat: 'json',
            renderAt: 'container',
            width: '400',
            height: '600',
            dataSource: {
                "chart": {
                    "theme": "fusion",
                    "caption": "Water Tank Level",
                    "captionFontColor": "#0062cc",
                    "subcaption": "Live Monitoring",
                    "lowerLimit": "0",
                    "upperLimit": "36",
                    "lowerLimitDisplay": "Empty",
                    "upperLimitDisplay": "Full",
                    "numberSuffix": " cm",
                    "showValue": "1",
                    "valueFontSize": "18",
                    "chartBottomMargin": "45",
                    "cylFillColor": "#87CEEB", // Sky Blue color
                    "cyloriginy": "300",
                    "use3DLighting": "0"
                },
                "value": "18", // Initial value
                "annotations": {
                    "origw": "500",
                    "origh": "40",
                    "autoscale": "1",
                    "groups": [{
                        "id": "range",
                        "items": [{
                            "id": "rangeBg",
                            "type": "rectangle",
                            "x": "$canvasCenterX-45",
                            "y": "$chartEndY-30",
                            "tox": "$canvasCenterX +45",
                            "toy": "$chartEndY-75",
                            "fillcolor": "#0062cc"
                        }, {
                            "id": "rangeText",
                            "type": "Text",
                            "fontSize": "11",
                            "fillcolor": "#333333",
                            "text": "Current Level",
                            "x": "$chartCenterX-45",
                            "y": "$chartEndY-50"
                        }]
                    }]
                }
            },
            "events": {
                "rendered": function(evtObj, argObj) {
                    var gaugeRef = evtObj.sender;
                    // Fetch real-time data from server
                    function updateWaterLevel() {
                        $.ajax({
                            url: 'fetch_data.php',
                            type: 'GET',
                            success: function(response) {
                                var data = JSON.parse(response);
                                var newLevel = data.value;
                                gaugeRef.feedData("&value=" + newLevel);
                                updateAnnotations(gaugeRef, newLevel);
                            }
                        });
                    }
                    
                    // Initial update
                    updateWaterLevel();
                    
                    // Update every 5 seconds
                    setInterval(updateWaterLevel, 5000);
                },
                "realTimeUpdateComplete": function(evt, arg) {
                    // This function updates the annotation and color based on the value
                    var annotations = evt.sender.annotations,
                        dataVal = evt.sender.getData(),
                        colorVal;

                    if (dataVal >= 31) {
                        colorVal = "#dc3545"; // Red for full level
                    } else if (dataVal <= 12) {
                        colorVal = "#ffc107"; // Yellow for low level
                    } else {
                        colorVal = "#28a745"; // Green for mid level
                    }
                    
                    annotations && annotations.update('rangeText', {
                        "text": "WL: " + dataVal + " cm",
                        "bgAlpha": "100",
                        "bgColor": colorVal
                    });
                    
                    annotations && annotations.update('rangeBg', {
                        "fillcolor": colorVal
                    });
                },
                "disposed": function(evt, arg) {
                    clearInterval(evt.sender.chartInterval);
                }
            }
        });
        chartObj.render();
    });
</script>

<style>
    .fusioncharts-label {
        background-color: #f8f8f8;
        /* padding: 20px; */
        border-radius: 3px;
        width: 100%; /* Ensure background color covers text width */
    }
</style>


<body class="layout-fixed-complete sidebar-expand-lg sidebar-mini bg-body-tertiary">
    <div class="app-wrapper">
        <?php include "includes/sidebar.php"; ?>
        <div class="app-main-wrapper main-blur">
            <?php include "includes/topnav.php"; ?>
            <main class="app-main">
                <div class="app-content">
                    <div class="container-fluid">
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="container" style="width: 300px !important;"></div>
                                    </div>
                                </div>
                            </div> <!-- /.col -->
                        </div> 
                    </div>
                </div>
            </main>
        </div>
    </div>
    <?php include "includes/footer.php"; ?>
</body>
</html>
