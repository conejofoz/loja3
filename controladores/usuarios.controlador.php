<?php

class ControladorUsuarios{
    
    /*
     * REGISTRO DE USUARIO
     */
    public function ctrRegistroUsuario(){
        if(isset($_POST["regUsuario"])){
            if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]*$/', $_POST["regUsuario"])&&
                    preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]*$/', $_POST["regEmail"])&&
                    preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]*$/', $_POST["regPassword"])){
            } else {
                echo '<script>'
                . 'swal({'
                        . 'title:"ERROR!",'
                        . 'text: "Error al registrar el usuario, no ser permitem caracteres especialies",'
                        . 'type:"error",'
                        . 'confirmButtonText:"Cerrar",'
                        . 'closeOnConfirm:false},'
                        . 'function(isConfirm){'
                        . 'if(isConfirm){'
                        . 'history.back();'
                        . '}'
                        . '});'
                        . '</script>';
            }
        }
        
    }
    
    
    
}