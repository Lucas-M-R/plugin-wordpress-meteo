<?php

Class Communes{
    public function setCommunes(){
        $curl = curl_init("https://geo.api.gouv.fr/communes");
                    curl_setopt_array($curl, [
                            CURLOPT_CAINFO          => __DIR__ . DIRECTORY_SEPARATOR . 'cert.cer',
                            CURLOPT_RETURNTRANSFER  => true,
                            // CURLOPT_TIMEOUT => 50
                    ]);
                    $communes = curl_exec($curl);
                    $error = curl_error($curl);
                    // var_dump($error);
                    // var_dump($curl);
                    $communes = json_decode($communes, true);
                    // var_dump($communes);

                    global $wpdb;
                    // foreach ($communes as $commune){
                    //     foreach ($commune['codesPostaux'] as $codepostal) {
                    //         $table_name_communes = $wpdb->prefix . 'meteo_plugin_communes';
                    //         $table_name_communes = [
                    //             "id" => $commune['code'],
                    //             "code" => $codepostal,                                
                    //             "nom" => $commune['nom']
                    //         ];
                    //     }
                        
                    // }
                    $table_name_communes = $wpdb->prefix . 'meteo_plugin_communes';
                    $values = array();
                    $place_holders = array();
                    $query = "INSERT INTO $table_name_communes ( code, codepostal, nom) VALUES ";
                    foreach ($communes as $commune){
                        foreach ($commune['codesPostaux'] as $codepostal) {
                            $id = $commune['code'];
                            $code = $codepostal;                                
                            $nom = $commune['nom'];
                        array_push($values, $commune['code'], $codepostal, $commune['nom']);
                        $place_holders[] = "(%s, %s, %s)";
                    }}
                    // var_dump($query);
                    $query .= implode( ', ', $place_holders );
                    // var_dump($values);
                    $wpdb->query( $wpdb->prepare( "$query ", $values ) );

                    curl_close($curl);
                    // var_dump($curl);
                    
            }

}