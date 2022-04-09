<?php

function enlace($elc, $name){
    return '<li><a href='.'"'.$elc.'">'.$name.'</a></li>';
}

function link_css($path){
    return "<link rel='stylesheet' type='text/css' href={$path}>". "\n\t\t";
}

function img($path, $alt){

}

function redirectIndex(){
    return header("refresh:4;url=index.php");
}