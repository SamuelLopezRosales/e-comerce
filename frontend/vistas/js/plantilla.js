/*=============================================
PLANTILLA
=============================================*/
$('[data-toggle="tooltip"]').tooltip();

$.ajax({

	url:"ajax/plantilla.ajax.php",
	success:function(respuesta){

		var colorFondo = JSON.parse(respuesta).colorFondo;
		var colorTexto = JSON.parse(respuesta).colorTexto;
		var barraSuperior = JSON.parse(respuesta).barraSuperior;
		var textoSuperior = JSON.parse(respuesta).textoSuperior;

		$(".backColor, .backColor a").css({"background": colorFondo,
											"color": colorTexto})

		$(".barraSuperior, .barraSuperior a").css({"background": barraSuperior,
			                                       "color": textoSuperior})

	}


})


/***********************************************************
ESCOGER LISTA O GRID
**********************************************************/
var btnList = $(".btnList");

for(var i=0; i < btnList.length; i++){
	// el i se va a perder dentro de una funcion por eso hay que sustraerlo
	$("#btnGrid"+i).click(function(){
		// subtraego el ultimo numero
		var numero = $(this).attr("id").substr(-1);
		$(".list"+numero).hide();
		$(".grid"+numero).show();

		$("#btnGrid"+numero).addClass("backColor");
		$("#btnList"+numero).removeClass("backColor");
	});

	$("#btnList"+i).click(function(){
		var numero =$(this).attr("id").substr(-1);
		$(".grid"+numero).hide();
		$(".list"+numero).show();

		$("#btnGrid"+numero).removeClass("backColor");
		$("#btnList"+numero).addClass("backColor");
	});

}


/*******************************************************+
EFECTOS CON EL SCROLL
*********************************************************/
$(window).scroll(function(){
	var scrollY = window.pageYOffset;

	if(window.matchMedia("(min-width:768px)").matches){
		if(scrollY < ($(".banner").offset().top-150)){
			$(".banner img").css({"margin-top": -scrollY/3+"px"});
		}else{
			scrollY = 0;
		}
	}

});

$.scrollUp({
	scrollText:"",
	scrollSpeed: 2000,
	easingType: "easeOutQuint"
});

/*=============================================
MIGAS DE PAN
=============================================*/

var pagActiva = $(".pagActiva").html();

if(pagActiva != null){

	var regPagActiva = pagActiva.replace(/-/g, " ");

	$(".pagActiva").html(regPagActiva);

}