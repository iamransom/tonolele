<?php
require_once('appvars.php');
require_once('mysqlclass.php');
//require_once('autorizar.php');
?>


<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


	<title>Todas las Canciones</title>
	<link rel="icon" href="img/favicon.ico" type="image/x-icon" />

	<link rel="stylesheet" type="text/css" href="estilo.css">
	<script type="text/javascript" src="acciones.js"></script>

	<link rel="stylesheet" href="./materialdesign/material.min.css">
	<script src="./materialdesign/material.min.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="./materialdesign/styles.css">
	<style>
		#view-source {
			position: fixed;
			display: block;
			right: 0;
			bottom: 0;
			margin-right: 40px;
			margin-bottom: 40px;
			z-index: 900;
		}
	</style>
</head>

<body>
    <?php include_once("analyticstracking.php") ?>


<?php
session_start();

	$connection_information = array(
	'host' => DB_HOST,
	'user' => DB_USER,
	'pass' => DB_PASSWORD,
	'db' => DB_NAME
		);
		$m = new mysql($connection_information);

	$buscar = getcheck('querry');

 //   var_dump($buscar);

		//simple and complex query (I recommend you use the select method of the class rather than this)
		$canciones = $m->query("SELECT id, nombre, autor, letra, version FROM `cdb_canciones` WHERE letra LIKE '%$buscar%' OR tags LIKE '%$buscar%'");


		//var_dump($canciones);


?>

					<body class="mdl-demo mdl-color--grey-100 mdl-color-text--grey-700 mdl-base">
						<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
							<header class="mdl-layout__header">
								<div class="mdl-layout__header-row">
									<!-- Title -->
									<img src="img/flecha-blanca.png" alt="LAGRAM" height="42" width="42">
									<span class="mdl-layout-title">Tonolele</span>
									<!-- Add spacer, to align navigation to the right -->
									<div class="mdl-layout-spacer"></div>
									<!-- Navigation. We hide it in small screens. -->
									<nav class="mdl-navigation mdl-layout--large-screen-only">
										<a class="mdl-navigation__link" onclick="irPagina('lista_canciones.php')">TODAS LAS CANCIONES</a>
										<?php
		if(check_login_status()){
		?>
											<a class="mdl-navigation__link" onclick="irPagina('agregar_cancion.php')">AGREGAR CANCIÓN</a>
											<a class="mdl-navigation__link" onclick="irPagina('logout.php')">LOGOUT</a>
											<?php }
		if(!check_login_status()) {
	   ?>
												<a class="mdl-navigation__link" onclick="irPagina('login.php')">LOGIN</a>
												<?php } ?>
									</nav>
								</div>
							</header>
							<div class="mdl-layout__drawer">
								<span class="mdl-layout-title">Tonolele</span>
								<nav class="mdl-navigation">
									<a class="mdl-navigation__link" onclick="irPagina('lista_canciones.php')">TODAS LAS CANCIONES</a>

									<?php
		if(check_login_status()){
		?>
										<a class="mdl-navigation__link" onclick="irPagina('agregar_cancion.php')">AGREGAR CANCIÓN</a>
										<a class="mdl-navigation__link" onclick="irPagina('logout.php')">LOGOUT</a>
										<?php }
		if(!check_login_status()) {
	   ?>
											<a class="mdl-navigation__link" onclick="irPagina('login.php')">LOGIN</a>
											<?php } ?>
								</nav>
							</div>
							<!--
<div class="mdl-layout__tab-bar mdl-js-ripple-effect mdl-color--primary-dark">

	<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored mdl-shadow--4dp mdl-color--accent" id="add">
		<i class="material-icons" role="presentation">add</i>
		<span class="visuallyhidden">Add</span>
	</button>
</div>
-->
							<main class="mdl-layout__content">
								<div class="mdl-layout__tab-panel is-active" id="overview">


									<section class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp">
										<div class="mdl-card mdl-cell mdl-cell--12-col">
											<div class="mdl-card__supporting-text mdl-grid mdl-grid--no-spacing">
												<h4 class="mdl-cell mdl-cell--12-col">Todas las canciones</h4>

												<table class="mdl-cell mdl-cell--12-col mdl-data-table mdl-js-data-table mdl-shadow--2dp">
													<thead>
														<tr>
															<th class="mdl-data-table__cell--non-numeric">
																<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-1">
																	<input type="checkbox" id="checkbox-1" class="mdl-checkbox__input" onchange="checkAll(this)" >
																</label>
															</th>
															<th class="mdl-data-table__cell--non-numeric">Título</th>
															<th class="mdl-data-table__cell--non-numeric">De</th>

														</tr>
													</thead>
													<tbody>
														<?php
				foreach ($canciones as $cancion){
					//var_dump($fiesta);
					//$codigoevento = $fiesta['cdf_eventos']['id'] . '_' . date("Ymd", strtotime($fiesta['cdf_eventos']['fecha']));
					echo '<tr id="'.$cancion['cdb_canciones']['id'] .'">' .
						'<td><label for="chk'.$cancion['cdb_canciones']['id'] .'" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" >
						<input type="checkbox" name="sel[]"  id="chk'.$cancion['cdb_canciones']['id'] .'" class="mdl-checkbox__input">
					</label></td>'.
					'<td class="mdl-data-table__cell--non-numeric" onclick="irPagina(\'cancion.php?idcancion=' . $cancion['cdb_canciones']['id'] . '\')";>'. $cancion['cdb_canciones']['nombre'] . '</td>' .
					'<td class="mdl-data-table__cell--non-numeric" onclick="irPagina(\'cancion.php?idcancion=' . $cancion['cdb_canciones']['id'] . '\')";>' . $cancion['cdb_canciones']['autor'] . '</td>' .
					'<!--td onclick="irPagina(\'cancion.php?idcancion=' . $cancion['cdb_canciones']['id'] . '\')";>' . $cancion['cdb_canciones']['tags'] . '</td-->';

//		if(check_login_status()){
//					echo'<td class="checkbox">' . ' <input type="checkbox" name="sel[]" value="'.$cancion['cdb_canciones']['id'].'">' . '</td>' ;}
				}
					echo	'</tr>';
//				}
				?>


													</tbody>
												</table>
												
											</div>

										</div>
										<button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="btn2">
											<i class="material-icons">more_vert</i>
										</button>
										<ul class="mdl-menu mdl-js-menu mdl-menu--bottom-right" for="btn2">
											<li class="mdl-menu__item" onclick="bajarTXTs()">Descargar letras en texto a TXT</li>
											<li class="mdl-menu__item" disabled>Descargar funciones a TXT</li>
											<li class="mdl-menu__item" disabled>Descargar tonos en tonalidad original a TXT</li>
											<li class="mdl-menu__item" disabled>Descargar funciones a PDF</li>
											<li class="mdl-menu__item" disabled>Descargar tonos en tonalidad original a PDF</li>
										</ul>
									</section>

									<section class="section--footer mdl-color--white mdl-grid">
										<div class="section__circle-container mdl-cell mdl-cell--2-col mdl-cell--1-col-phone">
										</div>
										<div class="section__circle-container mdl-cell mdl-cell--2-col mdl-cell--1-col-phone">
											<img src="img/lagram-LQ.png" height="100">
											<!--<div class="section__circle-container__circle mdl-color--accent section__circle--big"></div>-->
										</div>
										<div class="section__text mdl-cell mdl-cell--4-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
											Tonolele es un proyecto de LAGRAM para ayudarte a tocar canciones de alabanza. Podés usarlo en tu casa, en la iglesia o en donde quieras. Está todavía en desarrollo así que puede haber errores. Si tenés alguna idea o querés ayudarnos a mejorarlo, escribinos a info@lagram.com.ar o buscanos en Facebook </div>
										<div class="section__circle-container mdl-cell mdl-cell--2-col mdl-cell--1-col-phone">
										</div>
									</section>
								</div>
								<footer class="mdl-mega-footer">

									<div class="mdl-mega-footer--bottom-section">

										<div class="mdl-logo">
											LAGRAM - 2017
										</div>

										<ul class="mdl-mega-footer--link-list">
											<li><a href="http://www.lagram.com.ar/">lagram.com.ar</a></li>
											<li><a href="http://www.facebook.com/lagramoficial">facebook</a></li>
											<li><a href="http://www.instagram.com/lagramoficial">instagram</a></li>
											<li><a href="http://www.twitter.com/lagramoficial">twitter</a></li>


										</ul>
									</div>
								</footer>
							</main>
						</div>
						<!--<a href="https://github.com/google/material-design-lite/blob/mdl-1.x/templates/text-only/" target="_blank" id="view-source" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast">View Source</a>-->
						<script src="./materialdesign/material.min.js"></script>
					</body>

	</html>
