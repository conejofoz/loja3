/*=============================================
 PLANTILLA
 =============================================*/

//TOOLTIP
$('[data-toggle="tooltip"]').tooltip();


$.ajax({

    url: "ajax/plantilla.ajax.php",
    success: function (respuesta) {

        //console.log(JSON.parse(respuesta).colorFondo);

        var colorFondo = JSON.parse(respuesta).colorFondo;
        var colorTexto = JSON.parse(respuesta).colorTexto;
        var barraSuperior = JSON.parse(respuesta).barraSuperior;
        var textoSuperior = JSON.parse(respuesta).textoSuperior;

        $(".backColor, .backColor a").css({"background": colorFondo,
            "color": colorTexto})

        $(".barraSuperior, .barraSuperior a").css({"background": barraSuperior,
            "color": textoSuperior})

    }


});






/*=============================================
 QUADRICULA O LISTA
 =============================================*/
/*var btnList = $(".btnList");

for(var i = 0; i < btnList.length; i++){
    $("#btnGrid"+i).click(function(){
        var numero = $(this).attr("id").substr(-1); //a variavel i se perde dentro de uma funcao
        $(".list"+numero).hide();
        $(".grid"+numero).show();
        
        // COLORIR O BOTAO SELECIONADO
        $("#btnGrid"+numero).addClass("backColor");
        //$("#btnList"+numero).removeClass("backColor");
    });
    
    $("#btnList"+i).click(function(){
        var numero = $(this).attr("id").substr(-1); //a variavel i se perde dentro de uma funcao
        $(".list"+numero).show();
        $(".grid"+numero).hide();
        
        // COLORIR O BOTAO SELECIONADO
       // $("#btnGrid"+numero).removeClass("backColor");
        $("#btnList"+numero).addClass("backColor");
    });
}*/




var btnList = $(".btnList");

for(var i = 0; i < btnList.length; i++){

	$("#btnGrid"+i).click(function(){
            

		var numero = $(this).attr("id").substr(-1);
                

		$(".list"+numero).hide();
		$(".grid"+numero).show();

		//$("#btnGrid"+numero).removeClass("btn btn-default");
		$("#btnGrid"+numero).addClass("backColor");
		//$("#btnGrid"+numero).css("background-color", "#fc510d");
		$("#btnList"+numero).removeClass("backColor");
//                var cla = $(this).attr("class");
//                alert(cla);

	})

	$("#btnList"+i).click(function(){

		var numero = $(this).attr("id").substr(-1);

		$(".list"+numero).show();
		$(".grid"+numero).hide();

		$("#btnGrid"+numero).removeClass("backColor");
		$("#btnList"+numero).addClass("backColor");

	})

}






/*=============================================
 EFECTOS CON EL SCROLL
 =============================================*/
$(window).scroll(function(){
    var scrolly = window.pageYOffset;
    
    //    APLICAR O EFEITO SOLAMENT EM DISPOSITIVOS MAIORES QUE 768PX
    if(window.matchMedia("(min-width:768px)").matches){
        if(scrollY < ($(".banner").offset().top)){
        $(".banner img").css({"margin-top":-scrolly/2+"px"})
    } else {
        scrolly = 0;
    }
    } 
})



$.scrollUp({
    scrollText:"",
    scrollSpeed:2000,
    easingType:"easeOutQuint"
});    

  
  
  
/*=============================================
 MIGAS E PÃO
 =============================================*/  
var pagActiva = $(".pagActiva").html();
if(pagActiva != null){
    var regPagActiva = pagActiva.replace(/-/g, " ");
    $(".pagActiva").html(regPagActiva);
}
