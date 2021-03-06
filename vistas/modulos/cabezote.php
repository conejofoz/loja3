
<?php
$servidor = ruta::ctrRutaServidor();
$url = ruta::ctrRuta();

/* ===============================================
 * INICIO DE SESION USUARIO
  ================================================ */
if (isset($_SESSION["validarSesion"])) {

    if ($_SESSION["validarSesion"] == "ok") {

        echo '<script>'
        . 'localStorage.setItem("usuario", "' . $_SESSION["id"] . '");'
        . '</script>';
    }
}



/* ===============================================
 * API DE GOOGLE
  ================================================ */

/* ===============================================
 * CRIAR O OBJETO DA API GOOGLE
  ================================================ */
$cliente = new Google_Client();
$cliente->setAuthConfig('modelos/client_secret.json');
$cliente->setAccessType("offline");
$cliente->setScopes(['profile', 'email']);

/* ===============================================
 * RUTA PARA EL LOGIN DE GOOGLE
  ================================================ */
$rutaGoogle = $cliente->createAuthUrl();


/* ===============================================
 * RECIBIMOS LA VARIABLE GET DE GOOGLE LLAMADA CODE
  ================================================ */
if (isset($_GET["code"])) {
    $token = $cliente->authenticate($_GET["code"]);

    $_SESSION['id_token_google'] = $token;

    $cliente->setAccessToken($token);
}


/* ===============================================
 * RECIBIMOS LOS DATOS CIFRADOS DE GOOGLE EN UN ARRAY
  ================================================ */
if ($cliente->getAccessToken()) {
    $item = $cliente->verifyIdToken();


    $datos = array(
        "nombre" => $item["name"],
        "email" => $item["email"],
        "foto" => $item["picture"],
        "password" => "null",
        "modo" => "google",
        "verificacion" => 0,
        "emailEncriptado" => "null"
    );

    $respuesta = ControladorUsuarios::ctrRegistroRedesSociales($datos);


    echo '<script>'
    . 'setTimeout(function(){ '
    . 'window.location = localStorage.getItem("rutaActual"); '
    . '},1000); '
    . '</script>';
}
?>









<!--=====================================
=            Top            =
======================================-->

<div class="container-fluid barraSuperior" id="top">
    <div class="container">
        <div class="row">
            <!--=====================================
            =            Social            =
            ======================================-->
            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 social">
                <ul>
                    
                    <?php
                    $social = ControladorPlantilla::ctrEstiloPlantilla();

                    $jsonRedesSociales = json_decode($social["redesSociales"], true);
                    foreach ($jsonRedesSociales as $key => $value) {
                        if ($value["activo"] != 0) {
                            echo '<li>
                                    <a href="' . $value["url"] . '" target="_blank">
                                        <i class="fa ' . $value["red"] . ' redSocial ' . $value["estilo"] . '" arial-hidden="true"></i>
                                    </a>
                                 </li>';
                        }
                    }
                    ?>
                    <a href="https://api.whatsapp.com/send?l=pt_br&phone=595986824566" target="blank">
                        <i class="fa fa-whatsapp whatsappSuperior"> <span>+595-986-824566</span></i>
                    </a>
                </ul>
                
            </div>

            <!--=====================================
            =            registro            =
            ======================================-->
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 registro">
                <ul>
                    <?php
                    if (isset($_SESSION["validarSesion"])) {
                        if ($_SESSION["validarSesion"] == "ok") {



                            if ($_SESSION["modo"] == "directo") {
                                if ($_SESSION["foto"] != "") {
                                    echo '<li>'
                                    . '<img class="img-circle" src="' . $url . $_SESSION["foto"] . '" width="10%">'
                                    . '</li>';
                                } else {
                                    echo '<li>'
                                    . '<img class="img-circle" src="' . $servidor . 'vistas/img/usuarios/default/anonymous.png" width="10%">'
                                    . '</li>';
                                }
                                echo '<li> | </li>
                  <li><a href="' . $url . 'perfil">Ver Perfil</a></li>
                  <li> | </li>
                  <li><a href="' . $url . 'salir">Salir</a></li>';
                            }


                            if ($_SESSION["modo"] == "facebook") {
                                echo '<li>'
                                . '<img class="img-circle" src="' . $_SESSION["foto"] . '" width="10%">'
                                . '</li> '
                                . '<li> | </li>
              <li><a href="' . $url . 'perfil">Ver Perfil</a></li>
              <li> | </li>
              <li><a href="' . $url . 'salir" class="salir">Salir</a></li>';
                            }


                            if ($_SESSION["modo"] == "google") {
                                echo '<li>'
                                . '<img class="img-circle" src="' . $_SESSION["foto"] . '" width="10%">'
                                . '</li> '
                                . '<li> | </li>
              <li><a href="' . $url . 'perfil">Ver Perfil</a></li>
              <li> | </li>
              <li><a href="' . $url . 'salir">Salir</a></li>';
                            } else {
                                echo '<li>'
                                . '<img class="img-circle" src="' . $_SESSION["foto"] . '" width="10%">'
                                . '</li>';
                            }
                        }
                    } else {
                        echo '<li><a href="#modalIngreso" data-toggle="modal"><i class="fa fa-user iconeUser"></i></a></li>
                                 <li><a href="#" data-toggle="modal">|</a></li>
                                 <li><a href="#modalRegistro" data-toggle="modal"><i class="fa fa-user-plus iconeUser"></i></a></li>';
                    }
                    ?>

                </ul>
            </div>
        </div>

    </div>
</div>





<!--=====================================
=            HEADER                     =
======================================-->
<header class="container-fluid backColor colorTitulo">
    <div class="container">
        <div class="row" id="cabezote">
            <!--=====================================
            =            LOGOTIPO                   =
            ======================================-->
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 wow flip" data-wow-duration="2s" data-wow-delay="3s" id="logotipo">
                <a href="<?php echo $url; ?>">
                    <img src="<?php echo $servidor . $social["logo"]; ?>" class="">
                </a>

            </div>


            <!--=====================================
            =BLOQUE CATEGORIAS Y BUSCADOR           =
            ======================================-->
            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
                <!--======================================
                =            BOTON CATEGORIAS            =
                =======================================-->
<!--                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="btnCategorias">
                    <p>CATEGORIAS
                        <span class="pull-right">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </span>
                    </p>
                </div>-->

                <!--==============================
                =            BUSCADOR            =
                ===============================-->
                <div class="input-group col-lg-8 col-md-8 col-sm-7 col-xs-12" id="buscador">
                    <input type="search" name="buscar" class="form-control input-lg" placeholder="Buscar...">
                    <span class="input-group-btn">
                        <a href="<?php echo $url; ?>buscador/1/recientes">
                            <button class="btn btn-default btn-lg" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </a>
                    </span>
                </div>


            </div>

            <!--=============================
            =            CARRITO            =
            ==============================-->
            <div class="col-lg-3 col-md-3 col-sm-2 col-xs-12" id="carrito">
                <div col-xs-12>
                <a href="<?php echo $url; ?>carrito-de-compras">
                    
                    <button class="btn btn-default btn-circle pull-left btn-lg backColor" id="btnCar">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="cantidadCesta"></span>
                    </button>
                    
                </a>
<!--                <button class="btn btn-default btn-lg backColor" id="btnValorCarrinho">
                    <i class="fa fa-dollar"> <span class="sumaCesta"></span></i>
                </button>-->
                <button class="btn btn-default btn-lg backColor" id="btnValorCarrinho">
                    <a href="https://api.whatsapp.com/send?l=pt_br&phone=595986824566" target="blank">

<!--                    <i class="fa fa-whatsapp"> <span>+595-986-824566</span></i>-->
                    </a>
                </button>
                </div>

            </div>

        </div>

        <!--=====================================
        =              CATEGORIAS            =
        ======================================-->
        <div class="col-xs-12" id="categorias">
            <?php
            $item = null;
            $valor = null;
            $categorias = ControladorProductos::ctrMostrarCategorias($item, $valor);

            foreach ($categorias as $key => $value) {

                if ($value["estado"] != 0) {

                    echo '<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
                <h4>
                    <a href="' . $url . $value["ruta"] . '" class="pixelCategorias" titulo="' . $value["categoria"] . '">' . $value["categoria"] . '</a>
                </h4>
                <hr>
                <ul>';

                    $item = "id_categoria";
                    $valor = $value["id"];
                    $subcategorias = ControladorProductos::ctrMostrarSubCategorias($item, $valor);

                    foreach ($subcategorias as $key => $value) {
                        if ($value["estado"] != 0) {
                            echo '<li><a href="' . $url . $value["ruta"] . '" class="pixelSubCategorias" titulo="' . $value["subcategoria"] . '">' . $value["subcategoria"] . '</a></li>';
                        }
                    }
                    echo '
                </ul>

            </div>';
                }
            }



            ;
            ?>








        </div>

    </div>

</header>


<div id="menuLinha" class="container-fluid menuLinha">
    <ul>
        <li><a href="#empresa">EMPRESA</a></li>
        <li><a href="#equipe">EQUIPE</a></li>
        <li><a href="#mapaLocalizacao" id="menuMapaLocalizacao">LOCALIZAÇÃO</a></li>
        <li><a href="#formContacto">CONTATO</a></li>
        
    </ul>
    
</div>


<!--VENTANA MODAL PARA EL REGISTRO-->
<div id="modalRegistro" class="modal fade modalFormulario" role="dialog">
    <div class="modal-content modal-dialog">





        <div class="modal-body modalTitulo">
            <h3 class="backColorModal">REGISTRAR-SE</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <!--================================
            REGISTRO EM FACEBOOK
            =================================-->
            <div class="col-sm-6 col-xs-12 facebook">
                <p>
                    <i class="fa fa-facebook"></i>
                    Registro con Facebook
                </p>
            </div>

            <!--================================
            REGISTRO EM GOOGLE
            =================================-->
            <a href="<?php echo $rutaGoogle; ?>">
                <div class="col-sm-6 col-xs-12 google">
                    <p>
                        <i class="fa fa-google"></i>
                        Registro con Google
                    </p>
                </div>
            </a>

            <!--================================
            REGISTRO DIRECTO
            =================================-->
            <form method="post" onsubmit="return registroUsuario()">
                <hr>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-user"></i>
                        </span>
                        <input type="text" class="form-control input-lg text-uppercase" id="regUsuario" name="regUsuario" placeholder="Nome Completo" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-envelope"></i>
                        </span>
                        <input type="email" class="form-control input-lg" id="regEmail" name="regEmail" placeholder="Correio eletronico" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-lock"></i>
                        </span>
                        <input type="password" class="form-control input-lg" id="regPassword" name="regPassword" placeholder="Senha" required>
                    </div>
                </div>


                <div class="checkbox">
                    <label> 
                        <input type="checkbox" id="regPoliticas">
                        <small>
                            Al registrarse, usted acepta nuestras condiciones de uso y políticas de privacidad
                        </small>
                    </label>
                </div>

                <?php
                $registro = new ControladorUsuarios();
                $registro->ctrRegistroUsuario();
                ?>


                <input type="submit" class="btn btn-default backColor btn-block" value="ENVIAR"> 





            </form>

        </div>

        <div class="modal-footer">
            Ya tienes una cuenta registrada? | <strong><a href="#modalIngreso" data-dismiss="modal" data-toggle="modal">Ingresar</a></strong>
        </div>


    </div>
</div>






<!--VENTANA MODAL PARA EL INGRESO-->
<div id="modalIngreso" class="modal fade modalFormulario" role="dialog">
    <div class="modal-content modal-dialog">





        <div class="modal-body modalTitulo">
            <h3 class="backColorModal">INGRESAR</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <!--================================
            REGISTRO EM FACEBOOK
            =================================-->
            <div class="col-sm-6 col-xs-12 facebook">
                <p>
                    <i class="fa fa-facebook"></i>
                    Ingreso por Facebook
                </p>
            </div>

            <!--================================
            REGISTRO EM GOOGLE
            =================================-->
            <a href="<?php echo $rutaGoogle; ?>">
                <div class="col-sm-6 col-xs-12 google">
                    <p>
                        <i class="fa fa-google"></i>
                        Ingreso por Google
                    </p>
                </div>
            </a>

            <!--================================
            INGRESO DIRECTO
            =================================-->
            <form method="post">
                <hr>


                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-envelope"></i>
                        </span>
                        <input type="email" class="form-control input-lg" id="ingEmail" name="ingEmail" placeholder="Correio eletronico" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-lock"></i>
                        </span>
                        <input type="password" class="form-control input-lg" id="ingPassword" name="ingPassword" placeholder="Senha" required>
                    </div>
                </div>




                <?php
                $ingreso = new ControladorUsuarios();
                $ingreso->ctrIngresoUsuario();
                ?>


                <input type="submit" class="btn btn-default backColor btn-block btnIngreso" value="ENVIAR"> 
                <br>
                <center>
                    <a href="#modalPassword" data-dismiss="modal" data-toggle="modal">Olvidaste tu contraseña?</a> 
                </center>



            </form>

        </div>

        <div class="modal-footer">
            No tienes una cuenta registrada? | <strong><a href="#modalRegistro" data-dismiss="modal" data-toggle="modal">Registrarse</a></strong>
        </div>


    </div>
</div>


















<!--================================
VENTANA MODAL PARA OLVIDO DE CONTRASEÑA
=================================-->

<div id="modalPassword" class="modal fade modalFormulario" role="dialog">
    <div class="modal-content modal-dialog">





        <div class="modal-body modalTitulo">
            <h3 class="backColorModal">SOLICITUD DE NUEVA CONTRASEÑA</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <!--================================
            OLVIDO DE CONTRASEÑA
            =================================-->

            <form method="post">
                <label class="text-muted">Escribe el correo electrónico con el que estás registrado y allí te enviaremos una nueva contraseña</label>


                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-envelope"></i>
                        </span>

                        <input type="email" class="form-control input-lg" id="passEmail" name="passEmail" placeholder="Correio eletronico" required>
                    </div>
                </div>





                <?php
                $password = new ControladorUsuarios();
                $password->ctrOlvidoPassword();
                ?>


                <input type="submit" class="btn btn-default backColor btn-block" value="ENVIAR"> 



            </form>

        </div>

        <div class="modal-footer">
            No tienes una cuenta registrada? | <strong><a href="#modalRegistro" data-dismiss="modal" data-toggle="modal">Registrarse</a></strong>
        </div>


    </div>
</div>




<!--menu novo-->
<nav class="navbar navbar-inverse">
  <div class="container-fluid menuProduto">
      <div class="col-xs-4"></div>
      <div class="">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        <!--<a class="navbar-brand" href="#"><img alt="Brand" width="100" height="30" src="<?php //echo $servidor . $social["logo"]; ?>"></a>-->
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
<!--        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>-->
        <!--<li><a href="#">PRODUTOS</a></li>-->
          
            <?php
            $item = null;
            $valor = null;
            $categorias = ControladorProductos::ctrMostrarCategorias($item, $valor);

            foreach ($categorias as $key => $value) {

                if ($value["estado"] != 0) {

            ?>
        <li class="dropdown">
            
            <a href="<?php echo $url .$value["ruta"] ;?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $value["categoria"] ;?> <span class="caret"></span></a>
                
                <ul class="dropdown-menu">
                    
                    <?php
                    $item = "id_categoria";
                    $valor = $value["id"];
                    $subcategorias = ControladorProductos::ctrMostrarSubCategorias($item, $valor);

                    foreach ($subcategorias as $key => $value) {
                        if ($value["estado"] != 0) {
                        ?>          
                            <li><a href="<?php echo $url . $value["ruta"] ;?>"><?php echo $value["subcategoria"] ;?></a></li>
                        <?php  
                        }
                    };?>

                </ul>
        </li>
            <?php
                }
            };?>
        
        
        
        
        
      </ul>
<!--      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>-->
    </div><!-- /.navbar-collapse -->
      </div>
      <div class="col-xs-4"></div>
  </div><!-- /.container-fluid -->
</nav>
</div>
<!--menu novo fim-->















