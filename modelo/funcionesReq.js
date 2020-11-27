
function agregardatos(codigoRadicado,idUser,lista1,lista2,descripcion,ubicacion,detalle,idRequerimiento,correoElectronico, nombresApellidos){

	cadena="codigoRadicado=" + codigoRadicado + 
	"&idUser=" + idUser + 
	"&lista1=" + lista1 + 
	"&lista2=" + lista2 +
	"&descripcion=" + descripcion +
	"&ubicacion=" + ubicacion +
	"&correoElectronico=" + correoElectronico +
	"&nombresApellidos=" + nombresApellidos;

	$.ajax({
		type:"POST",
		url:"controlador/agregarDatosReq.php",
		data:cadena,
		success:function(r){
			if(r==1){
				$('#tabla').load('vistas/tablaRequerimientos.php');
				alertify.success("agregado con exito :)");
			}else{
				alertify.error("Fallo el servidor :(");
			}
		}
	});
}


function agregaform(datos){

	d=datos.split('||');

	$('#idRequerimiento').val(d[0]);
	$('#codigoU').val(d[1]);
	$('#usuarioSolicitanteU').val(d[2]);
	$('#usuarioSoporteU').val(d[3]);
	$('#categoriaU').val(d[4]);
	$('#servicioU').val(d[5]);
	$('#estadoU').val(d[6]);
	$('#descripcionSolicitudU').val(d[7]);
	$('#ubicacionU').val(d[8]);
	$('#detalleU').val(d[9]);
	$('#fechaCreacionU').val(d[10]);
	$('#fechaAtencionU').val(d[11]);
	$('#fechaFinalizacionU').val(d[12]);
	$('#correoElectronicoU').val(d[13]);
	
}


function actualizaDatos(){

	detalle=$('#detalleU').val();
		idRequerimiento=$('#idRequerimiento').val();
		correoElectronico=$('#correoElectronico').val();
		codigo=$('#codigo').val();
		usuarioSolicitante=$('#usuarioSolicitante').val();

	cadena= "detalle=" + detalle +
	"&idRequerimiento=" + idRequerimiento +
	"&correoElectronico=" + correoElectronico+
	"&codigo=" + codigo +
	"&usuarioSolicitante=" + usuarioSolicitante;

	$.ajax({
		type:"POST",
		url:"controlador/actualizaDetalles.php",
		data:cadena,
		success:function(r){
			
			if(r==1){
				$('#tabla').load('vistas/tablaRequerimientos.php');
				alertify.success("El detalle ha sido agregado con exito :)");
			}else{
				alertify.error("Fallo el servidor :(");
			}
		}
	});

}
