<?php 
	include("conexao/conexao.php");

	if(!isset($_GET['usuario']) || !isset($_GET['rodada']) || !isset($_GET['time'])){
		echo "<script>alert('Eita, Guerreiro! Aconteceu um erro, tente novamente!'); location.href='editarpalpite.php'; </script>";
	}

	$usuario = $_GET['usuario'];
	$rodada = $_GET['rodada'];
	$time = $_GET['time'];
	

	// Inserção no Banco e redirecionamento
		if (!isset($erro)) {

			//deletando o palpite antigo
			$sql_code = "DELETE FROM tpalpite WHERE palpite_user='$_GET[usuario]' AND palpite_rodada='$_GET[rodada]' AND palpite_time='$_GET[time]'";
			$confirma = $mysqli->query($sql_code) or die ($mysqli->error);

			// colocando o time antigo de volta pra disponivel
			$sql_code2 = "INSERT INTO ttimesdisp (disp_nome, disp_time)
			VALUES(
		  	'$_GET[usuario]',
			'$_GET[time]')";
			$confirma2 = $mysqli->query($sql_code2) or die($mysqli->error);

			if($confirma && $confirma2){
				echo "<script> location.href='editarpalpite.php?codigo=3'</script>";
			}else{
				$erro[]=$confirma;
			}

		}

?>