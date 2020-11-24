<?php 


	require_once "conexion.php";
	$conexion=conexion();
	$id=$_POST['id'];
	$na=$_POST['nombresApellidos'];
	$d=$_POST['direccion'];
	$t=$_POST['telefono'];
	$c=$_POST['correoElectronico'];
	$tu=$_POST['tipoUsuario'];
	$a=$_POST['actividad'];

	$sql="UPDATE Usuarios set nombresApellidos='$na',
								direccion='$d',
								telefono='$t',
								correoElectronico='$c',
								ID_Tipo_Usuario='$tu',
								actividad='$a'
				where id='$id'";
	echo $result=mysqli_query($conexion,$sql);

 ?>