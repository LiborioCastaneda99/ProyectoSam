

function agregardatos(nombresApellidos,direccion,telefono,correoElectronico,password,tipoUsuario,actividad){

	cadena="nombresApellidos=" + nombresApellidos + 
	"&direccion=" + direccion +
	"&telefono=" + telefono +
	"&correoElectronico=" + correoElectronico +
	"&password=" + password +
	"&tipoUsuario=" + tipoUsuario +
	"&actividad=" + actividad ;

	$.ajax({
		type:"POST",
		url:"controlador/agregarDatosUsuarios.php",
		data:cadena,
		success:function(r){
			if(r==1){
				$('#tabla').load('vistas/tablaUsuarios.php');
				//$('#buscador').load('componentes/buscador.php');
				alertify.success("agregado con exito :)");
			}else{
				alertify.error("Fallo el servidor :(");
			}
		}
	});

}

function agregaform(datos){

	d=datos.split('||');

	$('#idUsuario').val(d[0]);
	$('#nombresApellidosu').val(d[1]);
	$('#direccionu').val(d[2]);
	$('#telefonou').val(d[3]);
	$('#correoElectronicou').val(d[4]);
	$('#tipoUsuariou').val(d[6]);
	$('#actividadu').val(d[7]);
	
}

function actualizaDatos(){

	id=$('#idUsuario').val();
	nombresApellidos=$('#nombresApellidosu').val();
	direccion=$('#direccionu').val();
	telefono=$('#telefonou').val();
	correoElectronico=$('#correoElectronicou').val();
	tipoUsuario=$('#tipoUsuariou').val();
	actividad=$('#actividadu').val();

	cadena="id=" + id + 
	"&nombresApellidos=" + nombresApellidos + 
	"&direccion=" + direccion +
	"&telefono=" + telefono +
	"&correoElectronico=" + correoElectronico +
	"&tipoUsuario=" + tipoUsuario +
	"&actividad=" + actividad ;

	$.ajax({
		type:"POST",
		url:"controlador/actualizaDatosUsuarios.php",
		data:cadena,
		success:function(r){
			
			if(r==1){
				$('#tabla').load('vistas/tablaUsuarios.php');
				alertify.success("Actualizado con exito :)");
			}else{
				alertify.error("Fallo el servidor :(");
			}
		}
	});

}

function preguntarSiNo(id){
	alertify.confirm('Eliminar Usuarios', '¿Realmente desea eliminar este usuario?', 
		function(){ eliminarDatos(id) }
		, function(){ alertify.error('Se cancelo la eliminación del registro.')});
}

function eliminarDatos(id){

	cadena="id=" + id;

	$.ajax({
		type:"POST",
		url:"controlador/eliminarDatosUsuarios.php",
		data:cadena,
		success:function(r){
			if(r==1){
				$('#tabla').load('vistas/tablaUsuarios.php');
				alertify.success("Eliminado con exito!");
			}else{
				alertify.error("Fallo el servidor :(");
			}
		}
	});
}