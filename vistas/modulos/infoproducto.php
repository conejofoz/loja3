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
            <!--==========================
            VIDOR DE PRODUCTOS
            ============================-->
            <div class="col-md-5 col-sm-6 col-xs-12 visorImg">
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
            </div>
            <!--==========================
            PRODUTO
            ============================-->
            <div class="col-md-7 col-sm-6 col-xs-12">


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