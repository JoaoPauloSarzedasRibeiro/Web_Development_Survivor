<?php 
	include("conexao/conexao.php");

	//iniciando sessao
	if(!isset($_SESSION)) session_start();
	include("protect.php");	
	protect();

	// verificando se está com o campo nome, senão volta pro login
	if(!isset($_SESSION['nome'])){
				echo "location.href='login.php?codigo=1'; </script>";
	}

	// adicionando o campo rodada
	if(isset($_GET['rodada'])){
		$rodada['rodadaatual'] = $_GET['rodada'];
		}else{
	$sql_code_rodadaatual = "SELECT rodadaatual FROM trodadaatual LIMIT 1";
	$sql_query_rodadaatual = $mysqli->query($sql_code_rodadaatual) or die($mysqli->error);
	$rodada = $sql_query_rodadaatual->fetch_assoc();
	}

	//buscando rodada atual
	$sql_code_rodadaatual = "SELECT rodadaatual FROM trodadaatual LIMIT 1";
	$sql_query_rodadaatual = $mysqli->query($sql_code_rodadaatual) or die($mysqli->error);
	$rodadaatual = $sql_query_rodadaatual->fetch_assoc();

	// carregando a lista de rodadas
	$sql_code_rodadas = "SELECT rodada_id,rodada_nome FROM trodada WHERE rodada_id >= $rodadaatual[rodadaatual] LIMIT 3";
	$sql_query_rodadas = $mysqli->query($sql_code_rodadas) or die($mysqli->error);

	// exibindo times disponíveis
	$sql_code_time = "SELECT disp_time FROM ttimesdisp WHERE disp_nome='$_SESSION[nome]' ORDER BY disp_time";
	$sql_query_time = $mysqli->query($sql_code_time) or die ($mysqli->error);

	
	// ver se já tem palpite repetido
	$sql_code_maiorrodada = "SELECT palpite_rodada, palpite_time FROM tpalpite WHERE palpite_user='$_SESSION[nome]' ORDER BY palpite_rodada DESC LIMIT 1";

	$sql_query_maiorrodada = $mysqli->query($sql_code_maiorrodada) or die($mysqli->error);
	$maiorrodada = $sql_query_maiorrodada->fetch_assoc();

	// carregando datas de jogos
	$sql_code_datajogos = "SELECT confronto_data, confronto_diasem, Count(confronto_data) from tconfrontos where confronto_rodada = '$rodada[rodadaatual]' group by confronto_data having Count(confronto_data)>=1";
	$sql_query_datajogos = $mysqli->query($sql_code_datajogos) or die ($mysqli->error);


	// Criação da Sessão


	if(isset($_POST['confirmar'])){

		if(!isset($_SESSION))
			protect();

	// Registro dos dados na sessão
		foreach($_POST as $chave => $valor) {
			$_SESSION[$chave] = $mysqli->real_escape_string($valor);			
		}

		if (strlen($_SESSION['time']) != 0) {


			$sql_code_checkpalpite = "SELECT COUNT(palpite_rodada) AS check_palpite FROM tpalpite WHERE palpite_user = '$_SESSION[nome]' AND palpite_rodada = '$_SESSION[rodadas]'";
			$sql_query_checkpalpite = $mysqli->query($sql_code_checkpalpite) or die($mysqli->error);
			$checkpalpite = $sql_query_checkpalpite->fetch_assoc();

			if($checkpalpite['check_palpite']>0){
				echo "<script> location.href='editarpalpite.php?codigo=1'; </script>";		
				exit();
			}


		// Inserção no Banco e redirecionamento
			if (!isset($erro)) {
				$data = date('Y-m-d H:i:s');

				$sql_code = "INSERT INTO tpalpite (
				palpite_user,
				palpite_userid,
				palpite_rodada,
				palpite_time,
				palpite_data,
				palpite_resultado)
				VALUES(
				'$_SESSION[nome]',
				'$_SESSION[usuario]',
				'$_SESSION[rodadas]',
				'$_SESSION[time]',
				'$data',
				'Indefinido')";

				$sql_code2 = "DELETE FROM ttimesdisp WHERE disp_nome='$_SESSION[nome]' AND disp_time='$_SESSION[time]'";



				$confirma = $mysqli->query($sql_code) or die($mysqli->error);
				$confirma2 = $mysqli->query($sql_code2) or die($mysqli->error);

				if($confirma && $confirma2){
					unset(
					$_SESSION['rodadas'],
					$_SESSION['time']);

					echo "<script> location.href='editarpalpite.php?'</script>";
				}else{
					$erro[]=$confirma;
				}

			}
		}else{
			echo "<script>alert('Eita, Guerreiro! Aconteceu um erro, tente novamente!'); location.href='fazerpalpite.php'; </script>";
		}

	}
?>

<?php include_once("view/header.php"); ?>

	<body>



		<div id="iniciorodada">
		
			<div class="container" id="inicio-rodada">
				<div class="row">
					<div class="col-md-12">
						<h1>Fazer Palpite</h1>
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
				<div class="form-group">
					<label for="nome">Guerreiro(a)</label>
					<p><input class="form-control" name="nome" value="<?php echo $_SESSION['nome'] ?>" required disabled type="text"></p>
					<p class=espaco></p>
				</div>
				<div class="form-group">
					<label for="rodada">Rodada atual</label>
					<p><input class="form-control" name="rodada" value="<?php echo $rodadaatual['rodadaatual'] ?>" required disabled type="text"></p>
					<p class=espaco></p>
				</div>
				<div class="form-group">
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
		     	</div>
				<div class="form-group">
					<label for="time">Escolha um time</label>
					<p><select class="form-control" name="time">
						<?php while ($resultado_time = $sql_query_time->fetch_array()){ ?>
		         		 <option value="<?php echo $resultado_time['disp_time']; ?>"><?php echo $resultado_time['disp_time']; ?></option>
		     			<?php } ?>
		     		</select></p>
		     	</div>
		     		<p class=espaco></p>
					<p><button class="btn btn-primary" name="confirmar" type="submit" id="confirmarpalpite">Fazer Palpite</button></p>
			</form>
		</div>

		<p class=espaco></p>
		
		<div id="JogosRodada" class="container">

			<div class="row text-center">
				<h2>JOGOS da rodada <?php echo $rodada['rodadaatual']; ?></h2>
				<hr>	
			</div>

			<div id="confrontosFazerPalp" class="container">
				

				<div class="tab-confrontos">
					<table id="tab-confrontos" class="table table-bordered">

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
						<?php  } ?>



					</table>
			</div>

			<div class="row text-center">
				<h2>TABELA</h2>
				<hr>	
			</div>

			

			<div id="tabJogosRodada">
				<iframe frameborder="0"  scrolling="no" width="350" height="700" src="https://www.fctables.com/brazil/serie-a/iframe/?type=table&lang_id=12&country=29&template=182&team=&timezone=America/Sao_Paulo&time=24&po=1&ma=1&wi=1&dr=1&los=1&gf=0&ga=0&gd=0&pts=1&ng=0&form=1&width=350&height=700&font=Verdana&fs=12&lh=14&bg=FFFFFF&fc=333333&logo=1&tlink=0&ths=1&thb=1&thba=FFB612&thc=101820&bc=dddddd&hob=f5f5f5&hobc=ebe7e7&lc=333333&sh=1&hfb=1&hbc=002244&hfc=ffffff"></iframe>
			</div>


		</div>

	</div>
	</div>




	<?php include_once("view/footer.php"); ?>






<script>
		$(document).ready(function(){

				$("#rodadas").on("change", function(){
					$rodadaSelected = rodadas.options[rodadas.selectedIndex].value;
					location.href="fazerpalpite.php?rodada="+$rodadaSelected;	
				});

		});
	</script>