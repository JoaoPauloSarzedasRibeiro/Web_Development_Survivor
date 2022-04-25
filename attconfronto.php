<?php 
	include("conexao/conexao.php");

	//iniciando sessao
	if(!isset($_SESSION)) session_start();


	// adicionando o campo rodada
	if(isset($_GET['rodada'])){
		$rodada['rodadaatual'] = $_GET['rodada'];
		}else{
	$sql_code_rodadaatual = "SELECT rodadaatual FROM trodadaatual LIMIT 1";
	$sql_query_rodadaatual = $mysqli->query($sql_code_rodadaatual) or die($mysqli->error);
	$rodada1 = $sql_query_rodadaatual->fetch_assoc();
        $rodada['rodadaatual'] = $rodada1['rodadaatual']-1;
	}

	//buscando rodada atual
	$sql_code_rodadaatual = "SELECT rodadaatual FROM trodadaatual LIMIT 1";
	$sql_query_rodadaatual = $mysqli->query($sql_code_rodadaatual) or die($mysqli->error);
	$rodadaatual = $sql_query_rodadaatual->fetch_assoc();

	// carregando a lista de rodadas
	$sql_code_rodadas = "SELECT rodada_id,rodada_nome FROM trodada";
	$sql_query_rodadas = $mysqli->query($sql_code_rodadas) or die($mysqli->error);

	// exibindo confrontos
	$sql_code_time = "SELECT confronto_mandante, confronto_visitante, confronto_data, confronto_hora FROM tconfrontos WHERE confronto_rodada='$rodada[rodadaatual]' ORDER BY confronto_data, confronto_hora";
	$sql_query_time = $mysqli->query($sql_code_time) or die ($mysqli->error);



	// Criação da Sessão


	if(isset($_POST['confirmar'])){

		if(!isset($_SESSION))
			protect();

	// Registro dos dados na sessão
		foreach($_POST as $chave => $valor) {
			$_SESSION[$chave] = $mysqli->real_escape_string($valor);			
		}

		if (strlen($_SESSION['resultado']) != 0) {


			$sql_code_attresultado = "UPDATE tconfrontos SET confronto_resultado='$_SESSION[resultado]' WHERE confronto_rodada='$_SESSION[rodadas]' AND confronto_mandante='$_SESSION[confronto]'";
			$attresultado = $mysqli->query($sql_code_attresultado) or die($mysqli->error);

			if($attresultado){
				echo "<script> location.href='attconfronto.php?rodada='+'$_SESSION[rodadas]' </script>";		
				exit();
			}else{
			echo "<script>alert('Eita, Guerreiro! Aconteceu um erro, tente novamente!'); location.href='attconfronto.php'; </script>";
			}

		}
	}
?>

<?php include_once("view/header.php"); ?>

	<body>

		<div id="loading" class="container">
			<div id="img-load">
		 	 	<img id="loading-image" src="http://mba.escolanacionaldeseguros.com.br/template/images/loading2.gif" alt="Loading..." />
			</div>
		</div>

		<div id="iniciorodada">
		
			<div class="container" id="inicio-rodada">
				<div class="row">
					<div class="col-md-12">
						<h1>Att Confronto</h1>
					</div>
				</div>
			</div>

		</div>

		<?php 

			if(isset($erro)){
				echo "<div class='erro'>";
				foreach ($erro as $valor) {
					echo "$valor<br>";
				}
				echo "</div>";
			}

			
		?>
		

		<div id="formPalpite" class="container">
			<form method="POST">
				<div class="form-group">
					<label for="rodadas">Escolha uma rodada</label>
					<p><select class="form-control" name="rodadas" id="rodadas">
						<?php while ($rodadas = $sql_query_rodadas->fetch_array()){
							if (intval($rodadas['rodada_id'])==intval($rodada['rodadaatual'])){
							?>
							<option selected="selected" value="<?php echo $rodadas['rodada_id']; ?>"><?php echo $rodadas['rodada_id']; ?></option>
						<?php }else{ ?> 
	         		 		<option value="<?php echo $rodadas['rodada_id']; ?>"><?php echo $rodadas['rodada_id'];?></option>

	     			<?php } } ?>
		     		</select></p>
		     	</div>
				<div class="form-group">
					<label for="confronto">Escolha um confronto</label>
					<p><select class="form-control" name="confronto">
						<?php while ($confronto = $sql_query_time->fetch_array()){ ?>
		         		 <option value="<?php echo $confronto['confronto_mandante']; ?>"><?php echo $confronto['confronto_mandante']; ?> x <?php echo $confronto['confronto_visitante']; ?></option>
		     			<?php } ?>
		     		</select></p>
		     	</div>
				<div class="form-group">
					<label for="resultado">Resultado</label>
					<input class="form-control" name="resultado" value=" " type="text">
				</div>
					<p><button class="btn btn-primary" name="confirmar" type="submit" id="confirmarpalpite">Atualizar</button></p>
			</form>
		</div>


					</table>
			</div>

		<div id="resultadosAttConfrontos" class="container">
			<div class="row text-center">
				<h2>RESULTADOS AO VIVO</h2>
				<hr>	
			</div>
			


			<div id="tabJogosRodada">
				<iframe frameborder="0"  scrolling="no" width="350" height="440" src="https://www.fctables.com/brazil/serie-a/iframe/?type=league-scores&lang_id=12&country=29&template=182&team=180615&timezone=America/Sao_Paulo&time=24&width=350&height=440&font=Verdana&fs=12&lh=14&bg=FFFFFF&fc=333333&logo=1&tlink=0&scoreb=002244&scorefc=FFFFFF&sgdcoreb=69BE28&sgdcorefc=FFFFFF&sh=1&hfb=1&hbc=002244&hfc=ffffff"></iframe><div style="text-align:center;"></div>
			</div>


		</div>

	</div>
	</div>




	<?php include_once("view/footer.php"); ?>

	<script>
     	window.onload = function(){ document.getElementById("loading").style.display = "none" } 
	</script>




	<script>
		$(document).ready(function(){

				$("#rodadas").on("change", function(){
					$rodadaSelected = rodadas.options[rodadas.selectedIndex].value;
					location.href="attconfronto.php?rodada="+$rodadaSelected;	
				});

		});
	</script>