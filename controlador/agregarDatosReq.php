<?php 
require_once "conexion.php";
$conexion=conexion();

$cr=$_POST['codigoRadicado'];
$id=$_POST['idUser'];
$l1=$_POST['lista1'];
$l2=$_POST['lista2'];
$d=$_POST['descripcion'];
$u=$_POST['ubicacion'];
$ce=$_POST['correoElectronico'];
$na=$_POST['nombresApellidos'];
$f=date('y-m-d');

$sql="INSERT into Requerimientos (codigo, usuario_Solicitante, categoria, servicio, estado, descripcion_Solicitud, ubicacion,fecha_Creacion)
values ('$cr','$id','$l1','$l2','REPORTADO','$d','$u','$f')";

echo $result=mysqli_query($conexion,$sql);

ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "concurso@planeacionsat.com";
    $to = $ce;
    $subject = "Nuevo requerimiento";
    $message = "

    Buenas ".$na.", el requerimiento con código ".$cr.", con el detalle: ".$d.", ha sido reportado con estado en proceso con éxito.

	Muchas gracias.";
    $headers = "From:" . $from;
    mail($to,$subject,$message, $headers);


?>