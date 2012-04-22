<?php

class dblista_orden extends dao{
    function consulta($logica){
        if($logica=="cn"){
        return 'SELECT * FROM lista_orden';
        }else if($logica=="co"){
            return "SELECT * FROM information_schema.columns WHERE table_name = 'lista_orden' ORDER BY ordinal_position ASC;";
        }
    }

    function actualiza($idd){
        return "update lista_orden set
             id_elemento='".$idd['orden']."',
             medida='".$idd['medida']."',
             cantidad='".$idd['cantidad']."',
             valor_unitario='".$idd['valor_unitario']."',
             descuento='".$idd['descuento']
             ."'where id_orden='".$idd['id']."'";
    }

    function inserta($idd,$str="id"){
        return "insert into lista_orden values ('".$idd[$str]."'
                ,'".$idd['id_elemento']."'
                ,'".$idd['medida']."'
                ,'".$idd['cantidad']."'
                ,'".$idd['valor_unitario']."'
                ,'".$idd['descuento']."') ";
    }

    function elimina($idd){
        $depart = explode(",", $idd['id_orden']);
        $vari="";
        for($i=0;$i<count($depart);$i++){
            $vari.="delete from lista_orden where id_orden='".$depart[$i]."';";
        }
        return $vari;
    }
}

?>
