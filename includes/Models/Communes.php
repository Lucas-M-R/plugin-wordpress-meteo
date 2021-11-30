<?php
class Communes
{



    
    // public function __construct()
    // {
    //     if (isset ($_POST['communeSearch'])){
    //         $this->displayCommunes();
    //     }
    // }

// 
    public function displayCommunes(){
        global $wpdb;
        $search = sanitize_text_field($_POST['communeSearch']);
        $table_name_communes = $wpdb->prefix . 'meteo_plugin_communes';
        $result =  $wpdb->get_results('SELECT nom FROM ' . $table_name_communes . ' WHERE codepostal LIKE "%' . $search . '%" OR nom LIKE "%' . $search . '%" LIMIT 15;', ARRAY_A);
        // $resultJSON = json_encode($result);
        // echo $resultJSON;
        var_dump($result);
    }

    public function setCommunes()
    {
        $curl = curl_init("https://geo.api.gouv.fr/communes");
        curl_setopt_array($curl, [
            CURLOPT_CAINFO          => __DIR__ . DIRECTORY_SEPARATOR . 'cert.cer',
            CURLOPT_RETURNTRANSFER  => true,
            // CURLOPT_TIMEOUT => 50
        ]);
        $communes = curl_exec($curl);
        $error = curl_error($curl);
        // var_dump($error);
        $communes = json_decode($communes, true);
        global $wpdb;

        $table_name_communes = $wpdb->prefix . 'meteo_plugin_communes';
        
        //Suppression ancienne table (indispensable pour ne pas dupliquer les communes)
        $truncate = "TRUNCATE $table_name_communes";
        $wpdb->query($wpdb->prepare("$truncate"));
        
        //ajout table
        $values = array();
        $place_holders = array();
        $query = "INSERT INTO $table_name_communes ( code, codepostal, nom) VALUES ";
        foreach ($communes as $commune) {
            foreach ($commune['codesPostaux'] as $codepostal) {
                $id = $commune['code'];
                $code = $codepostal;
                $nom = $commune['nom'];
                array_push($values, $commune['code'], $codepostal, $commune['nom']);
                $place_holders[] = "(%s, %s, %s)";
            }
        }
        $query .= implode(', ', $place_holders);
        $wpdb->query($wpdb->prepare("$query ", $values));
        curl_close($curl);
    }
}