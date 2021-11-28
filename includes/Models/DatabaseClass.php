<?php



class DBWeather
{
    function __construct()
    {
    
        global $wpdb;
        $table_name = $wpdb->prefix . 'meteo_plugin_openweather';
        $wpdb_collate = $wpdb->collate;
        $sql =
            "CREATE TABLE {$table_name} (
            id mediumint(8) unsigned NOT NULL auto_increment ,
            appid varchar(40) NULL,
            PRIMARY KEY  (id),
            KEY first (first)
            )
            COLLATE {$wpdb_collate}";
    
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta( $sql );
       
    } 
    public function connect() //fonction de connextion à la base
    {
        try
        {
            global $wpdb;
            $servername = $wpdb->dbhost;
            $username = $wpdb->dbuser;
            $password = $wpdb->dbpassword;
            $dbname = $wpdb->dbname;
            // $charset = $wpdb->
            $charset = 'utf8mb4';
           
            $req = 'mysql:host='.$servername.';dbname='.$dbname.';charset='.$charset.','. $username .','. $password;
            echo $req;
            $bdd = new PDO($req);
            return $bdd; 
            var_dump($bdd);
        
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

//     public function initiatePlugin(){
//         register_activation_hook( __FILE__, array( $this, 'createTables' ) );
//  }
 
}