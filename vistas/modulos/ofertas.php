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
                                    <a href="">
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

