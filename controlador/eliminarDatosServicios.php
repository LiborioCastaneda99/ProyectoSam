
<?php 
	require_once "conexion.php";
	$conexion=conexion();
	$id=$_POST['id'];

	$sql="DELETE from Tipo_de_servicio where ID='$id'";
	echo $result=mysqli_query($conexion,$sql);
 ?>