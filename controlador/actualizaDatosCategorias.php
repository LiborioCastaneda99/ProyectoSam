<?php 

require_once "conexion.php";
$conexion=conexion();
$id=$_POST['id'];
$nc=strtoupper($_POST['nombreCategoria']);

$sql="UPDATE Categorias set Categoria='$nc'
where id='$id'";
echo $result=mysqli_query($conexion,$sql);

?>