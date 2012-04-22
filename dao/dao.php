<?php
include ("conexion.php");


class dao{
    
function consulta(){}
function inserta(){}
function actualiza(){}
function elimina(){}

function execute($exec){
    $exe= new coneccion();
    return $exe->hacercon($exec);
}

}

?>