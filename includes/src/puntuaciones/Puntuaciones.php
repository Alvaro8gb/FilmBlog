<?php

namespace es\abd\puntuaciones;


class Puntuacion{
    private $puntuacion;
    private $idUsuario;
    private $idPelicula;
    private $nombrePelicula;

    public function __construct($puntuacion, $idUsuario, $fecha, $comentario, $idPelicula, $nombrePelicula){
        $this->puntuacion = $puntuacion;
        $this->idUsuario = $idUsuario;
        $this->fecha = $fecha;
        $this->comentario = $comentario;
        $this->idPelicula = $idPelicula;
        $this->nombrePelicula = $nombrePelicula;

    }

    public function getPuntuacion(){
        return $this->puntuacion;
    }

    public function getIdUsuario(){
        return $this->idUsuario;
    }

    public function getFecha(){
        return $this->fecha;
    }
    public function getComentario(){
        return $this->comentario;
    }

    public function getIdPelicula(){
        return $this->idPelicula;
    }

    public function getNombrePelicula(){
        return $this->nombrePelicula;
    }
    
}