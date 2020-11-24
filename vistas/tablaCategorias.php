
<?php 
session_start();
require_once "../controlador/conexion.php";
require '../controlador/database.php';
$conexion=conexion();

?> 
<div class="row">
	<h2 style="margin:0px auto;">Control de datos Categorias</h2>
	<caption>
		<br><br><br>
		<button type="button" class="btn btn-success w-100" data-toggle="modal" data-target="#AgregarCategorias">
			<i class="fas fa-address-card"></i> 
			Agregar Categorias
		</button>
	</caption>
	<div class="table-responsive">
		<table class="table table-hover mt-2 py-2 w-100">
			<thead class="bg-dark text-light" style="border-radius: 5px;">
				<tr>
					<th scope="col">Id</th>
					<th scope="col">Nombres de la categorías</th>
					<th scope="col">Editar</th>
					<th scope="col">Eliminar</th>
				</tr>
			</thead>
			<?php 
			if(isset($_SESSION['consulta'])){
				if($_SESSION['consulta'] > 0){
					$idp=$_SESSION['consulta'];
					$sql="SELECT `ID`, `Categoria` FROM Categorias where id='$idp'";
				}else{
					$sql="SELECT `ID`, `Categoria` FROM Categorias";
				}
			}else{
				$sql="SELECT `ID`, `Categoria` FROM Categorias";
			}

			$result=mysqli_query($conexion,$sql);
			while($ver=mysqli_fetch_row($result)){ 

				$datos=
				$ver[0]."||".
				$ver[1];
				?>

				<tr class="small">
					<td><?php echo $ver[0] ?></td>
					<td><?php echo $ver[1] ?></td>
					
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