/*
 * 
 * 
 * 
 */
/*===================================================================
 * AGREGAR AL CARRITO
 ================================================================== */

if(localStorage.getItem("listaProductos") != null){
    
    var listaCarrito = JSON.parse(localStorage.getItem("listaProductos"))
}

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
        
        for(var i = 0; i< selecionarDetalle.length; i++){
            
            if($(selecionarDetalle[i]).val() == ""){
                
                swal({
                    title:"Debe selecionar Talla Y Color",
                    text:"",
                    type:"warning",
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
       if(localStorage.getItem("listaProductos") == null){
           
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
})

