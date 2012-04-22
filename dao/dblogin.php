
<?php
class dblog extends dao{
    
    function consulta($tipo="*",$pet=""){
        if ($tipo=="pass"){
            return $regis="SELECT * FROM login where usuario='$pet'";
        }else if($tipo=="*"){
            return $regis="SELECT * FROM login";
        }
//        foreach($regis as $row){
//            $hola=$row[3];
//        }
      //  return $hola;
    }
}

?>
