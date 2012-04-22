<?php

class logicaentrada extends logica{
    
    var $msg;
    var $dao;
    var $asignacion;
    var $dao2;
    var $dao3;
    var $dao4;

    function __construct($dao,$asignacio){
        $this->dao=$dao;
        $this->asignacion=$asignacio;
        include_once 'dao/dblista_orden.php';
        $this->dao2=new dblista_orden();
        include_once 'dao/dbremision.php';
        $this->dao3=new dbremision();
        include_once 'dao/dbstore.php';
        $this->dao4=new dbstore();
    }
    function logica (){
        $this->msg="";
        
        if($this->asignacion["accion"]=="consultaentrada_de_almacen"){
          $vali=("rea1,list-[unidad-litros-kilogramos]-,acci,acci,read,acci,read");
          $nomb=("Elemento,Medida,Cantidad,Valor Unitario,Subtotal,Descuento,Total");
          $nomb2=("elemento,medida,cantidad,valor_unitario,subtotal,descuento,total");
          $this->lista($nomb,$nomb2,$vali);
          
        }
        
//        if($this->asignacion["tabla"]=="tipoOrden_de_Compra"){
//          $vali=("");
//          $nomb=("Orden,Elemento,Medida,Cantidad,Valor Unitario,Descuento");
//          $nomb2=("id_orden,id_elemento,medida,cantidad,valor_unitario,descuento");
//          $sql="SELECT * from lista_orden where id_orden='".$this->asignacion2["rowid"]."'";
//          $this->tipotabla("Orden_de_Compra", $this->dao2,$nomb,$vali,"","550",$sql,"");
//        }
        
        if($this->asignacion["accion"]=="conlistjs"){
          $regis=$this->dao->execute("SELECT * from lista_orden where id_orden='".$this->asignacion["str"]."'");

          foreach($regis as $row){
              
              $ui=$row["valor_unitario"]*$row["cantidad"];
              $ui2=$ui-($ui*$row["descuento"])/100;

              $strobj2.= "jQuery('#".$this->asignacion["str2"]."').jqGrid('addRowData','"
                      .$row["id_elemento"]."',"
                      ."{'elemento':'".$row["id_elemento"]."',"
                      ."'medida':'".$row["medida"]."',"
                      ."'cantidad':'".$row["cantidad"]."',"
                      ."'subtotal':".$ui.","
                      ."'total':".$ui2.","
                      ."'valor_unitario':'".$row["valor_unitario"]."',"
                      ."'descuento':'".$row["descuento"]."'}"
                      .");";
          }
        $this->msg="<script>".$strobj2."</script>";
        }
        
        if($this->asignacion["accion"]=="insertaentrada"){
            
            $this->msg=$this->dao->execute($this->dao->inserta($this->asignacion));
            
            $nomb2=("id_orden,id_elemento,medida,cantidad,valor_unitario,descuento");
            $nomb2=explode(",", $nomb2);
            $exp1=explode("||", $this->asignacion["vary"]);
            $exp2;
            
            for($y=0;$y<count($exp1);$y++){
                $exp2=explode("|?", $exp1[$y]);
                for($i=0;$i<count($nomb2);$i++){
                    if($i==0){
                        $this->asignacion[$nomb2[$i]]=$this->asignacion["id"];
                    }else{
                        $this->asignacion[$nomb2[$i]]=$exp2[$i-1];
                    }
                }
                $this->msg.=$this->dao2->execute($this->dao2->inserta($this->asignacion));
                $this->msg.=$this->dao4->execute($this->dao4->actualiza($this->asignacion));
            }
        }
        if($this->asignacion["accion"]=="insertaremision"){
            $bood=true;
            $nombv="";
            $axu="";
            
            $nomb2=("id_orden,id_elemento,medida,cantidad,valor_unitario,descuento");
            $nomb2=explode(",", $nomb2);
            $exp1=explode("||", $this->asignacion["vary"]);
            $exp2;
            
            for($y=0;$y<count($exp1);$y++){
                $exp2=explode("|?", $exp1[$y]);
                for($i=0;$i<count($nomb2);$i++){
                    if($i==0){
                        //$this->asignacion[$nomb2[$i]]=$this->asignacion["id"];
                        $axu=$exp2[0];
                    }else if($i==3){
                        $nombv=explode("->", $exp2[$i-1]);
                        if(count($nombv)>1){
                            $bood=false;
                        }else{
                            $bood=true;
                        }
                    }else{
                        $this->asignacion[$nomb2[$i]]=$exp2[$i-1];
                    }
                }
                if($bood){
                    if($y==0){
                        $this->msg.=$this->dao3->execute($this->dao3->inserta($this->asignacion).";");
                    }
                    $this->msg.=$this->asignacion["cantidad"];
                    $this->msg.=$this->dao2->execute($this->dao2->inserta($this->asignacion,"rem"));
                }else{
                    $this->asignacion["id_orden"]=$this->asignacion["id"];
                    $this->asignacion["cantidad"]=$nombv[0];
                    if($y==0){
                        $this->msg.=$this->dao->execute($this->dao->inserta($this->asignacion));
                    }
                    $this->msg.=$this->dao2->execute($this->dao2->inserta($this->asignacion));
                    $this->msg.=$this->dao4->execute($this->dao4->actualiza($this->asignacion));
                    
                    $this->asignacion["id_orden"]=$axu;
                    $this->asignacion["cantidad"]=$nombv[1]-$nombv[0];
                    if($y==0){
                        $this->msg.=$this->dao->execute($this->dao3->inserta($this->asignacion));
                    }
                    $this->msg.=$this->dao2->execute($this->dao2->inserta($this->asignacion,"rem"));
                }
            }
        }        

        
        if($this->asignacion["accion"]=="editOrden_de_Compra"){
            $this->msg=$this->dao2->execute($this->dao2->actualiza($this->asignacion));
        }
        if($this->asignacion["accion"]=="delOrden_de_Compra"){
            $this->msg=$this->dao2->execute($this->dao2->elimina($this->asignacion));
        }
        if($this->asignacion["accion"]=="addOrden_de_Compra"){
            $regis=$this->dao2->execute($this->dao2->consulta("cn"));
            $this->asigna($regis,"orc");
            $this->msg=$this->dao2->execute($this->dao2->inserta($this->asignacion));
        }
        
      return $this->msg;
    }

    function lista($nomb,$row,$vali){
 
        include_once('lib/YepSua/Labs/RIA/jQuery4PHP/YsJQueryAutoloader.php');
        YsJQueryAutoloader::register();        
        YsJQuery::useComponent(YsJQueryConstant::COMPONENT_JQGRID);
        $idio=time();
        $grid = new YsGrid($idio,'Lista_Orden');
        $io=0;
        $rowo=array();
        $regis=$this->dao->execute($this->dao->consulta("cn"));
        $this->asigna($regis,"ent");
        $regis=$this->dao3->execute($this->dao3->consulta("cn"));
        $this->asigna($regis,"rem",0,"remi");
            
        $nombv=explode(",", $nomb);
        $rowv=explode(",", $row);
        
        for($i=0;$i<count($nombv);$i++){
            $fielo[$i] = new YsGridField($rowv[$i],$nombv[$i]);
            $grid->addGridFields($fielo[$i]);
        }


        $recordList = new YsGridRecordList();    
        $grid->setRecordList($recordList);
        $grid->setRowNumbers(true);
        $grid->setWidth('100%');
        $grid->setDataType(YsGridConstants::DATA_TYPE_LOCAL);
        $grid->setRowNum(1);
        $grid->setRowList(array(3,5,10));
        $grid->setViewRecords(true);
        $grid->setToolbar(array(true, YsAlignment::$TOP));
        $grid->appendInToolbar('<input DISABLED type="button" id="btnfrmactualiza" value="Actualizar" rel="grid" style="height:20px;font-size:-3"/>');
        $grid->setMultiselect(true);
        
        $navigator = new YsGridNavigator();
        $navigator->noDefaultButtons();
        $navigator->setSearch(true);
        

        $grid->setNavigator($navigator);
        $vartor=explode("|$",$this->asignacion["to"]);
        $this->msg.= "  
        <div id='ordiv'>
            <form id='frm$idio'>
                <table id='tabor'>
                    <tr>
                        <td><span>Numero de Orden</span></td>
                        <td><span>Numero de entrada</span></td>
                    </tr>
                    <tr>
                        <td><span><input name='id_orden' class='tipo -[".$vartor[0]."&vtn=single]-' rel='entr' obj='id;inaccion(".'"'.$idio.'",record.id'.")' READONLY /></span></td>
                        <td><span><input name='id' value='".$this->asignacion['id']."' READONLY /></span></td>
                    </tr>
                    <tr>
                        <td><span>Fecha de Entrada</span></td>
                        <td><span></span></td>
                    </tr>
                    <tr>
                        <td><span><input name='f-creacion' onfocus='fecha(this)' onmousemove='fecha(this)' READONLY /></span></td>
                        <td><span><input name='rem' type='hidden' value='".$this->asignacion['remi']."' /></span></td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td>
                        <input id='enviofrmin' class='btngd' type='button' value='Hacer Entrada' onclick='frmlin($idio)' >
                        </td>
                    </tr>
                </table>    
            </form>";
        $this->msg.= $grid->renderTemplate();
        $this->msg.= $grid->execute();
        $this->msg.= YsJQuery::newInstance()->execute(
        $grid->invoke('setGridParam',array('rowNum' => 10)), YsJQGrid::trigger('reloadGrid')); 
        $this->msg.="
            <script>
                numid='$idio';
                str1='$nomb';
                str2='$row';
                str3='$vali';
                $('#ventanaentrada_de_almacen .tipo').attr('onFocus','obj1=$(this); tipo(this,function(){ listaem(obj1,numid,str1,str2,str3); })');
                $('#ventanaentrada_de_almacen .tipo').attr('onClick','obj1=$(this); tipo(this,function(){ listaem(obj1,numid,str1,str2,str3); })');
                $('#ventanaentrada_de_almacen #btnfrmactualiza').attr('onClick','actualizaord(numid)');
                $('#btnborrall').attr('onClick','eliminalist(numid)');
                $('#ventanaentrada_de_almacen .pptt').text('".$vartor[1]."');
                $('#ventanaentrada_de_almacen #enviofrmin').val('".$vartor[2]."');
            </script>
        </div>
                
                ";
        
    }
   
}

?>
