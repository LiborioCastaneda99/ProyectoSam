<?php
session_start();

require_once "controlador/conexion.php";

require 'controlador/database.php';

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
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
  <title>Control de datos Usuarios | PROYECTO 3 CORTE</title>
  

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
  <script src="modelo/funcionesUsu.js"></script>
  <script src="librerias/bootstrap/js/bootstrap.js"></script>
  <script src="librerias/alertifyjs/alertify.js"></script>
</head>
<body>


  <?php $id=$user['id']; if(!empty($user) && ($user['ID_Tipo_Usuario']==3)): ?>

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
<div class="modal fade" id="AgregarUsuarios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-centered" role="document">
   <div class="modal-content">
     <div class="modal-header">
      <h5 class="modal-title text-center">Agregar Usuario</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">      
      </button>
    </div>
    <div class="modal-body">
     <form class="form p-2 mt-2">
      <div class="form-group text-left row">
        <div class="col">
          <label>Nombres y Apellidos</label>
          <input type="text" required="" class="form form-control" id="nombresApellidos">
        </div>
      </div>
      <div class="form-group text-left row">
        <div class="col">
          <label for="text-left">Dirección de domicilio</label>
          <input type="text" required="" id="direccion" class="form form-control">
        </div>
        <div class="col">
          <label for="text-left">Teléfono</label>
          <input type="number" required="" id="telefono" class="form form-control">
        </div>
      </div>
      <div class="form-group text-left row">
        <div class="col">
          <label for="text-left">Correo electrónico</label>
          <input type="email" required="" id="correoElectronico" class="form form-control">
        </div>
        <div class="col">
          <label for="text-left">Contraseña</label>
          <input type="password" required="" id="password" class="form form-control">
        </div>
      </div>
      <div class="form-group text-left row">
        <div class="col">
          <label for="text-left">Tipo de usuario</label>
          <select required="" id="tipoUsuario" class="form-control form">
            <option value="0">Seleccione uno</option>
            <option value="1">Usuario Solicitante</option>
            <option value="2">Soporte Tecnico</option>
            <option value="3">Administrador</option>
          </select>
        </div>
        <div class="col">
          <label for="text-left">Actividad</label>
          <select required="" id="actividad" class="form-control form">
            <option value="0">Seleccione uno</option>
            <option value="1">Activo</option>
            <option value="2">Inactivo</option>
          </select>
        </div>
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

<!-- Modal para edicion de datos-->
<div class="modal fade" id="modalEdicion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center">Actualizar usuarios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
       <form class="form p-2 mt-2">
        <div class="form-group text-left row">
          <div class="col">
            <input type="hidden" id="idpersona" name="">
            <label>Nombres y Apellidos</label>
            <input type="text" id="nombresApellidosu" class="form form-control">
          </div>
        </div>
        <div class="form-group text-left row">
          <div class="col">
            <label for="text-left">Dirección de domicilio</label>
            <input type="text" id="direccionu" class="form form-control">
          </div>
          <div class="col">
            <label for="text-left">Teléfono</label>
            <input type="number" id="telefonou" class="form form-control">
          </div>
        </div>
      <div class="form-group text-left">
          <label for="text-left">Correo electrónico</label>
          <input type="email" required="" id="correoElectronicou" class="form form-control">
              </div>
      <div class="form-group text-left row">
        <div class="col">
          <label for="text-left">Tipo de usuario</label>
          <select required="" id="tipoUsuariou" class="form-control form">
            <option value="0">Seleccione uno</option>
            <option value="1">Usuario Solicitante</option>
            <option value="2">Soporte Tecnico</option>
            <option value="3">Administrador</option>
          </select>
        </div>
        <div class="col">
          <input type="hidden" id="idUsuario" name="">
          <label for="text-left">Actividad</label>
          <select required="" id="actividadu" class="form-control form">
            <option value="0">Seleccione uno</option>
            <option value="1">Activo</option>
            <option value="2">Inactivo</option>
          </select>
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
    $('#tabla').load('vistas/tablaUsuarios.php');
  });
</script>


<script type="text/javascript">
  $(document).ready(function(){
    $('#guardarnuevo').click(function(){
      nombresApellidos=$('#nombresApellidos').val();
      direccion=$('#direccion').val();
      telefono=$('#telefono').val();
      correoElectronico=$('#correoElectronico').val();
      password=$('#password').val();
      tipoUsuario=$('#tipoUsuario').val();
      actividad=$('#actividad').val();
      agregardatos(nombresApellidos,direccion,telefono,correoElectronico,password,tipoUsuario,actividad);
    });


    $('#actualizadatos').click(function(){
      actualizaDatos();
    });

  });
</script>

