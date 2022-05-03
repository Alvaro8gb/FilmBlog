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
    <table class ="tabla_ranking">
      <tr>
          <th>PELICULA</th>
          <th>PUNTUACION</th>
      </tr>
EOS;


$maxRanking = 5;
$conn = $app->getConexionBd();
$sql = sprintf("SELECT idpelicula, avg(puntuacion) as sumaPuntuacion FROM puntuaciones GROUP BY idpelicula ORDER BY sumaPuntuacion desc LIMIT $maxRanking ");
$consulta = @mysqli_query($conn, $sql);
while($fila = @mysqli_fetch_array($consulta)){
    $sql2 = sprintf("SELECT titulo FROM peliculas WHERE idpelicula = '%s'", $conn->real_escape_string($fila["idpelicula"]));
    $consulta2 = @mysqli_query($conn, $sql2);
    $fila2 = @mysqli_fetch_array($consulta2);
    $puntuacion = intval($fila["sumaPuntuacion"]);
    $contenidoPrincipal .= <<<EOS
      <tr>
      <td>{$fila2["titulo"]}</td>
      <td id ="puntuacion">$puntuacion</td>
      </tr>
    EOS;
}

$consulta->free();


$contenidoPrincipal .= <<<EOS
  </table>
  </div>
  EOS;


$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css' => $css];
$app->generaVista('/plantillas/plantilla.php', $params);