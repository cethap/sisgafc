<?php

class dborden extends dao{
    function consulta($logica){
        if($logica=="cn"){
        return 'SELECT * FROM ordencompra';
        }else if($logica=="co"){
            return "SELECT * FROM information_schema.columns WHERE table_name = 'ordencompra' ORDER BY ordinal_position ASC;";
        }
    }

    function actualiza($idd){
        return "update ordencompra set
             id_proveedor='".$idd['id_proveedor']."',
             fecha='".$idd['f-creacion']."',
             tipo_pago='".$idd['tipo_pago']
             ."'where id='".$idd['id']."'";
    }

    function inserta($idd){
        return "insert into ordencompra values ('".$idd['id']."'
                ,'".$idd['id_proveedor']."'
                ,'".$idd['f-creacion']."'
                ,'".$idd['tipo_pago']."') ";
    }

    function elimina($idd){
        $depart = explode(",", $idd['id']);
        $vari="";
        for($i=0;$i<count($depart);$i++){
            $vari.="delete from ordencompra where id='".$depart[$i]."';";
        }
        return $vari;
    }
}
?>
