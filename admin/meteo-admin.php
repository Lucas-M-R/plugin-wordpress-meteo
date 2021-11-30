<?php

require_once (__DIR__ . ('/../includes/Views/configuration.php'));
require_once (__DIR__ . ('/../includes/Views/currentweather.php'));
Controller::adminPage();
$data = new Communes();
$data->displayCommunes();
?>

<form action="" method="post">
<label for="communeSearch">Chosissez une commune</label>
<input list="communes" id="communeSearch" name="communeSearch" placeholder="Code postal ou ville"/>
<input type="submit" value="C'est super!">
</form>
<div id="ici">


</div>