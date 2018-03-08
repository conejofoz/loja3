<?php
$servidor = ruta::ctrRutaServidor();
$url = ruta::ctrRuta();
?>

<!--========================================================
BREADCRUMB INFOPRODUCTO
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
INFOPRODUCTO
=========================================================-->
<div class="container-fluid infoproducto">
    <div class="container">
        <div class="row">

            <?php
            /* =================
             * VISOR DE IMAGENS
              ================= */
            $item = "ruta";
            $valor = $rutas[0];
            $infoProducto = ControladorProductos::ctrMostrarInfoProducto($item, $valor);
            if ($infoProducto["tipo"] == "fisico") {
                echo '<div class="col-md-5 col-sm-6 col-xs-12 visorImg">
                <figure class="visor">
                    <img id="lupa1" class="img-thumbnail" src="http://localhost/backend/vistas/img/multimedia/tennis-verde/img-01.jpg" alt="tennis verde 11">
                    <img id="lupa2" class="img-thumbnail" src="http://localhost/backend/vistas/img/multimedia/tennis-verde/img-02.jpg" alt="tennis verde 11">
                    <img id="lupa3" class="img-thumbnail" src="http://localhost/backend/vistas/img/multimedia/tennis-verde/img-03.jpg" alt="tennis verde 11">
                    <img id="lupa4" class="img-thumbnail" src="http://localhost/backend/vistas/img/multimedia/tennis-verde/img-04.jpg" alt="tennis verde 11">
                    <img id="lupa5" class="img-thumbnail" src="http://localhost/backend/vistas/img/multimedia/tennis-verde/img-05.jpg" alt="tennis verde 11">

                </figure>
                <div class="flexslider carousel">
                    <ul class="slides">
                        <li>
                            <img value="1"class="img-thumbnail" src="http://localhost/backend/vistas/img/multimedia/tennis-verde/img-01.jpg" alt="tennis verde 11">
                        </li>
                        <li>
                            <img value="2"class="img-thumbnail" src="http://localhost/backend/vistas/img/multimedia/tennis-verde/img-02.jpg" alt="tennis verde 11">
                        </li>
                        <li>
                            <img value="3"class="img-thumbnail" src="http://localhost/backend/vistas/img/multimedia/tennis-verde/img-03.jpg" alt="tennis verde 11">
                        </li>
                        <li>
                            <img value="4"class="img-thumbnail" src="http://localhost/backend/vistas/img/multimedia/tennis-verde/img-04.jpg" alt="tennis verde 11">
                        </li>
                        <li>
                            <img value="5"class="img-thumbnail" src="http://localhost/backend/vistas/img/multimedia/tennis-verde/img-05.jpg" alt="tennis verde 11">
                        </li>
                        <!-- items mirrored twice, total of 12 -->
                    </ul>
                </div>
            </div>';
            } else {
                /* =================
                 * VISOR DE VIDEOS
                  ================= */
                echo '<div class="col-sm-6 col-xs-12">'
                . '<iframe class="videoPresentacion" src="https://www.youtube.com/embed/N4aY6yX-MaM?rel=0&autoplay=1" width="100%" frameborder="0" allowfullscreen></iframe>'
                . '</div>';
            }
            ?>

            








            <!--==========================
            PRODUTO
            ============================-->
            
            <?php
                if($infoProducto["tipo"] == "fisico"){
                    echo '<div class="col-md-7 col-sm-6 col-xs-12">';
                } else {
                    echo '<div class="col-sm-6 col-xs-12">'; 
                }
            ?>
            
            


                <!--==========================
                CONTINUAR COMPRANDO
                ============================-->
                <div class="col-xs-6">
                    <h6>
                        <a href="javascript:history.back()" class="text-muted">
                            <i class="fa fa-reply"></i>Continuar comprando
                        </a>
                    </h6> 

                </div>
                <!--==========================
                COMPARTIR EN REDES SOCIALES
                ============================-->
                <div class="col-xs-6">
                    <h6>
                        <a href="#" class="dropdown-toggle pull-right text-muted" data-toggle="dropdown">
                            <i class="fa fa-plus"></i>Compartir
                        </a>
                        <ul class="dropdown-menu pull-right compartirRedes">
                            <li>
                                <p class="btnFacebook">
                                    <i class="fa fa-facebook"></i>
                                    Facebook
                                </p>
                            </li>
                            <li>
                                <p class="btnGoogle">
                                    <i class="fa fa-google"></i>
                                    Google
                                </p>
                            </li>
                        </ul>
                    </h6> 

                </div>

                <div class="clearfix"></div>



                <!--==========================
                ESPACIO PARA O PRODUCTO
                ============================-->







                <!--==========================
                ZONA DE LUPA
                ============================-->
                <figure class="lupa">
                    <img src="" alt="">
                </figure>
            </div>
        </div>
    </div>
</div>