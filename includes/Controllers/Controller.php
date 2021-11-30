<?php

class Controller{

public static function adminPage(){

    if (isset($_POST['FillCollins'])) {
        $comm = new Communes(); 
        $comm->setCommunes();
    }

    if (isset($_POST['appid'])) {
        $appid = strip_tags($_POST['appid']);
        echo 'voici votre appId: ' . $appid . '<br>';
    }

}}