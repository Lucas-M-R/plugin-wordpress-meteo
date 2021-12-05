<?php
function appiform()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'options';
    $appi = $wpdb->get_row("SELECT option_value FROM $table_name WHERE option_name = 'APPID'", ARRAY_A);
    if (is_null($appi)) {
        echo 'placeholder="Entre votre clé API ici"';
    } else {
        echo 'value="' . $appi["option_value"] . '"';
    }
}

?>


<script>
    function searching(search) {
        var ajax = new XMLHttpRequest();
        // console.log(search);
        // ajax.onreadystatechange = function() {
        // ajax.responseType = 'json';
        ajax.open('GET', '../wp-content/plugins/meteo/includes/Models/getcommunes.php?communeSearch=' + search);
        ajax.onloadend = function() {
            setlist(this.response)
        };
        ajax.send();
    }

    function setlist(response) {
        let communes = JSON.parse(response);
        console.log("-------------", communes);
        options.innerHTML = "";
        for (commune of communes) {
            options.innerHTML += '<option value="' + commune.codepostal + ' ' + commune.nom + '">';
        }
    }


    function copyTextFull() {
        let copyTextFull = document.getElementById("shortcodeFull");
        copyTextFull.select();
        copyTextFull.setSelectionRange(0, 99999); /* For mobile devices */
        navigator.clipboard.writeText(copyTextFull.value);
        alert("Shortcode dans le presse-papiers: " + copyTextFull.value);
    }

    function copyText() {
        let copyText = document.getElementById("shortcode");
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */
        navigator.clipboard.writeText(copyText.value);
        alert("Shortcode dans le presse-papiers: " + copyText.value);
    }

    function copyTextMini() {
        let copyTextMini = document.getElementById("shortcodemini");
        copyTextMini.select();
        copyTextMini.setSelectionRange(0, 99999); /* For mobile devices */
        navigator.clipboard.writeText(copyTextMini.value);
        alert("Shortcode dans le presse-papiers: " + copyTextMini.value);
    }
</script>


<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Shortcode</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Configuration</button>
    </li>

</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">


        <!-- Onglet Shortcode -->

        <div class="mb-3 container">
            <form action="" method="POST" autocomplete="off">
                <label class="form-label" for="communeSearch">Chosissez une commune</label><br>
                <input list="communes" class="form-control mb-3 w-50" id="communeSearch" oninput="searching(this.value)" name="communeSearch" placeholder="Code postal ou ville" />
                <input type="submit" class="btn btn-success" value="Créer les shortcodes">
            </form>
        </div>

        <datalist id="communes">
            <div id="options">
                <!-- le script ajax fonction searching va là dedans -->
            </div>
        </datalist>
        <div id="currentweather"></div>

        
        <?php
        $shortcity = preg_replace('[\d]', '', $_POST['communeSearch']);
        $shortcity = sanitize_text_field($shortcity); ?>



        <label for="shortcodeFull">Votre Shortcode</label>
        <input type="text" id="shortcodeFull" value="[meteofull ville=<?= $shortcity ?>]">
        <div class="btn" onclick="copyTextFull()"><img src="https://www.svgrepo.com/show/29533/clipboard.svg" alt="" style="width:30px; height:30px;"></div>

        <label for="shortcodeFull">Votre Shortcode</label>
        <input type="text" id="shortcode" value="[meteo ville=<?= $shortcity ?>]">
        <div class="btn" onclick="copyText()"><img src="https://www.svgrepo.com/show/29533/clipboard.svg" alt="" style="width:30px; height:30px;"></div>

        <label for="shortcodeFull">Votre Shortcode</label>
        <input type="text" id="shortcodemini" value="[meteomini ville=<?= $shortcity ?>]">
        <div class="btn" onclick="copyTextMini()"><img src="https://www.svgrepo.com/show/29533/clipboard.svg" alt="" style="width:30px; height:30px;"></div>


    </div>

    <!-- onglet configuration -->

    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

        <div class="m-3 d-flex">
            <form action="" method="POST">
                <label class="form-label">Pour obtenir une clé API il vous faut vous inscrire sur <a href="https://openweathermap.org" target="blank">Openweather</a></label><br />
                <input type="text" name="appid" <?= appiform() ?>>
                <input class="btn btn-outline-secondary btn-sm" type="submit" value="Enregistrer la clé API">

            </form>
            <form method="POST">
                <input type="submit" name="FillCollins" value="Peupler la base de données" />
            </form>
        </div>

    </div>
</div>





















<script>
    let options = document.getElementById('options');
</script>






<!-- <form action="" method="POST">
    <select name="lang" id="langChoice">
        <option value="">--Selectionnez une langue --</option>
        <option value="af"> Afrikaans </option>
        <option value="al"> Albanian </option>
        <option value="ar"> Arabic </option>
        <option value="az"> Azerbaijani </option>
        <option value="bg"> Bulgarian </option>
        <option value="ca"> Catalan </option>
        <option value="cz"> Czech </option>
        <option value="da"> Danish </option>
        <option value="de"> German </option>
        <option value="el"> Greek </option>
        <option value="en"> English </option>
        <option value="eu"> Basque </option>
        <option value="fa"> Persian (Farsi) </option>
        <option value="fi"> Finnish </option>
        <option value="fr"> French </option>
        <option value="gl"> Galician </option>
        <option value="he"> Hebrew </option>
        <option value="hi"> Hindi </option>
        <option value="hr"> Croatian </option>
        <option value="hu"> Hungarian </option>
        <option value="id"> Indonesian </option>
        <option value="it"> Italian </option>
        <option value="ja"> Japanese </option>
        <option value="kr"> Korean </option>
        <option value="la"> Latvian </option>
        <option value="lt"> Lithuanian </option>
        <option value="mk"> Macedonian </option>
        <option value="no"> Norwegian </option>
        <option value="nl"> Dutch </option>
        <option value="pl"> Polish </option>
        <option value="pt"> Portuguese </option>
        <option value="pt"> Português Brasil </option>
        <option value="ro"> Romanian </option>
        <option value="ru"> Russian </option>
        <option value="sv"> Swedish </option>
        <option value="sk"> Slovak </option>
        <option value="sl"> Slovenian </option>
        <option value="sp"> Spanish </option>
        <option value="sr"> Serbian </option>
        <option value="th"> Thai </option>
        <option value="tr"> Turkish </option>
        <option value="ua"> Ukrainian </option>
        <option value="vi"> Vietnamese </option>
        <option value="cn"> Chinese Simplified </option>
        <option value="zh"> Chinese Traditional </option>
        <option value="zu"> Zulu </option>
    </select>
</form> -->