<?php


class Openweather
{

  public $APPID = '55443e07418a117cdc0e7f607f08fc53';
  public $city = '';
  public $country = '';
  public $lang = 'fr';
  public $units = 'metric';

  public function getCurrentWeather($location)
  {
    // $codb = new Database;
    $curlreq = "https://api.openweathermap.org/data/2.5/weather?q=$location&APPID=$this->APPID&lang=$this->lang&units=$this->units";
    $curl = curl_init($curlreq);
    // var_dump($curl);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($curl);
    $data = json_decode($data, true);

    if ($data === false) {
      var_dump((curl_error($curl)));
    } else {
      $weather = [
        'city' => $data['name'],
        'temp' => $data['main']['temp'],
        'feels_like' => $data['main']['feels_like'],
        'temp_min' => $data['main']['temp_min'],
        'temp_max' => $data['main']['temp_max'],
        'humidity' => $data['main']['humidity'],
        'wind_speed' => $data['wind']['speed'],
        'wind_deg' => $data['wind']['deg'],
        'weatherDesc'  => $data['weather']['0']['description'],
        'weatherIcon' => $data['weather']['0']['icon']
      ];


      return $weather;
    }
    curl_close($curl);
  }

  public function wind_cardinals($deg)
  {
    $cardinalDirections = array(
      'nord' => array(348.75, 361),
      'nord' => array(0, 11.25),
      'nord nord-est' => array(11.25, 33.75),
      'nord-est' => array(33.75, 56.25),
      'est nord-est' => array(56.25, 78.75),
      'est' => array(78.75, 101.25),
      'est sud-est' => array(101.25, 123.75),
      'sud-est' => array(123.75, 146.25),
      'sud sud-est' => array(146.25, 168.75),
      'sud' => array(168.75, 191.25),
      'sud sud-ouest' => array(191.25, 213.75),
      'sud ouest' => array(213.75, 236.25),
      'ouest sud-ouest' => array(236.25, 258.75),
      'ouest' => array(258.75, 281.25),
      'ouest nord-ouest' => array(281.25, 303.75),
      'nord-ouest' => array(303.75, 326.25),
      'nord nord-ouest' => array(326.25, 348.75)
    );
    foreach ($cardinalDirections as $dir => $angles) {
      if ($deg >= $angles[0] && $deg < $angles[1]) {
        $cardinal = str_replace("2", "", $dir);
      }
    }
    return $cardinal;
  }

  public function accordCardinal($cardinal)
  {
    if (substr($cardinal, 0, 1) === "n" || (substr($cardinal, 0, 1) === "s")) {
      $accordCardinal = 'au';
    } else {
      $accordCardinal = 'à l\'';
    }
    return $accordCardinal;
  }
} {
}
