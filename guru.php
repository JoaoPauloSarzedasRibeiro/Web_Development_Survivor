<?php

	include("conexao/conexao.php");
	 
	// verificando sessão
	include("protect.php");
	protect4();

	// verificando se está com o campo nome, senão volta pro login
	if(!isset($_SESSION['nome'])){
				echo "location.href='login.php?codigo=11'; </script>";
	}

	//buscando guru
	$sql_code_guru = "SELECT rodada_guru FROM trodadaatual LIMIT 1";
	$sql_query_guru = $mysqli->query($sql_code_guru) or die($mysqli->error);
	$rodada_guru = $sql_query_guru->fetch_assoc();

	//buscando rodada atual
	$sql_code_rodadaatual = "SELECT rodadaatual FROM trodadaatual LIMIT 1";
	$sql_query_rodadaatual = $mysqli->query($sql_code_rodadaatual) or die($mysqli->error);
	$rodadaatual = $sql_query_rodadaatual->fetch_assoc();

	//atualizando rodada
	if($rodada_guru['rodada_guru']==0){
$rodada=$rodadaatual['rodadaatual'];
}else{
$rodada=$rodadaatual['rodadaatual']-1;
}


	//buscando a pergunta atual
	$sql_code_pergunta = "SELECT *, COUNT(pergunta_id) as contador FROM tguru_pergunta WHERE pergunta_rodada='$rodada' ORDER BY pergunta_id DESC LIMIT 1";
	$sql_query_pergunta = $mysqli->query($sql_code_pergunta) or die($mysqli->error);
	$pergunta = $sql_query_pergunta->fetch_assoc();
		
					// pegando contagem de respostas
					$sql_code_resp = "SELECT
									    COUNT(resposta_id) AS cont
									FROM tguru_respostas
									WHERE
										resposta_user='$_SESSION[nome]'
									AND
										resposta_rodada='$rodada'";
					$sql_query_resp = $mysqli->query($sql_code_resp) or die($mysqli->error);
					$cont_resp = $sql_query_resp->fetch_assoc();


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

				if($cont_resp['cont']==0){
						$sql_code = "INSERT INTO tguru_respostas (
						resposta_user,
						resposta_rodada,
						resposta_texto,
						resposta_pergunta)
						VALUES(
						'$_SESSION[nome]',
						'$rodada',
						'$_SESSION[pergunta]',
						'$pergunta[pergunta_texto]')";

						$confirma = $mysqli->query($sql_code) or die($mysqli->error);

						if($confirma){
							echo "<script> location.href='index.php?codigo=10'</script>";
						}else{
							$erro[]=$confirma;
						}
				}elseif ($cont_resp['cont']==1) {
						$sql_code = "UPDATE tguru_respostas
						SET
						resposta_texto='$_SESSION[pergunta]',
						resposta_pergunta = '$pergunta[pergunta_texto]'
						WHERE
						resposta_user='$_SESSION[nome]'
						AND
						resposta_rodada='$rodada'";
						$confirma = $mysqli->query($sql_code) or die($mysqli->error);

						if($confirma){
							echo "<script> location.href='index.php?codigo=11'</script>";
						}else{
							$erro[]=$confirma;
						}
				}
				
			}else{
				echo "<script>alert('Eita, Guerreiro! Aconteceu um erro, tente novamente!'); location.href='guru.php'; </script>";
			}

	}






?>

<?php include_once("view/header.php"); ?>

	<body>
		


	<div id="iniciorodada">
		<div class="container" id="inicio-rodada">
			<div class="row">
				<div class="col-md-12">
					<h1>Guru do Survivor</h1>
				</div>
			</div>
		</div>

	</div>


		<div id="erroPrimeiroAcesso" class="container">
			<div class="text-center">
				<?php 

					if(isset($erro) > 0)
					foreach ($erro as $msg) {
						echo "<p>$msg</p>";
					}

				?>
			</div>
		</div>

		<div id="boasvindas" class="erro container">
			<div class="text-center">
				<?php 

					if(isset($boasvindas) > 0)
					foreach ($boasvindas as $msg) {
						echo "<p>$msg</p>";
					}

				?>
			</div>
		</div>

		<div id="logoguru" class="container	">
			<img src="img/guru.png" style="height:166px;">
		</div> 
		
		
		<div id="formPrimAcesso" class="container">
			<form method="POST">
<div class="form-group">
<?php if($cont_resp['cont']>0){
echo "<br><p style='color:red'>Sua resposta já foi enviada, utilize o campo abaixo para editá-la!</p>";
} ?>
</div>
				<div class="form-group">
					<label for="nome">Vidente</label>
					<p><input class="form-control" name="nome" value="<?php echo $_SESSION['nome'] ?>" required disabled type="text"></p>
					<p class=espaco></p>
				</div>
				<div class="form-group">
					<label for="rodada">Rodada</label>
					<p><input class="form-control" name="rodada" value="<?php echo $rodada ?>" required disabled type="text"></p>
					<p class=espaco></p>
				</div>
				<div class="form-group">
					<label for="pergunta"><?php
					if ($pergunta['contador']==0) {
						?> [PERGUNTA NÃO CADASTRADA - POR FAVOR TENTE NOVAMENTE MAIS TARDE]</label>
					<p><input class="form-control"  name="pergunta" value="" required type="text" disabled="true"></p> <?php ;
					}else{
					echo $pergunta['pergunta_texto']; ?></label>
					<p><input class="form-control"  name="pergunta" value="" required type="text"></p>
					<?php } ?>
					<p class=espaco></p>
				</div>
				<div class="form-group">
					<p><button class="btn btn-primary" name="confirmar" type="submit" id="confirmarpalpite" <?php if ($pergunta['contador']==0) { ?> disabled="true" <?php } ?>>Lançar a Sorte!</button></p>
				</div>
			</form>
		</div>

	</body>

	<script>
     	window.onload = function(){
     		$('#erroPrimeiroAcesso').fadeOut(5000);} 
	</script>


<?php include_once("view/footer.php"); ?>