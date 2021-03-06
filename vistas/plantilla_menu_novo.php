<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        

        <?php
        
        session_start();
        
        $servidor = ruta::ctrRutaServidor();
        
        $plantilla = ControladorPlantilla::ctrEstiloPlantilla();
        echo '<link rel="icon" href="'.$servidor.$plantilla["icono"] . '">';

        /*
         * mantener la ruta fixa del projeto
         */
        $url = Ruta::ctrRuta();
       

        
        
        /*
         * MARCADO DE CABECERA
         */
        $rutas = array();
        if(isset($_GET["ruta"])){
           $rutas = explode("/", $_GET["ruta"]) ;
           $ruta = $rutas[0];
        } else {
            $ruta = "inicio";
        }
        $cabeceras = ControladorPlantilla::ctrTraerCabeceras($ruta);
        if(!$cabeceras["ruta"]){
            $ruta = "inicio";
            $cabeceras = ControladorPlantilla::ctrTraerCabeceras($ruta);
        }
        //var_dump($cabeceras);

        
        ?>
        
        <!--Marcado de HTML5-->
        <meta name="title" content="<?php echo $cabeceras['titulo']; ?>">
        <meta name="description" content="<?php echo $cabeceras['descripcion']; ?>">
        <meta name="keyword" content="<?php echo $cabeceras['palabrasClaves']; ?>">
        <title><?php echo $cabeceras['titulo']; ?></title>
        <meta charset="UTF-8">
        <meta name="author" content="Silvio Coelho">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        
        
        <!--Geo localização-->
        <meta name="geo.region" content="PY" />
        <meta name="geo.placename" content="Ciudad del Este" />
        <meta name="geo.position" content="-25.508772;-54.609126" />
        <meta name="ICBM" content="-25.508772, -54.609126" />

        

        <!--=====================================
	Marcado de Open Graph FACEBOOK
	======================================-->

	<meta property="og:title"   content="<?php echo $cabeceras['titulo'];?>">
	<meta property="og:url" content="<?php echo $url.$cabeceras['ruta'];?>">
	<meta property="og:description" content="<?php echo $cabeceras['descripcion'];?>">
	<meta property="og:image"  content="<?php echo $servidor.$cabeceras['portada'];?>">
	<meta property="og:type"  content="website">	
	<meta property="og:site_name" content="Tu logo">
	<meta property="og:locale" content="es_PY">

	<!--=====================================
	Marcado para DATOS ESTRUCTURADOS GOOGLE
	======================================-->
	
	<meta itemprop="name" content="<?php echo $cabeceras['titulo'];?>">
	<meta itemprop="url" content="<?php echo $url.$cabeceras['ruta'];?>">
	<meta itemprop="description" content="<?php echo $cabeceras['descripcion'];?>">
	<meta itemprop="image" content="<?php echo $servidor.$cabeceras['portada'];?>">

	<!--=====================================
	Marcado de TWITTER
	======================================-->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="<?php echo $cabeceras['titulo'];?>">
	<meta name="twitter:url" content="<?php echo $url.$cabeceras['ruta'];?>">
	<meta name="twitter:description" content="<?php echo $cabeceras['descripcion'];?>">
	<meta name="twitter:image" content="<?php echo $servidor.$cabeceras['portada'];?>">
	<meta name="twitter:site" content="@tu-usuario">
        
                

        <!--=========================================================
        PLUGINS DE CSS
        ==========================================================-->
        <link rel="icon" href="<?php echo $url; ?>vistas/img/plantilla/icono.png">
        <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>vistas/css/plugins/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>vistas/css/plugins/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu|Ubuntu+Condensed" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Cabin+Sketch" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Fredericka+the+Great" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>vistas/css/plugins/flexslider.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>vistas/css/plugins/sweetalert.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>vistas/css/plugins/dscountdown.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>vistas/css/plugins/animate.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>vistas/css/style.css">
        
        <!--=========================================================
        FOLHAS DE ESTILO PERSONALIZADAS
        ==========================================================-->
        <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>vistas/css/plantilla.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>vistas/css/cabezote.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>vistas/css/slide.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>vistas/css/productos.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>vistas/css/infoproducto.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>vistas/css/perfil.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>vistas/css/carrito-de-compras.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>vistas/css/ofertas.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>vistas/css/footer.css">
        
        <!--=========================================================
        PLUGINS DE JAVASCRIPT
        ==========================================================-->
        <script type="text/javascript" src="<?php echo $url; ?>vistas/js/plugins/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo $url; ?>vistas/js/plugins/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo $url; ?>vistas/js/plugins/jquery.easing.js"></script>
        <script type="text/javascript" src="<?php echo $url; ?>vistas/js/plugins/jquery.scrollUp.js"></script>
        <script type="text/javascript" src="<?php echo $url; ?>vistas/js/plugins/jquery.flexslider.js"></script>
        <script type="text/javascript" src="<?php echo $url; ?>vistas/js/plugins/sweetalert.min.js"></script>
        <script type="text/javascript" src="<?php echo $url; ?>vistas/js/plugins/dscountdown.min.js"></script>
        <script type="text/javascript" src="<?php echo $url; ?>vistas/js/plugins/knob.jquery.js"></script>
        <script type="text/javascript" src="<?php echo $url; ?>vistas/js/plugins/wow.min.js"></script>
        <!--RELACIONADO COM COMPARTIR EM GOOGLE-->
        <script src="https://apis.google.com/js/platform.js" async defer></script>

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

            if ($valor == $rutaCategorias["ruta"] && $rutaCategorias["estado"] == 1) {
                $ruta = $valor;
            }
            
            /*
             * urls amigaveis de subcategorias
             */
            $rutaSubCategorias = ControladorProductos::ctrMostrarSubCategorias($item, $valor);
            foreach ($rutaSubCategorias as $key => $value){
                if($rutas[0] == $value["ruta"] && $value["estado"] == 1){
                    $ruta = $rutas[0];
                }
            }
            
            
            /*
             * urls amigaveis de produtos
             */
            $rutaProductos = ControladorProductos::ctrMostrarInfoProducto($item, $valor);
            if($rutas[0] == $rutaProductos["ruta"] && $rutaProductos["estado"] == 1){
                $infoProducto = $rutas[0];
            }
            
            
            
            
            
            /*
             * lista blanca de urls amigaveis
             */
            if ($ruta != null || $rutas[0] == "articulos-gratis" || $rutas[0] == "lo-mas-vendido" || $rutas[0] == "lo-mas-visto") {
                include "modulos/productos.php";
            } else if($infoProducto != null) {
                include "modulos/infoproducto.php";
            } else if($rutas[0] == "buscador" || $rutas[0] == "verificar" || $rutas[0] == "salir" || $rutas[0] == "perfil" || $rutas[0] == "carrito-de-compras" || $rutas[0] == "error" || $rutas[0] == "finalizar-compra" || $rutas[0] == "curso" || $rutas[0] == "ofertas"){
                include "modulos/".$rutas[0].".php";
            } else if($rutas[0] == "inicio") {
                include "modulos/slide.php";
                include "modulos/destacados.php";
            } else {
                include "modulos/error404.php";
            }
        }else{
            include "modulos/slide.php";
            include "modulos/destacados.php";
        }
//        SI O SI DEVEN APARECER
        include "modulos/visitas.php";
        include "modulos/equipe.php";
        include "modulos/footer.php";
        
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
        <script type="text/javascript" src="<?php echo $url; ?>vistas/js/registroFacebook.js"></script>
        <script type="text/javascript" src="<?php echo $url; ?>vistas/js/carrito-de-compras.js"></script>
        <script type="text/javascript" src="<?php echo $url; ?>vistas/js/visitas.js"></script>
        
        
<!--https://developers.facebook.com/-->
<?php echo $plantilla["apiFacebook"]; ?>

   
   
   
   <script>
   
   
   /*
    * COMPARTIR EN FACEBOOK
    * https://developers.facebook.com/docs/
    */
   $(".btnFacebook").click(function(){
       FB.ui({
           method: 'share',
           display: 'popup',
           href:'<?php echo $url.$cabeceras["ruta"]; ?>'
       }, function(response){});
   })
   
	/*=============================================
	COMPARTIR EN GOOGLE
	https://developers.google.com/+/web/share/     
	=============================================*/

	$(".btnGoogle").click(function(){

		window.open(

			'https://plus.google.com/share?url=<?php  echo $url.$cabeceras["ruta"];  ?>',
			'',
			'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=400'
		);

		return false;

	})   
   
	/*=============================================
	COMPARTIR EN WHATSAPP
	https://api.whatsapp.com/send?text     
	=============================================*/

	$(".btnwhats").click(function(){
            
            //alert("clicou");

		window.open(

			'https://api.whatsapp.com/send?text=<?php  echo $url.$cabeceras["ruta"];  ?>');

		return false;

	})   
   
</script>




<!--GOOGLE ANALYTICS-->
<!--AINDA NÃO IMPLEMENTADO-->
<script>
    <?php //echo $plantilla["googleAnalytics"]; ?>
</script>




<!--PIXEL DE FACEBOOK-->
<!--AINDA NÃO IMPLEMENTADO-->
<script>
    <?php //echo $plantilla["pixelFacebook"]; ?>
</script>




    </body>
</html>