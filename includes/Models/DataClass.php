<?php



class DBWeather
{

    public function connect() //fonction de connextion à la base
    {
        try
        {
            global $wpdb;
            $servername = $wpdb->dbhost;
            $username = $wpdb->dbuser;
            $password = $wpdb->dbpassword;
            $dbname = $wpdb->dbname;
            $charset = $wpdb->charset;
            // $charset = 'latin1_swedish_ci';
           
            $req ='mysql:host='.$servername.';dbname='.$dbname.';charset='.$charset.','. $username .','. $password;
            echo $req;
            $bdd = new PDO($req);
            return $bdd; 

        
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }
    // function installation()
    function installation()   
    {
    
        global $wpdb;
        $table_name_shortcodes = $wpdb->prefix . 'meteo_plugin_shortcodes';
        $table_name_communes = $wpdb->prefix . 'meteo_plugin_communes';
        $wpdb_collate = $wpdb->collate;
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
         
        $sql =   
            "CREATE TABLE $table_name_shortcodes (
            id int(9) unsigned NOT NULL auto_increment ,
            shortcode varchar(30) NULL,
            PRIMARY KEY  (id))";
 
         $sql2 =   
            "CREATE TABLE $table_name_communes (
            id int(6) unsigned NOT NULL auto_increment ,
            code varchar(6)  NOT NULL,
            codepostal varchar(6),
            nom varchar(30) NOT NULL,
            PRIMARY KEY  (id))";
    
        dbDelta( $sql );
        dbDelta( $sql2 );
    } 
public function insertAppId(){
    global $wpdb;
    $appid_openweather = $wpdb->prefix . 'options';
    $sql =
        "INSERT INTO $appid_openweather (option_name, option_value) VALUES (:option_name, :option_value)";
    

}



    //         public function getAll(){
    //             $datas = $this->connect()->prepare("SELECT * FROM regions");
    //             $datas->execute();
    //             $allDatas = $datas->fetchAll(); 
    //             return $allDatas;
    //     }
    
    //     public function insert($code, $nom){
    //             $ajouter = $this->connect()->prepare('INSERT INTO regions ( code, nom) VALUES (:code, :nom)');
    //             $ajouter->bindParam(':code', $code); 
    //             $ajouter->bindParam(':nom', $nom);
    //             $ajouter->execute(); 
    //             $ajouter->debugDumpParams();
                
    //             //$result = $ajouter->execute();
    //             //$result->debugDumpParams();
               
    // }






//     public function initiatePlugin(){
//         register_activation_hook( __FILE__, array( $this, 'createTables' ) );
//  }
 
}