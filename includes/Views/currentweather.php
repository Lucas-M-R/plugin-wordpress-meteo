<?php
// define( 'SHORTINIT', true );
// require_once( '../../../../../wp-load.php' );
// require_once  ABSPATH . 'wp-content/plugins/meteo/includes/Models/OpenweatherClass.php';
// global $wpdb;


if (isset ($_POST['communeSearch'])){
    $location = preg_replace('[\d]', '', $_POST['communeSearch']);
    $location = sanitize_text_field($location);
    $currentWeather = new Openweather();
    $weather = $currentWeather->getCurrentWeather($location);
    $weatherImg = 'http://openweathermap.org/img/wn/' . $weather["weatherIcon"] . '@2x.png';
    $wind = new Openweather();
    $windDirection = $wind->wind_cardinals($weather['wind_deg']);
    $accordCardinal = $wind->accordCardinal($windDirection);


    echo '<br/>';
    echo '<div style="background:grey;"><img src="'.$weatherImg.'"></div>';
    echo '<br/>';
    echo 'il fait ' . $weather['temp'] . '°C<br/>';
    echo 'il fait ' . $weather['feels_like'] . '°C en ressenti <br/>';
    echo 'il fait ' . $weather['temp_min'] . '°C au minimum<br/>';
    echo 'il fait ' . $weather['temp_max'] . '°C au maximum<br/>';
    echo 'il fait ' . $weather['humidity'] . '% d\'humidité<br/>';
    echo 'il souffle ' . $weather['wind_speed'] . 'km/h de vent<br/>';
    echo 'Un vent qui vient  ' . $accordCardinal .' '. $windDirection . '<br/>';
    echo 'il fait ' . $weather['weatherDesc'] . '<br/>';
    echo 'à '. $weather['city'];
}
else {
    echo "veuillez entrer une ville";
}


// Pour obtenir les resultats de la requette : 
//      
//   $weather['temp']
//   $weather['feels_like']
//   $weather['temp_min']
//   $weather['temp_max']
//   $weather['humidity']
//   $weather['wind_speed']
//   $weather['wind_deg']
//   $weather['weatherDesc']
//   $weather['weatherIcon']


