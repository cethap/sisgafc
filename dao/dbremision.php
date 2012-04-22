<?php

class dbremision extends dao{
    function consulta($logica){
        if($logica=="cn"){
        return 'SELECT * FROM remision';
        }else if($logica=="co"){
            return "SELECT * FROM information_schema.columns WHERE table_name = 'remision' ORDER BY ordinal_position ASC;";
        }
    }

    function actualiza($idd){
        return "update remision set
             id_orden='".$idd['id_orden']."' where id='".$idd['id']."'";
    }

    function inserta($idd){
        return "insert into remision values ('".$idd['rem']."'
                ,'".$idd['id_orden']."' )";
    }

    function elimina($idd){
        $depart = explode(",", $idd['id']);
        $vari="";
        for($i=0;$i<count($depart);$i++){
            $vari.="delete from remision where id='".$depart[$i]."';";
        }
        return $vari;
    }
}

?>
