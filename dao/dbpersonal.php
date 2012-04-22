<?php

class dbperso extends dao {
    function consulta($logica){  
        if($logica=="cn"){
        return 'SELECT * FROM staff_personal order by id';
        }else if($logica=="co"){
            return "SELECT * FROM information_schema.columns WHERE table_name = 'staff_personal' ORDER BY ordinal_position ASC;";
        }
    }

    function actualiza($idd){
        return "update staff_personal set 
            cedula='".$idd['cedula']."',
            nombre='".$idd['nombre']."',apellido='".$idd['apellido']."'
            ,telefono='".$idd['telefono']."',movil='".$idd['movil']."'
            ,cargo='".$idd['cargo']."',e_mail='".$idd['e_mail']."' where id='".$idd['id']."'";
    }

    function inserta($idd){
        return "insert into staff_personal values (
            '".$idd['cedula']."'
            ,'".$idd['nombre']."','".$idd['apellido']."'
            ,'".$idd['telefono']."','".$idd['movil']."'
            ,'".$idd['cargo']."','".$idd['e_mail']."','".$idd['id']."') ";
    }

    function elimina($idd){
        $depart = explode(",", $idd['id']);
        $vari="";
        for($i=0;$i<count($depart);$i++){
            $vari.="delete from staff_personal where id='".$depart[$i]."'";
        }
        return $vari;
    }    
}
?>
