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

<body>
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


    <div id="window">


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
 <span class="boton" onclick="guardarTodo(letraPrnt.length);mandaActualizar(stringLetra);">GUARDAR</span>

 		<?php 
		echo '<span class="botonchico noprint" onclick="irPagina(\'cancion.php?idcancion=' . $idcancion . '\')";>'.'CANCELAR</span>'; 
		?> 


</span>


<span id="cancTodo" class="todocancion">
</span>

	<?php 
	$url = $cancion['link1'];
	if($url){
	preg_match(
	        '/[\\?\\&]v=([^\\?\\&]+)/',
	        $url,
	        $matches
	    );
	$id = $matches[1];
	//echo '<object class="video" width="' . $width . '" height="' . $height . '"><param class="noprint" name="movie" value="http://www.youtube.com/v/' . $id . '&amp;hl=en_US&amp;fs=1?rel=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/' . $id . '&amp;hl=en_US&amp;fs=1?rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="' . $width . '" height="' . $height . '"></embed></object>';
	}
	?>

</div>

</div>
</div>



	<div id="footer"  class="noprint">
		<!--span class="boton" onclick="irPagina('lista_canciones.php')">VOLVER A LISTA</span-->
		</br>
	</div>
	
</body>


<! ADAPTACION Y PRINT DE LETRA Y TONOS >

<script type="text/javascript"> 

 var tonos = "<?php echo $cancion['tonos'] ?>"; 
 var letra = "<?php echo $cancion['letra'] ?>"; 
 var idcancion = "<?php echo $idcancion ?>"; 
 var tonosp;
 var letrap;
 var guardando = false;

window.onload=function() {

 tonosp = tonos;
 letrap = letra;
 imprimirtodo();
 window.addEventListener("keydown", checkKeyPressed, false);

}
 
var smyVar; 
function checkKeyPressed(e) {
	console.log(e.keyCode);
    if (e.keyCode == "221"||e.keyCode == "8"||e.keyCode == "46"||e.keyCode == "50") {
        //alert("The '*' key is pressed.");
      //  myVar = setTimeout(refresh, 20);
        
    }
}


function refresh(){
	var posi = getPosition();
	console.log(posi);
	guardarTodo(letraPrnt.length);
    letrap = stringLetra;
    imprimirtodo();
     setSelectionRange(document.getElementById ("letra"),posi,posi);

}

var selection;

var getPosition =  function(){
	//selection = window.getSelection();
	selection = getCaretCharacterOffsetWithin(document.getElementById ("letra"));
	return selection;
}

////////////////

function getTextNodesIn(node) {
    var textNodes = [];
    if (node.nodeType == 3) {
        textNodes.push(node);
    } else {
        var children = node.childNodes;
        for (var i = 0, len = children.length; i < len; ++i) {
            textNodes.push.apply(textNodes, getTextNodesIn(children[i]));
        }
    }
    return textNodes;
}

function setSelectionRange(el, start, end) {
    if (document.createRange && window.getSelection) {
        var range = document.createRange();
        range.selectNodeContents(el);
        var textNodes = getTextNodesIn(el);
        var foundStart = false;
        var charCount = 0, endCharCount;

        for (var i = 0, textNode; textNode = textNodes[i++]; ) {
            endCharCount = charCount + textNode.length;
            if (!foundStart && start >= charCount
                    && (start < endCharCount ||
                    (start == endCharCount && i <= textNodes.length))) {
                range.setStart(textNode, start - charCount);
                foundStart = true;
            }
            if (foundStart && end <= endCharCount) {
                range.setEnd(textNode, end - charCount);
                break;
            }
            charCount = endCharCount;
        }

        var sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(range);
    } else if (document.selection && document.body.createTextRange) {
        var textRange = document.body.createTextRange();
        textRange.moveToElementText(el);
        textRange.collapse(true);
        textRange.moveEnd("character", end);
        textRange.moveStart("character", start);
        textRange.select();
    }
}


//////////////

function getCaretCharacterOffsetWithin(element) {
    var caretOffset = 0;
    if (typeof window.getSelection != "undefined") {
        var range = window.getSelection().getRangeAt(0);
        var preCaretRange = range.cloneRange();
        preCaretRange.selectNodeContents(element);
        preCaretRange.setEnd(range.endContainer, range.endOffset);
        caretOffset = preCaretRange.toString().length;
    } else if (typeof document.selection != "undefined" && document.selection.type != "Control") {
        var textRange = document.selection.createRange();
        var preCaretTextRange = document.body.createTextRange();
        preCaretTextRange.moveToElementText(element);
        preCaretTextRange.setEndPoint("EndToEnd", textRange);
        caretOffset = preCaretTextRange.text.length;
    }
    return caretOffset;
}

function showCaretPos() {
    var el = document.getElementById("test");
    var caretPosEl = document.getElementById("caretPos");
    caretPosEl.innerHTML = "Caret position: " + getCaretCharacterOffsetWithin(el);
}





/////////////

function imprimirtodo(){
 letraPrnt = letrap.split("*");
 tonosPrnt = tonosp.split("*");
 //letraPrnt.unshift("*");
 //tonosPrnt.unshift("*");

 var stringCompleto = "<div id=\"letra\"  class=\"inputletra\" type=\"text\" id=\"letra\" contenteditable>";

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
		 	 letraPrnt[i] = letraPrnt[i].replace(/@([^@]*)@/g, "<span class=\"letraparte\">@$1@</span> ");
		 	 //var start=letraPrnt[i].indexOf('@') + 1;
		 	 //var end =letraPrnt[i].indexOf('@',start);
		 	 //letraPrnt[i] = letraPrnt[i].replace(/<br>/g, "");

			 //stringCompleto += "<span class=\""+ colornumero(i) +"\">" + letraPrnt[i].substring(0, start-1);
			 //stringCompleto += '</span>';

			 //stringCompleto += "<span class=\"letraparte\">" + letraPrnt[i].substring(start-1, end+1);
			 //stringCompleto += '</span>';

			 //stringCompleto += "<span class=\""+ colornumero(i) +"\">" + letraPrnt[i].substring(end+1, letraPrnt[i].length);
			 //if(letraPrnt[i].length - end < 2) stringCompleto += "&nbsp;&nbsp;&nbsp;&nbsp;";
			 //stringCompleto += '</span>*';
			 
			 stringCompleto += "<span class=\""+ colornumero(i) + "\">" + letraPrnt[i];
			 if(letraPrnt[i].length < 2) stringCompleto += "";
			 stringCompleto += '</span>*';
			 
		 }
		 else{ 
			 stringCompleto += "<span class=\""+ colornumero(i) + "\">" + letraPrnt[i];
			 if(letraPrnt[i].length < 2) stringCompleto += "";
			 stringCompleto += '</span>*';
		 }
 }
 	stringCompleto = stringCompleto.substring(0,stringCompleto.length-1);

 stringCompleto += "</div>";
//console.log(stringCompleto);
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
		
		
var stringLetra
function guardarTodo(largo){
guardando=true;
	stringLetra=document.getElementById("letra").innerText;
	
	/////SACA ESTILO
	console.log(document.getElementById("letra").innerText);
	
		
	stringLetra = stringLetra.replace(/(<\/span>|<span class="letraeven">|<span class="letraodd">|<span class="letraparte">|<\/div>|&nbsp;)/gi, '');
	stringLetra = stringLetra.replace(/(<br>|<div>)/gi, '\r\n');
	stringLetra = stringLetra.replace(/(<br>)/gi, '\r\n');
	stringLetra = stringLetra.replace(/\r\n\r\n/gi, '\r\n');

	////////
	//console.log(stringLetra);
	//console.log(stringTono);
	//console.log(idcancion);
	//mandaActualizar(stringLetra);
}

function mandaActualizar(actualizaletra)
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
    xmlhttp.send("idcancion="+idcancion+"&letra="+actualizaletra);
    xmlhttp.send();
    
}

function colornumero(num){
  if(num % 2 == 0){
	  return "letraodd";
  }
  else{
	  return "letraeven";
  }
}

window.onbeforeunload = myConfirmation;

function myConfirmation() {
	if (guardando) return undefined;

    return 'Estás saliendo de la página sin guardar tus cambios';
}

</script>


	