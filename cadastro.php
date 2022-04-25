<?php 

	include("conexao/conexao.php");

	// Criação da Sessão
	if(isset($_POST['confirmar'])){

		if(!isset($_SESSION))
			session_start();

	// Registro dos dados na sessão
		foreach($_POST as $chave => $valor) {
			$_SESSION[$chave] = $mysqli->real_escape_string($valor);			
		}


	
	// Validacao dos dados

		if(strlen($_SESSION['nome']) == 0)
			$erro[] = "Preencha o nome.";


		if(strcmp($_SESSION['senha'],$_SESSION['rsenha']) != 0)
			$erro[] = "As senhas não combinam.";


	// Inserção no Banco e redirecionamento
		if (!isset($erro)) {
			
			$sql_code = "INSERT INTO tuser (
			user_nome,
			user_senha,
			user_vida,
			prim_acesso,
			user_timedocoracao,
			user_cidade,
			user_temporada,
			user_2017_2,
			user_2018_2,
			user_2019_1,
			user_2019_2,
			user_copa_2019)
			VALUES(
			'$_SESSION[nome]',
			'$_SESSION[senha]',
			5,
			1,
			'$_SESSION[timedocoracao]',
			'$_SESSION[cidade]',
			'$_SESSION[temporada]',
			'$_SESSION[u_2017_2]',
			'$_SESSION[u_2018_2]',
			'$_SESSION[u_2019_1]',
			'$_SESSION[u_2019_2]',
			'$_SESSION[u_copa_2019]')";

			$sql_code_times = "INSERT INTO ttimesdisp (
			disp_nome,
			disp_time)
			VALUES(
			'$_SESSION[nome]','Athletico PR'),
			('$_SESSION[nome]','Atletico GO'),
			('$_SESSION[nome]','Atletico MG'),
			('$_SESSION[nome]','Bahia'),
			('$_SESSION[nome]','America MG'),
			('$_SESSION[nome]','Bragantino RB'),
			('$_SESSION[nome]','Ceara'),
			('$_SESSION[nome]','Corinthians'),
			('$_SESSION[nome]','Juventude'),
			('$_SESSION[nome]','Flamengo'),
			('$_SESSION[nome]','Fluminense'),
			('$_SESSION[nome]','Fortaleza'),
			('$_SESSION[nome]','Cuiaba'),
			('$_SESSION[nome]','Gremio'),
			('$_SESSION[nome]','Internacional'),
			('$_SESSION[nome]','Palmeiras'),
			('$_SESSION[nome]','Santos'),
			('$_SESSION[nome]','Sao Paulo'),
			('$_SESSION[nome]','Sport'),
			('$_SESSION[nome]','Chapecoense')";


			$confirma = $mysqli->query($sql_code) or die($mysqli->error);

			$confirma2 = $mysqli->query($sql_code_times) or die($mysqli->error);

			if($confirma && $confirma2){
				unset(
				$_SESSION['nome'],
				$_SESSION['senha']);

				echo "<script>alert('Cadastro bem sucedido!'); location.href='cadastro.php'; </script>";
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
				<label for="nome">Nome</label>
				<input class="form-control" name="nome" value="<?php if(isset($_SESSION)) echo $_SESSION['nome']; ?>" required type="text">
				<p class=espaco></p>
			</div>
			<div class="form-group">
				<label for="senha">Senha</label>
				<input class="form-control" name="senha" value="senha2468" required>
				<p class=espaco></p>
			</div>
			<div class="form-group">
				<label for="rsenha">Repetir Senha</label>
				<input class="form-control" name="rsenha" value="senha2468" required>
				<p class=espaco></p>
			</div>
			<div class="form-group">
				<label for="timedocoracao">Time do Coração</label>
				<input class="form-control" name="timedocoracao" value="" required>
				<p class=espaco></p>
			</div>
			<div class="form-group">
				<label for="cidade">Cidade</label>
				<input class="form-control" name="cidade" value="" required>
				<p class=espaco></p>
			</div>
			<div class="form-group">
				<label for="temporada">Temporadas Jogadas</label>
				<input class="form-control" name="temporada" value="4" required>
				<p class=espaco></p>
			</div>
			<div class="form-group">
				<label for="u_2017_2">2017_2</label>
				<input class="form-control" name="u_2017_2" value="0" required>
				<p class=espaco></p>
			</div>
			<div class="form-group">
				<label for="u_2018_2">2018_2</label>
				<input class="form-control" name="u_2018_2" value="0" required>
				<p class=espaco></p>
			</div>
			<div class="form-group">
				<label for="u_2019_1">2019_1</label>
				<input class="form-control" name="u_2019_1" value="0" required>
				<p class=espaco></p>
			</div>
			<div class="form-group">
				<label for="u_2019_2">2019_2</label>
				<input class="form-control" name="u_2019_2" value="0" required>
				<p class=espaco></p>
			</div>
			<div class="form-group">
				<label for="u_copa_2019">copa_2019</label>
				<input class="form-control" name="u_copa_2019" value="0" required>
				<p class=espaco></p>
			</div>
			<div class="form-group">
				<p><button class="btn btn-primary" name="confirmar" type="submit" id="confirmarpalpite">Cadastrar</button></p>
			</div>
			
		</form>
	</div>
	</body>

		<script>
     	window.onload = function(){
     		$('#erro').fadeOut(5000);}

		</script>

<?php include_once("view/footer.php"); ?>