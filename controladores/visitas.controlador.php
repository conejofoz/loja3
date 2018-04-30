<?php

class ControladorVisitas {
    /*
     * GUARDAR IP
     */

    static public function ctrEnviarIp($ip, $pais) {
        $tabla = "visitaspersonas";
        $visita = 1;
        $respuestaInsertarIp = null;
        $respuestaActualizarIp = null;

        if ($pais == "") {
            $pais = "UnKnown";
        }
        /*
         * BUSCAR IP EXISTENTE
         */
        $buscarIpExistente = ModeloVisitas::mdlSeleccionarIp($tabla, $ip);


        if (!$buscarIpExistente) {
            /*
             * GUARDA IP NUEVA
             */
            $respuestaInsertarIp = ModeloVisitas::mdlGuardarNuevaIp($tabla, $ip, $pais, $visita);
            //return $respuestaInsertarIp;
        } else {
            /*
             * SI LA IP EXISTE E ES OTRO DIA VOLVERLA A GUARDAR
             */
            date_default_timezone_set('America/Sao_Paulo');
            $fechaActual = date('Y-m-d');

            foreach ($buscarIpExistente as $key => $value) {
                $compararFecha = substr($value["fecha"], 0, 10);
            }
            if ($fechaActual != $compararFecha) {
                $respuestaActualizarIp = ModeloVisitas::mdlGuardarNuevaIp($tabla, $ip, $pais, $visita);
            }
        }
        if ($respuestaInsertarIp == "ok" || $respuestaActualizarIp == "ok") {
            $tablaPais = "visitaspaises";
            /*
             * SELECIONAR PAIS PARA VER SE JA EXISTE
             */
            $seleccionarPais = ModeloVisitas::mdlSeleccionarPais($tablaPais, $pais);

            if (!$seleccionarPais) {
                /* SE NO EXISTE EL PAIS AGREGAR NUEVO PAIS */
                $cantidad = 1;
                $insertarPais = ModeloVisitas::mdlInsertarPais($tablaPais, $pais, $cantidad);
            } else {
                /* SI EXISTE EL PAIS ACTUALIZAR UNA NUEVA VISITA */
                $actualizarCantidad = $seleccionarPais["cantidad"] + 1;
                $actualizarPais = ModeloVisitas::mdlActualizarPais($tablaPais, $pais, $actualizarCantidad);
            }
        }
    }

    /*
     * MOSTRAR EL TOTAL DE VISITAS
     */

    public function ctrMostrarTotalVisitas() {
        $tabla = "visitaspaises";
        $respuesta = ModeloVisitas::mdlMostrarTotalVisitas($tabla);
        return $respuesta;
    }
    
    
    /*
     * MOSTRAR LOS 6 PAISES DE VISITAS
     */

    public function ctrMostrarPaises() {
        $tabla = "visitaspaises";
        $respuesta = ModeloVisitas::mdlMostrarPaises($tabla);
        return $respuesta;
    }

}
