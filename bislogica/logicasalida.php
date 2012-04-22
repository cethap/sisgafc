<?php

class logicasalida extends logica{
    function logica (){
        $this->msg="";
        include_once 'dao/dblista_orden.php';
        $this->dao2=new dblista_orden();
        
        if($this->asignacion["accion"]=="consultasalida"){ 
            $vali=("");
            $nomb=("Salida,Personal,Dependencia,Fecha");
            $this->tipotabla("Salida", $this->dao,$nomb,$vali,"non","700","","");
        }
        if($this->asignacion["accion"]=="consultasalida_de_almacen"){ 
          $vali=("");
          $nomb=("Elemento,Cantidad");
          $nomb2=("id_elemento,cantidad");
          $this->lista($nomb,$nomb2,$vali);
        }
        if($this->asignacion["accion"]=="insertaSalida"){ 
            
            $this->msg=$this->dao->execute($this->dao->inserta($this->asignacion));
            
            $nomb2=("id_orden,id_elemento,cantidad");
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
                $this->msg=$this->dao2->execute($this->dao2->inserta($this->asignacion));
            }
            
            
        }

      return $this->msg;
    }
    
    function lista($nomb,$row,$vali){
 
        include_once('lib/YepSua/Labs/RIA/jQuery4PHP/YsJQueryAutoloader.php');
        YsJQueryAutoloader::register();        
        YsJQuery::useComponent(YsJQueryConstant::COMPONENT_JQGRID);
        $idio=time();
        $grid = new YsGrid($idio,'Salida');
        $io=0;
        $rowo=array();
        $regis=$this->dao->execute($this->dao->consulta("cn"));
        $this->asigna($regis,"sal");
            
        $nombv=explode(",", $nomb);
        $rowv=explode(",", $row);
        
        for($i=0;$i<count($nombv);$i++){
            $fielo[$i] = new YsGridField($rowv[$i],$nombv[$i]);
            $grid->addGridFields($fielo[$i]);
        }


        $recordList = new YsGridRecordList();    
        $grid->setRecordList($recordList);
        $grid->setRowNumbers(true);
        $grid->setWidth('700');
        $grid->setDataType(YsGridConstants::DATA_TYPE_LOCAL);
        $grid->setRowNum(1);
        $grid->setRowList(array(3,5,10));
        $grid->setViewRecords(true);
        $grid->setToolbar(array(true, YsAlignment::$TOP));
        $grid->appendInToolbar('<input type="button" id="btnInToolbar" value="Añadir" style="height:20px;font-size:-3" class="tipo -[consultastock&vtn=single]-" rel="sali" /><input type="button" id="btnborrall" value="Eliminar" style="height:20px;font-size:-3"/>');
        $grid->setMultiselect(true);
        
        $navigator = new YsGridNavigator();
        $navigator->noDefaultButtons();
        $navigator->setSearch(true);
        

        $grid->setNavigator($navigator);
        $this->msg.= "  
        <div id='ordiv'>   
            <form id='frm$idio'>
                <table id='tabor'>
                    <tr>
                        <td><span>Personal</span></td>
                        <td><span>Numero Salida</span></td>
                    </tr>
                    <tr>
                        <td><span><input name='id_staff' class='tipo -[consultapersonal&vtn=single]-' rel='entr' obj='cedula' READONLY /></span></td>
                        <td><span><input name='id' value='".$this->asignacion['id']."' READONLY /></span></td>
                    </tr>
                    <tr>
                        <td><span>Dependencia</span></td>
                        <td><span>Fecha de Creacion</span></td>
                    </tr>
                    <tr>
                        <td><span><input name='id_dependencia' class='tipo -[consultadepartamento&vtn=single]-' rel='entr' obj='id' READONLY /></span></td>
                        <td><span><input name='f-creacion' onfocus='fecha(this)' onmousemove='fecha(this)' READONLY /></span></td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td>
                        <input id='enviofrmord' type='button' class='btngd' value='Enviar Salida' onclick='frmsal($idio)' >
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
                $('#ventanasalida_de_almacen .tipo').attr('onFocus','obj1=$(this); tipo(this,function(){ listaem(obj1,numid,str1,str2,str3); })');
                $('#ventanasalida_de_almacen .tipo').attr('onClick','obj1=$(this); tipo(this,function(){ listaem(obj1,numid,str1,str2,str3); })');
                $('#ventanasalida_de_almacen #btnfrmactualiza').attr('onClick','actualizalist(numid)');
                $('#btnborrall').attr('onClick','eliminalist(numid,".'"'."id_elemento".'"'.")');
            </script>
        </div>
                
                ";
        
    }
    
    function creatabla($titu,$regi1,$regi2,$ancho,$tipo,$arre,$nomb,$alto){
        include_once('lib/YepSua/Labs/RIA/jQuery4PHP/YsJQueryAutoloader.php');
        YsJQueryAutoloader::register();        
        YsJQuery::useComponent(YsJQueryConstant::COMPONENT_JQGRID);
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
        $grid->setSubGrid(true);
        //$grid->setBeforeSearchExpandedContent('alert("Before Search")');
        //$grid->setAfterSearchExpandedContent('alert("After Search")');
        $grid->searchExpandedContentIn('controlador.php?tabla=tipo'.$titu);
            
        if($tipo=="crud"){
            
            $navigator = new YsGridNavigator();
            $navigator->setDel(true);
            $navigator->setEdit(true);

            $form = new YsGridForm();
            //$form->setUrl('controlador.php?tabla='.$titu);
            $form->setHeight("100%");
            $form->setBeforeShowForm(new YsJsFunction("ini($('#editmod".$idio." .DataTD input'),'".$arre."');"));
            $form->setBeforeSubmit(new YsJsFunction(""));
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
        </script>
        
        <form id='oculto_$idio' style='display:block;'>
            <input id='fila' name='fila'>
            <input id='conn' name='conn'>
            <input id='dest' name='dest'>            
        </form>";
        
    }     
    
}

?>
