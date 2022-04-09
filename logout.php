<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';


if (strtoupper($_SERVER['REQUEST_METHOD']) !== 'POST') {
    $app->redirige('/index.php');
}

$formLogout = new \es\abd\usuarios\FormularioLogout();
$formLogout->gestiona();