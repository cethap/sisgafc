<?php

class dbelectronico extends dao{
    function consulta($logica){
        if($logica=="cn"){
        return 'SELECT * FROM electronico';
        }else if($logica=="co"){
            return "SELECT * FROM information_schema.columns WHERE table_name = 'electronico' ORDER BY ordinal_position ASC;";
        }
    }

    function actualiza($idd){
        return "update electronico set
             serie='".$idd['serie']."',
             especialidad='".$idd['especialidad']
             ."'where id_elemento='".$idd['id']."'";
    }

    function inserta($idd){
        return "insert into electronico values ('".$idd['id']."'
                ,'".$idd['serie']."'
                ,'".$idd['especialidad']."') ";
    }

    function elimina($idd){
        $depart = explode(",", $idd['id']);
        $vari="";
        for($i=0;$i<count($depart);$i++){
            $vari.="delete from electronico where id='".$depart[$i]."';";
        }
        return $vari;
    }
}

?>
