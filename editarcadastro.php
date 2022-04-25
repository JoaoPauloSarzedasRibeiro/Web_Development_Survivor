<?php 

	include("conexao/conexao.php");


	// Carregando lista de usuários
	$sql_code_usuarios = "SELECT user_nome FROM tuser ORDER BY user_nome";
	$sql_query_usuarios = $mysqli->query($sql_code_usuarios) or die($mysqli->error);

	if(isset($_GET['user']))
		$nomeselecionado = $_GET['user'];
	else
		$nomeselecionado = "João Paulo";

	// Carregando userselecionado
	$sql_code_user = "SELECT * FROM tuser WHERE user_nome='$nomeselecionado'";
	$sql_query_user = $mysqli->query($sql_code_user) or die($mysqli->error);
	$userselecionado = $sql_query_user->fetch_assoc();

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
			
			$sql_code = "UPDATE tuser SET
								user_timedocoracao = '$_SESSION[timedocoracao]',
								user_cidade='$_SESSION[cidade]',
								user_temporada='$_SESSION[temporada]',
								user_2017_2='$_SESSION[u_2017_2]',
								user_2018_2='$_SESSION[u_2018_2]',
								user_2019_1='$_SESSION[u_2019_1]',
								user_2019_2='$_SESSION[u_2019_2]',
								user_2019_2='$_SESSION[u_2020_1]',
								user_2019_2='$_SESSION[u_2020_2]',
								user_copa_2019='$_SESSION[u_copa_2019]'
							WHERE
								user_nome='$nomeselecionado'";
			$confirma = $mysqli->query($sql_code) or die($mysqli->error);

			if($confirma){
				echo "<script>alert('Cadastro editado com sucesso!'); location.href='editarcadastro.php'; </script>";
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
					<label for="nome">Trocar guerreiro(a)</label>
					<p><select class="form-control" name="nome" id="nome">
						<?php while ($usuarios = $sql_query_usuarios->fetch_array()){ ?>
		         		 <option value="<?php echo $usuarios['user_nome']; ?>"><?php echo $usuarios['user_nome']; ?></option>
		     			<?php } ?>
		     		</select></p>
				</div>
			<div class="form-group">
				<label for="user">Guerreiro selecionado</label>
				<input class="form-control" name="user" value="<?php echo $nomeselecionado ?>" required disabled="true">
				<p class=espaco></p>
			</div>
			<div class="form-group">
				<label for="timedocoracao">Time do Coração</label>
				<input class="form-control" name="timedocoracao" value="<?php echo $userselecionado['user_timedocoracao']; ?>" required>
				<p class=espaco></p>
			</div>
			<div class="form-group">
				<label for="cidade">Cidade</label>
				<input class="form-control" name="cidade" value="<?php echo $userselecionado['user_cidade']; ?>" required>
				<p class=espaco></p>
			</div>
			<div class="form-group">
				<label for="temporada">Temporadas jogadas</label>
				<input class="form-control" name="temporada" value="<?php echo $userselecionado['user_temporada']; ?>" required>
				<p class=espaco></p>
			</div>
			<div class="form-group">
				<label for="u_2017_2">2017_2</label>
				<input class="form-control" name="u_2017_2" value="<?php echo $userselecionado['user_2017_2']; ?>" required>
				<p class=espaco></p>
			</div>
			<div class="form-group">
				<label for="u_2018_2">2018_2</label>
				<input class="form-control" name="u_2018_2" value="<?php echo $userselecionado['user_2018_2']; ?>" required>
				<p class=espaco></p>
			</div>
			<div class="form-group">
				<label for="u_2019_1">2019_1</label>
				<input class="form-control" name="u_2019_1" value="<?php echo $userselecionado['user_2019_1']; ?>" required>
				<p class=espaco></p>
			</div>
			<div class="form-group">
				<label for="u_2019_2">2019_2</label>
				<input class="form-control" name="u_2019_2" value="<?php echo $userselecionado['user_2019_2']; ?>" required>
				<p class=espaco></p>
			</div>
			<div class="form-group">
				<label for="u_copa_2019">copa_2019</label>
				<input class="form-control" name="u_copa_2019" value="<?php echo $userselecionado['user_copa_2019']; ?>" required>
				<p class=espaco></p>
			</div>
			<div class="form-group">
				<label for="u_2020_1">2020_1</label>
				<input class="form-control" name="u_2020_1" value="<?php echo $userselecionado['user_2020_1']; ?>" required>
				<p class=espaco></p>
			</div>
			<div class="form-group">
				<label for="u_2020_2">2020_2</label>
				<input class="form-control" name="u_2020_2" value="<?php echo $userselecionado['user_2020_2']; ?>" required>
				<p class=espaco></p>
			</div>
			<div class="form-group">
				<label for="u_2021_1">2021_1</label>
				<input class="form-control" name="u_2021_1" value="<?php echo $userselecionado['user_2021_1']; ?>" required>
				<p class=espaco></p>
			</div>
			<div class="form-group">
				<p><button class="btn btn-primary" name="confirmar" type="submit" id="confirmarpalpite">Cadastrar</button></p>
			</div>
			
		</form>
	</div>
	</body>


<?php include_once("view/footer.php"); ?>

	<script>
		$(document).ready(function(){

				$("#nome").on("change", function(){
					$nomeSelected = nome.options[nome.selectedIndex].value;
					location.href="editarcadastro.php?user="+$nomeSelected;	
				});

		});
	</script>

	<script>
 	window.onload = function(){
 		$('#erro').fadeOut(5000);}

	</script>