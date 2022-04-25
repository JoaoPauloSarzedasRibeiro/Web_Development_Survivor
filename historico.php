<?php 

 	if (!isset($_SESSION))
			session_start();


	include_once("view/header.php");
	include("conexao/conexao.php");

	// adicionando o campo rodada
	$sql_code_rodada = "SELECT rodadaatual FROM trodadaatual LIMIT 1";
	$sql_query_rodada = $mysqli->query($sql_code_rodada) or die($mysqli->error);
	$rodadaatual = $sql_query_rodada->fetch_assoc();

	//buscando guru
	$sql_code_guru2 = "SELECT rodada_guru FROM trodadaatual LIMIT 1";
	$sql_query_guru2 = $mysqli->query($sql_code_guru2) or die($mysqli->error);
	$rodada_guru = $sql_query_guru2->fetch_assoc();

	// Se vier via GET, atualiza a tabela
	if(isset($_GET['rodada'])){
			if ($_GET['rodada']<$rodadaatual['rodadaatual']){
				$rodadaGET = $_GET['rodada'];
				$sql_code_hist = "SELECT `palpite_user`,`palpite_rodada`,`palpite_time`,`palpite_resultado`, `palpite_fora` FROM tpalpite WHERE palpite_rodada='$rodadaGET' ORDER BY `palpite_user` ASC";
			}else{
				$rodadaGET = $rodadaatual['rodadaatual']-1;
				$sql_code_hist = "SELECT `palpite_user`,`palpite_rodada`,`palpite_time`,`palpite_resultado`,`palpite_fora` FROM tpalpite WHERE palpite_rodada='$rodadaatual[rodadaatual]'-1 ORDER BY `palpite_user` ASC";
			}
	}else{
			$rodadaGET = $rodadaatual['rodadaatual']-1;
			$sql_code_hist = "SELECT `palpite_user`,`palpite_rodada`,`palpite_time`,`palpite_resultado`,`palpite_fora` FROM tpalpite WHERE palpite_rodada='$rodadaatual[rodadaatual]'-1 ORDER BY `palpite_user` ASC";
	}
	// carregando a tabela de historico
	$sql_query_hist = $mysqli->query($sql_code_hist) or die($mysqli->error);

	// carregando a lista de rodadas
	$sql_code_rodadas = "SELECT rodada_id,rodada_nome FROM trodada WHERE rodada_id < $rodadaatual[rodadaatual]";
	$sql_query_rodadas = $mysqli->query($sql_code_rodadas) or die($mysqli->error);

	if ($rodadaatual['rodadaatual'] == 20) {
		$alerta[] = "Ops! Os palpites só ficarão disponíveis quando a rodada iniciar.";
	}

	// carregando lista dos times
	$sql_code_chart = "SELECT palpite_time, count(palpite_time) as cont  FROM tpalpite WHERE palpite_rodada = $rodadaGET GROUP BY palpite_time ORDER BY cont";
	$sql_query_chart = $mysqli->query($sql_code_chart) or die($mysqli->error);

	// carregando lista dos resultados
	$sql_code_chart2 = "SELECT palpite_resultado, count(palpite_resultado) as cont  FROM tpalpite WHERE palpite_rodada = $rodadaGET GROUP BY palpite_resultado ORDER BY cont";
	$sql_query_chart2 = $mysqli->query($sql_code_chart2) or die($mysqli->error);


	




?>

<section>


	<div id="iniciorodada">
		<div class="container" id="inicio-rodada">
			<div class="row">
				<div class="col-md-12">
					<h1>Histórico de Palpites</h1>
				</div>
			</div>
		</div>

	</div>

	<div id="erroHistorico" class="erro container">
		<div class="text-center">
			<?php 

				if(isset($alerta) > 0)
				foreach ($alerta as $msg) {
					echo "<p>$msg</p>";
				}

			?>
		</div>
	</div>



	<div id="formHistorico" class="container">
		<form method="POST">
				<div class="form-group">
					<label for="rodadas">Escolha uma rodada</label>
					<p><select class="form-control" name="rodadas" id="rodadas">
						<?php while ($rodadas = $sql_query_rodadas->fetch_array()){ ?>
	         		 		<option value="<?php echo $rodadas['rodada_id']; ?>"><?php echo $rodadas['rodada_id'];?></option>
	     			<?php } ?>
	     					<option selected="selected" value=" ">Rodada...</option>
		     		</select></p>
		     	</div>
		</form>
	</div>

	<div id="historico" class="container">
		<div class="tabclassificacao">
			<table id="tab-classificacao" class="table table-bordered">
				<thead>
<tr><th class="text-center" colspan="4">Rodada: <?php echo $rodadaGET ?></th></tr>
					<tr>
						<th class="text-center">Nome</th>
						<th class="text-center">Palpite</th>
<!-- 						<th class="text-center">Guru</th> -->
						<th class="text-center">R</th>

					</tr>
				</thead>
				<tbody>
					<?php while ($historico = $sql_query_hist->fetch_array()) {



	// carregando lista dos gurus
	$sql_code_guru = "SELECT resposta_texto FROM tguru_respostas WHERE resposta_user='$historico[palpite_user]' AND resposta_rodada='$rodadaGET'";
	$sql_query_guru = $mysqli->query($sql_code_guru) or die($mysqli->error);
$guru = $sql_query_guru->fetch_assoc();



?>
	                   <tr>
		                   <td class="text-center negrito"><a href="historicouser.php?usuario=<?php echo $historico['palpite_user'];?>" class="link-tabela"><?php echo $historico['palpite_user'];?></a></td>
		                   <td class="text-center"><?php echo $historico['palpite_time'];?></td>
<!-- 
		                   <td class="text-center"><?php

if($rodada_guru['rodada_guru']==1){ echo "?"; }else{ 

 echo $guru['resposta_texto'];}?></td> -->


		                   <td class="text-center negrito" <?php 
		                   if($historico['palpite_resultado']=="Derrota"){
		                   		echo "style='color:#e90052'";
		                   }elseif ($historico['palpite_resultado']=="Vitória"&&$historico['palpite_fora']!="S") {
		                   		echo "style='color:#69BE28'";
		                   }elseif ($historico['palpite_resultado']=="Empate") {
		                   		echo "style='color:#002244'";
		                   }elseif ($historico['palpite_resultado']=="Indefinido") {
		                   		echo "style='color:#95a5a6'";
		                   }
		                   if($historico['palpite_fora']=="S"){
		                   		echo "style='color:#f1c40f'";
		                   }

		                   ?>

		                   ><?php

		                   if($historico['palpite_fora']=="S"){
		                   		echo "F";
		                   }elseif ($historico['palpite_resultado']=="Vitória"){
		                   	echo "V";
		                   }elseif ($historico['palpite_resultado']=="Empate"){
		                   	echo "E";
		                   }elseif ($historico['palpite_resultado']=="Derrota"){
		                   	echo "D";
		                   }elseif ($historico['palpite_resultado']=="Indefinido"){
		                   	echo "?";
		                   }?></td>
	                   </tr>

             		 <?php  } ?>

				</tbody>
			</table>


		

		</div>


	</div>

	<div class="container" id="dashboard">

		<div class="row text-center">
			<h2>PALPITES POR TIME</h2>
			<hr>
		</div>
		
		<div class="container" id="chartContainer" style="height: 200px; width: 100%;"></div>

	</div>

	<div class="container" id="dashboard2">

		<div class="row text-center">
			<h2>RESULTADOS</h2>
			<hr>
		</div>
		
		<div class="container" id="chartContainer2" style="height: 200px; width: 100%;"></div>

	</div>


</section>
<?php include_once("view/footer.php"); ?>


	

	<script>
		$(document).ready(function(){

				$("#rodadas").on("change", function(){
					$rodadaSelected = rodadas.options[rodadas.selectedIndex].value;
					location.href="historico.php?rodada="+$rodadaSelected;	
				});

		});
	</script>

	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
	<script type="text/javascript">

		window.onload = function () {

     		$('#erroHistorico').fadeOut(15000);

			var chart = new CanvasJS.Chart("chartContainer", {
				title:{
					text: ""              
				},
				data: [              
				{
					// Change type to "doughnut", "line", "splineArea", etc.
					type: "pie",
					dataPoints: [
					<?php 
							while ($times = $sql_query_chart->fetch_array()){


								$time = $times['palpite_time'];
								$sql_code_countpalpite = "SELECT count(palpite_user) as contagem from tpalpite WHERE palpite_time='$times[palpite_time]' AND palpite_rodada='$rodadaGET'";
								$sql_query_countpalpite = $mysqli->query($sql_code_countpalpite) or die($mysqli->error);
								$contagem = $sql_query_countpalpite->fetch_assoc();
								?>

								
								{ label: '<?php echo $time ?>' , y: '<?php echo $contagem['contagem'] ?>' },

							<?php } ?>
					]
				}
				]
			});
			chart.render();

				var chart2 = new CanvasJS.Chart("chartContainer2", {
				title:{
					text: ""              
				},
				data: [              
				{
					// Change type to "doughnut", "line", "splineArea", etc.
					type: "pie",
					dataPoints: [
					<?php 
							while ($resultados = $sql_query_chart2->fetch_array()){


								$resultado = $resultados['palpite_resultado'];
								$sql_code_countresultados = "SELECT count(palpite_user) as contagem from tpalpite WHERE palpite_resultado='$resultados[palpite_resultado]' AND palpite_rodada='$rodadaGET'";
								$sql_query_countresultados = $mysqli->query($sql_code_countresultados) or die($mysqli->error);
								$contagem2 = $sql_query_countresultados->fetch_assoc();
								?>

								
								{ label: '<?php echo $resultado ?>' , y: '<?php echo $contagem2['contagem'] ?>' },

							<?php } ?>
					]
				}
				]
			});
			chart2.render();

		}
		
	</script>


