/*
 * 
 * 
 * 
 */
/*===================================================================
 * AGREGAR AL CARRITO
================================================================== */

var listaCarrito = [];

$(".agregarCarrito").click(function(){
    
    var idProducto = $(this).attr("idProducto");
    var imagen = $(this).attr("imagen");
    var titulo = $(this).attr("titulo");
    var precio = $(this).attr("precio");
    var tipo = $(this).attr("tipo");
    var peso = $(this).attr("peso");
    
    /*
     * AGREGAR AL LOCAL STORAGE LOS PRODUTOS AGREGADOS AL CARRITO
     */
    
    listaCarrito.push({
        "idProducto":idProducto,
        "imagen":imagen,
        "titulo":titulo,
        "precio":precio,
        "tipo":tipo,
        "peso":peso,
        "cantidad":"1"
    });
    
    console.log("listaCarrito", listaCarrito);
    
    localStorage.setItem("listaProductos", JSON.stringify(listaCarrito));
})

