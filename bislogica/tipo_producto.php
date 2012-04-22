<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tipo_producto
 *
 * @author cesar
 */
class tipo_producto extends logica{
    
    var $msg;
    var $dao;
    var $asignacion;

    function __construct($dao,$asignacio){
        $this->dao=$dao;
        $this->asignacion=$asignacio;
    }
    
    function logica (){
        $vali=("not srt,not srt,not srt");
        $nomb=("Departamento,Nombre,Descripción");
        //$this->tipotabla("Departamento", $this->dao,$nomb,$vali,"crud","620");

        if($this->asignacion["accion"]=="form_pd"){
            $regis=$this->dao->execute($this->dao->consulta("co",$this->asignacion["tipo"]));
            $varta=0;
?>
            <h1 style="font-size:15px; margin-bottom:10px;">Ingrese datos tipo de producto</h1>
            <table width="390" id="tipoprod">
                <tbody>
                    <?php
                    foreach($regis as $row){
                        if($varta!=0){
                            echo '
                                    <tr>
                                        <td>
                                            <label>'.$row[3].'</label>
                                        </td>
                                        <td>
                                            <input class="notut" name="'.$row[3].'">
                                        </td>
                                    </tr>
                            ';
                        }
                        $varta++;
                    }
                    ?>
                </tbody>
            </table>
<?php
        }
        return "";
    }
    
    function tipos(){

    }
}


?>
