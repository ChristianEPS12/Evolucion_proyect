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
  <title>EngieCerti::Control de Asistencia</title>
  <script src="https://maps.googleapis.com/maps/api/js?key=TU_API_KEY&callback=initMap" async defer></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
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
                    <h1>Control </h1>
                </div>
                <div class="section-body">
                    <h2 class="section-title">Listado de Asistencia</h2>
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
                                        <label class="form-control-label">Usuarios: <span class="tx-danger">*</span></label>
                                        <select class="form-control select2" style="width:100%" name="usu_id" id="usu_id" data-placeholder="Seleccione">
                                            <option label="Seleccione"></option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-2 d-flex align-items-end">
                                    <button class="btn btn-outline-info" id="add_button" onclick="nuevo()">
                                        <i class="fa fa-plus mr-1"></i> Registrar Asistencia
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="br-pagebody">
                                        <div class="br-section-wrapper">
                                            <div class="table-wrapper">
                                                <table id="asistencia_data" class="table display responsive nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th class="wd-10p">Usuario</th>
                                                            <th class="wd-15p">Fecha</th>
                                                            <th class="wd-15p">Hora</th>
                                                            <th class="wd-20p">Ubicación</th>
                                                            <th class="wd-20p"></th>
                                                            <th class="wd-10p"></th>
                                                            <th class="wd-10p"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
