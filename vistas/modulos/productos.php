<?php
$servidor = ruta::ctrRutaServidor();
?>
<!--=========================================================
BANNER
==========================================================-->
<figure class="banner">
    <img src="http://localhost/backend/vistas/img/banner/default.jpg" class="img-responsive" width="100%">

    <div class="textoBanner textoDer">
        <h1 style="color:#fff">OFERTAS ESPECIALES</h1>
        <h2 style="color:#fff"><strong>50% off</strong></h2>
        <h3 style="color:#fff">Termina em 31 de octubre</h3>
    </div>
</figure>


<!--=======================================================
BARRA DE PRODUTOS
========================================================-->
<div class="container-fluid well well-sm barraProductos">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-xs-12">
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        Ordenar Productos <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#"></a></li>
                        
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-xs-12 organizarProductos">
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-default btnGrid" id="btnGrid0">
                        <i class="fa fa-th" aria-hidden="true"></i>
                        <span class="col-xs-0 pull-right">GRID</span>
                    </button>
                    <button type="button" class="btn btn-default btnList" id="btnList0">
                        <i class="fa fa-list" aria-hidden="true"></i>
                        <span class="col-xs-0 pull-right">LISTA</span>
                    </button>
                </div>
            </div> <!--fim 12 colunas-->
        </div><!--fim row-->
    </div><!--fim container-->
</div>



<?php

if ($rutas[0] == "articulos-gratis") {
    
    $item2 = "precio";
    $valor2 = 0;
    $ordenar = "id";
    
} else if ($rutas[0] == "lo-mas-vendido") {
    
    $item2 = null;
    $valor2 = null;
    $ordenar = "ventas";
    
    
} else if ($rutas[0] == "lo-mas-visto") {
    
    $item2 = null;
    $valor2 = null;
    $ordenar = "vistas";
    
} else {
    $ordenar = "id";
    $item1 = "ruta";
    $valor1 = $rutas[0];

    $categoria = ControladorProductos::ctrMostrarCategorias($item1, $valor1);

    var_dump($categoria);

    if (!$categoria) {
        $subCategoria = ControladorProductos::ctrMostrarSubCategorias($item1, $valor1);
        $item2 = "id_subcategoria";
        $valor2 = $subCategoria[0]["id"];
        
    } else {
        $item2 = "id_categoria";
        $valor2 = $categoria["id"];
    }
}




$base = 0;
$tope = 12;
$productos = ControladorProductos::ctrMostrarProductos($ordenar, $item2, $valor2, $base, $tope);
var_dump(count($productos));
if (!$productos) {
    echo 'No hay productos';
}
?>