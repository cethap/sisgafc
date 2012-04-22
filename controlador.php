<?php

    include'bislogica/bislogica.php';
    include 'dao/dao.php';
    error_reporting(E_ALL);
    session_start();
    $asignaget="";
    foreach($_POST as $nombre_campo => $valor){
       $asignacion[$nombre_campo] = $valor ;
    }
    foreach($_GET as $nombcampo => $val){
       $asignaget[$nombcampo] = $val ;
    }
    $dao="";
    $dao2="jj";
    $bislogica= new bislogic($dao,$asignaget,$asignacion);
    echo $bislogica->msg;

?>
