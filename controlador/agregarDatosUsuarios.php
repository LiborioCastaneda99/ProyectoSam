<?php 

require_once "conexion.php";
$conexion=conexion();
$na=$_POST['nombresApellidos'];
$d=$_POST['direccion'];
$t=$_POST['telefono'];
$c=$_POST['correoElectronico'];
$p=$_POST['password'];
$tu=$_POST['tipoUsuario'];
$a=$_POST['actividad'];
  $password = password_hash($p, PASSWORD_BCRYPT);

$sql="INSERT into Usuarios (nombresApellidos, direccion, telefono, correoElectronico, password, ID_Tipo_Usuario, actividad) values ('$na','$d','$t','$c','$password','$tu','$a')";
echo $result=mysqli_query($conexion,$sql);

?>