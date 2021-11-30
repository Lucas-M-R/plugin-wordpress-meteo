<?php

require (__DIR__ . ('/../includes/Views/configuration.php'));
require (__DIR__ . ('/../includes/Views/currentweather.php'));
Controller::adminPage();
$data = new Communes();
$data->displayCommunes();

?>
<div class="container">
<?= $content ?>
</div>


<form action="" method="post">
<label for="communeSearch">Choose a flavor:</label>
<input list="communes" id="communeSearch" name="communeSearch" />
<datalist id="communes">
    <?php foreach ($data as $key => $commune){
    echo "<option value='$data[$key]'>";
} ?>
</datalist>
<input type="submit" value="coucou">
</form>
<div id="ici">


</div>