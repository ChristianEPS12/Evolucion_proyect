<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
    <div class="login-brand">
        <img src="../../public/img/logo_principal.png" alt="logo" width="100" class="shadow-light rounded-circle">
    </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Menu Principal</li>
            <li><a class="nav-link" href="../UsuHome/"><i class="fas fa-home"></i>
            <span>Inicio</span></a></li> 
        <?php
            if($_SESSION["rol_id"]==1){
                ?>
                    <li><a class="nav-link" href="../UsuCurso/"><i class="fas fa-book"></i> 
                    <span>Mis Cursos</span></a></li>
                    <li><a class="nav-link" href="../AdminAsistencia/index2.php"><i class="fas fa-calendar-check"></i> 
                    <span>Mi Asistencia</span></a></li>
                <?php
            }else{
                ?>
                    <li><a class="nav-link" href="../AdminMntUsuario/"><i class="fas fa-book"></i> 
                    <span>Mnt. Usuario</span></a></li>
                    <li><a class="nav-link" href="../AdminMntCurso/"><i class="fas fa-book"></i> 
                    <span>Mnt. Curso</span></a></li>
                    <li><a class="nav-link" href="../AdminMntInstructor/"><i class="fas fa-book"></i> 
                    <span>Mnt. Instructor</span></a></li>
                    <li><a class="nav-link" href="../AdminMntCategoria/"><i class="fas fa-book"></i> 
                    <span>Mnt. Categoria</span></a></li>
                    <li><a class="nav-link" href="../AdminDetalleCertificado/"><i class="fas fa-book"></i> 
                    <span>Detalle Certificado</span></a></li>
                    <li><a class="nav-link" href="../AdminAsistencia/index.php"><i class="fas fa-calendar-check"></i> 
                    <span>Control de Asistencia</span></a></li>
                <?php
            }
        ?>
            <li><a class="nav-link" a href="../UsuPerfil/" ><i class="far fa-user"></i> 
            <span>Perfil</span></a></li>
            <li><a class="nav-link" href="#" onclick="confirmarCierreSesion()"><i class="fas fa-power-off"></i> 
            <span>Cerrar Sesión</span></a></li>

            <script type="text/javascript">
                function confirmarCierreSesion() {
                    // Usar SweetAlert2 para la confirmación
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "Si cierras sesión, perderás el acceso temporalmente.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, cerrar sesión',
                        cancelButtonText: 'Cancelar',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Mostrar mensaje de confirmación de salida
                            Swal.fire({
                                title: 'Cerrando sesión...',
                                text: 'Saliendo del sistema, hasta pronto!',
                                icon: 'info',
                                timer: 1500, // Se cerrará automáticamente después de 1.5 segundos
                                showConfirmButton: false // No muestra el botón de confirmar
                            }).then(() => {
                                // Redirigir al logout.php después de mostrar el mensaje de salida
                                window.location.href = "../html/Logout.php";
                            });
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            // Si el usuario cancela, mostrar mensaje de cancelación
                            Swal.fire(
                                'Cancelado',
                                'Tu sesión está segura.',
                                'error'
                            );
                        }
                    });
                }
            </script>
        </ul>
    </aside>
</div>