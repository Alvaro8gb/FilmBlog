<?php

namespace es\abd\puntuaciones;


class Puntuacion{
    private $puntuacion;
    private $idUsuario;
    private $idPelicula;
    private $nombrePelicula;

    public function __construct($puntuacion, $idUsuario, $idPelicula, $nombrePelicula){
        $this->puntuacion = $puntuacion;
        $this->idUsuario = $idUsuario;
        $this->idPelicula = $idPelicula;
        $this->nombrePelicula = $nombrePelicula;
    }

    public function getPuntuacion(){
        return $this->puntuacion;
    }

    public function getIdUsuario(){
        return $this->idUsuario;
    }

    public function getIdPelicula(){
        return $this->idPelicula;
    }

    public function getNombrePelicula(){
        return $this->nombrePelicula;
    }
    
}