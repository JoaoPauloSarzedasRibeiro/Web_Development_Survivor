<?php 
	include("conexao/conexao.php");

	//iniciando sessao
	if(!isset($_SESSION)) session_start();

	// adicionando o campo rodada
	if(isset($_GET['rodada'])){
		$rodada['rodadaatual'] = $_GET['rodada'];
		}else{
			$sql_code_rodadaatual = "SELECT rodadaatual FROM trodadaatual LIMIT 1";
			$sql_query_rodadaatual = $mysqli->query($sql_code_rodadaatual) or die($mysqli->error);
			$rodada1 = $sql_query_rodadaatual->fetch_assoc();
			$rodada['rodadaatual'] = $rodada1['rodadaatual']-1;
	}

	// carregando rodada atual
	$sql_code_rodadaatual = "SELECT rodadaatual FROM trodadaatual LIMIT 1";
	$sql_query_rodadaatual = $mysqli->query($sql_code_rodadaatual) or die($mysqli->error);
	$rodada1 = $sql_query_rodadaatual->fetch_assoc();

	// carregando a lista de rodadas
	$sql_code_rodadas = "SELECT rodada_id,rodada_nome FROM trodada WHERE rodada_id < $rodada1[rodadaatual]";
	$sql_query_rodadas = $mysqli->query($sql_code_rodadas) or die($mysqli->error);


	// carregando datas de jogos
	$sql_code_datajogos = "SELECT confronto_data, confronto_diasem, Count(confronto_data) from tconfrontos where confronto_rodada = '$rodada[rodadaatual]' group by confronto_data having Count(confronto_data)>=1";
	$sql_query_datajogos = $mysqli->query($sql_code_datajogos) or die ($mysqli->error);

	
?>

<?php include_once("view/header.php"); ?>

	<body>



		<div id="iniciorodada">
		
			<div class="container" id="inicio-rodada">
				<div class="row">
					<div class="col-md-12">
						<h1>Resultados dos Jogos</h1>
					</div>
				</div>
			</div>

		</div>

		<?php 

			if(isset($erro)){
				echo "<div class='erro'>";
				foreach ($erro as $valor) {
					echo "$valor<br>";
				}
				echo "</div>";
			}

			
		?>
		

		<div id="formPalpite" class="container">
			<form method="POST">
					<label for="rodadas">Escolha uma rodada</label>
					<p><select class="form-control" name="rodadas" id="rodadas">
						<?php while ($rodadas = $sql_query_rodadas->fetch_array()){
							if (intval($rodadas['rodada_id'])==intval($rodada['rodadaatual'])){
							?>
							<option selected="selected" value="<?php echo $rodada['rodadaatual']; ?>"><?php echo $rodada['rodadaatual']; ?></option>
						<?php }else{ ?> 
	         		 		<option value="<?php echo $rodadas['rodada_id']; ?>"><?php echo $rodadas['rodada_id'];?></option>

	     			<?php } } ?>
		     		</select></p>
			</form>
		</div>

		<p class=espaco></p>
		
		<div id="JogosRodadaResultados" class="container">

			<div class="row text-center">
				<h2>RODADA <?php echo $rodada['rodadaatual']; ?></h2>
				<hr>	
			</div>

			<div id="confrontosFazerPalp" class="container">
				

				<div class="tab-confrontos">
					<table id="tab-confrontos-resultados" class="table table-bordered">

						<?php while ($datajogos = $sql_query_datajogos->fetch_array()) {

								// carregando jogos da rodada
									$sql_code_confrontos = "SELECT * FROM tconfrontos WHERE confronto_rodada = '$rodada[rodadaatual]' AND confronto_data = '$datajogos[confronto_data]' ORDER BY confronto_hora";
									$sql_query_confrontos = $mysqli->query($sql_code_confrontos) or die ($mysqli->error);

							?>

							
						<thead>
							<tr><th colspan='2' class="text-center data"><?php echo $datajogos['confronto_diasem'];?>
								<th colspan='1' class="text-center data"><?php echo $datajogos['confronto_data'];?></th>
							</th></tr>
							<tr>
								<th colspan='2' class="text-center">Casa</th>
								<th class="text-center">Placar</th>
								<th colspan='2' class="text-center">Fora</th>
							</tr>

						</thead>
						<tbody>
							
			                 <?php while ($confrontos = $sql_query_confrontos->fetch_array()) {?>
			                   <tr>
			                   		

					               <td class="text-center"><img src="img/iconestimes/<?php echo $confrontos['confronto_caminhom'];?>.png" style="width:15px;height:15px;"></td>
				                   <td class="text-center negrito normal"><?php echo $confrontos['confronto_mandante'];?></td>
<?php if($confrontos['confronto_resultado']=="-"){ ?>
				                  <td class="text-center resultado"><?php echo $confrontos['confronto_hora'];?></td>
<?php }else{ ?>
<td class="text-center negrito resultado"><?php echo $confrontos['confronto_resultado'];?></td>
<?php } ?>
				                   <td class="text-center negrito normal"><?php echo $confrontos['confronto_visitante'];?></td>
				                   <td class="text-center"><img src="img/iconestimes/<?php echo $confrontos['confronto_caminhov'];?>.png" style="width:15px;height:15px;"></td>

			                   </tr>

		             		 <?php  } ?>



						</tbody>
						<?php  } ?>



					</table>
			</div>

			<div class="row text-center">
				<h2>TABELA</h2>
				<hr>	
			</div>

			

			<div id="tabJogosRodada">
				<iframe frameborder="0"  scrolling="no" width="350" height="700" src="https://www.fctables.com/brazil/serie-a/iframe/?type=table&lang_id=12&country=29&template=182&team=&timezone=America/Sao_Paulo&time=24&po=1&ma=1&wi=1&dr=1&los=1&gf=0&ga=0&gd=0&pts=1&ng=0&form=1&width=350&height=700&font=Verdana&fs=12&lh=14&bg=FFFFFF&fc=333333&logo=1&tlink=0&ths=1&thb=1&thba=FFB612&thc=101820&bc=dddddd&hob=f5f5f5&hobc=ebe7e7&lc=333333&sh=1&hfb=1&hbc=002244&hfc=ffffff"></iframe>
				<div style="text-align:center;">
			</div>


		</div>

	</div>
	</div>




	<?php include_once("view/footer.php"); ?>






<script>
		$(document).ready(function(){

				$("#rodadas").on("change", function(){
					$rodadaSelected = rodadas.options[rodadas.selectedIndex].value;
					location.href="historicoresultados.php?rodada="+$rodadaSelected;	
				});

		});
	</script>