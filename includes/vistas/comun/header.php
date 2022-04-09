
<?php

use es\abd\Aplicacion;
require_once __DIR__.'/../helpers/utils.php';


function mostrarSaludo(){
    $html = '';
    $app = Aplicacion::getInstancia();
    if ($app->usuarioLogueado()) {
        $logoutUrl =  $app->resuelve('/logout.php');
        $html = <<<EOS
        <li><a href="{$logoutUrl}">Logout</a> </li>
      EOS;
    } else {
        $loginUrl = $app->resuelve('/login.php');
        $registroUrl = $app->resuelve('/registro.php');
        $html = <<<EOS
        <li><a href="{$loginUrl}">Login</a> </li> 
        <li><a href="{$registroUrl}">Sing up</a> </li>
      EOS;
    }

    return $html;
}

?>

    <nav class="navbar navbar-inverse navbar-fixed-top bg-dark">
            <div class="container">
               <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="#">LIBROS</a>
               </div>
               <div id="navbar" class="navbar-collapse collapse">
                  <ul class="nav navbar-nav">
                     <li class="active">
                        <a href="index.php">Home</a>
                     </li>
                     <li>
                        <a href="contacto.php">Contact</a>
                     </li>
                     <li class="dropdown">
                        <a href="index.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu
                        <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                           <li>
                              <a href="index.php#historia">Historia de la electronica</a>
                           </li>
                           <li>
                              <a href="index.php#introduccion">Introducción a los semiconductores</a>
                           </li>
                           <li>
                              <a href="index.php#union">Unión p-n</a>
                           </li>
                           <li>
                              <a href="index.php#diodo">El diodo como elemento de un circuito</a>
                           </li>
                           <li role="separator" class="divider"></li>
                           <li class="dropdown-header">Dispositivos optoelectrónicos</li>
                           <li>
                              <a href="index.php#luz">Absorción y emisión de luz por la materia</a>
                           </li>
                           <li>
                              <a href="index.php#celula">La célula solar</a>
                           </li>
                           <li>
                              <a href="index.php#emisor">El diodo emisor de luz</a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <?=mostrarSaludo();?>
                        
                     </li>
                  </ul>
               </div>
            </div>
   </nav>

        

         <!--Fin de la barra de navegación -->
