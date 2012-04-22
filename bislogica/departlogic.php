<?php


class departlogic extends logica{

   
    function logica (){

	if($this->asignacion["accion"]=="consultadepartamento"){
            $vali=("not srt,not srt,not srt");
            $nomb=("Departamento,Nombre,Descripción");


            if(!isset($this->asignacion["vtn"]) && ($this->asignacion["vtn"]!="single")){
                $this->tipotabla("Departamento", $this->dao,$nomb,$vali,"crud",$_SESSION['widthp']);
            }else{
                $this->tipotabla("Departamento", $this->dao,$nomb,$vali,"non",$_SESSION['widthp'],"","");
            }
        }
        if($this->asignacion["accion"]=="editDepartamento"){
            $this->msg=$this->dao->execute($this->dao->actualiza($this->asignacion));
        }
        if($this->asignacion["accion"]=="delDepartamento"){
            $this->msg=$this->dao->execute($this->dao->elimina($this->asignacion));
        }
        if($this->asignacion["accion"]=="addDepartamento"){
            $regis=$this->dao->execute($this->dao->consulta("cn"));
            $this->asigna($regis,"dp");
            $this->msg=$this->dao->execute($this->dao->inserta($this->asignacion));
            
        }
        
      return $this->msg;
      
    }

}

?>
