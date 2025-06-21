<?php
  //llamamos al archivo de conexion.php
  require_once("../../config/conexion.php");
  if(isset($_SESSION["usu_id"])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php require_once("../html/MainHead.php"); ?>
  <title>EngieCerti::Perfil</title>
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
            <h1>Mi Perfil</h1>
          </div>

          <div class="section-body">
            <h2 class="section-title">Pantalla Perfil</h2>
            <p class="section-lead">
              En este apartado puede visualizar o editar sus datos
            </p>

            <div class="row">
              <!-- Columna del formulario -->
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                  <form>
                    <div class="card-body">
                      <div class="form-group">
                        <label>Nombres:</label>
                        <input type="text" class="form-control" name="usu_nom" id="usu_nom" placeholder="Ingrese Nombre" required="">
                      </div>
                      <div class="form-group">
                        <label>Apellido Paterno:</label>
                        <input type="text" class="form-control" name="usu_apep" id="usu_apep" placeholder="Apellido Paterno" required="">
                      </div>
                      <div class="form-group">
                        <label>Apellido Materno:</label>
                        <input type="text" class="form-control" name="usu_apem" id="usu_apem" placeholder="Apellido Materno" required="">
                      </div>
                      <div class="form-group">
                        <label>Correo Electrónico:</label>
                        <input type="text" class="form-control" name="usu_correo" id="usu_correo" required="" readonly>
                      </div>
                      <div class="form-group">
                        <label>Contraseña:</label>
                        <input type="text" class="form-control" name="usu_pass" id="usu_pass" placeholder="Ingrese Contraseña" required="">
                      </div>
                      <div class="form-group">
                        <label>Sexo:</label>
                        <select class="form-control" name="usu_sex" id="usu_sex" data-placeholder="Seleccione" required="">
                          <option label="Seleccione"></option>
                          <option value="F">Femenino</option>
                          <option value="M">Masculino</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Teléfono:</label>
                        <input type="text" class="form-control" name="usu_telf" id="usu_telf" placeholder="Ingrese Teléfono" required="">
                      </div>
                    </div>
                    <div class="card-footer text-right">
                      <button class="btn btn-info" id="btnactualizar">Actualizar</button>
                    </div>
                  </form>
                </div>
              </div>

              <!-- Columna para la imagen -->
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                  <div class="card-body text-center">
                    <img src="../../public/hola.png" alt="Imagen de perfil" class="img-fluid rounded" />
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
  <script type="text/javascript" src="usuperfil.js"></script>
</body>
</html>
<?php
  }else{
    //si no ha iniciado sesion se redireccionara a la ventana principal
    header("Location:".Conectar::ruta()."view/404/");
  }
?>