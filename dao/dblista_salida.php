<?php

class dblista_salida extends dao{
    function consulta($logica){
        if($logica=="cn"){
        return 'SELECT * FROM lista_salida';
        }else if($logica=="co"){
            return "SELECT * FROM information_schema.columns WHERE table_name = 'lista_salida' ORDER BY ordinal_position ASC;";
        }
    }

    function actualiza($idd){
        return "update lista_salida set
             id_elemento='".$idd['id_elemento']."',
             cantidad='".$idd['cantidad']."',
             fecha='".$idd['fecha']
             ."'where id_salida='".$idd['id']."'";
    }

    function inserta($idd){
        return "insert into lista_salida values ('".$idd['id']."'
                ,'".$idd['id_elemento']."'
                ,'".$idd['cantidad']."'
                ,'".$idd['fecha']."') ";
    }

    function elimina($idd){
        $depart = explode(",", $idd['id']);
        $vari="";
        for($i=0;$i<count($depart);$i++){
            $vari.="delete from lista_salida where id='".$depart[$i]."';";
        }
        return $vari;
    }
}

?>
