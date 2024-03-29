<?php

namespace es\abd\peliculas;
use es\abd\Aplicacion;

class Pelicula{
    private $titulo;
    private $director;
    private $fechaEstreno;
    private $descripcion;
    private $imagen;
    private $categoria;
    private $id;
    private $puntuacion;

    public function __construct($titulo, $director, $descripcion, $imagen, $categoria,$id){
        $this->titulo = $titulo;
        $this->director = $director;
        $this->descripcion = $descripcion;
        $this->imagen = $imagen;
        $this->categoria = $categoria;
        $this->id = $id;

        self::setPuntuacion();
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

    public function getPuntuacion(){
        return $this->puntuacion;
    }
    
    public function votado($idUsuario){
        $app = Aplicacion::getInstancia();
        $conn = $app->getConexionBd();
        $sql = sprintf("SELECT puntuacion FROM puntuaciones WHERE idpelicula = '%d' AND idusuario = '%d'",$this->id,$idUsuario);
        $conn = @mysqli_query($conn, $sql);

        if($fila = @mysqli_fetch_array($conn)){
            return $fila["puntuacion"];
        }
        return 0;
        
    }
    private function setPuntuacion(){
        $app = Aplicacion::getInstancia();
        $conn = $app->getConexionBd();
        $sql = sprintf("SELECT AVG(puntuacion) AS media, COUNT(*) as users FROM puntuaciones WHERE idpelicula = '%d'",$this->id);
        $conn = @mysqli_query($conn, $sql);

        $fila = @mysqli_fetch_array($conn);

        if($fila["users"] != 0){
            $this->puntuacion = intval($fila["media"]);
        }
        else{
            $this->puntuacion = 0;
        }
    }

    public function nuevaPuntuacion($userId, $puntuacion){
        $app = Aplicacion::getInstancia();
        $conn = $app->getConexionBd();
        $query = sprintf("INSERT INTO puntuaciones VALUES ('%d' ,'%d', '%d')",$this->id,$userId, $puntuacion);
        $res = @mysqli_query($conn, $query);
        $this->setPuntuacion();
    }

}