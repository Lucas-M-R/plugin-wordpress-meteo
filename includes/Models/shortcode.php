<?php
// wp_enqueue_style('style', __DIR__ . '/includes/CSS/style.css', false, '1.1', 'all');
if (isset($_POST['communeSearch']) && !empty($_POST['communeSearch'])) {
    setShortCodeCity();
}

function  setshortCodeCity()
{

    global $wpdb;

    $search = preg_replace('[\d]', '', $_POST['communeSearch']);
    $search = sanitize_text_field($search);
    $table_name_shortcodes = $wpdb->prefix . 'meteo_plugin_shortcodes';
    $results =  $wpdb->query($wpdb->prepare('INSERT INTO ' . $table_name_shortcodes . '(shortcode) VALUE ("' . $search . '")'));
}




add_filter('widget_text', 'shortcode_unautop');
add_filter('widget_text', 'do_shortcode');

//_________________________________________________________SHORTCODE REGULAR

function shortcode_meteo_full($city)
{
    $q = new Openweather();
    return esc_attr($q->getmeteo_regular($city));
}
add_shortcode('meteofull', 'shortcode_meteo_full');

//_________________________________________________________SHORTCODE COMPACT

function shortcode_meteo($city)
{
    $q = new Openweather();
    return esc_attr($q->getmeteo_compact($city));
}
add_shortcode('meteo', 'shortcode_meteo');

//_________________________________________________________SHORTCODE MINI

function shortcode_meteo_mini($city)
{
    $q = new Openweather();  
    return esc_attr($q->getmeteo_mini($city));
}
add_shortcode('meteomini', 'shortcode_meteo_mini');


// api.openweathermap.org/data/2.5/weather?q=geovreisset&appid=55443e07418a117cdc0e7f607f08fc53

?>

<style>
    

.meteoshort{
    width: 20rem;
}
.meteothumb{
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    align-items: center;
}
.meteominishort {
    display: flex;
    text-align: center;
    position: relative;
    border-radius: 5px;
    padding: 1px;
    width: 15rem;
    align-items: center;
    justify-content: center;
}

.cityhover {
    width: 100%;
    height: 100%;
    text-align: center;
    vertical-align: middle;
    font-weight: bold;
    position: absolute;
    opacity: 0;
    top: 0%;
    left: 0%;
    transition: .3s;
    
}
.cityhover:hover {
    opacity: 1;
    background-color: rgba(255, 255, 255, .5);
    
}

.temp48,
.temp47 {background-color: #A3546D;}

.temp46,
.temp45 {background-color: #B6598E;}

.temp44,
.temp43 {background-color: #C95CAE;}

.temp42,
.temp41 {background-color: #DB60CE;}

.temp40,
.temp39 {background-color: #DB5E94;}

.temp38,
.temp37 {background-color: #B6598E;}

.temp36,
.temp35 {background-color: #DB635A;}

.temp34,
.temp33 {background-color: #E3545A;}

.temp32,
.temp31 {background-color: #E17F5A;}

.temp30,
.temp29 {background-color: #E3905A;}

.temp28,
.temp27 {background-color: #DEA85A;}

.temp26,
.temp25 {background-color: #E1BA5D;}

.temp24,
.temp23 {background-color: #E1CC61;}

.temp22,
.temp21 {background-color: #DED960;}

.temp20,
.temp19 {background-color: #E3E75A;}

.temp18,
.temp17 {background-color: #CBE7BA;}

.temp16,
.temp15 {background-color: #B6EC78;}

.temp14,
.temp13 {background-color: #92CD76;}

.temp12,
.temp11 {background-color: #6EB474;}

.temp10,
.temp9 {background-color: #4A9872;}

.temp8,
.temp7 {background-color: #629D91;}

.temp6,
.temp5 {background-color: #53C2A3;}

.temp4,
.temp3 {background-color: #4ACB85}

.temp2,
.temp1 {background-color: #4ADC8B;}

.temp0,
.temp-1 {background-color: #4AE3A4;}

.temp-2,
.temp-3 {background-color: #AAE0EE;}

.temp-4,
.temp-5 {background-color: #96DAEE;}

.temp-6,
.temp-7 {background-color: #7ACDF0;}

.temp-8,
.temp-9 {background-color: #72BDED;}

.temp-10,
.temp-11 {background-color: #69A7E8;}

.temp-12,
.temp-13 {background-color: #5F8DE1;}

.temp-14,
.temp-15 {background-color: #5A72DB;}

.temp-16,
.temp-17 {background-color: #5A5BD6;}

.temp-18,
.temp-19 {background-color: #8156DB;}

.temp-20,
.temp-21 {background-color: #9C56E1;}

.temp-22,
.temp-23 {background-color: #B356E2}

.temp-24,
.temp-25 {background-color: #C55ADE;}

.temp-26,
.temp-27 {background-color: #AB5ABE;}

.temp-28,
.temp-29 {background-color: #935AAB;}

.temp-30,
.temp-31 {background-color: #7D5799;}

.temp-32,
.temp-33 {background-color: #6A5988;}

</style>