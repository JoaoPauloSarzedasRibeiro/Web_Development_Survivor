<?php 

	if(!isset($_SESSION))
		session_start();

	include_once("view/header.php");
	include("conexao/conexao.php");



	// carregando a tabela de usuarios
	$sql_code_users = "SELECT
					    user_nome
					FROM tuser
					WHERE
						user_vida>0
					ORDER BY
					    user_nome ASC";
	$sql_query_users = $mysqli->query($sql_code_users) or die($mysqli->error);
	

	// pegando contagem de usuarios
	$sql_code_users2 = "SELECT
					    user_nome,
					    COUNT(user_id) AS cont_users2
					FROM tuser
					WHERE
						user_vida>0
					ORDER BY
					    user_nome ASC";
	$sql_query_users2 = $mysqli->query($sql_code_users2) or die($mysqli->error);
	$cont_users2 = $sql_query_users2->fetch_assoc();
	



	// adicionando o campo rodada
	$sql_code_rodada = "SELECT rodadaatual FROM trodadaatual LIMIT 1";
	$sql_query_rodada = $mysqli->query($sql_code_rodada) or die($mysqli->error);
	$rodadaatual = $sql_query_rodada->fetch_assoc();

	// pegando contagem de palpites da rodada atual
	$sql_code_contpalpite = "SELECT COUNT(palpite_time) AS cont_palp FROM tpalpite WHERE palpite_rodada=$rodadaatual[rodadaatual]";
	$sql_query_contpalpite = $mysqli->query($sql_code_contpalpite) or die ($mysqli->error);
	$cont_palp = $sql_query_contpalpite->fetch_assoc();

		// carregando datas de jogos
	$sql_code_datajogos2 = "SELECT confronto_data, confronto_diasem, confronto_hora, Count(confronto_data) from tconfrontos where confronto_rodada = '$rodadaatual[rodadaatual]' group by confronto_data having Count(confronto_data)>1";
	$sql_query_datajogos2 = $mysqli->query($sql_code_datajogos2) or die ($mysqli->error);

	$data_encerra = $sql_query_datajogos2->fetch_assoc();


?>


<section>
	


	<div id="sucessoLogin" class="erro container">
		<div class="text-center">
			<?php 

				if(isset($sucessoLogin) > 0)
				foreach ($sucessoLogin as $msg) {
					echo "<p>$msg</p>";
				}

			?>
		</div>
	</div>

	<div id="iniciorodada">
		
		<div class="container" id="inicio-rodada">
			<div class="row">
				<div class="col-md-12">
					<h1>Quem já palpitou?</h1>
<!-- 					<p><?php echo $data_encerra['confronto_diasem']; ?>, <?php echo $data_encerra['confronto_data']; ?></p> -->
				</div>
			</div>
		</div>

	</div>


	<div id="checkpalpite" class="container">

		<div class="row text-center">
			<h2>Palpites feitos: <?php echo $cont_palp['cont_palp']; ?>/<?php echo $cont_users2['cont_users2']; ?></h2>
			<hr>
		</div>
		
		<div class="tabclassificacao">
			<table id="tab-classificacao" class="table table-bordered">
				<thead>
					<tr>
						<th class="text-center">Rodada</th>
						<th class="text-center">Guerreiro(a)</th>
						<th class="text-center">Palpite?</th>
<!-- 						<th class="text-center">Guru?</th> -->
					</tr>
				</thead>
				<tbody>
					<?php while ($usuarios = $sql_query_users->fetch_array()) {

						// checndo se tem palpite pro user na rodada
						$sql_code_contpalpites = "SELECT palpite_id as contpalpites from tpalpite
						where
						palpite_user='$usuarios[user_nome]'
						and
						palpite_rodada='$rodadaatual[rodadaatual]'";
						$sql_query_contpalpites = $mysqli->query($sql_code_contpalpites) or die ($mysqli->error);
						$contpalpites = $sql_query_contpalpites->num_rows;


		
					// pegando contagem de respostas
					$sql_code_resp = "SELECT
									    COUNT(resposta_id) AS cont
									FROM tguru_respostas
									WHERE
										resposta_user='$usuarios[user_nome]'
									AND
										resposta_rodada='$rodadaatual[rodadaatual]'";
					$sql_query_resp = $mysqli->query($sql_code_resp) or die($mysqli->error);
					$cont_resp = $sql_query_resp->fetch_assoc();

						?>
	                   <tr>
	                   		<td class="text-center negrito"><?php echo $rodadaatual['rodadaatual'];?></td>
		                   <td class="text-center negrito"><?php echo $usuarios['user_nome'];?></td>
							
							<?php if($contpalpites == 0) {

								echo "<td class='text-center negrito' style='color:#e90052'>✘</td>";
							}else{
								echo "<td class='text-center negrito' style='color:#69BE28'>✔</td>";
							}
		                   	?>
							
<!-- 							<?php if($cont_resp['cont']==0) {

								echo "<td class='text-center negrito' style='color:#e90052'>✘</td>";
							}else{
								echo "<td class='text-center negrito' style='color:#69BE28'>✔</i></td>";
							}
		                   	?> -->

	                   </tr>

             		 <?php  } ?>

				</tbody>

			</table>
	</div>



</section>

	<script>
     	window.onload = function(){
     		$('#sucessoLogin').fadeOut(5000);
     } 
	</script>


<?php include_once("view/footer.php"); ?>