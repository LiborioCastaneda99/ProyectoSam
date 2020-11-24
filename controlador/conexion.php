

<?php 
		function conexion(){
			$servidor="localhost";
			$usuario="root";
			$password="";
			$bd="proyecto_3corte";

			$conexion=mysqli_connect($servidor,$usuario,$password,$bd);

			return $conexion;
		}

 ?>