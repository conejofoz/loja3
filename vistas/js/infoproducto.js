/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//CARROSEL
$(".flexslider").flexslider({
    animation: "slide",
    controlNav: true,
    animationLoop: false,
    slideshow: false,
    itemWidth: 100,
    itemMargin: 5
});


//TROCAR IMAGEM
$(".flexslider ul li img").click(function(){
    var capturaIndice = $(this).attr("value");
    $(".infoproducto figure.visor img").hide();
    $("#lupa"+capturaIndice).show();
    
})



//EFECTO LUPA
$(".infoproducto figure.visor img").mouseover(function(event){
    var capturaImg = $(this).attr("src");
    $(".lupa img").attr("src", capturaImg);
    $(".lupa").fadeIn("fast");
    $(".lupa").css({
        "height": $(".visorImg").height()+"px",
        "background":"#eee",
        "width":"100%"
    })
})

$(".infoproducto figure.visor img").mouseout(function(event){
    $(".lupa").fadeOut("fast");
})

$(".infoproducto figure.visor img").mousemove(function(event){
    var posX = event.offsetX;
    var posY = event.offsetY;
    $(".lupa img").css({
        "margin-left":-posX+"px",
        "margin-top":-posY+"px"
    })
})

