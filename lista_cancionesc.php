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
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


        <title>Todas las Canciones</title>
        <link rel="icon" href="img/favicon.ico" type="image/x-icon" />

        <link rel="stylesheet" type="text/css" href="estilo.css">
        <script type="text/javascript" src="acciones.js"></script>

        <link rel="stylesheet" href="./materialdesign/material.min.css">
        <script src="./materialdesign/material.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="./materialdesign/styles.css">
        <style>
            #view-source {
                position: fixed;
                display: block;
                right: 0;
                bottom: 0;
                margin-right: 40px;
                margin-bottom: 40px;
                z-index: 900;
            }
        </style>
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

                    <body class="mdl-demo mdl-color--grey-100 mdl-color-text--grey-700 mdl-base">
                        <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
                            <header class="mdl-layout__header">
                                <div class="mdl-layout__header-row">
                                    <!-- Title -->
                                    <img src="img/flecha-blanca.png" alt="LAGRAM" height="42" width="42">
                                    <span class="mdl-layout-title">Tonolele</span>
                                    <!-- Add spacer, to align navigation to the right -->
                                    <div class="mdl-layout-spacer"></div>
                                    <!-- Navigation. We hide it in small screens. -->
                                    <nav class="mdl-navigation  ">
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
                                        <?php
        if (check_login_status()) {
            ?>
                                            <a class="mdl-navigation__link" onclick="irPagina('agregar_cancion.php')">AGREGAR CANCIÓN</a>
                                            <a class="mdl-navigation__link" onclick="irPagina('logout.php')">LOGOUT</a>
                                            <a class="mdl-navigation__link" "> </a>
                                            <?php
        }
        if (!check_login_status()) {
            ?>
                                                <a class="mdl-navigation__link" onclick="irPagina('login.php')">LOGIN</a>
                                                <?php
        }
        if (check_login_status()) {
             ?>
                                                <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect  mdl-shadow--4dp mdl-color--primary" id="add">
                                                   <i class="material-icons" role="presentation">add</i>
                                                   <span class="visuallyhidden">Add</span>
                                                 </button>
                                                 <?php
         }
              ?>
                                    </nav>
                                </div>
                            </header>



                            <main class="mdl-layout__content">
                                <div class="mdl-layout__tab-panel is-active" id="overview">


                                    <section class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp">
                                        <div class="mdl-card mdl-cell mdl-cell--12-col">
                                            <div class="mdl-card__supporting-text mdl-grid mdl-grid--no-spacing">
                                                <h4 class="mdl-cell mdl-cell--12-col">Todas las canciones</h4>

                                                <table class="mdl-cell mdl-cell--12-col mdl-data-table mdl-js-data-table mdl-shadow--2dp">
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
                        '<td><label for="chk'.$cancion['cdb_canciones']['id'] .'" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" >
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

                                                <form action="lista_canciones_buscar.php" method="get">
                                                    BUSCAR CANCION
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

                                            <!-- Expandable Textfield -->

                                            <!-- <div class="mdl-card__actions">
                                                <a class="mdl-button" disabled>Buscar</a>
                                            </div> -->
                                        </div>
                                        <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="btn2">
                                            <i class="material-icons">more_vert</i>
                                        </button>
                                        <ul class="mdl-menu mdl-js-menu mdl-menu--bottom-right" for="btn2">
                                            <li class="mdl-menu__item" onclick="bajarTXTs()">Descargar letras en texto a TXT</li>
                                            <li class="mdl-menu__item" disabled>Descargar funciones a TXT</li>
                                            <li class="mdl-menu__item" disabled>Descargar tonos en tonalidad original a TXT</li>
                                            <li class="mdl-menu__item" disabled>Descargar funciones a PDF</li>
                                            <li class="mdl-menu__item" disabled>Descargar tonos en tonalidad original a PDF</li>
                                        </ul>
                                    </section>
                                    <!--
                                    <section class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp">
<header class="section__play-btn mdl-cell mdl-cell--3-col-desktop mdl-cell--2-col-tablet mdl-cell--4-col-phone mdl-color--teal-100 mdl-color-text--white">
    <i class="material-icons">play_circle_filled</i>
</header>
<div class="mdl-card mdl-cell mdl-cell--9-col-desktop mdl-cell--6-col-tablet mdl-cell--4-col-phone">
    <div class="mdl-card__supporting-text">
        <h4>Features</h4> Dolore ex deserunt aute fugiat aute nulla ea sunt aliqua nisi cupidatat eu. Nostrud in laboris labore nisi amet do dolor eu fugiat consectetur elit cillum esse.
    </div>
    <div class="mdl-card__actions">
        <a href="#" class="mdl-button">Read our features</a>
    </div>
</div>
<button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="btn1">
    <i class="material-icons">more_vert</i>
</button>
<ul class="mdl-menu mdl-js-menu mdl-menu--bottom-right" for="btn1">
    <li class="mdl-menu__item">Lorem</li>
    <li class="mdl-menu__item" disabled>Ipsum</li>
    <li class="mdl-menu__item">Dolor</li>
</ul>
</section>
-->

                                    <!--
                                    <section class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp">
                                        <div class="mdl-card mdl-cell mdl-cell--12-col">
                                            <div class="mdl-card__supporting-text mdl-grid mdl-grid--no-spacing">
                                                <h4 class="mdl-cell mdl-cell--12-col">Details</h4>
                                                <div class="section__circle-container mdl-cell mdl-cell--2-col mdl-cell--1-col-phone">
                                                    <div class="section__circle-container__circle mdl-color--primary"></div>
                                                </div>
                                                <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                                                    <h5>Lorem ipsum dolor sit amet</h5> Dolore ex deserunt aute fugiat aute nulla ea sunt aliqua nisi cupidatat eu. Duis nulla tempor do aute et eiusmod velit exercitation nostrud quis <a href="#">proident minim</a>.
                                                </div>
                                                <div class="section__circle-container mdl-cell mdl-cell--2-col mdl-cell--1-col-phone">
                                                    <div class="section__circle-container__circle mdl-color--primary"></div>
                                                </div>
                                                <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                                                    <h5>Lorem ipsum dolor sit amet</h5> Dolore ex deserunt aute fugiat aute nulla ea sunt aliqua nisi cupidatat eu. Duis nulla tempor do aute et eiusmod velit exercitation nostrud quis <a href="#">proident minim</a>.
                                                </div>
                                                <div class="section__circle-container mdl-cell mdl-cell--2-col mdl-cell--1-col-phone">
                                                    <div class="section__circle-container__circle mdl-color--primary"></div>
                                                </div>
                                                <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                                                    <h5>Lorem ipsum dolor sit amet</h5> Dolore ex deserunt aute fugiat aute nulla ea sunt aliqua nisi cupidatat eu. Duis nulla tempor do aute et eiusmod velit exercitation nostrud quis <a href="#">proident minim</a>.
                                                </div>
                                            </div>
                                            <div class="mdl-card__actions">
                                                <a href="#" class="mdl-button">Read our features</a>
                                            </div>
                                        </div>
                                        <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="btn2">
                                            <i class="material-icons">more_vert</i>
                                        </button>
                                        <ul class="mdl-menu mdl-js-menu mdl-menu--bottom-right" for="btn2">
                                            <li class="mdl-menu__item">Lorem</li>
                                            <li class="mdl-menu__item" disabled>Ipsum</li>
                                            <li class="mdl-menu__item">Dolor</li>
                                        </ul>
                                    </section>
-->

                                    <section class="section--footer mdl-color--white mdl-grid">
                                        <div class="section__circle-container mdl-cell mdl-cell--2-col mdl-cell--1-col-phone">
                                        </div>
                                        <div class="section__circle-container mdl-cell mdl-cell--2-col mdl-cell--1-col-phone">
                                            <img src="img/lagram-LQ.png" height="100">
                                            <!--<div class="section__circle-container__circle mdl-color--accent section__circle--big"></div>-->
                                        </div>
                                        <div class="section__text mdl-cell mdl-cell--4-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                                            Tonolele es un proyecto de LAGRAM para ayudarte a tocar canciones de alabanza. Podés usarlo en tu casa, en la iglesia o en donde quieras. Está todavía en desarrollo así que puede haber errores. Si tenés alguna idea o querés ayudarnos a mejorarlo, escribinos a info@lagram.com.ar o buscanos en Facebook </div>
                                        <div class="section__circle-container mdl-cell mdl-cell--2-col mdl-cell--1-col-phone">
                                        </div>
                                    </section>
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


                                        </ul>
                                    </div>
                                </footer>
                            </main>
                        </div>
                        <!--<a href="https://github.com/google/material-design-lite/blob/mdl-1.x/templates/text-only/" target="_blank" id="view-source" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast">View Source</a>-->
                        <script src="./materialdesign/material.min.js"></script>
                    </body>

    </html>
