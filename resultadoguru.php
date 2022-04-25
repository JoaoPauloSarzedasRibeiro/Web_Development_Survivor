<?php 

	include("conexao/conexao.php");


	// Carregando lista de usuários
	$sql_code_usuarios = "SELECT user_nome FROM tuser ORDER BY user_nome";
	$sql_query_usuarios = $mysqli->query($sql_code_usuarios) or die($mysqli->error);

	//buscando rodada atual
	$sql_code_rodadaatual = "SELECT rodadaatual FROM trodadaatual LIMIT 1";
	$sql_query_rodadaatual = $mysqli->query($sql_code_rodadaatual) or die($mysqli->error);
	$rodada = $sql_query_rodadaatual->fetch_assoc();
	$selecionada = $rodada['rodadaatual']-1;

	// carregando a lista de rodadas
	$sql_code_rodadas = "SELECT rodada_id, rodada_nome FROM trodada";
	$sql_query_rodadas = $mysqli->query($sql_code_rodadas) or die($mysqli->error);

	// Criação da Sessão

	if(isset($_POST['confirmar'])){

		if(!isset($_SESSION))
			session_start();

	// Registro dos dados na sessão
		foreach($_POST as $chave => $valor) {
			$_SESSION[$chave] = $mysqli->real_escape_string($valor);			
		}


	// baixando infos do adm
		$sql_code_adm = "SELECT * FROM trodadaatual LIMIT 1";
		$sql_query_adm = $mysqli->query($sql_code_adm) or die($mysqli->error);
		$chaveacesso = $sql_query_adm->fetch_assoc();

	

	// Inserção no Banco e redirecionamento
	if (!isset($erro)) {
		
			$sql_code = "UPDATE tguru_respostas SET
							resposta_certo = '$_SESSION[valor]'
						WHERE
							resposta_user = '$_SESSION[nome]'
						AND
							resposta_rodada = '$_SESSION[rodada]'";
			$confirma = $mysqli->query($sql_code) or die($mysqli->error);
			if($confirma){
				unset(
				$_SESSION['senha'],
				$chaveacesso['senha_adm']);
				echo "<script>alert('Resultado do guru da rodada '+'$_SESSION[rodada]'+' do guerreiro '+'$_SESSION[nome]'+' alterado para '+'$_SESSION[valor]'); location.href='resultadoguru.php'; </script>";
			}else{
				$erro[]=$confirma;
			}
		}else{
			echo "<script>alert('Senha/Rodada incorreta! Sai Fora!'); </script>";
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

		<div id="formAdm" class="container">
			<form method="POST">
		        <div class="form-group">
					<label for="rodada">Escolha uma rodada</label>
					<p><select class="form-control" name="rodada" id="rodada">
						<?php while ($rodadas = $sql_query_rodadas->fetch_array()){
							if (intval($rodadas['rodada_id'])==intval($rodada['rodadaatual'])){
							?>
							<option selected="selected" value="<?php echo $selecionada; ?>"><?php echo $selecionada; ?></option>
						<?php }else{ ?> 
		     		 		<option value="<?php echo $rodadas['rodada_id']; ?>"><?php echo $rodadas['rodada_id'];?></option>

		 			<?php } } ?>
		     		</select></p>
			   	</div>
				<div class="form-group">
					<label for="nome">Guerreiro(a)</label>
					<p><select class="form-control" name="nome">
						<?php while ($usuarios = $sql_query_usuarios->fetch_array()){ ?>
		         		 <option value="<?php echo $usuarios['user_nome']; ?>"><?php echo $usuarios['user_nome']; ?></option>
		     			<?php } ?>
		     		</select></p>
				</div>
	            <div class="form-group">
					<label for="valor">Resultado (1 ou 0)</label>
					<input class="form-control" name="valor" value="1" required>
					<p class=espaco></p>
				</div>
				<div class="form-group">
					<p><button class="btn btn-primary" name="confirmar" type="submit" id="confirmarpalpite">Aplicar</button></p>
				</div>
			</form>
		</div>
		
	
	<?php include_once("view/footer.php"); ?>
