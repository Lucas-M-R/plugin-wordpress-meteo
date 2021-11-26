<?php


$location = 'moscow';
$currentWeather = new Openweather();
$weather = $currentWeather->getCurrentWeather($location);
$weatherImg = 'http://openweathermap.org/img/wn/' . $weather["weatherIcon"] . '@2x.png';
$wind = new Openweather();
$windDirection = $wind->wind_cardinals('150');
$accordCardinal = $wind->accordCardinal($windDirection);





// resultats de la requette : 
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

echo '<br/>';
echo '<div style="background:grey;"><img src="'.$weatherImg.'"></div>';
echo '<br/>';
echo 'il fait ' . $weather['temp'] . '°C<br/>';
echo 'il fait ' . $weather['feels_like'] . '°C en ressenti <br/>';
echo 'il fait ' . $weather['temp_min'] . '°C au minimum<br/>';
echo 'il fait ' . $weather['temp_max'] . '°C au maximum<br/>';
echo 'il fait ' . $weather['humidity'] . '% d\'humidité<br/>';
echo 'il souffle ' . $weather['wind_speed'] . 'km/h de vent<br/>';
echo 'Un vent qui souffle  ' . $accordCardinal .' '. $windDirection . '<br/>';
echo 'il fait ' . $weather['weatherDesc'] . '<br/>';
echo 'à '. $weather['city'];
