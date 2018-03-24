
<!--=================================================
VALIDAR SESIÓN
==================================================-->
<?php
$url = ruta::ctrRuta();

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
            <li class="active"><a data-toggle="tab" href="#home">MIS COMPRAS</a></li>
            <li><a data-toggle="tab" href="#menu1">MI LISTA DE DESEOS</a></li>
            <li><a data-toggle="tab" href="#menu1">EDITAR PERFIL</a></li>
            <li><a data-toggle="tab" href="#menu1">VER OFERTAS</a></li>
        </ul>

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <h3>HOME</h3>
                <p>Some content.</p>
            </div>
            <div id="menu1" class="tab-pane fade">
                <h3>Menu 1</h3>
                <p>Some content in menu 1.</p>
            </div>
        </div>
    </div>
</div>