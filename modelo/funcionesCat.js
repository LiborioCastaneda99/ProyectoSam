

function agregardatos(nombreCategoria){

	cadena="nombreCategoria=" + nombreCategoria ;

	$.ajax({
		type:"POST",
		url:"controlador/agregarDatosCategoria.php",
		data:cadena,
		success:function(r){
			if(r==1){
				$('#tabla').load('vistas/tablaCategorias.php');
				alertify.success("agregada con exito :)");
			}else{
				alertify.error("Fallo el servidor :(");
			}
		}
	});

}

function agregaform(datos){

	d=datos.split('||');

	$('#idCategoria').val(d[0]);
	$('#nombreCategoriau').val(d[1]);
	
}

function actualizaDatos(){

	id=$('#idCategoria').val();
	nombreCategoria=$('#nombreCategoriau').val();

	cadena="id=" + id + 
	"&nombreCategoria=" + nombreCategoria ;

	$.ajax({
		type:"POST",
		url:"controlador/actualizaDatosCategorias.php",
		data:cadena,
		success:function(r){
			
			if(r==1){
				$('#tabla').load('vistas/tablaCategorias.php');
				alertify.success("Actualizada con exito :)");
			}else{
				alertify.error("Fallo el servidor :(");
			}
		}
	});

}

function preguntarSiNo(id){
	alertify.confirm('Eliminar Usuarios', '¿Realmente desea eliminar está categoria?', 
		function(){ eliminarDatos(id) }
		, function(){ alertify.error('Se cancelo la eliminación del registro.')});
}

function eliminarDatos(id){

	cadena="id=" + id;

	$.ajax({
		type:"POST",
		url:"controlador/eliminarDatosCategorias.php",
		data:cadena,
		success:function(r){
			if(r==1){
				$('#tabla').load('vistas/tablaCategorias.php');
				alertify.success("Eliminada con exito!");
			}else{
				alertify.error("Fallo el servidor :(");
			}
		}
	});
}