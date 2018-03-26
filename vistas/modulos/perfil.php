
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
                <a href="<?php echo $url;?>ofertas"><i class="fa fa-star"></i> VER OFERTAS</a>
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
                                
                                    if($_SESSION["modo"] == "directo"){
                                        
                                        if($_SESSION["foto"] != ""){
                                            echo '<img src="'.$url.$_SESSION["foto"].'" class="img-thumbnail">';
                                        } else {
                                            echo '<img src="'.$servidor.'vistas/img/usuarios/default/anonymous.png" class="img-thumbnail">';
                                        }
                                        
                                    } else {
                                       echo '<img src="'.$_SESSION["foto"].'" class="img-thumbnail">'; 
                                    }
                                
                                ?>
                                
                            </figure>
                        </div>
                        <div class="col-md-9 col-sm-8 col-xs-12"></div>
                        
                    </form>
                </div>
            </div>
            
            
        </div>
    </div>
</div>