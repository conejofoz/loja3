<?php

session_destroy();

$url = ruta::ctrRuta();

echo '<script> '
        . 'window.location = "'.$url.'" '
        . '</script>';