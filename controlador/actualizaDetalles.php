<?php 
	require_once "conexion.php";
	$conexion=conexion();
	$id=$_POST['idRequerimiento'];
	$d=$_POST['detalle'];
	$e='ATENTIDO';
	$f=date('y-m-d');

	$sql="UPDATE Requerimientos set estado='$e',
									detalle='$d',
									fecha_Finalizacion='$f'
				where id='$id'";
	echo $result=mysqli_query($conexion,$sql);

 ?>