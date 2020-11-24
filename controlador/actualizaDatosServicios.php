<?php 

require_once "conexion.php";
$conexion=conexion();
$id=$_POST['id'];
$nc=strtoupper($_POST['nombreServicio']);

$sql="UPDATE Tipo_de_servicio set Servicio='$nc'
where id='$id'";
echo $result=mysqli_query($conexion,$sql);

?>