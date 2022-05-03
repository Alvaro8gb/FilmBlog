<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

$tituloPagina = 'Films';
$css = link_css($app->resuelve(RUTA_CSS.'peliculas.css'));
try{
    $peliculas = new \es\abd\peliculas\Peliculas();
    $contenidoPrincipal = $peliculas->gestiona();;      

}catch(\Exception $e){
    $app->paginaError(501,'Error',"Error en peliculas: ".$e->getMessage(),$e->getTrace());
}

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css' => $css];
$app->generaVista('/plantillas/plantilla.php', $params);