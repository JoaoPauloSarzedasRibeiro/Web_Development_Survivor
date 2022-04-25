<?php 

 if (!isset($_SESSION))
			session_start();

	include_once("view/header.php");
	include("conexao/conexao.php");


	// carregando a tabela de usuarios
	$sql_code_class = "SELECT * FROM tuser ORDER BY user_nome ASC";
	$sql_query_class = $mysqli->query($sql_code_class) or die($mysqli->error);



?>


<section>


<body style="background-color: #eee;">
	

	<div id="listaguerreiros" class="container">
		
		<div class="row text-center">
			<h2>Guerreiros</h2>
			<hr>
		</div>
	</div>

		<?php while ($user = $sql_query_class->fetch_array()) {

				// carregando a tabela do nome da foto
				$sql_code_foto = "SELECT * FROM tarquivo WHERE nome='$user[user_nome]'";
				$sql_query_foto = $mysqli->query($sql_code_foto) or die($mysqli->error);
				$foto = $sql_query_foto->fetch_assoc();

		?>

		<div class="tabguerreiros container">
			<table id="tab-guerreiros" class="table table-bordered">
	                   <tr>
	                   		<td rowspan="5" style="padding: 15px; width: 120px"><img style="height: 130px; width: 100px; position: relative; top: 15px;	 border-radius: 35px" src="img/user/<?php echo $foto['nome']; ?><?php echo $foto['extensao']; ?>" alt="<?php echo $user['user_nome']; ?>"><img src="img/iconestimes/<?php echo $user['user_timedocoracao']; ?>.png" style="width:40px;height:40px;position: relative; left: 38px; top: -7px"></td>
	                   		<td colspan="2" class="text-center negrito" style="font-size: 20px; color: #FFB612"><?php echo $user['user_nome']; ?></td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Cidade:</td>
	                   		<td class="text-center" style="text-align: left;"><?php echo $user['user_cidade']; ?></td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Time do coração:</td>
	                   		<td class="text-center" style="text-align: left;"><?php echo $user['user_timedocoracao']; ?></td>
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
	                   	<tr>
	                   		<td colspan="3" class="text-center negrito"><a style="color: #FFB612;" href="historicouser.php?usuario=<?php echo $user['user_nome'];?>" class="link-tabela">Ver campanha</a>
	                   		</td>
	                   	</tr>

			</table>
		</div>

	             <?php } ?>
	</div>


</section>




<?php include_once("view/footer.php"); ?>

