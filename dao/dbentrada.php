<?php

class dbentrada extends dao{
    function consulta($logica){
        if($logica=="cn"){
        return 'SELECT * FROM entrada';
        }else if($logica=="co"){
            return "SELECT * FROM information_schema.columns WHERE table_name = 'entrada' ORDER BY ordinal_position ASC;";
        }
    }

    function actualiza($idd){
        return "update entrada set
             id_orden='".$idd['id_orden']."',
             fecha='".$idd['f-creacion']
             ."'where id='".$idd['id']."';";
    }

    function inserta($idd){
        return "insert into entrada values ('".$idd['id']."'
                ,'".$idd['id_orden']."'
                ,'".$idd['f-creacion']."');";
    }

    function elimina($idd){
        $depart = explode(",", $idd['id']);
        $vari="";
        for($i=0;$i<count($depart);$i++){
            $vari.="delete from entrada where id='".$depart[$i]."';";
        }
        return $vari;
    }
}

?>
