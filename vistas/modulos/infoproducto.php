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
            if ($infoProducto["tipo"] == "fisico") {
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

            <?php
            /* --==========================
              TITULO DO PRODUCTO
              ============================ */
            if ($infoProducto["oferta"] == 0) {
                if ($infoProducto["nuevo"] == 0) {


                    echo '<h1 class="text-muted text-uppercase">' . $infoProducto["titulo"] . '</h1>';
                } else {
                    echo '<h1 class="text-muted text-uppercase">' . $infoProducto["titulo"] . '
                <br>
                <small>
                    <span class="label label-warning">NUEVO</span>
                </small>
                </h1>';
                }
            } else {
                if ($infoProducto["nuevo"] == 0) {
                    echo '<h1 class="text-muted text-uppercase">' . $infoProducto["titulo"] . '
                <br>
                <small>
                    <span class="label label-warning">' . $infoProducto["descuentoOferta"] . '% off</span>
                </small>
                </h1>';
                } else {
                    echo '<h1 class="text-muted text-uppercase">' . $infoProducto["titulo"] . '
                <br>
                <small>
                    <span class="label label-warning">' . $infoProducto["descuentoOferta"] . '% off</span>
                        <span class="label label-warning">NUEVO</span>
                </small>
                </h1>';
                }
            }
            /* --==========================
              PRECIO DO PRODUCTO
              ============================ */
            if ($infoProducto["precio"] == 0) {
                echo '<h2 class="text-muted">GRATIS</h2>';
            } else {
                if ($infoProducto["precio"] == 0) {
                    echo '<h2 class="text-muted">USD ' . $infoProducto["precio"] . '</h2>';
                } else {
                    echo '<h2 class="text-muted">
                            <span>
                                <strong class="oferta">USD $' . $infoProducto["precio"] . '</strong>
                           </span>
                        </h2>
                        <span>
                            $' . $infoProducto["precioOferta"] . '
                        </span>';
                }
            }
            
            /* --==========================
              DESCRIÇÃO DO PRODUCTO
              ============================ */
            echo '<p>$' . $infoProducto["descripcion"] . '</p>';
            ?>
            
            <!--==========================
            CARACTERISTICAS DO PRODUCTO
            ============================-->
            <hr>
            <div class="form-group row">
                <?php
                    if($infoProducto["detalles"] != null){
                        
                        $detalles = json_decode($infoProducto["detalles"], true);
                        
                        if($infoProducto["tipo"] == "fisico"){
                            
                            if($detalles["Talla"] != null){
                                echo '<div class="col-md-3 col-xs-12">'
                                . '<select class="form form-control selecionarDetalle" id="selecionarTalla">'
                                        . '<option value="">Talla</option>';
                                for($i = 0; $i <= count($detalles["Talla"]); $i++){
                                    echo '<option value="'.$detalles["Talla"][$i].'">'.$detalles["Talla"][$i].'</option>';
                                }
                                echo '</select>'
                                . '</div>';
                                
                            }
                            if($detalles["Color"] != null){
                                echo '<div class="col-md-3 col-xs-12">'
                                . '<select class="form form-control selecionarColor" id="selecionarColor">'
                                        . '<option value="">Color</option>';
                                for($i = 0; $i <= count($detalles["Color"]); $i++){
                                    echo '<option value="'.$detalles["Color"][$i].'">'.$detalles["Color"][$i].'</option>';
                                }
                                echo '</select>'
                                . '</div>';
                                
                            }
                            if($detalles["Marca"] != null){
                                echo '<div class="col-md-3 col-xs-12">'
                                . '<select class="form form-control selecionarMarca" id="selecionarMarca">'
                                        . '<option value="">Marca</option>';
                                for($i = 0; $i <= count($detalles["Marca"]); $i++){
                                    echo '<option value="'.$detalles["Marca"][$i].'">'.$detalles["Marca"][$i].'</option>';
                                }
                                echo '</select>'
                                . '</div>';
                                
                            }
                            
                        } else {
                            
                        }
                        
                    }
                ?>
            </div>

            









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