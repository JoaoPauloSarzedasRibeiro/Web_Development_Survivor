<?php 

	include("conexao/conexao.php");

	// adicionando o campo rodada - 1
	$sql_code_rodada = "SELECT rodadaatual FROM trodadaatual LIMIT 1";
	$sql_query_rodada = $mysqli->query($sql_code_rodada) or die($mysqli->error);
	$rodadaatual = $sql_query_rodada->fetch_assoc();
	$rodadaJOGO = $rodadaatual['rodadaatual']-1;


	// Carregando lista de usuários
	$sql_code_usuarios = "SELECT palpite_user FROM tpalpite WHERE palpite_rodada = '$rodadaJOGO' AND palpite_time = 'Sem Palpite' ORDER BY palpite_user ASC";
	$sql_query_usuarios = $mysqli->query($sql_code_usuarios) or die($mysqli->error);

	// Se vier via GET, atualiza a tabela
	if(isset($_GET['nome'])){
				$nomeGET = $_GET['nome'];
				$sql_code_timedisp = "SELECT * FROM ttimesdisp WHERE disp_nome='$nomeGET' ORDER BY disp_time ASC";
			}else{
				$nomeGET = 'João Paulo';
				$sql_code_timedisp = "SELECT * FROM ttimesdisp WHERE disp_nome='$nomeGET' ORDER BY disp_time ASC";
			}

	// carregando a tabela de times disp
	$sql_query_timedisp = $mysqli->query($sql_code_timedisp) or die($mysqli->error);

	
	// Criação da Sessão
	if(isset($_POST['confirmar'])){

		if(!isset($_SESSION))
			session_start();

	// Registro dos dados na sessão
		foreach($_POST as $chave => $valor) {
			$_SESSION[$chave] = $mysqli->real_escape_string($valor);			
		}
	

	// Inserção no Banco e redirecionamento
		if (!isset($erro)) {
			
			$sql_code = "UPDATE tpalpite SET
								palpite_time = '$_SESSION[time]',
								palpite_resultado = 'Indefinido'
								WHERE
								palpite_user = '$nomeGET'
								AND
								palpite_rodada = '$rodadaJOGO'
								AND
								palpite_time = 'Sem Palpite'";

			$sql_code2 = "DELETE FROM ttimesdisp WHERE disp_nome='$nomeGET' AND disp_time='$_SESSION[time]'";
			
			$confirma = $mysqli->query($sql_code) or die($mysqli->error);
			$confirma2 = $mysqli->query($sql_code2) or die($mysqli->error);

			if($confirma && $confirma2){
				echo "<script>alert('Palpite ajustado com sucesso!'); location.href='ajustepalpite.php'; </script>";
			}else{
				$erro[]=$confirma;
			}

		}

	}
?>

<?php include_once("view/header.php"); ?>
	<body>


		<div id="erro" class="container">
			<div class="text-center">
				<?php 

					if(isset($erro) > 0)
					foreach ($erro as $msg) {
						echo "<p>$msg</p>";
					}

				?>
			</div>
		</div>
	
	<div id="formCadastro" class="container">
		<form method="POST">
			<div class="form-group">
				<label for="rodada">Rodada</label>
				<input class="form-control" name="rodada" value="<?php echo $rodadaJOGO; ?>" required type="text">
				<p class=espaco></p>
			</div>
			<div class="form-group">
				<label for="nome">Trocar Guerreiro(a)</label>
				<p><select class="form-control" name="nome" id="nome">
					<?php while ($usuarios = $sql_query_usuarios->fetch_array()){ ?>
	         		 <option value="<?php echo $usuarios['palpite_user']; ?>"><?php echo $usuarios['palpite_user']; ?></option>
	     			<?php } ?>
	     			<option selected="selected" value=" ">Selecione...</option>
	     		</select></p>
			</div>
			<div class="form-group">
				<label for="nomeescolhido">Guerreiro selecionado</label>
				<input class="form-control" name="nomeescolhido" value="<?php echo $nomeGET; ?>" required type="text" disabled>
				<p class=espaco></p>
			</div>
			<div class="form-group">
				<label for="time">Times Disponíveis(a)</label>
				<p><select class="form-control" name="time" id="time">
					<?php while ($timedisp = $sql_query_timedisp->fetch_array()){ ?>
	         		 <option value="<?php echo $timedisp['disp_time']; ?>"><?php echo $timedisp['disp_time']; ?></option>
	     			<?php } ?>
	     		</select></p>
			</div>
			<div class="form-group">
				<p><button class="btn btn-primary" name="confirmar" type="submit" id="confirmarpalpite">Ajustar palpite</button></p>
			</div>
			
		</form>
	</div>
	</body>


<?php include_once("view/footer.php"); ?>


	<script>
 	window.onload = function(){
 		$('#erro').fadeOut(5000);}

	</script>

	<script>
		$(document).ready(function(){

				$("#nome").on("change", function(){
					$nomeSelected = nome.options[nome.selectedIndex].value;
					location.href="ajustepalpite.php?nome="+$nomeSelected;	
				});

		});
	</script>