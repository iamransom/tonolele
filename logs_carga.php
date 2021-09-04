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
		
		getcheck('log');
		getcheck('tipolog');
		getcheck('evento');
		getcheck('proveedor');
		getcheck('ayudante');
		getcheck('usuario');


				//var_dump($dataupd);
		
			?>
				<div id="header"></div>
				<div id="mainframe">
					
					
			<?php
		
		
				$result = $m->insert('cdf_logs',$dataupd);
			if($result){
				//echo 'EVENT UPDATED <br>';
				$error=false;
				?>
				<?php
			}
			else{
				//echo  'ERROR UPDATE DE EVENTO <br>';
				$error=true;
				?>
				<h1> Error en la actualización de tus datos. Por favor, intentalo de nuevo más tarder</h1>
				<?php
				}
		
				if($codigo){
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