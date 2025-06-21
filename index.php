<?php
  //Llamando a la cadena de conexión
  require_once("config/conexion.php");
  if(isset($_POST["enviar"]) and $_POST["enviar"]=="si"){
    require_once("models/Usuario.php");
    $usuario = new Usuario();
    $usuario->login();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login</title>
  <link rel="stylesheet" href="public/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="public/modules/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="public/css/style.css">
  <link rel="stylesheet" href="public/css/components.css">
  <style>
      .login-container {
        height: 100vh;
      }
      .login-form {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        position: relative;
      }
      .login-image {
        background-image: url('public/img/tecnologia.jpeg'); /* Cambia esto con la ruta de tu imagen */
        background-size: cover;
        background-position: center;
        height: 100vh;
      }
      
      /* Diseño mejorado para el selector de idioma */
      .language-selector-container {
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 1;
      }
      
      .language-selector-container select {
        border-radius: 5px;
        border: 1px solid #ccc;
        padding: 5px 10px;
        background-color: #f7f7f7;
        color: #333;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        font-size: 0.9rem;
        transition: all 0.3s ease;
      }
      
      .language-selector-container select:hover {
        background-color: #e9ecef;
        border-color: #007bff;
      }
      
      .language-selector-container label {
        font-size: 0.9rem;
        color: #333;
        margin-right: 10px;
      }
        /* Media query para dispositivos móviles */
        @media (max-width: 768px) {
          .login-image {
            display: none; /* Ocultar la imagen a la derecha */
          }
          .login-container {
            background-image: url('public/img/tecnologia.jpeg'); /* Imagen de fondo en móviles */
            background-size: cover;
            background-position: center;
            height: 100vh;
          }
          .login-form {
            width: 100%; /* Formulario ocupa todo el ancho */
            padding: 20px;
          }
          .form-group label {
          color: white !important; /* Forzar el color blanco */
          }
          .forgot-password-link {
          font-size: 1rem !important;
          color: white !important;
          text-shadow: -1px -1px 0 black, 1px -1px 0 black, -1px 1px 0 black, 1px 1px 0 black; /* Simular borde alrededor del texto */
          text-decoration: none !important; /* Quitar subrayado */
          display: inline-block !important;
        }

        .forgot-password-link:hover {
          color: white !important; /* Mantener el color del texto en hover */
          text-shadow: none !important; /* Remover el borde en hover, si lo deseas */
          transition: 0.3s ease !important;
        }
        .language-selector-container select {
            width: 100px;
        }
        .language-selector-container label {
          font-size: 1rem !important;
          color: white !important;
          text-shadow: -1px -1px 0 black, 1px -1px 0 black, -1px 1px 0 black, 1px 1px 0 black; /* Simular borde alrededor del texto */
        }
        .login-brand {
          margin-top: 50px; /* Ajusta este valor para mover más o menos */
        }
        }
        /* Ajustes específicos para tablets */
      @media (min-width: 769px) and (max-width: 1024px) {
          .login-image {
              background-size: cover;
              background-position: center;
              height: 100vh;
          }
      
      .login-form {
          width: 90%; /* Ajustar el ancho del formulario en tablets */
          padding: 30px; /* Un poco más de padding en tablets */
      }

      .forgot-password-link {
          font-size: 1rem !important;
          text-decoration: none !important;
          display: inline-block !important;
      }

      .forgot-password-link:hover {
          color: white !important;
          text-shadow: none !important;
          transition: 0.3s ease !important;
      }

      .language-selector-container select {
          width: 120px; /* Más ancho en tablets */
      }


      .login-brand {
          margin-top: 80px; /* Mueve el logo aún más abajo en tablets */
      }
    }
  </style>
</head>

<body>

  <div class="container-fluid login-container">
    <div class="row">
      <!-- Columna izquierda: formulario de login sin contenedor -->
      <div class="col-12 col-md-3 login-form">
        
        <!-- Selector de idiomas alineado a la izquierda -->
        <div class="language-selector-container">
          <label for="language-selector"><i class="fas fa-globe"></i> Idioma:</label>
          <select id="language-selector" class="form-control" style="display: inline-block; width: auto;">
            <option value="es">Español</option>
            <option value="en">English</option>
            <option value="fr">Français</option>
            <option value="pt">Português</option>
          </select>
        </div>

        <form action="#" method="post">
            <div class="login-brand text-center mb-4">
                <img src="public/img/logo_principal.png" alt="logo" width="200" class="shadow-light rounded-circle">
            </div>

            <!-- Mensajes de error -->
            <?php if(isset($_GET['m']) && $_GET['m'] == 1): ?>
                <div class="alert alert-danger">
                    <strong>Error:</strong> Correo o contraseña incorrectos.
                </div>
            <?php endif; ?>
            <?php if(isset($_GET['m']) && $_GET['m'] == 2): ?>
                <div class="alert alert-warning">
                    <strong>Error:</strong> Por favor, rellene todos los campos.
                </div>
            <?php endif; ?>

            <div class="form-group">
              <label id="email-label" for="email" style="font-size: 1rem;">Correo</label>
              <input id="usu_correo" type="text" class="form-control input-lg" name="usu_correo" tabindex="1" required autofocus style="height: 50px; font-size: 1.2rem;">
              <div class="invalid-feedback" id="email-feedback">
                Por favor, rellene su correo electrónico
              </div>
            </div>

            <div class="form-group">
              <div class="d-block">
                <label id="password-label" for="password" class="control-label" style="font-size: 1rem;">Contraseña</label>
              </div>
              <input id="usu_pass" type="password" class="form-control input-lg" name="usu_pass" tabindex="2" required style="height: 50px; font-size: 1.2rem;">
              <div class="invalid-feedback" id="password-feedback">
                Por favor, rellene su contraseña
              </div>
            </div>

            <div class="text-center">
              <a href="auth-forgot-password.html" class="forgot-password-link" id="forgot-password-link">
                  ¿Has olvidado tu contraseña?
              </a>
            </div>

            <div class="form-group">
              <input type="hidden" name="enviar" class="form-control" value="si"> 
              <button type="submit" class="btn btn-lg btn-block" style="background: linear-gradient(90deg, #000000, #33C4FF); color: white; font-size: 1rem; margin-top: 20px;" tabindex="4" id="submit-button">
                  Ingresar
              </button>
            </div>
        </form>
      </div>

      <!-- Columna derecha: imagen -->
      <div class="col-12 col-md-9 login-image">
        <!-- La imagen de fondo se maneja con CSS -->
      </div>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="public/modules/jquery.min.js"></script>
  <script src="public/modules/popper.js"></script>
  <script src="public/modules/tooltip.js"></script>
  <script src="public/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="public/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="public/modules/moment.min.js"></script>
  <script src="public/js/stisla.js"></script>

  <script>
    // Traducciones para cada idioma
    const translations = {
      en: {
        email: 'Email',
        password: 'Password',
        emailFeedback: 'Please enter your email address',
        passwordFeedback: 'Please enter your password',
        forgotPassword: 'Forgot your password?',
        submit: 'Login'
      },
      es: {
        email: 'Correo',
        password: 'Contraseña',
        emailFeedback: 'Por favor, rellene su correo electrónico',
        passwordFeedback: 'Por favor, rellene su contraseña',
        forgotPassword: '¿Has olvidado tu contraseña?',
        submit: 'Ingresar'
      },
      fr: {
        email: 'Courriel',
        password: 'Mot de passe',
        emailFeedback: 'Veuillez entrer votre adresse courriel',
        passwordFeedback: 'Veuillez entrer votre mot de passe',
        forgotPassword: 'Mot de passe oublié?',
        submit: 'Connexion'
      },
      pt: {
        email: 'Email',
        password: 'Senha',
        emailFeedback: 'Por favor, insira seu email',
        passwordFeedback: 'Por favor, insira sua senha',
        forgotPassword: 'Esqueceu sua senha?',
        submit: 'Entrar'
      }
    };

    // Función para cambiar el idioma
    document.getElementById('language-selector').addEventListener('change', function() {
      const selecteadLanguage = this.value;
      document.getElementById('email-label').textContent = translations[selectedLanguage].email;
      document.getElementById('password-label').textContent = translations[selectedLanguage].password;
      document.getElementById('email-feedback').textContent = translations[selectedLanguage].emailFeedback;
      document.getElementById('password-feedback').textContent = translations[selectedLanguage].passwordFeedback;
      document.getElementById('forgot-password-link').textContent = translations[selectedLanguage].forgotPassword;
      document.getElementById('submit-button').textContent = translations[selectedLanguage].submit;
    });
  </script>

</body>
</html>
