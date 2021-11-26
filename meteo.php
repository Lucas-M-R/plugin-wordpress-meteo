<?php
/*
Plugin Name: Meteo Maximum Weather
Plugin URI: https://accescodeschool.fr/
Description: Voici un plugin pour avoir la météo sur son site 
Author: Lucas Morille-Roy ACS 
Version: Alpha
Author URI: https://lucasm.promo-93.codeur.online/portfolio
*/



// function loadClass($class) {
//   require __DIR__ . '/includes/Models/'.$class.'Class.php';
// }
// spl_autoload_register ('loadClass');



function lienDeMenu(){
  add_menu_page(
    'Meteo menu', //titre de la page
    'Mon plugin météo', // lien dans le add_menu_page
    'manage_options',
    plugin_dir_path(__FILE__).'/admin/meteo-admin.php'   // lien vers la page où on doit arriver quand on est sur le menu
  );
}
add_action('admin_menu', 'lienDeMenu');

define(SHORTINIT, true);
include('C:\Users\lucas\OneDrive\ACS\PROJETS\PROJET_8 Meteo\wordpress\wp-load.php'); 
// ^^^^^^^c'est pas beau mais pour l'instant ça fait le café//

require_once  __DIR__ . '/includes/Models/DatabaseClass.php';
require_once  __DIR__ . '/includes/Models/OpenweatherClass.php';
// require  __DIR__ . '/includes/Views/currentweather.php';


/* Shortcode – Google Maps Integration */

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


// function fn_googleMaps($atts, $content = null) {
//     extract(shortcode_atts(array(
//        "width" => 640,
//        "height" => 480,
//        "src" => 'https://goo.gl/maps/HEGwNih2M8CtTbd58'
//     ), $atts));
//     return '<iframe width="' . $width . '" height="' . $height . '" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="' . $src . '&amp;output=embed"></iframe>';
//  }
//  add_shortcode("googlemap", "fn_googleMaps") ;
// // utilisation du shortcode: [googlemap]

//  function notre_fonction($param) {
//    extract(
//      shortcode_atts(
//        array(
//          'prenom' => 'Jean',
//          'nom' => 'Dupontel',
//          'age' => 32
//        ),
//        $param
//      )
//    );
//    return $prenom . ' ' . $nom . ' a ' . $age . ' ans.';
//  };
//  echo notre_fonction($param);
 ?>