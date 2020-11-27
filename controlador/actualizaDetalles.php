<?php 
require_once "conexion.php";
$conexion=conexion();
$id=$_POST['idRequerimiento'];
$d=$_POST['detalle'];
$na=$_POST['usuarioSolicitante'];
$cr=$_POST['codigo'];
$ce=$_POST['correoElectronico'];
$e='ATENTIDO';
$f=date('y-m-d');

$sql="UPDATE Requerimientos set estado='$e',
detalle='$d',
fecha_Finalizacion='$f'
where id='$id'";
echo $result=mysqli_query($conexion,$sql);

ini_set( 'display_errors', 1 );
error_reporting( E_ALL );
$from = "concurso@planeacionsat.com";
$to = $ce;
$subject = "El estado de su requerimiento cambió";
$message = "

Buenas ".$na.", el requerimiento con código ".$cr.", con el detalle: ".$d.", ha sido reportado con estado atendido con éxito.

Muchas gracias.";
$headers = "From:" . $from;
mail($to,$subject,$message, $headers);


?>