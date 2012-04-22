<?php

class dbmaquina extends dao{
    function consulta($logica){
        if($logica=="cn"){
        return 'SELECT * FROM maquina';
        }else if($logica=="co"){
            return "SELECT * FROM information_schema.columns WHERE table_name = 'maquina' ORDER BY ordinal_position ASC;";
        }
    }

    function actualiza($idd){
        return "update maquina set
             serie='".$idd['serie']."',
             fuente_energia='".$idd['fuente_energia']."',
             movimiento='".$idd['movimiento']."',
             bastidor='".$idd['bastidor']
             ."'where id_elemento='".$idd['id']."'";
    }

    function inserta($idd){
        return "insert into maquina values ('".$idd['id']."'
                ,'".$idd['serie']."'
                ,'".$idd['fuente_energia']."'
                ,'".$idd['movimiento']."'
                ,'".$idd['bastidor']."') ";
    }

    function elimina($idd){
        $depart = explode(",", $idd['id']);
        $vari="";
        for($i=0;$i<count($depart);$i++){
            $vari.="delete from maquina where id='".$depart[$i]."';";
        }
        return $vari;
    }
}

?>
