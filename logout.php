<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';


if (strtoupper($_SERVER['REQUEST_METHOD']) !== 'POST') {
    $app->redirige('/index.php');
}

$formLogout = new \es\abd\usuarios\FormularioLogout();
$htmlFormLogout = $formLogout->gestiona();

$contenidoPrincipal = $htmlFormLogout;

$css = link_css($app->resuelve(RUTA_CSS.'formulario.css'));

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css' => $css];
$app->generaVista('/plantillas/plantilla.php', $params);