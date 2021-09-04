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

	
		$dataupd = array();


	$connection_information = array(
	'host' => DB_HOST,
	'user' => DB_USER,
	'pass' => DB_PASSWORD,
	'db' => DB_NAME
		);
		$m = new mysql($connection_information);
 
		$idevento = $_POST['idevento'];
		
		$idevento = trim($idevento);
		$idevento = mysql_real_escape_string($idevento);
		
		 
		$codigo = $_POST['codigo'];
		
		$codigo = trim($codigo);
		$codigo = mysql_real_escape_string($codigo);
		//var_dump($idevento);
		
		getcheck('preciofinal');
		getcheck('preciofinal');
		getcheck('nombrenovio');
		getcheck('nombrenovia');
		getcheck('email');
		getcheck('tel1');
		getcheck('tel2');
		getcheck('conociste');
		getcheck('enviocalle');
		getcheck('envionumero');
		getcheck('enviopiso');
		getcheck('enviolocalidad');
		getcheck('enviociudad');
		getcheck('enviocp');
		getcheck('salonnombre');
		getcheck('salonresponsable');
		getcheck('salontelefono');
		getcheck('salonweb');
		getcheck('salonemail');
		getcheck('saloncalle');
		getcheck('salonnumero');
		getcheck('salonpiso');
		getcheck('salonlocalidad');
		getcheck('salonciudad');
		getcheck('salonrequerimientos');
		getcheck('horacomienzo');
		getcheck('horafinal');
		getcheck('ubicacioncabina');
		getcheck('familiarnombre');
		getcheck('familiartel1');
		getcheck('familiartel2');
		getcheck('fotocolor');
		getcheck('fototamano');
		getcheck('fotopie');
		getcheck('fotohaydiseno');
		getcheck('fotodisenoindicaciones');
		getcheck('fotofacebook');
		getcheck('fotosaldo');
		getcheck('fotosaldoresponsable');
		getcheck('comentarios');
		getcheck('linkmapa');
		getcheck('mandamoslink');
		getcheck('mandamosdvd');
		getcheck('mandamosdvdllego');
		getcheck('mandamosrecomienden');
		getcheck('vienensacarse');
		getcheck('vienensacarsefecha');
		
		//var_dump($dataupd);
		
			?>
				<div id="header"></div>
				<div id="mainframe">
					
					
			<?php
		
		
		$result = $m->update('cdf_eventos' ,$dataupd , 'id=' . $idevento);
			if($result){
				//echo 'EVENT UPDATED <br>';
				$error=false;
				?>
				<h1> Gracias por completar tu información!</h1>
				<?php
			}
			else{
				//echo  'ERROR UPDATE DE EVENTO <br>';
				$error=true;
				?>
				<h1> Error en la actualización de tus datos. Por favor, intentalo de nuevo más tarde</h1>
				<?php
				}
				
				echo '</br> <span class="boton" onclick="irPagina(\'clientes.php?id=' . $codigo  . '\')">VOLVER</span></br>
				</br>';
		
				if($_POST['editor']){
					?>
					<script type="text/javascript">window.location = "evento.php?idevento=<?php echo $codigo; ?>"</script>
					<?php
				}
				?>
				</div>
		
</body>
		<?php
		
		function getcheck($vartocheck){
			global $dataupd;
			$checked = $_POST[$vartocheck];
			$checked = trim($checked);
			$checked = mysql_real_escape_string($checked);
			if ($checked!=null){
				$dataupd[$vartocheck]=$checked;
			}
		}
		?>