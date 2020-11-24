<?php 
require_once "conexion.php";
$conexion=conexion();
$iU=$_POST['idUser'];
$fA=$_POST['fecha_Atencion'];
$e=$_POST['estado'];
$iR=$_POST['idRequerimiento'];
$ce=$_POST['correoElectronico'];
$na=$_POST['nombresApellidos'];
$cr=$_POST['codigoRequerimiento'];
$d=$_POST['datalleRequerimiento'];

$sql="UPDATE Requerimientos set usuario_Soporte='$iU', estado='$e', fecha_Atencion='$fA' where id='$iR'";
echo $result=mysqli_query($conexion,$sql);
if ($result>0) {

ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "concurso@planeacionsat.com";
    $to = $ce;
    $subject = "El estado del requerimiento cambió";
    $message = "

    Buenas ".$na.", el requerimiento con código ".$cr.", con el detalle: ".$d.", ha sido reportado con estado atendido con éxito.

	Muchas gracias.";
    $headers = "From:" . $from;
    mail($to,$subject,$message, $headers);


	echo "<script> 
	window.location='../requerimientos.php';

	</script>";	
}


?>