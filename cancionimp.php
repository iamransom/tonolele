<?php
session_start();
require_once('appvars.php');
require_once('mysqlclass.php');
//require_once('autorizar.php');
?>

<html>
<?php
    if(!check_login_status()){
    ?><script type="text/javascript">
           // window.location = "login.php";
              var imprimir=0;
              var tonoin=0;

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
        $tono = getcheck('tono');

        $cancion  = $m->row(array(
            'table' => 'cdb_canciones',
            'condition' => 'id= '. '"'.$idcancion.'"' ));


        if($tono != null){?>
            <script>
                tonoin = "<?php echo $tono?>";
                // alert("TONO: "+tonoin);
                    //window.onload = function () { alert("It's loaded!") }
            </script>
    <?php    }


       if(true){  ////////// IMPRIME SI ESTA LA ORDEN
	     		  ?>
		       	<script>
		           	imprimir=1;

		           		//window.onload = function () { alert("It's loaded!") }
		       	</script>
		       <?php
       }
    ?>
<head>
    <title>LAGRAM TONOLELE - <?php echo $cancion['nombre'] ?></title>
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script type="text/javascript" src="acciones.js">
</script>
</head>

<body>
        <?php include_once("analyticstracking.php") ?>


    <div id="window">

    <div id="header">
        <h1><?php echo $cancion['nombre']?><br>
            </div>

    <div id="mainframe">
        <div id="edit">
            <!--div id="editTonos" class="noprint">

            <textarea class="textareachico" rows="20" cols="4" wrap="virtual" name="tonos"  autocomplete="off""><?php
            echo  str_replace('\r\n', "&#10", $cancion['tonos']) ?></textarea>

            </div-->


        </div>

        <div id="contenedorletra">
	            <span id="cancDatosIzq" class="datoscancionizq">Tempo: <?php echo $cancion['tempo']?><br>
            Tono Original: <?php echo numero_a_tono($cancion['tonoorig'])?><br></span> <span id="cancDatosDer" class="datoscancionder noprint">De: <?php echo $cancion['autor']?><br>

            </span> <!--span id="botEditar" class="botoneseditar"><span class="botonchico noprint" onclick="mostrarDiv('editInfo');mostrarDiv('edit')">Modif. INFO</span> <?php
                    echo '<span class="botonchico noprint" onclick="irPagina(\'cancion_editar.php?idcancion=' . $idcancion . '\')";>'.'EDITAR TONOS</span>';
                    echo '<span class="botonchico noprint" onclick="irPagina(\'cancion_editarletra.php?idcancion=' . $idcancion . '\')";>'.'EDITAR LETRA</span-->';
                    //echo '<span class="botonchico noprint" onclick="irPagina(\'cancion_editartonos.php?idcancion=' . $idcancion . '\')";>'.'Modif. TONOS</span>';

                    ?></span> <span id="cancTodo" class="todocancion"></span> </br>


      		   </div>
         </div>
  </div>

   <script type="text/javascript">


    var tonos = "<?php echo $cancion['tonos'] ?>";
    var letra = "<?php echo $cancion['letra'] ?>";
    var tonosp;
    var letrap;

    window.onload=function() {

    tonosp = tonos;
    letrap = letra;
    imprimirtodo();
//    if(imprimir==1) window.setTimeout(timer,5000);
    }

	function timer() {
        var tn=parseInt(tonoin)
        if(tn>0 && tn<13) setTono(tn);
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
         stringCompleto = stringCompleto.replace(/@([^@]*)@/g, "</div></div><div class=\"bq\"><span class=\"verso\">$1<\/span><div class=\"bloque\">");//<span class=\"medioespacio\"> <\/span>
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
     window.setTimeout(timer,2000);

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
    function setTono(tono){
    tonodestino = tono;
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
