        <div id="dialogIdactualizar" style="display:none;" title="Ventana" >
        </div> 

<script>
    
   
    var ventanas="", footo="";
    
    for(i=0;i<$("#menaba .icon").length;i++){
        
        obj=$("#menaba .icon").eq(i);
        str=obj.attr("href");
        clave=str.substring(1, str.length);
        
        ventanas +='<div id="ventana'+clave+'" class="abs window window_full">'+
                    '<div class="abs window_inner">'+
                        '<div class="window_top">'+
                            '<span class="float_left">'+
                                    '<img src="assets/images/icons/chulo.png" /><div class="pptt" style="float:left">'+
                                    obj.text()+
                            '</div></span>'+
                            '<span class="float_right">'+
                                '<a href="#'+clave+'" class="window_min"></a>'+
                                '<a href="#'+clave+'" class="window_resize"></a>'+
                                '<a href="#'+clave+'" class="window_close"></a>'+
                            '</span>'+
                        '</div>'+
                        '<div class="abs window_content">'+
                            '<div class="window_main">'+
                                '<div class="contenidoventana" id="conte'+clave+'"></div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="abs window_bottom">'+
                                '<div id="'+obj.text()+'"></div>'+
                        '</div>'+
                    '</div>'+
                    '<span class=""></span>'+
                '</div>';

        footo+=  '<li id="'+clave+'">'+
                    '<a href="#ventana'+clave+'">'+
                        '<img src="assets/images/icons/chulo.png" />'+
                        obj.text()+
                    '</a>'+
                '</li>';
     }
     
$("#desktop").append(ventanas);
$("#dock").html(footo);


                
function ajaxmen(a,b,c){ 
    b = typeof(b) != 'undefined' ? b : 'controlador.php';
    c = typeof(c) != 'undefined' ? c : '';
    $("#conte"+a).html("<div style='width: 100px; margin: auto;' ><img src='images/cargando.gif'style='margin-top:50px'/></div>");
//    $.ajax({
//        type: 'POST',
//        url: b,
//        data: "accion=consulta"+a,
//        success: function(msg){
//            $("#conte"+a).html(msg);
//        }
//    });
    
    $.post(b,"accion=consulta"+a+"&to="+c, function(data) {
        $("#conte"+a).html(data);
    }); 
    
}
    
</script>
<!--script src="assets/javascripts/jquery.desktop.js"></script-->
    </body>
</html>
