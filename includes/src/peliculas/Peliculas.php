<?php

namespace es\abd\peliculas;

use es\abd\Aplicacion;
use es\abd\Lista;

class Peliculas extends Lista{
    private const TABLE ="peliculas";

    public function __construct(){
        parent::__construct(self::TABLE);
    }

    protected function crearElem($fila){
        return new Pelicula($fila["titulo"],$fila["director"],$fila["descripcion"],$fila["imagen"],$fila["categoria"],$fila["idpelicula"]);
    }

    private function mostrarPeliculas($peliculas){
        $html = '<div class="tabla"><div class="grid-container">';
        
        foreach($peliculas as $id => $pelicula){
            $puntuacionPelicula = "";
            for($i = 0;  $i < $pelicula->getPuntuacion(); $i++){
                $puntuacionPelicula .= '<p class=puntuacionPositiva>★</p>';                   
            }
            for($i = $pelicula->getPuntuacion();  $i < 5; $i++){
                $puntuacionPelicula .= '<p class=puntuacionNegativa>★</p>';                   
            }
            
            if(strlen($pelicula->getDescripcion()) >= 300){
                $desc = substr($pelicula->getDescripcion(),0,300) .'...';
            }else{
                $desc = $pelicula->getDescripcion();
            }

            $imagen = $pelicula->getImagen();
            $alt = "imagen_".$pelicula->getTitulo();
            $htmlImagen = '<a href="peliculas.php?id='.$id.'">
                                <div class="todoPelicula">
                                    <img class="peliculasImg" src="data:image/png;base64,'.base64_encode($imagen).'" alt ="'.$alt.'_img">
                                    <div class="peliculasTexto">
                                        <h1>'. $pelicula->getTitulo() .'<h1>
                                        <p><b>DIRECTOR: </b>'.$pelicula->getDirector().'</p><br>
                                        <p><b>CATEGORIA: </b>'.$pelicula->getCategoria().'</p>
                                        <p><b>DESCRIPCION: </b>'.$desc .'</p>
                                        <div class=puntuaciones>'.$puntuacionPelicula.'</div>
                                    </div>
                                </div>
                            </a>';
            
            $html .= ' <div class="grid-item"> '. $htmlImagen.'</div> ';
        }

        $html.='</div></div>';
        
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

    private function generarPuntuacionPelicula($puntuacion){

        $puntuacionPelicula = "";

        for($i = 0;  $i < $puntuacion; $i++){
            $puntuacionPelicula .= '<p class=puntuacionGeneralPositiva>★</p>';                   
        }
        for($i = $puntuacion;  $i < 5; $i++){
            $puntuacionPelicula .= '<p class=puntuacionGeneralNegativa>★</p>';                   
        }

        return $puntuacionPelicula;

    }

    protected function mostrarElem($datos){
                
        $id_pelicula = filter_var(trim($datos["id"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);  
        $pelicula = parent::getElement($id_pelicula);
        $app = Aplicacion::getInstancia();
       
        if(isset($_POST["estrellas"]) && $pelicula->votado($_SESSION['idUsuario']) == 0){
            $pelicula->nuevaPuntuacion($_SESSION['idUsuario'], $_POST["estrellas"]);
            $app->redirige($_SERVER['PHP_SELF']."?id=$id_pelicula");
        }

        $imagen = $pelicula->getImagen();
        $alt = "imagen_".$pelicula->getTitulo();

       $puntuacionPelicula = $this->generarPuntuacionPelicula($pelicula->getPuntuacion());
        
        if($_SESSION['login'] == false){
            $votar = '<h2 class="votoTexto2">Inicie sesion para puntuar</h2>';
        }
        else{
            $votar = <<< EOS
                    <div class="votar"> 
                        <p class="votoTexto"><b>Tu voto</b><p>
                        <br>
                    <div class= "votoIndividual"> 
            EOS;
                
            $puntuacionUsuario = $pelicula->votado($app->idUsuario()) ;
            if($puntuacionUsuario == 0){
                $votar = <<< EOS
                    <form action="" method="post" id = "my_form">
                        <p class="clasificacion">
                            <input id="radio1" type="radio" name="estrellas" value="5" ><!--
                            --><label for="radio1">★</label><!--
                            --><input id="radio2" type="radio" name="estrellas" value="4" ><!--
                            --><label for="radio2">★</label><!--
                            --><input id="radio3" type="radio" name="estrellas" value="3" ><!--
                            --><label for="radio3">★</label><!--
                            --><input id="radio4" type="radio" name="estrellas" value="2" ><!--
                            --><label for="radio4">★</label><!--
                            --><input id="radio5" type="radio" name="estrellas" value="1" ><!--
                            --><label for="radio5">★</label>
                            <button type="submit" class="buton_estrellas"name="puntuar">Puntuar</button>
                        </p>

                         
                    </form>
                </div>
                EOS;
            }
            else{
                $puntuacionIndividual = $this->generarPuntuacionPelicula($puntuacionUsuario);
                $votar .= <<<EOS
                    <div class="tusEstrellas">
                        $puntuacionIndividual
                    </div>
                 EOS;
            }
        }
        $votar .= '</div>';


        $html  = ' <div class="todoPeliculaIndividual">
            <img class="peliculasImgIndividual" src="data:image/png;base64,'.base64_encode($imagen).'" alt ="'.$alt.'_img">
            <div class="peliculasTextoIndividual">
                <h1 class="tituloIndividual">'. $pelicula->getTitulo() .'<h1><br>
                <p class="textoIndividual"><b>DIRECTOR: </b>'.$pelicula->getDirector().'</p><br>
                <p class="textoIndividual"><b>CATEGORIA: </b>'.$pelicula->getCategoria().'</p><br>
                <p class="textoIndividual"><b>DESCRIPCION: </b>'.$pelicula->getDescripcion() .'</p>
                <div class="puntuacionesIndividual">
                    <div class="puntuacionesGeneralIndividual">'.$puntuacionPelicula.'</div>
                    '.$votar.'
                </div>
            </div>
        </div>';
        

        return $html;

    }

}