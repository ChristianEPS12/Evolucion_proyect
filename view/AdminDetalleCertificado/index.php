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
  <title>EngieCerti::Detalle Certificado</title>
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
                    <h1>Cursos</h1>
                </div>
                <div class="section-body">
                    <h2 class="section-title">Detalle Certificado</h2>
                    <p class="section-lead">
                        Listado de Detalle Certificados
                    </p>
                    <div class="row">
                        
                    <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Cursos: <span class="tx-danger">*</span></label>
                                    <select class="form-control select2" style="width:100%" name="cur_id" id="cur_id" data-placeholder="Seleccione">
                                        <option label="Seleccione"></option>

                                    </select>
                                </div>
                            </div>
                                <div class="form-group col-md-2 d-flex align-items-end">
                                    <button class="btn btn-outline-info" id="add_button" onclick="nuevo()">
                                        <i class="fa fa-plus mr-1"></i> Agregar Usuarios
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="br-pagebody">
                                        <div class="br-section-wrapper">
                                            <div class="table-wrapper">
                                                <table id="detalle_data" class="table display responsive nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th class="wd-10p">Curso</th>
                                                            <th class="wd-15p">Usuario</th>
                                                            <th class="wd-15p">Fecha Inicio</th>
                                                            <th class="wd-20p">Fecha Fin</th>
                                                            <th class="wd-20p">Instructor</th>
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
  <script type="text/javascript" src="admindetallecertificado.js"></script>
</body>
</html>
<?php
  }else{
    //si no ha iniciado sesion se redireccionara a la ventana principal
    header("Location:".Conectar::ruta()."view/404/");
  }
?>