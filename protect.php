<?php
 

	if(!function_exists("protect")){
		function protect(){

			if(!isset($_SESSION))
				session_start();

			if((!isset($_SESSION['usuario'])) || !is_numeric($_SESSION['usuario'])){

				header("Location: login.php?codigo=1");
			}
		}
	}

	if(!function_exists("protect2")){
		function protect2(){

			if(!isset($_SESSION))
				session_start();

			if((!isset($_SESSION['usuario'])) || !is_numeric($_SESSION['usuario'])){

				header("Location: login.php?codigo=2");
			}
		}
	}

	if(!function_exists("protect3")){
		function protect3(){

			if(!isset($_SESSION))
				session_start();

			if((!isset($_SESSION['usuario'])) || !is_numeric($_SESSION['usuario'])){

				header("Location: login.php?codigo=3");
			}
		}
	}

	if(!function_exists("protect4")){
		function protect4(){

			if(!isset($_SESSION))
				session_start();

			if((!isset($_SESSION['usuario'])) || !is_numeric($_SESSION['usuario'])){

				header("Location: login.php?codigo=11");
			}
		}
	}

	if(!function_exists("protect5")){
		function protect5(){

			if(!isset($_SESSION))
				session_start();

			if((!isset($_SESSION['usuario'])) || !is_numeric($_SESSION['usuario'])){

				header("Location: login.php?codigo=100");
			}
		}
	}

?>