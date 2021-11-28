<?php
/*
Plugin Name: Meteo Maximum Weather Plus Saga
Plugin URI: https://accescodeschool.fr/
Description: Voici un plugin pour avoir la météo sur son site 
Author: Lucas Morille-Roy, ACS 
Version: Alpha
Author URI: https://lucasm.promo-93.codeur.online/portfolio
*/



// function loadClass($class) {
//   require __DIR__ . '/includes/Models/'.$class.'Class.php';
// }
// spl_autoload_register ('loadClass');

require_once  __DIR__ . '/includes/Views/header.php';


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
require_once (ABSPATH . 'wp-load.php'); 
require_once ( ABSPATH . 'wp-admin/includes/upgrade.php' );
require_once  __DIR__ . '/includes/Models/DatabaseClass.php';
require_once  __DIR__ . '/includes/Models/OpenweatherClass.php';
$DBW = new DBWeather();
register_activation_hook( __FILE__, array( __FILE__, 'createTables' ) );
// $this->connect();
// require  __DIR__ . '/includes/Views/currentweather.php';

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


 ?>