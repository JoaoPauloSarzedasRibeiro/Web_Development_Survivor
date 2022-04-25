$(document).ready(function(){

  	$("#btn-bars").on("click", function(){
  		alert("The paragraph was clicked.");
  		$("header").toggleClass("open-menu");
  	});

});

