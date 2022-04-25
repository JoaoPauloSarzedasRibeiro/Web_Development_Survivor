<?php 

include("conexao/conexao.php");

	// carregando lista de usuarios
	$sql_code_listauser = "SELECT user_nome, user_id FROM tuser ORDER BY user_id";
	$sql_query_listauser = $mysqli->query($sql_code_listauser) or die ($mysqli->error);


	while ($listauser = $sql_query_listauser->fetch_array()){

		//contando vitorias
		$sql_code_contagem = "SELECT COUNT(palpite_resultado) AS vitoria FROM tpalpite WHERE palpite_userid='$listauser[user_id]' AND palpite_resultado='Vitória'";
		$sql_query_contagem = $mysqli->query($sql_code_contagem) or die ($mysqli->error);
		$vitoria = $sql_query_contagem->fetch_assoc();

		//contando fora
		$sql_code_contagem2 = "SELECT COUNT(palpite_fora) AS fora FROM tpalpite WHERE palpite_userid='$listauser[user_id]' AND palpite_fora='S'";
		$sql_query_contagem2 = $mysqli->query($sql_code_contagem2) or die ($mysqli->error);
		$fora = $sql_query_contagem2->fetch_assoc();

		//contando Derrota
		$sql_code_contagem3 = "SELECT COUNT(palpite_resultado) AS derrota FROM tpalpite WHERE palpite_userid='$listauser[user_id]' AND palpite_resultado='Derrota'";
		$sql_query_contagem3 = $mysqli->query($sql_code_contagem3) or die ($mysqli->error);
		$derrota = $sql_query_contagem3->fetch_assoc();

		//contando Empate
		$sql_code_contagem4 = "SELECT COUNT(palpite_resultado) AS empate FROM tpalpite WHERE palpite_userid='$listauser[user_id]' AND palpite_resultado='Empate'";
		$sql_query_contagem4 = $mysqli->query($sql_code_contagem4) or die ($mysqli->error);
		$empate = $sql_query_contagem4->fetch_assoc();

		//contando gurus
		$sql_code_contagem5 = "SELECT COUNT(resposta_certo) AS guru FROM  tguru_respostas WHERE resposta_user='$listauser[user_nome]' AND resposta_certo=1";
		$sql_query_contagem5 = $mysqli->query($sql_code_contagem5) or die ($mysqli->error);
		$guru= $sql_query_contagem5->fetch_assoc();

		$jogos = intval(intval($derrota['derrota'])+intval($vitoria['vitoria'])+intval($empate['empate']));

		//alterando na tabela de usuarios
		$sql_code_alter = "UPDATE tuser SET
								user_vida=5-'$derrota[derrota]',
								user_vitoria='$vitoria[vitoria]',
								user_derrota='$derrota[derrota]',
								user_empate='$empate[empate]',
								user_fora='$fora[fora]',
								user_guru='$guru[guru]',
								user_jogos='$jogos'
							WHERE
								user_id='$listauser[user_id]'";
		$sql_query_alter = $mysqli->query($sql_code_alter) or die ($mysqli->error);

	}
	
	echo "<script> alert('Sucesso!');
	location.href='adminadminadmin.php';</script>";	

?>