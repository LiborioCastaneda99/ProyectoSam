<?php 
$conexion=mysqli_connect('localhost','root','','proyecto_3corte');
$continente=$_POST['continente'];

	$sql="SELECT `ID`, `ID_Categoria`, `Servicio` FROM `Tipo_de_servicio` WHERE ID_Categoria='$continente'";

	$result=mysqli_query($conexion,$sql);

	$cadena="
			<select id='lista2' name='lista2' class='form form-control'>
			<option value='0'>Seleccione una</option>";

	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[0].'>'.$ver[2].'</option>';
	}

	echo  $cadena."</select>";
	

?>