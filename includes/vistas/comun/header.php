
<?php


use es\abd\Aplicacion;
use es\abd\peliculas\Categorias;

use es\abd\usuarios\FormularioLogout;



try{
   require_once __DIR__.'/../helpers/utils.php';
   
   $app = Aplicacion::getInstancia();
   $categorias = new Categorias();
   
   $menu_categorias = $categorias->mostrar_categorias();
   
   $usuario_info = usuarioInfo($app);
  
}catch(\Exception $e){
   $app->paginaError(501,'Error',"Error en header: ".$e->getMessage(),$e->getTrace());
}


function usuarioInfo($app){
    $html = '';
    if ($app->usuarioLogueado()) {

      $logoutUrl = $app->resuelve("/logout.php");
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
                  <a class="navbar-brand" href="#"> Fav-Films</a>
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
                              <a href="peliculas.php">Todas</a>
                           </li>
                           <li role="separator" class="divider"></li>
                           <li class="dropdown-header">Categorias</li>
                           <?= $menu_categorias ?>
                        </ul>
                        <li>
                        <a href="contacto.php">Contact</a>
                        </li>
                     </li>
                     <li>
                        <?= $usuario_info ?>
                        
                     </li>
                  </ul>
               </div>
            </div>
   </nav>

        

         <!--Fin de la barra de navegación -->
