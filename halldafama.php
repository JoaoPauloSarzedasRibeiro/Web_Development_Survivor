<?php 

 if (!isset($_SESSION))
			session_start();

	include_once("view/header.php");
	include("conexao/conexao.php");


	// carregando a tabela de usuários
	$sql_code_class = "SELECT * FROM tgoats ORDER BY goat_podios DESC";
	$sql_query_class = $mysqli->query($sql_code_class) or die($mysqli->error);



?>


<section>


<body style="background-color: #eee;">
	

	<div id="listahall" class="container">
		
		<div class="row text-center">
			<h2>Hall da Fama</h2>
			<hr>
		</div>
	</div>



		<?php while ($user = $sql_query_class->fetch_array()) { ?>

		<div class="tabhall container">
			<table id="tab-hall" class="table table-bordered">
	                   <tr>
	                   		<td colspan="2" class="text-center negrito" style="font-size: 20px;  padding-top: 10px;"><i class="fas fa-star"></i> Campeão Peso por Peso <i class="fas fa-star"></i></td>
	                   	</tr>
	                   <tr>
	                   		<td colspan="2" class="text-center negrito" style="font-size: 20px; color: #FFB612; padding-top: 10px;"><?php echo $user['goat_nome']; ?></td>
	                   	</tr>
	                   	<tr>
	                   		<td style="width: 120px"><img style="height: 130px; width: 100px; position: relative; top: 15px;	 border-radius: 35px" src="img/goats/<?php echo $user['goat_nome']; ?>.png" alt="<?php echo $user['goat_nome']; ?>"><img src="img/iconestimes/<?php echo $user['goat_time']; ?>.png" style="width:40px;height:40px;position: relative; left: 38px; top: -7px"></td>
	                   	
<!-- 	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Cidade:</td>
	                   		<td class="text-center" style="text-align: left;"><?php echo $user['goat_cidade']; ?></td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Time do coração:</td>
	                   		<td class="text-center" style="text-align: left;"><?php echo $user['goat_time']; ?></td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Temporadas jogadas:</td>
	                   		<td class="text-center" style="text-align: left;"><?php echo $user['goat_temporadas']; ?></td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Aparições no pódio:</td>
	                   		<td class="text-center" style="text-align: left;"><?php echo $user['goat_podios']; ?></td>
	                   	</tr> -->
	                   
	                   		
	                   		<td colspan="1" class="text-center" style="text-align: center; font-size: 20px;">
	                   		
	                   		<?php if($user['goat_2020_2']==1){
		                   		echo "<img src='img/ouro.png' style='width:30px;height:40px;'>  1º lugar 2020.2<br>";
		                   	} ?>
		                   	<?php if($user['goat_2020_2']==2){
		                   		echo "<img src='img/prata.png' style='width:30px;height:40px;'>  2º lugar 2020.2<br>";
		                   	} ?>
		                   	<?php if($user['goat_2020_2']==3){
		                   		echo "<img src='img/bronze.png' style='width:30px;height:40px;'>  3º lugar 2020.2<br>";
		                   	} ?>

	                   		<?php if($user['goat_2020_1']==1){
		                   		echo "<img src='img/ouro.png' style='width:30px;height:40px;'>  1º lugar 2020.1<br>";
		                   	} ?>
		                   	<?php if($user['goat_2020_1']==2){
		                   		echo "<img src='img/prata.png' style='width:30px;height:40px;'>  2º lugar 2020.1<br>";
		                   	} ?>
		                   	<?php if($user['goat_2020_1']==3){
		                   		echo "<img src='img/bronze.png' style='width:30px;height:40px;'>  3º lugar 2020.1<br>";
		                   	} ?>

	                   		<?php if($user['goat_2019_2']==1){
		                   		echo "<img src='img/ouro.png' style='width:30px;height:40px;'>  1º lugar 2019.2<br>";
		                   	} ?>
		                   	<?php if($user['goat_2019_2']==2){
		                   		echo "<img src='img/prata.png' style='width:30px;height:40px;'>  2º lugar 2019.2<br>";
		                   	} ?>
		                   	<?php if($user['goat_2019_2']==3){
		                   		echo "<img src='img/bronze.png' style='width:30px;height:40px;'>  3º lugar 2019.2<br>";
		                   	} ?>

	                   		<?php if($user['goat_2019_1']==1){
		                   		echo "<img src='img/ouro.png' style='width:30px;height:40px;'>  1º lugar 2019.1<br>";
		                   	} ?>
		                   	<?php if($user['goat_2019_1']==2){
		                   		echo "<img src='img/prata.png' style='width:30px;height:40px;'>  2º lugar 2019.1<br>";
		                   	} ?>
		                   	<?php if($user['goat_2019_1']==3){
		                   		echo "<img src='img/bronze.png' style='width:30px;height:40px;'>  3º lugar 2019.1<br>";
		                   	} ?>

		                   	<?php if($user['goat_2018_2']==1){
		                   		echo "<img src='img/ouro2.png' style='width:30px;height:40px;'>  1º lugar 2018.2<br>";
		                   	} ?>
		                   	<?php if($user['goat_2018_2']==2){
		                   		echo "<img src='img/prata2.png' style='width:30px;height:40px;'>  2º lugar 2018.2<br>";
		                   	} ?>
		                   	<?php if($user['goat_2018_2']==3){
		                   		echo "<img src='img/bronze2.png' style='width:30px;height:40px;'>  3º lugar 2018.2<br>";
		                   	} ?>

		                   	<?php if($user['goat_2017_2']==1){
		                   		echo "<img src='img/ouro3.png' style='width:30px;height:40px;'>  1º lugar 2017.2<br>";
		                   	} ?>
		                   	<?php if($user['goat_2017_2']==2){
		                   		echo "<img src='img/prata3.png' style='width:30px;height:40px;'>  2º lugar 2017.2<br>";
		                   	} ?>
		                   	<?php if($user['goat_2017_2']==3){
		                   		echo "<img src='img/bronze3.png' style='width:30px;height:40px;'>  3º lugar 2017.2<br>";
		                   	} ?>

	                   		</td>
	                   	</tr>

				</table>
			</div>

		             <?php } ?>
		</div>

<button class="accordion">Temporada 2020.2</button>
	<div class="panel">
		<div class="tabhall container">
			<table id="tab-hall" class="table table-bordered">
	                   <tr>
	                   		<td rowspan="5" style="padding: 15px; width: 120px"><img style="height: 130px; width: 100px; position: relative; top: 15px;	 border-radius: 35px" src="img/halldafama/leandrostudart.png" alt="leandrostudart"><img src="img/iconestimes/Botafogo.png" style="width:40px;height:40px;position: relative; left: 38px; top: -7px"></td>
	                   		<td colspan="2" class="text-center negrito" style="font-size: 20px; color: #f1c40f"><i class="fas fa-trophy"></i>     Leandro Studart</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Vitórias (fora de casa):</td>
	                   		<td class="text-center" style="text-align: left;">14 (5)</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Empates:</td>
	                   		<td class="text-center" style="text-align: left;">4</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Derrotas:</td>
	                   		<td class="text-center" style="text-align: left;">1</td>
	                   	</tr>


			</table>
		</div>

		<div class="tabhall container">
			<table id="tab-hall" class="table table-bordered">
	                   <tr>
	                   		<td rowspan="5" style="padding: 15px; width: 120px"><img style="height: 130px; width: 100px; position: relative; top: 15px;	 border-radius: 35px" src="img/halldafama/fernanda.png" alt="fernanda"><img src="img/iconestimes/Flamengo.png" style="width:40px;height:40px;position: relative; left: 38px; top: -7px"></td>
	                   		<td colspan="2" class="text-center negrito" style="font-size: 20px; color: #7f8fa6"><i class="fas fa-trophy"></i> Fernanda Bottino</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Vitórias (fora de casa):</td>
	                   		<td class="text-center" style="text-align: left;">12 (1)</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Empates:</td>
	                   		<td class="text-center" style="text-align: left;">5</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Derrotas:</td>
	                   		<td class="text-center" style="text-align: left;">2</td>
	                   	</tr>


			</table>
		</div>

		<div class="tabhall container">
		<table id="tab-hall" class="table table-bordered">
                   <tr>
                   		<td rowspan="5" style="padding: 15px; width: 120px"><img style="height: 130px; width: 100px; position: relative; top: 15px;	 border-radius: 35px" src="img/halldafama/igorchaves.jpg" alt="igorchaves"><img src="img/iconestimes/Flamengo.png" style="width:40px;height:40px;position: relative; left: 38px; top: -7px"></td>
                   		<td colspan="2" class="text-center negrito" style="font-size: 20px; color: #e58e26"><i class="fas fa-trophy"></i>     Igor Chaves</td>
                   	</tr>
                   	<tr>
                   		<td class="text-center negrito" style="text-align: left;">Vitórias (fora de casa):</td>
                   		<td class="text-center" style="text-align: left;">12 (0)</td>
                   	</tr>
                   	<tr>
                   		<td class="text-center negrito" style="text-align: left;">Empates:</td>
                   		<td class="text-center" style="text-align: left;">5</td>
                   	</tr>
                   	<tr>
                   		<td class="text-center negrito" style="text-align: left;">Derrotas:</td>
                   		<td class="text-center" style="text-align: left;">2</td>
                   	</tr>


		</table>
		</div>
	</div>




<button class="accordion">Temporada 2020.1</button>
	<div class="panel">
		<div class="tabhall container">
			<table id="tab-hall" class="table table-bordered">
	                   <tr>
	                   		<td rowspan="5" style="padding: 15px; width: 120px"><img style="height: 130px; width: 100px; position: relative; top: 15px;	 border-radius: 35px" src="img/halldafama/igorchaves.jpg" alt="igorchaves"><img src="img/iconestimes/Botafogo.png" style="width:40px;height:40px;position: relative; left: 38px; top: -7px"></td>
	                   		<td colspan="2" class="text-center negrito" style="font-size: 20px; color: #f1c40f"><i class="fas fa-trophy"></i>     Igor Chaves</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Vitórias (fora de casa):</td>
	                   		<td class="text-center" style="text-align: left;">12 (2)</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Empates:</td>
	                   		<td class="text-center" style="text-align: left;">6</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Derrotas:</td>
	                   		<td class="text-center" style="text-align: left;">1</td>
	                   	</tr>


			</table>
		</div>

		<div class="tabhall container">
			<table id="tab-hall" class="table table-bordered">
	                   <tr>
	                   		<td rowspan="5" style="padding: 15px; width: 120px"><img style="height: 130px; width: 100px; position: relative; top: 15px;	 border-radius: 35px" src="img/halldafama/tiago.jpg" alt="tiago"><img src="img/iconestimes/Flamengo.png" style="width:40px;height:40px;position: relative; left: 38px; top: -7px"></td>
	                   		<td colspan="2" class="text-center negrito" style="font-size: 20px; color: #7f8fa6"><i class="fas fa-trophy"></i>     Tiago</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Vitórias (fora de casa):</td>
	                   		<td class="text-center" style="text-align: left;">13 (0)</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Empates:</td>
	                   		<td class="text-center" style="text-align: left;">4</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Derrotas:</td>
	                   		<td class="text-center" style="text-align: left;">2</td>
	                   	</tr>


			</table>
		</div>

		<div class="tabhall container">
		<table id="tab-hall" class="table table-bordered">
                   <tr>
                   		<td rowspan="5" style="padding: 15px; width: 120px"><img style="height: 130px; width: 100px; position: relative; top: 15px;	 border-radius: 35px" src="img/halldafama/igoresende.jpg" alt="igoresende"><img src="img/iconestimes/Flamengo.png" style="width:40px;height:40px;position: relative; left: 38px; top: -7px"></td>
                   		<td colspan="2" class="text-center negrito" style="font-size: 20px; color: #e58e26"><i class="fas fa-trophy"></i>     Igo Resende</td>
                   	</tr>
                   	<tr>
                   		<td class="text-center negrito" style="text-align: left;">Vitórias (fora de casa):</td>
                   		<td class="text-center" style="text-align: left;">11 (1)</td>
                   	</tr>
                   	<tr>
                   		<td class="text-center negrito" style="text-align: left;">Empates:</td>
                   		<td class="text-center" style="text-align: left;">6</td>
                   	</tr>
                   	<tr>
                   		<td class="text-center negrito" style="text-align: left;">Derrotas:</td>
                   		<td class="text-center" style="text-align: left;">2</td>
                   	</tr>


		</table>
		</div>
	</div>















	<button class="accordion">Temporada 2019.2</button>
	<div class="panel">
		<div class="tabhall container">
			<table id="tab-hall" class="table table-bordered">
	                   <tr>
	                   		<td rowspan="5" style="padding: 15px; width: 120px"><img style="height: 130px; width: 100px; position: relative; top: 15px;	 border-radius: 35px" src="img/halldafama/joninha.png" alt="joninha"><img src="img/iconestimes/Vasco.png" style="width:40px;height:40px;position: relative; left: 38px; top: -7px"></td>
	                   		<td colspan="2" class="text-center negrito" style="font-size: 20px; color: #f1c40f"><i class="fas fa-trophy"></i>     Joninha</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Vitórias (fora de casa):</td>
	                   		<td class="text-center" style="text-align: left;">15 (5)</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Empates:</td>
	                   		<td class="text-center" style="text-align: left;">3</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Derrotas:</td>
	                   		<td class="text-center" style="text-align: left;">1</td>
	                   	</tr>


			</table>
		</div>

		<div class="tabhall container">
			<table id="tab-hall" class="table table-bordered">
	                   <tr>
	                   		<td rowspan="5" style="padding: 15px; width: 120px"><img style="height: 130px; width: 100px; position: relative; top: 15px;	 border-radius: 35px" src="img/halldafama/carloschaves.png" alt="carloschaves"><img src="img/iconestimes/Botafogo.png" style="width:40px;height:40px;position: relative; left: 38px; top: -7px"></td>
	                   		<td colspan="2" class="text-center negrito" style="font-size: 20px; color: #7f8fa6"><i class="fas fa-trophy"></i>     Carlos Chaves</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Vitórias (fora de casa):</td>
	                   		<td class="text-center" style="text-align: left;">12 (4)</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Empates:</td>
	                   		<td class="text-center" style="text-align: left;">6</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Derrotas:</td>
	                   		<td class="text-center" style="text-align: left;">1</td>
	                   	</tr>


			</table>
		</div>

		<div class="tabhall container">
		<table id="tab-hall" class="table table-bordered">
                   <tr>
                   		<td rowspan="5" style="padding: 15px; width: 120px"><img style="height: 130px; width: 100px; position: relative; top: 15px;	 border-radius: 35px" src="img/halldafama/leandrostudart.png" alt="leandrostudart"><img src="img/iconestimes/Vasco.png" style="width:40px;height:40px;position: relative; left: 38px; top: -7px"></td>
                   		<td colspan="2" class="text-center negrito" style="font-size: 20px; color: #e58e26"><i class="fas fa-trophy"></i>     Leandro Studart</td>
                   	</tr>
                   	<tr>
                   		<td class="text-center negrito" style="text-align: left;">Vitórias (fora de casa):</td>
                   		<td class="text-center" style="text-align: left;">11 (4)</td>
                   	</tr>
                   	<tr>
                   		<td class="text-center negrito" style="text-align: left;">Empates:</td>
                   		<td class="text-center" style="text-align: left;">7</td>
                   	</tr>
                   	<tr>
                   		<td class="text-center negrito" style="text-align: left;">Derrotas:</td>
                   		<td class="text-center" style="text-align: left;">1</td>
                   	</tr>


		</table>
		</div>
	</div>

	<button class="accordion">Temporada 2019.1</button>
	<div class="panel">
		<div class="tabhall container">
			<table id="tab-hall" class="table table-bordered">
	                   <tr>
	                   		<td rowspan="5" style="padding: 15px; width: 120px"><img style="height: 130px; width: 100px; position: relative; top: 15px;	 border-radius: 35px" src="img/halldafama/viniciusmoreira.png" alt="viniciusmoreira"><img src="img/iconestimes/Vasco.png" style="width:40px;height:40px;position: relative; left: 38px; top: -7px"></td>
	                   		<td colspan="2" class="text-center negrito" style="font-size: 20px; color: #f1c40f"><i class="fas fa-trophy"></i> Vinicius Moreira</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Vitórias (fora de casa):</td>
	                   		<td class="text-center" style="text-align: left;">12 (1)</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Empates:</td>
	                   		<td class="text-center" style="text-align: left;">6</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Derrotas:</td>
	                   		<td class="text-center" style="text-align: left;">1</td>
	                   	</tr>


			</table>
		</div>

		<div class="tabhall container">
			<table id="tab-hall" class="table table-bordered">
	                   <tr>
	                   		<td rowspan="5" style="padding: 15px; width: 120px"><img style="height: 130px; width: 100px; position: relative; top: 15px;	 border-radius: 35px" src="img/halldafama/fernanda.png" alt="fernanda"><img src="img/iconestimes/Flamengo.png" style="width:40px;height:40px;position: relative; left: 38px; top: -7px"></td>
	                   		<td colspan="2" class="text-center negrito" style="font-size: 20px; color: #7f8fa6"><i class="fas fa-trophy"></i> Fernanda Bottino</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Vitórias (fora de casa):</td>
	                   		<td class="text-center" style="text-align: left;">11 (0)</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Empates:</td>
	                   		<td class="text-center" style="text-align: left;">7</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Derrotas:</td>
	                   		<td class="text-center" style="text-align: left;">1</td>
	                   	</tr>


			</table>
		</div>

		<div class="tabhall container">
		<table id="tab-hall" class="table table-bordered">
                   <tr>
                   		<td rowspan="5" style="padding: 15px; width: 120px"><img style="height: 130px; width: 100px; position: relative; top: 15px;	 border-radius: 35px" src="img/halldafama/magno.png" alt="magno"><img src="img/iconestimes/Botafogo.png" style="width:40px;height:40px;position: relative; left: 38px; top: -7px"></td>
                   		<td colspan="2" class="text-center negrito" style="font-size: 20px; color: #e58e26"><i class="fas fa-trophy"></i>  Magno Sarzedas</td>
                   	</tr>
                   	<tr>
                   		<td class="text-center negrito" style="text-align: left;">Vitórias (fora de casa):</td>
                   		<td class="text-center" style="text-align: left;">14 (2)</td>
                   	</tr>
                   	<tr>
                   		<td class="text-center negrito" style="text-align: left;">Empates:</td>
                   		<td class="text-center" style="text-align: left;">3</td>
                   	</tr>
                   	<tr>
                   		<td class="text-center negrito" style="text-align: left;">Derrotas:</td>
                   		<td class="text-center" style="text-align: left;">2</td>
                   	</tr>


		</table>
		</div>
	</div>

	<button class="accordion">Temporada 2018.2</button>
	<div class="panel">
		<div class="tabhall container">
			<table id="tab-hall" class="table table-bordered">
	                   <tr>
	                   		<td rowspan="5" style="padding: 15px; width: 120px"><img style="height: 130px; width: 100px; position: relative; top: 15px;	 border-radius: 35px" src="img/halldafama/danielbottino.png" alt="danielbottino"><img src="img/iconestimes/Flamengo.png" style="width:40px;height:40px;position: relative; left: 38px; top: -7px"></td>
	                   		<td colspan="2" class="text-center negrito" style="font-size: 20px; color: #f1c40f"><i class="fas fa-trophy"></i> Daniel Bottino</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Vitórias (fora de casa):</td>
	                   		<td class="text-center" style="text-align: left;">15 (1)</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Empates:</td>
	                   		<td class="text-center" style="text-align: left;">3</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Derrotas:</td>
	                   		<td class="text-center" style="text-align: left;">1</td>
	                   	</tr>


			</table>
		</div>

		<div class="tabhall container">
			<table id="tab-hall" class="table table-bordered">
	                   <tr>
	                   		<td rowspan="5" style="padding: 15px; width: 120px"><img style="height: 130px; width: 100px; position: relative; top: 15px;	 border-radius: 35px" src="img/halldafama/douglascampos.png" alt="douglascampos"><img src="img/iconestimes/Flamengo.png" style="width:40px;height:40px;position: relative; left: 38px; top: -7px"></td>
	                   		<td colspan="2" class="text-center negrito" style="font-size: 20px; color: #7f8fa6"><i class="fas fa-trophy"></i> Douglas Campos</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Vitórias (fora de casa):</td>
	                   		<td class="text-center" style="text-align: left;">14 (1)</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Empates:</td>
	                   		<td class="text-center" style="text-align: left;">4</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Derrotas:</td>
	                   		<td class="text-center" style="text-align: left;">1</td>
	                   	</tr>


			</table>
		</div>

		<div class="tabhall container">
		<table id="tab-hall" class="table table-bordered">
                   <tr>
                   		<td rowspan="5" style="padding: 15px; width: 120px"><img style="height: 130px; width: 100px; position: relative; top: 15px;	 border-radius: 35px" src="img/halldafama/fernanda.png" alt="fernanda"><img src="img/iconestimes/Flamengo.png" style="width:40px;height:40px;position: relative; left: 38px; top: -7px"></td>
                   		<td colspan="2" class="text-center negrito" style="font-size: 20px; color: #e58e26"><i class="fas fa-trophy"></i>  Fernanda Bottino</td>
                   	</tr>
                   	<tr>
                   		<td class="text-center negrito" style="text-align: left;">Vitórias (fora de casa):</td>
                   		<td class="text-center" style="text-align: left;">15 (1)</td>
                   	</tr>
                   	<tr>
                   		<td class="text-center negrito" style="text-align: left;">Empates:</td>
                   		<td class="text-center" style="text-align: left;">2</td>
                   	</tr>
                   	<tr>
                   		<td class="text-center negrito" style="text-align: left;">Derrotas:</td>
                   		<td class="text-center" style="text-align: left;">2</td>
                   	</tr>


		</table>
		</div>
	</div>

	<button class="accordion">Temporada 2017.2</button>
	<div class="panel">
		<div class="tabhall container">
			<table id="tab-hall" class="table table-bordered">
	                   <tr>
	                   		<td rowspan="5" style="padding: 15px; width: 120px"><img style="height: 130px; width: 100px; position: relative; top: 15px;	 border-radius: 35px" src="img/halldafama/fernanda.png" alt="fernanda"><img src="img/iconestimes/Flamengo.png" style="width:40px;height:40px;position: relative; left: 38px; top: -7px"></td>
	                   		<td colspan="2" class="text-center negrito" style="font-size: 20px; color: #f1c40f"><i class="fas fa-trophy"></i> Fernanda Bottino</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Vitórias (fora de casa):</td>
	                   		<td class="text-center" style="text-align: left;">10 (3)</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Empates:</td>
	                   		<td class="text-center" style="text-align: left;">8</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Derrotas:</td>
	                   		<td class="text-center" style="text-align: left;">1</td>
	                   	</tr>


			</table>
		</div>

		<div class="tabhall container">
			<table id="tab-hall" class="table table-bordered">
	                   <tr>
	                   		<td rowspan="5" style="padding: 15px; width: 120px"><img style="height: 130px; width: 100px; position: relative; top: 15px;	 border-radius: 35px" src="img/halldafama/caiotostes.png" alt="caiotostes"><img src="img/iconestimes/Flamengo.png" style="width:40px;height:40px;position: relative; left: 38px; top: -7px"></td>
	                   		<td colspan="2" class="text-center negrito" style="font-size: 20px; color: #7f8fa6"><i class="fas fa-trophy"></i> Caio Tostes</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Vitórias (fora de casa):</td>
	                   		<td class="text-center" style="text-align: left;">11 (2)</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Empates:</td>
	                   		<td class="text-center" style="text-align: left;">6</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Derrotas:</td>
	                   		<td class="text-center" style="text-align: left;">2</td>
	                   	</tr>


			</table>
		</div>

		<div class="tabhall container">
		<table id="tab-hall" class="table table-bordered">
                   <tr>
                   		<td rowspan="5" style="padding: 15px; width: 120px"><img style="height: 130px; width: 100px; position: relative; top: 15px;	 border-radius: 35px" src="img/halldafama/douglascampos.png" alt="douglascampos"><img src="img/iconestimes/Flamengo.png" style="width:40px;height:40px;position: relative; left: 38px; top: -7px"></td>
                   		<td colspan="2" class="text-center negrito" style="font-size: 20px; color: #e58e26"><i class="fas fa-trophy"></i>  Douglas Campos</td>
                   	</tr>
                   	<tr>
                   		<td class="text-center negrito" style="text-align: left;">Vitórias (fora de casa):</td>
                   		<td class="text-center" style="text-align: left;">8 (2)</td>
                   	</tr>
                   	<tr>
                   		<td class="text-center negrito" style="text-align: left;">Empates:</td>
                   		<td class="text-center" style="text-align: left;">9</td>
                   	</tr>
                   	<tr>
                   		<td class="text-center negrito" style="text-align: left;">Derrotas:</td>
                   		<td class="text-center" style="text-align: left;">2</td>
                   	</tr>


		</table>
		</div>
	</div>

	<button class="accordion">Copa América 2019</button>
	<div class="panel">
		<div class="tabhall container">
			<table id="tab-hall" class="table table-bordered">
	                   <tr>
	                   		<td rowspan="5" style="padding: 15px; width: 120px"><img style="height: 130px; width: 100px; position: relative; top: 15px;	 border-radius: 35px" src="img/halldafama/andersonsilva.png" alt="andersonsilva"><img src="img/iconestimes/Botafogo.png" style="width:40px;height:40px;position: relative; left: 38px; top: -7px"></td>
	                   		<td colspan="2" class="text-center negrito" style="font-size: 20px; color: #f1c40f"><i class="fas fa-trophy"></i> Anderson Silva</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Pontos:</td>
	                   		<td class="text-center" style="text-align: left;">350</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Resultados Exatos:</td>
	                   		<td class="text-center" style="text-align: left;">5</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Palpites Vencedores:</td>
	                   		<td class="text-center" style="text-align: left;">14</td>
	                   	</tr>


			</table>
		</div>

		<div class="tabhall container">
			<table id="tab-hall" class="table table-bordered">
	                   <tr>
	                   		<td rowspan="5" style="padding: 15px; width: 120px"><img style="height: 130px; width: 100px; position: relative; top: 15px;	 border-radius: 35px" src="img/halldafama/caiotostes.png" alt="caiotostes"><img src="img/iconestimes/Flamengo.png" style="width:40px;height:40px;position: relative; left: 38px; top: -7px"></td>
	                   		<td colspan="2" class="text-center negrito" style="font-size: 20px; color: #f1c40f"><i class="fas fa-trophy"></i> Caio Tostes</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Pontos:</td>
	                   		<td class="text-center" style="text-align: left;">350</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Resultados Exatos:</td>
	                   		<td class="text-center" style="text-align: left;">5</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Palpites Vencedores:</td>
	                   		<td class="text-center" style="text-align: left;">14</td>
	                   	</tr>


			</table>
		</div>

		<div class="tabhall container">
		<table id="tab-hall" class="table table-bordered">
                   <tr>
                   		<td rowspan="5" style="padding: 15px; width: 120px"><img style="height: 130px; width: 100px; position: relative; top: 15px;	 border-radius: 35px" src="img/halldafama/joaoribeiro.png" alt="joaoribeiro"><img src="img/iconestimes/Botafogo.png" style="width:40px;height:40px;position: relative; left: 38px; top: -7px"></td>
                   		<td colspan="2" class="text-center negrito" style="font-size: 20px; color: #e58e26"><i class="fas fa-trophy"></i>  João Paulo</td>
                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Pontos:</td>
	                   		<td class="text-center" style="text-align: left;">340</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Resultados Exatos:</td>
	                   		<td class="text-center" style="text-align: left;">2</td>
	                   	</tr>
	                   	<tr>
	                   		<td class="text-center negrito" style="text-align: left;">Palpites Vencedores:</td>
	                   		<td class="text-center" style="text-align: left;">15</td>
	                   	</tr>


		</table>
		</div>
	</div>




</section>

<?php include_once("view/footer.php"); ?>

	<script type="text/javascript">
		var acc = document.getElementsByClassName("accordion");
		var i;

		for(i = 0; i < acc.length; i++){
			acc[i].addEventListener("click", function(){

				/* Toggle between addind and removing the active class, to highlight the panel that controls the panel */

				this.classList.toggle("active");

				/*Toggle between showing and hiding the active panel */
				var panel = this.nextElementSibling;
			    if (panel.style.maxHeight){
			      panel.style.maxHeight = null;
			    } else {
			      panel.style.maxHeight = panel.scrollHeight + "px";
			    }
			});
		}
	</script>