<?php
session_start();
require_once('appvars.php');
require_once('mysqlclass.php');
//require_once('autorizar.php');
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
 

	
	
	//var_dump($_POST);
	
	$idcancion = postcheck('idcancion');	
	$nombre = postcheck('nombre');	
	$autor = postcheck('autor');	
	$version = postcheck('version');	
	$tempo = postcheck('tempo');	
	$cifraindicadora = postcheck('cifraindicadora');	
	$link1 = postcheck('link1');	
	$tonoorig = postcheck('tonoorig');	
	$link2 = postcheck('link2');	
	$letra = postcheck('letra');	
	$tonos = postcheck('tonos');	
	$tags = postcheck('tags');	
		
	$dataupd = array();		
	
	if ($nombre) $dataupd['nombre']=$nombre;
	if ($autor) $dataupd['autor']=$autor;
	if ($version) $dataupd['version']=$version;
	if ($tempo) $dataupd['tempo']=$tempo;
	if ($cifraindicadora) $dataupd['cifraindicadora']=$cifraindicadora;
	if ($link1) $dataupd['link1']=$link1;
	if ($link2) $dataupd['link2']=$link2;
	if ($tonoorig) $dataupd['tonoorig']=$tonoorig;
	if ($letra) $dataupd['letra']=$letra;
	if ($tonos) $dataupd['tonos']=$tonos;
	if ($tags) $dataupd['tags']=$tags;
	
	//var_dump($tonos);
		
		$result = $m->update('cdb_canciones' ,$dataupd , 'id=' . $idcancion);
			if($result){
					
					echo "OK";
					?>
					<script type="text/javascript"> window.location = "cancion.php?idcancion=<?php echo $idcancion ?>"</script>			
					<?php
					}
			else{
				echo 'ERROR';
				}

		

 }
 ?>