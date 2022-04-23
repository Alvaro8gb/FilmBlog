<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';


$tituloPagina = 'Login';

$contenidoPrincipal = "";

$css = link_css($app->resuelve(RUTA_CSS.'blog.css'));

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css' => $css];
$app->generaVista('/plantillas/plantilla.php', $params);