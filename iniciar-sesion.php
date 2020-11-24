<?php
session_start();

require 'controlador/database.php';

if (isset($_SESSION['user_id'])) {
  $records = $conn->prepare('SELECT id, nombresApellidos, direccion, telefono, correoElectronico, password, ID_Tipo_Usuario FROM Usuarios WHERE id = :id');
  $records->bindParam(':id', $_SESSION['user_id']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  $user = null;

  if (count($results) > 0) {
    $user = $results;
  }
}


if (isset($_SESSION['user_id'])) {
  header('Location: mi-cuenta.php');
}

if (!empty($_POST['txtCorreo']) && !empty($_POST['password'])) {
  $records = $conn->prepare('SELECT id, nombresApellidos, direccion, telefono, correoElectronico, password, ID_Tipo_Usuario FROM Usuarios WHERE correoElectronico = :txtCorreo');
  $records->bindParam(':txtCorreo', $_POST['txtCorreo']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  $message = '';

  if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
    $_SESSION['user_id'] = $results['id'];
    header("Location: mi-cuenta.php");
  } else {
    echo "<script>alert('Lo sentimos, su correo o contraseña son erroneos, por favor verifique nuevamente su información y accede al aplicativo.');window.location='iniciar-sesion.php';</script>";    
  }
}


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>INICIAR SESIÓN | PROYECTO 3 CORTE</title>



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
  <script src="js/funcionesUsu.js"></script>
  <script src="librerias/bootstrap/js/bootstrap.js"></script>
  <script src="librerias/alertifyjs/alertify.js"></script>
</head>
<body>

  <div class="wrapper">
    <!-- Menú de gestión  -->
    <?php include 'controlador/menu-gestion.php'; ?>

    <!-- Page Content  -->
    <div id="content">
     <!-- navbar  -->
     <?php include 'controlador/navbar.php'; ?>


     <div class="container">
      <h2 class="text-center">Iniciar sesión</h2>
      <div class="row">
        <div class="col-md-6" style="margin: 0px auto;">
          <div class="full-width container-login">
            <br>
            <form class="simple_form new_user" id="new_user" action="iniciar-sesion.php" accept-charset="UTF-8" method="post">
              <div class="form-group">
                <div class="form-group email optional user_email">
                  <center>
                    <label class="control-label email"><i class="fa fa-envelope" aria-hidden="true"></i> Correo electrónico</label>
                  </center>
                  <input class="form-control form input-lg" placeholder="Correo electrónico" required=""  type="email" name="txtCorreo" id="user_email" />
                </div>
              </div>
              <div class="form-group">
               <div class="form-group password optional user_password">
                 <center> <label class="control-label password optional" for="user_password"><i class="fa fa-key" aria-hidden="true"></i> Contraseña</label></center>
                 <input class="form-control form input-lg" placeholder="Contraseña" required="" type="password" name="password" />
               </div>
             </div>
             <center> 
              <button class="btn btn-success" type="submit" style="border-radius: 5px;"> Iniciar sesión  </button>
            </center>
          </form>          
        </div>
      </div>
    </div>
  </div>
</div>
</div>


<div class="overlay"></div>

<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<!-- jQuery Custom Scroller CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="javascript" src="stacktable.js"></script>
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

  $(document).ready(function() {
    $('#tabla1').stacktable();
  });
</script>
</body>

</html>