<?php


class Openweather
{

  public $APPID = '';
  public $city = '';
  public $country = '';
  public $lang = 'fr';
  public $units = 'metric';


  public function __construct()
  {
    if (isset($_POST['appid']) && !empty($_POST['appid'])) {
      $this->appidOpenWeather();
    }
    global $wpdb;
    $key = $wpdb->get_row('SELECT option_value FROM ' . $wpdb->prefix . 'options WHERE option_name = "APPID"');
    if (isset($key)) {
      $this->APPID = $key->option_value;
    }
  }
  // forecast 4 jour => https://api.openweathermap.org/data/2.5/forecast?callback=response&q=Jouhe&appid=55443e07418a117cdc0e7f607f08fc53&lang=fr&units=metric

  public function appidOpenWeather()
  {
    global $wpdb;
    // $APPID = strip_tags($_POST['appid']);
    $this->APPID = strip_tags($_POST['appid']);
    $table = $wpdb->prefix . 'options';
    $data = array(
      'option_name' => 'APPID',
      'option_value' => $this->APPID
    );

    $format = array('%s', '%s');
    $wpdb->insert($table, $data, $format);
    $my_id = $wpdb->insert_id;
    echo $this->APPID;
    // echo $my_id;


    //     $sql =
    //     "CREATE TABLE $table_name_shortcodes (
    //     id int(9) unsigned NOT NULL auto_increment ,
    //     shortcode varchar(30) NULL,
    //     PRIMARY KEY  (id))";

    // dbDelta($sql);


    // $insertappid = "
    // INSERT INTO 
    // $table_name_option (
    //   option_name, 
    //   option_value) 
    //   VALUE (
    //     APPID, 
    //     $this->APPID
    //     )";

    // $wpdb->query($wpdb->prepare($insertappid));

    // dbDelta($insertappid);
  }

  public function getCurrentWeather($location)
  {
    // $codb = new Database;

    $curlreq = "https://api.openweathermap.org/data/2.5/weather?q=$location&APPID=$this->APPID&lang=$this->lang&units=$this->units";
    $curl = curl_init($curlreq);
    // var_dump($curlreq);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($curl);
    $data = json_decode($data, true);
    // echo "<pre>";
    // var_dump($data);
    // echo "</pre>";

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
        'wind_gust' => $data['wind']['gust'],
        'weatherDesc'  => $data['weather']['0']['description'],
        'weatherIcon' => $data['weather']['0']['icon']
      ];


      return $weather;
    }
    curl_close($curl);
  }

  // getforecast('paris');
  public function getForecast($location)
  {
    // $codb = new Database;
    $curlreq = "https://api.openweathermap.org/data/2.5/forecast?callback=response&q=$location&appid=$this->APPID&lang=$this->lang&units=$this->units";

    $curl = curl_init($curlreq);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($curl);
    $data = json_decode($data, true);
    var_dump($data);
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
      $accordCardinal = 'du';
    } else {
      $accordCardinal = 'de l\'';
    }
    return $accordCardinal;
  }


  function getmeteo_mini($city)
  {
    global $wpdb;
    $a = shortcode_atts(array(
      'ville' => 'Lons-le-Saunier'

    ), $atts);


    if (is_array($city)){
    $query = $city['ville'];
    } else {
    $query = $city;
    }
    $table_name_shortcodes = $wpdb->prefix . 'meteo_plugin_shortcodes';
    $result =  $wpdb->get_results($wpdb->prepare(
      'SELECT shortcode 
                                                FROM ' . $table_name_shortcodes . ' 
                                                WHERE shortcode = "' . $query . '"'
    ));

    if (is_null($result) === false) {
      $location = sanitize_text_field($query);
      $currentWeather = new Openweather();
      $weather = $currentWeather->getCurrentWeather($location);
      $weatherImg = 'http://openweathermap.org/img/wn/' . $weather["weatherIcon"] . '@2x.png';
      $wind = new Openweather();
      $windDirection = $wind->wind_cardinals($weather['wind_deg']);
      $accordCardinal = $wind->accordCardinal($windDirection);
      $temp = round($weather['temp']);

      echo '<div class=" meteominishort temp' . $temp . ' ">';
      echo '<img src="' . $weatherImg . '"  width="50px" height="50px" alt="">';
      echo '<div>' . $temp . '°C';
      echo '</div>';
      echo '<div class="cityhover">' . $weather['city'] . '</div>';
      echo '</div>';
    }
  }
  function getmeteo_regular($city)
  {
    global $wpdb;
    $a = shortcode_atts(array(
      'ville' => 'Lons-le-Saunier'

    ), $atts);





    if (is_array($city)){
      $query = $city['ville'];
      } else {
      $query = $city;
      }
    $table_name_shortcodes = $wpdb->prefix . 'meteo_plugin_shortcodes';
    $result =  $wpdb->get_results($wpdb->prepare(
      'SELECT shortcode 
                                                     FROM ' . $table_name_shortcodes . ' 
                                                     WHERE shortcode = "' . $query . '"'
    ));
    if (is_null($result) === false) {
      $location = sanitize_text_field($query);
      $currentWeather = new Openweather();
      $weather = $currentWeather->getCurrentWeather($location);
      $weatherImg = 'http://openweathermap.org/img/wn/' . $weather["weatherIcon"] . '@2x.png';
      $wind = new Openweather();
      $windDirection = $wind->wind_cardinals($weather['wind_deg']);
      $accordCardinal = $wind->accordCardinal($windDirection);
      $temp = round($weather['temp']);
      //__________________________________________________________ BOOTSTRAP CARD
      echo '<div class="card meteoshort" style="width: 25rem;">';
      echo '<div class="meteothumb temp' . $temp . '"><img src="' . $weatherImg . '">';
      echo $weather['temp'] . '°C';
      echo '</div>';
      echo '<div class="card-body">';
      echo '  <p class="card-text">';
      echo 'il fait ' . $weather['weatherDesc'] . '<br/>';
      echo 'à ' . $weather['city'] . '</p>';
      echo $weather['feels_like'] . '°C en ressenti <br/>';
      echo 'il fait ' . $weather['temp_min'] . '°C au minimum<br/>';
      echo 'il fait ' . $weather['temp_max'] . '°C au maximum<br/>';
      echo 'il fait ' . $weather['humidity'] . '% d\'humidité<br/>';
      echo 'Le vent souffle à ' . $weather['wind_speed'] . 'km/h';
      if (round($weather['wind_speed']) < round($weather['wind_gust'])) {
        echo ',<br/>avec des rafales à ' . $weather['wind_gust'] . 'km/h.<br/>';
      } else {
        echo ', sans rafales. ';
      }

      echo 'Un vent qui vient  ' . $accordCardinal . ' ' . $windDirection . '<br/>';

      echo '</div>';
      echo '</div>';
    }
  }




  function getmeteo_compact($city)
  {
    global $wpdb;
    $a = shortcode_atts(array(
      'ville' => 'Lons-le-Saunier'

    ), $atts);





    if (is_array($city)){
      $query = $city['ville'];
      } else {
      $query = $city;
      }
    $table_name_shortcodes = $wpdb->prefix . 'meteo_plugin_shortcodes';
    $result =  $wpdb->get_results($wpdb->prepare(
            'SELECT shortcode 
            FROM ' . $table_name_shortcodes . ' 
            WHERE shortcode = "' . $query . '"'
    ));
    if (is_null($result) === false) {
      $location = sanitize_text_field($query);
      $currentWeather = new Openweather();
      $weather = $currentWeather->getCurrentWeather($location);
      $weatherImg = 'http://openweathermap.org/img/wn/' . $weather["weatherIcon"] . '@2x.png';
      $wind = new Openweather();
      $windDirection = $wind->wind_cardinals($weather['wind_deg']);
      $accordCardinal = $wind->accordCardinal($windDirection);
      $temp = round($weather['temp']);

      echo '<div class="card meteoshort" style="width: 25rem;">';
      echo '<div class="meteothumb temp' . $temp . '"><img src="' . $weatherImg . '">';
      echo $temp . '°C</div>';
      echo '<div class="textdefilbox temp' . $temp . '">';
      echo '<div>Le temps est ' . $weather['weatherDesc'];
      echo ' à ' . $weather['city'] . ' - ';
      echo 'la température ressentie est de '.round($weather['feels_like']) . '°C - ';
      echo 'Le vent souffle à ' . round($weather['wind_speed']) . 'km/h';
      if (round($weather['wind_speed']) < round($weather['wind_gust'])) {
        echo ', avec des rafales à ' . round($weather['wind_gust']) . 'km/h.';
      } else {
        echo ', sans rafales. ';
      }
      echo 'Un vent qui vient  ' . $accordCardinal . ' ' . $windDirection;
      echo '</div>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
      // echo '</div>';
      ?>
      <style>
        
        
        
  .textdefilbox {
  max-width: 30em;                     /* largeur de la fenêtre */
 /* margin: 1em auto 2em;*:
  /* border: 10px solid #F0F0FF; */
  overflow: hidden;                     /* masque tout ce qui dépasse */
  /* box-shadow: 0 .25em .5em #CCC,inset 0 0 1em .25em #CCC; */
}
.textdefilbox > :last-child {
  display: inline-block;                /* modèle de boîte en ligne */
  padding-right: 2em;                   /* un peu d'espace pour la transition */
  padding-left: 100%;                   /* placement à droite du conteneur */
  white-space: nowrap;                  /* pas de passage à la ligne */
  animation: defilement-rtl 15s infinite linear;
}
@keyframes defilement-rtl {
  0% {
    transform: translate3d(0,0,0);      /* position initiale à droite */
  }
  100% {
    transform: translate3d(-100%,0,0);  /* position finale à gauche */
  }
  
}




      </style>
      <?php
    }
  }
}
