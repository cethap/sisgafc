<?php

class stock extends logica{

    function logica (){
        $this->msg="";
        
        if($this->asignacion["accion"]=="consultastock"){ 
            $vali=("");
            $nomb=("Elemento,Cantidad");
            
            if(isset($this->asignacion["vtn"]) && $this->asignacion["vtn"]!="single"){
                $this->tipotabla("Stock", $this->dao,$nomb,$vali,"non",$_SESSION['widthp']);
            }else{
                $this->tipotabla("Stock", $this->dao,$nomb,$vali,"non","700","","");
            }
        }

      return $this->msg;
    }
}
?>
