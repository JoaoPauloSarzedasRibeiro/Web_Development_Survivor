<?php 
	

	include("conexao/conexao.php");

	// carregando lista de usuarios
	$sql_code_listauser = "SELECT user_nome, user_id, user_vida FROM tuser ORDER BY user_id";
	$sql_query_listauser = $mysqli->query($sql_code_listauser) or die ($mysqli->error);

	// carregando rodada atual
	$sql_code_rodadaatual = "SELECT rodadaatual FROM trodadaatual LIMIT 1";
	$sql_query_rodadaatual = $mysqli->query($sql_code_rodadaatual) or die($mysqli->error);
	$rodadaatual = $sql_query_rodadaatual->fetch_assoc();


	while ($listauser = $sql_query_listauser->fetch_array()){

		//procurando a rodada atual-1 na lista de palpites
		$sql_code_checkPalpite = "SELECT COUNT(palpite_time) AS contagemPalpite FROM tpalpite WHERE palpite_userid='$listauser[user_id]' AND palpite_rodada= '$rodadaatual[rodadaatual]'-1";
		$sql_query_checkPalpite = $mysqli->query($sql_code_checkPalpite) or die ($mysqli->error);
		$contagem = $sql_query_checkPalpite->fetch_assoc();

		if ($contagem['contagemPalpite'] == 0 AND $listauser['user_vida']>0) {

			$data = date('Y-m-d H:i:s');

			$sql_code = "INSERT INTO tpalpite (
				palpite_user,
				palpite_userid,
				palpite_rodada,
				palpite_time,
				palpite_data,
				palpite_resultado)
				VALUES(
				'$listauser[user_nome]',
				'$listauser[user_id]',
				'$rodadaatual[rodadaatual]'-1,
				'Sem Palpite',
				'$data',
				'Derrota')";
			$confirma = $mysqli->query($sql_code) or die($mysqli->error);

		}

	}
	
	echo "<script> alert('Sucesso!');
	location.href='adminadminadmin.php';</script>";	

?>