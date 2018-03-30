
<!--=================================================
VALIDAR SESIÓN
==================================================-->
<?php
$url = ruta::ctrRuta();
$servidor = ruta::ctrRutaServidor();

if (!isset($_SESSION['validarSesion'])) {
    echo '<script>
            window.location = "' . $url . '";
          </script>';
}
?>


<!--=================================================
BREADCRUMP PERFIL
==================================================-->
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




<!--=================================================
SESÍON PERFIL
==================================================-->
<div class="container-fluid">
    <div class="container">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#compras"><i class="fa fa-list-ul"></i> MIS COMPRAS</a>
            </li>
            <li>
                <a data-toggle="tab" href="#deseos"><i class="fa fa-gift"></i> MI LISTA DE DESEOS</a>
            </li>
            <li>
                <a data-toggle="tab" href="#perfil"><i class="fa fa-user"></i> EDITAR PERFIL</a>
            </li>
            <li>
                <a href="<?php echo $url; ?>ofertas"><i class="fa fa-star"></i> VER OFERTAS</a>
            </li>
        </ul>

        <div class="tab-content">

            <!--==============================================
            COMPRAS
            ===============================================-->
            <div id="compras" class="tab-pane fade in active">

                <div class="panel-group">
                    
                    <?php 
                    
                        $item = "id_usuario";
                        $valor = $_SESSION["id"];
                        
                        $compras = ControladorUsuarios::ctrMostrarCompras($item, $valor);
                        
                        if(!$compras){
                            
                            echo '<div class="col-xs-12 text-center error404">
                                <h1><small>Oops!</small></h1>
                                <h2>Aún no tienes compras realizadas en esta tienda</h2>
                                </div>'; 
                            
                        } else {
                            
                            foreach ($compras as $key => $value1){
                                
                                $ordenar = "id";
                                $item = "id";
                                $valor = $value1["id_producto"];
                                
                                $productos = ControladorProductos::ctrListarProductos($ordenar, $item, $valor);
                                
                                //var_dump($productos);
                                foreach ($productos as $key => $value2){
                                echo   '<div class="panel panel-default">
                                            <div class="panel-body">
                                                <div class="col-md-2 col-sm-6 col-xs-12">
                                                    <figure>
                                                        <img class="img-thumbnail" src="'.$servidor.$value2["portada"].'">
                                                    </figure>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <h1><small>'.$value2["titulo"].'</small></h1>
                                                    <p>'.$value2["titular"].'</p>';
                                
                                                    if($value2["tipo"] == "virtual"){
                                                        echo '<a href="'.$url.'/curso">
                                                                    <button class="btn btn-default pull-left">Ir al curso</button>
                                                              </a> ';
                                                    } else {
                                                        
                                                        echo '<h6>Proceso de entrega: '.$value2["entrega"].' días hábiles</h6>';
                                                        
                                                        if($value1["envio"] == 0){
                                                            
                                                            echo '<div class="progress">
                                                                    <div class="progress-bar progress-bar-info" role="progressbar" style="width: 33.33%">
                                                                        <i class="fa fa-check"> Despachado</i>
                                                                    </div>
                                                                    <div class="progress-bar progress-bar-default" role="progressbar" style="width: 33.33%">
                                                                       <i class="fa fa-clock-o"> Enviando</i>
                                                                    </div>
                                                                    <div class="progress-bar progress-bar-success" role="progressbar" style="width: 33.33%">
                                                                       <i class="fa fa-clock-o"> Entregado</i>
                                                                    </div>
                                                                  </div>';
                                                        }
                                                        
                                                        if($value1["envio"] == 1){
                                                            
                                                            echo '<div class="progress">
                                                                     <div class="progress-bar progress-bar-info" role="progressbar" style="width: 33.33%">
                                                                        <i class="fa fa-check"> Despachado</i>
                                                                     </div>
                                                                     <div class="progress-bar progress-bar-default" role="progressbar" style="width: 33.33%">
                                                                        <i class="fa fa-check"> Enviando</i>
                                                                     </div>
                                                                     <div class="progress-bar progress-bar-success" role="progressbar" style="width: 33.33%">
                                                                        <i class="fa fa-clock-o"> Entregado</i>
                                                                     </div>
                                                                  </div>';
                                                        }
                                                        
                                                        if($value1["envio"] == 2){
                                                            
                                                            echo '<div class="progress">
                                                                     <div class="progress-bar progress-bar-info" role="progressbar" style="width: 33.33%">
                                                                        <i class="fa fa-check"> Despachado</i>
                                                                     </div>
                                                                     <div class="progress-bar progress-bar-default" role="progressbar" style="width: 33.33%">
                                                                        <i class="fa fa-check"> Enviando</i>
                                                                     </div>
                                                                     <div class="progress-bar progress-bar-success" role="progressbar" style="width: 33.33%">
                                                                        <i class="fa fa-check"> Entregado</i>
                                                                     </div>
                                                                  </div>';
                                                        }
                                                        
                                                    }
                                
                                                echo '<h4 class="pull-right"><smaill>Comprado el '.substr($value1["fecha"],0,10).'</small></h4>
                                                </div>
                                                
                                                <div class="col-md-4 col-xs-12">
                                                    <div class="pull-right">
                                                        <a href="#modalComentarios" data-toggle="modal" idComentario="">
                                                            <button class="btn btn-default backColor">Calificar Producto</button>
                                                        </a>
                                                    </div>
                                                    <br><br>
                                                    <div class="pull-right">
                                                        <h3 class="text-right">
                                                            <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                            <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                            <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                            <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                            <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                        </h3>
                                                        <small>
                                                            <p class="panel panel-default" style="padding: 5px">
                                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                                                                Cupiditate minus, consectetur beatae fugit odio iure 
                                                                repudiandae quia distinctio, id ducimus molestiae. 
                                                                Obcaecati, unde. Illo molestiae dolorum, saepe nisi enim iusto.
                                                            </p> 
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                }
                            }
                        }
                        
                    ?>
                    
                    
                    
                    
                    
                       
                </div>


            </div>


            <!--==============================================
            LISTA DE DESEJOS
            ===============================================-->
            <div id="deseos" class="tab-pane fade">
                <h3>Menu 1</h3>
                <p>Some content in menu 1.</p>
            </div>


            <!--==============================================
            PERFIL DE USUÁRIO
            ===============================================-->
            <div id="perfil" class="tab-pane fade">
                <div class="row">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="col-md-3 col-sm-4 col-xs-12 text-center">
                            <br>
                            <figure id="imgPerfil">
                                <?php
                                if ($_SESSION["modo"] == "directo") {

                                    echo '<input type="hidden" value="' . $_SESSION["id"] . '" name="idUsuario">';
                                    echo '<input type="hidden" value="' . $_SESSION["password"] . '" name="passUsuario">';
                                    echo '<input type="hidden" value="' . $_SESSION["foto"] . '" name="fotoUsuario">';
                                    echo '<input type="hidden" value="' . $_SESSION["modo"] . '" name="modoUsuario">';

                                    if ($_SESSION["foto"] != "") {
                                        echo '<img src="' . $url . $_SESSION["foto"] . '" class="img-thumbnail">';
                                    } else {
                                        echo '<img src="' . $servidor . 'vistas/img/usuarios/default/anonymous.png" class="img-thumbnail">';
                                    }
                                } else {
                                    echo '<img src="' . $_SESSION["foto"] . '" class="img-thumbnail">';
                                }
                                ?>

                            </figure>
                            <br>
                            <?php
                            if ($_SESSION["modo"] == "directo") {

                                echo '<button type="button" class="btn btn-default" id="btnCambiarFoto">Cambiar foto de perfil</button>';
                            }
                            ?>

                            <div id="subirImagen">
                                <input type="file" class="form-control" id="datosImagen" name="datosImagen">
                                <img class="previsualizar">

                            </div>

                        </div>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                            <?php
                            if ($_SESSION["modo"] != "directo") {

                                echo '<br><label class="control-label text-muted text-uppercase" for="editarNombre">Nombre:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input type="text" class="form-control" name="editarNombre" value="' . $_SESSION["nombre"] . '" readonly>
                                    </div><br>';
                                echo '<br><label class="control-label text-muted text-uppercase" for="editarEmail">Correo electrónico:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                        <input type="text" class="form-control" name="editarEmail" value="' . $_SESSION["email"] . '" readonly>
                                    </div><br>';
                                echo '<br><label class="control-label text-muted text-uppercase">Modo de registro en el sistema:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-' . $_SESSION["modo"] . '"></i></span>
                                        <input type="text" class="form-control" name="editarEmail" value="' . $_SESSION["modo"] . '" readonly>
                                    </div><br>';
                            } else {

                                echo '<br><label class="control-label text-muted text-uppercase" for="editarNombre">Cambiar Nombre:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input type="text" class="form-control" id="editarNombre" name="editarNombre" value="' . $_SESSION["nombre"] . '">
                                    </div><br>';
                                echo '<label class="control-label text-muted text-uppercase" for="editarEmail">Cambiar Email:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                        <input type="email" class="form-control" id="editarEmail" name="editarEmail" value="' . $_SESSION["email"] . '">
                                    </div><br>';
                                echo '<label class="control-label text-muted text-uppercase" for="editarPassword">Cambiar Contraseña:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input type="text" class="form-control" id="editarPassword" name="editarPassword" placeholder="Escribe la nueva contraseña">
                                    </div><br>';
                                echo '<button type="submit" class="btn btn-default backColor btn-md pull-left">Actualizar Datos</button>';
                            }
                            ?>
                        </div>

                            <?php
                            $actualizarPerfil = new ControladorUsuarios();
                            $actualizarPerfil->ctrActualizarPerfil();
                            ?>

                    </form>
                    <button class="btn btn-danger btn-md pull-right">Eliminar Cuenta</button>
                </div>
            </div>


        </div>
    </div>
</div>







<!--VENTANA MODAL PARA COMENTARIOS-->
<div id="modalComentarios" class="modal fade modalFormulario" role="dialog">
    <div class="modal-content modal-dialog">
        <div class="modal-body modalTitulo">
            <h3 class="backColor">CALIFICA ESTE PRODUCTO</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <form method="post">
                <h1 class="text-center" id="estrellas">
                    <i class="fa fa-star text-success" aria-hidden="true"></i>
                    <i class="fa fa-star text-success" aria-hidden="true"></i>
                    <i class="fa fa-star text-success" aria-hidden="true"></i>
                    <i class="fa fa-star text-success" aria-hidden="true"></i>
                    <i class="fa fa-star text-success" aria-hidden="true"></i>
                        
                </h1>
                
                <div class="form-group text-center">
                    <label class="radio-inline"><input type="radio" name="puntaje" value="0.5">0.5</label>
                    <label class="radio-inline"><input type="radio" name="puntaje" value="1.0">1.0</label>
                    <label class="radio-inline"><input type="radio" name="puntaje" value="1.5">1.5</label>
                    <label class="radio-inline"><input type="radio" name="puntaje" value="2.0">2.0</label>
                    <label class="radio-inline"><input type="radio" name="puntaje" value="2.5">2.5</label>
                    <label class="radio-inline"><input type="radio" name="puntaje" value="3.0">3.0</label>
                    <label class="radio-inline"><input type="radio" name="puntaje" value="3.5">3.5</label>
                    <label class="radio-inline"><input type="radio" name="puntaje" value="4.0">4.0</label>
                    <label class="radio-inline"><input type="radio" name="puntaje" value="4.5">4.5</label>
                    <label class="radio-inline"><input type="radio" name="puntaje" value="5.0" checked>5.0</label>
                </div>
                
                <div class="form-group">
                    <label for="comment" class="text-muted">
                        Tu oínión acerca de este producto: <span><small>(máximo 300 caracteres)</small></span>
                    </label>
                    <textarea class="form-control" rows="5" id="comentario" name="comentario" maxlength="300" required></textarea>
                    <br>
                    <input type="submit" class="btn btn-default backColor btn-block" value="ENVIAR">
                </div>
                
            </form>
        </div>
        <div class="modal-footer">
            
        </div>
    </div>
</div>