<?php

class ControladorUsuarios {
    /*
     * REGISTRO DE USUARIO
     */

    public function ctrRegistroUsuario() {
        if (isset($_POST["regUsuario"])) {
            if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["regUsuario"]) &&
                    preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["regEmail"]) &&
                    preg_match('/^[a-zA-Z0-9]+$/', $_POST["regPassword"])) {

                $encriptar = crypt($_POST["regPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                
                $encriptarEmail = md5($_POST["regEmail"]);

                $datos = array(
                    "nombre" => $_POST["regUsuario"],
                    "password" => $encriptar,
                    "email" => $_POST["regEmail"],
                    "modo" => "directo",
                    "foto" => "",
                    "verificacion" => 1,
                    "emailEncriptado" =>$encriptarEmail
                );

                $tabla = "usuarios";

                $respuesta = ModelUsuarios::mdlRegistraUsuario($tabla, $datos);

                if ($respuesta == "ok") {
                    /*
                     * VERIFICAR CORREIO ELETRONICO
                     */
                    date_default_timezone_set("America/Sao_Paulo");
                    $url = ruta::ctrRuta();
                    
                    $mail = new PHPMailer;
                    $mail->CharSet = 'UTF-8';
                    $mail->isMail();
                    $mail->setFrom('cursos@tutorialesatualcance.com', 'Tutoriales');
                    $mail->addReplyTo('cursos@tutorialesatualcance.com', 'Tutoriales');
                    $mail->Subject = "Por favor verifique su dirección de correio eletrónico";
                    $mail->addAddress($_POST["regEmail"]);
                    $mail->msgHTML('<div style="width: 100%; background: #eee; position: relative; font-family: sans-serif; padding-bottom: 40px">
                    <center>
                        <img style="padding: 20px; width: 10%" src="http://tutorialesatualcance.com/tienda/logo.png">
                    </center>
                    <div style="position: relative; margin: auto; width: 600px; background: white; padding: 20px;">
                        <center>
                            <img style="padding: 20px; width: 15%" src="http://tutorialesatualcance.com/tienda/icon-email.png">
                            <h3 style="font-weight: 100; color: #999">VERIFIQUE SU DIRECCIÓN DE CORREIO ELETRÓNICO</h3>
                            <hr style="border: 1px solid #ccc; width: 80%">
                            <h4 style="font-weight: 100; color: #999">Para comenzar a usar su cuenta de Tienda Virtual, debe confirmar su dirección de correio electrónico</h4>
                            <a href="'.$url.'verificar/'.$encriptarEmail.'" target="_blank" style="text-decoration: none">
                                <div style="line-height: 60px; background: #0aa; width: 60%; color: white">Verifique su dirección de correio electrónico</div>
                            </a>
                            <br>
                            <hr style="border: 1px solid #ccc; width: 80%">
                            <h5 style="font-weight: 100; color: #999">Si no se inscribió en esta cuenta, puede ignorar este correo eletrónico y la cuenta se eliminará.</h5>
                        </center>
                    </div>
                    </div>');
                    $envio = $mail->Send();
                    
                    if(!envio){
                        echo '<script>'
                . 'swal({'
                . 'title:"ERROR!",'
                . 'text: "Ha ocurrido un problema enviando verificación de correo electrónico a '.$_POST["regEmail"].$mail->ErrorInfo.'",'
                . 'type:"error",'
                . 'confirmButtonText:"Cerrar",'
                . 'closeOnConfirm:false},'
                . 'function(isConfirm){'
                . 'if(isConfirm){'
                . 'history.back();'
                . '}'
                . '});'
                . '</script>';
                    } else {
                        echo '<script> '
                    . 'swal({'
                    . 'title:"OK!", '
                    . 'text: "Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico ' . $_POST["regEmail"] . ' para verificar la cuenta", '
                    . 'type:"success", '
                    . 'confirmButtonText:"Cerrar", '
                    . 'closeOnConfirm:false}, '
                    . 'function(isConfirm){ '
                    . 'if(isConfirm){ '
                    . 'history.back(); '
                    . '} '
                    . '}); '
                    . '</script> ';
                    }



                    
                } else {
                    echo "erro em adicionar usuario";
                    exit;
                }
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
    
    
    
    
    /*==========================================================================
     * MOSTRAR USUARIO
    ========================================================================= */
    static public function ctrMostrarUsuario($item, $valor){
        $tabla = "usuarios";
        $respuesta = ModelUsuarios::mdlMostrarUsuario($tabla, $item, $valor);
        return $respuesta;
        
    }
    
    /*==========================================================================
     * ACTUALIZAR USUARIO
    ========================================================================= */
    static public function ctrActualizarUsuario($id, $item, $valor){
        $tabla = "usuarios";
        $respuesta = ModelUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);
        return $respuesta;
        
    }
    
    
    
    
    
    /*==========================================================================
     * INGRESO USUARIO
    ========================================================================= */
    public function ctrIngresoUsuario(){
        
        if(isset($_POST["ingEmail"])){
            
            if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["ingEmail"]) &&
                    preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])) {
                
                $encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                
                $tabla = "usuarios";
                $item = "email";
                $valor = $_POST["ingEmail"];
                
                $respuesta = ModelUsuarios::mdlMostrarUsuario($tabla, $item, $valor);
                
                
                
                if($respuesta["email"] == $_POST["ingEmail"] && $respuesta["password"] == $encriptar){
                    
                    if($respuesta["verificacion"] == 1){
                        echo '<script>'
                                . 'swal({'
                                . 'title:"NO HA VERIFICADO SU CORREO ELECTRÓNICO!",'
                                . 'text: "Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo para verificar la dirección de correo electrónico '.$respuesta[0]["email"].'!",'
                                . 'type:"warning",'
                                . 'confirmButtonText:"Cerrar",'
                                . 'closeOnConfirm:false},'
                                . 'function(isConfirm){'
                                . 'if(isConfirm){'
                                . 'history.back();'
                                . '}'
                                . '});'
                                . '</script>';
                    } else {
                        
                        $_SESSION["validarSesion"] = "ok";
                        $_SESSION["id"] = $respuesta["id"];
                        $_SESSION["nombre"] = $respuesta["nombre"];
                        $_SESSION["foto"] = $respuesta["foto"];
                        $_SESSION["email"] = $respuesta["email"];
                        $_SESSION["password"] = $respuesta["password"];
                        $_SESSION["modo"] = $respuesta["modo"];
                        
                        echo '<script> '
                             . 'window.location = localStorage.getItem("rutaActual")     '
                             . '</script> ';
                        
                    }
                    
                    
                /*====================================
                 * ERROU A SENHA OU O EMAIL
                 =====================================*/    
                } else {
                        echo '<script>'
                            . 'swal({'
                            . 'title:"ERROR AL INGRESAR!",'
                            . 'text: "Por favor revise que el email exista o la contraseña coincida con la registrada",'
                            . 'type:"error",'
                            . 'confirmButtonText:"Cerrar",'
                            . 'closeOnConfirm:false},'
                            . 'function(isConfirm){'
                            . 'if(isConfirm){'
                            . 'window.location = localStorage.getItem("rutaActual") '
                            . '}'
                            . '});'
                            . '</script>';
                    }
                
            } else {
                echo '<script>'
                . 'swal({'
                . 'title:"ERROR!",'
                . 'text: "Error al ingresar ao sistema, no ser permitem caracteres especialies",'
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
    
    
    
/*====================================
* OUVIDO CONTRASEÑA
 =====================================*/ 
 public function ctrOlvidoPassword(){
     if(isset($_POST["passEmail"])){
         if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["passEmail"])){
             /*====================================
            * GERAR UNA CONTRASEÑA ALEATORIA
            =====================================*/ 
             function generarPassword($longitud){
                 $key = "";
                 $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
                 $max = strlen($pattern)-1;
                 
                 for($i = 0; $i < $longitud; $i++){
                     $key .= $pattern{mt_rand(0,$max)};
                 }
                 return $key;
             }
             
             $nuevaPassWord = generarPassword(11);
             
             $encriptar = crypt($nuevaPassWord, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
             
             $tabla = "usuarios";
             $item1 = "email";
             $valor1 = $_POST["passEmail"];
             $respuesta1 = ModelUsuarios::mdlMostrarUsuario($tabla, $item1, $valor1);
             if($respuesta1){
                 $id = $respuesta1["id"];
                 $item2 = "password";
                 $valor2 = $encriptar;
                 $respuesta2 = ModelUsuarios::mdlActualizarUsuario($tabla, $id, $item2, $valor2);
                

                //================ 
                if ($respuesta2 == "ok") {
                    /*
                     * CAMBIO DE CONTRASEÑA
                     */
                    date_default_timezone_set("America/Sao_Paulo");
                    $url = ruta::ctrRuta();
                    
                    $mail = new PHPMailer;
                    $mail->CharSet = 'UTF-8';
                    $mail->isMail();
                    $mail->setFrom('cursos@tutorialesatualcance.com', 'Tutoriales');
                    $mail->addReplyTo('cursos@tutorialesatualcance.com', 'Tutoriales');
                    $mail->Subject = "Solicitud de nueva contraseña";
                    $mail->addAddress($_POST["passEmail"]);
                    $mail->msgHTML('<div style="width: 100%; background: #eee; position: relative; font-family: sans-serif; padding-bottom: 40px">
                            <center>
                                <img style="padding: 20px; width: 10%" src="http://tutorialesatualcance.com/tienda/logo.png">
                            </center>
                            <div style="position: relative; margin: auto; width: 600px; background: white; padding: 20px;">
                                <center>
                                    <img style="padding: 20px; width: 15%" src="http://tutorialesatualcance.com/tienda/icon-pass.png">
                                    <h3 style="font-weight: 100; color: #999">SOLICITUD DE NUEVA CONTRASEÑA</h3>
                                    <hr style="border: 1px solid #ccc; width: 80%">
                                    <h4 style="font-weight: 100; color: #999"><strong>Su nueva contraseña: </strong>'.$nuevaPassWord.'</h4>
                                    <a href="'.$url.'" target="_blank" style="text-decoration: none">
                                        <div style="line-height: 60px; background: #0aa; width: 60%; color: white">Ingrese nuevamente al sitio</div>
                                    </a>
                                    <br>
                                    <hr style="border: 1px solid #ccc; width: 80%">
                                    <h5 style="font-weight: 100; color: #999">Si no se inscribió en esta cuenta, puede ignorar este correo eletrónico y la cuenta se eliminará.</h5>
                                </center>
                            </div>
                        </div>');
                    $envio = $mail->Send();
                    
                    if(!envio){
                        echo '<script>'
                . 'swal({'
                . 'title:"ERROR!",'
                . 'text: "Ha ocurrido un problema enviando cambio de contraseña a '.$_POST["passEmail"].$mail->ErrorInfo.'",'
                . 'type:"error",'
                . 'confirmButtonText:"Cerrar",'
                . 'closeOnConfirm:false},'
                . 'function(isConfirm){'
                . 'if(isConfirm){'
                . 'history.back();'
                . '}'
                . '});'
                . '</script>';
                    } else {
                        echo '<script> '
                    . 'swal({'
                    . 'title:"OK!", '
                    . 'text: "Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico ' . $_POST["passEmail"] . ' para su cambio de contraseña", '
                    . 'type:"success", '
                    . 'confirmButtonText:"Cerrar", '
                    . 'closeOnConfirm:false}, '
                    . 'function(isConfirm){ '
                    . 'if(isConfirm){ '
                    . 'history.back(); '
                    . '} '
                    . '}); '
                    . '</script> ';
                    }
                 
                 
                 
                 
                 
                 
                 
                 
                 
                 
                }   
                 //==========
             } else {
                 echo '<script>'
                . 'swal({'
                . 'title:"ERROR!",'
                . 'text: "El correo electrónico no se no existe en el sistema!",'
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
             
             
             
         } else {
             echo '<script>'
                . 'swal({'
                . 'title:"ERROR!",'
                . 'text: "Error al enviar el correo electrónico, no se permitem caracteres especiales!",'
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
