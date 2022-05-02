<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';


$tituloPagina = "Home";

ob_start();
require_once __DIR__.'/static/carrousel.html';
$contenidoPrincipal = ob_get_clean();

$css = link_css($app->resuelve(RUTA_CSS.'ranking.css'));

$contenidoPrincipal .= <<<EOS
<div id="container_ranking">
   <div class = "move"> 
      <span id = "ranking">TOP Peliculas</span>
      <div class="liquid"></div>
   </div>
    <table class ="out">
      <tr>
          <th>PELICULA</th>
          <th>PUNTUACION</th>
      </tr>
EOS;

/*
$conn = $app->getConexionBd();
$sql = sprintf("SELECT IdJugador, sum(Puntuacion) as SumaPuntos FROM ranking GROUP BY IdJugador ORDER BY SumaPuntos desc LIMIT $maxNumJugadores ");
$consulta = @mysqli_query($conn, $sql);
while($fila = @mysqli_fetch_array($consulta)){
    $sql2 = sprintf("SELECT  nombreUsuario FROM usuarios WHERE IdUsuario = '%s'", $conn->real_escape_string($fila["IdJugador"]));
    $consulta2 = @mysqli_query($conn, $sql2);
    $fila2 = @mysqli_fetch_array($consulta2);
    $contenidoPrincipal .= <<<EOS
      <tr>
      <td>{$fila2["nombreUsuario"]}</td>
      <td>{$fila["SumaPuntos"]}</td>
      </tr>
    EOS;
}

$consulta->free();

*/
$contenidoPrincipal .= <<<EOS
  </table>
  </div>
  EOS;


$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css' => $css];
$app->generaVista('/plantillas/plantilla.php', $params);