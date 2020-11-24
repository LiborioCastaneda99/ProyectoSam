
<?php 
session_start();
require_once "../controlador/conexion.php";
require '../controlador/database.php';
$conexion=conexion();

?> 
<div class="row">
	<h2 style="margin:0px auto;">Control de datos Usuarios</h2>
	<caption>
		<br><br><br>
		<button type="button" class="btn btn-success w-100" data-toggle="modal" data-target="#AgregarUsuarios">
			<i class="fas fa-address-card"></i> 
			Agregar Usuarios
		</button>
	</caption>
	<div class="table-responsive">
		<table class="table table-hover mt-2 py-2 w-100">
			<thead class="bg-dark text-light" style="border-radius: 5px;">
				<tr>
					<th scope="col">Nombres y Apellidos</th>
					<th scope="col">Dirección</th>
					<th scope="col">Teléfono</th>
					<th scope="col">Correo electrónico</th>
					<th scope="col">Tipo Usuario</th>
					<th scope="col">Actividad</th>
					<th scope="col">Editar</th>
					<th scope="col">Eliminar</th>
				</tr>
			</thead>
			<?php 
			if(isset($_SESSION['consulta'])){
				if($_SESSION['consulta'] > 0){
					$idp=$_SESSION['consulta'];
					$sql="SELECT `id`, `nombresApellidos`, `direccion`, `telefono`, `correoElectronico`, `password`, `ID_Tipo_Usuario`, actividad FROM Usuarios where id='$idp'";
				}else{
					$sql="SELECT `id`, `nombresApellidos`, `direccion`, `telefono`, `correoElectronico`, `password`, `ID_Tipo_Usuario`, actividad FROM Usuarios";
				}
			}else{
				$sql="SELECT `id`, `nombresApellidos`, `direccion`, `telefono`, `correoElectronico`, `password`, `ID_Tipo_Usuario`, actividad FROM Usuarios";
			}

			$result=mysqli_query($conexion,$sql);
			while($ver=mysqli_fetch_row($result)){ 

				$datos=
				$ver[0]."||".
				$ver[1]."||".
				$ver[2]."||".
				$ver[3]."||".
				$ver[4]."||".
				$ver[5]."||".
				$ver[6]."||".
				$ver[7];
				?>

				<tr class="small">
					<td><?php echo $ver[1] ?></td>
					<td><?php echo $ver[2]?></td>
					<td><?php echo $ver[3] ?></td>
					<td><?php echo $ver[4] ?></td>
					<td>
						<?php 
						if ($ver[6]=='1') {
							echo "Usuario Solicitante";
						}elseif ($ver[6]=='2') {
							echo "Soporte tecnico";
						}elseif ($ver[6]=='3') {
							echo "Administrador";
						} ?>
					</td>
					<td><?php if ($ver[7]==1) {
						echo "Activo";
					}elseif ($ver[7]==2) {
						echo "Inactivo";
					} ?></td>
					<td>
						<button class="btn btn-warning glyphicon glyphicon-edit" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $datos ?>')">
						</button>
					</td>
					<td>
						<button class="btn btn-danger glyphicon glyphicon-trash" onclick="preguntarSiNo('<?php echo $ver[0] ?>')">
						</button>
					</td>
				</tr>
				<?php 
			}
			?>
		</table>
	</div>
</div>