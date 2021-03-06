<!--FOOTER-->
<footer class="container-fluid">
    <div class="container wow fadeInDown" data-wow-duration="2s">
        <div class="row">
            <!--CATEGORIAS E SUBCATEGORIAS-->
            <div class="col-lg-5 col-md-6 col-xs-12 footerCategorias">
                <?php
                $url = ruta::ctrRuta();
                $item = null;
                $valor = null;
                $categorias = ControladorProductos::ctrMostrarCategorias($item, $valor);

                foreach ($categorias as $key => $value) {
                    if ($value["estado"] != 0) {
                        echo '<div class="col-lg-4 col-md-3 col-sm-4 col-xs-12 footerCategorias">
                            <h4><a href="' . $url . $value["ruta"] . '" class="pixelCategorias" titulo="' . $value["categoria"] . '">' . $value["categoria"] . '</a></h4>
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
                        echo '</ul>
                          </div>';
                    }
                }
                ?>



            </div>


            <!--DADOS CONTACTO-->
            <div class="col-md-3 col-sm-6 col-xs-12 infoContacto">
                <h5>Dudas e inquietudes, contáctenos en:</h5>
                <br>
                <h5>
                    <i class="fa fa-phone-square" aria-hidden="true"></i>(595)-061-512216 - Infinity Matriz
                    <br><br>
                    <i class="fa fa-phone-square" aria-hidden="true"></i>(595)-061-500628 - Filial Sax
                    <br><br>
                    <i class="fa fa-phone-square" aria-hidden="true"></i>(595)-046-242456 - Filial Salto
                    <br><br>
                    <a href="https://api.whatsapp.com/send?l=pt_br&phone=595986824566" target="blank">
                        <i class="fa fa-whatsapp" aria-hidden="true"></i>+595-986-824566</a>
                    <br><br>
                    <i class="fa fa-envelope" aria-hidden="true"></i>ecommerce@infinity-group.net
                    <br><br>
                    <i class="fa fa-map-marker" aria-hidden="true"></i>Av. Sán Blás, 136
                    <br><br>
                    Ciudad del Este | Paraguay
                </h5>



            </div>



            <!--FORMULARIO CONTÁCTENOS-->
            <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12 formContacto " id="formContacto">
                <h4>Formulario de contacto</h4>
                <form role="form" method="POST" onsubmit="return validarContactenos()">
                    <input type="text" id="nombreContactenos" name="nombreContactenos" class="form-control" placeholder="Escriba su nombre" required>
                    <br>
                    <input type="email" id="emailContactenos" name="emailContactenos" class="form-control" placeholder="Escriba su correo electrónico" required>
                    <br>
                    <textarea id="mensajeContactenos" name="mensajeContactenos" class="form-control" placeholder="Escriba su mensaje" rows="5" required></textarea>
                    <br>
                    <input type="submit" value="Enviar" class="btn btn-default backColor pull-right" id="enviar">
                </form>

                <?php
                $contactenos = new ControladorUsuarios();
                $contactenos->ctrFormularioContactenos();
                ?>

            </div>

        </div>
    </div>
</footer>


<div class="container-fluid final anime anime-start" id="mapaLocalizacao" data-wow-duration='3s'>
    <!--<div class="container">-->
        <div class="row">
            <div class="col-xs-12 text-left text-muted">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3600.888409007901!2d-54.6109664567692!3d-25.508767917315215!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94f685599ba0e249%3A0xf6988af036f41039!2sInfinity+Group+S.A.!5e0!3m2!1spt-BR!2sbr!4v1525058948947" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
    <!--</div>-->
</div>

<!--FINAL-->
<div class="container-fluid final">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-xs-12 text-left text-muted">
                <h5>&copy; 2018 Todos los derechos reservados. Sitio elaborado por Silvio Coelho</h5>
            </div>

            <div class="col-sm-6 col-xs-12 text-right social">
                <ul>
                    <?php
                    $social = ControladorPlantilla::ctrEstiloPlantilla();

                    $jsonRedesSociales = json_decode($social["redesSociales"], true);
                    foreach ($jsonRedesSociales as $key => $value) {
                        echo '<li>
				<a href="' . $value["url"] . '" target="_blank">
                                    <i class="fa ' . $value["red"] . ' redSocial ' . $value["estilo"] . '" arial-hidden="true"></i>
				</a>
                            </li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<a href="https://api.whatsapp.com/send?l=pt_br&phone=595986824566" target="blank"><img src="https://i.imgur.com/XMsxHpu.png" style="height:40px; position:fixed; bottom: 25px; left: 25px; z-index:100;" data-selector="img"></a>
