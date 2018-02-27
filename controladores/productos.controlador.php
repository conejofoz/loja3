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
    public function ctrMostrarProductos(){
        $tabla = "productos";
        $respuesta = ModeloProductos::mdlMostrarProductos($tabla);
    }
        
    
}