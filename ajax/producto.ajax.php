<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class AjaxProductos {

    public $contador;
    public $item;
    public $ruta;

    public function ajaxVistaProducto() {
        
        $datos = array(
            "valor"=>$this->valor,
            "item"=>$this->item,
            "ruta"=>$this->ruta
            );
        $respuesta = ControladorPlantilla::ctrEstiloPlantilla($datos);
        //print_r($respuesta);
        //exit;

        echo $respuesta;
    }

}

if (isset($_POST["valor"])) {
    $vista = new AjaxProductos();
    $vista -> valor = $_POST["valor"];
    $vista -> item = $_POST["item"];
    $vista -> ruta = $_POST["ruta"];
    
    $vista->ajaxVistaProducto();
}

