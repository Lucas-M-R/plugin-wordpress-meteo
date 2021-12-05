<?php
/*
Plugin Name: Meteo Maximum Weather Plus Saga
Plugin URI: https://accescodeschool.fr/
Description: Voici un plugin pour avoir la météo sur son site 
Author: Lucas Morille-Roy, ACS 
Version: 0.9
Author URI: https://lucasm.promo-93.codeur.online/portfolio
*/


require_once  __DIR__ . '/includes/Views/header.php';


function lienDeMenu(){
  add_menu_page(
    'Meteo menu', //titre de la page
    'Mon plugin météo', // lien dans le add_menu_page
    'manage_options',
    plugin_dir_path(__FILE__).'/admin/meteo-admin.php'   // lien vers la page où on doit arriver quand on est sur le menu
  );
}


// on crée une page météo à l'initialisation du plugin

function initialization(){
  $page_array = array (
    'post_title' => 'La page météorologique',
    'post_content' => '[meteo ville=Paris]',
    'post_status' => 'publish',
    'post_type' => 'page',
    'post_author' => get_current_user_id(),
  );
  wp_insert_post($page_array);


  // la fonction installation crée la base de données shortcodes et communes
  $a=new DBWeather();
  $a->installation();
}
register_activation_hook(__FILE__, 'initialization');
add_action('admin_menu', 'lienDeMenu');


//a la desactivation du plugin on efface la page météo mais on garde la BDD
function desactivation(){
  $suppression = get_page_by_title('La page météorologique');
  wp_delete_post($suppression->ID, true);
}
register_deactivation_hook(__FILE__, 'desactivation');



// a la suppression du plugin on supprime la BDD
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
require_once  __DIR__ . '/includes/Models/shortcode.php';




//add shortcodes in the widgets
// add_filter('widget_text', 'do_shortcode');

// wp_register_style('style', __DIR__.'/includes/CSS/style.css');


// function script_meteo_plugin() {
//     wp_enqueue_script( 'script_meteo_plugin', plugins_url( '/js/script_meteo_plugin.js', __FILE__ ), '1.0.0.', true);
// }
// add_action('wp_enqueue_scripts','script_meteo_plugin');
?>