<?php

require_once '../controladores/usuarios.controlador.php';
require_once '../modelos/usuarios.modelo.php';

class AjaxUsuarios{
    /*
     * VALIDAR EMAIL EXISTENTE
     */
    public function ajaxValidarEmail(){
        $datos = $this->validarEmail;
        
        $respuesta = ControladorUsuarios::ctrMostrarUsuario("email", $datos);
        
        echo json_encode($respuesta);
    }
}




/*
* VALIDAR EMAIL EXISTENTE
*/
if(isset($_POST["validarEmail"])){
    $valEmail = new AjaxUsuarios();
    $valEmail->validarEmail = $_POST["validarEmail"];
    $valEmail->ajaxValidarEmail();
}