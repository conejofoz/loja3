<?php
$servidor = ruta::ctrRutaServidor();
$url = ruta::ctrRuta();
?>

<!--========================================================
BREADCRUMB OFERTAS
=========================================================-->

<div class="container-fluid well well-sm">
    <div class="container">
        <div class="row">
            <ul class="breadcrumb fondoBreadcrumb text-uppercase">
                <li>
                    <a href="">
                        <li><a href="<?php echo $url; ?>">INICIO</a></li>
                        <li class="active pagActiva"><?php echo $rutas[0]; ?></li>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>





<!--========================================================
jumbotron aviso oferta
=========================================================-->
<?php
    if(isset($rutas[1])){
        if($rutas[1] == "aviso"){
            echo '<div class="container-fluid">
                        <div class="container">
                            <div class="jumbotron">
                                <button type="button" class="close cerrarOfertas" style="margin-top: -50px;"><h1>&times;</h1>

                                </button>
                                <h1 class="text-center">Hola!</h1>
                                <p class="text-center">
                                    Tu artículo ha sido asignado a tus compras, pero antes queremos presentarte las siguintes ofertas, si no deseas ver las ofertas y continuar en el artículo que acabas de adquirir haz click en el siguiente botón:
                                    <br><br>
                                    <a href="'.$url.'perfil">
                                        <button class="btn btn-default backColor btn-lg">
                                            VER ARTICULOS COMPRADOS
                                        </button>
                                    </a>
                                    <br><br>
                                    <a href="">
                                        <button class="btn btn-default btn-lg">
                                            VER OFERTAS
                                        </button>
                                    </a>
                                </p>

                            </div>
                        </div>
                    </div>';
        }
    }

?>

<div class="container-fluid">
    <div class="container">
        <div class="row moduloOfertas">
            <?php
                /*
                 * TRAEMOS LAS OFERTAS DE CATEGORIAS
                 */
                 $item = null;
                 $valor = null;
                 date_default_timezone_set('America/Sao_Paulo');
                 $fecha = date('Y-m-d');
                 $hora = date('H:i:s');
                 $fechaActual = $fecha.' '.$hora;
                 $respuesta = ControladorProductos::ctrMostrarCategorias($item, $valor);
                 foreach ($respuesta as $key => $value) {
                     if($value["oferta"] == 1){
                        if($value["finOferta"] > $fecha){
                            $datetime1 = new DateTime($value["finOferta"]);
                            $datetime2 = new DateTime($fechaActual);
                            $interval = date_diff($datetime1, $datetime2);
                            $finOferta = $interval->format('%a');
                            var_dump($finOferta);
                            //var_dump($datetime1);
                            //var_dump($datetime2);
                            echo '<div class="col-md4 col-sm-6 col-xs-12">
                                       <div class="ofertas">
                                           <h3 class="text-center text-uppercase">
                                               OFERTA ESPECIAL EN <br> '.$value["categoria"].'!
                                           </h3>
                                           <figure>
                                               <img class="img-responsive" src="'.$servidor.$value["imgOferta"].'" width="100%">
                                               <div class="sombraSuperior"></div>';
                                                   if($value["descuentoOferta"] != 0){
                                                       echo '<h1 class="text-center text-uppercase">%'.$value["descuentoOferta"].' OFF</h1>';
                                                   } else {
                                                       echo '<h1 class="text-center text-uppercase">$'.$value["precioOferta"].'</h1>';
                                                   }


                                                   echo '</figure>
                                       </div>
                                   </div>';
                        }
                     }
                 }
            
            
            ?>
        </div>
    </div>
</div>

