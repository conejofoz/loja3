<?php

require_once 'conexion.php';

class ModeloCarrito{
    /*
     * MOSTRAR TARIFAS
     */
    public static function mdlMostrarTarifas($tabla) {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
        $stmt->execute();
        return $stmt->fetch();
        $stmt->close();
    }
    
    
    
    static public function mdlNuevasCompras($tabla, $datos) {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla "
                . "id_usuario, id_producto) "
                . "VALUES(:id_usuario, :id_producto) ");
        $stmt->bindParam(":id_usuario", $datos["idUsuario"], PDO::PARAM_INT);
        $stmt->bindParam(":id_producto", $datos["idProducto"], PDO::PARAM_INT);
        $stmt->execute();
        if($stmt->execute()){
            return "ok";
        } else {
            return "error";
        }
            
       
        $stmt->close();
        $stmt = NULL;
    }
}
