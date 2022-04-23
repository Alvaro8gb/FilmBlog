<?php

namespace es\abd\peliculas;
use es\abd\Lista;

class Peliculas extends Lista{
    private const TABLE ="peliculas";

    public function __construct(){
        parent::__construct(self::TABLE);
    }

    protected function crearElem($fila){
        return new Pelicula($fila["titulo"],$fila["director"],$fila["descripcion"],$fila["imagen"],$fila["categoria"]);
    }

    private function mostrarPeliculas($peliculas){

        $html = '<div class="grid-container">';
        
        foreach($peliculas as $id => $pelicula){

            $imagen = $pelicula->getImagen();
            $alt = "imagen_".$pelicula->getTitulo();
            $htmlImagen = '<a href="peliculas.php?id='.$id.'"><img class="juego" src="data:image/png;base64,'.base64_encode($imagen).'" alt ="'.$alt.'_img"></a>';
            $html .= ' <div class="grid-item"> '.$htmlImagen.'</div>';
        }

        $html.='</div>';


        return $html;

    }

    protected function mostrarElems(){
        return $this->mostrarPeliculas($this->lista);
        
    }

    public function mostrar_por_categoria($categoria){
        
        $peliculas_categoria = array();

        foreach($this->lista as $id => $pelicula){
            
           if($pelicula->getCategoria() == $categoria){
            $peliculas_categoria[$id] = $pelicula;
           }
        }

        return $this->mostrarPeliculas($peliculas_categoria);
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