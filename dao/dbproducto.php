<?php
class dbproduc extends dao{

    function consulta($logica){        
        if($logica=="cn"){
        return 'SELECT * FROM elemento order by id';
        }else if($logica=="co"){
            return "SELECT * FROM information_schema.columns WHERE table_name = 'elemento' ORDER BY ordinal_position ASC;";
        }
    }

    function actualiza($idd){
        $retu="";
        $ttipo=explode("#|$",$idd['tipo']);
        $uttipo="";
        for($i=1;$i<count($ttipo);$i++){
            $uttipo.=$ttipo[$i].",";
        }
        $retu= "update elemento set
             tipo='".$ttipo[0]."'
            ,descripcion='".$idd['descripcion']."'
            ,marca='".$idd['marca']."' where id='".$idd['id']."';";

            if(count($ttipo)>1){
                $retu.='update '.$ttipo[0].' set '.str_replace("\'","'",substr($uttipo, 0, -1)).' where id_elemento='."'".$idd['id']."'".';';
            }

        return $retu;
    }

    function inserta($idd){
        $ttipo=explode("#|$",$idd['tipo']);
        $uttipo="";
        $uttipo.="'".$idd['id']."',";
        for($i=1;$i<count($ttipo);$i++){
            $tito=explode("=",$ttipo[$i]);
            $uttipo.=$tito[1].",";
        }
        $retu= "insert into elemento values (
            '".$idd['id']."'
            , '".$idd['marca']."'
            ,'".$idd['descripcion']."','".$ttipo[0]."'); "
            ."insert into store values (
            '".$idd['id']."'
            ,0); ";
            if(count($ttipo)>1){
                $retu.='insert into '.$ttipo[0].' values('.str_replace("\'","'",substr($uttipo, 0, -1)).');';
            }
        return $retu;
    }

    function elimina($idd){
        $depart = explode(",", $idd['id']);
        $vari="";
        for($i=0;$i<count($depart);$i++){
            $vari.="delete from elemento where id='".$depart[$i]."';";
        }
        return $vari;
    }
}
?>
