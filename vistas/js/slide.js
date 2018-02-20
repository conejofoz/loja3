/*====================================================
variables
====================================================*/
var item = 0;
var itemPaginacion = $("#paginacion li");

/*====================================================
paginacion
====================================================*/
$("#paginacion li").click(function(){
    item = $(this).attr("item") - 1;
    movimientoSlide(item);
})



/*====================================================
avanzar
====================================================*/
function avanzar(){
    
  if(item == 3){
      item = 0;
  }  else {
      item++
  }
  movimientoSlide(item);

}


$("#slide #avanzar").click(function(){
    avanzar();
})




/*====================================================
retroceder
====================================================*/
$("#slide #retroceder").click(function(){
  if(item == 0){
      item = 3;
  }  else {
      item--
  }
  movimientoSlide(item);
})





/*====================================================
MOVIMENTO SLIDE
====================================================*/
function movimientoSlide(item){
    $("#slide ul").animate({"left": item * -100 + "%"}, 1000);
    $("#paginacion li").css({"opacity":.5});
    $(itemPaginacion[item]).css({"opacity":1});
}





/*====================================================
INTERVALO
====================================================*/
setInterval(function(){
    avanzar();
},3000)