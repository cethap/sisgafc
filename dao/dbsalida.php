<?php

class dbsalida extends dao{
    function consulta($logica){
        if($logica=="cn"){
        return 'SELECT * FROM salida';
        }else if($logica=="co"){
            return "SELECT * FROM information_schema.columns WHERE table_name = 'salida' ORDER BY ordinal_position ASC;";
        }
    }

    function actualiza($idd){
        return "update salida set
             id_staff='".$idd['id_staff']."',
             id_dependencia='".$idd['id_dependencia']."',
             fecha='".$idd['f-creacion']
             ."'where id='".$idd['id']."'";
    }

    function inserta($idd){
        return "insert into salida values ('".$idd['id']."'
                ,'".$idd['id_staff']."'
                ,'".$idd['id_dependencia']."'
                ,'".$idd['f-creacion']."') ";
    }

    function elimina($idd){
        $depart = explode(",", $idd['id']);
        $vari="";
        for($i=0;$i<count($depart);$i++){
            $vari.="delete from salida where id='".$depart[$i]."';";
        }
        return $vari;
    }
}

?>
