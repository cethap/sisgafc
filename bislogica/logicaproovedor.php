<?php
class proveelogic extends logica{
    var $msg;
    var $dao;
    var $asignacion;

    function __construct($dao,$asignacio){
        $this->dao=$dao;
        $this->asignacion=$asignacio;
    }
    function logica (){
        $this->msg="";
        
      if($this->asignacion["accion"]=="consultaproveedor"){
          $vali=("not str,not srt,not srt,not srt map,srt,srt,srt,not email,srt-web,srt");
          $nomb=("Proveedor,Razon Social,Representante,Dirección,Telefono,Movil,Fax,E-mail,Web,Id");
          if(!isset($this->asignacion["vtn"]) && $this->asignacion["vtn"]!="single"){
            $this->tipotabla("Proveedor", $this->dao,$nomb,$vali,"crud");
          }else{
            $this->tipotabla("Proveedor", $this->dao,$nomb,$vali,"non","100%","","");  
          }
        }
        if($this->asignacion["accion"]=="editProveedor"){
            $this->msg=$this->dao->execute($this->dao->actualiza($this->asignacion));
        }
        if($this->asignacion["accion"]=="delProveedor"){
            $this->msg=$this->dao->execute($this->dao->elimina($this->asignacion));
        }
        if($this->asignacion["accion"]=="addProveedor"){
            $regis=$this->dao->execute($this->dao->consulta("cn"));
            $this->asigna($regis,"pv",9);
            $this->msg=$this->dao->execute($this->dao->inserta($this->asignacion));
        }
        
      return $this->msg;
    }
}
?>
