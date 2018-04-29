<?php

class ControladorVisitas{
    /*
     * GUARDAR IP
     */
    
    static public function ctrEnviarIp($ip, $pais) {
        $tabla = "visitaspersonas";
        $visita = 1;
        
        if($pais == ""){
            $pais = "UnKnown";
        }
        $respuestaInsertarIp = ModeloVisitas::mdlGuardarNuevaIp($tabla, $ip, $pais, $visita);
        return $respuestaInsertarIp;
    }
}
