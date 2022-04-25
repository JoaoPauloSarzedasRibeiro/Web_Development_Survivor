<?php 

 	if (!isset($_SESSION))
			session_start();


	include_once("view/header.php");
	include("conexao/conexao.php");

?>

<section>



	<div id="bannerFim" class="container">
	</div>

	<div id="msg-fim" class="container">
			<div class="row">
					<p id="pbold">Obrigado pela sua participação, Guerreiro(a)!</p>
					<p>Conto contigo na próxima edição do SURVIVOR DA GALERA!</p>
					<p>Utilize o menu acima para continuar acompanhando a competição.</p>
					<p id="pbold">Valeu!</p>
			</div>
	</div>


</section>

	<script>
     	window.onload = function(){
     		$('#sucessoLogin').fadeOut(5000);
     } 
	</script>


<?php include_once("view/footer.php"); ?>