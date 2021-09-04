<?php
session_start();

require_once('appvars.php');
require_once('mysqlclass.php');
//require_once('autorizar.php');
?>
<html>


<head>
	<title>Tonolele</title>
	<link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
	<link rel="stylesheet" type="text/css" href="estilo.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="acciones.js"></script>
	
	
	<link rel="stylesheet" href="./materialdesign/material.min.css">
	<script src="./materialdesign/material.min.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

</head>

<body>
<?php
//var_dump($_SESSION);
//var_dump($_COOKIE);
if(!check_login_status()){
?>
<script>
		window.location = "lista_canciones.php";
			</script>
<?php
			echo "bad login";

}
else{
?>
<!-- Always shows a header, even in smaller screens. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title">Title</span>
      <!-- Add spacer, to align navigation to the right -->
      <div class="mdl-layout-spacer"></div>
      <!-- Navigation. We hide it in small screens. -->
      <nav class="mdl-navigation mdl-layout--large-screen-only">
        <a class="mdl-navigation__link" href="">Link</a>
        <a class="mdl-navigation__link" href="">Link</a>
        <a class="mdl-navigation__link" href="">Link</a>
        <a class="mdl-navigation__link" href="">Link</a>
      </nav>
    </div>
  </header>
  <div class="mdl-layout__drawer">
    <span class="mdl-layout-title">Title</span>
    <nav class="mdl-navigation">
      <a class="mdl-navigation__link" href="">Link</a>
      <a class="mdl-navigation__link" href="">Link</a>
      <a class="mdl-navigation__link" href="">Link</a>
      <a class="mdl-navigation__link" href="">Link</a>
    </nav>
  </div>
  <main class="mdl-layout__content">
    <div class="page-content"><!-- Your content goes here -->
 

<div id="mainframe">

<a href="lista_canciones.php"><h3>Lista de Canciones</h3></a></br>

-Buscar Canciones</br></br>

-Armar Lista</br></br>

-Cargar Canciones</br></br>


<a href="logout.php">LOGOUT</a>
</div>
 </main>
</div>
</body>
</html>

<?php
 }
 ?>