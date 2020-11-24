<?php 

require_once "conexion.php";
$conexion=conexion();
$nc=strtoupper($_POST['nombreCategoria']);


$sql="INSERT into Categorias (Categoria) values ('$nc')";
echo $result=mysqli_query($conexion,$sql);

?>