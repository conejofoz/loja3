<?php

$item1 = "ruta";
$valor1 = $rutas[0];

$categoria = ControladorProductos::ctrMostrarCategorias($item1, $valor1);

var_dump($categoria);
if(!$categoria){
    $subCategoria = ControladorProductos::ctrMostrarSubCategorias($item1, $valor1);
    $item2 = "id_subcategoria";
    $valor2 = $subCategoria[0]["id"];
}else{
    $item2 = "id_categoria";
    $valor2 = $categoria["id"];
}
$ordenar = "id";
$base = 0;
$tope = 12;
$productos = ControladorProductos::ctrMostrarProductos($ordenar, $item2, $valor2, $base, $tope);
var_dump(count($productos));
if(!$productos){
    echo 'No hay productos';
}
?>