<?php

class logicaremision extends logica{
    function logica (){
        $this->msg="";
        
        if($this->asignacion["accion"]=="consultaremision"){ 
            $vali=("");
            $nomb=("Remision,Orden de Compra");
            $this->tipotabla("Remision", $this->dao,$nomb,$vali,"non","700","","");
        }

      return $this->msg;
    }
}

?>
