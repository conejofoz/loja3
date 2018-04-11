/*
 * 
 * 
 * 
 */
/*===================================================================
 * VISUALIZAR LOS PRODUCTOS EN LA PAGINA CARRITO DE COMPRAS
 ================================================================== */







if (localStorage.getItem("listaProductos") != null) {

    var listaCarrito = JSON.parse(localStorage.getItem("listaProductos"))
    
    listaCarrito.forEach(functionForEach);
    
    function functionForEach(item, index){
    
        $(".cuerpoCarrito").append(
    
                '<div class="row itemCarrito">'+
                    '<div class="col-sm-1 col-xs-12">'+
                        '<br>'+
                        '<center>'+
                            '<button class="btn btn-default backColor">'+
                                '<i class="fa fa-times"></i>'+
                            '</button>'+
                        '</center>'+
                    '</div>'+


                    '<div class="col-sm-1 col-xs-12">'+
                        '<figure>'+
                            '<img src="http://localhost/backend/vistas/img/productos/cursos/curso02.jpg" class="img-thumbnail">'+
                        '</figure>'+
                    '</div>'+


                    '<div class="col-sm-4 col-xs-12">'+
                        '<br>'+
                        '<p class="tituloCarritoCompra text-left">Jarra BKY-025 Azul Claro</p>'+
                    '</div>'+


                    '<div class="col-md-2 col-sm-1 col-xs-12">'+
                        '<br>'+
                        '<p class="precioCarritoCompra text-center">USD $<span>10</span></p>'+
                    '</div>'+


                   '<div class="col-md-2 col-sm3 col-xs-8">'+
                        '<br>'+
                        '<div class="col-xs-8">'+
                            '<center>'+
                                '<input type="number" class="form-control" min="1" value="1" readonly>'+
                            '</center>'+
                        '</div>'+
                    '</div>'+
                    
                    
                    '<div class="col-md2 col-sm-1 col-xs-4 text-center">'+
                        '<br>'+
                        '<p>'+
                            '<strong>USD $<span>10,00</span></strong>'+
                        '</p>'+
                    '</div>'+
                    
                    
                '</div><!-- fim item-->'+
                '<div class="clearfix"></div><hr>');
 
    }
}







/*
 * 
 * 
 * 
 */
/*===================================================================
 * AGREGAR AL CARRITO
 ================================================================== */

$(".agregarCarrito").click(function () {

    var idProducto = $(this).attr("idProducto");
    var imagen = $(this).attr("imagen");
    var titulo = $(this).attr("titulo");
    var precio = $(this).attr("precio");
    var tipo = $(this).attr("tipo");
    var peso = $(this).attr("peso");

    var agregarAlCarrito = false;

    /*
     * CAPTURAR DETALLES
     */
    if (tipo == "virtual") {

        agregarAlCarrito = true;

    } else {

        var selecionarDetalle = $(".selecionarDetalle");

        for (var i = 0; i < selecionarDetalle.length; i++) {

            if ($(selecionarDetalle[i]).val() == "") {

                swal({
                    title: "Debe selecionar Talla Y Color",
                    text: "",
                    type: "warning",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Selecionar",
                    closeOnConfirm: false
                })

            } else {

                titulo = titulo + "-" + $(selecionarDetalle[i]).val()

                agregarAlCarrito = true;
            }
        }

    }







    /*
     * AGREGAR AL LOCAL STORAGE LOS PRODUTOS AGREGADOS AL CARRITO
     */
    if (agregarAlCarrito) {

        /*
         * RECUPERAR ALMACIENAMENTO DEL LOCALSTORAGE
         */
        if (localStorage.getItem("listaProductos") == null) {

            listaCarrito = [];
        } else {

            listaCarrito.concat(localStorage.getItem("listaProductos"));
            console.log("listaCarrito", listaCarrito);
        }


        listaCarrito.push({
            "idProducto": idProducto,
            "imagen": imagen,
            "titulo": titulo,
            "precio": precio,
            "tipo": tipo,
            "peso": peso,
            "cantidad": "1"
        });

        console.log("listaCarrito", listaCarrito);

        localStorage.setItem("listaProductos", JSON.stringify(listaCarrito));
    }

    swal({
        title: "",
        text: "Se ha agregado un nuevo producto al carrito de compras!",
        type: "success",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        cancelButtonText: "Continuar comprando!",
        confirmButtonText: "Ir a mi carrito de compras",
        closeOnConfirm: false
    },
            function (isConfirm) {
                if(isConfirm){
                    window.location = rutaOculta + "carrito-de-compras";
                }
                
            })
});

