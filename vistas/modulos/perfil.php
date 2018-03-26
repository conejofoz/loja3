
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
                <h3>HOME</h3>
                <p>Some content.</p>
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
                                
                                echo '<button class="btn btn-default">Cambiar foto de perfil</button>';

                            }
                            ?>

                        </div>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                            <?php
                            
                            if ($_SESSION["modo"] != "directo") {
                                
                                echo '<br><label class="control-label text-muted text-uppercase" for="editarNombre">Nombre:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input type="text" class="form-control" name="editarNombre" value="'.$_SESSION["nombre"].'" readonly>
                                    </div><br>';
                                echo '<br><label class="control-label text-muted text-uppercase" for="editarEmail">Correo electrónico:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                        <input type="text" class="form-control" name="editarEmail" value="'.$_SESSION["email"].'" readonly>
                                    </div><br>';
                                echo '<br><label class="control-label text-muted text-uppercase">Modo de registro en el sistema:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-'.$_SESSION["modo"].'"></i></span>
                                        <input type="text" class="form-control" name="editarEmail" value="'.$_SESSION["modo"].'" readonly>
                                    </div><br>';

                            } else {
                                
                                echo '<br><label class="control-label text-muted text-uppercase" for="editarNombre">Cambiar Nombre:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input type="text" class="form-control" id="editarNombre" name="editarNombre" value="'.$_SESSION["nombre"].'">
                                    </div><br>';
                                echo '<label class="control-label text-muted text-uppercase" for="editarEmail">Cambiar Email:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                        <input type="email" class="form-control" id="editarEmail" name="editarEmail" value="'.$_SESSION["email"].'">
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

                    </form>
                    <button class="btn btn-danger btn-md pull-right">Eliminar Cuenta</button>
                </div>
            </div>


        </div>
    </div>
</div>
<label class="control-label text-muted text-uppercase" for="editarNombre">Nombre:</label>
<div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
    <input type="text" class="form-control" id="editarNombre" name="editar" value="" readonly >
</div>
<br>

