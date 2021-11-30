<?php

// global $wpdb;
// var_dump($wpdb);
// $dbpref = $wpdb->prefix;
// var_dump($dbpref);
// var_dump(wpdb(get_row(1)));






// require (__DIR__ . ('/../includes/Controllers/Controller.php'));
require (__DIR__ . ('/../includes/Views/configuration.php'));
require (__DIR__ . ('/../includes/Views/currentweather.php'));
Controller::adminPage();
?> 
<div class="container">
    <?= $admin ?>
</div>
