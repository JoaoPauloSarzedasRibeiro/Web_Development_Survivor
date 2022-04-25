<?php 
	include("conexao/conexao.php");

	if(!isset($_GET['usuario']) || !isset($_GET['rodada']) || !isset($_GET['time'])){
		echo "<script>alert('Eita, Guerreiro! Aconteceu um erro, tente novamente!'); location.href='editarpalpite.php'; </script>";
	}

	// carregando os dados passados por post
	$usuario = $_GET['usuario'];
	$rodada = $_GET['rodada'];
	$timeatual = $_GET['time'];

	// carregando o palpite
	$sql_code_Palpite = "SELECT palpite_time FROM tpalpite
	WHERE
	palpite_user = '$_GET[usuario]'
	AND
	palpite_userid = '$_GET[userid]'
	AND
	palpite_rodada = '$_GET[rodada]'
	ORDER BY palpite_rodada ASC";

	$sql_query_Palpite = $mysqli->query($sql_code_Palpite) or die($mysqli->error);
	$palpite = $sql_query_Palpite->fetch_array();

	if($_GET['time'] != $palpite['palpite_time']){
		echo "<script>alert('Eita, Guerreiro! Aconteceu um erro, tente novamente!'); location.href='editarpalpite.php'; </script>";
	}


	// carregando os times disponiveis
	$sql_code_time = "SELECT disp_time FROM ttimesdisp WHERE disp_nome='$_GET[usuario]' AND disp_nome != '' ORDER BY disp_time";
	$sql_query_time = $mysqli->query($sql_code_time) or die ($mysqli->error);

	// carregando datas de jogos pra tabela de jogos
	$sql_code_datajogos = "SELECT confronto_data, confronto_diasem, Count(confronto_data) from tconfrontos where confronto_rodada = '$rodada' group by confronto_data having Count(confronto_data)>=1";
	$sql_query_datajogos = $mysqli->query($sql_code_datajogos) or die ($mysqli->error);



	// Criação da Sessão

	if(isset($_POST['confirmar'])){



	// Inserção no Banco e redirecionamento
		if (!isset($erro)) {


			//atribuindo o time novo do palpite
			$_SESSION['time'] = $mysqli->escape_string($_POST['time']);

			if(strlen($_SESSION['time']) != 0)

			//deletando o palpite antigo
			$sql_code = "DELETE FROM tpalpite WHERE palpite_user='$_GET[usuario]' AND palpite_rodada='$_GET[rodada]' AND palpite_time = '$_GET[time]'";
			$confirma = $mysqli->query($sql_code) or die ($mysqli->error);



			// inserindo o palpite novo
			$data = date('Y-m-d H:i:s');

			$sql_code2 = "INSERT INTO tpalpite (
			palpite_user,
			palpite_userid,
			palpite_rodada,
			palpite_time,
			palpite_data,
			palpite_resultado)
			VALUES(
			'$_GET[usuario]',
			'$_GET[userid]',
			'$_GET[rodada]',
			'$_SESSION[time]',
			'$data',
			'Indefinido')";
			$confirma2 = $mysqli->query($sql_code2) or die($mysqli->error);

			// deletando o time novo do times disponiveis
			$sql_code3 = "DELETE FROM ttimesdisp WHERE disp_nome='$_GET[usuario]' AND disp_time='$_SESSION[time]'";
			$confirma3 = $mysqli->query($sql_code3) or die($mysqli->error);

			// colocando o time antigo de volta pra disponivel
			$sql_code4 = "INSERT INTO ttimesdisp (disp_nome, disp_time)
			VALUES(
		  	'$_GET[usuario]',
			'$_GET[time]')";
			$confirma4 = $mysqli->query($sql_code4) or die($mysqli->error);


			// verificando se todas querys rodaram
			if($confirma && $confirma2 && $confirma3 && $confirma4){
				unset(
				$_SESSION['timeatual'],
				$_SESSION['time']);

				echo "<script> location.href='editarpalpite.php?codigo=2'</script>";
			}else{
				$erro[]=$confirma;
			}

		}

	}
?>

<?php include_once("view/header.php"); ?>
	<body>
		

		<div id="iniciorodada">
		
			<div class="container" id="inicio-rodada">
				<div class="row">
					<div class="col-md-12">
						<h1>Edição de Palpite</h1>
					</div>
				</div>
			</div>

		</div>

		<div id="formEditarPalpite" class="container">
			<form method="POST">
				<div class="form-group">
					<label for="nome">Guerreiro(a)</label>
					<p><input class="form-control" name="nome" value="<?php echo $_GET['usuario'] ?>" required disabled type="text"></p>
					<p class=espaco></p>
				</div>
				<div class="form-group">
					<label for="rodada">Rodada</label>
					<p><input class="form-control" name="rodada" value="<?php echo $_GET['rodada'] ?>" required disabled type="text"></p>
					<p class=espaco></p>
				</div>
				<div class="form-group">
					<label for="time_atual">Time atual</label>
					<p><input class="form-control" name="time_atual" value="<?php echo $palpite['palpite_time'] ?>" required disabled type="text"></p>
					<p class=espaco></p>
				</div>
				<div class="form-group">
					<label for="time">Novo time</label>
					<select class="form-control" name="time">

						<?php while ($resultado_time = $sql_query_time->fetch_array()){ ?>
		         		 <option value="<?php echo $resultado_time['disp_time']; ?>"><?php echo $resultado_time['disp_time']; ?></option>
		     			<?php } ?>
		     		</select></p>
					<p class=espaco>
				</p>
				</div>
				<div class="form-group">
					<p><button class="btn btn-primary" name="confirmar" type="submit" id="confirmarpalpite">Editar Palpite</button></p>
				</div>

			</form>
		</div>

		<div id="JogosRodadaEdicao" class="container">


			<div class="row text-center">
				<h2>JOGOS da rodada <?php echo $rodada; ?></h2>
				<hr>	
			</div>

			<div id="confrontosEdicao" class="container">

				<div class="tab-confrontos">
					<table id="tab-confrontos" class="table table-bordered">

						<?php while ($datajogos = $sql_query_datajogos->fetch_array()) {

								// carregando jogos da rodada
									$sql_code_confrontos = "SELECT * FROM tconfrontos WHERE confronto_rodada = '$rodada' AND confronto_data = '$datajogos[confronto_data]' ORDER BY confronto_hora";
									$sql_query_confrontos = $mysqli->query($sql_code_confrontos) or die ($mysqli->error);
							?>

							
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
						<?php  } ?>



					</table>
			</div>

			<div class="row text-center">
				<h2>TABELA</h2>
				<hr>	
			</div>

			<div id="tabJogosRodada">
				<iframe frameborder="0"  scrolling="no" width="350" height="700" src="https://www.fctables.com/brazil/serie-a/iframe/?type=table&lang_id=12&country=29&template=182&team=&timezone=America/Sao_Paulo&time=24&po=1&ma=1&wi=1&dr=1&los=1&gf=0&ga=0&gd=0&pts=1&ng=0&form=1&width=350&height=700&font=Verdana&fs=12&lh=14&bg=FFFFFF&fc=333333&logo=1&tlink=0&ths=1&thb=1&thba=FFB612&thc=101820&bc=dddddd&hob=f5f5f5&hobc=ebe7e7&lc=333333&sh=1&hfb=1&hbc=002244&hfc=ffffff"></iframe>
				<div style="text-align:center;"></div>
			</div>
		</div>
		</div>
		</div>




<?php include_once("view/footer.php"); ?>
