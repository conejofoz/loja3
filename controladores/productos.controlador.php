<?php

class ControladorProductos{
    static public function ctrMostrarCategorias($item, $valor){
        $tabla = "categorias";
        
        $respuesta = ModeloProductos::mdlMostrarCategorias($tabla, $item, $valor);
        
        return $respuesta;
    }
    
    
    
    
    static public function ctrMostrarSubCategorias($item, $valor){
        $tabla = "subcategorias";
        
        $respuesta = ModeloProductos::mdlMostrarSubCategorias($tabla, $item, $valor);
        
        return $respuesta;
    }
    
    
    
    /*
    MOSTRAR PRODUTOS
     */
    static public function ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo){
        $tabla = "productos";
        $respuesta = ModeloProductos::mdlMostrarProductos($tabla, $ordenar, $item, $valor, $base, $tope, $modo);
        return $respuesta;
    }
    
    
    /*
     * MOSTRAR INFO PRODUTO
     */
    static public function ctrMostrarInfoProducto($item, $valor){
        $tabla = "productos";
        $respuesta = ModeloProductos::mdlMostrarInfoProducto($tabla, $item, $valor);
        return $respuesta;
    }
    
    
    
    static public function ctrListarProductos($ordenar, $item, $valor){
        $tabla = "productos";
        
        
        $respuesta = ModeloProductos::mdlListarProductos($tabla, $ordenar, $item, $valor);
        return $respuesta;
    }
        
    
}