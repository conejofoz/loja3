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
            $multimedia = json_decode($infoProducto["multimedia"], true);
            //var_dump($infoProducto["multimedia"]);
            //var_dump($multimedia[0]["foto"]);
            //exit;
            if ($infoProducto["tipo"] == "fisico") {
                echo '<div class="col-md-5 col-sm-6 col-xs-12 visorImg">
                <figure class="visor">';
                for ($i = 0; $i < count($multimedia); $i++) {
                    echo '<img id="lupa' . ($i + 1) . '" class="img-thumbnail" src="' . $servidor . $multimedia[$i]["foto"] . '">';
                }

                echo '</figure>
                <div class="flexslider carousel">
                    <ul class="slides">';

                for ($i = 0; $i < count($multimedia); $i++) {
                    echo '<li>
                            <img value="' . ($i + 1) . '"class="img-thumbnail" src="' . $servidor . $multimedia[$i]["foto"] . '" alt="' . $infoProducto["titulo"] . '">
                        </li>';
                }


                echo '</ul>
                </div>
            </div>';
            } else {
                /* =================
                 * VISOR DE VIDEOS
                  ================= */
                echo '<div class="col-sm-6 col-xs-12">'
                . '<iframe class="videoPresentacion" src="https://www.youtube.com/embed/' . $infoProducto["multimedia"] . '?rel=0&autoplay=1" width="100%" frameborder="0" allowfullscreen></iframe>'
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
                if ($infoProducto["detalles"] != null) {

                    $detalles = json_decode($infoProducto["detalles"], true);

                    if ($infoProducto["tipo"] == "fisico") {

                        if ($detalles["Talla"] != null) {
                            echo '<div class="col-md-3 col-xs-12">'
                            . '<select class="form form-control selecionarDetalle" id="selecionarTalla">'
                            . '<option value="">Talla</option>';
                            for ($i = 0; $i <= count($detalles["Talla"]); $i++) {
                                echo '<option value="' . $detalles["Talla"][$i] . '">' . $detalles["Talla"][$i] . '</option>';
                            }
                            echo '</select>'
                            . '</div>';
                        }
                        if ($detalles["Color"] != null) {
                            echo '<div class="col-md-3 col-xs-12">'
                            . '<select class="form form-control selecionarColor" id="selecionarColor">'
                            . '<option value="">Color</option>';
                            for ($i = 0; $i <= count($detalles["Color"]); $i++) {
                                echo '<option value="' . $detalles["Color"][$i] . '">' . $detalles["Color"][$i] . '</option>';
                            }
                            echo '</select>'
                            . '</div>';
                        }
                        if ($detalles["Marca"] != null) {
                            echo '<div class="col-md-3 col-xs-12">'
                            . '<select class="form form-control selecionarMarca" id="selecionarMarca">'
                            . '<option value="">Marca</option>';
                            for ($i = 0; $i <= count($detalles["Marca"]); $i++) {
                                echo '<option value="' . $detalles["Marca"][$i] . '">' . $detalles["Marca"][$i] . '</option>';
                            }
                            echo '</select>'
                            . '</div>';
                        }
                    } else {

                        echo '<div class="col-xs-12">
                                <li>
                                    <i style="margin-right:10px" class="fa fa-play-circle"></i>' . $detalles["Clases"] . '
                                </li>
                                <li>
                                    <i style="margin-right:10px" class="fa fa-clock-o"></i>' . $detalles["Tiempo"] . '
                                </li>
                                <li>
                                    <i style="margin-right:10px" class="fa fa-check-circle"></i>' . $detalles["Nivel"] . '
                                </li>
                                <li>
                                    <i style="margin-right:10px" class="fa fa-info-circle"></i>' . $detalles["Acceso"] . '
                                </li>
                                <li>
                                    <i style="margin-right:10px" class="fa fa-desktop"></i>' . $detalles["Dispositivo"] . '
                                </li>
                                <li>
                                    <i style="margin-right:10px" class="fa fa-trophy"></i>' . $detalles["Certificado"] . '
                                </li>
                            </div>';
                    }
                }
                /* --==========================
                  ENTREGA
                  ============================ */
                if ($infoProducto["entrega"] == 0) {
                    if ($infoProducto["precio"] == 0) {
                        echo '<h4 class="col-md-12 col-sm-0 col-xs-0">'
                        . '<hr>'
                        . '<span class="label label-default" style="font-weight:100">'
                        . '<i class="fa fa-clock-o" style="margin-right:5px"></i> Entrega inmediata | '
                        . '<i class="fa fa-shopping-cart" style="margin:0px 5px"></i>' . $infoProducto["ventasGratis"] . ' inscritos'
                        . '<i class="fa fa-eye" style="margin:0px 5px"></i>Visto por ' . $infoProducto["vistasGratis"] . ' personas'
                        . '</span>'
                        . '</h4>';
                        echo '<h4 class="col-lg-0 col-md-0 col-xs-12">'
                        . '<hr>'
                        . '<span class="label label-default" style="font-weight:100">'
                        . '<i class="fa fa-clock-o" style="margin-right:5px"></i> Entrega inmediata | '
                        . '<i class="fa fa-shopping-cart" style="margin:0px 5px"></i>' . $infoProducto["ventasGratis"] . ' inscritos'
                        . '<i class="fa fa-eye" style="margin:0px 5px"></i>Visto por ' . $infoProducto["vistasGratis"] . ' personas'
                        . '</span>'
                        . '</h4>';
                    } else {
                        echo '<h4 class="col-md-12 col-sm-0 col-xs-0">'
                        . '<hr>'
                        . '<span class="label label-default" style="font-weight:100">'
                        . '<i class="fa fa-clock-o" style="margin-right:5px"></i> Entrega inmediata | '
                        . '<i class="fa fa-shopping-cart" style="margin:0px 5px"></i>' . $infoProducto["ventas"] . ' ventas'
                        . '<i class="fa fa-eye" style="margin:0px 5px"></i>Visto por ' . $infoProducto["vistas"] . ' personas'
                        . '</span>'
                        . '</h4>';
                        echo '<h4 class="col-lg-0 col-md-0 col-xs-12">'
                        . '<hr>'
                        . '<span class="label label-default" style="font-weight:100">'
                        . '<i class="fa fa-clock-o" style="margin-right:5px"></i> Entrega inmediata | '
                        . '<i class="fa fa-shopping-cart" style="margin:0px 5px"></i>' . $infoProducto["ventas"] . ' ventas'
                        . '<i class="fa fa-eye" style="margin:0px 5px"></i>Visto por ' . $infoProducto["vistas"] . ' personas'
                        . '</span>'
                        . '</h4>';
                    }
                } else {
                    if ($infoProducto["precio"] == 0) {
                        echo '<h4 class="col-md-12 col-sm-0 col-xs-0">'
                        . '<hr>'
                        . '<span class="label label-default" style="font-weight:100">'
                        . '<i class="fa fa-clock-o" style="margin-right:5px"></i> '
                        . $infoProducto["entrega"] . ' dias habiles para la entrega | '
                        . '<i class="fa fa-shopping-cart" style="margin:0px 5px"></i>' . $infoProducto["ventasGratis"] . ' solicitudes'
                        . '<i class="fa fa-eye" style="margin:0px 5px"></i>Visto por ' . $infoProducto["vistasGratis"] . ' personas'
                        . '</span>'
                        . '</h4>';
                        echo '<h4 class="col-lg-0 col-md-0 col-xs-12">'
                        . '<hr>'
                        . '<span class="label label-default" style="font-weight:100">'
                        . '<i class="fa fa-clock-o" style="margin-right:5px"></i> '
                        . $infoProducto["entrega"] . ' dias habiles para la entrega | '
                        . '<i class="fa fa-shopping-cart" style="margin:0px 5px"></i>' . $infoProducto["ventasGratis"] . ' solicitudes'
                        . '<i class="fa fa-eye" style="margin:0px 5px"></i>Visto por ' . $infoProducto["vistasGratis"] . ' personas'
                        . '</span>'
                        . '</h4>';
                    } else {
                        echo '<h4 class="col-md-12 col-sm-0 col-xs-0">'
                        . '<hr>'
                        . '<span class="label label-default" style="font-weight:100">'
                        . '<i class="fa fa-clock-o" style="margin-right:5px"></i> '
                        . $infoProducto["entrega"] . ' dias habiles para la entrega | '
                        . '<i class="fa fa-shopping-cart" style="margin:0px 5px"></i>' . $infoProducto["ventas"] . ' ventas'
                        . '<i class="fa fa-eye" style="margin:0px 5px"></i>Visto por ' . $infoProducto["vistas"] . ' personas'
                        . '</span>'
                        . '</h4>';
                        echo '<h4 class="col-lg-0 col-md-0 col-xs-12">'
                        . '<hr>'
                        . '<small>'
                        . '<i class="fa fa-clock-o" style="margin-right:5px"></i> '
                        . $infoProducto["entrega"] . ' dias habiles para la entrega <br> '
                        . '<i class="fa fa-shopping-cart" style="margin:0px 5px"></i>' . $infoProducto["ventas"] . ' ventas <br>'
                        . '<i class="fa fa-eye" style="margin:0px 5px"></i>Visto por ' . $infoProducto["vistas"] . ' personas'
                        . '</small>'
                        . '</h4>';
                    }
                }
                ?>
            </div>
            <!--==========================
           BOTONES DE COMPRA
           ============================-->
            <div class="row botonesCompra">
                <?php
                if ($infoProducto["precio"] == 0) {
                    echo '<div class="col-md-6 col-xs-12">';
                    if ($infoProducto["tipo"] == "virtual") {
                        echo '<button class="btn btn-default btn-block btn-lg backColor">ACCEDER AHORA</button>';
                    } else {
                        echo '<button class="btn btn-default btn-block btn-lg backColor">SOLICITAR AHORA</button>';
                    }
                    echo '</div>';
                } else {
                    if ($infoProducto["tipo"] == "virtual") {
                        echo '<div class="col-md-6 col-xs-12">
                     <button class="btn btn-default btn-block btn-lg"><small>COMPRAR AHORA</small></button>
                 </div>
                 <div class="col-md-6 col-xs-12">
                     <button class="btn btn-default btn-block btn-lg backColor">
                         ADICIONAR AL CARRITO
                         <i class="fa fa-shopping-cart"></i>
                     </button>
                 </div>';
                    } else {

                        echo '<div class="col-lg-6 col-md-8 col-xs-12">
                     <button class="btn btn-default btn-block btn-lg backColor">
                         <small>ADICIONAR AL CARRITO</small>
                         <i class="fa fa-shopping-cart"></i>
                     </button>
                 </div>';
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
    <!--==========================
            COMENTARIOS
    ============================-->
    <br>
    <div class="row">
        <ul class="nav nav-tabs">
            <li class="active"><a>COMENTARIOS 4</a></li>
            <li><a>Ver mas</a></li>
            <li class="pull-right"><a class="text-muted">PROMEDIO DE CALIFICACION: 3.5 | 
                    <i class="fa fa-star text-success"></i>   
                    <i class="fa fa-star text-success"></i>   
                    <i class="fa fa-star text-success"></i>   
                    <i class="fa fa-star-half-o text-success"></i>   
                    <i class="fa fa-star-o text-success"></i>   
                </a></li>
        </ul>
        <br>
        <div class="row comentarios">
            <div class="panel-group col-md-3 col-sm-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-uppercase">
                        Silvio Coelho
                        <span class="text-right">
                            <img class="img-circle" src="<?php echo $url; ?>vistas/img/usuarios/40/944.jpg" width="20%">
                        </span>
                    </div>
                    <div class="panel-body"><small>$Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto maxime quas modi, eveniet fugiat. Alias voluptatem cum consectetur nobis quod, excepturi recusandae, itaque facere minima officiis autem illum, perferendis provident! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto maxime quas modi, eveniet fugiat. Al</small></div>
                    <div class="panel-footer">
                        <i class="fa fa-star text-success"></i>   
                        <i class="fa fa-star text-success"></i>   
                        <i class="fa fa-star text-success"></i>   
                        <i class="fa fa-star-half-o text-success"></i>   
                        <i class="fa fa-star-o text-success"></i> 
                    </div>
                </div>

            </div>
            <div class="panel-group col-md-3 col-sm-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-uppercase">
                        Silvio Coelho
                        <span class="text-right">
                            <img class="img-circle" src="<?php echo $url; ?>vistas/img/usuarios/40/944.jpg" width="20%">
                        </span>
                    </div>
                    <div class="panel-body"><small>$Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto maxime quas modi, eveniet fugiat. Alias voluptatem cum consectetur nobis quod, excepturi recusandae, itaque facere minima officiis autem illum, perferendis provident! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto maxime quas modi, eveniet fugiat. Al</small></div>
                    <div class="panel-footer">
                        <i class="fa fa-star text-success"></i>   
                        <i class="fa fa-star text-success"></i>   
                        <i class="fa fa-star text-success"></i>   
                        <i class="fa fa-star-half-o text-success"></i>   
                        <i class="fa fa-star-o text-success"></i> 
                    </div>
                </div>

            </div>
            <div class="panel-group col-md-3 col-sm-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-uppercase">
                        Silvio Coelho
                        <span class="text-right">
                            <img class="img-circle" src="<?php echo $url; ?>vistas/img/usuarios/40/944.jpg" width="20%">
                        </span>
                    </div>
                    <div class="panel-body"><small>$Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto maxime quas modi, eveniet fugiat. Alias voluptatem cum consectetur nobis quod, excepturi recusandae, itaque facere minima officiis autem illum, perferendis provident! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto maxime quas modi, eveniet fugiat. Al</small></div>
                    <div class="panel-footer">
                        <i class="fa fa-star text-success"></i>   
                        <i class="fa fa-star text-success"></i>   
                        <i class="fa fa-star text-success"></i>   
                        <i class="fa fa-star-half-o text-success"></i>   
                        <i class="fa fa-star-o text-success"></i> 
                    </div>
                </div>

            </div>
            <div class="panel-group col-md-3 col-sm-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-uppercase">
                        Silvio Coelho
                        <span class="text-right">
                            <img class="img-circle" src="<?php echo $url; ?>vistas/img/usuarios/40/944.jpg" width="20%">
                        </span>
                    </div>
                    <div class="panel-body"><small>$Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto maxime quas modi, eveniet fugiat. Alias voluptatem cum consectetur nobis quod, excepturi recusandae, itaque facere minima officiis autem illum, perferendis provident! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto maxime quas modi, eveniet fugiat. Al</small></div>
                    <div class="panel-footer">
                        <i class="fa fa-star text-success"></i>   
                        <i class="fa fa-star text-success"></i>   
                        <i class="fa fa-star text-success"></i>   
                        <i class="fa fa-star-half-o text-success"></i>   
                        <i class="fa fa-star-o text-success"></i> 
                    </div>
                </div>

            </div>

        </div>
        <hr>
    </div>

</div>



<!--ARTICULOS RELACIONADOS-->
<div class="container-fluid productos">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 tituloDestacado">
                <div class="col-sm-6 col-xs-12">
                    <h1><small>PRODUCTOS RELACIONADOS</small></h1>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <?php
                        $item = "id";
                        $valor = $infoProducto["id_subcategoria"];
                        $rutasArticulosDestacados = ControladorProductos::ctrMostrarSubCategorias($item, $valor);
                        //var_dump($rutasArticulosDestacados);
                        echo '<a href="'.$url.$rutasArticulosDestacados[0]["ruta"] . '">
                        <button class="btn btn-default backColor pull-right">
                            VER MÁS <span class="fa fa-chevron-right"></span>
                        </button>
                    </a>';
                    ?>
                    
                </div>
            </div>
            <!--forcar aparecer a linha hr-->
            <div class="clearfix"></div>
            <hr>
        </div>
        <?php
            $ordenar = "";
            $item = "id_subcategoria";
            $valor = $infoProducto["id_subcategoria"];
            $base = 0;
            $tope = 4;
            $modo = "Rand()";
            $relacionados = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo);
            //var_dump($relacionados);
            if(!$relacionados){
                echo '<div class="col-xs-12 error404">
            <h1><small>Oops!</small></h1>
            <h2><small>No hay productos relacionados!</small></h2>
            
        </div>';
            } else {
                echo '<ul class="grid0">';
        
        
        

     

            foreach ($relacionados as $key => $value) {
            echo '<li class="col-md-3 col-sm-6 col-xs-12">
                <!--==============-->
                <figure>
                    <a href="'.$url . $value["ruta"] . '" class="pixelSubCategorias">
                       <img src="' . $servidor . $value["portada"] . '" class="img-responsive">
                    </a>
                </figure>


                <!--==============-->
                <h4>
                    <small>
                        <a href="'.$url . $value["ruta"] . '" class="pixelProducto">
                           ' . $value["titulo"] . '<br><span style="color:rgba(0,0,0,0)">-</span>';

                            if ($value["nuevo"] != 0) {
                            echo '<span class="label label-warning fontSize">Nuevo</span> ';
                            }

                            if ($value["oferta"] != 0) {
                            echo '<span class="label label-warning fontSize">' . $value["descuentoOferta"] . '% off</span>';
                            }

                            echo '</a>
                    </small>
                </h4>


                <!--==============-->
                <div class="col-xs-6 precio">';

                    if ($value["precio"] == 0) {
                    echo '<h2><small>GRATIS</small></h2>';
                    } else {
                    if ($value["oferta"] != 0) {
                    echo '<h2><small>
                            <strong class="oferta">USD $' . $value["precio"] . '</strong>
                        </small>
                        <small>
                            $' . $value["precioOferta"] . '
                        </small></h2>';
                    } else {
                    echo '<h2><small>USD $' . $value["precio"] . '</small></h2>';
                    }
                    }

                    echo '</div>


                <!--==============-->
                <div class="col-xs-6 enlaces">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-default btn-xs deseos" 
                                idProducto="' . $value["id"] . '" data-toggle="tooltip" title="Agregar a mi lista de deseos">
                                <i class="fa fa-heart" aria-hidden="true"></i>

                        </button>';

                        if ($value["tipo"] == "virtual" && $value["precio"] != 0) {
                        if ($value["oferta"] != 0) {
                        echo '<button type="button" class="btn btn-default btn-xs agregarCarrito" 
                                      idProducto="' . $value["id"] . '" 
                                      imagen="' . $servidor . $value["portada"] . '"
                                      titulo="' . $value["titulo"] . '"
                                      precio="' . $value["precioOferta"] . '"
                                      tipo="' . $value["tipo"] . '"
                                      peso="' . $value["peso"] . '"
                                      data-toggle="tooltip"
                                      title="Agregar al carrito de compras">
                                      <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        </button>';
                        } else {


                        echo '<button type="button" class="btn btn-default btn-xs agregarCarrito" 
                                      idProducto="' . $value["id"] . '" 
                                      imagen="' . $servidor . $value["portada"] . '"
                                      titulo="' . $value["titulo"] . '"
                                      precio="' . $value["precio"] . '"
                                      tipo="' . $value["tipo"] . '"
                                      peso="' . $value["peso"] . '"
                                      data-toggle="tooltip"
                                      title="Agregar al carrito de compras">
                                      <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        </button>';
                        }
                        }

                        echo '<a href="'.$url . $value["ruta"] . '" class="pixelProducto">
                                 <button type="button" class="btn btn-default btn-xs" 
                                data-toggle="tooltip" title="Ver producto">
                                <i class="fa fa-eye" aria-hidden="true"></i>

                            </button>
                        </a>

                    </div>
                </div>
            </li>';
            }


            echo '</ul>';
            }
            ?>
    </div>
</div>