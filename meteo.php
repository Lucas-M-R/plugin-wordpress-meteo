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
require_once  __DIR__ . '/includes/Models/DataClass.php';
require_once  __DIR__ . '/includes/Models/OpenweatherClass.php';
require_once  __DIR__ . '/includes/Models/Communes.php';
require_once  __DIR__ . '/includes/Controllers/Controller.php';
$DBW = new DBWeather();
$DBW->installation()
// register_activation_hook( __FILE__, array( __FILE__, 'installation' ) );
// register_activation_hook( __FILE__, 'installation');
// $this->connect();

?>