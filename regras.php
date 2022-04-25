<?php 

 	if (!isset($_SESSION))
			session_start();


	include_once("view/header.php");
	include("conexao/conexao.php");

?>

<section>
	


	<div id="iniciorodada">
		<div class="container" id="inicio-rodada">
			<div class="row">
				<div class="col-md-12">
					<h1>Regras e Premiação</h1>
				</div>
			</div>
		</div>

	</div>


	<div id="Regras1" class="container">

		<div class="row text-center">
			<h2>Sobre o Survivor</h2>
			<hr>
		</div>
		
		<div class="container">
			<div class="row">
					<p>O Survivor é um jogo de estratégia e sobrevivência baseado no Brasileirão Série A, tendo uma edição para cada turno do campeonato.</p>
					<p>No jogo, cada participante inicia com 5 vidas e em cada rodada deverá escolher um (somente um) time que ele acredita que vencerá. Caso o time perca, o participante perderá uma das suas vidas, caso vença ou empate o participante acumulará pontos que servirão de critérios de desempate.</p>
<!-- 					<p>Além de palpitar em algum time, uma vez por rodada cada participante poderá acessar a área do "Guru do Survivor" no menu e tentar acertar a resposta de uma pergunta aleatória. Cada acerto contará como 1 ponto de desempate ao fim da competição.</p> -->
					<p>Ao fim das 19 rodadas de cada turno, o jogador com o maior número de vidas e vitórias será consagrado o CAMPEÃO do Survivor!</p>
					<p>Ah, duas coisas: cada participante poderá escolher cada time somente uma vez, ou seja, pensando pelo lado positivo, quem escolher o Vasco na primeira rodada nunca mais poderá utilizá-lo. Além disto, se o participante perder todas as vidas ele terá que assistir o resto da brincadeira do banco de reservas.</p></p>
					
					<h2>Premiação</h2>
					<hr>
					<p><a id="trofeu1" class="trofeu1"><i class="fas fa-medal" aria-hidden="true"></i></a>	1º Lugar: 40% do valor arrecadado. </p>
					<p><a id="trofeu2" class="trofeu1"><i class="fas fa-medal" aria-hidden="true"></i></a>	2º Lugar: 25% do valor arrecadado. </p>
					<p><a id="trofeu3" class="trofeu1"><i class="fas fa-medal" aria-hidden="true"></i></a>	3º Lugar: 15% do valor arrecadado. </p>
					<p><a id="trofeu3" class="trofeu1"><i class="fas fa-medal" aria-hidden="true"></i></a>	4º Lugar: 10% do valor arrecadado. </p>
					<p><a id="trofeu3" class="trofeu1"><i class="fas fa-medal" aria-hidden="true"></i></a>	5º Lugar: 10% do valor arrecadado. </p>




					<h2>Regras</h2>
					<hr>
					
					</p>
					<p><i id="bolinha" class="fa fa-futbol-o" aria-hidden="true"></i> Cada participante inicia a competição com 5 vidas.</p>
					<p><i id="bolinha" class="fa fa-futbol-o" aria-hidden="true"></i> Até o horário de início de cada rodada, cada participante deverá realizar um palpite em algum time de sua base de times disponíveis. Caso o palpite não seja realizado até o início da rodada, o participante poderá enviar um palpite de um jogo do dia seguinte para o administrador (João Paulo), que fará o ajuste no sistema. Em caso de não palpite o participante perderá 1 vida automaticamente.</p>
					<p><i id="bolinha" class="fa fa-futbol-o" aria-hidden="true"></i> Cada time só poderá ser escolhido por cada participante uma única vez durante todo o turno.</p>
					<p><i id="bolinha" class="fa fa-futbol-o" aria-hidden="true"></i> O participante cujo time escolhido perder, perderá uma vida.</p>
					<p><i id="bolinha" class="fa fa-futbol-o" aria-hidden="true"></i> O participante cujo time escolhido ganhar/empatar não perderá vida e acumulará uma vitória/empate.</p>
					<p><i id="bolinha" class="fa fa-futbol-o" aria-hidden="true"></i> Os participantes têm a opção de registrar o palpite das próximas duas rodadas, porém só serão considerados os palpites após o início da rodada em questão.</p>
					<p><i id="bolinha" class="fa fa-futbol-o" aria-hidden="true"></i> A classificação da competição tem como principal critério o número de vidas, seguido de quantidade de vitórias, empates e vitórias fora de casa.</p>
					<p><i id="bolinha" class="fa fa-futbol-o" aria-hidden="true"></i> Se um jogo for adiado, por motivo de agenda ou solicitação do clube ou da CBF, nenhum palpite será modificado e o resultado será registrado após a realização da partida.</p>

					<h2>Colaboração</h2>
					<hr>

					<p><i id="bolinha" class="fa fa-money" aria-hidden="true"></i> Para participar da competição, cada jogador deverá contribuir com a quantia de R$50. Deste valor, R$45 são destinados à premiação e R$5 à manutenção do sistema online.</p>



			</div>
		</div>

	</div>



</section>

	<script>
     	window.onload = function(){
     		$('#sucessoLogin').fadeOut(5000);
     } 
	</script>


<?php include_once("view/footer.php"); ?>