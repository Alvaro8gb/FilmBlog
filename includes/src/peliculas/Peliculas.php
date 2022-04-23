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
            $titulo = "imagen_".$pelicula->getTitulo();
            $htmlImagen = '<a href="peliculas.php?id='.$id.'"><img class="juego" src="data:image/png;base64,'.base64_encode($imagen).'" alt ="'.$titulo.'_img"></a>';
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

        /*$ruta_imagenes = self::$ruta_imagenes;
        $id_juego = filter_var(trim($datos["id"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);  
        $juego = parent::getElement($id_juego);
       
        $html = '<div class = "img_juego">
        <img class="juego" src="data:image/png;base64,'.base64_encode($juego->getImagen()).'"/>
        </div>';

        $html .= <<< EOS
        <div class = "boton_exit">
            <a href="juegos.php"><img src="{$ruta_imagenes}exit.png" alt="Exit"></a>
        </div>
        <div class = "boton_play_now">
            <a href="{$juego->getEnlace()}"><img src="{$ruta_imagenes}play.png" alt="Play Now"></a>
        </div>
        <div class = "boton_ranking">
            <a href="ranking.php#{$juego->getId()}"><img src="{$ruta_imagenes}ranking.png" alt="Ranking"></a>
        </div>
        <div class = "informacion">
            <p><b>Título: </b>{$juego->getNombre()}</p>
            <p><b>Categoría: </b>{$juego->getCategoria()}</p>
            <p><b>Descripción: </b>{$juego->getDesc()}</p>
        </div>
    EOS;

    return $html;

    */

    }

}