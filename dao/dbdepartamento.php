<?php

class dbdepart extends dao{

    function consulta($logica){  
        if($logica=="cn"){
            return 'SELECT * FROM dependencia order by id';
        }else if($logica=="co"){
            return "SELECT * FROM information_schema.columns WHERE table_name = 'dependencia' ORDER BY ordinal_position ASC;";
        }
    }

    function actualiza($idd){
         return "update dependencia set nombre='".$idd['nombre']."', descripcion='".$idd['descripcion']."' where id='".$idd['id']."'";              
    }

    function inserta($idd){
         return "insert into dependencia values ('".$idd['id']."','".$idd['nombre']."','".$idd['descripcion']."') ";

    }

    function elimina($idd){
        $variot="";
        $depart = explode(",", $idd['id']);
        for($i=0;$i<count($depart);$i++){
            $variot.="delete from dependencia where id='".$depart[$i]."';";
        }
        return $variot;
    }
}
?>


