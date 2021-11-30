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
$contentpagemeteo = include __DIR__ . '/includes/Views/meteopage.php';
function initialization(){
  $page_array = array (
    'post_title' => 'coucou tout le monde',
    'post_content' => $contentpagemeteo,
    'post_status' => 'publish',
    'post_type' => 'page',
    'post_author' => get_current_user_id(),
  );
  wp_insert_post($page_array);
}
register_activation_hook(__FILE__, 'initialization');
add_action('admin_menu', 'lienDeMenu');

function desactivation(){
  $suppression = get_page_by_title('coucou tout le monde');
  wp_delete_post($suppression->ID, true);
}
register_deactivation_hook(__FILE__, 'desactivation');


function uninstall(){
  global $wpdb;
  $wpdb->query("DROP TABLE ".$wpdb->prefix."meteo_plugin_shortcodes");
  $wpdb->query("DROP TABLE ".$wpdb->prefix."meteo_plugin_communes");
  $wpdb->query("DROP TABLE ".$wpdb->prefix."meteo_plugin_");
}
register_uninstall_hook(__FILE__, 'uninstall');







define(SHORTINIT, true);
require_once (ABSPATH . 'wp-load.php'); 
require_once ( ABSPATH . 'wp-admin/includes/upgrade.php' );
require_once  __DIR__ . '/includes/Models/DataClass.php';
require_once  __DIR__ . '/includes/Models/OpenweatherClass.php';
require_once  __DIR__ . '/includes/Models/Communes.php';
require_once  __DIR__ . '/includes/Controllers/Controller.php';


wp_enqueue_script ( 'script_meteo_plugin', __DIR__ . '/js/script_meteo_plugin.js', true );

// function script_meteo_plugin() {
//     wp_enqueue_script( 'script_meteo_plugin', plugins_url( '/js/script_meteo_plugin.js', __FILE__ ), '1.0.0.', true);
// }
// add_action('wp_enqueue_scripts','script_meteo_plugin');
?>