<?php


include 'logica.php';

class bislogic{
    
    var $msg;
    var $dao;
    var $parseo;
    var $asignacion;
    var $arriba;


    function __construct($da,$parse="",$asignacio){
        $this->dao=$da;
        $this->parseo=$parse;
        $this->asignacion=$asignacio;
        $this->ini();
    }

    function ini(){

        //inicia validacion login
        if(isset($this->asignacion["username"])
                && !empty($this->asignacion["username"])
                && isset($this->asignacion["password"])
                && !empty($this->asignacion["password"])){
            include_once 'bislogin.php';
            include_once 'dao/dblogin.php';
            $bislo= new bislogin(new dblog(), $this->asignacion);
            $this->msg = $bislo->logica();

        }else{
            $this->msg = "Llene los campos de Usuario y Password.";
        }
        //finaliza validacion login
        //inicia crud_______________________________________________________________________________________

        if(isset($this->asignacion["accion"]) && !empty($this->asignacion["accion"])){

            if(isset($this->parseo["tabla"])){
                $this->asignacion["accion"].=$this->parseo["tabla"];
            }

            $this->msg =$this->asignacion["accion"];


            $this->msg =$this->asignacion["accion"];
            if($this->asignacion["accion"]=="consultadepartamento"
             ||$this->asignacion["accion"]=="editDepartamento"
             ||$this->asignacion["accion"]=="delDepartamento"
             ||$this->asignacion["accion"]=="addDepartamento"){
                    include_once 'departlogic.php';
                    include_once 'dao/dbdepartamento.php';
                    $depalog= new departlogic(new dbdepart(), $this->asignacion);
                    $this->msg = $depalog->logica();
            }


            if($this->asignacion["accion"]=="form_pd"){
                    include_once 'tipo_producto.php';
                    include_once 'dao/dbtipo_producto.php';
                        $log= new tipo_producto(new dbtipo_producto(),$this->asignacion);
                        $this->msg = $log->logica();
            }


            if($this->asignacion["accion"]=="consultapersonal"
             ||$this->asignacion["accion"]=="editPersonal"
             ||$this->asignacion["accion"]=="addPersonal"
             ||$this->asignacion["accion"]=="delPersonal"){
                    include_once 'logicapersonal.php';
                    include_once 'dao/dbpersonal.php';
                    $log= new persologic(new dbperso(), $this->asignacion);
                    $this->msg = $log->logica();
            }

            if($this->asignacion["accion"]=="consultaproveedor"
             ||$this->asignacion["accion"]=="editProveedor"
             ||$this->asignacion["accion"]=="addProveedor"
             ||$this->asignacion["accion"]=="delProveedor"){
                    include_once 'logicaproovedor.php';
                    include_once 'dao/dbproveedor.php';
                    $log= new proveelogic(new dbprovee(), $this->asignacion);
                    $this->msg = $log->logica();
            }

            if($this->asignacion["accion"]=="consultaproducto"
             ||$this->asignacion["accion"]=="editProducto"
             ||$this->asignacion["accion"]=="addProducto"
             ||$this->asignacion["accion"]=="delProducto"){
                    include_once 'logicaproducto.php';
                    include_once 'dao/dbproducto.php';
                    $log= new productlogic(new dbproduc(), $this->asignacion);
                    $this->msg = $log->logica();
            }
            
            
            if($this->asignacion["accion"]=="consultaLista_Orden"
               ||$this->asignacion["accion"]=="consultaOrden"
               ||$this->asignacion["accion"]=="insertaOrden"
               ||$this->asignacion["accion"]=="editOrden_de_Compra"
               ||$this->asignacion["accion"]=="addOrden_de_Compra"
               ||$this->asignacion["accion"]=="delOrden_de_Compra"){
                    include_once 'logicaorden.php';
                    include_once 'dao/dblista_orden.php';
                    include_once 'dao/dborden.php';
                    $log= new logicaorden(new dborden(), new dblista_orden(), $this->asignacion);
                    $this->msg = $log->logica();
            }
            
            if($this->asignacion["accion"]=="consultaentrada_de_almacen"
             ||$this->asignacion["accion"]=="conlistjs"
             ||$this->asignacion["accion"]=="insertaentrada"
             ||$this->asignacion["accion"]=="insertaremision"){
                    include_once 'logicaentrada.php';
                    include_once 'dao/dbentrada.php';
                    $log= new logicaentrada(new dbentrada(), $this->asignacion);
                    $this->msg = $log->logica();
            }
            
            if($this->asignacion["accion"]=="consultaremision"){
                    include_once 'logicaremision.php';
                    include_once 'dao/dbremision.php';
                    $log= new logicaremision(new dbremision(), $this->asignacion);
                    $this->msg = $log->logica();
            }  
            
            if($this->asignacion["accion"]=="consultasalida"
             ||$this->asignacion["accion"]=="consultasalida_de_almacen"
             ||$this->asignacion["accion"]=="insertaSalida"){
                    include_once 'logicasalida.php';
                    include_once 'dao/dbsalida.php';
                    $log= new logicasalida(new dbsalida(), $this->asignacion);
                    $this->msg = $log->logica();
            }
            
            
            if($this->asignacion["accion"]=="consultastock"){
                    include_once 'stock.php';
                    include_once 'dao/dbstore.php';
                    $log= new stock(new dbstore(), $this->asignacion);
                    $this->msg = $log->logica();
            }
            
            
        }
        
        
//        if($this->parseo["accion"]=="pdf"){
//                    include_once 'pdf/gpdf.php';
//                    $log= new gpdf($this->parseo["tabla"]);
//                    $log->logica();
//        }
        
        if(isset($this->parseo["tabla"])){
            if($this->parseo["tabla"]=="tipoOrden_de_Compra"){
                        include_once 'logicaorden.php';
                        include_once 'dao/dblista_orden.php';
                        include_once 'dao/dborden.php';
                        $log= new logicaorden(new dborden(), new dblista_orden(), $this->parseo,$this->asignacion);
                        $this->msg = $log->logica();
            }
            
            if($this->parseo["tabla"]=="tipoProducto"){
                        include_once 'tipo_producto.php';
                        $log= new tipo_producto($this->asignacion);
                        $this->msg = $log->logica();
            }
        }


        //finaliza crud_______________________________________________________________________________________
        return $this->msg;
    }
}

?>