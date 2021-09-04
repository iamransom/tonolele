<?php
session_start();
require_once('appvars.php');
require_once('mysqlclass.php');
//require_once('autorizar.php');
?>
    <!doctype html>
    <!--
  Material Design Lite
  Copyright 2015 Google Inc. All rights reserved.
  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at
      https://www.apache.org/licenses/LICENSE-2.0
  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License
-->
    <html lang="es">

    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="description" content="Un proyecto para ayudarte a crecer">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
      <title>Tonolele</title>

      <!-- Add to homescreen for Chrome on Android -->
      <meta name="mobile-web-app-capable" content="yes">
      <link rel="icon" sizes="192x192" href="images/android-desktop.png">

      <!-- Add to homescreen for Safari on iOS -->
      <meta name="apple-mobile-web-app-capable" content="yes">
      <meta name="apple-mobile-web-app-status-bar-style" content="black">
      <meta name="apple-mobile-web-app-title" content="TONOLELE - LAGRAM">
      <link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">

      <!-- Tile icon for Win8 (144x144 + tile color) -->
      <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
      <meta name="msapplication-TileColor" content="#3372DF">

      <link rel="shortcut icon" href="images/favicon.png">

      <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
      <!--
      <link rel="canonical" href="http://www.example.com/">
      -->

      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
      <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
      <link rel="stylesheet" href="./materialdesign/material.min.css">
      <script src="./materialdesign/material.min.js"></script>
      <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
      <link rel="stylesheet" href="./materialdesign/styles.css">
      <link rel="stylesheet" type="text/css" href="estilo.css">
      <script type="text/javascript" src="acciones.js"></script>


    </head>


    <?php include_once("analyticstracking.php") ?>


        <?php


    $connection_information = array(
    'host' => DB_HOST,
    'user' => DB_USER,
    'pass' => DB_PASSWORD,
    'db' => DB_NAME
        );
        $m = new mysql($connection_information);



        //simple and complex query (I recommend you use the select method of the class rather than this)
        $canciones = $m->query('SELECT id, nombre, autor, tags FROM `cdb_canciones` ORDER BY `nombre` ASC');
        //var_dump($canciones);


?>

<body>
  <div class="demo-layout mdl-layout mdl-layout--fixed-header mdl-js-layout mdl-color--grey-100 ">
    <header class="demo-header mdl-layout__header">
      <div class="mdl-layout__header-row">
      <img src="img/flecha-blanca.png" alt="LAGRAM" height="42" width="42">
        <span class="mdl-layout-title">Tonolele</span>
        <div class="mdl-layout-spacer"></div>

    <?php
        if (check_login_status()) {
        ?>
                <a class="mdl-navigation__link"  onclick="irPagina('agregar_cancion.php')">AGREGAR CANCIÓN</a>
                <?php
        }
        ?>
        <form action="lista_canciones_buscar.php" method="get">
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
            <label class="mdl-button mdl-js-button mdl-button--icon" for="sample6">
              <i class="material-icons">search</i>
            </label>
            <div class="mdl-textfield__expandable-holder">
              <input class="mdl-textfield__input" type="text" name="querry" id="sample6">
              <label class="mdl-textfield__label" for="sample-expandable">Expandable Input</label>
            </div>
          </div>
        </form>
      </div>
    </header>
    <div class="demo-ribbon"></div>
    <main class="demo-main mdl-layout__content  ">
      <div class="mdl-grid">




<!-- <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--2-col  mdl-cell--8-col-tablet mdl-cell--8-col-phone">
              ajsiodjoi
          </div> -->

          <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone "></div>

        <div class="mdl-card demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--8-col mdl-cell--hide-phone">


            <h4 class="mdl-cell mdl-cell--12-col">Todas las canciones

                </h4>
            <!-- Right aligned menu below button -->
            <div class="mdl-card__menu">
                <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect" id="btn2">
                  <i class="material-icons">more_vert</i>
                </button>
            </div>
            <ul class="mdl-menu mdl-js-menu mdl-menu--bottom-right" for="btn2">
                <li class="mdl-menu__item" onclick="bajarTXTs()">Descargar letras en texto a TXT</li>
                <li class="mdl-menu__item" disabled>Descargar funciones a TXT</li>
                <li class="mdl-menu__item" disabled>Descargar tonos en tonalidad original a TXT</li>
                <li class="mdl-menu__item"  disabled">Imprimir funciones</li>
                <li class="mdl-menu__item" disabled>Descargar tonos en tonalidad original a PDF</li>
            </ul>
                <table class="mdl-cell mdl-data-table  mdl-cell--12-col mdl-js-data-table mdl-shadow--2dp  mdl-cell--hide-phone">
                    <thead>
                        <tr>
                            <th class="mdl-data-table__cell--non-numeric">
                                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-1">
                                    <input type="checkbox" id="checkbox-1" class="mdl-checkbox__input" onchange="checkAll(this)" >
                                </label>
                            </th>
                            <th class="mdl-data-table__cell--non-numeric">Título</th>
                            <th class="mdl-data-table__cell--non-numeric">De</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
foreach ($canciones as $cancion) {
//var_dump($fiesta);
//$codigoevento = $fiesta['cdf_eventos']['id'] . '_' . date("Ymd", strtotime($fiesta['cdf_eventos']['fecha']));
echo '<tr id="'.$cancion['cdb_canciones']['id'] .'">' .
'<td>'.''.'<label for="chk'.$cancion['cdb_canciones']['id'] .'" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" >
<input type="checkbox" name="sel[]"  id="chk'.$cancion['cdb_canciones']['id'] .'" class="mdl-checkbox__input">
</label></td>'.
'<td class="mdl-data-table__cell--non-numeric" onclick="irPagina(\'cancion.php?idcancion=' . $cancion['cdb_canciones']['id'] . '\')";>'. $cancion['cdb_canciones']['nombre'] . '</td>' .
'<td class="mdl-data-table__cell--non-numeric" onclick="irPagina(\'cancion.php?idcancion=' . $cancion['cdb_canciones']['id'] . '\')";>' . $cancion['cdb_canciones']['autor'] . '</td>' .
'<!--td onclick="irPagina(\'cancion.php?idcancion=' . $cancion['cdb_canciones']['id'] . '\')";>' . $cancion['cdb_canciones']['tags'] . '</td-->';

//		if(check_login_status()){
//					echo'<td class="checkbox">' . ' <input type="checkbox" name="sel[]" value="'.$cancion['cdb_canciones']['id'].'">' . '</td>' ;}
}
echo    '</tr>';
//				}
?>


                    </tbody>
                </table>
        </div>


<!-- PARA CELULAR -->

        <div class="mdl-cell  mdl-cell--hide-desktop  mdl-cell--hide-tablet">

            <h4 class="mdl-cell mdl-cell--12-col">Todas las canciones</h4>

                <table class="mdl-cell mdl-data-table  mdl-cell--12-col mdl-js-data-table mdl-shadow--4dp ">
                    <thead>
                        <tr>
                            <th class="mdl-data-table__cell--non-numeric">
                                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-1">
                                    <input type="checkbox" id="checkbox-1" class="mdl-checkbox__input" onchange="checkAll(this)" >
                                </label>
                            </th>
                            <th class="mdl-data-table__cell--non-numeric">Canción</th>
                            <!-- <th class="mdl-data-table__cell--non-numeric">De</th> -->

                        </tr>
                    </thead>
                    <tbody>
                        <?php
        foreach ($canciones as $cancion) {
        //var_dump($fiesta);
        //$codigoevento = $fiesta['cdf_eventos']['id'] . '_' . date("Ymd", strtotime($fiesta['cdf_eventos']['fecha']));
        echo '<tr id="'.$cancion['cdb_canciones']['id'] .'">' .
        '<td><label for="chk'.$cancion['cdb_canciones']['id'] .'" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" >
        <input type="checkbox" name="sel[]"  id="chk'.$cancion['cdb_canciones']['id'] .'" class="mdl-checkbox__input">
        </label></td>'.
    '<td class="mdl-data-table__cell--non-numeric" onclick="irPagina(\'cancion.php?idcancion=' . $cancion['cdb_canciones']['id'] . '\')";><strong>'. $cancion['cdb_canciones']['nombre'] . '</strong></br>' .
        'de '.$cancion['cdb_canciones']['autor'] . '</td>' .
        '<!--td onclick="irPagina(\'cancion.php?idcancion=' . $cancion['cdb_canciones']['id'] . '\')";>' . $cancion['cdb_canciones']['tags'] . '</td-->';

        //		if(check_login_status()){
        //					echo'<td class="checkbox">' . ' <input type="checkbox" name="sel[]" value="'.$cancion['cdb_canciones']['id'].'">' . '</td>' ;}
        }
        echo    '</tr>';
        //				}
        ?>


                    </tbody>
                </table>
        </div>


    </div>
        <div class="section--footer mdl-color--white mdl-grid">
            <div class="section__circle-container mdl-cell mdl-cell--3-col mdl-cell--1-col-phone">
            </div>
            <div class="section__circle-container mdl-cell mdl-cell--2-col mdl-cell--1-col-phone">
                <img src="img/lagram-LQ.png" height="100">
                <!--<div class="section__circle-container__circle mdl-color--accent section__circle--big"></div>-->
            </div>

            <div class="section__text mdl-cell mdl-cell--4-col-desktop mdl-cell--6-col-tablet mdl-cell--4-col-phone">
                Tonolele es un proyecto de LAGRAM para ayudarte a tocar canciones de alabanza. Podés usarlo en tu casa, en la iglesia o en donde quieras. Está todavía en desarrollo así que puede haber errores. Si tenés alguna idea o querés ayudarnos a mejorarlo, escribinos a info@lagram.com.ar o buscanos en Facebook </div>
            <div class="section__circle-container mdl-cell mdl-cell--2-col mdl-cell--1-col-phone">
            </div>

        </div>
      <footer class="mdl-mega-footer">

          <div class="mdl-mega-footer--bottom-section">

              <div class="mdl-logo">
                  LAGRAM - 2017
              </div>

              <ul class="mdl-mega-footer--link-list">
                  <li><a href="http://www.lagram.com.ar/">lagram.com.ar</a></li>
                  <li><a href="http://www.facebook.com/lagramoficial">facebook</a></li>
                  <li><a href="http://www.instagram.com/lagramoficial">instagram</a></li>
                  <li><a href="http://www.twitter.com/lagramoficial">twitter</a></li>

                  <?php
              if (check_login_status()) {
              ?>
                     <li> <a onclick="irPagina('logout.php')">LOGOUT</a></li>
             <?php
              }
              if (!check_login_status()) {
              ?>
                          <li><a  onclick="irPagina('login.php')">LOGIN</a></li>
                          <?php
              }
              ?>

              </ul>
              <!-- <span class="botonchico noprint" onclick="mostrarDiv('editInfo');mostrarDiv('edit')">MODIFICAR INFO</span> -->
          </div>
      </footer>
    </main>
  </div>
  <script src="./materialdesign/material.min.js"></script>
</body>

    </html>
