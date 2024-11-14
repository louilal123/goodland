<?php
require_once('Main_class.php');
$main = new Main_class();
$events = $main->fetchEvents();
?>
<script>
    // Pass events to JavaScript
    var calendarEvents = <?= json_encode($events) ?>;
</script>