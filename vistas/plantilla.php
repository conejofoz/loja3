<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="title" content="Tienda Virtual">
        <meta name="description" content="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam voluptatum rerum inventore quibusdam nihil ducimus nobis, qui, odio libero culpa sapiente minima neque error ullam. Itaque repellendus, iusto repudiandae porro">
        <meta name="keyword" content="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam voluptatum rerum inventore quibusdam nihil ducimus nobis, qui, odio libero culpa sapiente minima neque error ullam. Itaque repellendus, iusto repudiandae porro">
        <title>Tienda virtual</title>

        <?php
        
        session_start();
        
        $servidor = ruta::ctrRutaServidor();
        
        $icono = ControladorPlantilla::ctrEstiloPlantilla();
        echo '<link rel="icon" href="'.$servidor.$icono["icono"] . '">';

        /*
         * mantener la ruta fixa del projeto
         */
        $url = Ruta::ctrRuta();

        //var_dump($url);

        ;
        ?>

        <!--=========================================================
        PLUGINS DE CSS
        ==========================================================-->
        <link rel="icon" href="http://localhost/backend/<?php echo $url; ?>vistas/img/plantilla/icono.png">
        <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>vistas/css/plugins/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>vistas/css/plugins/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu|Ubuntu+Condensed" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>vistas/css/plugins/flexslider.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>vistas/css/plugins/sweetalert.css">
        
        <!--=========================================================
        FOLHAS DE ESTILO PERSONALIZADAS
        ==========================================================-->
        <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>vistas/css/plantilla.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>vistas/css/cabezote.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>vistas/css/slide.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>vistas/css/productos.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>vistas/css/infoproducto.css">
        
        <!--=========================================================
        PLUGINS DE JAVASCRIPT
        ==========================================================-->
        <script type="text/javascript" src="<?php echo $url; ?>vistas/js/plugins/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo $url; ?>vistas/js/plugins/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo $url; ?>vistas/js/plugins/jquery.easing.js"></script>
        <script type="text/javascript" src="<?php echo $url; ?>vistas/js/plugins/jquery.scrollUp.js"></script>
        <script type="text/javascript" src="<?php echo $url; ?>vistas/js/plugins/jquery.flexslider.js"></script>
        <script type="text/javascript" src="<?php echo $url; ?>vistas/js/plugins/sweetalert.min.js"></script>

    </head>
    <body>
        <?php
        /* =============================================
          =            CABEZOTE            =
          ============================================= */

        include "modulos/cabezote.php";
        
        /*
         * CONTENIDO DINAMICO
         */
        $rutas = array();
        $ruta = null;
        $infoProducto = null;
        if (isset($_GET["ruta"])) {
            //echo $_GET["ruta"];

            $rutas = explode("/", $_GET["ruta"]);

            $item = "ruta";
            $valor = $rutas[0];
            /*
             * urls amigaveis de categoria
             */
            $rutaCategorias = ControladorProductos::ctrMostrarCategorias($item, $valor);

            if ($valor == $rutaCategorias["ruta"]) {
                $ruta = $valor;
            }
            
            /*
             * urls amigaveis de subcategorias
             */
            $rutaSubCategorias = ControladorProductos::ctrMostrarSubCategorias($item, $valor);
            foreach ($rutaSubCategorias as $key => $value){
                if($rutas[0] == $value["ruta"]){
                    $ruta = $rutas[0];
                }
            }
            
            
            /*
             * urls amigaveis de produtos
             */
            $rutaProductos = ControladorProductos::ctrMostrarInfoProducto($item, $valor);
            if($rutas[0] == $rutaProductos["ruta"]){
                $infoProducto = $rutas[0];
            }
            
            
            
            
            
            /*
             * lista blanca de urls amigaveis
             */
            if ($ruta != null || $rutas[0] == "articulos-gratis" || $rutas[0] == "lo-mas-vendido" || $rutas[0] == "lo-mas-visto") {
                include "modulos/productos.php";
            } else if($infoProducto != null) {
                include "modulos/infoproducto.php";
            } else if($rutas[0] == "buscador" || $rutas[0] == "verificar" || $rutas[0] == "salir"){
                include "modulos/".$rutas[0].".php";
            } else {
                include "modulos/error404.php";
            }
        }else{
            include "modulos/slide.php";
            include "modulos/destacados.php";
        }
        ?>
        <input type="hidden" value="<?php echo $url; ?>" id="rutaOculta">
        <!--=========================================================
        PLUGINS DE JAVASCRIPT PERSONALIZADO
        ==========================================================-->
        <script type="text/javascript" src="<?php echo $url; ?>vistas/js/cabezote.js"></script>
        <script type="text/javascript" src="<?php echo $url; ?>vistas/js/plantilla.js"></script>
        <script type="text/javascript" src="<?php echo $url; ?>vistas/js/slide.js"></script>
        <script type="text/javascript" src="<?php echo $url; ?>vistas/js/buscador.js"></script>
        <script type="text/javascript" src="<?php echo $url; ?>vistas/js/infoproducto.js"></script>
        <script type="text/javascript" src="<?php echo $url; ?>vistas/js/usuarios.js"></script>
    </body>
</html>