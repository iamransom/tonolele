<?php
require_once('appvars.php');
require_once('mysqlclass.php');
//require_once('autorizar.php');
?>


<head>
	<title>CdF</title>
	<link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
	<link rel="stylesheet" type="text/css" href="estilo.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="acciones.js"></script>
</head>

<body>


<?php
session_start();
if(!check_login_status()){
?>
<script>
				window.location = "login.php";
			</script>
<?php
			echo "bad login";

}
else{
?>


	
<div id="header">

<h1>Agregar Canción</h1>

</div>

	<div id="mainframe">

			<form action="agregar_cancion_bin.php" method="post">
			<table class="cargadedatos">
			<tr><td>Nombre</td><td><input class="formulario" type="text" name="nombre"  autocomplete="off" required></td></tr>
			<tr><td>De</td><td><input class="formulario"  type="text" name="autor" autocomplete="off" ></td></tr>
			<!--tr><td>Versión</td><td><input class="formulario"  type="text" name="version" autocomplete="off"></td></tr-->
			<tr><td>Tempo</td><td><input id="tempo" width="120px" class="formulario"  type="number" name="tempo" autocomplete="off"   width="40" ><span class="botontono" onclick="taptempo()" >TAP</span></td></tr>
			<!--tr><td>Cifra Indicadora</td><td><input class="formulario"  type="number" name="cifraindicadora" autocomplete="off" ></td></tr-->
			<tr><td>Tono Original</td><td><input class="formulario"  type="text" name="tonoorig" autocomplete="off" ></td></tr>
			<tr><td>Link Youtube</td><td><input class="formulario"  type="url" name="link1" value="<?php echo $invitados; ?>" autocomplete="off" ></td></tr>
			<!--tr><td>Link2</td><td><input class="formulario"  type="url" name="link2" autocomplete="off" ></td></tr-->
			<tr><td>Tags</td><td><input class="formulario"  type="text" name="tags" autocomplete="off" ></td></tr>
			<tr><td></td><td class="comentario">
	SIMBOLOS PARA LA CARGA:<br>
	-el nombre de cada verso se incluye entre símbolos @. Por ejemplo @estrofa 1@ <br>
	</tr></td>
			<tr><td>Letra</td><td><textarea cols="40" rows="5"  class="formulario" wrap="virtual" name="letra"  autocomplete="off" required ></textarea></td></tr>
			</table>


	</div>
	
	<div id="footer">
	<input class="boton" type="submit" value="AGREGAR"> 
	<span class="boton" onclick="irPagina('lista_canciones.php')">CANCELAR CREACIÓN</span></td></tr>
			</form>
		<!--span class="boton" onclick="irPagina('index.php')">INICIO</span></br-->
	</div>
</body>

<?php
 }
 ?>

