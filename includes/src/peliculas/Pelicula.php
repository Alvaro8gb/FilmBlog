<?php

namespace es\abd\peliculas;


class Pelicula{
    private $titulo;
    private $director;
    private $fechaEstreno;
    private $descripcion;
    private $imagen;
    private $categoria;

    public function __construct($titulo, $director, $descripcion, $imagen, $categoria){
        $this->titulo = $titulo;
        $this->director = $director;
        $this->descripcion = $descripcion;
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
    public function getDescripcion(){
        return $this->descripcion;
    }

    public function getImagen(){
        return $this->imagen;
    }

    public function getCategoria(){
        return $this->categoria;
    }
    

}