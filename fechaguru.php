<?php 

include("conexao/conexao.php");

	// carregando o status atual
	$sql_code_rodadaatual = "SELECT rodada_guru FROM trodadaatual";
	$sql_query_rodadaatual = $mysqli->query($sql_code_rodadaatual) or die ($mysqli->error);
	$rodada_aberta = $sql_query_rodadaatual->fetch_assoc();

	if ($rodada_aberta['rodada_guru']==0) {

				//alterando na tabela
		$sql_code_alter = "UPDATE trodadaatual SET
								rodada_guru=1
							WHERE
								rodadaatual_id=1";
		$sql_query_alter = $mysqli->query($sql_code_alter) or die ($mysqli->error);
	}elseif ($rodada_aberta['rodada_guru']==1) {

				//alterando na tabela
		$sql_code_alter = "UPDATE trodadaatual SET
								rodada_guru=0
							WHERE
								rodadaatual_id=1";
		$sql_query_alter = $mysqli->query($sql_code_alter) or die ($mysqli->error);

	}
	
	echo "<script> alert('Sucesso!');
	location.href='guru.php';</script>";	

?>