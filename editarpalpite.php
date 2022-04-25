<?php 
	include("conexao/conexao.php");

	// verificando sessão
	include("protect.php");
	protect2();

	// consultando rodada atual
	$sql_code_rodada = "SELECT rodadaatual FROM trodadaatual LIMIT 1";
	$sql_query_rodada = $mysqli->query($sql_code_rodada) or die($mysqli->error);
	$rodadaatual = $sql_query_rodada->fetch_assoc();

	// verificando se está com o campo nome, senão volta pro login
	if(!isset($_SESSION['nome'])){
				echo "<script>alert('Sessão expirada. Por favor faça o login novamente.'); location.href='login.php'; </script>";
	}

	// mostrando a mensagem de redirecionamento
	if(isset($_GET['codigo'])){
		if ($_GET['codigo']==1) {
			$alerta[] = "Já existe palpite para a rodada selecionada! Edite o palpite abaixo ou selecione outra rodada.";
		}
	}

	if(isset($_GET['codigo'])){
		if ($_GET['codigo']==2) {
			$sucesso[] = "Palpite realizado com sucesso. Caso necessite, você pode editá-lo abaixo!";
		}
	}

	if(isset($_GET['codigo'])){
		if ($_GET['codigo']==3) {
			$alerta[] = "Palpite excluído com sucesso!";
		}
	}

		// carregando a tabela de palpites do usuario
	$sql_code_listaPalpites = "SELECT palpite_user,palpite_rodada, palpite_time FROM tpalpite WHERE palpite_user = '$_SESSION[nome]' AND palpite_rodada>=$rodadaatual[rodadaatual] ORDER BY palpite_rodada ASC";
	$sql_query_listaPalpites = $mysqli->query($sql_code_listaPalpites) or die($mysqli->error);

	$total = $sql_query_listaPalpites->num_rows;

	if ($total == 0) {
		$alerta[] = "Ops! Você não possui nenhum palpite em aberto.";
	}
	
	
?>

<?php include_once("view/header.php"); ?>


	<body>
	


		<div id="iniciorodada">
		
			<div class="container" id="inicio-rodada">
				<div class="row">
					<div class="col-md-12">
						<h1>Palpites em Aberto</h1>
					</div>
				</div>
			</div>

		</div>

			<div id="erroPalpite" class="erro container">
				<div class="text-center">
					<?php 

						if(isset($alerta) > 0)
						foreach ($alerta as $msg) {
							echo "<p>$msg</p>";
						}

					?>
				</div>
			</div>

			<div id="sucessoPalpite" class="container">
				<div class="text-center">
					<?php 

						if(isset($sucesso) > 0)
						foreach ($sucesso as $msg) {
							echo "<p>$msg</p>";
						}

					?>
				</div>
			</div>
			
		
		<div id="listaEditarPalpites" class="container">
			
			<div class="row text-center">
				<h2>Editar Palpites</h2>
				<hr>
			</div>



			<div class="tabclassificacao">
				<table id="tab-classificacao" class="table table-bordered">
					<thead>
						<tr>
							<th class="text-center">Guerreiro(a)</th>
							<th class="text-center">Rodada</th>
							<th class="text-center">Palpite</th>
							<th class ="text-center">Ações</th>
						</tr>
					</thead>
					<tbody>
						<?php while ($listaPalpites = $sql_query_listaPalpites->fetch_array()) {?>
		                   <tr>
			                   <td class="text-center negrito"><?php echo $listaPalpites['palpite_user'];?></td>
			                   <td class="text-center negrito"><?php echo $listaPalpites['palpite_rodada'];?></td>
			                   <td class="text-center"><?php echo $listaPalpites['palpite_time'];?></td>
			                   <td class="text-center">
			                   	<a id="btn-editar" class="btn btn-editar" href="edicaopalpite.php?usuario=<?php echo $listaPalpites["palpite_user"]; ?>&rodada=<?php echo $listaPalpites["palpite_rodada"]; ?>&time=<?php echo $listaPalpites["palpite_time"]; ?>&userid=<?php echo $_SESSION["usuario"]; ?>"><i class="fa fa-pencil-square-o" id="btn-editar"></i></a>
			                   	<a  id="btn-excluir" class="btn btn-excluir" href="excluirpalpite.php?usuario=<?php echo $listaPalpites["palpite_user"]; ?>&rodada=<?php echo $listaPalpites["palpite_rodada"]; ?>&time=<?php echo $listaPalpites["palpite_time"]; ?>"><i class="far fa-trash-alt" id="btn-excluir"></i></a>
			                   </td>
		                   </tr>

	             		 <?php  } ?>

					</tbody>


				</table>
			</div>

		</div>

		<div id="opcaonovopalpite" class="container">
			<div class="btn-cinza">
				<a href="fazerpalpite.php" class="btn btn-cinza">Fazer Palpite</a>
			</div>	
		</div>

		

	<script>
     	window.onload = function(){
     		$('#erroPalpite').fadeOut(15000);
     		$('#sucessoPalpite').fadeOut(15000);} 

	</script>

	<?php include_once("view/footer.php"); ?>