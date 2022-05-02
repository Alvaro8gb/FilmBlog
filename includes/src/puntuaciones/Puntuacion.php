<?php

namespace es\abd\puntuaciones;
use es\abd\Lista;

class Peliculas extends Lista{
    private const TABLE ="puntuaciones";

    public function __construct(){
        parent::__construct(self::TABLE);
    }

    protected function crearElem($fila){
        //return new Puntuacion($fila["titulo"],$fila["director"],$fila["descripcion"],$fila["imagen"],$fila["categoria"]);
    }

    public function mostrarPuntacionesByIdPelicula($id){

    }

    public function mostrarPuntacionesByUsuario(){

    }
    protected function mostrarElems(){
         
        
    }


    protected function mostrarElem($datos){

        $id_pelicula = filter_var(trim($datos["id"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);  
        $pelicula = parent::getElement($id_pelicula);
       
        $html = <<< EOS
        <div class="container">
            <div class="col"> Titulo {$pelicula->getTitulo()}</div>
            <div class="col"> Director {$pelicula->getDirector()}</div>
            <div class="col"> Fecha de estreno {$pelicula->getFechaEstreno()}</div>
            <div class="col"> Categoria {$pelicula->getCategoria()}</div>
            <div class="col"> Descripcion  {$pelicula->getDescripcion()}</div>

        </div>
        EOS;

        return $html;

    }

}