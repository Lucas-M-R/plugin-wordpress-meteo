<?php 

    if (isset ($_POST['communeSearch']) && !empty ($_POST['communeSearch'])){
        setShortCodeCity();
    }

 function  setshortCodeCity(){

    global $wpdb;
    
    $search = preg_replace('[\d]', '', $_POST['communeSearch']);
    $search = sanitize_text_field($search);
    $table_name_shortcodes = $wpdb->prefix . 'meteo_plugin_shortcodes';
    $results =  $wpdb->query($wpdb->prepare('INSERT INTO '. $table_name_shortcodes . '(shortcode) VALUE ("' . $search . '")'));
    
}



















add_filter( 'widget_text', 'shortcode_unautop' );
add_filter( 'widget_text', 'do_shortcode' );


function shortcode_bienvenue(){
    return "<h1> Ce code court marche bien </h1>";
}
add_shortcode('bienvenue', 'shortcode_bienvenue');


function shortcode_meteo_simple($city){
    //paramètre par défaut

    

    getmeteoshortcode($city);

}
add_shortcode('meteo', 'shortcode_meteo_simple');


function getmeteoshortcode($city){
    global $wpdb;
    $a = shortcode_atts(array(
        'ville' => 'Lons-le-Saunier'

    ), $atts);


    
    $query = $city;
    $table_name_shortcodes = $wpdb->prefix . 'meteo_plugin_shortcodes';
    $result =  $wpdb->query($wpdb->prepare('SELECT shortcode 
                                                FROM '. $table_name_shortcodes . ' 
                                                WHERE shortcode = "' . $query .'"'
                                            ));
    echo $result;
}