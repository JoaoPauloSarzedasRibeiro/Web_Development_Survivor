<footer>
		

			<div class="row row-cinza-escuro">
				
				<div class="container copyright-mobile">
					
					<p style="font-weight: bold; font-size: 15px;"><a href="index.php" style="color: #fff;">survivordagalera.com.br</a></p>
					<p style="font-size: 10px;">© Copyright 2017 | João Paulo Ribeiro</p>

				</div>

			</div>





	</footer>

	<script src="lib/jquery/jquery.min.js"></script>
	<script src="lib/owl.carousel/owl-carousel/owl.carousel.min.js"></script>
	<script src="lib/bootstrap/js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function(){

				$("#btn-bars").on("click", function(){
					$("header").toggleClass("open-menu");
				});

				$("#menu-mobile-mask, .btn-close").on("click", function(){
					$("header").removeClass("open-menu");
				});

		});
	</script>

	</body>
</html>