<?php

class Controller{

public static function adminPage(){

    
if (isset($_POST['FillCollins'])) {
        $comm = new Communes(); 
        $comm->setCommunes();
         }
// if (isset($_POST['communeSearch']))    
//     ob_start();
//     include (__DIR__ . ('/../Views/currentweather.php'));
    

//     $content = ob_get_clean();
    // if (isset($_POST['appid'])) {
    // ob_start();
    // require_once (__DIR__ . ('/../Models/OpenweatherClass.php'));
    // }

}}