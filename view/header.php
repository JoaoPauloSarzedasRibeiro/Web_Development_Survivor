<!DOCTYPE html>



<html>
	<head>
		<meta charset="utf-8">
		<meta name="theme-color" content="#101820">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="viewport" content="height=device-height, initial-scale=1">
		<title>Survivor da Galera</title>
		<link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="lib/owl.carousel/owl-carousel/owl.carousel.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/survivor_v8.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.1/css/all.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.1/css/v4-shims.css"


	</head>

	<body>
		
		

		<header>

			<div id="menu-mobile-mask" class="visible-xs"></div>

			<div id="menu-mobile" class="visible-xs">
				<ul class="list-unstyled">
					<li><a href="index.php">Início</a></li>
					<li><a href="regras.php">Regras</a></li>
					<li><a href="fazerpalpite.php">Fazer Palpite</a></li>
					<li><a href="editarpalpite.php">Editar Palpite</a></li>
<!-- 					<li><a href="guru.php">Responder Guru</a></li> -->
					<li><a href="historico.php">Histórico de Palpites</a></li>
					<li><a href="checkpalpite.php">Quem já palpitou?</a></li>
					<li><a href="guerreiros.php">Quem é quem?</a></li>
					<li><a href="halldafama.php">Hall da Fama</a></li>
					<li><a href="primeiroacesso.php">Alterar Senha</a></li>					
					<!-- <li><a href='bolao/index.php' style="color:#FFB612">ACESSAR BOLÃO</a></li> -->
					<li><a href='logout.php' style="color:#FFB612">Sair</a></li>

				</ul>

				<div class="bar-close">
					<button type="button" class="btn btn-close"><i class="fas fa-arrow-left"></i></button>
				</div>

			</div>



			<div class="container" id="logo">
				<a href="index.php"><img id="logotipo" src="img/logotipo2.png" alt="Logotipo" href="indexp.php"></a>
			</div>

			<div class="header-black">
				<div class="container" id="divbars">
					<button id="btn-bars" type="button"><i class="fa fa-bars"></i></button>
				</div>
				<div  class="container" id="nome-user">
					<?php
						if (isset($_SESSION['usuario'])){

							echo "<p>Olá, $_SESSION[nome]</p>";
						}else{
							echo "<a href='login.php'>Fazer Login</a>";
						}

					?>
				</div>
			</div>

			<div class="container">
				
				<div class="row">
					
					<nav id="menu" class="pull-right">
						<ul>
							<li><a href="index.php">Início</a></li>
							<li><a href="regras.php">Regras</a></li>
							<li><a href="fazerpalpite.php">Fazer Palpite</a></li>
							<li><a href="editarpalpite.php">Editar Palpite</a></li>
<!-- 							<li><a href="guru.php">Responder Guru</a></li> -->
							<li><a href="historico.php">Histórico de Palpites</a></li>
							<li><a href="checkpalpite.php">Quem já palpitou?</a></li>
							<li><a href="guerreiros.php">Quem é quem?</a></li>
							<li><a href="halldafama.php">Hall da Fama</a></li>
							<li><a href="primeiroacesso.php">Alterar Senha</a></li>					
						<!-- 	<li><a href='bolao/index.php' style="color:#FFB612">ACESSAR BOLÃO</a></li> -->
							<li><a href='logout.php' style="color:#FFB612">Sair</a></li>
						</ul>
					</nav>

				</div>

			</div>

		
		</header>