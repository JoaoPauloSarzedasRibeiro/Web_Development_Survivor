<?php

	session_start();
	unset($_SESSION['usuario']);
	unset($_SESSION['nome']);
	echo "<script>location.href='index.php';</script>";
	
?>