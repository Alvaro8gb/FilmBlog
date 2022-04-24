<?php

namespace es\abd\usuarios;

use es\abd\Aplicacion;
use es\abd\Formulario;

class FormularioLogout extends Formulario
{
    public function __construct() {
        parent::__construct('formLogout', [
            'urlRedireccion' => Aplicacion::getInstancia()->resuelve('/index.php')
        ]);
    }

    protected function generaCamposFormulario(&$datos){

        $camposFormulario = <<<EOS
            <div class="logout">
            <button class="liquid" type="submit">
                <span>Salir</span>
            </button>
            </div>
        EOS;
        return $camposFormulario;
    }


    protected function procesaFormulario(&$datos){
        $app = Aplicacion::getInstancia();
        $app->logout();
        $mensajes = ['Hasta pronto!'];
        $app->putAtributoPeticion('mensajes', $mensajes);
        $result = $app->resuelve('/index.php');

        return $result;
    }
}