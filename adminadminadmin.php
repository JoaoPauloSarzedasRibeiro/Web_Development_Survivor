<?php 

	include("conexao/conexao.php");



	//buscando rodada atual
	$sql_code_rodadaatual = "SELECT rodadaatual FROM trodadaatual LIMIT 1";
	$sql_query_rodadaatual = $mysqli->query($sql_code_rodadaatual) or die($mysqli->error);
	$rodada = $sql_query_rodadaatual->fetch_assoc();

	// carregando a lista de rodadas
	$sql_code_rodadas = "SELECT rodada_id, rodada_nome FROM trodada ORDER BY rodada_id ASC";
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
			
			if (($_SESSION['senha'] == $chaveacesso['senha_adm']) AND is_numeric($_SESSION['rodada'])) {

				$sql_code_rodadaatual = "UPDATE trodadaatual SET rodadaatual='$_SESSION[rodada]' WHERE senha_adm='$_SESSION[senha]'";
				$confirma = $mysqli->query($sql_code_rodadaatual) or die($mysqli->error);
				if($confirma){
					unset(
					$_SESSION['senha'],
					$chaveacesso['senha_adm']);
					echo "<script>alert('Rodada atualizada para: '+'$_SESSION[rodada]'+'!'); location.href='adminadminadmin.php'; </script>";
				}else{
					$erro[]=$confirma;
				}
			}else{
				echo "<script>alert('Senha/Rodada incorreta! Sai Fora!'); </script>";
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

		<div id="formAdm" class="container">
			<form method="POST">
		        <div class="form-group">
					<label for="rodada">Escolha uma rodada</label>
					<p><select class="form-control" name="rodada" id="rodada">
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
					<label for="senha">Senha</label>
					<input class="form-control" name="senha" value="" required type="password">
					<p class=espaco></p>
				</div>
				<div class="form-group">
					<p><button class="btn btn-primary" name="confirmar" type="submit" id="confirmarpalpite">Att Rodada</button></p>
				</div>
			</form>
		</div>
		
		<div class="tabclassificacao">
				<table id="tab-classificacao" class="table table-bordered">
					<thead>
						<tr>
							<th class="text-center">Configurações do Jogo</th>
						</tr>
					</thead>
					<tbody>
						<tr>
	                   		<td class="text-center negrito"><a href="attclassificacao.php">Att Classificação</a></td>
	                   	</tr>
						<tr>
	                   		<td class="text-center negrito"><a href="attresultados.php">Att Resultados</a></td>
	                   	</tr>
						<tr>
	                   		<td class="text-center negrito"><a href="removerbrancos.php">Limpar Brancos</a></td>
	                   	</tr>
						<tr>
	                   		<td class="text-center negrito"><a href="ajustepalpite.php">Ajustar Palpite</a></td>
	                   	</tr>
<!-- 						<tr>
	                   		<td class="text-center negrito"><a href="editarguru.php">Pergunta Guru</a></td>
	                   	</tr>
						<tr>
	                   		<td class="text-center negrito"><a href="resultadoguru.php">Resultado Guru</a></td>
	                   	</tr> -->
						<tr>
	                   		<td class="text-center negrito"><a href="rodadaaberta.php">A/F Rodada</a></td>
	                   	</tr>
<!-- 						<tr>
	                   		<td class="text-center negrito"><a href="fechaguru.php">A/F Guru</a></td>
	                   	</tr> -->
						<tr>
							<th class="text-center">Cadastro</th>
						</tr>
						<tr>
	                   		<td class="text-center negrito"><a href="cadastro.php">Cadastrar</a></td>
	                   	</tr>
						<tr>
	                   		<td class="text-center negrito"><a href="editarcadastro.php">Editar Cadastro</a></td>
	                   	</tr>
						<tr>
	                   		<td class="text-center negrito"><a href="resetarsenha.php">Resetar Senha</a></td>
	                   	</tr>
						<tr>
	                   		<td class="text-center negrito"><a href="uploadfoto.php">Upload Foto</a></td>
	                   	</tr>
						<tr>
							<th class="text-center">Bolão</th>
						</tr>
						<tr>
	                   		<td class="text-center negrito"><a href="bolao/bolao_admin.php">Adm Bolão</a></td>
	                   	</tr>
	                </tbody>
				</table>
		</div>
	
	<?php include_once("view/footer.php"); ?>
