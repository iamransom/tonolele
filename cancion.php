<?php
session_start();
require_once('appvars.php');
require_once('mysqlclass.php');
//require_once('autorizar.php');
?>

<?php
    if (!check_login_status()) {
        ?><script type="text/javascript">
           // window.location = "login.php";
              var imprimir=0;


    </script><?php
               // echo "bad login";
    }
    //else{

    $connection_information = array(
        'host' => DB_HOST,
        'user' => DB_USER,
        'pass' => DB_PASSWORD,
        'db' => DB_NAME
            );
        $m = new mysql($connection_information);

        $idcancion = getcheck('idcancion');
        $editando = getcheck('editando');
        $imprimir = getcheck('imprimir');
        $tonnn = getcheck('tono');

        $cancion  = $m->row(array(
            'table' => 'cdb_canciones',
            'condition' => 'id= '. '"'.$idcancion.'"' ));



       if ($imprimir == "1") {  ////////// IMPRIME SI ESTA LA ORDEN
                   ?>
		       	<script>
		           	imprimir=1;

		           		//window.onload = function () { alert("It's loaded!") }
		       	</script>
		       <?php
       }
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

<!-- SETEA EL TONO SI EStÁ EN LA URL -->

  <?php
  if ($tonnn>1){
    }?>

<script type="text/javascript">
setTimeout(function(){
  console.log(<?php echo $tonnn; ?>);
  switch (<?php echo $tonnn; ?>) {
  case 1:
    setTono(1,"bot2");
    break;
  case 3:
    setTono(3,"bot3");
    break;
  case 5:
    setTono(5,"bot4");
    break;
  case 6:
    setTono(6,"bot5");
    break;
  case 8:
    setTono(8,"bot6");
    break;
  case 9:
    setTono(9,"bot7");
    break;
  case 10:
    setTono(10,"bot8");
    break;
  case 11:
    setTono(11,"bot9");
    break;
  case 12:
    setTono(12,"bot10");
    break;
  default:
    //Declaraciones ejecutadas cuando ninguno de los valores coincide con el valor de la expresión
    break;
  }

  //setTono(<?php echo $tonnn ?>,"bot8");
}, 2000);
</script>



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
  <body>
    <div class="demo-layout mdl-layout mdl-layout--fixed-header mdl-js-layout mdl-color--grey-100 ">
      <header class="demo-header mdl-layout__header">
        <div class="mdl-layout__header-row">
        <img src="img/flecha-blanca.png" alt="LAGRAM" height="42" width="42"  onclick="irPagina('lista_canciones.php')">
          <span class="mdl-layout-title"  onclick="irPagina('lista_canciones.php')">Tonolele</span>
          <div class="mdl-layout-spacer"></div>
          <a class="mdl-navigation__link mdl-button--colored" onclick=" window.history.back();">VOLVER</a>
                 <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect  mdl-cell--hide-phone" onclick="printthis()">
                <i class="material-icons">print</i>
            </button>
              <div id="tt4" class="icon material-icons">share</div>
                <div class="mdl-tooltip" for="tt4">
                Compartir estará disponible en breve
                </div>
             <!-- <button class="mdl-button mdl-js-button " onclick="irPagina('lista_canciones.php') mdl-color-text--grey-100">
              CANCIONES
            </button> -->
        </div>
      </header>
      <div class="demo-ribbon"></div>
      <main class="demo-main mdl-layout__content  ">
        <div class="mdl-grid">


            <div class="mdl-cell mdl-cell--2-col mdl-cell--8-col-tablet mdl-cell--8-col-phone ">
                <div class="demo-card-square mdl-card mdl-shadow--2dp ">
              <!-- <div class="mdl-card__title mdl-card--expand">
                <h2 class="mdl-card__title-text">Info</h2>
              </div> -->
              <div class="mdl-card__supporting-text">
                 Tempo: <?php echo $cancion['tempo']?><br>
                 Tono Original: <?php echo numero_a_tono($cancion['tonoorig'])?><br>
                 De: <?php echo $cancion['autor']?><br>
                 <?php
                 if ($cancion['link1']) {
                     ?> <a href="<?php echo $cancion['link1']?>" target="_blank">Ver en youtube</a><br>
                 <?php
                 }
                 ?>
              </div>
              <?php
              if (check_login_status()) {
                  ?>
               <div class="mdl-card__actions mdl-card--border">
                <?php
                echo "<a class=\"mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect\" onclick=\"irPagina('cancion_editarletra.php?idcancion=$idcancion')\">";
                ?>
                                  Editar letra
                </a>
                <?php
                echo "<a class=\"mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect\" onclick=\"irPagina('cancion_editar.php?idcancion=$idcancion')\">";
                ?>
                  Editar tonos
                </a>
            </div>
                <?php
              }
                ?>
              <!-- </div> -->
            </div>
             </div>


<!-- <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--2-col  mdl-cell--8-col-tablet mdl-cell--8-col-phone">
                ajsiodjoi
            </div> -->
            <!-- <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone "></div> -->
          <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--8-col">


                      <h2 class="mdl-cell mdl-cell--12-col"><?php echo $cancion['nombre']?></h2>
                      <button class="mdl-button mdl-js-button mdl-button--primary" id="bot1" onclick='setTono(0,"bot1");'>
                        IV
                      </button>
                      <button class="mdl-button mdl-js-button mdl-button--primary" id="bot2" onclick='setTono(1,"bot2");'>
                        DO
                      </button>
                      <button class="mdl-button mdl-js-button mdl-button--primary" id="bot3" onclick='setTono(3,"bot3");'>
                        RE
                      </button>
                      <button class="mdl-button mdl-js-button mdl-button--primary" id="bot4" onclick='setTono(5,"bot4");'>
                        MI
                      </button>
                      <button class="mdl-button mdl-js-button mdl-button--primary" id="bot5" onclick='setTono(6,"bot5");'>
                        FA
                      </button>
                      <button class="mdl-button mdl-js-button mdl-button--primary" id="bot6" onclick='setTono(8,"bot6");'>
                        SOL
                      </button>
                      <button class="mdl-button mdl-js-button mdl-button--primary" id="bot7" onclick='setTono(9,"bot7");'>
                        SOL#
                      </button>
                      <button class="mdl-button mdl-js-button mdl-button--primary" id="bot8" onclick='setTono(10,"bot8");'>
                        LA
                      </button>
                      <button class="mdl-button mdl-js-button mdl-button--primary" id="bot9" onclick='setTono(11,"bot9");'>
                        SI♭
                      </button>
                      <button class="mdl-button mdl-js-button mdl-button--primary" id="bot10" onclick='setTono(12,"bot10");'>
                        SI
                      </button>

            <span id="cancTodo" class="todocancion">
                      </span> </br>




          </div>


      </div>
      <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
        <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--8-col">

            <?php
            $url = $cancion['link1'];
            if ($url) {
                preg_match(
                    '/[\\?\\&]v=([^\\?\\&]+)/',
                    $url,
                    $matches
                );
                $id = $matches[1];
                // echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/8xe6nLVXEC0" frameborder="0" allowfullscreen></iframe>';
            }
            ?>

            <div class="container">
                <iframe src="//www.youtube.com/embed/<?php echo $id ?>"
                frameborder="0" allowfullscreen class="video"></iframe>
            </div>
      <!--
  </div>
        <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--8-col">
-->

            <?php
            $url = $cancion['link2'];
            if ($url) {
                preg_match(
                    '/[\\?\\&]v=([^\\?\\&]+)/',
                    $url,
                    $matches
                );
                $id = $matches[1];
                // echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/8xe6nLVXEC0" frameborder="0" allowfullscreen></iframe>';
            }
            ?>
            <?php
            if ( $cancion['link2']){
            ?>

            <div class="container">
                <iframe src="//www.youtube.com/embed/<?php echo $id ?>"
                frameborder="0" allowfullscreen class="video"></iframe>
            </div>
            <?php
            }
            ?>
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


                </ul>
                <!-- <span class="botonchico noprint" onclick="mostrarDiv('editInfo');mostrarDiv('edit')">MODIFICAR INFO</span> -->
            </div>
        </footer>
      </main>
    </div>
    <script src="./materialdesign/material.min.js"></script>
  </body>
</html>



   <script type="text/javascript">


    var tonos = "<?php echo $cancion['tonos'] ?>";
    var letra = "<?php echo $cancion['letra'] ?>";
    var tonosp;
    var letrap;

    window.onload=function() {

    tonosp = tonos;
    letrap = letra;
    imprimirtodo();
    if(imprimir==1) window.setTimeout(timer,5000);
    }

	function timer() {
		window.print();
	}

	function largostring(st){
		var largo = st.length;
		if(st.indexOf(".")>0){
			largo--;
		}
		if(st.indexOf(" ")>0){
		//	largo--;
		}
		return largo;
	}

	function agregarguion (st){
		var lin = st.length;
		st = st.replace(/\r\n/g,"-\r\n");
		st = st.replace(/\r/g,"-\r");
		st = st.replace(/\n/g,"-\n");
		if (lin == st.length) st += "-";
		return st;
	}

    function imprimirtodo(){
    letraPrnt = "";//letrap.split("*");
    tonosPrnt = letrap.split("*");
    //letraPrnt.unshift("*");
    //tonosPrnt.unshift("*");

    var stringCompleto = "";
    var esmenor=0;
    var stringtono=0;
         if(letrap.charAt(0)==="m") {
            tonosPrnt[0] = "<\/br> <span class=\"tag\"> Canción en escala menor <\/span> "+tonosPrnt[0].substring(1);; //stringCompleto += cartel("Canción en Escala Menor");
            esmenor=1;
         }
        for(var i=0; i<tonosPrnt.length; i++){
//            stringCompleto +=  tonosPrnt[i] ;
          	var let = largostring(tonosPrnt[i]);
        //  	console.log(tonosPrnt[i],'^',let,'^',stringtono.length);
            if(stringtono.length>let-2){
	           for (var e=0; e<stringtono.length+4-let ;e++){
	           	 tonosPrnt[i] = agregarguion(tonosPrnt[i]);
	           	 //tonosPrnt[i] +=  "*";
	           	}
            	}
            stringCompleto +=  tonosPrnt[i] ;

            i++;
            if (i<tonosPrnt.length){
            	stringtono=traducir(tonosPrnt[i],tonodestino ,esmenor);
             	stringCompleto += "<span class=\"tonoscancion\">" + stringtono + "<\/span>";
             }

         }

        // stringCompleto += letrap;
         stringCompleto = stringCompleto.replace(/\r\n/g,"<\/br>");
         stringCompleto = stringCompleto.replace(/\r/g,"<\/br>");
         stringCompleto = stringCompleto.replace(/\n/g,"<\/br>");
         stringCompleto = stringCompleto.replace(/<br>/g, "");
         stringCompleto = stringCompleto.replace(/@([^@]*)@/g, "</div><span class=\"verso\">$1<\/span><div class=\"bloque\">");//<span class=\"medioespacio\"> <\/span>
        // stringCompleto = stringCompleto.replace(/\*([^\*]*)\*/g, "<span class=\"tonoscancion\">$1<\/span>");


    console.log(tonodestino);
    for(var i=0; i<letraPrnt.length; i++){

     letraPrnt[i] = letraPrnt[i].replace(/\r\n/g,"<\/br>");
     letraPrnt[i] = letraPrnt[i].replace(/\r/g,"<\/br>");
     letraPrnt[i] = letraPrnt[i].replace(/\n/g,"<\/br>");
    try
        {
        tonosPrnt[i] = tonosPrnt[i].replace(/\r\n/g,"");
        tonosPrnt[i] = tonosPrnt[i].replace(/\r/g,"");
        tonosPrnt[i] = tonosPrnt[i].replace(/\n/g,"");
        }
    catch(err)
      {
      //Handle errors here
      }

     if (letraPrnt[i].indexOf('@') != -1){
        letraPrnt[i] = letraPrnt[i].replace(/<br>/g, "");
    //      letraPrnt[i] = letraPrnt[i].replace(/[^[\]]+(?=])/g, "<span class=\"medioespacio\"><br><br><\/span> <span class=\"verso\">ssss $1 <\/span> ");
        letraPrnt[i] = letraPrnt[i].replace(/@([^@]*)@/g, "<span class=\"medioespacio\"><\/span> <span class=\"verso\"> $1 <\/span> ");
        //SETEA ESTILO DE SEPARADOR DE MOMENTO
        letraPrnt[i] = letraPrnt[i].replace(/@([^@]*)@/g, "<span class=\"medioespacio\"><\/span> <span class=\"verso\"> $1  <\/span> ");
     }
     //letraPrnt[i] = letraPrnt[i].replace(/&/g,"<br><br>");

     if(tonosPrnt[i]) {
             tonosPrnt[i] =  tonosPrnt[i] + ' ';
     }

     if(tonosPrnt[i]) {
        while(tonosPrnt[i].length > letraPrnt[i].length){
             letraPrnt[i] += 'X';
        }
     }


     stringCompleto += "<span id=\"cancLetra\" class=\"letracancion\">" ;
     stringCompleto += letraPrnt[i] ;
     stringCompleto += "<\/span>";
   }

    document.getElementById('cancTodo').innerHTML = stringCompleto ;

    }

    function editarTonos(state){

            var div = document.getElementById(nombreDiv);
                if (div.style.display != 'block') {
                    div.style.display = 'block';
                }
                else {
                    div.style.display = 'none';
                }
        }



    var tonodestino = 0;
    function setTono(tono, boton){
    tonodestino = tono;
    document.getElementById("bot1").className = "mdl-button mdl-js-button mdl-button--primary";
    document.getElementById("bot2").className = "mdl-button mdl-js-button mdl-button--primary";
    document.getElementById("bot3").className = "mdl-button mdl-js-button mdl-button--primary ";
    document.getElementById("bot4").className = "mdl-button mdl-js-button mdl-button--primary ";
    document.getElementById("bot5").className = "mdl-button mdl-js-button mdl-button--primary ";
    document.getElementById("bot6").className = "mdl-button mdl-js-button mdl-button--primary ";
    document.getElementById("bot7").className = "mdl-button mdl-js-button mdl-button--primary ";
    document.getElementById("bot8").className = "mdl-button mdl-js-button mdl-button--primary ";
    document.getElementById("bot9").className = "mdl-button mdl-js-button mdl-button--primary ";
    document.getElementById("bot10").className = "mdl-button mdl-js-button mdl-button--primary ";
    document.getElementById(boton).className = "mdl-button mdl-js-button mdl-button--primary mdl-button--accent";
    imprimirtodo();
    }

    function cartel (texto){
    var vuelve = ""
    vuelve += texto + "<\/br>";
    return vuelve;
    }

    function printthis(){
        url = "cancionimp.php?idcancion=<?php echo $idcancion?>&tono="+tonodestino;
        // window.location.href = url;
        var win = window.open(url, '_blank');
        win.focus();
    }

	function createYouTubeEmbedLink (link) {

	 return link.replace("http://www.youtube.com/watch?v=", "http://www.youtube.com/embed/");
	 }
    </script>
</body>
</html>
