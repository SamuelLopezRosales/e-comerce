/*=============================================
CABEZOTE
=============================================*/

$("#btnCategorias").click(function(){

	// checo el tamaño de la pantalla
	if(window.matchMedia("(max-width:767px)").matches){

		$("#btnCategorias").after($("#categorias").slideToggle("fast"))

	}else{

		$("#cabezote").after($("#categorias").slideToggle("fast"))

	}


})