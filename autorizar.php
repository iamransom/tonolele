<?php
////Usuario y Contraseña
$username = 'iamranso_presbi';
$password = '123qaz';

if(!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) || ($_SERVER['PHP_AUTH_USER']) != $username || ($_SERVER['PHP_AUTH_PW'] != $password)){
	header('HTTP/1.1 401 Unauthorized');
	header('WWW-Authenticate: Basic realm="Mismatch"');
	exit('<h3>SPORTS BARKER</h3>Sorry, you must enter your username and password to log in and access this page.');
}

?>