<?php


class persologic extends logica{

    function logica (){
        $this->msg="";
        
        if($this->asignacion["accion"]=="consultapersonal"){ 
            $vali=("not str-num,not srt,not srt,not srt,not srt,not email,not srt, not str-num");
            $nomb=("Cedula,Nombres,Apellidos,Movil,Telefono,E-mail,Cargo,Personal");
            if(!isset($this->asignacion["vtn"]) && $this->asignacion["vtn"]!="single"){
                $this->tipotabla("Personal", $this->dao,$nomb,$vali,"crud",$_SESSION['widthp']);
            }else{
                $this->tipotabla("Personal", $this->dao,$nomb,$vali,"non",$_SESSION['widthp'],"","");
            }
        }
        if($this->asignacion["accion"]=="editPersonal"){
            $this->msg=$this->dao->execute($this->dao->actualiza($this->asignacion));
        }
        if($this->asignacion["accion"]=="delPersonal"){
            $this->msg=$this->dao->execute($this->dao->elimina($this->asignacion));
        }
        if($this->asignacion["accion"]=="addPersonal"){
            $regis=$this->dao->execute($this->dao->consulta("cn"));
            $this->asigna($regis,"ps",7);
            $this->msg=$this->dao->execute($this->dao->inserta($this->asignacion));
        }

      return $this->msg;
    }
}

?>
