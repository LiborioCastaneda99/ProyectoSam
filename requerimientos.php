<?php
session_start();

require_once "controlador/conexion.php";

require 'controlador/database.php';

$conexion=conexion();

//Consulta para traer 
$sql_traer_categorias="SELECT `ID`, `Categoria` FROM Categorias";
$result=mysqli_query($conexion,$sql_traer_categorias);

//Consulta para contar el codigo 
$sql_codigo="SELECT count(codigo) As codigo FROM Requerimientos";
$result_codigo=mysqli_query($conexion,$sql_codigo);

while($ver_codigo=mysqli_fetch_row($result_codigo)):
 ?>
 <?php 
 $contar=1;
 $contar=$contar+$ver_codigo[0];
 ?>
<?php endwhile;

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
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
  <title>Control de datos Requerimientos | PROYECTO 3 CORTE</title>
  

  <!--Fuentes de letra de google-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />

  <!-- Bootstrap CSS CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <!-- Our Custom CSS -->
  <link rel="stylesheet" href="css/style.css">
  <!-- Scrollbar Custom CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

  <!-- Font Awesome JS -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>


  <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
  <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">
  <link rel="stylesheet" type="text/css" href="librerias/select2/css/select2.css">

  <script src="librerias/jquery-3.2.1.min.js"></script>
  <script src="modelo/funcionesReq.js"></script>
  <script src="librerias/bootstrap/js/bootstrap.js"></script>
  <script src="librerias/alertifyjs/alertify.js"></script>
</head>
<body>


  <?php $id=$user['id']; $correoElectronico=$user['correoElectronico'];   $nombresApellidos=$user['nombresApellidos']; if(!empty($user) && ($user['ID_Tipo_Usuario']==1)): ?>

  <div class="wrapper">
    <!-- Page Content  -->
    <div id="content">
     <!-- navbar  -->
     <?php include 'controlador/navbar.php'; ?>

     <div class="container">
      <div id="buscador"></div>
      <div id="tabla"></div>
    </div>
  </div>
</div>

<!-- Modal para registros nuevos -->
<div class="modal fade" id="AgregarRequerimientos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-centered" role="document">
   <div class="modal-content">
     <div class="modal-header">
      <h5 class="modal-title text-center">Agregar Requerimiento</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">      
      </button>
    </div>
    <div class="modal-body">
     <form class="form p-2 mt-2">
      <div class="form-group text-left row">
        <div class="col">
          <label>Categoría principal</label>
          <select id="lista1" name="lista1" class="form form-control">
            <option value="0">Seleciona una</option>
            <?php
            while($ver_categorias=mysqli_fetch_row($result)):
             ?>
             <option value="<?php echo $ver_categorias[0] ?>">
              <?php echo $ver_categorias[1]?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>
    </div>
    <div class="form-group text-left row">
      <div class="col">
        <label>Categoría Secundaria</label>
        <div id="select2lista"></div>
      </div>
    </div>
    <div class="form-group text-left">
      <label for="text-left">Descripción de la solicitud</label>
      <input type="text" id="descripcion" class="form form-control">
    </div>
    <div class="form-group text-left">
      <label for="text-left">Ubicación dentro de la empresa</label>
      <input type="text" id="ubicacion" class="form form-control" placeholder="donde será prestado el servicio">
      <input type="hidden" id="idUser" name="" value="<?php echo $id;?>">
      <input type="hidden" id="codigoRadicado" name="" value="<?php echo "00".$contar;?>">
      <input type="hidden" id="correoElectronico" name="" value="<?php echo $correoElectronico;?>">
      <input type="hidden" id="nombresApellidos" name="" value="<?php echo $nombresApellidos;?>">
    </div>
  </form>
</div>
<div class="modal-footer">
 <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
 <button type="button" class="btn btn-success" data-dismiss="modal" id="guardarnuevo">
  Agregar
</button>
</div>
</div>
</div>
</div>


<?php $id=$user['id']; elseif(!empty($user) && ($user['ID_Tipo_Usuario']==2)): ?>

<div class="wrapper">
  <!-- Page Content  -->
  <div id="content">
   <!-- navbar  -->
   <?php include 'controlador/navbar.php'; ?>

   <div class="container">
    <div id="buscador"></div>
    <div id="tabla"></div>
  </div>
</div>
</div>

<!-- Modal para edicion de datos-->
<div class="modal fade" id="modalEdicion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center">Actualizar Requerimientos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
       <form class="form p-2 mt-2">
        <div class="form-group text-left row">
          <div class="col">
            <label class="text-left">Detalles</label>
            <input type="text" id="detalleU" class="form form-control" required="">
            <input type="hidden" id="idRequerimiento" class="form form-control" required="">
            <input type="hidden" id="codigoU" class="form form-control" required="">
            <input type="hidden" id="correoElectronicoU" class="form form-control" required="">
            <input type="hidden" id="usuarioSolicitanteU" class="form form-control" required="">
          </div>
        </div>
      </form>
    </div>
    <div class="modal-footer">
     <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
     <button type="button" class="btn btn-warning" id="actualizadatos" data-dismiss="modal">Actualizar</button>
   </div>
 </div>
</div>
</div>

<?php else: ?>
  <?php echo "<script>window.location='iniciar-sesion.php';</script>"; ?>
<?php endif; ?>


<!-- jQuery Custom Scroller CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

<script type="text/javascript">
  $(document).ready(function () {
    $("#sidebar").mCustomScrollbar({
      theme: "minimal"
    });

    $('#dismiss, .overlay').on('click', function () {
      $('#sidebar').removeClass('active');
      $('.overlay').removeClass('active');
    });

    $('#sidebarCollapse').on('click', function () {
      $('#sidebar').addClass('active');
      $('.overlay').addClass('active');
      $('.collapse.in').toggleClass('in');
      $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });
  });
</script>
</body>

</html>

<script type="text/javascript">
  $(document).ready(function(){
    $('#tabla').load('vistas/tablaRequerimientos.php');
  });
</script>


<!--Listas -->
<script type="text/javascript">
  $(document).ready(function(){
    $('#lista1').val(0);
    recargarLista();

    $('#lista1').change(function(){
      recargarLista();
    });
  })
</script>
<script type="text/javascript">
  function recargarLista(){
    $.ajax({
      type:"POST",
      url:"controlador/datosSelect.php",
      data:"continente=" + $('#lista1').val(),
      success:function(r){
        $('#select2lista').html(r);
      }
    });
  }
</script>


<script type="text/javascript">
  $(document).ready(function(){
    $('#guardarnuevo').click(function(){
      codigoRadicado=$('#codigoRadicado').val();
      idUser=$('#idUser').val();
      lista1=$('#lista1').val();
      lista2=$('#lista2').val();
      descripcion=$('#descripcion').val();
      ubicacion=$('#ubicacion').val();
      correoElectronico=$('#correoElectronico').val();
      nombresApellidos=$('#nombresApellidos').val();
      agregardatos(codigoRadicado,idUser,lista1,lista2,descripcion,ubicacion,correoElectronico, nombresApellidos);
    });


    $('#actualizadatos').click(function(){
      actualizaDatos();
    });

  });
</script>

