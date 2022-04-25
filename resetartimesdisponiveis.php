<?php 

	include("conexao/conexao.php");

	// Criação da Sessão
	if(isset($_POST['confirmar'])){

		if(!isset($_SESSION))
			session_start();

	// Registro dos dados na sessão
	// Carregando lista de usuários
	$sql_code_usuarios = "SELECT user_nome FROM tuser ORDER BY user_nome";
	$sql_query_usuarios = $mysqli->query($sql_code_usuarios) or die($mysqli->error);


	// Inserção no Banco e redirecionamento
		if (!isset($erro)) {

			while ($user = $sql_query_usuarios->fetch_array()) {			

					$sql_code_times = "INSERT INTO ttimesdisp (
					disp_nome,
					disp_time)
					VALUES('$user[user_nome]','Athletico-PR'),
						('$user[user_nome]','Atletico-GO'),
						('$user[user_nome]','Atletico-MG'),
						('$user[user_nome]','Bahia'),
						('$user[user_nome]','America-MG'),
						('$user[user_nome]','Bragantino'),
						('$user[user_nome]','Ceara'),
						('$user[user_nome]','Corinthians'),
						('$user[user_nome]','Juventude'),
						('$user[user_nome]','Flamengo'),
						('$user[user_nome]','Fluminense'),
						('$user[user_nome]','Fortaleza'),
						('$user[user_nome]','Cuiaba'),
						('$user[user_nome]','Gremio'),
						('$user[user_nome]','Internacional'),
						('$user[user_nome]','Palmeiras'),
						('$user[user_nome]','Santos'),
						('$user[user_nome]','Sao-Paulo'),
						('$user[user_nome]','Sport'),
						('$user[user_nome]','Chapecoense')";

				$confirma2 = $mysqli->query($sql_code_times) or die($mysqli->error);
			}

			if($confirma2){

				echo "<script>alert('Reset bem sucedido!'); location.href='resetartimesdisponiveis.php'; </script>";
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
				<p><button class="btn btn-primary" name="confirmar" type="submit" id="confirmarpalpite">Resetar</button></p>
			</div>
			
		</form>
	</div>
	</body>

		<script>
     	window.onload = function(){
     		$('#erro').fadeOut(5000);}

		</script>

<?php include_once("view/footer.php"); ?>