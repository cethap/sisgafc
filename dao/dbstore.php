<?php
class dbstore extends dao{
    function consulta($logica){
        if($logica=="cn"){
        return 'SELECT * FROM store';
        }else if($logica=="co"){
            return "SELECT * FROM information_schema.columns WHERE table_name = 'store' ORDER BY ordinal_position ASC;";
        }
    }

    
    function actualiza($idd){
        return "update store set
             cantidad= cantidad + ".$idd['cantidad']." where id_elemento='".$idd['id_elemento']."';";
    }

    function inserta($idd){
        return "insert into store values ('".$idd['id']."','".$idd['cantidad']."';) ";
    }

    function elimina($idd){
        $depart = explode(",", $idd['id']);
        $vari="";
        for($i=0;$i<count($depart);$i++){
            $vari.="delete from store where id='".$depart[$i]."';";
        }
        return $vari;
    }
}

?>
