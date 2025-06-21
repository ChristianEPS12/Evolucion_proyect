<?php
  //llamamos al archivo de conexion.php
  require_once("../../config/conexion.php");
  if(isset($_SESSION["usu_id"])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php require_once("../html/MainHead.php"); ?>
  <link rel="stylesheet" href="../../public/css/search.css">
  <script src="https://maps.googleapis.com/maps/api/js?key=TU_API_KEY&callback=initMap" async defer></script>
  <title>EngieCerti::Control de Asistencia</title>
  <style>
    .img-fluid {
        max-width: 100%;  /* Asegura que la imagen no se exceda del contenedor */
        height: auto;     /* Mantiene la proporción de la imagen */
        max-height: 600px;  /* Establece la altura máxima de la imagen */
    }
  </style>
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>

        <?php require_once("../html/MainHeader.php"); ?>
        <?php require_once("../html/MainMenu.php"); ?>

        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Control de Asistencia</h1>
                </div>
                <div class="section-body">
                    <h2 class="section-title">Tomar mi Asistencia</h2>
                    <p class="section-lead">
                        Control de Asistencia de Usuarios
                    </p>
                    <div class="row">
                        
                    <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Dale Click al botton derecho para registrarte: <span class="tx-danger">*</span></label>
                                        <!-- Campo oculto para el ID del usuario -->
                                        <input type="hidden" name="usu_id" id="usu_id" value="<?php echo $_SESSION['usu_id']; ?>" />
                                    </div>
                                </div>
                                <!-- Ajustar el margen de separación aquí -->
                                <div class="form-group col-md-2 d-flex align-items-end">
                                    <button class="btn btn-outline-info" id="add_button" onclick="nuevo()" style="margin-left: 10px;"> <!-- Ajustar el margen -->
                                        <i class="fa fa-plus mr-1"></i> Registrar Asistencia
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center mt-4">
                    <img src="../../public/asistencia.jpg" alt="Imagen de Asistencia" class="img-fluid">
                </div>
            </section>
        </div>

        <footer class="main-footer">
            <div class="footer-left">
                Capstone Project - Universidad Privada del Norte <div class="bullet"></div><a href="#"></a>
            </div>
            <div class="footer-right">
            </div>
        </footer>
      </div>
  </div>
  

  <?php require_once("modalmantenimiento.php"); ?>

  <?php require_once("../html/MainJs.php"); ?>
  <script type="text/javascript" src="adminasistencia.js"></script>
  <script type="text/javascript" src="capturarFoto.js"></script>
</body>
</html>
<?php
  }else{
    //si no ha iniciado sesion se redireccionara a la ventana principal
    header("Location:".Conectar::ruta()."view/404/");
  }
?>
