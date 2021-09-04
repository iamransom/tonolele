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
    <html lang="es">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


        <title>Canciones</title>
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


    <body class="mdl-demo mdl-color--grey-100 mdl-color-text--grey-700 mdl-base">
        <div class="demo-layout mdl-layout mdl-layout--fixed-header mdl-js-layout mdl-color--grey-100">
            <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
            <header class="mdl-layout__header">
                <div class="mdl-layout__header-row">
                    <!-- Title -->
                    <img src="img/flecha-blanca.png" alt="LAGRAM" height="42" width="42">
                    <span class="mdl-layout-title">Tonolele</span>
                    <!-- Add spacer, to align navigation to the right -->
                    <div class="mdl-layout-spacer"></div>
                    <!-- Navigation. We hide it in small screens. -->
                    <nav class="mdl-navigation mdl-layout--large-screen-only">
                        <a class="mdl-navigation__link" onclick="irPagina('lista_canciones.php')">CANCIONES</a>

                        <?php
    if (check_login_status()) {
        ?>
                            <?php
    }
    if (!check_login_status()) {
        ?>
                                <?php
    } ?>
                        <a class="mdl-navigation__link">
                          <i class="material-icons">print</i> <span>Imprimir</span>
                        </a>
                        <a class="mdl-navigation__link">
                          <i class="material-icons">share</i> <span> Compartir </span>
                      </a>
                    </nav>

                </div>
            </header>

            <!--
    <div class="mdl-layout__tab-bar mdl-js-ripple-effect mdl-color--primary-dark">

    <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored mdl-shadow--4dp mdl-color--accent" id="add">
    <i class="material-icons" role="presentation">add</i>
    <span class="visuallyhidden">Add</span>
    </button>
    </div>
    -->
            <main class="mdl-layout__content">
                <div class="mdl-layout__tab-panel is-active" id="overview">

                    <section class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp">

                        <div class="mdl-card mdl-cell mdl-cell--12-col">
                            <div class="mdl-card__supporting-text mdl-grid mdl-grid--no-spacing">
                                <h1 class="mdl-cell mdl-cell--12-col"><?php echo $cancion['nombre']?></h1>
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

                                <span id="cancDatosIzq" class="datoscancionizq">Tempo: <?php echo $cancion['tempo']?><br>
                            Tono Original: <?php echo numero_a_tono($cancion['tonoorig'])?><br></span> <span id="cancDatosDer" class="datoscancionder noprint">De: <?php echo $cancion['autor']?><br>

                            <?php
                            if ($cancion['link1']) {
                                ?> <a class="noprint" href="<?php echo $cancion['link1']?>" target="_blank">VER EN YOUTUBE</a><br>
                            <?php
                            }
                            ?></span>

                                </span> <span id="cancTodo" class="todocancion"></span> </br>


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
                            <?php if (check_login_status()) {
                                echo '<li class="mdl-menu__item" onclick="irPagina(\'cancion_editar.php?idcancion=' . $idcancion . '\')";>'.'Editar tonos</li> ';
                            }?>
                            <?php if (check_login_status()) {
                                echo '<li class="mdl-menu__item" onclick="irPagina(\'cancion_editarletra.php?idcancion=' . $idcancion . '\')";>'.'Editar letra</li> ';
                            }?>
                            <?php if (check_login_status()) {
                                echo '<li class="mdl-menu__item" onclick="editarinfo()";>'.'Editar info</li> ';
                            }?>

                        </ul>
                    </section>

                    <section class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp">
                        <div class="mdl-card mdl-cell mdl-cell--12-col">
                            <div class="mdl-card__supporting-text mdl-grid mdl-grid--no-spacing">
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
                                    echo '<object class="video noprint" >
                                    <param class="noprint" name="movie" value="http://www.youtube.com/v/' . $id . '&amp;hl=en_US&amp;fs=1?rel=0"></param>
                                    <param name="allowFullScreen" value="true"></param>
                                    <param name="allowscriptaccess" value="always"></param>
                                    <embed src="http://www.youtube.com/v/' . $id . '&amp;hl=en_US&amp;fs=1?rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="' . $width . '" height="' . $height . '"></embed></object>';
                                }
                                ?>
                                </div>
                            <!-- Expandable Textfield -->

                            <!-- <div class="mdl-card__actions">
                                <a class="mdl-button" disabled>Buscar</a>
                            </div> -->
                        </div>
                    </section>




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
                        <span class="botonchico noprint" onclick="mostrarDiv('editInfo');mostrarDiv('edit')">MODIFICAR INFO</span>
                    </div>
                </footer>
            </main>
        </div>
        <!--<a href="https://github.com/google/material-design-lite/blob/mdl-1.x/templates/text-only/" target="_blank" id="view-source" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast">View Source</a>-->
        <script src="./materialdesign/material.min.js"></script>
    </div>
    </body>







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
            stringCompleto +=  tonosPrnt[i] ;
            if(stringtono.length+2>tonosPrnt[i].length){
	           for (var e=0; e<stringtono.length+3-tonosPrnt[i].length ;e++){
	           	 stringCompleto +=  " -";
	           	}
            }
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
             letraPrnt[i] += '-';
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

	function createYouTubeEmbedLink (link) {

	 return link.replace("http://www.youtube.com/watch?v=", "http://www.youtube.com/embed/");
	 }
    </script>
</body>
</html>
