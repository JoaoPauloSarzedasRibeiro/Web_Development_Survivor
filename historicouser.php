<?php 
	include_once("view/header.php");
	include("conexao/conexao.php");

	// adicionando o campo rodada
	$sql_code_rodada = "SELECT rodadaatual FROM trodadaatual LIMIT 1";
	$sql_query_rodada = $mysqli->query($sql_code_rodada) or die($mysqli->error);
	$rodadaatual = $sql_query_rodada->fetch_assoc();

	// Pegando usuario pelo GET
	$usuario = $_GET['usuario'];

	// carregando a tabela do usuario
	$sql_code_class = "SELECT * FROM tuser WHERE user_nome='$usuario'";
	$sql_query_class = $mysqli->query($sql_code_class) or die($mysqli->error);
	$user = $sql_query_class->fetch_assoc();

	// carregando a tabela do nome da foto
	$sql_code_foto = "SELECT * FROM tarquivo WHERE nome='$user[user_nome]'";
	$sql_query_foto = $mysqli->query($sql_code_foto) or die($mysqli->error);
	$foto = $sql_query_foto->fetch_assoc();


	// Buscando os palpites
	$sql_code_hist = "SELECT * FROM tpalpite WHERE palpite_rodada<'$rodadaatual[rodadaatual]' AND palpite_user='$usuario' ORDER BY `palpite_rodada` ASC";
	
	// carregando a tabela de historico
	$sql_query_hist = $mysqli->query($sql_code_hist) or die($mysqli->error);


	if ($rodadaatual['rodadaatual'] == 1) {
		$alerta[] = "Ops! Os palpites só ficarão disponíveis quando a rodada iniciar.";
	}

?>

<section>
	

	<div id="erroHistorico" class="erro container">
		<div class="text-center">
			<?php 

				if(isset($alerta) > 0)
				foreach ($alerta as $msg) {
					echo "<p>$msg</p>";
				}

			?>
		</div>
	</div>

	<div class="tabguerreiros container" style="margin-bottom: 0px; border-bottom: 0px;">
			<table id="tab-guerreiros" class="table table-bordered">
	                   <tr>
	                   		<td rowspan="4" style="padding: 15px; width: 120px"><img style="height: 130px; width: 100px; position: relative; top: 15px;	 border-radius: 35px" src="img/user/<?php echo $foto['nome']; ?><?php echo $foto['extensao']; ?>" alt="<?php echo $user['user_nome']; ?>"><img src="img/iconestimes/<?php echo $user['user_timedocoracao']; ?>.png" style="width:40px;height:40px;position: relative; left: 38px; top: -7px"></td>
	                   		<td colspan="2" class="text-center negrito" style="font-size: 20px; color: #FFB612"><?php echo $user['user_nome']; ?></td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Cidade:</td>
	                   		<td class="text-center" style="text-align: left;"><?php echo $user['user_cidade']; ?></td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Temporadas jogadas:</td>
	                   		<td class="text-center" style="text-align: left;"><?php echo $user['user_temporada']; ?></td>
	                   	</tr>
	                   	<tr>
	                   		
	                   		<td colspan="2" class="text-center" style="text-align: center;">
	                   			
	                   			<?php if($user['user_2021_1']==1){
		                   		echo "<img src='img/ouro2.png' style='width:15px;height:20px;'>  1º lugar 2021.1<br>";
		                   	} ?>
		                   	<?php if($user['user_2021_1']==2){
		                   		echo "<img src='img/prata2.png' style='width:15px;height:20px;'>  2º lugar 2021.1<br>";
		                   	} ?>
		                   	<?php if($user['user_2021_1']==3){
		                   		echo "<img src='img/bronze2.png' style='width:15px;height:20px;'>  3º lugar 2021.1<br>";
		                   	} ?>

		                   	<?php if($user['user_2020_2']==1){
		                   		echo "<img src='img/ouro.png' style='width:15px;height:20px;'>  1º lugar 2020.2<br>";
		                   	} ?>
		                   	<?php if($user['user_2020_2']==2){
		                   		echo "<img src='img/prata.png' style='width:15px;height:20px;'>  2º lugar 2020.2<br>";
		                   	} ?>
		                   	<?php if($user['user_2020_2']==3){
		                   		echo "<img src='img/bronze.png' style='width:15px;height:20px;'>  3º lugar 2020.2<br>";
		                   	} ?>
		                   			
		                   	<?php if($user['user_2020_1']==1){
		                   		echo "<img src='img/ouro2.png' style='width:15px;height:20px;'>  1º lugar 2020.1<br>";
		                   	} ?>
		                   	<?php if($user['user_2020_1']==2){
		                   		echo "<img src='img/prata2.png' style='width:15px;height:20px;'>  2º lugar 2020.1<br>";
		                   	} ?>
		                   	<?php if($user['user_2020_1']==3){
		                   		echo "<img src='img/bronze2.png' style='width:15px;height:20px;'>  3º lugar 2020.1<br>";
		                   	} ?>

		                   	<?php if($user['user_copa_2019']==1){
		                   		echo "<img src='img/copa1.png' style='width:15px;height:20px;'>  1º lugar Copa América<br>";
		                   	} ?>
		                   	<?php if($user['user_copa_2019']==2){
		                   		echo "<img src='img/copa2.png' style='width:15px;height:20px;'>  2º lugar Copa América<br>";
		                   	} ?>
		                   	<?php if($user['user_copa_2019']==3){
		                   		echo "<img src='img/copa3.png' style='width:15px;height:20px;'>  3º lugar Copa América<br>";
		                   	} ?>

	                   		<?php if($user['user_2019_2']==1){
		                   		echo "<img src='img/ouro.png' style='width:15px;height:20px;'>  1º lugar 2019.2<br>";
		                   	} ?>
		                   	<?php if($user['user_2019_2']==2){
		                   		echo "<img src='img/prata.png' style='width:15px;height:20px;'>  2º lugar 2019.2<br>";
		                   	} ?>
		                   	<?php if($user['user_2019_2']==3){
		                   		echo "<img src='img/bronze.png' style='width:15px;height:20px;'>  3º lugar 2019.2<br>";
		                   	} ?>
	                   			
	                   			<?php if($user['user_2019_1']==1){
		                   		echo "<img src='img/ouro.png' style='width:15px;height:20px;'>  1º lugar 2019.1<br>";
		                   	} ?>
		                   	<?php if($user['user_2019_1']==2){
		                   		echo "<img src='img/prata.png' style='width:15px;height:20px;'>  2º lugar 2019.1<br>";
		                   	} ?>
		                   	<?php if($user['user_2019_1']==3){
		                   		echo "<img src='img/bronze.png' style='width:15px;height:20px;'>  3º lugar 2019.1<br>";
		                   	} ?>

		                   	<?php if($user['user_2018_2']==1){
		                   		echo "<img src='img/ouro2.png' style='width:15px;height:20px;'>  1º lugar 2018.2<br>";
		                   	} ?>
		                   	<?php if($user['user_2018_2']==2){
		                   		echo "<img src='img/prata2.png' style='width:15px;height:20px;'>  2º lugar 2018.2<br>";
		                   	} ?>
		                   	<?php if($user['user_2018_2']==3){
		                   		echo "<img src='img/bronze2.png' style='width:15px;height:20px;'>  3º lugar 2018.2<br>";
		                   	} ?>

		                   	<?php if($user['user_2017_2']==1){
		                   		echo "<img src='img/ouro3.png' style='width:15px;height:20px;'>  1º lugar 2017.2<br>";
		                   	} ?>
		                   	<?php if($user['user_2017_2']==2){
		                   		echo "<img src='img/prata3.png' style='width:15px;height:20px;'>  2º lugar 2017.2<br>";
		                   	} ?>
		                   	<?php if($user['user_2017_2']==3){
		                   		echo "<img src='img/bronze3.png' style='width:15px;height:20px;'>  3º lugar 2017.2<br>";
		                   	} ?>

	                   		</td>
	                   	</tr>

			</table>
	</div>


	<div id="historicouser" class="container">
		<div class="tabclassificacao">
			<table id="tab-classificacao" class="table table-bordered">
				<thead>
					<tr>
						<th class="text-center">R</th>
						<th class="text-center">Guerreiro(a)</th>
						<th class="text-center">Palpite</th>
						<th class="text-center">Resultado</th>

					</tr>
				</thead>
				<tbody>
					<?php while ($historico = $sql_query_hist->fetch_array()) {?>
	                   <tr>
		                   <td class="text-center negrito"><?php echo $historico['palpite_rodada'];?></td>
		                   <td class="text-center negrito"><?php echo $historico['palpite_user'];?></td>
		                   <td class="text-center"><?php echo $historico['palpite_time'];?></td>
		                   <td class="text-center negrito" <?php 
		                   if($historico['palpite_resultado']=="Derrota"){
		                   		echo "style='color:#e90052'";
		                   }elseif ($historico['palpite_resultado']=="Vitória"&&$historico['palpite_fora']!="S") {
		                   		echo "style='color:#69BE28'";
		                   }elseif ($historico['palpite_resultado']=="Empate") {
		                   		echo "style='color:#002244'";
		                   }elseif ($historico['palpite_resultado']=="Indefinido") {
		                   		echo "style='color:#95a5a6'";
		                   }
		                   if($historico['palpite_fora']=="S"){
		                   		echo "style='color:#f1c40f'";
		                   }

		                   ?>

		                   ><?php

		                   if($historico['palpite_fora']=="S"){
		                   		echo "V Fora";
		                   }else{
		                   	echo $historico['palpite_resultado'];
		                   }?></td>
	                   </tr>

             		 <?php  } ?>

				</tbody>
			</table>
		</div>


	</div>


</section>

	<script>
     	window.onload = function(){
     		$('#erroHistorico').fadeOut(15000);}

	</script>

	
<?php include_once("view/footer.php"); ?>


