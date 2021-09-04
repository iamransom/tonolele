<?php
session_start();
require_once('appvars.php');
require_once('mysqlclass.php');
//require_once('autorizar.php');
?>

<html>
<head>
    <title>Cancionero Data Base</title>
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script type="text/javascript" src="acciones.js">
</script>
</head>

<body>
    <?php
    if(!check_login_status()){
    ?><script type="text/javascript">
            window.location = "login.php";
                
    </script><?php
                echo "bad login";

    }
    else{

    $connection_information = array(
        'host' => DB_HOST,
        'user' => DB_USER,
        'pass' => DB_PASSWORD,
        'db' => DB_NAME
            );
        $m = new mysql($connection_information);
        
        $idcancion = getcheck('idcancion');
        $editando = getcheck('editando');
        
        $cancion  = $m->row(array(
            'table' => 'cdb_canciones',
            'condition' => 'id= '. '"'.$idcancion.'"' ));
            
            
            
            //var_dump($cancion['letra']);
                
    ?>

    <div id="header">
        <h1><?php echo $cancion['nombre']?><br>
        <span id="bot1" class="botontono noprint resaltado" onclick='setTono(0,"bot1");'>IV</span> <span id="bot2" class="botontono noprint" onclick='setTono(1,"bot2");'>DO</span> <span id="bot3" class="botontono noprint" onclick='setTono(3,"bot3");'>RE</span> <span id="bot4" class="botontono noprint" onclick='setTono(5,"bot4");'>MI</span> <span id="bot5" class="botontono noprint" onclick='setTono(6,"bot5");'>FA</span> <span id="bot6" class="botontono noprint" onclick='setTono(8,"bot6");'>SOL</span> <span id="bot7" class="botontono noprint" onclick='setTono(10,"bot7");'>LA</span> <span id="bot8" class="botontono noprint" onclick='setTono(12,"bot8");'>SI</span></h1>
    </div>

    <div id="mainframe">
    <?php
    
    ?>
        <div id="edit">
            <div id="editInfo" class="noprint">
                <form action="editar_cancion_bin.php" method="post">
                    <input class="formulario" type="text" name="idcancion" autocomplete="off" readonly hidden="" value="<?php echo  $cancion['id']?>"><br>
                    Nombre<input class="formulario" type="text" name="nombre" autocomplete="off" value="<?php echo  $cancion['nombre']  ?>"><br>
                    Autor<input class="formulario" type="text" name="autor" autocomplete="off" value="<?php echo   $cancion['autor'] ?>"><br>
                    Versión<input class="formulario" type="text" name="version" autocomplete="off" value="<?php echo   $cancion['version'] ?>"><br>
                    Tempo<input class="formulario" id="tempo" type="number" name="tempo" autocomplete="off" value="<?php echo  $cancion['tempo']  ?>"> <span class="botontono" onclick="taptempo()">TAP</span><br>
                    Cifra Indicadora<input class="formulario" type="number" name="cifraindicadora" autocomplete="off" value="<?php echo   $cancion['cifraindicadora']  ?>"><br>
                    Tono Original<input class="formulario" type="text" name="tonoorig" autocomplete="off" value="<?php echo  $cancion['tonoorig']?>"><br>
                    Link Youtube<input class="formulario" type="url" name="link1" autocomplete="off" value="<?php echo   $cancion['link1']  ?>"><br>
                    Link2<input class="formulario" type="url" name="link2" autocomplete="off" value="<?php echo   $cancion['link2'] ?>"><br>

                    <center>
                        <input class="boton" type="submit" value="    GUARDAR    ">
                    </center>
                </form>
            </div><!--div id="editTonos" class="noprint">

            <textarea class="textareachico" rows="20" cols="4" wrap="virtual" name="tonos"  autocomplete="off""><?php 
            echo  str_replace('\r\n', "&#10", $cancion['tonos']) ?></textarea>
            
            </div-->

            <div id="editLetra" class="noprint">
                <!--form action="editar_cancion_bin.php" method="post"-->
                <textarea class="textareachico" rows="20" cols="4" wrap="virtual" name="letra" autocomplete="off">
<?php 
            echo  str_replace('\r\n', "&#10", $cancion['letra']) ?>
</textarea><br>

                <div class="comentarioedit">
                    SIMBOLOS PARA LA CARGA:<br>
                    -el símbolo * separa compases tanto para las letras como para los tonos<br>
                    -las bajadas de línea en los tonos, no se toman en cuenta en la salida final<br>
                    -el nombre de cada verso se incluye entre símbolos @. Por ejemplo @estrofa 1@<br>
                    -si hay varios tonos dentro de un compás, separalos con un guion medio<br>
                    -si la canción está en escala menor, el primer caracter del campo de los tonos, debería ser una m minuscula
                </div>
            </div>
        </div>

        <div id="contenedorletra">
            <span id="cancDatosIzq" class="datoscancionizq">Tempo: <?php echo $cancion['tempo']?><br>
            Cifra: <?php echo $cancion['cifraindicadora']?><br>
            Tono Original: <?php echo numero_a_tono($cancion['tonoorig'])?><br></span> <span id="cancDatosDer" class="datoscancionder">Autor: <?php echo $cancion['autor']?><br>
            <?php
            if ($cancion['link1']){?> <a class="noprint" href="<?php echo $cancion['link1']?>" target="_blank">VER EN YOUTUBE</a><br>
            <?php }
            ?></span> <span id="botEditar" class="botoneseditar"><span class="botonchico noprint" onclick="mostrarDiv('editInfo');mostrarDiv('edit')">Modif. INFO</span> <?php 
                    echo '<span class="botonchico noprint" onclick="irPagina(\'cancion_editar.php?idcancion=' . $idcancion . '\')";>'.'EDITAR TONOS</span>'; 
                    echo '<span class="botonchico noprint" onclick="irPagina(\'cancion_editarletra.php?idcancion=' . $idcancion . '\')";>'.'EDITAR LETRA</span>'; 
                    //echo '<span class="botonchico noprint" onclick="irPagina(\'cancion_editartonos.php?idcancion=' . $idcancion . '\')";>'.'Modif. TONOS</span>'; 
                    
                    ?></span> <span id="cancTodo" class="todocancion"></span> </br>
<?php 
$url = $cancion['link1'];
preg_match(
        '/[\\?\\&]v=([^\\?\\&]+)/',
        $url,
        $matches
    );

$id = $matches[1];

$width = '640';
$height = '385';
echo '<object width="' . $width . '" height="' . $height . '"><param name="movie" value="http://www.youtube.com/v/' . $id . '&amp;hl=en_US&amp;fs=1?rel=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/' . $id . '&amp;hl=en_US&amp;fs=1?rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="' . $width . '" height="' . $height . '"></embed></object>';
?>

       </div>
        
   
    </div><?php
    }
    ?>

    <div id="footer" class="noprint">
        <span class="boton" onclick="irPagina('lista_canciones.php')">VOLVER A LISTA</span><br>
    </div><script type="text/javascript">


    var tonos = "<?php echo $cancion['tonos'] ?>"; 
    var letra = "<?php echo $cancion['letra'] ?>"; 
    var tonosp;
    var letrap;

    window.onload=function() {

    tonosp = tonos;
    letrap = letra;
    imprimirtodo();
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
            tonosPrnt[0] = "<\/br> <span class=\"tag\"> Canción en tono menor <\/span> "+tonosPrnt[0].substring(1);; //stringCompleto += cartel("Canción en Escala Menor");
            esmenor=1;
         }
        for(var i=0; i<tonosPrnt.length; i++){
            stringCompleto +=  tonosPrnt[i] ;
            if(stringtono.length+1>tonosPrnt[i].length){
	           for (var e=0; e<stringtono.length+1-tonosPrnt[i].length ;e++){
	           	 stringCompleto +=  "-";
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
         stringCompleto = stringCompleto.replace(/@([^@]*)@/g, "<span class=\"verso\">$1<\/span>");//<span class=\"medioespacio\"> <\/span>
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
    document.getElementById("bot1").className = "botontono noprint";
    document.getElementById("bot2").className = "botontono noprint";
    document.getElementById("bot3").className = "botontono noprint";
    document.getElementById("bot4").className = "botontono noprint";
    document.getElementById("bot5").className = "botontono noprint";
    document.getElementById("bot6").className = "botontono noprint";
    document.getElementById("bot7").className = "botontono noprint";
    document.getElementById("bot8").className = "botontono noprint";
    document.getElementById(boton).className = "botontono noprint resaltado";
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
