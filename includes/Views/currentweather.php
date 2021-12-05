<?php
// define( 'SHORTINIT', true );
// require_once( '../../../../../wp-load.php' );
// require_once  ABSPATH . 'wp-content/plugins/meteo/includes/Models/OpenweatherClass.php';
// global $wpdb;


if (isset($_POST['communeSearch'])) {
  $location = preg_replace('[\d]', '', $_POST['communeSearch']);
  $location = sanitize_text_field($location);
} else {
  $location = "Paris";
}
$currentWeather = new Openweather();
$weather = $currentWeather->getCurrentWeather($location);
$weatherImg = 'http://openweathermap.org/img/wn/' . $weather["weatherIcon"] . '@2x.png';
$wind = new Openweather();
$windDirection = $wind->wind_cardinals($weather['wind_deg']);
$accordCardinal = $wind->accordCardinal($windDirection);
$temp = round($weather['temp']);

//     echo '<br/>';
//     echo '<div style="background:grey;"><img src="'.$weatherImg.'"></div>';
//     echo '<br/>';
//     echo 'il fait ' . $weather['temp'] . '°C<br/>';
//     echo 'il fait ' . $weather['feels_like'] . '°C en ressenti <br/>';
//     echo 'il fait ' . $weather['temp_min'] . '°C au minimum<br/>';
//     echo 'il fait ' . $weather['temp_max'] . '°C au maximum<br/>';
//     echo 'il fait ' . $weather['humidity'] . '% d\'humidité<br/>';
//     echo 'il souffle ' . $weather['wind_speed'] . 'km/h de vent<br/>';
//     echo 'Un vent qui vient  ' . $accordCardinal .' '. $windDirection . '<br/>';
//     echo 'il fait ' . $weather['weatherDesc'] . '<br/>';
//     echo 'à '. $weather['city'];
// }
// else {
//     echo "veuillez entrer une ville";
// }
?>


<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link " id="nav-regular-tab" data-bs-toggle="tab" data-bs-target="#nav-regular" type="button" role="tab" aria-controls="nav-regular" aria-selected="false">Complet</button>
    <button class="nav-link active" id="nav-compact-tab" data-bs-toggle="tab" data-bs-target="#nav-compact" type="button" role="tab" aria-controls="nav-compact" aria-selected="true">Compact</button>
    <button class="nav-link" id="nav-mini-tab" data-bs-toggle="tab" data-bs-target="#nav-mini" type="button" role="tab" aria-controls="nav-mini" aria-selected="false">Mini</button>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade" id="nav-regular" role="tabpanel" aria-labelledby="nav-regular-tab">

    <?php $q =  new openweather();
    $q->getmeteo_regular($location) ?>

  </div>

  <div class="tab-pane fade show active" id="nav-compact" role="tabpanel" aria-labelledby="nav-compact-tab">
    <?php $q =  new openweather();
    $q->getmeteo_compact($location) ?>
  </div>

  <div class="tab-pane fade" id="nav-mini" role="tabpanel" aria-labelledby="nav-mini-tab">
    <?php $q =  new openweather();
    $q->getmeteo_mini($location) ?>
  </div>
  
</div>

<?php


// Pour obtenir les resultats de la requette : 
//      
//   $weather['temp']
//   $weather['feels_like']
//   $weather['temp_min']
//   $weather['temp_max']
//   $weather['humidity']
//   $weather['wind_speed']
//   $weather['wind_deg']
//   $weather['wind_gust']
//   $weather['weatherDesc']
//   $weather['weatherIcon']
