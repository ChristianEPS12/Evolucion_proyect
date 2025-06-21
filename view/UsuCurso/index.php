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
  <title>EngieCerti::Curso</title>
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
                    <h2 class="section-title">Listado de mis cursos</h2>
                    <p class="section-lead">
                        Desde aquí podrá encontrar sus cursos por certificado
                    </p>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="br-pagebody">
                                        <div class="br-section-wrapper">
                                            <div class="table-wrapper">
                                                <table id="cursos_data" class="table display responsive nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th class="wd-15p">Curso</th>
                                                            <th class="wd-15p">Fecha Inicio</th>
                                                            <th class="wd-20p">Fecha Fin</th>
                                                            <th class="wd-15p">Instructor</th>
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


  <?php require_once("../html/MainJs.php"); ?>
  <script type="text/javascript" src="usucurso.js"></script>
</body>
</html>
<?php
  }else{
    //si no ha iniciado sesion se redireccionara a la ventana principal
    header("Location:".Conectar::ruta()."view/404/");
  }
?>