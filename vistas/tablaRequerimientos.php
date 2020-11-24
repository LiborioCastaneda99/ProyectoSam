
<?php 
session_start();
require_once "../controlador/conexion.php";
require '../controlador/database.php';
$conexion=conexion();


//validar sesión
if (isset($_SESSION['user_id'])) {
	$records = $conn->prepare('SELECT id, nombresApellidos, direccion, telefono, correoElectronico, password, ID_Tipo_Usuario FROM Usuarios  WHERE id = :id');
	$records->bindParam(':id', $_SESSION['user_id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$user = null;

	if (count($results) > 0) {
		$user = $results;
	}
}

?>
<?php $id=$user['id']; if(!empty($user) && ($user['ID_Tipo_Usuario']==1)): ?>

<div class="row">
	<h2 style="margin:0px auto;">Control de datos Requerimientos</h2>
	<caption>
		<br><br><br>
		<button type="button" class="btn btn-success w-100" data-toggle="modal" data-target="#AgregarRequerimientos">
			<i class="fas fa-address-card"></i> 
			Agregar Requerimientos
		</button>
	</caption>
	<div class="table-responsive">
		<table class="table table-hover mt-2 py-2 w-100">
			<thead class="bg-dark text-light" style="border-radius: 5px;">
				<tr>
					<th scope="col">Codigo</th>
					<th scope="col">Usuario Solicitante</th>
					<th scope="col">Usuario Soporte</th>
					<th scope="col">Categoria</th>
					<th scope="col">Servicio</th>
					<th scope="col">Estado</th>
					<th scope="col">Descripción Solicitud</th>
					<th scope="col">Ubicación</th>
					<th scope="col">Detalle</th>
					<th scope="col">Fecha Creación</th>
					<th scope="col">Fecha Atención</th>
					<th scope="col">Fecha Finalización</th>
				</tr>
			</thead>
			<?php 
			$id=$user['id'];
			if(isset($_SESSION['consulta'])){
				if($_SESSION['consulta'] > 0){
					$idp=$_SESSION['consulta'];
					$sql="SELECT `id`, `codigo`, `usuario_Solicitante`, `usuario_Soporte`, `categoria`, `servicio`, `estado`, `descripcion_Solicitud`, `ubicacion`, `detalle`, `fecha_Creacion`, `fecha_Atencion`, `fecha_Finalizacion` FROM `Requerimientos` where id='$idp'";
				}else{
					$sql="SELECT Requerimientos.`id`, `codigo`, Usuarios.nombresApellidos, `usuario_Soporte`, Categorias.Categoria, Tipo_de_servicio.Servicio, `estado`, `descripcion_Solicitud`, `ubicacion`, `detalle`, `fecha_Creacion`, `fecha_Atencion`, `fecha_Finalizacion` FROM `Requerimientos`, Tipo_de_servicio, Categorias, Usuarios where Requerimientos.categoria=Categorias.ID and Requerimientos.servicio=Tipo_de_servicio.ID and Requerimientos.usuario_Solicitante=Usuarios.id and Requerimientos.usuario_Solicitante=$id";
				}
			}else{
				$sql="SELECT Requerimientos.`id`, `codigo`, Usuarios.nombresApellidos, `usuario_Soporte`, Categorias.Categoria, Tipo_de_servicio.Servicio, `estado`, `descripcion_Solicitud`, `ubicacion`, `detalle`, `fecha_Creacion`, `fecha_Atencion`, `fecha_Finalizacion` FROM `Requerimientos`, Tipo_de_servicio, Categorias, Usuarios where Requerimientos.categoria=Categorias.ID and Requerimientos.servicio=Tipo_de_servicio.ID and Requerimientos.usuario_Solicitante=Usuarios.id and Requerimientos.usuario_Solicitante=$id";
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
				$ver[6];
				?>

				<tr class="small">
					<td><?php echo $ver[1] ?></td>
					<td><?php echo $ver[2]?></td>
					<td><?php echo $ver[3] ?></td>
					<td><?php echo $ver[4] ?></td>
					<td><?php echo strtoupper($ver[5]) ?></td>
					<td><?php echo $ver[6] ?></td>
					<td><?php echo $ver[7] ?></td>
					<td><?php echo $ver[8] ?></td>
					<td><?php echo $ver[9] ?></td>
					<td><?php echo $ver[10] ?></td>
					<td><?php echo $ver[11] ?></td>
					<td><?php echo $ver[12] ?></td>
				</tr>
				<?php 
			}
			?>
		</table>
	</div>
</div>
<?php $id=$user['id']; elseif(!empty($user) && ($user['ID_Tipo_Usuario']==2)): ?>



<div class="row">
	<h2 style="margin:0px auto;">Control de datos Requerimientos</h2>
	<caption>
		<br><br><br>
	</caption>
	<div class="table-responsive">
		<table class="table table-hover mt-2 py-2 w-100">
			<thead class="bg-dark text-light" style="border-radius: 5px;">
				<tr>
					<th scope="col">Codigo</th>
					<th scope="col">Usuario Solicitante</th>
					<th scope="col">Usuario Soporte</th>
					<th scope="col">Categoria</th>
					<th scope="col">Servicio</th>
					<th scope="col">Estado</th>
					<th scope="col">Descripción Solicitud</th>
					<th scope="col">Ubicación</th>
					<th scope="col">Detalle</th>
					<th scope="col">Fecha Creación</th>
					<th scope="col">Fecha Atención</th>
					<th scope="col">Fecha Finalización</th>
					<th scope="col">Atender servicio</th>
					<th scope="col">Agregar detalles</th>
				</tr>
			</thead>
			<?php 
			$id=$user['id'];
			if(isset($_SESSION['consulta'])){
				if($_SESSION['consulta'] > 0){
					$idp=$_SESSION['consulta'];
					$sql="SELECT `id`, `codigo`, `usuario_Solicitante`, `usuario_Soporte`, `categoria`, `servicio`, `estado`, `descripcion_Solicitud`, `ubicacion`, `detalle`, `fecha_Creacion`, `fecha_Atencion`, `fecha_Finalizacion` FROM `Requerimientos` where id='$idp'";
				}else{
					$sql="SELECT Requerimientos.`id`, `codigo`, Usuarios.nombresApellidos, `usuario_Soporte`, Categorias.Categoria, Tipo_de_servicio.Servicio, `estado`, `descripcion_Solicitud`, `ubicacion`, `detalle`, `fecha_Creacion`, `fecha_Atencion`, `fecha_Finalizacion`, Usuarios.correoElectronico FROM `Requerimientos`, Tipo_de_servicio, Categorias, Usuarios where Requerimientos.categoria=Categorias.ID and Requerimientos.servicio=Tipo_de_servicio.ID and Requerimientos.usuario_Solicitante=Usuarios.id";
				}
			}else{
				$sql="SELECT Requerimientos.`id`, `codigo`, Usuarios.nombresApellidos, `usuario_Soporte`, Categorias.Categoria, Tipo_de_servicio.Servicio, `estado`, `descripcion_Solicitud`, `ubicacion`, `detalle`, `fecha_Creacion`, `fecha_Atencion`, `fecha_Finalizacion`, Usuarios.correoElectronico FROM `Requerimientos`, Tipo_de_servicio, Categorias, Usuarios where Requerimientos.categoria=Categorias.ID and Requerimientos.servicio=Tipo_de_servicio.ID and Requerimientos.usuario_Solicitante=Usuarios.id";
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
				$ver[7]."||".
				$ver[8]."||".
				$ver[9]."||".
				$ver[10]."||".
				$ver[11]."||".
				$ver[12]."||".
				$ver[13];
				?>

				<tr class="small">
					<td><?php echo $ver[1] ?></td>
					<td><?php echo $ver[2]?></td>
					<td><?php echo $ver[3] ?></td>
					<td><?php echo $ver[4] ?></td>
					<td><?php echo strtoupper($ver[5]) ?></td>
					<td><?php echo $ver[6] ?></td>
					<td><?php echo $ver[7] ?></td>
					<td><?php echo $ver[8] ?></td>
					<td><?php echo $ver[9] ?></td>
					<td><?php echo $ver[10] ?></td>
					<td><?php echo $ver[11] ?></td>
					<td><?php echo $ver[12] ?></td>
					<td>
						<?php if ($ver[6]=='REPORTADO'): ?>
							<form action="controlador/actualizaAtenderServicio.php" method="POST">
								<input type="hidden" name="idUser" value="<?php echo $id; ?>">
								<input type="hidden" name="fecha_Atencion" value="<?php echo date('y-m-d') ?>">
								<input type="hidden" name="estado" value="EN PROCESO">
								<input type="hidden" name="idRequerimiento" value="<?php echo $ver[0]; ?>">
								<input type="hidden" name="correoElectronico" value="<?php echo $ver[13]; ?>">
								<input type="hidden" name="nombresApellidos" value="<?php echo $ver[2]; ?>">
								<input type="hidden" name="codigoRequerimiento" value="<?php echo $ver[1]; ?>">
								<input type="hidden" name="datalleRequerimiento" value="<?php echo $ver[7]; ?>">

								<input type="submit" name=""  class="btn btn-success" value="Atender Servicio">
							</form>
						<?php endif; ?>
					</td>

					<td>
						<?php if ($ver[6]=='EN PROCESO'): ?>
							<button class="btn btn-warning glyphicon glyphicon-edit" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $datos ?>')">
							<?php endif; ?>
						</button>
					</td>
				</tr>
				<?php 
			}
			?>
		</table>
	</div>
</div>

<?php endif; ?>