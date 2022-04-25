<?php

	include("conexao/conexao.php");
// adicionando o campo rodada
	$sql_code_rodada = "SELECT * FROM trodadaatual LIMIT 1";
	$sql_query_rodada = $mysqli->query($sql_code_rodada) or die($mysqli->error);
	$rodadaatual = $sql_query_rodada->fetch_assoc();
	$rodada = $rodadaatual['rodadaatual'] -1;
	 
// buscando a lista de times
	$sql_code_time = "SELECT * FROM ttime";
	$sql_query_time = $mysqli->query($sql_code_time) or die($mysqli->error);


// Criação da Sessão

	if(isset($_POST['confirmar'])){

		if(!isset($_SESSION))
			session_start();

	//buscando rodada da edição
		$_SESSION['rodada']=$_POST['rodada'];

	// Inserção no Banco
		if (!isset($erro)) {
			unset($valor,$chave);
			
			// Registro dos resultados no banco
			foreach($_POST as $chave => $valor) {

				if ($valor=="Vitória"){
					$sql_code_attResultado1 = "UPDATE tpalpite SET palpite_resultado='Vitória',palpite_fora=NULL WHERE palpite_time='$chave' AND palpite_rodada = $_SESSION[rodada]";
					$confirma = $mysqli->query($sql_code_attResultado1) or die($mysqli->error);
				}elseif($valor=="Derrota"){
					$sql_code_attResultado2 = "UPDATE tpalpite SET palpite_resultado='Derrota',palpite_fora=NULL WHERE palpite_time='$chave' AND palpite_rodada = $_SESSION[rodada]";
					$confirma = $mysqli->query($sql_code_attResultado2) or die($mysqli->error);
				}elseif($valor=="Indefinido"){
					$sql_code_attResultado3 = "UPDATE tpalpite SET palpite_resultado='Indefinido',palpite_fora=NULL WHERE palpite_time='$chave' AND palpite_rodada = $_SESSION[rodada]";
					$confirma = $mysqli->query($sql_code_attResultado3) or die($mysqli->error);
				}elseif($valor=="Fora"){
					$sql_code_attResultado4 = "UPDATE tpalpite SET
					palpite_resultado='Vitória',
					palpite_fora='S'
					WHERE palpite_time='$chave' AND palpite_rodada = $_SESSION[rodada]";
					$confirma = $mysqli->query($sql_code_attResultado4) or die($mysqli->error);
				}elseif($valor=="Empate"){				
					$sql_code_attResultado5 = "UPDATE tpalpite SET palpite_resultado='Empate',palpite_fora=NULL WHERE palpite_time='$chave' AND palpite_rodada = $_SESSION[rodada]";
					$confirma = $mysqli->query($sql_code_attResultado5) or die($mysqli->error);
				}
			}

			echo "<script> alert('Resultados atualizados com sucesso!'); location.href='adminadminadmin.php'; </script>";

				
		}

	}




?>

<?php include_once("view/header.php"); ?>

	<body>
		


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


		<div id="formAttResultados" class="container">
			<form method="POST">

				<div class="form-group">
					<label for="rodada">Rodada</label>
					<input class="form-control" name="rodada" value="<?php echo $rodada ?>" type="text" required>
					<p class=espaco></p>
				</div>

				<?php while ($time = $sql_query_time->fetch_array()){ ?>

				<div class="form-group">
					<label for="<?php echo $time['time_nome']; ?>"><?php echo $time['time_nome']; ?></label>
					<p><select class="form-control" name="<?php echo $time['time_nome']; ?>">
						 <option selected="selected" value="Não mudar">Não mudar</option>
		         		 <option value="Indefinido">Indefinido</option>
		         		 <option value="Vitória">Vitória</option>
		         		 <option value="Derrota">Derrota</option>
		         		 <option value="Fora">Fora</option>
		         		 <option value="Empate">Empate</option>
		     		</select></p>
				</div>

				<?php } ?>


				<div class="form-group">
					<p><button class="btn btn-primary" name="confirmar" type="submit" id="confirmarpalpite">Confirmar</button></p>
				</div>
			</form>
		</div>

	</body>



<?php include_once("view/footer.php"); ?>