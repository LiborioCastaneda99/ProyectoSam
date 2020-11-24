<?php 

require_once "conexion.php";
$conexion=conexion();
$nc=$_POST['nombreCategoria'];
$ns=strtoupper($_POST['nombreServicio']);


$sql="INSERT into Tipo_de_servicio (`ID_Categoria`, `Servicio`) values ('$nc','$ns')";
echo $result=mysqli_query($conexion,$sql);

?>