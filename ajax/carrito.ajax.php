<?php

require_once "../extensiones/paypal.controlador.php";

class AjaxCarrito {

    public $divisa;
    public $total;
    public $impuesto;
    public $envio;
    public $subtotal;
    public $tituloArray;
    public $cantidadArray;
    public $valorItemArray;
    public $idProductoArray;

    public function ajaxEnviarPaypal() {

        $datos = array(
            "divisa" => $this->divisa,
            "total" => $this->total,
            "impuesto" => $this->impuesto,
            "envio" => $this->envio,
            "subtotal" => $this->subtotal,
            "tituloArray" => $this->tituloArray,
            "cantidadArray" => $this->cantidadArray,
            "valorItemArray" => $this->valorItemArray,
            "idProductoArray" => $this->idProductoArray
        );
        $respuesta = Paypal::mdlPagoPaypal($datos);
        echo $respuesta;
    }

    /*
     * METODO PAYU
     */

    public function ajaxTraerComercioPayu() {
        $respuesta = ControladorCarrito::ctrMostrarTarifas();
        echo json_encode($respuesta);
    }

    /*
     * VERIFICAR QUE NO TENGA EL PRODUCTO ADQUIRIDO
     */

    public $idUsuario;
    public $idProducto;

    public function ajaxVerificarProducto() {
        $datos = array(
            "idUsuario" => $this->idUsuario,
            "idProducto" => $this->idProducto
        );

        $respuesta = ControladorCarrito::ctrVerificarProducto($datos);
        echo json_encode($respuesta);
    }

}

if (isset($_POST["divisa"])) {
    $paypal = new AjaxCarrito();
    $paypal->divisa = $_POST["divisa"];
    $paypal->total = $_POST["total"];
    $paypal->impuesto = $_POST["impuesto"];
    $paypal->envio = $_POST["envio"];
    $paypal->subtotal = $_POST["subtotal"];
    $paypal->tituloArray = $_POST["tituloArray"];
    $paypal->cantidadArray = $_POST["cantidadArray"];
    $paypal->valorItemArray = $_POST["valorItemArray"];
    $paypal->idProductoArray = $_POST["idProductoArray"];
    $paypal->ajaxEnviarPaypal();
}









/*
* VERIFICAR QUE NO TENGA EL PRODUCTO ADQUIRIDO
*/
if(isset($_POST["idProducto"])){
    $producto = new AjaxCarrito();
    $producto->idUsuario = $_POST["idUsuario"];
    $producto->idProductoo = $_POST["idProducto"];
    $producto->ajaxVerificarProducto();
    
}
