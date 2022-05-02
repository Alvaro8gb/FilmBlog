<?php
require_once __DIR__.'/includes/config.php';

use es\abd\usuarios\FormularioLogout;

$tituloPagina='Logout';

$nombreUsuario = $app->nombreUsuario();

$formLogout = new FormularioLogout();
$htmlLogout = $formLogout->gestiona();
$contenidoPrincipal = "<div> <br><br><p> Seguro que desea salir $nombreUsuario ? </p> $htmlLogout </div>";

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantilla.php', $params);

exit();