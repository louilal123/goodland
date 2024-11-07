<?php

require_once 'classes/Main_class.php'; 

if (!empty($_GET['temperature']) && !empty($_GET['humidity']) && !empty($_GET['water_level']) ) {

    $temperature = filter_var($_GET['temperature'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $humidity = filter_var($_GET['humidity'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $water_level = filter_var($_GET['water_level'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
   

    $main = new Main_class();
    $result = $main->storeDHT11Data($temperature, $humidity, $water_level);
    echo $result;  
} else {
    echo "Required parameters are missing.";
}

?>