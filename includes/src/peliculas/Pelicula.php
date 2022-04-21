<?php

namespace es\abd\peliculas;


class Pelicula{
    private $titulo;
    private $director;
    private $fechaEstreno;
    private $imagen;
    private $categoria;

    public function __construct($titulo, $director, $fechaEstreno, $imagen, $categoria){
        $this->nombre = $titulo;
        $this->autor = $director;
        $this->fechaEstreno = $fechaEstreno;
        $this->imagen = $imagen;
        $this->categoria = $categoria;

    }

    public function getTitulo(){
        return $this->titulo;
    }

    public function getDirector(){
        return $this->director;
    }

    public function getFechaEstreno(){
        return $this->fechaEstreno;
    }

    public function getImagen(){
        return $this->imagen;
    }

    public function getCategoria(){
        return $this->categoria;
    }
    

}