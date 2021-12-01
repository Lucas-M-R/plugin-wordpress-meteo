<?php

require_once(__DIR__ . ('/../includes/Views/configuration.php'));
// require_once(__DIR__ . ('/../includes/Views/currentweather.php'));
Controller::adminPage();
// $data->displayCommunes();
include (__DIR__ . ('/../includes/Views/currentweather.php'));

?>
