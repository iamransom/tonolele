<?php
session_start();

require_once('appvars.php');
require_once('mysqlclass.php');
//require_once('autorizar.php');
?>


<head>
	<title>Cancionero Data Base</title>
	<link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
	<link rel="stylesheet" type="text/css" href="estilo.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="acciones.js"></script>
</head>

<body onclick="myFunction()">
    <?php include_once("analyticstracking.php") ?>

<?php 
if(!check_login_status()){
?>
<script>
				window.location = "login.php";
			</script>
<?php
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

<h1> <?php echo $cancion['nombre']?><br>

</h1>
</div>

<div id="mainframe">

<div id="contenedorletra">

<span id="cancDatosIzq" class="datoscancionizq">
Tempo: <?php echo $cancion['tempo']?></br>
Cifra: <?php echo $cancion['cifraindicadora']?></br>
Tono Original: <?php echo numero_a_tono($cancion['tonoorig'])?></br>
</span>
<span id="cancDatosDer" class="datoscancionder">
Autor: <?php echo $cancion['autor']?></br>

<?php }
?>
</span>

<span id="botEditar" class="botoneseditar">
 <!--input class="botonchico" type="submit" value="ACEPTAR"-->

</span>


<span id="cancTodo" class="todocancion">
</span>


</div>

</div>



	<!--div id="footer"  class="noprint">
		<span class="boton" onclick="irPagina('lista_canciones.php')">VOLVER A LISTA</span>
		</br>
	</div-->
	
	<div id="botonesflotantes">
		<span class="botontono" onclick="ponertono(1)"> I </span>
		<span class="botontono" onclick="ponertono(4)"> IV </span>
		<span class="botontono" onclick="ponertono(5)"> V </span>
		<span class="botontono" onclick="ponertono(2)"> II </span>
		<span class="botontono" onclick="ponertono(3)"> III </span>
		<span class="botontono" onclick="ponertono(6)"> VI </span>
		<span class="botontono" onclick="ponertono(7)"> VII </span></br>

		<span class="titrecuadro"> DESPLAZAR TODO</span>
		<span class="botontono" onclick="moveratras()"> << </span>
		<span class="botontono" onclick="moveradelante()"> >> </span> </br>
		 <span class="boton" onclick="guardarTonos(letraPrnt.length)">GUARDAR</span>

 		<?php 
		echo '<span class="botonchico noprint" onclick="irPagina(\'cancion.php?idcancion=' . $idcancion . '\')";>'.'CANCELAR</span>'; 
		?> 


	</div>
	
</body>


<! ADAPTACION Y PRINT DE LETRA Y TONOS >

<script type="text/javascript"> 

 var tonos = "<?php echo $cancion['tonos'] ?>"; 
 var letra = "<?php echo $cancion['letra'] ?>"; 
 var idcancion = "<?php echo $idcancion ?>"; 
 var tonosp;
 var letrap;
 
window.onload=function() {

 tonosp = tonos;
 letrap = letra;
 imprimirtodo();
}

var tonosPrnt;

function imprimirtodo(){
 letraPrnt = letrap.split("*");
 tonosPrnt = tonosp.split("*");
 //letraPrnt.unshift("*");
 //tonosPrnt.unshift("*");

 var stringCompleto = "m = escala menor";
 for(var i=0; i<letraPrnt.length; i++){

	 letraPrnt[i] = letraPrnt[i].replace(/\r\n/g,"</br>");
 	 letraPrnt[i] = letraPrnt[i].replace(/\r/g,"</br>");
 	 letraPrnt[i] = letraPrnt[i].replace(/\n/g,"</br>");
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
	 	letraPrnt[i] = letraPrnt[i].replace(/@([^%]*)@/g, "<span class=\"medioespacio\"><br><br></span> <span class=\"verso\"> $1 </span> ");
	 }
 	 //letraPrnt[i] = letraPrnt[i].replace(/&/g,"<br><br>");
  
 //	 if(tonosPrnt[i]) {
//		  	 tonosPrnt[i] =  tonosPrnt[i] + ''; 
// 	 }

	 if(tonosPrnt[i]) {
		 while(tonosPrnt[i].length+1 > letraPrnt[i].length){
			 letraPrnt[i] += '-';
		}
		/*if (tonosPrnt[i].indexOf('-') != -1){
		 	switch (tonosPrnt[i].match(/-/g).length){
			 	case 1:
			 		tonosPrnt[i] = tonosPrnt[i].replace(/-/, "&nbsp;&nbsp;&nbsp;<span class=\"marcadortiempo\">³</span>");
			 		break;
			 	case 2:
			 		tonosPrnt[i] = tonosPrnt[i].replace(/-/, "&nbsp;<span class=\"marcadortiempo\">²</span>");
			 		tonosPrnt[i] = tonosPrnt[i].replace(/-/, "&nbsp;<span class=\"marcadortiempo\">³</span>");
			 		break;
			 	case 3:
			 		tonosPrnt[i] = tonosPrnt[i].replace(/-/, "&nbsp;<span class=\"marcadortiempo\">²</span>");
			 		tonosPrnt[i] = tonosPrnt[i].replace(/-/, "&nbsp;<span class=\"marcadortiempo\">³</span>");
			 		tonosPrnt[i] = tonosPrnt[i].replace(/-/, "&nbsp;<span class=\"marcadortiempo\">⁴</span>");
			 		break;
		 	}
		 }*/
if(true){//tonosPrnt[i].localeCompare('_') > 0) {    
//console.log(tonosPrnt[i].length);
var larg=1;
if (tonosPrnt[i].length!=0) larg=tonosPrnt[i].length;
		 stringCompleto += /*'<span class=\"marcadortiempoedit\">¹</span>' +*/ "<input class=\"inputtono\" size=\""+ larg +"\" type=\"text\" id=\""+i+"\"";
		 stringCompleto +=   'value="'+ tonosPrnt[i] +'">';
		 stringCompleto += "</input>";
	 }

	 }
	 else{
		 stringCompleto +=  "<input class=\"inputtono\" size=\"2\" type=\"text\" id=\""+i+"\"";
		 stringCompleto +=   'value="">';
		 stringCompleto += "</input>";		 
	 }
	 
	 	 
	 stringCompleto += "<span id=\"cancLetra\" class=\"letracancionedittono\">" ;
	 stringCompleto += letraPrnt[i] ;
	 stringCompleto += "</span>";
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
		
function guardarTonos(largo){
	if(document.getElementById("tono0")) stringTono=document.getElementById("tono0").value;
	else stringTono='';
	for(var i=1; i<largo; i++){
	 	tono = document.getElementById("tono"+i);	
	 	//console.log(tono.value);
	 	if(tono) stringTono+="*" + tono.value;
	 	else stringTono+="*";
	}
	stringTono+="*";
	//console.log(stringTono);
	//console.log(idcancion);
	mandaActualizar(stringTono);
}

function mandaActualizar(stringSend)
{

    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            console.log(xmlhttp.responseText);
	    	//		alert(xmlhttp.responseText);

			if(xmlhttp.responseText.substring(0, 2)=='OK'){
				//// QUE HAGO SI DA OK
				console.log("DEVOLVIO OK");
				irPagina("cancion.php?idcancion="+idcancion);
			}
        }
    }
    xmlhttp.open("POST","editar_cancion_bin.php",true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("idcancion="+idcancion+"&tonos="+stringSend);
    xmlhttp.send();
    
}

function moveratras(){
	if(document.getElementById(lastFocus).value){
		for(var o=lastFocus-1; o<tonosPrnt.length-2; o++){
			if(document.getElementById(o+1)){
				document.getElementById(o+1).value ="";
				document.getElementById(o+1).value = document.getElementById(o+2).value;
				console.log(document.getElementById(o).value);
			}
		}	
		document.getElementById(tonosPrnt.length-1).value ="";
	}
	document.getElementById(lastFocus).focus();

}

function moveradelante(){
	//console.log(lastFocus);	
	document.getElementById(lastFocus).focus();	
	for(var o=tonosPrnt.length; o>lastFocus; o--){
		if(document.getElementById(o)){
			document.getElementById(o).value ="";
			document.getElementById(o).value = document.getElementById(o-1).value;
			//console.log(document.getElementById(o).value);
		}
	}	
	document.getElementById(lastFocus).value ="";

}

var lastFocus;

function log(what, id) {
    lastFocus = id;
    //console.log(lastFocus);
}

function myFunction() {
    var x = document.activeElement.id;
    log("focus",x);
}

function ponertono(tono){
	console.log(lastFocus);
	var tonorom;
	document.getElementById(lastFocus).focus();
	switch(tono){
		case 1:
			tonorom= "I";
        break;
		case 2:
			tonorom= "II";
        break;
		case 3:
			tonorom= "III";			
        break;
		case 4:
			tonorom= "IV";			
        break;
		case 5:
			tonorom= "V";			
        break;
		case 6:
			tonorom= "VI";			
        break;
		case 7:
			tonorom= "VII";
        break;
		}
    document.activeElement.value=tonorom;
    document.getElementById(parseInt(lastFocus) + 1).focus();


}

</script>


