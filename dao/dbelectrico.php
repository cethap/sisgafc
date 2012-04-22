<?php

class dbelectrico extends dao{
    function consulta($logica){
        if($logica=="cn"){
        return 'SELECT * FROM electrico';
        }else if($logica=="co"){
            return "SELECT * FROM information_schema.columns WHERE table_name = 'electrico' ORDER BY ordinal_position ASC;";
        }
    }

    function actualiza($idd){
        return "update electrico set
             voltaje='".$idd['voltaje']."',
             amperaje='".$idd['amperaje']."',
             omnios='".$idd['omnios']
             ."'where id_elemento='".$idd['id']."'";
    }

    function inserta($idd){
        return "insert into electrico values ('".$idd['id']."'
                ,'".$idd['voltaje']."'
                ,'".$idd['amperaje']."'
                ,'".$idd['omnios']."') ";
    }

    function elimina($idd){
        $depart = explode(",", $idd['id']);
        $vari="";
        for($i=0;$i<count($depart);$i++){
            $vari.="delete from electrico where id='".$depart[$i]."';";
        }
        return $vari;
    }
}

?>
