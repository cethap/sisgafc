<?php
include("adodb/adodb-exceptions.inc.php");
        include('adodb/adodb.inc.php');
class coneccion{
    function __construct(){

    }
    function hacercon($sql){
        
	$db = ADONewConnection('postgres'); # eg 'mysql' o 'postgres'
	$db->Connect('localhost', 'unoraya_system', 'system', 'unoraya_sisgafc');
        try{
            $rs = $db->Execute($sql);
        } catch (exception $e) {
            var_dump($e);
            $rs.= adodb_backtrace($e->gettrace());
        }
        $verie=$db->ErrorMsg();
        if(substr($verie, 0, 5)=="ERROR"){
            $rs= "error";
        }else{
            if(substr($sql, 0, 6)!="SELECT"){
                $rs= "ok";
            }
        }
        return $rs;
    }
}

?>
