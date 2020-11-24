<nav class="navbar navbar-expand-lg navbar-light bg-dark text-right">
    <div class="container-fluid">

        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-align-justify"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent" style="padding-right: 5%;">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item text-light">
                    <a class="nav-link text-light active" href="index.php">Inicio</a>
                </li>
                <?php if (!empty($user) && ($user['ID_Tipo_Usuario']==1)): ?>
                <li class="nav-item text-light">
                    <a class="nav-link text-light" href="requerimientos.php">Reporta incidentes</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link text-light" href="logout.php">Cerrar sesión</a>
                </li>
                <?php elseif(!empty($user) && ($user['ID_Tipo_Usuario']==2)): ?>

                <li class="nav-item text-light">
                    <a class="nav-link text-light" href="requerimientos.php">Reporta incidentes</a>
                </li>

                
                <li class="nav-item">
                    <a class="nav-link text-light" href="logout.php">Cerrar sesión</a>
                </li>
                <?php elseif(!empty($user) && ($user['ID_Tipo_Usuario']==3)): ?>

                <li class="nav-item text-light">
                    <a class="nav-link text-light" href="usuarios.php">Usuarios</a>
                </li>
                <li class="nav-item text-light">
                    <a class="nav-link text-light" href="categorias.php">Categorías</a>
                </li>

                <li class="nav-item text-light">
                    <a class="nav-link text-light" href="servicios.php">Servicios</a>
                </li>

                
                <li class="nav-item">
                    <a class="nav-link text-light" href="logout.php">Cerrar sesión</a>
                </li>

                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="logout.php">Iniciar sesión</a>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</nav> 