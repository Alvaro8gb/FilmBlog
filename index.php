<?php
require_once __DIR__.'/includes/config.php';

$tituloPagina = "Home";

ob_start();
require __DIR__.'/static/carrousel.html';
$contenidoPrincipal = ob_get_clean();

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css'=> $css];
$app->generaVista('/plantillas/plantilla.php', $params);