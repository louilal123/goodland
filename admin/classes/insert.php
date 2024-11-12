<?php
require_once('Main_class.php');

$mainClass = new Main_class();

// Run the data insertion in a loop every 5 seconds
while (true) {
    // Insert random data into the database
    $mainClass->insertRandomData();

    // Wait for 5 seconds before running again
    sleep(5);  // Sleep for 5 seconds
}
