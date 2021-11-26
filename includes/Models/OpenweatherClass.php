<?php


class Openweather {

public $APPID = '55443e07418a117cdc0e7f607f08fc53';
public $location = '';
public $country = '';
public $lang = 'fr';
public $units = 'metric';

public function getCurrentWeather($city){
  
}


// $curl = curl_init('https://api.openweathermap.org/data/2.5/weather?q=fay-en-montagne&APPID=55443e07418a117cdc0e7f607f08fc53&lang=fr&units=metric');


// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// $data = curl_exec($curl);
// $data = json_decode($data, true);
// echo '<pre>';
// echo "il fait ". $data['main']['temp'] . "°C à " . $data['name'];
// echo '</pre>';
// if ($data === false){
//   var_dump((curl_error($curl)));

// } else {
//   echo '<pre>';
//  var_dump(($curl));
//  echo '</pre>';
// }
// curl_close($curl);

}