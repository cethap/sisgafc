<?php
class dbtipo_producto extends dao{

    function consulta($logica,$tiblo=""){        
        if($logica=="cn"){
        return 'SELECT * FROM '.$tiblo;
        }else if($logica=="co"){
            return "SELECT * FROM information_schema.columns WHERE table_name = '".$tiblo."' ORDER BY ordinal_position ASC;";
        }
    }

    function actualiza($idd){
        // return "update elemento set
        //      tipo='".$idd['tipo']."'
        //     ,descripcion='".$idd['descripcion']."'
        //     ,marca='".$idd['marca']."' where id='".$idd['id']."'";
    }

    function inserta($idd){
        // return "insert into elemento values (
        //     '".$idd['id']."'
        //     , '".$idd['marca']."'
        //     ,'".$idd['descripcion']."','".$idd['tipo']."'); "
        //     ."insert into store values (
        //     '".$idd['id']."'
        //     ,0) ";
    }

    function elimina($idd){
        // $depart = explode(",", $idd['id']);
        // $vari="";
        // for($i=0;$i<count($depart);$i++){
        //     $vari.="delete from elemento where id='".$depart[$i]."';";
        // }
        // return $vari;
    }
}
?>
