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
                    "foto" => "",
                    "modo" => "directo",
                    "foto" => "",
                    "verificacion" => 1,
                    "emailEncriptado" => $encriptarEmail
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
                            <a href="' . $url . 'verificar/' . $encriptarEmail . '" target="_blank" style="text-decoration: none">
                                <div style="line-height: 60px; background: #0aa; width: 60%; color: white">Verifique su dirección de correio electrónico</div>
                            </a>
                            <br>
                            <hr style="border: 1px solid #ccc; width: 80%">
                            <h5 style="font-weight: 100; color: #999">Si no se inscribió en esta cuenta, puede ignorar este correo eletrónico y la cuenta se eliminará.</h5>
                        </center>
                    </div>
                    </div>');
                    $envio = $mail->Send();

                    if (!envio) {
                        echo '<script>'
                        . 'swal({'
                        . 'title:"ERROR!",'
                        . 'text: "Ha ocurrido un problema enviando verificación de correo electrónico a ' . $_POST["regEmail"] . $mail->ErrorInfo . '",'
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

    /* ==========================================================================
     * MOSTRAR USUARIO
      ========================================================================= */

    static public function ctrMostrarUsuario($item, $valor) {
        $tabla = "usuarios";
        $respuesta = ModelUsuarios::mdlMostrarUsuario($tabla, $item, $valor);
        return $respuesta;
    }

    /* ==========================================================================
     * ACTUALIZAR USUARIO
      ========================================================================= */

    static public function ctrActualizarUsuario($id, $item, $valor) {
        $tabla = "usuarios";
        $respuesta = ModelUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);
        return $respuesta;
    }

    /* ==========================================================================
     * INGRESO USUARIO
      ========================================================================= */

    public function ctrIngresoUsuario() {

        if (isset($_POST["ingEmail"])) {

            if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["ingEmail"]) &&
                    preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])) {

                $encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $tabla = "usuarios";
                $item = "email";
                $valor = $_POST["ingEmail"];

                $respuesta = ModelUsuarios::mdlMostrarUsuario($tabla, $item, $valor);



                if ($respuesta["email"] == $_POST["ingEmail"] && $respuesta["password"] == $encriptar) {

                    if ($respuesta["verificacion"] == 1) {
                        echo '<script>'
                        . 'swal({'
                        . 'title:"NO HA VERIFICADO SU CORREO ELECTRÓNICO!",'
                        . 'text: "Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo para verificar la dirección de correo electrónico ' . $respuesta[0]["email"] . '!",'
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


                    /* ====================================
                     * ERROU A SENHA OU O EMAIL
                      ===================================== */
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

    /* ====================================
     * OUVIDO CONTRASEÑA
      ===================================== */

    public function ctrOlvidoPassword() {
        if (isset($_POST["passEmail"])) {
            if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["passEmail"])) {
                /* ====================================
                 * GERAR UNA CONTRASEÑA ALEATORIA
                  ===================================== */

                function generarPassword($longitud) {
                    $key = "";
                    $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
                    $max = strlen($pattern) - 1;

                    for ($i = 0; $i < $longitud; $i++) {
                        $key .= $pattern{mt_rand(0, $max)};
                    }
                    return $key;
                }

                $nuevaPassWord = generarPassword(11);

                $encriptar = crypt($nuevaPassWord, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $tabla = "usuarios";
                $item1 = "email";
                $valor1 = $_POST["passEmail"];
                $respuesta1 = ModelUsuarios::mdlMostrarUsuario($tabla, $item1, $valor1);
                if ($respuesta1) {
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
                                    <h4 style="font-weight: 100; color: #999"><strong>Su nueva contraseña: </strong>' . $nuevaPassWord . '</h4>
                                    <a href="' . $url . '" target="_blank" style="text-decoration: none">
                                        <div style="line-height: 60px; background: #0aa; width: 60%; color: white">Ingrese nuevamente al sitio</div>
                                    </a>
                                    <br>
                                    <hr style="border: 1px solid #ccc; width: 80%">
                                    <h5 style="font-weight: 100; color: #999">Si no se inscribió en esta cuenta, puede ignorar este correo eletrónico y la cuenta se eliminará.</h5>
                                </center>
                            </div>
                        </div>');
                        $envio = $mail->Send();

                        if (!envio) {
                            echo '<script>'
                            . 'swal({'
                            . 'title:"ERROR!",'
                            . 'text: "Ha ocurrido un problema enviando cambio de contraseña a ' . $_POST["passEmail"] . $mail->ErrorInfo . '",'
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

    /*
     * REGISTRO CON REDES SOCIALES
     */

    static public function ctrRegistroRedesSociales($datos) {
        $tabla = "usuarios";
        $item = "email";
        $valor = $datos["email"];
        $emailRepetido = false;

        $respuesta0 = ModelUsuarios::mdlMostrarUsuario($tabla, $item, $valor);

        if ($respuesta0) {
            if ($respuesta0["modo"] != $datos["modo"]) {
                echo '<script>'
                . 'swal({'
                . 'title:"ERROR!",'
                . 'text: "Error el correo electrónico ' . $datos["email"] . 'ya está registrado en el sistema con un método diferente a Google!",'
                . 'type:"error",'
                . 'confirmButtonText:"Cerrar",'
                . 'closeOnConfirm:false},'
                . 'function(isConfirm){'
                . 'if(isConfirm){'
                . 'history.back();'
                . '}'
                . '});'
                . '</script>';
                $emailRepetido = false;
            }
            $emailRepetido = true;
        } else {
            $respuesta1 = ModelUsuarios::mdlRegistraUsuario($tabla, $datos);
        }



        if ($emailRepetido || $respuesta1 == "ok") {


            $respuesta2 = ModelUsuarios::mdlMostrarUsuario($tabla, $item, $valor);

            if ($respuesta2["modo"] == "facebook") {

                session_start();

                $_SESSION["validarSesion"] = "ok";
                $_SESSION["id"] = $respuesta2["id"];
                $_SESSION["nombre"] = $respuesta2["nombre"];
                $_SESSION["foto"] = $respuesta2["foto"];
                $_SESSION["email"] = $respuesta2["email"];
                $_SESSION["password"] = $respuesta2["password"];
                $_SESSION["modo"] = $respuesta2["modo"];

                echo "ok";
            } else if ($respuesta2["modo"] == "google") {

                $_SESSION["validarSesion"] = "ok";
                $_SESSION["id"] = $respuesta2["id"];
                $_SESSION["nombre"] = $respuesta2["nombre"];
                $_SESSION["foto"] = $respuesta2["foto"];
                $_SESSION["email"] = $respuesta2["email"];
                $_SESSION["password"] = $respuesta2["password"];
                $_SESSION["modo"] = $respuesta2["modo"];

                echo "ok";
            } else {

                echo "";
            }
        }
    }

    /* =====================================================
     * ACTUALIZAR PERFIL
      ===================================================== */

    public function ctrActualizarPerfil() {

        if (isset($_POST["editarNombre"])) {
            
            /*VALIDAR IMAGEN*/
            $ruta = "";
            if(isset($_FILES["datosImagen"]["tmp_name"])){
                
                $directorio = "vistas/img/usuarios/".$_POST["idUsuario"];
                
                /*PRIMERO PREGUTAMOS SE EXISTE IMAGEN NA BD*/
                
                if(!empty($_POST["fotoUsuario"])){
                    
                    unlink($_POST["fotoUsuario"]);
                    
                } else {
                    
                    mkdir($directorio, 0755);
                    
                }
                
                /*GUARDAMOS LA IMAGEN EN EL DIRECTORIO*/
                
                $aleatorio = mt_rand(100, 999);
                
                $ruta = "vistas/img/usuarios/".$_POST["idUsuario"]."/".$aleatorio.".jpg";
                
                /*MODIFICAMOS TAMAÑO DE LA FOTO*/
                
                list($ancho, $alto) = getimagesize($_FILES["datosImagen"]["tmp_name"]);
                
                $nuevoAncho = 500;
                $nuevoAlto = 500;
                $origen = imagecreatefromjpeg($_FILES["datosImagen"]["tmp_name"]);
                $destino = imagecreatetruecolor($nuevoAlto, $nuevoAncho);
                imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                imagejpeg($destino, $ruta);
                
                
                
                
                
                
            }

            if ($_POST["editarPassword"] == "") {
                $password = $_POST["passUsuario"]; //senha oculta no formulario
            } else {
                $password = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
            }

            $datos = array(
                "nombre" => $_POST["editarNombre"],
                "email" => $_POST["editarEmail"],
                "password" => $password,
                "foto" => $ruta,
                "id" => $_POST["idUsuario"]
            );

            $tabla = "usuarios";

            $respuesta = ModelUsuarios::mdlActualizarPerfil($tabla, $datos);

            if ($respuesta == "ok") {
                
                $_SESSION["validarSesion"] = "ok";
                $_SESSION["id"] = $datos["id"];
                $_SESSION["nombre"] = $datos["nombre"];
                $_SESSION["foto"] = $datos["foto"];
                $_SESSION["email"] = $datos["email"];
                $_SESSION["password"] = $datos["password"];
                $_SESSION["modo"] = $_POST["modoUsuario"];
                
                echo '<script>'
                . 'swal({'
                . 'title:"OK!",'
                . 'text: "Su cuenta ha sido actualizada correctamente!",'
                . 'type:"success",'
                . 'confirmButtonText:"Cerrar",'
                . 'closeOnConfirm:false},'
                . 'function(isConfirm){'
                . 'if(isConfirm){'
                . 'history.back();'
                . '}'
                . '});'
                . '</script>';
            } else {
                //echo $respuesta;
                //exit;
                echo '<script>'
                . 'swal({'
                . 'title:"ERROR!",'
                . 'text: "' . $respuesta. '",'
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
    
    
    
    
    /* ==========================================================================
     * MOSTRAR COMPRAS
      ========================================================================= */

    static public function ctrMostrarCompras($item, $valor) {
        $tabla = "compras";
        $respuesta = ModelUsuarios::mdlMostrarCompras($tabla, $item, $valor);
        return $respuesta;
    }

}
