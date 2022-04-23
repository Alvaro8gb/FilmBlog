<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

$categoria = $_GET["categoria"];
$tituloPagina = $categoria;


$css = link_css($app->resuelve(RUTA_CSS.'peliculas.css'));

$peliculas = new \es\abd\peliculas\Peliculas();

$contenidoPrincipal = "<h2> $categoria </h2> ";

$contenidoPrincipal .= $peliculas->mostrar_por_categoria($categoria);

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css' => $css];
$app->generaVista('/plantillas/plantilla.php', $params);