<?php

require_once(__DIR__ . ('/../includes/Views/configuration.php'));
require_once(__DIR__ . ('/../includes/Views/currentweather.php'));
Controller::adminPage();
$data = new Communes();
// $data->displayCommunes();
?>

<form action="" method="post" autocomplete="off">
    <label for="communeSearch">Chosissez une commune</label>
    <input list="communes" id="communeSearch" oninput="searching(this.value)" name="communeSearch" placeholder="Code postal ou ville" />
    <input type="submit" value="C'est super!">
</form>

<datalist id="communes"> 
<div id="options">
<script>
    let options = document.getElementById('ici');
  
    function searching(search) {
        var ajax = new XMLHttpRequest();
        console.log(search);
        // ajax.onreadystatechange = function() {
        // ajax.responseType = 'json';
        ajax.open('GET', '../wp-content/plugins/meteo/includes/getcommunes.php?communeSearch='+search);
        ajax.onloadend = function() {setlist(this.response)};
        ajax.send();
    }
    function setlist(response){
        let communes = JSON.parse(response);
        console.log(communes);
        document.getElementById("options").innerHTML = "";
        for (commune  of communes){
            document.getElementById("options").innerHTML += '<option value="'+commune.codepostal+' '+commune.nom+'">';
            
    }
}
</script>
</div>       
</datalist>
