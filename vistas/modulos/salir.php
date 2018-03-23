<?php

session_destroy();

$url = ruta::ctrRuta();

if(!empty($_SESSION['id_token_google'])){
    unset($_SESSION['id_token_google']);
}

echo '<script> '
        . 'window.location = "'.$url.'" '
        . '</script>';