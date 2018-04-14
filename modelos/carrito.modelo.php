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
}
