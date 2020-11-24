
<?php 
session_start();
require_once "../controlador/conexion.php";
require '../controlador/database.php';
$conexion=conexion();

?> 
<div class="row">
	<h2 style="margin:0px auto;">Control de datos Servicios</h2>
	<caption>
		<br><br><br>
		<button type="button" class="btn btn-success w-100" data-toggle="modal" data-target="#AgregarServicios">
			<i class="fas fa-address-card"></i> 
			Agregar Servicios
		</button>
	</caption>
	<div class="table-responsive">
		<table class="table table-hover mt-2 py-2 w-100">
			<thead class="bg-dark text-light" style="border-radius: 5px;">
				<tr>
					<th scope="col">Nombre del servicio</th>
					<th scope="col">Editar</th>
					<th scope="col">Eliminar</th>
				</tr>
			</thead>
			<?php 
			if(isset($_SESSION['consulta'])){
				if($_SESSION['consulta'] > 0){
					$idp=$_SESSION['consulta'];
					$sql="SELECT Categorias.`ID`, `ID_Categoria`, Categorias.Categoria, `Servicio`,Tipo_de_servicio.ID As Id_Servicios FROM `Tipo_de_servicio`,Categorias WHERE Tipo_de_servicio.ID_Categoria=Categorias.ID and Tipo_de_servicio.ID='$idp'";
				}else{
					$sql="SELECT Categorias.`ID`, `ID_Categoria`, Categorias.Categoria, `Servicio`,Tipo_de_servicio.ID As Id_Servicios FROM `Tipo_de_servicio`,Categorias WHERE Tipo_de_servicio.ID_Categoria=Categorias.ID";
				}
			}else{
				$sql="SELECT Categorias.`ID`, `ID_Categoria`, Categorias.Categoria, `Servicio`,Tipo_de_servicio.ID As Id_Servicios FROM `Tipo_de_servicio`,Categorias WHERE Tipo_de_servicio.ID_Categoria=Categorias.ID";
			}

			$result=mysqli_query($conexion,$sql);
			while($ver=mysqli_fetch_row($result)){ 

				$datos=
				$ver[0]."||".
				$ver[1]."||".
				$ver[2]."||".
				$ver[3]."||".
				$ver[4];
				?>

				<tr class="small">
					<td><?php echo strtoupper($ver[3]) ?></td>
					
					<td>
						<button class="btn btn-warning glyphicon glyphicon-edit" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $datos ?>')">
						</button>
					</td>
					<td>
						<button class="btn btn-danger glyphicon glyphicon-trash" onclick="preguntarSiNo('<?php echo $ver[4] ?>')">
						</button>
					</td>
				</tr>
				<?php 
			}
			?>
		</table>
	</div>
</div>