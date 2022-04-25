<?php

	include("conexao/conexao.php");

	if(isset($erro)){
		unset($erro);
	}
	 
	// Carregando lista de usuários
	$sql_code_usuarios = "SELECT user_nome FROM tuser ORDER BY user_nome";
	$sql_query_usuarios = $mysqli->query($sql_code_usuarios) or die($mysqli->error);

	// se tiver foto, carrega a foto
	if (isset($_FILES['arquivo'])){
		if (strtolower(substr($_FILES['arquivo']['name'], -4)) != "jpeg") 
			$extensao = strtolower(substr($_FILES['arquivo']['name'], -4)); //pega o texto da extensão do arquivo
		else
			$extensao = strtolower(substr($_FILES['arquivo']['name'], -5)); //pega o texto da extensão do arquivo

		$novo_nome = $_POST['nome'] . $extensao;
		$diretorio = "img/user/";

		move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome); // efetua o upload

		$sql_code_upload = "INSERT INTO tarquivo (id, nome, extensao) VALUES(null, '$_POST[nome]', '$extensao')";
		$mysqli->query($sql_code_upload) or die($mysqli->error);
	}

?>

<?php include_once("view/header.php"); ?>

	<body>
		

		<div id="iniciorodada">
		
			<div class="container" id="inicio-rodada">
				<div class="row">
					<div class="col-md-12">
						<h1>Upload de Foto</h1>
					</div>
				</div>
			</div>

		</div>

		<div id="erro" class="erro container">
			<div class="text-center">
				<?php 

					if(isset($erro) > 0)
					foreach ($erro as $msg) {
						echo "<p>$msg</p>";
					}

					if(isset($alerta) > 0)
					foreach ($alerta as $msg) {
						echo "<p>$msg</p>";
					}

				?>
			</div>
		</div>

		<div id="formLogin" class="container">
		<form action="uploadfoto.php" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label for="nome">Guerreiro(a)</label>
					<p><select class="form-control" name="nome">
						<?php while ($usuarios = $sql_query_usuarios->fetch_array()){ ?>
		         		 <option value="<?php echo $usuarios['user_nome']; ?>"><?php echo $usuarios['user_nome']; ?></option>
		     			<?php } ?>
		     		</select></p>
				</div>
				<div>
					<label for="arquivo">Foto de Perfil</label>
					<input type="file" name="arquivo">
					<p class=espaco></p>
				</div>
				<div class="form-group">
					<p><button class="btn btn-primary" name="confirmar" type="submit" id="confirmarpalpite">Cadastrar</button></p>
				</div>
			</form>
		</div>





<?php include_once("view/footer.php"); ?>

	<script>
     	window.onload = function(){
     		$('#erro').fadeOut(5000);}

	</script>