<?php
session_start(); require_once('appvars.php'); require_once('mysqlclass.php'); ?>

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
    <?php include_once("analyticstracking.php") ?>

    <?php
    if(!check_login_status()){ ?><script type="text/javascript">
            window.location = "login.php";

    </script><?php
        echo "bad login"; } else{ $connection_information = array( 'host' => DB_HOST, 'user' => DB_USER, 'pass' => DB_PASSWORD, 'db' => DB_NAME ); $m = new mysql($connection_information); $idcancion = getcheck('idcancion'); $editando = getcheck('editando'); $cancion = $m->row(array( 'table' => 'cdb_canciones', 'condition' => 'id= '. '"'.$idcancion.'"' )); ?>
    <div id="window">

    <div id="header">
        <h1><?php echo $cancion['nombre']?><br></h1>
    </div>

    <div id="mainframe">
        <div id="edit">
            <!--div id="editTonos" class="noprint">

            <textarea class="textareachico" rows="20" cols="4" wrap="virtual" name="tonos"  autocomplete="off""><?php  echo str_replace('\r\n', "&#10", $cancion['tonos']) ?></textarea>

            </div-->

            <div id="editLetra" class="noprint">
                <!--form action="editar_cancion_bin.php" method="post"-->
                <textarea class="textareachico" rows="20" cols="4" wrap="virtual" name="letra" autocomplete="off">
<?php  echo str_replace('\r\n', "&#10", $cancion['letra']) ?>
</textarea><br>
            </div>
        </div>
        <div id="contenedorletra" >
            <span id="botEditar" class="botoneseditar"><span class="botonchico noprint" onclick="guardar('editInfo')">GUARDAR</span> <span class="botonchico noprint" onclick="cancelar('editInfo')">CANCELAR</span></span> <div id="cartelmodo" class="todocancion"></div> <div id="cancTodo" class="todocancion"></div>
        </div>
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
    <div id="cartel"class="botoneraagregartono">
    	<span id="bot1" class="botonpop noprint" onclick='cierrapoptono("I");'>I</span>
    	<span id="bot2" class="botonpop noprint" onclick='cierrapoptono("II");'>II</span>
    	<span id="bot3" class="botonpop noprint" onclick='cierrapoptono("III");'>III</span>
    	<span id="bot4" class="botonpop noprint" onclick='cierrapoptono("IV");'>IV</span></br>
    	<span id="bot5" class="botonpop noprint" onclick='cierrapoptono("V");'>V</span>
    	<span id="bot6" class="botonpop noprint" onclick='cierrapoptono("VI");'>VI</span>
    	<input id="inputton" class="inputtono noprint" type="text" name="lname" size="2" onkeypress='inputkey(event);'> 
    </div>  
     <div id="cartelmodif"class="botoneraagregartono">
    	<input id="editton" class="inputtono noprint" type="text" name="lname" size="6" onkeypress='inputkey(event);'> 
    	<span id="bot1" class="botonpop noprint" onclick='cierrapopmodif("");'>del</span>
    </div>  
    <?php
    } ?><script type="text/javascript">
 
    var tonos = "<?php echo $cancion['tonos'] ?>";
    var letra = "<?php echo $cancion['letra'] ?>";
    var idcancion = "<?php echo $idcancion ?>"; 
    var guardando = false;

    var tonosp;
    var letrap;
    var cartelescala;
    var esmenor=0;
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
    var stringtono=0;
    
    ////////////////SI LA CANCION ESTA EN MENOR
         if(letrap.charAt(0)==="m") {
            cartelescala = '<input type="checkbox" id="escala" name="escala" value="menor" checked> Canción en escala menor';
            document.getElementById('cartelmodo').innerHTML = cartelescala ;
            tonosPrnt[0] = tonosPrnt[0].substring(1);
            esmenor=1;

         }
         else {
            cartelescala = '<input type="checkbox" id="escala"  name="escala" value="menor" > Canción en escala menor';
            document.getElementById('cartelmodo').innerHTML = cartelescala ;
            //cartelescala = "<input type="checkbox" name="vehicle" value="Bike"> I have a bike<br><\/br> <span class=\"tag\"> Canción en tono menor <\/span> "; //stringCompleto += cartel("Canción en Escala Menor");
         }
         
         
         
    ///////////////////////////
        for(var i=0; i<tonosPrnt.length; i++){
        	stringCompleto +=  tonosPrnt[i] ;
            if(stringtono.length+1>tonosPrnt[i].length){
	           for (var e=0; e<stringtono.length+1-tonosPrnt[i].length ;e++){
	           	 stringCompleto +=  "<span>-</span>";
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
         stringCompleto = stringCompleto.replace(/@([^@]*)@/g, "<span class=\"verso\">$1<\/span><!-- cierra verso -->");//<span class=\"medioespacio\"> <\/span>
        // stringCompleto = stringCompleto.replace(/\*([^\*]*)\*/g, "<span class=\"tonoscancion\">$1<\/span>");


    //console.log(tonodestino);
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
    if(tonosPrnt[i].localeCompare('_') > 0) {
         stringCompleto += '<span class=\"marcadortiempo\">¹<\/span>' + "<span id=\"cancTono\" class=\"tonoscancion\">" ;
             stringCompleto +=  tonosPrnt[i];// + '|';
         stringCompleto += "&nbsp;<\/span>";
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

    function cartel (texto){
    var vuelve = ""
    vuelve += texto + "<\/br>";
    return vuelve;
    }
    
    var ee;
   var contletra = document.getElementById('cancTodo');
		contletra.onclick = function(e) {
			var clase = e.target.className;
			//console.log(clase);
			posicion=getCaretCharacterOffsetWithin(this);
			if(clase == "todocancion"){
				var dive = document.getElementById('cartel');
				//console.log(dive.style.display);
				cierrapopmodif("close");
				if(dive.style.display === "") abrepoptono();
				else if(dive.style.display === "none") abrepoptono();
				else if(dive.style.display === "block") cierrapoptono("close");
			}
			else if(clase == "tonoscancion"){
				var dive = document.getElementById('cartelmodif');
				//console.log(dive.style.display);
				ee=e;
				cierrapoptono("close");
				if(dive.style.display === "") abrepopmodif();
				else if(dive.style.display === "none") abrepopmodif();
				else if(dive.style.display === "block") cierrapopmodif("close");
			}
			
	};
	
   var posicion;
	

function myConfirmation() {
	if (guardando) return undefined;
    return 'Estás saliendo de la página sin guardar tus cambios';
}

var cursor;

function abrepoptono(){
				var div = document.getElementById('cartel');
				div.style.display = "block";
				div.style.left = event.clientX;
				div.style.top = event.clientY;
				cursor = savecursor();
				//console.log(document.getElementById('inputton'));
				document.getElementById('inputton').focus();

				//var contenido = prompt("qué grado?", "");

} 
 
function cierrapoptono(accion){ 
				var div = document.getElementById('cartel');
				div.style.display = "none";
				switch (accion){ 
					case "close": 
						break;
					default: 
						var contenido = accion;
						if(contenido !== "")	insertTextAtCursor(cursor, contenido);
						break;
				}
} 

function abrepopmodif(){
			var inp = document.getElementById('editton');
			var div = document.getElementById('cartelmodif');
				div.style.display = "block";
				div.style.left = event.clientX;
				div.style.top = event.clientY;
				inp.value = ee.srcElement.innerHTML;
				//console.log(ee.srcElement.innerHTML);
				//ee.srcElement.innerHTML="";
				document.getElementById('editton').focus();

}

function cierrapopmodif(accion){
 				var div = document.getElementById('cartelmodif');
				div.style.display = "none";
				switch (accion){ 
					case "close": 
						break;
					default: 
						ee.srcElement.innerHTML = accion;
						break;
				}
}


function inputkey(e){
	//console.log(e.keyCode);
	if (e.keyCode == 13) {
        cierrapoptono(document.getElementById('inputton').value);
        cierrapopmodif(document.getElementById('editton').value);
    }
	if (e.keyCode == 27) {
        cierrapoptono("close");
        cierrapopmodif("close");
    }
}

function savecursor() {
    var sel, range, html, pos;
    if (window.getSelection) {
        sel = window.getSelection();
        if (sel.getRangeAt && sel.rangeCount) {
            range = sel.getRangeAt(0);
           // var newNode = document.createElement('span');
           // newNode.className = 'tonoscancion';
           // newNode.innerHTML = text;
           // range.deleteContents();
           //range.insertNode(newNode );
           // range.insertNode( document.createTextNode(text) );
        }

    } else if (document.selection && document.selection.createRange) {
        document.selection.createRange().text = text;
    }
    return range;
}

window.onbeforeunload = myConfirmation;
//////////////


function insertTextAtCursor(cursor, text) {
    var sel, range, html;
    if (window.getSelection) {
        sel = window.getSelection();
        if (sel.getRangeAt && sel.rangeCount) {
            range = cursor;//sel.getRangeAt(0);
            var newNode = document.createElement('span');
            newNode.className = 'tonoscancion';
            newNode.innerHTML = text;
           // range.deleteContents();
           range.insertNode(newNode );
           // range.insertNode( document.createTextNode(text) );
        }
    } else if (document.selection && document.selection.createRange) {
        document.selection.createRange().text = text;
    }
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

function showCaretPos() {
    var el = document.getElementById("test");
    var caretPosEl = document.getElementById("caretPos");
    caretPosEl.innerHTML = "Caret position: " + getCaretCharacterOffsetWithin(el);
}


//////////////////////////////// GUARDAR Y CANCELAR
var stringToSave;
function guardar(){
	guardando=true;
    stringToSave = document.getElementById("cancTodo").innerHTML;
    	/////SACA ESTILO	
	//stringToSave = stringToSave.replace(/(<\/span>|<span class="letraeven">|<span class="letraodd">|<span class="letraparte">|<\/div>|&nbsp;)/gi, '');
	stringToSave = stringToSave.replace(/(<span class="tonoscancion"><\/span>)/gi, '');
	stringToSave = stringToSave.replace(/(<span>-<\/span>)/gi, '');
	stringToSave = stringToSave.replace(/(<span class="verso">)/gi, '@');
	stringToSave = stringToSave.replace(/(<\/span><!-- cierra verso -->)/gi, '@');
	stringToSave = stringToSave.replace(/(<span class="tonoscancion">)/gi, '*');
	stringToSave = stringToSave.replace(/(<\/span>)/gi, '*');
	stringToSave = stringToSave.replace(/(<br>|<div>)/gi, '\r\n');
	stringToSave = stringToSave.replace(/(&nbsp;)/gi, ' ');
	stringToSave = stringToSave.replace(/(<br>)/gi, '\r\n');
	stringToSave = stringToSave.replace(/\r\n\r\n/gi, '\r\n');
    /////SETEA SI ESTAMOS EN MENOR
    if(document.getElementById('escala').checked){
	    console.log("ESTAMOS EN MENOR");
	    stringToSave = "m"+stringToSave;
    }
    
    
	console.log(stringToSave);
	mandaActualizar(stringToSave);
}

function cancelar(){
 irPagina("cancion.php?idcancion=" + idcancion + "");
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

/////////////

    </script>
</body>
</html>
