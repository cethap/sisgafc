<?php

class dbprovee extends dao{

    function consulta($logica){
        if($logica=="cn"){
            return 'SELECT * FROM proveedor order by id';
        }else if($logica=="co"){
            return "SELECT * FROM information_schema.columns WHERE table_name = 'proveedor' ORDER BY ordinal_position ASC;";
        }
    }

    function actualiza($idd){
        return "update proveedor set 
            nit='".$idd['nit']."',
            razon_social='".$idd['razon_social']."',representante='".$idd['representante']."'
            ,direccion='".$idd['direccion']."',telefono='".$idd['telefono']."'
            ,movil='".$idd['movil']."',fax='".$idd['fax']."'
            ,mail='".$idd['mail']."' where id='".$idd['id']."'";

    }

    function inserta($idd){
        return "insert into proveedor values (
            '".$idd['nit']."'
            ,'".$idd['razon_social']."','".$idd['representante']."'
            ,'".$idd['direccion']."','".$idd['telefono']."', '".$idd['movil']."'
            ,'".$idd['fax']."','".$idd['mail']."','".$idd['web']."','".$idd['id']."') ";
    }

    function elimina($idd){
        $depart = explode(",", $idd['id']);
        for($i=0;$i<count($depart);$i++){
        $vari.="delete from proveedor where id='".$depart[$i]."';";
        }
        return $vari;
    }
}
?>
