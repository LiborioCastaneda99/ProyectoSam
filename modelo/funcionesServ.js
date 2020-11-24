

function agregardatos(nombreCategoria,nombreServicio){

	cadena="nombreCategoria=" + nombreCategoria+
			"&nombreServicio="+nombreServicio;

	$.ajax({
		type:"POST",
		url:"controlador/agregarDatosServicios.php",
		data:cadena,
		success:function(r){
			if(r==1){
				$('#tabla').load('vistas/tablaServicios.php');
				alertify.success("agregada con exito :)");
			}else{
				alertify.error("Fallo el servidor :(");
			}
		}
	});

}

function agregaform(datos){

	d=datos.split('||');

	$('#idServicio').val(d[4]);
	$('#nombreServiciou').val(d[3]);
	
}

function actualizaDatos(){

	id=$('#idServicio').val();
	nombreServicio=$('#nombreServiciou').val();

	cadena="id=" + id + 
	"&nombreServicio=" + nombreServicio ;

	$.ajax({
		type:"POST",
		url:"controlador/actualizaDatosServicios.php",
		data:cadena,
		success:function(r){
			
			if(r==1){
				$('#tabla').load('vistas/tablaServicios.php');
				alertify.success("Actualizado con exito :)");
			}else{
				alertify.error("Fallo el servidor :(");
			}
		}
	});

}

function preguntarSiNo(id){
	alertify.confirm('Eliminar Usuarios', '¿Realmente desea eliminar este servicio?', 
		function(){ eliminarDatos(id) }
		, function(){ alertify.error('Se cancelo la eliminación del registro.')});
}

function eliminarDatos(id){

	cadena="id=" + id;

	$.ajax({
		type:"POST",
		url:"controlador/eliminarDatosServicios.php",
		data:cadena,
		success:function(r){
			if(r==1){
				$('#tabla').load('vistas/tablaServicios.php');
				alertify.success("Eliminado con exito!");
			}else{
				alertify.error("Fallo el servidor :(");
			}
		}
	});
}