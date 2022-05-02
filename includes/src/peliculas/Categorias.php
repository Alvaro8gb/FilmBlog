<?php

namespace es\abd\peliculas;

use es\abd\Aplicacion;


class Categorias{
    private $lista;

    public function __construct(){
        $this->lista = array();

        $this->load();

    }

    private function load(){
        $app = Aplicacion::getInstancia();
        $conn = $app->getConexionBd();
        $sql = "SELECT distinct categoria FROM peliculas";
        $conn = @mysqli_query($conn, $sql);
        while($fila = @mysqli_fetch_array($conn)){
            array_push($this->lista,$fila["categoria"]);
        }
        $conn->free();
    }

    public function mostrar_categorias(){

        $html = "";
        
        foreach( $this->lista as $categoria){

            $html .= <<< EOS
            <li> 
                <a href='categoria.php?categoria=$categoria'>$categoria</a>
            </li>
            EOS;
        }

        return $html;

        

    }

    

}