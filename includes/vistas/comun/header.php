
<?php

use es\abd\Aplicacion;
require_once __DIR__.'/../helpers/utils.php';
$app = Aplicacion::getInstancia();


function usuarioInfo($app){
    $html = '';
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
                  <a class="navbar-brand" href="#"> <?=$app->getName()?></a>
               </div>
               <div id="navbar" class="navbar-collapse collapse">
                  <ul class="nav navbar-nav">
                     <li class="active">
                        <a href="index.php">Home</a>
                     </li>
                     <li class="dropdown">
                        <a href="index.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                           Films
                        <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                           <li>
                              <a href="index.php#historia">Buscador</a>
                           </li>
                           <li role="separator" class="divider"></li>
                           <li class="dropdown-header">Categorias</li>
                           <li>
                              <a href="index.php#luz">Accion</a>
                           </li>
                           <li>
                              <a href="index.php#celula">Miedo</a>
                           </li>
                        </ul>
                        <li>
                        <a href="contacto.php">Contact</a>
                        </li>
                     </li>
                     <li>
                        <?=usuarioInfo($app);?>
                        
                     </li>
                  </ul>
               </div>
            </div>
   </nav>

        

         <!--Fin de la barra de navegación -->
