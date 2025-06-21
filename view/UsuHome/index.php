<?php
  //llamamos al archivo de conexion.php
  require_once("../../config/conexion.php");
  if(isset($_SESSION["usu_id"])){
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php require_once("../html/MainHead.php"); ?>
  <title>EngieCerti::Home</title>
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
            <h1>Panel Principal</h1>
          </div>

          <!-- Tarjeta de total de cursos -->
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>TOTAL DE CURSOS</h4>
                  </div>
                  <div class="card-body" id="lbltotal">
                   
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Sección de listado de cursos -->
          <section class="section">
            <div class="section-body">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                    <h4>Top Ultimos Cursos: Aquí podrá visualizar los últimos 10 certificados</h4>
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
            </div>
          </section>
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
  <script type="text/javascript" src="usuhome.js"></script>
</body>
</html>

<?php
  }else{
    //si no ha iniciado sesion se redireccionara a la ventana principal
    header("Location:".Conectar::ruta()."view/404/");
  }
?>