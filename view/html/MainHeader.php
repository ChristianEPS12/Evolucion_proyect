<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
    <li class="dropdown">
        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="../../public/img/avatar/avatar-1.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">
                <?php echo $_SESSION["usu_nom"]; ?>
            </div>
        </a>
        
        <input type="hidden" id="usu_idx" value="<?php echo $_SESSION["usu_id"]; ?>">
        <!-- <input type="hidden" id="rol_idx" value="<?php echo $_SESSION["rol_id"]; ?>"> -->
        
        <div class="dropdown-menu dropdown-menu-right">
            <a href="../UsuPerfil/" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Perfil
            </a>
            <div class="dropdown-divider"></div>
            <a href="../html/Logout.php" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
            </a>
        </div>
    </li>
</ul>
</nav>