
<?php
include ("conexion.php");
require "dompdf_config.inc.php";


$exe= new coneccion();
$html="";
$pipo= $exe->hacercon("SELECT * FROM information_schema.columns WHERE table_name = '".$_GET["tabla"]."' ORDER BY ordinal_position ASC;");
$cont=0;
$html.='<table width="100%" border=1 cellspacing=0 cellpadding=1 bordercolor="666633" style="font-family:arial, helvetica, sans;">
<tr>';

foreach($pipo as $row){
        $html.= "<td style='text-align:center;'> ".$row[3]."</td>";
        $cont++;
}
$html.='</tr>';

    $str1=$_GET["p1"];
    $str2=$_GET["p2"];
    $str3=$_GET["p3"];
    $str="";
    
    
    if(($str1==null) && ($str2==null) && ($str3==null)){
        $pipo=$exe->hacercon("SELECT * FROM ".$_GET["tabla"]);
        foreach($pipo as $row){
            $html.= "<tr>";
            for($i=0;$i<$cont;$i++){
                $html.= "<td style='font-size:7px; font-weight:lighter; text-align:left;'> ".$row[$i]."</td>";
            }
            $html.= "</tr>";
        }
    }
    else{
        if($str2=="eq"){
            $str=$str1."='$str3'";
        }
        
        
        if($str2=="ne"){
            $str=$str1."!='$str3'";
        }
        

        if($str2=="it"){
            $str=$str1."<'$str3'";
        }
        
        if($str2=="le"){
            $str=$str1."<='$str3'";
        }
        
        if($str2=="gt"){
            $str=$str1.">'$str3'";
        }
        

        if($str2=="ge"){
            $str=$str1.">='$str3'";
        }
        
        if($str2=="bw"){
            $str=$str1."like '%$str3'";
        }
        
        if($str2=="bn"){
            $str=$str1."not ilike '%$str3'";
        }
        
        if($str2=="ew"){
            $str=$str1."like '$str3%'";
        }
        if($str2=="en"){
            $str=$str1."not ilike '$str3%'";
        }
        if($str2=="cn"){
            $str=$str1."like '%$str3%'";
        }
        if($str2=="nc"){
            $str=$str1."not ilike '%$str3%'";
        }
        
        $pipo2= $exe->hacercon("SELECT * FROM ".$_GET["tabla"]." where ".$str);
        foreach($pipo2 as $row){
            $html.= "<tr>";
            for($i=0;$i<$cont;$i++){
                $html.= "<td style='font-size:7px; font-weight:lighter; text-align:left;'> ".$row[$i]."</td>";
            }
            $html.= "</tr>";
        }
    }
    
$html.='</table>';

echo $html;

$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream($_GET["tabla"].".pdf");

?>