<?php

class logica {
    
    var $msg;
    var $dao;
    var $asignacion;

    function __construct($daos,$asignacios){
        $this->dao=$daos;
        $this->asignacion=$asignacios;
    }
    
    function tipotabla($nombre,$dao,$nomb,$arre,$tipo="full",$wid="100%",$conp="",$alto="alt"){
        $this->dao=$dao;
        if($conp==""){
            $regis=$this->dao->execute($this->dao->consulta("cn"));
        }else{
            $regis=$this->dao->execute($conp);
        }
        $regis2=$this->dao->execute($this->dao->consulta("co"));
        $this->creatabla($nombre,$regis,$regis2,$wid,$tipo,$arre,explode(",", $nomb),$alto);
    }
    
    function creatabla($titu,$regi1,$regi2,$ancho,$tipo,$arre,$nomb,$alto){
        include_once('lib/YepSua/Labs/RIA/jQuery4PHP/YsJQueryAutoloader.php');
        YsJQueryAutoloader::register();        
        YsJQuery::useComponent(YsJQueryConstant::COMPONENT_JQGRID);
        $tiblo=explode(" ",$this->dao->consulta("cn"));
        $idio=time();
        $grid = new YsGrid($idio,$titu);
        $regis=$regi1;
        $regis2=$regi2;
        $io=0;
        $rowo=array();
        $clasep="";
        $atributop="";
        foreach($regis2 as $row){
            $rowo[$io]=$row[3];
            $fielo[$io] = new YsGridField($row[3],$nomb[$io]);
            $fielo[$io]->setEditable(true);
            $grid->addGridFields($fielo[$io]);
            $io++;
        }
        $recordList = new YsGridRecordList();
        
        for($i=0;$i<count($rowo);$i++){
              $atributop.=$rowo[$i].",";
              $clasep.="\n this.".$rowo[$i]."=".$rowo[$i]."; \n";
        }
          
        foreach($regis as $row){
          $record = new YsGridRecord();
          for($i=0;$i<count($rowo);$i++){
              $record->setAttribute($rowo[$i], $row[$i]);
          }
          $recordList->append($record);
        }
        
        $grid->setRecordList($recordList);
        $grid->setRowNumbers(true);
        $grid->setWidth($ancho);
        if($alto=="alt"){
            $grid->setHeight($_SESSION['heightp']);
        }
        $grid->setDataType(YsGridConstants::DATA_TYPE_LOCAL);
        $grid->setRowNum(1);
        $grid->setRowList(array(3,5,10));
        $grid->setViewRecords(true);
         $grid->setToolbar(array(true, YsAlignment::$TOP));
        $grid->appendInToolbar('<input type="button" id="pdf" value="PDF" style="height:20px;font-size:-3" />');
        
        if($tipo=="crud"){
            
            $navigator = new YsGridNavigator();
            $navigator->setDel(true);
            $navigator->setEdit(true);

            $form = new YsGridForm();
            //$form->setUrl('controlador.php?tabla='.$titu);
            $form->setHeight("100%");
            $form->setBeforeShowForm(new YsJsFunction("ini($('#editmod".$idio." .DataTD input'),'".$arre."');"));
            $form->setBeforeSubmit(new YsJsFunction("return false;"));
            $form->setOnClickSubmit(new YsJsFunction("trazare($('#delmod".$idio."'), $('#FrmGrid_".$idio."'),$titu ,'$idio','$titu' );"));
            $form->setBottomInfo("Sisgafc");
            
            $navigator->setEditForm($form);
            $navigator->setAddForm($form);
            $navigator->setDeleteForm($form);
            $navigator->setSearchForm($form);
            
            $grid->setNavigator($navigator);
            $this->msg.= $grid->renderTemplate();
            $this->msg.= $grid->execute();
            $this->msg.= YsJQuery::newInstance()->execute(
            $grid->invoke('setGridParam',array('rowNum' => 10)), YsJQGrid::trigger('reloadGrid'));

        }else{
            $navigator = new YsGridNavigator();
            $navigator->noDefaultButtons();
            $navigator->setSearch(true);
            $navigator->setRefresh(true);

            $grid->setNavigator($navigator);
            
            $this->msg.= $grid->renderTemplate();
            $this->msg.= $grid->execute();
            $this->msg.= YsJQuery::newInstance()->execute(
            $grid->invoke('setGridParam',array('rowNum' => 10)), YsJQGrid::trigger('reloadGrid')); 
        }
        
        $this->msg.="<script>
         function ".$titu."(".substr($atributop, 0, -1)."){"
          .$clasep."   
          }
          idio='$idio';  
          $('#search_$idio .ui-icon-search').click(function(){setTimeout( 'intervalo(".'"'.$idio.'"'.")' ,350) });
          $('#refresh_$idio .ui-icon-refresh').click(function(){
          
             $.ajax({type: 'POST',url: 'controlador.php?' ,data: 'accion=consulta".strtolower($titu)."',
            success: function(msg){ 
                
                $('#conte".strtolower($titu)."').html(msg);
                
            }}); 
                
          });
                
            $('#pdf').click(function(){
               location.href='pdf/index.php?'+$('#oculto_$idio').serialize()+'&accion=pdf';
            });
        </script>
        
        <form id='oculto_$idio' style='display:none;'>
            <input id='fila' name='p1'>
            <input id='conn' name='p2'>
            <input id='dest' name='p3'>  
            <input id='tabla' name='tabla' value='".$tiblo[3]."'>
        </form>";
        
    }
    
    function asigna($arr,$pre,$num=0,$ays="id"){
        $cadr="";
        foreach($arr as $row){
          $cadr=$row[$num];
        }
        if($cadr==""){
            $this->asignacion[$ays]=$pre."-1";
        }else{
            $cadr2= explode("-", $cadr);
            $this->asignacion[$ays]= $pre."-".($cadr2[1]+1);
        }
    }
    
    function logica (){
      
    }
}

?>
