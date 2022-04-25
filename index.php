<?php 

 if (!isset($_SESSION))
			session_start();

	include_once("view/header.php");
	include("conexao/conexao.php");


	//sucesso trocar senha
	if(isset($_GET['codigo'])){
		if ($_GET['codigo']==1) {
			$sucessoLogin[] = "Sucesso! Aproveite o jogo, $_SESSION[nome]!";
		}
	}
	//sucesso guru
	if(isset($_GET['codigo'])){
		if ($_GET['codigo']==10) {
			$sucessoLogin[] = "Sucesso! Previsão enviada com sucesso!";
		}
	}
	//sucesso guru
	if(isset($_GET['codigo'])){
		if ($_GET['codigo']==11) {
			$sucessoLogin[] = "Sucesso! Previsão editada com sucesso!";
		}
	}

	// carregando a tabela de classificação
	$sql_code_class = "SELECT
					    user_nome,
					    user_jogos,
						user_vida,
						user_vitoria,
						user_empate,
						user_derrota,
						user_2019_1,
						user_2019_2,
						user_2018_2,
						user_2017_2,
						user_copa_2019,
						user_guru,
						user_fora, 
						IF(user_vida=@vida AND user_vitoria=@vitoria AND user_empate=@empate AND user_derrota=@derrota AND user_fora=@fora,@curRank:=@curRank,@curRank:=@_sequence) AS rank,
              				@_sequence:=@_sequence+1,@vida:=user_vida,@vitoria:=user_vitoria,@empate:=user_empate,@derrota:=user_derrota,@fora:=user_fora
    				FROM      tuser p, (SELECT @curRank := 1, @_sequence:=1, @vida:=-1, @vitoria:=-1,@empate:=-1,@derrota:=-1,@fora:=-1) r
					ORDER BY
						user_vida DESC,
					    user_vitoria DESC,
					  	user_fora DESC,
					    user_empate DESC,
					    user_guru DESC,
					    user_nome ASC
					LIMIT 5";
	$sql_query_class = $mysqli->query($sql_code_class) or die($mysqli->error);



	// adicionando o numero de participantes
	$sql_code_num = "SELECT COUNT(user_nome) AS number_users FROM tuser";
	$sql_query_num = $mysqli->query($sql_code_num) or die ($mysqli->error);
	$number_users = $sql_query_num->fetch_assoc();

	// adicionando o campo rodada
	$sql_code_rodada = "SELECT * FROM trodadaatual LIMIT 1";
	$sql_query_rodada = $mysqli->query($sql_code_rodada) or die($mysqli->error);
	$rodadaatual = $sql_query_rodada->fetch_assoc();

	// carregando datas de jogos
	$sql_code_datajogos = "SELECT confronto_data, confronto_diasem, confronto_hora, Count(confronto_data) from tconfrontos where confronto_rodada = '$rodadaatual[rodadaatual]' group by confronto_data having Count(confronto_data)>=1";
	$sql_query_datajogos = $mysqli->query($sql_code_datajogos) or die ($mysqli->error);


	// carregando datas de jogos rodada -1
	$rodada=$rodadaatual['rodadaatual']-1;
	$sql_code_datajogos3 = "SELECT confronto_data, confronto_diasem, confronto_hora, Count(confronto_data) from tconfrontos where confronto_rodada = '$rodada' group by confronto_data having Count(confronto_data)>=1";
	$sql_query_datajogos3 = $mysqli->query($sql_code_datajogos3) or die ($mysqli->error);

		// carregando datas de jogos
	$sql_code_datajogos2 = "SELECT confronto_data, confronto_diasem, confronto_hora from tconfrontos where confronto_rodada = '$rodadaatual[rodadaatual]' ORDER BY confronto_data ASC, confronto_hora ASC";
	$sql_query_datajogos2 = $mysqli->query($sql_code_datajogos2) or die ($mysqli->error);

	$data_encerra = $sql_query_datajogos2->fetch_assoc();


?>


<section>

<body style="background-color: #eee;">

<!-- 	<div id="iniciorodada">
		
		<div class="container" id="inicio-rodada">
			<div class="row">
				<div class="col-md-12">
					<h1>Início da próxima rodada - Rodada <?php echo $rodadaatual['rodadaatual']; ?></h1>
					<p><?php echo $data_encerra['confronto_diasem']; ?>, <?php echo $data_encerra['confronto_data']; ?>    às    <?php echo $data_encerra['confronto_hora']; ?>h</p>
				</div>
			</div>
		</div>

	</div> -->

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




	<div id="classificacao" class="container">
		
		<div class="row text-center">
			<h2>Classificação</h2>
<!-- 			<hr> -->
		</div>

		<div class="tabclassificacao">
			<table id="tab-classificacao" class="table table-bordered">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">Guerreiro(a)</th>
						<th class="text-center"><i class="fas fa-heartbeat"></i></th>
						<th class="text-center">V</th>
						<th class="text-center">E</th>
						<th class="text-center">D</th>
						<th class="text-center">F</th>
<!-- 						<th class="text-center"><i class="fas fa-star"></i></th> -->
						<th class="text-center">J</th>
						<th class="text-center">últimos</i></i></th>
					</tr>
				</thead>
				<tbody>
					<?php while ($classificacao = $sql_query_class->fetch_array()) {?>
	                   <tr>
	                   		<td class="text-center negrito" <?php 

		                   if($classificacao['user_vida']==0){
		                   		echo "style='color:#7f8fa6'";
		                   } ?>

		                   >

		                   		                   	<?php if($classificacao['rank']==1 AND $rodadaatual['rodadaatual']>1){ ?>
		                   	<i  id="trofeu1" class="fas fa-crown text-center" aria-hidden="true"></i>
		                   	<?php }elseif($classificacao['rank']==2){?>
		                   	<i  id="trofeu2" class="fas fa-medal text-center" aria-hidden="true"></i>
		                   	<?php }elseif($classificacao['rank']==3){?>
		                   	<i  id="trofeu3" class="fas fa-medal text-center" aria-hidden="true"></i>
		                   	<?php }elseif($classificacao['user_vida']==0){ ?>
		                   	<i  id="trofeu4" class="fas fa-skull-crossbones text-center" aria-hidden="true"></i>

		                   <?php

		                   	}else{
		                   		 echo "$classificacao[rank]º";
		                   	} ?>

		                   </td>

		                   <td class="text-center negrito"><a style="color: #101820;" href="historicouser.php?usuario=<?php echo $classificacao['user_nome'];?>" class="link-tabela" <?php 

		                   if($classificacao['user_vida']==0){
		                   		echo "style='color:#7f8fa6'";
		                   } ?>

		                   >
		                   	<?php echo $classificacao['user_nome'];?></a>

		                   	<!-- <?php if($classificacao['user_2019_1']==1){
		                   		echo "  <img src='img/ouro.png' style='width:15px;height:20px;'>";
		                   	} ?>
		                   	<?php if($classificacao['user_2019_1']==2){
		                   		echo "  <img src='img/prata.png' style='width:15px;height:20px;'>";
		                   	} ?>
		                   	<?php if($classificacao['user_2019_1']==3){
		                   		echo "  <img src='img/bronze.png' style='width:15px;height:20px;'>";
		                   	} ?>

		                   	<?php if($classificacao['user_2019_2']==1){
		                   		echo "  <img src='img/ouro.png' style='width:15px;height:20px;'>";
		                   	} ?>
		                   	<?php if($classificacao['user_2019_2']==2){
		                   		echo "  <img src='img/prata.png' style='width:15px;height:20px;'>";
		                   	} ?>
		                   	<?php if($classificacao['user_2019_2']==3){
		                   		echo "  <img src='img/bronze.png' style='width:15px;height:20px;'>";
		                   	} ?>

		                   	<?php if($classificacao['user_2018_2']==1){
		                   		echo "  <img src='img/ouro2.png' style='width:15px;height:20px;'>";
		                   	} ?>
		                   	<?php if($classificacao['user_2018_2']==2){
		                   		echo "  <img src='img/prata2.png' style='width:15px;height:20px;'>";
		                   	} ?>
		                   	<?php if($classificacao['user_2018_2']==3){
		                   		echo "  <img src='img/bronze2.png' style='width:15px;height:20px;'>";
		                   	} ?>

		                   	<?php if($classificacao['user_2017_2']==1){
		                   		echo "  <img src='img/ouro3.png' style='width:15px;height:20px;'>";
		                   	} ?>
		                   	<?php if($classificacao['user_2017_2']==2){
		                   		echo "  <img src='img/prata3.png' style='width:15px;height:20px;'>";
		                   	} ?>
		                   	<?php if($classificacao['user_2017_2']==3){
		                   		echo "  <img src='img/bronze3.png' style='width:15px;height:20px;'>";
		                   	} ?>

		                   	<?php if($classificacao['user_copa_2019']==1){
		                   		echo "  <img src='img/copa1.png' style='width:15px;height:20px;'>";
		                   	} ?>
		                   	<?php if($classificacao['user_copa_2019']==2){
		                   		echo "  <img src='img/copa2.png' style='width:15px;height:20px;'>";
		                   	} ?>
		                   	<?php if($classificacao['user_copa_2019']==3){
		                   		echo "  <img src='img/copa3.png' style='width:15px;height:20px;'>";
		                   	} ?> -->

		                   </td>
		                   <td class="text-center negrito" <?php 

		                   if($classificacao['user_vida']==0){
		                   		echo "style='color:#7f8fa6'";
		                   } ?>

		                   ><?php echo $classificacao['user_vida'];?></td>
		                   <td class="text-center" <?php 

		                   if($classificacao['user_vida']==0){
		                   		echo "style='color:#7f8fa6'";
		                   } ?>

		                   ><?php echo $classificacao['user_vitoria'];?></td>
		                   <td class="text-center" <?php 

		                   if($classificacao['user_vida']==0){
		                   		echo "style='color:#7f8fa6'";
		                   } ?>

		                   ><?php echo $classificacao['user_empate'];?></td>
		                   <td class="text-center" <?php 

		                   if($classificacao['user_vida']==0){
		                   		echo "style='color:#7f8fa6'";
		                   }elseif($classificacao['user_derrota']>0){
		                   		echo "style='color:#e90052'";
		                   }
		                    ?>

		                   ><?php echo $classificacao['user_derrota'];?></td>
		                   <td class="text-center" <?php 

		                   if($classificacao['user_vida']==0){
		                   		echo "style='color:#7f8fa6'";
		                   } ?>

		                   ><?php echo $classificacao['user_fora'];?></td>
<!-- 		                   <td class="text-center" <?php 

		                   if($classificacao['user_vida']==0){
		                   		echo "style='color:#7f8fa6'";
		                   } ?>

		                   ><?php echo $classificacao['user_guru'];?></td> -->
		                   <td class="text-center" <?php 

		                   if($classificacao['user_vida']==0){
		                   		echo "style='color:#7f8fa6'";
		                   } ?>

		                   ><?php echo $classificacao['user_jogos'];?></td>




							<td class="text-center"> <?php 

								// carregando lista dos resultados
								$sql_code_hist = "SELECT palpite_resultado FROM tpalpite
								WHERE palpite_rodada < $rodadaatual[rodadaatual] AND palpite_user = '$classificacao[user_nome]'
								ORDER BY palpite_rodada DESC
								LIMIT 4";
								$sql_query_hist = $mysqli->query($sql_code_hist) or die($mysqli->error);

							while ($result = $sql_query_hist->fetch_array()){

								if($result['palpite_resultado']=="Vitória"){ ?>
		                   			<i class="fas fa-circle text-center" aria-hidden="true" style='color:#69BE28; font-size:6px; word-break: none;'></i>
		                   		<?php }elseif($result['palpite_resultado']=="Derrota"){ ?>
		                   			<i class="fas fa-circle text-center" aria-hidden="true" style='color:#e90052; font-size:6px;'></i>
		                   		<?php }elseif($result['palpite_resultado']=="Empate"){ ?>
		                   			<i class="fas fa-circle text-center" aria-hidden="true" style='color:#002244; font-size:6px;'></i>
		                   		<?php }elseif($result['palpite_resultado']=="Indefinido"){ ?>
		                   			<i class="fas fa-circle text-center" aria-hidden="true" style='color:#95a5a6; font-size:6px;'></i>
		                   		<?php }

							} ?>
	                   	

		                   </td>

	                   </tr>

             		 <?php  } ?>

				</tbody>



			</table>
		</div>

		<div class="vermais">
			<a href="classificacao.php" style="color: #FFB612;" >Ver mais</a>
		</div>

	</div>



	<div id="fazerpalpite" class="container">
		
		<div class="row text-center">
			<h2>Fazer palpite</h2>
			<a href="fazerpalpite.php"><img id="bannerfazerpalpite" src="img/fazerpalpite2.jpg" style="width:100%;"></a>
<!-- 			<hr> -->
		</div>

	</div>

	<div id="guerreiros" class="container">
		
		<div class="row text-center">
			<h2>Quem é quem?</h2>
			<p>Conheça os guerreiros da 1ª edição do Survivor de 2020</p>
			<a href="guerreiros.php"><img id="bannerguerreiros" src="img/guerreiros.jpg" style="width:100%;"></a>
<!-- 			<hr> -->
		</div>

	</div>

	<div id="halldafama" class="container">
		
		<div class="row text-center">
			<h2>Hall da Fama</h2>
			<p>Os guerreiros que fizeram história no Survivor da Galera</p>
			<a href="halldafama.php"><img id="bannerhalldafama" src="img/halldafama.jpg" style="width:100%;"></a>
<!-- 			<hr> -->
		</div>

	</div>


	<div id="confrontos" class="container">
		
		<div class="row text-center">
			<?php if($rodadaatual['rodada_aberta']==0){ ?>
				<h2>Jogos da rodada <?php echo $rodadaatual['rodadaatual'];?></h2>
			<?php }elseif($rodadaatual['rodada_aberta']==1){ ?>
				<h2>Jogos da rodada <?php echo $rodada;?> (em andamento)</h2>
			<?php } ?>
		</div>

		<div class="tab-confrontos">
			<table id="tab-confrontos" class="table table-bordered">

				<?php if($rodadaatual['rodada_aberta']==0){ ?>

					<?php while ($datajogos = $sql_query_datajogos->fetch_array()) {

							// carregando jogos da rodada
								$sql_code_confrontos = "SELECT * FROM tconfrontos WHERE confronto_rodada = '$rodadaatual[rodadaatual]' AND confronto_data = '$datajogos[confronto_data]' ORDER BY confronto_hora";
								$sql_query_confrontos = $mysqli->query($sql_code_confrontos) or die ($mysqli->error);
						?>

						
<!-- 					<thead>
						<tr><th colspan='2' class="text-center data"><?php echo $datajogos['confronto_diasem'];?></th>
							<th colspan='1' class="text-center data"><?php echo $datajogos['confronto_data'];?></th>
						</tr>
					</thead> -->
					<thead>
						<tr>
							<th colspan='2' class="text-center">Casa</th>
							<th colspan='2' class="text-center">Fora</th>
						</tr>

					</thead>
					<tbody>
						
		                 <?php while ($confrontos = $sql_query_confrontos->fetch_array()) {?>
		                   <tr>
		                   		

		                   		<td class="text-center"><img src="img/iconestimes/<?php echo $confrontos['confronto_caminhom'];?>.png" style="width:15px;height:15px;"></td>
			                   <td class="text-center negrito"><?php echo $confrontos['confronto_mandante'];?></td>		       
			                   <td class="text-center negrito"><?php echo $confrontos['confronto_visitante'];?></td>
			                   <td class="text-center"><img src="img/iconestimes/<?php echo $confrontos['confronto_caminhov'];?>.png" style="width:15px;height:15px;"></td>

		                   </tr>

	             		 <?php  } ?>



					</tbody>
					<?php  }
				}elseif($rodadaatual['rodada_aberta']==1){ ?>
					<?php while ($datajogos3 = $sql_query_datajogos3->fetch_array()) {

								// carregando jogos da rodada
									$sql_code_confrontos = "SELECT * FROM tconfrontos WHERE confronto_rodada = '$rodada' AND confronto_data = '$datajogos3[confronto_data]' ORDER BY confronto_hora";
									$sql_query_confrontos = $mysqli->query($sql_code_confrontos) or die ($mysqli->error);

							?>

							
						<thead>
<!-- 							<tr><th colspan='2' class="text-center data"><?php echo $datajogos3['confronto_diasem'];?>
								<th colspan='1' class="text-center data"><?php echo $datajogos3['confronto_data'];?></th>
							</th></tr>
							<tr> -->
								<th colspan='2' class="text-center">Casa</th>
								<th colspan='2' class="text-center">Fora</th>
							</tr>

						</thead>
						<tbody>
							
			                 <?php while ($confrontos = $sql_query_confrontos->fetch_array()) {?>
			                   <tr>
			                   		

					               <td class="text-center"><img src="img/iconestimes/<?php echo $confrontos['confronto_caminhom'];?>.png" style="width:30px;height:30px;"></td>
				                   <td class="text-center negrito normal"><?php echo $confrontos['confronto_mandante'];?></td>
				                   <td class="text-center negrito normal"><?php echo $confrontos['confronto_visitante'];?></td>
				                   <td class="text-center"><img src="img/iconestimes/<?php echo $confrontos['confronto_caminhov'];?>.png" style="width:30px;height:30px;"></td>

			                   </tr>

		             		 <?php  } ?>



						</tbody>
					<?php  }
				}?>



			</table>
		</div>


</section>




<?php include_once("view/footer.php"); ?>

	<script>
     	window.onload = function(){
     		$('#sucessoLogin').fadeOut(5000);
     } 
	</script>