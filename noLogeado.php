<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'No logeado';

$contenidoPrincipal =<<<EOS
        <h1>¡Usuario no registrado!</h1>
        <p id="cl">Debes iniciar sesión para ver el contenido.</p> 
EOS;

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantilla.php', $params);