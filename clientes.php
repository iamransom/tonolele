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

	


	$connection_information = array(
	'host' => DB_HOST,
	'user' => DB_USER,
	'pass' => DB_PASSWORD,
	'db' => DB_NAME
		);
		$m = new mysql($connection_information);
 
		$idevento = $_GET['id'];

		$evento = $m->row(array(
		'table' => 'cdf_eventos',
		'condition' => 'codigo= '. '"'.$idevento.'"' ));
 
		//simple and complex query (I recommend you use the select method of the class rather than this)
	//	$fiestas = $m->query('SELECT * FROM `cdf_eventos` ORDER BY `fecha`');
		$tiposdeevento = $m -> query('SELECT * FROM `cdf_tipoeventos`');
		$tiposdeservicio = $m -> query('SELECT * FROM `cdf_tiposervicios`');

		
	
	$faltandatos = false;	
	$codigorepetido = true;
	
	//var_dump($fecha);	
	
	if(!$numeropresu || !$nombre || !$mail || !$salon || !$invitados || !$horas || !$fecha ){
		$faltandatos=true;
	}
	//	var_dump($numeropresu);
	//	var_dump($_POST);	
	//var_dump($codigoevento);
	
	
	if (!$faltandatos || !$codigorepetido){
		$data = array(
				'id' => $numeropresu,
				'codigo' => $codigoevento,
				'nombre' => $nombre,
				'fecha' => $fecha,
				'salon' => $salon,
				'tipoevento' => $tipoevento,
				'tiposervicio' => $tiposervicio,
				'horasservicio' => $horas,
				'cantidadinvitados' => $invitados,
				'email' => $mail,

				);
				$result = $m->insert('cdf_eventos',$data);
				if(result){
					$return = 'EVENTO ' . $codigoevento . ' AGREGADO'; 
					?>
						<script type="text/javascript">window.location = "lista_eventos.php"</script>
					<?php
				}
	}
	
?>

	
<div id="header">

 
</div>

	<div id="mainframe" class="datosclientes">
			<h1 class="tituloclientes"><?php echo $evento['nombre'] . ' - Planilla de Contacto'?></h1>

			<form action="clientes_carga.php" method="post" onsubmit="return false;">
			<input name="idevento" value="<?php echo $evento['id'] ?>"  type="hidden" readonly hidden></input>
			<input name="codigo" value="<?php echo $evento['codigo'] ?>"  type="hidden" readonly hidden></input>
			<p>
				Prespuesto: <strong> <?php echo ' CdF' . $evento['id'] . ' - ' . $tiposdeevento[$evento['tipoevento']-1]["cdf_tipoeventos"]['nombre']?> </strong>
			</p><p>	
				Fecha:<strong> <?php echo  date("D d-m-Y", strtotime($evento['fecha'])) ?> </strong>
			</p><p>	
				Servicio:<strong> <?php echo ' ' . $tiposdeservicio[$evento['tiposervicio']-1]["cdf_tiposervicios"]['nombre'] . '  - ' . $evento['horasservicio'] . ' horas'?> </strong>
			</p><p>	
				Lugar:<strong> <?php echo ' ' . $evento['salon'] . ' - ' . $evento['cantidadinvitados'] . ' invitados'?> </strong>
		
			</p>
	<?php if($evento['tipoevento']==1){ ?>
			
			<h4> Datos de los Novios </h4>
			
			<p>
				Nombre Completo - Novia:
				<?php preorm('nombrenovia','text',50);?>			
			</p><p>
				Nombre Completo - Novio:
				<?php preorm('nombrenovio','text',50);?>	
	<?php } ?>	
	<?php  if($evento['tipoevento']==2){ ?>
			
			<h4> Datos de la cumpleañera </h4>
			
			<p>
				Nombre Completo:
				<?php preorm('nombrenovia','text',50);?>			
			</p>
			<h4> Datos del contratante </h4>
			
			<p>
				Nombre Completo:
				<?php preorm('nombrenovio','text',50);?>		
	<?php } ?>	
			</p><p>
				Teléfono fijo:
				<?php preorm('tel1','text',15);?>
				Celular:
				<?php preorm('tel2','text',15);?>
			</p>
				<h4>Dirección Postal (Para el envío del dvd con las fotos en alta calidad):</h4>
			<p>
				Calle:
				<?php preorm('enviocalle','text',25);?>	
				Número:
				<?php preorm('envionumero','text',5);?>	
				Piso:
				<?php preorm('enviopiso','text',5);?>									
			</p><p>
				Localidad:
				<?php preorm('enviolocalidad','text');?>	
				C.P:
				<?php preorm('enviocp','text',5);?>	
			
			<h4> Datos del Evento </h4>
			<p>
				Nombre del Salón:
				<?php preorm('salonnombre','text',48);?>	
			</p><p>
				Persona responsable:
				<?php preorm('salonresponsable','text',15);?>				
				Teléfono:
				<?php preorm('salontelefono','text',15);?>
			</p><p>
				Calle:
				<?php preorm('saloncalle','text',25);?>	
				Número:
				<?php preorm('salonnumero','text',5);?>	
				Piso:
				<?php preorm('salonpiso','text',5);?>									
			</p><p>
				Barrio:
				<?php preorm('salonlocalidad','text',20);?>
				Ciudad:
				<?php preorm('salonciudad','text',20);?>		
			</p><p>
				Requerimientos especiales del salón:
				<?php preorm('salonrequerimientos','text',45);?>
			</p><p>
				Horario de comienzo del servicio:
				<?php preorm('horacomienzo','text',5);?>
				Horario de finalización del servicio:
				<?php preorm('horafinal','text',5);?><br>
				<span class="chico">El armado de la cabina se realiza una hora antes de comenzar el servicio. La elección de comenzar el servicio luego de comenzado el evento solo se recomienda para los casos donde el lugar de ubicación de la cabina, no está visible para los invitados.  Si se requiere el armado de la cabina antes de comenzado el evento y el servicio comienza horas después, tiene un costo adicional.</span>
			</p><p>
				Ubicación de la cabina en el salón:
				<?php preorm('ubicacioncabina','text',48);?>
			</p>
			
			<h4> Persona responsable a contactar día del evento (familiar/amigo/etc.) </h4>
			
			<p>
				Nombre:
				<?php preorm('familiarnombre','text',25);?>	
				Tel 1:
				<?php preorm('familiartel1','text',11);?>				
				Tel 2:
				<?php preorm('familiartel2','text',11);?>
				
			<h4> Características de las Fotos<br> Pueden ver ejemplos ya diseñados <a href=http://companiadefotos.com/ejemplos_fotos.html target="_blank"> aquí </a> </h4>
			
			
			<p>

				Color: <br>
				<input type="radio" name="fotocolor" value="C"<?php if($evento['fotocolor']=="C") echo 'checked';?>>Color <br>
				<input type="radio" name="fotocolor" value="B" <?php if($evento['fotocolor']=="B") echo 'checked';?>>Blanco y Negro
			</p><p>
				Tipo de Foto: <br>
				<input type="radio" name="fototamano" value="G"<?php if($evento['fototamano']=="G") echo 'checked';?>>10x15 cm. <span class="chico">Sale una copia por vez </span><br>
				<input type="radio" name="fototamano" value="T" <?php if($evento['fototamano']=="T") echo 'checked';?>>5x15 cm. <span class="chico">Salen 2 copias iguales por vez	</span>					</p><p>
				Datos para el “Pie de foto” (Ej: Nombres, fecha, alguna frase, etc)<br>
				<?php preormarea('fotopie');?>
			<h4> ¿Cuentan con diseño ya realizado para el pie de foto?  (Por ejemplo si van a usar el mismo diseño que las invitaciones, etc) </h4>
			
			<p>
				<input type="checkbox" name="fotohaydiseno" value="S" <?php if($evento['fotohaydiseno']=="S") echo 'checked';?>>Contamos con diseño<br>
				<span class="chico"> Si cuentan con diseño, se deben enviar archivos editables<br> a info@companiadefotos.com 
					(archivos de Illustrator o Photoshop editables y tipografías)</span>
			</p><p>
				Si no cuentan con diseño, ¿Cuáles son las indicaciones para realizar el diseño de la misma? <br>
				<?php preorm('fotodisenoindicaciones','text',80);?>	
				
			<h4> ¿Desean que subamos las fotos al Facebook de Compañía de Fotos al día siguiente del evento, para que sus invitados puedan verlas? </h4>
			
			<p>
				<input type="radio" name="fotofacebook" value="S"<?php if($evento['fotofacebook']=="S") echo 'checked';?>>SI 
				<input type="radio" name="fotofacebook" value="N" <?php if($evento['fotofacebook']=="N") echo 'checked';?>>NO <br>
			Este servicio es sin cargo y es según preferencia de los novios.<br> <span class="chico">Si desean que lo hagamos, es útil que le den “Me gusta” a nuestra página para poder etiquetar a sus invitados. <br>Link: <a href=https://www.facebook.com/companiadefotos target="_blank">facebook.com/companiadefotos </a></span>

			<h4> Modo de Pago del saldo del servicio </h4>
			
			<p>
				<input type="radio" name="fotosaldo" value="E"<?php if($evento['fotosaldo']=="E") echo 'checked';?>>En el evento 
				Persona responsable: <?php preorm('fotosaldoresponsable','text');?><br>
				<input type="radio" name="fotosaldo" value="T" <?php if($evento['fotosaldo']=="T") echo 'checked';?>>Por transferencia bancaria, antes de comenzar el evento
			<h4> ¿Algún otro comentario? </h4>
			<p>
				<?php preormarea('comentarios');?>

			</p>


			</br></br>

			<tr><td><input class="boton" value="GUARDAR DATOS" onclick="this.parentNode.submit();"> </tr>
			</form>
			
						
			
	</div>
	
	<div id="footer">
		<!--span class="boton" onclick="irPagina('index.php')">INICIO</span></br-->
	</div>
</body>


<?php

 function checkin($variablechek){
	$checked = $_POST[$variablechek];
	$checked = trim($checked);
	$checked = mysql_real_escape_string($checked);
	return $checked;
 }

 function preorm($valprefill, $type, $ancho){
 	global $evento;
	 if ($evento[$valprefill]){
		 
		 echo '<input size="'. $ancho .'" class="formulariocliente gris" type="'.$type.'" name="' . $valprefill . '"';
		 echo 'value="' . $evento[$valprefill] . '"';
		 echo ' readonly>';
	 }
	 else {
		 echo '<input size="'. $ancho .'" class="formulariocliente" type="'.$type.'" name="' . $valprefill . '"';
		 echo 'value=""';
		 echo 'autocomplete="off" >';
	 }
	 
 }
 	
 function preormarea($valprefill){
 	global $evento;
	 if ($evento[$valprefill]){
		 
		 echo '<textarea class="formulariocliente gris"  rows="4" cols="60" name="' . $valprefill . '" readonly>';
		 echo str_replace('\\r\\n', "\r\n", $evento[$valprefill]);
		 echo ' </textarea>';
	 }
	 else {
		 echo '<textarea class="formulariocliente"  rows="4" cols="60" name="' . $valprefill . '" autocomplete="off" >';
		 echo '</textarea>';
	 }
	 
 }


?>

