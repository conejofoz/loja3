<?php
    //$ip = $_SERVER['REMOTE_ADDR'];
    $ip = "249.170.168.184";
    //http://www.geoplugin.net/
    $informacionPais = file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip);
    //var_dump($informacionPais);
    $datosPais = json_decode($informacionPais);
    $pais = $datosPais->geoplugin_countryName;
    
    $enviarIp = ControladorVisitas::ctrEnviarIp($ip, $pais);
    var_dump($enviarIp);
    

?>
<!--========================================================
BREADCRUMB INFOPRODUCTO
=========================================================-->

<div class="container-fluid well well-sm">
    <div class="container">
        <div class="row">
            <ul class="breadcrumb lead">
                <h2 class="pull-right"><small>Tu eres nuestro visitante # 100</small></h2>
            </ul>
        </div>
    </div>
</div>

<!--MODULO VISITAS-->

<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md2 col-sm-4 col-xs-12 text-center">
                <h2 class="text-muted">Colombia</h2>
                <input type="text" class="knob" value="45" data-width="90" data-height="90" data-fgcolor="#0f0" data-readonly="true">
                <p class="text-muted text-center" style="font-size: 12px">50% de las visitas</p>
            </div>
        </div>
    </div>
</div>