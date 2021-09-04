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

<?php

	$connection_information = array(
	'host' => DB_HOST,
	'user' => DB_USER,
	'pass' => DB_PASSWORD,
	'db' => DB_NAME
		);
		$m = new mysql($connection_information);
 

 

		
	$faltandatos = false;	
	$codigorepetido = true;
		
	$nombre = postcheck('nombre');	
	$autor = postcheck('autor');	
	$version = postcheck('version');	
	$tempo = postcheck('tempo');	
	$cifraindicadora = postcheck('cifraindicadora');	
	$link1 = postcheck('link1');	
	$link2 = postcheck('link2');	
	$tonoorig = postcheck('tonoorig');	
	$letra = postcheck('letra');	
	$tonos = postcheck('tonos');	
	$tags = postcheck('tags');	
		

	if (!$faltandatos || !$codigorepetido){
		$data = array(
				'nombre' => $nombre,
				'autor' => $autor,
				'version' => $version,
				'tempo' => $tempo,
				'cifraindicadora' => $cifraindicadora,
				'link1' => $link1,
				'link2' => $link2,
				'tonoorig' => $tonoorig,
				'letra' => $letra,
				'tags' => $tags,
				'tonos' => $tonos,	
				);
				$result = $m->insert('cdb_canciones',$data);
				if($result){
					$return = 'EVENTO AGREGADO'; 
					?>
						<script type="text/javascript">window.location = "lista_canciones.php"</script>
					<?php
				}
				else{
					echo 'ERROR EN CARGA';
					var_dump($data);
					
				}
	}
	
?>

<?php
 }
 ?>

