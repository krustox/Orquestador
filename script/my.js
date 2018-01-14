/**
 * @author Diego
 */

$(document).ready(function(){
	$("#servicio").change(function() {
  		$("#tipo").load("/Orquestador/ajax/select_tipo_servicio.php?servicio=" + $("#servicio").val().split(",")[0]);
  		$("#tipol").show();
  		$("#tipo").show();
	});
});

$(document).ready(function(){
	$("#marcha").change(function() {
		if($("#marchatxt").is(":visible")){
			$("#marchatxtl").hide();
  			$("#marchatxt").hide();
		}else{
			$("#marchatxtl").show();
  			$("#marchatxt").show();
  		}
	});
});

$(document).ready(function(){
	$("#tipo").change(function() {
		var dato = $("#tipo").val().split(",");
		if(dato[dato.length-1] === "Infraestructura"){
  			$("#subservicio").load("/Orquestador/ajax/select_subservicio.php?tipo=" + $("#tipo").val().split(",")[0]);
  			$("#agrupacionl").hide();
  			$("#agrupacion").hide();
  			$("#segmentol").hide();
  			$("#segmento").hide();
  			$("#productol").hide();
  			$("#producto").hide();
  			$("#transaccionl").hide();
  			$("#transaccion").hide();
  			$("#operacionl").hide();
  			$("#operacion").hide();
  			$("#variableul").hide();
  			$("#variableu").hide();
  			$("#variableu").prop('type','hidden');
  			$("#subserviciol").show();
  			$("#subservicio").show();
  			$("#servidorl").hide();
  			$("#servidor").hide();
  		}else{
  			$("#agrupacion").load("/Orquestador/ajax/select_agrupacion.php?tipo=" + $("#tipo").val().split(",")[0]);
  			$("#agrupacionl").show();
  			$("#agrupacion").show();
  			$("#subserviciol").hide();
  			$("#subservicio").hide();
  			$("#sitel").hide();
  			$("#site").hide();
  			$("#componentel").hide();
  			$("#componente").hide();
  			$("#subcomponentel").hide();
  			$("#subcomponente").hide();
  			$("#servidorl").hide();
  			$("#servidor").hide();
  			$("#variablel").hide();
  			$("#variable").hide();
  			$("#variableinfra").hide();
  			$("#variable").prop('type','hidden');
  		}
	});
});

$(document).ready(function(){
	$("#subservicio").change(function() {
  		$("#site").load("/Orquestador/ajax/select_site.php?subservicio=" + $("#subservicio").val().split(",")[0]);
  		$("#sitel").show();
  		$("#site").show();
	});
});

$(document).ready(function(){
	$("#site").change(function() {
  		$("#componente").load("/Orquestador/ajax/select_componente.php?site=" + $("#site").val().split(",")[0]);
  		$("#componentel").show();
  		$("#componente").show();
	});
});

$(document).ready(function(){
	$("#componente").change(function() {
  		$("#subcomponente").load("/Orquestador/ajax/select_subcomponente.php?componente=" + $("#componente").val().split(",")[0]);
  		$("#subcomponentel").show();
  		$("#subcomponente").show();
	});
});

$(document).ready(function(){
	$("#subcomponente").change(function() {
  		$("#servidor").load("/Orquestador/ajax/select_elemento.php?subcomponente=" + $("#subcomponente").val().split(",")[0]);
  		$("#servidorl").show();
  		$("#servidor").show();	
	});
});

$(document).ready(function(){
	$("#servidor").change(function() {
  		//$("#variableinfra").load("/Orquestador/ajax/select_variablei.php");
  		$("#variablel").show();
  		$("#variableinfra").show();
  		//$("#variable").prop('type','text');  		
	});
});
  
$(document).ready(function(){
	$("#variableinfra").change(function() {
  		if($("#variableinfra").val()== "Espacio Disponible en Megabytes" || $("#variableinfra").val()== "Porcentaje de uso de disco"){
  			$("#variable").prop('type','text');
  		}else{
  			$("#variable").val("");
  			$("#variable").prop('type','hidden');
  		}
	});
});
  
$(document).ready(function(){
	$("#agrupacion").change(function() {
  		$("#segmento").load("/Orquestador/ajax/select_segmento.php?agrupacion=" + $("#agrupacion").val().split(",")[0]);
  		$("#segmentol").show();
  		$("#segmento").show();
	});
});

$(document).ready(function(){
	$("#segmento").change(function() {
  		$("#producto").load("/Orquestador/ajax/select_producto.php?segmento=" + $("#segmento").val().split(",")[0]);
  		$("#productol").show();
  		$("#producto").show();
	});
});

$(document).ready(function(){
	$("#producto").change(function() {
  		$("#transaccion").load("/Orquestador/ajax/select_transaccion.php?producto=" + $("#producto").val().split(",")[0]);
  		$("#transaccionl").show();
  		$("#transaccion").show();
	});
});

$(document).ready(function(){
	$("#transaccion").change(function() {
  		$("#operacion").load("/Orquestador/ajax/select_operacion.php?transaccion=" + $("#transaccion").val().split(",")[0]);
  		$("#operacionl").show();
  		$("#operacion").show();	
	});
});

$(document).ready(function(){
	$("#operacion").change(function() {
  		//$("#variableeu").load("/Orquestador/ajax/select_variableu.php");
  		$("#variableul").show();
  		$("#variableeu").show();
  		//$("#variableu").prop('type','text');
	});
});

$(document).ready(function(){
	$("#variableeu").change(function() {
  		if($("#variableeu").val()== "PRUEBANECESARIA"){
  			$("#variableu").prop('type','text');
  		}else{
  			$("#variableu").val("");
  			$("#variableu").prop('type','hidden');
  		}
	});
});


$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#table tfoot th').each( function () {
        var title = $(this).text();
        if(title !== "Accion" && title !== "Acción"){
        	$(this).html( '<input type="text" placeholder="'+title+'" />' );
        }
    } );
 
    // DataTable
    var table = $('#table').DataTable();
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
} );

$(document).ready(function(){
$("form").submit(function () { 
    if($("#servicio option:selected").val() == " ") {  
        window.alert("El Servicio es un campo obligatorio");  
        return false;  
    }else if($("#severidad option:selected").val() == " ") {  
        window.alert("La Severidad es un campo obligatorio");  
        return false;  
    }else if($("#para").val().length < 2 || !($("#para").val().includes("@")) ){
    	window.alert("Los campos de destinatario para es obligatorio y debe tener formato de correo");  
        return false;
    }else if($("#cc").val().length < 2 || !($("#cc").val().includes("@"))){
    	window.alert("Los campos de destinatario copia es obligatorio y debe tener formato de correo");  
        return false;
    }else if($("#marchatxt").is(":visible")){
    	if($("#marchatxt").val().length <2 || !($("#marchatxt").val().includes("@"))){
    		window.alert("El campo de marcha blanca es obligatorio y debe tener formato de correo");  
        	return false;
    	}
    }
    return true;  
});  
});


function crear(){
	window.location.href = window.location.href.split("/")[0]+"/"+window.location.href.split("/")[1]+"/"+
	window.location.href.split("/")[2]+"/"+window.location.href.split("/")[3]+"/Regla/crear_regla.php";	
}

function eliminar(id,tabla){
	if (confirm("Desea eliminar el registro?")) {
        // your deletion code
	var response;
	$.ajax({ type: "GET",   
     url: "ajax/eliminar.php?tabla=" + tabla +"&id="+ id,   
     async: false,
	 datatype: "html",
     success : function(data)
     {
		window.location = window.location.href.split("?")[0];
		window.alert(data);
        response= data;
     }
	});	
}
    return false;
}

function eliminarServ(nombre){
	if (confirm("Desea eliminar el registro?")) {
        // your deletion code
	var response;
	$.ajax({ type: "GET",   
     url: "/Orquestador/ajax/eliminar.php?nombre="+ nombre,   
     async: false,
	 datatype: "html",
     success : function(data)
     {
		window.location = window.location.href.split("?")[0];
		window.alert(data);
        response= data;
     }
	});	
}
    return false;
}

function eliminarUser(nombre){
	if (confirm("Desea eliminar el registro?")) {
        // your deletion code
	var response;
	$.ajax({ type: "GET",   
     url: "/Orquestador/ajax/eliminar.php?id="+ nombre,   
     async: false,
	 datatype: "html",
     success : function(data)
     {
		window.location = window.location.href.split("?")[0];
		window.alert(data);
        response= data;
     }
	});	
}
    return false;
}

function logout(){
	if (confirm("Desea cerrar sesion?")) {
        // your deletion code
	var response;
	$.ajax({ type: "GET",   
     url: "/Orquestador/ajax/logout.php",   
     async: false,
	 datatype: "html",
     success : function(data)
     {
        response= data;
        window.location.replace(data);
     }
	});	
}
    return false;	
}
 function display(test) {
 	var text = test.split(",");
 	var textlen= text.length;
 	test = "";
 	while (textlen > 0){
 		textlen = textlen -1;
 		test = test + text[textlen] + "\r\n";
 	}
 	$("#popup").text(test);
    $("#dialog").dialog();
 }

$(document).ready(function(){
$("#severidad").change(function(){
    var color = $("option:selected", this).attr("class");
    $("#severidad").attr("class", color);
});
});
