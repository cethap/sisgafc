//
// Kick things off.
//

var globalobj= new Object();
var objb= "";
var serializo='';
var formitu="";
var numval;

jQuery(document).ready(function() {
	JQD.go();
});

//
// Namespace - Module Pattern.
//
var JQD = (function($, window, undefined) {
	// Expose innards of JQD.
	return {
		go: function() {
			for (var i in JQD.init) {
				JQD.init[i]();
			}
		},
		init: {
			frame_breaker: function() {
				if (window.location !== window.top.location) {
					window.top.location = window.location;
				}
			},
			//
			// Initialize the clock.
			//
			clock: function() {
				if (!$('#clock').length) {
					return;
				}

				// Date variables.
				var date_obj = new Date();
				var hour = date_obj.getHours();
				var minute = date_obj.getMinutes();
				var day = date_obj.getDate();
				var year = date_obj.getFullYear();
				var suffix = 'AM';

				// Array for weekday.
				var weekday = [
					'Sunday',
					'Monday',
					'Tuesday',
					'Wednesday',
					'Thursday',
					'Friday',
					'Saturday'
				];

				// Array for month.
				var month = [
					'January',
					'February',
					'March',
					'April',
					'May',
					'June',
					'July',
					'August',
					'September',
					'October',
					'November',
					'December'
				];

				// Assign weekday, month, date, year.
				weekday = weekday[date_obj.getDay()];
				month = month[date_obj.getMonth()];

				// AM or PM?
				if (hour >= 12) {
					suffix = 'PM';
				}

				// Convert to 12-hour.
				if (hour > 12) {
					hour = hour - 12;
				}
				else if (hour === 0) {
					// Display 12:XX instead of 0:XX.
					hour = 12;
				}

				// Leading zero, if needed.
				if (minute < 10) {
					minute = '0' + minute;
				}

				// Build two HTML strings.
				var clock_time = weekday + ' ' + hour + ':' + minute + ' ' + suffix;
				var clock_date = month + ' ' + day + ', ' + year;

				// Shove in the HTML.
				$('#clock').html(clock_time).attr('title', clock_date);

				// Update every 60 seconds.
				setTimeout(JQD.init.clock, 60000);
			},
			//
			// Initialize the desktop.
			//
			desktop: function() {
				// Cancel mousedown, right-click.
				$(document).mousedown(function(ev) {
					if (!$(ev.target).closest('a').length) {
						
						//ev.preventDefault();
                                                JQD.util.clear_active();
						ev.stopPropagation();
					}
				}).bind('contextmenu', function() {
					return false;
				});

				// Relative or remote links?
				$('a').live('click', function(ev) {
					var url = $(this).attr('href');
					this.blur();

					if (url.match(/^#/)) {
						ev.preventDefault();
						ev.stopPropagation();
					}
					else {
						$(this).attr('target', '_self');
					}
				});

				// Make top menus active.
				$('a.menu_trigger').live('mousedown', function() {
					if ($(this).next('ul.menu').is(':hidden')) {
						JQD.util.clear_active();
						$(this).addClass('active').next('ul.menu').show();
					}
					else {
						JQD.util.clear_active();
					}
				}).live('mouseenter', function() {
					// Transfer focus, if already open.
					if ($('ul.menu').is(':visible')) {
						JQD.util.clear_active();
						$(this).addClass('active').next('ul.menu').show();
					}
				});

				// Desktop icons.
				$('a.icon').live('mousedown', function() {
					// Highlight the icon.
					JQD.util.clear_active();
					$(this).addClass('active');
				}).live('click', function() {
					// Get the link's target.
                                        var ssce=$(this).attr('rel');
                                        eval(ssce);
                                        
					var x = $(this).attr('href');
					var y = $(x).find('a').attr('href');

					// Show the taskbar button.
					if ($(x).is(':hidden')) {
						$(x).remove().appendTo('#dock');
						$(x).show('fast');
					}

					// Bring window to front.
					JQD.util.window_flat();
					$(y).addClass('window_stack').show();
				}).live('mouseenter', function() {
					$(this).die('mouseenter').draggable({
						revert: true,
						containment: 'parent'
					});
				});
				
				
				
				// Desktop icons.
				$('a.icon2').live('mousedown', function() {
					// Highlight the icon.
					JQD.util.clear_active();
					$(this).addClass('active');
				}).live('dblclick', function() {
					// Get the link's target.
					var x = $(this).attr('href');
					var y = $(x).find('a').attr('href');

					// Show the taskbar button.
					if ($(x).is(':hidden')) {
						$(x).remove().appendTo('#dock');
						$(x).show('fast');
					}

					// Bring window to front.
					JQD.util.window_flat();
					$(y).addClass('window_stack').show();
				}).live('mouseenter', function() {
					$(this).die('mouseenter').draggable({
						revert: true,
						containment: 'parent'
					});
				});
				

				// Taskbar buttons.
				$('#dock a').live('click', function() {
					// Get the link's target.
					var x = $($(this).attr('href'));

					// Hide, if visible.
					if (x.is(':visible')) {
						x.hide();
					}
					else {
						// Bring window to front.
						JQD.util.window_flat();
						x.show().addClass('window_stack');
					}
				});

				// Make windows movable.
				$('div.window').live('mousedown', function() {
					// Bring window to front.
					JQD.util.window_flat();
					$(this).addClass('window_stack');
				}).live('mouseenter', function() {
					$(this).die('mouseenter').draggable({
						// Confine to desktop.
						// Movable via top bar only.
						cancel: 'a',
						containment: 'parent',
						handle: 'div.window_top'
					}).resizable({
						containment: 'parent',
						minWidth: 400,
						minHeight: 200
					});

				// Double-click top bar to resize, ala Windows OS.
				}).find('div.window_top').live('dblclick', function() {
					JQD.util.window_resize(this);

				// Double click top bar icon to close, ala Windows OS.
				}).find('img').live('dblclick', function() {
					// Traverse to the close button, and hide its taskbar button.
					$($(this).closest('div.window_top').find('a.window_close').attr('href')).hide('fast');

					// Close the window itself.
					$(this).closest('div.window').hide();

					// Stop propagation to window's top bar.
					return false;
				});

				// Minimize the window.
				$('a.window_min').live('click', function() {
                                    
					$(this).closest('div.window').hide();
				});

				// Maximize or restore the window.
				$('a.window_resize').live('click', function() {
					JQD.util.window_resize(this);
				});

				// Close the window.
				$('a.window_close').live('click', function() {
                                        
					$(this).closest('div.window').hide(800,'easeInOutQuint',function(){
                                            $('.window_stack .window_main div').html("<div style='width: 100px; margin: auto;' ><img src='images/cargando.gif'style='margin-top:50px'/></div>");});
					$($(this).attr('href')).hide('slow');
				});

				// Show desktop button, ala Windows OS.
				$('#show_desktop').live('click', function() {
					// If any windows are visible, hide all.
					if ($('div.window:visible').length) {
						$('div.window').hide();
					}
					else {
						// Otherwise, reveal hidden windows that are open.
						$('#dock li:visible a').each(function() {
							$($(this).attr('href')).show();
						});
					}
				});

				$('table.data').each(function() {
					// Add zebra striping, ala Mac OS X.
					$(this).find('tbody tr:odd').addClass('zebra');
				}).find('tr').live('mousedown', function() {
					// Highlight row, ala Mac OS X.
					$(this).closest('tr').addClass('active');
				});
			},
			wallpaper: function() {
				// Add wallpaper last, to prevent blocking.
				if ($('#desktop').length) {
					$('body').prepend('<img id="wallpaper" class="abs" src="assets/images/misc/wallpaper.jpg" />');
				}
			}
		},
		util: {
			//
			// Clear active states, hide menus.
			//
			clear_active: function() {
				$('a.active, tr.active').removeClass('active');
				$('ul.menu').hide();
			},
			//
			// Zero out window z-index.
			//
			window_flat: function() {
				$('div.window').removeClass('window_stack');
			},
			//
			// Resize modal window.
			//
			window_resize: function(el) {
				// Nearest parent window.
				var win = $(el).closest('div.window');

				// Is it maximized already?
				if (win.hasClass('window_full')) {
					// Restore window position.
					win.removeClass('window_full').css({
						'top': win.attr('data-t'),
						'left': win.attr('data-l'),
						'right': win.attr('data-r'),
						'bottom': win.attr('data-b'),
						'width': win.attr('data-w'),
						'height': win.attr('data-h')
					});
				}
				else {
					win.attr({
						// Save window position.
						'data-t': win.css('top'),
						'data-l': win.css('left'),
						'data-r': win.css('right'),
						'data-b': win.css('bottom'),
						'data-w': win.css('width'),
						'data-h': win.css('height')
					}).addClass('window_full').css({
						// Maximize dimensions.
						'top': '0',
						'left': '0',
						'right': '0',
						'bottom': '0',
						'width': '100%',
						'height': '100%'
					});
				}

				// Bring window to front.
				JQD.util.window_flat();
				win.addClass('window_stack');
			}
		}
	};
// Pass in jQuery.
})(jQuery, this);


//---------------------------------------------Ventana-----------------------------------//
function abreventana(w,h,f){
      w = typeof(w) != 'undefined' ? w : 700;
      h = typeof(h) != 'undefined' ? h : 343;
      f = typeof(f) != 'undefined' ? f : function(){$(this).dialog( "close" );};
    jQuery('#dialogIdactualizar').dialog({'modal': true,'show': 'slide','width': w,'height': h,'resizable': true, 'buttons': { 
            "Cerrar": function() {
                    $(this).dialog( "close" );
            },
            "Ok": f}})
}

//---------------------------------------------fin Ventana-----------------------------------//



//---------------------------------------------Inicio-----------------------------------//
function ini(vart,srt){
    
    var new_text = srt.split(',');
    sec="";
        for(i=0;i<vart.length;i++){
            vart.eq(i).addClass(new_text[i]);
        }
    accion();

}
//---------------------------------------------Fin Inicio-----------------------------------//



//---------------------------------------------Logica-----------------------------------//

/****************************************Accion******************************************/
function accion(){
    $('.map').attr('onFocus',"mapi()");
    $('.tipo').attr('onFocus',"tipo(this)");
    $('.fech').attr('onFocus','fecha(this);');
    $('.tipopr').replaceWith('<select name="tipo" onchange="tipopr(this)" class="not srt tipo -[form_pd]-" ><option value="">Seleccione tipo de producto</option> <option datasel="electrico">Electrico</option> <option datasel="electronico">Electronico</option> <option datasel="maquina">Maquina</option> <option value="consumo">Consumo</option> <option value="fijo">Otro Fijo</option></select>'); 
}
/****************************************Fin Accion******************************************/
/****************************************Mapa******************************************/
function mapi(){
     $('#dialogIdactualizar').html('<div id="dialog"></div><div id="map_canvas"></div>');
     abreventana(500,500); 
     mapaa();
}
/****************************************Fin Mapa******************************************/


function tipopr(parm,fuc){
	if(typeof($("option:selected",parm).attr("datasel"))!= 'undefined'){
	    fuc = typeof(fuc) != 'undefined' ? fuc : function(){
	    	pp=0;
	    	ppstr="";
	    	console.log($('#dialogIdactualizar input'));
	    	$('#dialogIdactualizar input').each(function(){
	    		if($(this).val()==""){
	    			pp++;
	    		}else{
	    			ppstr+=$(this).attr("name")+"='"+$(this).val()+"'#|$";
	    		}
	    	});
	    	if(pp==0){
	    		ppstr=ppstr.substring(0,ppstr.length-3)
	    		$("option:selected",parm).val($("option:selected",parm).attr("datasel")+"#|$"+ppstr);
	    		$(this).dialog( "close" );
	    	}else{
	    		alert("falta ingresar datos");
	    	}
	    };
	    ntp=$(parm).attr('class').split('-[');
	    ntp=ntp[1].split(']-');
	    abreventana(500,243,fuc); 
	    $('#dialogIdactualizar').html("<div style='width: 100px; margin: auto;' ><img src='images/cargando.gif'style='margin-top:50px'/></div>");
	    ajaxtrae('#dialogIdactualizar','accion='+ntp[0]+'&tipo='+$("option:selected",parm).attr("datasel")); 
	}
}


/****************************************Tipo******************************************/
function tipo(parm,fuc){
    fuc = typeof(fuc) != 'undefined' ? fuc : function(){$(this).dialog( "close" );};
    ntp=$(parm).attr('class').split('-[');
    ntp=ntp[1].split(']-');
    abreventana(700,343,fuc); 
    $('#dialogIdactualizar').html("<div style='width: 100px; margin: auto;' ><img src='images/cargando.gif'style='margin-top:50px'/></div>");
    ajaxtrae('#dialogIdactualizar','accion='+ntp[0]); 
}
/****************************************Fin Tipo******************************************/
/****************************************Fecha******************************************/
function fecha(parm){
    $(parm).datepicker(
    {
    	dateFormat: 'yy-mm-dd',
        "showButtonPanel": true
    });
}
/****************************************Fin Fecha******************************************/
/****************************************Ajax parametros******************************************/
function ajaxtrae(cont, svr){
    $.ajax({
        type: 'POST',
        url: 'controlador.php',
        data: svr,
        success: function(msg){ 
            $(cont).html(msg);
        }
    });
}
/****************************************Fin parametros******************************************/

//---------------------------------------------Fin Logica-----------------------------------//


//---------------------------------------------Mapa-----------------------------------//
/****************************************Encontrar Locacion******************************************/
function findLocation(location, marker) {
        $('#map_canvas').gmap('search', {'location': location}, function(results, status) {
                if ( status === 'OK' ) {
                        $.each(results[0].address_components, function(i,v) {
                                if ( v.types[0] == "administrative_area_level_1" || v.types[0] == "administrative_area_level_2" ) {
                                        $('#state'+marker.__gm_id).val(v.long_name);
                                } else if ( v.types[0] == "country") {
                                        $('#country'+marker.__gm_id).val(v.long_name);
                                }
                        });
                        marker.setTitle(results[0].formatted_address);
                        $('#address'+marker.__gm_id).val(results[0].formatted_address);
                        position=location;//results[0].formatted_address;
                        locacion=results[0].formatted_address;
                        openDialog(marker);
                }
        });
}
/****************************************Fin Encontrar Locacion******************************************/

/****************************************Abrir Ventana Dialogo******************************************/
function openDialog(el) {
      $('#dialog'+el.__gm_id).dialog({'modal':true, 'title': 'Editar y guardar locacion', 'buttons': { 
            "Borrar": function() {
                    $(this).dialog( "close" );
                    el.setMap(null);
                    return false;
            },
            "Guardar": function() {
                    $('.map').val(position);
                    $('#dialogIdactualizar').dialog( "close" );
                    $('#dialogIdactualizar').html('');
                    $(this).dialog( "close" );
                    return false;
            }
      }});
    }
/****************************************Fin Abrir Ventana Dialogo******************************************/

/****************************************Fin Mapa******************************************/
function mapaa(){
    var position;
    var locacion;
    if($('.map').val()!=''){
        
//        $('#map_canvas').gmap({'center': ($('.map').val().replace("(","")).replace(")","")}).bind('init', function() {
//                $('#map_canvas').gmap('addMarker', {'position': ($('.map').val().replace("(","")).replace(")","")});
//        });
            $('#map_canvas').gmap({'center': ($('.map').val().replace("(","")).replace(")","")}).bind('init', function(event, map) { 
                $('#map_canvas').gmap('addMarker', {'position': ($('.map').val().replace("(","")).replace(")","")});
                    $(map).click( function(event) {
                            $('#map_canvas').gmap('addMarker', {'position': event.latLng}, function(map, marker) {
                                    $('#dialog').append('<form id="dialog'+marker.__gm_id+'" method="get" action="/" style="display:none;"><p><input id="address'+marker.__gm_id+'" class="txt" name="address" value=""/></p></form>');
                                    findLocation(marker.getPosition(), marker);

                            }).dragend( function(event) {
                                    var self = this;
                                    findLocation(event.latLng, this);
                            }).click( function() {
                                    openDialog(this);
                            })
                    });
            });        
    }else{
            $('#map_canvas').gmap().bind('init', function(event, map) { 
                    $(map).click( function(event) {
                            $('#map_canvas').gmap('addMarker', {'position': event.latLng, 'draggable': true, 'bounds': false}, function(map, marker) {
                                    $('#dialog').append('<form id="dialog'+marker.__gm_id+'" method="get" action="/" style="display:none;"><p><input id="address'+marker.__gm_id+'" class="txt" name="address" value=""/></p></form>');
                                    findLocation(marker.getPosition(), marker);

                            }).dragend( function(event) {
                                    var self = this;
                                    findLocation(event.latLng, this);
                            }).click( function() {
                                    openDialog(this);
                            })
                    });
            });
    }
}
/****************************************Fin Mapa******************************************/
//---------------------------------------------Fin mapa-----------------------------------//




//---------------------------------------------Menu-----------------------------------//

$(document).ready(function() { 
    
    $('#menudow').mouseenter(function() {
      $('#menaba').slideDown("slow");
    });
    $('html').click(function() {
      $('#menaba').slideUp("slow");
    });
    
});

//---------------------------------------------Fin Menu-----------------------------------//


//---------------------------------------------Crud-----------------------------------//

function trazare(e, io, pack, titu,tabla) {
    var valora="";
    
    if(e.css('display')!="block"){
        
        for(i=0;i<$(".DataTD input",io).length-1;i++){
            valora+=" '"+$(".DataTD input",io).eq(i).val()+"' ,";
        }
        obj=valora.substr(0,valora.length-1);
        eval("globalobj= new pack("+obj+");");
        
        if($("#edithd"+titu+" span").text()=="Modificar registro"){
            if(not($(".DataTD input.not, .DataTD select.not",io))){
                $.ajax({type: 'POST',
                url: 'controlador.php?tabla='+tabla ,data: 'accion=edit&'+io.serialize(),
                success: function(msg){ 
                    $('#FormError').css("display","block");
                    if(msg.length<20){
                        jQuery('#'+titu).jqGrid('setRowData',globalobj.id,globalobj);
                        $('#FormError td').html("<span style='color:#86A747'>Fila Editada</span>");
                    }else{
                        $('#FormError td').html("Hubo un error");
                    }
                }});
            }
        }else if($("#edithd"+titu+" span").text()=="Agregar registro"){
            
            if(not($(".DataTD input.not, .DataTD select.not",io))){
                $.ajax({type: 'POST',
                url: 'controlador.php?tabla='+tabla ,data: 'accion=add&'+io.serialize(),
                success: function(msg){ 
                   $('#FormError').css("display","block");
                    if(msg.length<20){
                        jQuery('#'+titu).jqGrid('addRowData',globalobj.id,globalobj);
                        $('#FormError td').html("<span style='color:#86A747'>Fila Añadida</span>");
                    }else{
                        $('#FormError td').html("Hubo un error");
                    }
                }});
            }   
        }
    }else{
        $.ajax({type: 'POST',
            url: 'controlador.php?tabla='+tabla ,data: 'accion=del&id='+$(".DelTable #DelData td:eq(0)",e).text(),
            success: function(msg){ 
                $('#DelError').css("display","block");
                if(msg.length<20){
                    jQuery('#'+titu).jqGrid('delRowData',$(".DelTable #DelData td:eq(0)",e).text());
                    $('#DelError td').html("<span style='color:#86A747'>Filas Borradas</span>");
                }else{
                    $('#DelError td').html("Hubo un error");
                }
            }});  
    }    
}

function not(param){
    verf=0;
    console.log(param);
    for(i=0;i<param.length;i++){
    	console.log("'"+param.eq(i).val()+"'")
        if(param.eq(i).val()==""){
            verf++; 
        }
    }
    if(verf>0){
        alert("Digite Campos Obligatorios");
        return false;
    }else{
        return true;
    }
}

function correo(param){
    verf=0;
    if(param.length>0||param.val()!=""){
        for(i=0;i<param.val().length-1;i++){
            if(param.val().substring(i, i+1)=="@"||param.val().substring(i, i+1)=="."){
                verf++; 
            }
        }
        if(verf==2){
            return true;
        }else{
            alert("Digite Correo Valido");
            return false;
        }
    }else if(param.length>=0||param.val()==""){
        return true;
    }
}

function intervalo(inter){ 
    $('#fbox_'+inter+' .ui-search').click(
        function(){
            
            oculto=$('#oculto_'+inter);
            
             $("#fila",oculto).val($('#fbox_'+inter+' .fields select').val());
             $("#conn",oculto).val($('#fbox_'+inter+' .ops select').val());
             $("#dest",oculto).val($('#fbox_'+inter+' .data input').val());
             
    });
}
//---------------------------------------------Fin Crud-----------------------------------//

//---------------------------------------------Accion Orden-----------------------------------//
function listaem(obj1,obj,str1,str2,str3) {

    lilo=$("#dialogIdactualizar div").eq(0).attr("id");
    vlilo=lilo.substring(5,lilo.length);
    boolv=true;
    boolv2=true;
    var rof = jQuery('#'+vlilo).jqGrid('getGridParam','selrow');
    
    if(rof){
      var record = jQuery('#'+vlilo).jqGrid('getRowData',rof);
      $('#dialogIdactualizar').dialog( "close" );
      
      if(obj1.attr('rel')=="grid"){
          
          
      objr=$("#"+obj+" .jqgrow");
      srt="";
          for(i=0;i<objr.length;i++){
              for(y=2;y<$("td",objr.eq(i)).length;y++){
                  if(y==2){
                    //srt+=$("td",objr.eq(i)).eq(y).text()+" ";
                    if($("td",objr.eq(i)).eq(y).text()==record.id){
                        boolv=false;
                    }
                    
                  }
              }
          }
          
          if(boolv){
              
              $('#dialogIdactualizar').html(formu(str1,str2,record.id,obj,str3));
              formitu=formu(str1,str2,record.id,obj,str3);
              abreventana(400,300,function(){
                  acciclass('#frmu-'+obj+" input");
                  
                  for(i=1;i<$('#frmu-'+obj+" input, select").length;i++){
                      if($('#frmu-'+obj+" input, select").eq(i).val()==""){
                          boolv2=false;
                      }
                  }
                  
                  if(boolv2){
                      poo="";
                      for(i=1;i<$('#frmu-'+obj+" input, select").length;i++){
                          poo+="'"+$('#frmu-'+obj+" input, select").eq(i).attr('id')+"':";
                          poo+="'"+$('#frmu-'+obj+" input, select").eq(i).val()+"',";
                      }

                      eval("globalobj= {"+poo.substr(0, poo.length-1)+"}");
                      jQuery('#'+obj).jqGrid('addRowData',globalobj.elemento,globalobj);
                      $('#dialogIdactualizar').dialog( "close" );
                  }else{
                      alert("Llene todas las filas");
                      boolv2=true;
                  }
              });
          }else{
              alert(record.id+" ya esta en la lista");
          }
          
      }else if(obj1.attr('rel')=="sali"){
              $('#dialogIdactualizar').html("<label style='margin-right:10px' >Cantidad de elementos</label><input />");
              $('#dialogIdactualizar input').val(record.cantidad);
              abreventana(350,120,function(){
                  if((parseFloat($('#dialogIdactualizar input').val())<=record.cantidad)&&(parseFloat($('#dialogIdactualizar input').val())>0)){
                      record.cantidad=$('#dialogIdactualizar input').val();
                      globalobj=record;
                      jQuery('#'+obj).jqGrid('addRowData',globalobj.id_elemento,globalobj);
                      $('#dialogIdactualizar').dialog( "close" );
                  }else{
                  	  globalobj=record;
                      jQuery('#'+obj).jqGrid('addRowData',globalobj.id_elemento,globalobj);
                      $('#dialogIdactualizar').dialog( "close" );
                  }
                  
              });          
      }else{
          stjs=obj1.attr('obj').split(';');
          obj1.val(eval("record."+stjs[0]));
          eval(stjs[1]);
      }
      
    }else{
        alert("seleccione fila");
    }
 
}

function formu(str1,str2,str3,frm,str4){
    var cad="";
    var stro = str1.split(',');
    var strt = str2.split(',');
    var strth = str4.split(',');
    cad+="<table width='390' id='frmu-"+frm+"' >"
    cad+="<form>"
    for(i=0;i<stro.length;i++){
        cad+="<tr>"
                cad+="<td><label>"+stro[i]+"</label></td>";
                valid= strth[i].substring(0, 4);
                vad=strth[i];
                
             if(valid=="rea1"){
                 cad+="<td><input id='"+strt[i]+"' name='"+strt[i]+"' value='"+str3+"' READONLY ></td>";
             }else if(valid=="list"){
                vad=vad.split('-[');
                vad=vad[1].split(']-');
                vad=vad[0].split('-');
                cad+="<td><select id='"+strt[i]+"' >";
                for(y=0;y<vad.length;y++){
                    cad+="<option value='"+vad[y]+"'>"+vad[y]+"</option>";
                }
                cad+="</select></td>";
             }else if(valid=="acci"){
                 valido='#frmu-'+frm+" input";
                 cad+="<td><input id='"+strt[i]+"' class='acci' name='"+strt[i]+"'onfocus='acciclass(valido)' onmousemove='acciclass(valido)' onkeypress='acciclass(valido)' ></td>";
             }else if(valid=="read"){
                 cad+="<td><input id='"+strt[i]+"' class='acci' name='"+strt[i]+"' READONLY ></td>";
             }
        cad+="</tr>"
    }
    cad+="</form>"
    cad+="</table>"
    return cad;
}

function acciclass(obj){
    retsa=$(obj).eq(1).val()*$(obj).eq(2).val();
    $(obj).eq(3).val(retsa);
    $(obj).eq(5).val(retsa-((retsa*$(obj).eq(4).val())/100));
}

function actualizalist(obj){
    $('#dialogIdactualizar').html(formitu);
    var rofi = jQuery('#'+obj).jqGrid('getGridParam','selrow');
    var strll,strot;
    if(rofi){
        
        record = jQuery('#'+obj).jqGrid('getRowData',rofi);
        strll=serialize(record).split(',');
        
        for(i=0;i<strll.length;i++){
            strot=strll[i].split(';');
            $('#frmu-'+obj+" #"+strot[0]).val(strot[1]);
        }
        
        abreventana(400,300,function(){
        poo="";
        for(i=1;i<$('#frmu-'+obj+" input, select").length;i++){
          poo+="'"+$('#frmu-'+obj+" input, select").eq(i).attr('id')+"':";
          poo+="'"+$('#frmu-'+obj+" input, select").eq(i).val()+"',";
        }

        eval("globalobj= {"+poo.substr(0, poo.length-1)+"}");
        jQuery('#'+obj).jqGrid('setRowData',globalobj.elemento,globalobj);
        $('#dialogIdactualizar').dialog( "close" );
        });
        
    }else{
        alert("seleccione algina fila");
    }
}


function eliminalist(obj,ido){
    ido = typeof(ido) != 'undefined' ? ido : "elemento";
    var rofi = jQuery('#'+obj).jqGrid('getGridParam','selrow');
    if(rofi){
        record = jQuery('#'+obj).jqGrid('getRowData',rofi);
        jQuery('#'+obj).jqGrid('delRowData',eval("record."+ido));
    }else{
        alert("seleccione algina fila");
    }
}


function serialize(obj){
    var returnVal;
    if(obj != undefined){
        switch(obj.constructor){
            case Array:
                var vArr="[";
                for(var i=0;i<obj.length;i++)
                {
                 if(i>0) vArr += ",";
                 vArr += serialize(obj[i]);
                }
                vArr += "]"
                return vArr;
            case String:
                returnVal = ";" + obj;
                return returnVal;
            case Number:
                returnVal = isFinite(obj) ? obj.toString() : null;
                return returnVal;    
            case Date:
                returnVal = "#" + obj;
                return returnVal;  
            default:
                if(typeof obj == "object"){
                    var vobj=[];
                    for(attr in obj){
                        if(typeof obj[attr] != "function")
                        {
                        vobj.push('' + attr + '' + serialize(obj[attr]));
                        }
                    }
                    if(vobj.length >0){
                        return "" + vobj.join(",") + "";
                        }else{
                        return "{}";
                    }
                }  
                else
                {
                 return obj.toString();
                }
        }
    }
    return null;
}

function frmlorden(obj,stringo){
   
    var fields = $("#frm"+obj+" :input").serializeArray();
     con=0;
     srt="";
      jQuery.each(fields, function(i, field){
        if(field.value==""){
           con++; 
        }
      });
      
      objr=$("#"+obj+" .jqgrow");
      
      for(i=0;i<objr.length;i++){
          for(y=2;y<$("td",objr.eq(i)).length;y++){
              if((y<6)||(y==7)){
                srt+=$("td",objr.eq(i)).eq(y).text()+"|?";
              }
          }
          srt+="||";
      }

      if(con>0||srt==""){
        alert("Filas o Lista sin llenar");
      }else{
          ajaxgen("accion=insertaOrden&vary="+srt.substr(0,srt.length-4)+"&"+$("#frm"+obj).serialize(),"controlador.php",ajaxorden);
      }
}
//---------------------------------------------Fin Accion Orden-----------------------------------//

//---------------------------------------------Accion Inicio-----------------------------------//

function frmlin(obj,stringo){
    
    boleea=true;
    numo=$("#"+obj+" .cbox").length;
    aux=0;
    for(i=0;i<numo;i++){
        if($("#"+obj+" .cbox").eq(i).attr("checked")){
            boleea=false
            aux++;
        }
    }
    if(boleea&&numo>1){
        alert("seleccione algun item");
    }else if(!(boleea)&&(aux<numo)){
          var rm=confirm("faltan items por seleccionar desea hacer remision?");
          if(rm){
              insertain(obj);
          }else{}
    }else if(boleea&&numo==1){
          var rm=confirm("desea hacer remision con el unico item?");
          if(rm){
              insertain(obj);
          }else{}
    }else if(!(boleea)&&(aux==numo)){
          var fields = $("#frm"+obj+" :input").serializeArray();
          con=0;
          srt="";
          jQuery.each(fields, function(i, field){
            if(field.value==""){
               con++; 
            }
          });
          objr=$("#"+obj+" .jqgrow");
          for(i=0;i<objr.length;i++){
              for(y=2;y<$("td",objr.eq(i)).length;y++){
                  if((y<6)||(y==7)){
                    srt+=$("td",objr.eq(i)).eq(y).text()+"|?";
                  }
              }
              srt+="||";
          }
          if(con>0){
            alert("Filas o Lista sin llenar");
          }else{
              ajaxgen("accion=insertaentrada&vary="+srt.substr(0,srt.length-4)+"&"+$("#frm"+obj).serialize(),"controlador.php",function(pp){});
          }
    }

}
//---------------------------------------------Fin Accion Inicio-----------------------------------//
//---------------------------------------------Accion Salida-----------------------------------//

function frmsal(obj,stringo){
   
    var fields = $("#frm"+obj+" :input").serializeArray();
     con=0;
     srt="";
      jQuery.each(fields, function(i, field){
        if(field.value==""){
           con++; 
        }
      });
      
      objr=$("#"+obj+" .jqgrow");
      
      for(i=0;i<objr.length;i++){
          for(y=2;y<$("td",objr.eq(i)).length;y++){
              if((y<6)||(y==7)){
                srt+=$("td",objr.eq(i)).eq(y).text()+"|?";
              }
          }
          srt+="||";
      }

      if(con>0||srt==""){
        alert("Filas o Lista sin llenar");
      }else{
          ajaxgen("accion=insertaSalida&vary="+srt.substr(0,srt.length-4)+"&"+$("#frm"+obj).serialize(),"controlador.php",ajaxsal);
      }
}

//---------------------------------------------Fin Accion Salida-----------------------------------//


function inaccion(str,str2){
    $("#gbox_"+str+" .ui-row-ltr").remove();
    $("#gbox_"+str+" .ui-jqgrid-bdiv div").eq(1).html("<div style='width: 100px; margin: auto;' ><img src='images/cargando.gif'style='margin-top:14px'/></div>");
    ajaxgen("accion=conlistjs&str="+str2+"&str2="+str,"controlador.php",function(msg){
        $("#gbox_"+str+" .ui-jqgrid-bdiv div").eq(1).html(msg);
    });
}

//---------------------------------------------Fin Accion Inicio-----------------------------------//

//---------------------------------------------Accion Remision-----------------------------------//

function frmremision(obj,stringo){
    
    numo=$("#"+obj+" .cbox").length;
    aux=0;
    for(i=0;i<numo;i++){
        if($("#"+obj+" .cbox").eq(i).attr("checked")){
            aux++;
        }
    }
    if(aux==numo){
          var fields = $("#frm"+obj+" :input").serializeArray();
          con=0;
          srt="";
          jQuery.each(fields, function(i, field){
            if(field.value==""){
               con++; 
            }
          });
          objr=$("#"+obj+" .jqgrow");
          for(i=0;i<objr.length;i++){
              for(y=2;y<$("td",objr.eq(i)).length;y++){
                  if((y<6)||(y==7)){
                    srt+=$("td",objr.eq(i)).eq(y).text()+"|?";
                  }
              }
              srt+="||";
          }
          if(con>0){
            alert("Filas o Lista sin llenar");
          }else{
              ajaxgen("accion=insertaremision&vary="+srt.substr(0,srt.length-4)+"&"+$("#frm"+obj).serialize(),"controlador.php",function(pp){});
              $("#t_"+obj+" #btnfrmactualiza").attr("disabled","");
              $("#enviofrmin").attr("disabled","");
          }
    }else{
        alert("seleccione todos los items");
    }

}

//---------------------------------------------Fin Accion Remision-----------------------------------//

//--------------------------------------------------Ajax------------------------------------------//
function ajaxgen(a,b,f){ 
    
bool=true;

$.ajax({
        type: 'POST',
        url: b,
        data: a,
        success: function(msg){
            f(msg);
        }
    }).fail(function() {bool=false;});
    return bool;
}

function ajaxorden(msg){
    if(msg=="ok"){
    $.ajax({
        type: 'POST',
        url: "controlador.php",
        data: "accion=consultaLista_Orden",
        success: function(msg3){
            $("#conteLista_Orden").html(msg3);
        }
    });
    }else{
        alert("Hubo un error en el envio");
    }
}


function ajaxsal(msg){
    if(msg=="ok"){
    $.ajax({
        type: 'POST',
        url: "controlador.php",
        data: "accion=consultasalida_de_almacen",
        success: function(msg3){
            $("#contesalida_de_almacen").html(msg3);
        }
    });
    }else{
        alert("Hubo un error en el envio");
    }
}



//---------------------------------------------Fin Ajax-----------------------------------//
function insertain(obj){
      var fields = $("#frm"+obj+" :input").serializeArray();
      con=0;
      srt="";
      jQuery.each(fields, function(i, field){
        if(field.value==""){
           con++; 
        }
      });
      objr=$("#"+obj+" .ui-state-highlight");
      for(i=0;i<objr.length;i++){
          for(y=2;y<$("td",objr.eq(i)).length;y++){
              if((y<6)||(y==7)){
                srt+=$("td",objr.eq(i)).eq(y).text()+"|?";
              }
          }
          srt+="||";
      }
      if(con>0||srt==""){
        alert("Filas o Lista sin llenar");
      }else{
          ajx=ajaxgen("accion=insertaentrada&vary="+srt.substr(0,srt.length-4)+"&"+$("#frm"+obj).serialize(),"controlador.php",function(pp){});
          if(ajx){
             objr.remove(); 
             $("#enviofrmin").val("Hacer Remision");
             $("#enviofrmin").attr("onclick","frmremision('"+obj+"')");
             $("#t_"+obj+" #btnfrmactualiza").removeAttr("disabled");
          }
      }
}

function actualizaord(numid){
    ff="";
    tt="";
    valido='#frmu-'+numid+" input";
    var rofi = jQuery('#'+numid).jqGrid('getGridParam','selrow');
    if(rofi){
        record = jQuery('#'+numid).jqGrid('getRowData',rofi);
        
        ff+="<table width='390' id='frmu-"+numid+"'  ><form>";
        
        
        strll=serialize(record).split(',');
        for(i=0;i<strll.length;i++){
            ff+="<tr>";
            strot=strll[i].split(';');
            ff+="<td><label>"+strot[0]+"</label></td>";
            if(i==2){
                tt=strot[1].split("->");
                if(tt.length==1){
                    ff+="<td><input id='"+strot[0]+"' value='"+strot[1]+"'><td>";
                    tt=strot[1];
                }else{
                    ff+="<td><input id='"+strot[0]+"' value='"+tt[1]+"'><td>";
                    tt=tt[1];
                }
            }else{
                ff+="<td><input READONLY id='"+strot[0]+"' value='"+strot[1]+"' ><td>";
            }
            ff+="</tr>";
        }
        
        ff+="</form></table>";
        
        $('#dialogIdactualizar').html(ff);
        numval=tt;
        abreventana(400,300,function(){
        
        if(acciclass2(valido)){
            poo="";
            for(i=0;i<$(valido).length;i++){
              poo+="'"+$(valido).eq(i).attr('id')+"':";
              if(i==2){
                  poo+="'"+$(valido).eq(i).val()+"->"+numval+"',";
              }else{
                poo+="'"+$(valido).eq(i).val()+"',";
              }
            }
            eval("globalobj= {"+poo.substr(0, poo.length-1)+"}");
            jQuery('#'+numid).jqGrid('setRowData',globalobj.elemento,globalobj);

            $('#dialogIdactualizar').dialog( "close" );
        }
        
        });
        
    }else{
        alert("Seleccione fila")
    }
    
} 

function acciclass2(obj){
    bool;
    if(parseFloat($(obj).eq(2).val())<numval){
        retsa=$(obj).eq(2).val()*$(obj).eq(3).val();
        $(obj).eq(4).val(retsa);
        $(obj).eq(6).val(retsa-((retsa*$(obj).eq(5).val())/100));
        bool=true;
    }else if(parseFloat($(obj).eq(2).val())>=numval){
        alert("la cantidad debe se menor");
        bool=false;
    }
return bool;
}

