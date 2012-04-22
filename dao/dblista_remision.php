<?php

class dblista_remision extends dao{
    function consulta($logica){
        if($logica=="cn"){
        return 'SELECT * FROM lista_remision';
        }else if($logica=="co"){
            return "SELECT * FROM information_schema.columns WHERE table_name = 'lista_remision' ORDER BY ordinal_position ASC;";
        }
    }

    function actualiza($idd){
        return "update lista_remision set
             id_elemento='".$idd['id_elemento']."',
             cantidad_pendiente='".$idd['cantidad_pendiente']."',
             estado_remision='".$idd['estado_remision']
             ."'where id_remision='".$idd['id']."';";
    }

    function inserta($idd){
        return "insert into lista_remision values ('".$idd['id']."'
                ,'".$idd['id_elemento']."'
                ,'".$idd['cantidad_pendiente']."'
                ,'".$idd['estado_remision']."');";
    }

    function elimina($idd){
        $depart = explode(",", $idd['id']);
        $vari="";
        for($i=0;$i<count($depart);$i++){
            $vari.="delete from lista_remision where id='".$depart[$i]."';";
        }
        return $vari;
    }
}

?>
