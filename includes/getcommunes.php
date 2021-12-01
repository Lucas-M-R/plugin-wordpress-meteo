<?php 

define( 'SHORTINIT', true );
require( '../../../../wp-load.php' );
search();

function search(){
    global $wpdb;
    $search = sanitize_text_field($_GET['communeSearch']);
    
    $table_name_communes = $wpdb->prefix . 'meteo_plugin_communes';
    $results =  $wpdb->get_results('SELECT codepostal, nom FROM ' . $table_name_communes . ' WHERE codepostal LIKE "%' . $search . '%" OR nom LIKE "%' . $search . '%" LIMIT 15;');
    $resultJSON = json_encode($results, TRUE);
    echo $resultJSON;
    // print_r($results);

}
