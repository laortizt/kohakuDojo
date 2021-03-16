<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="./assets/style/login.css"/>
    <title>Sign in & Sign up Form</title>
  </head>
  <body>
    <div class="container login-container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="" method="post" autocomplete="off" class="sign-in-form">
            <h2 class="title">Iniciar sesión</h2>
            <label for="">Usuario</label>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="emailSignIn"/>
            </div>
            <label for="">Contraseña</label>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="passwordSignIn"/>
            </div>
            <input type="submit" value="Entrar" class="btn-kohaku-login"/>
          </form>

          <?php
            if(isset($_POST['emailSignIn'])&& isset($_POST['passwordSignIn'])&& $_POST['emailSignIn']!=""&&$_POST['passwordSignIn']!="" ){
              require_once"./controller/controllerLogin.php";
              $login = new controllerLogin();
              echo $login->start_controller_session();
            }
          ?>

          <form action="" class="sign-up-form">
            <h2 class="title">Regístrate</h2>
            <label for="">Nombres</label>
            <div class="input-field" name="firstname" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}">
              <i class="fas fa-user"></i>
              <input type="text" />
            </div>
            <label for="">Apellidos</label>
            <div class="input-field" name="lastname" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}">
              <i class="fas fa-user"></i>
              <input type="text" />
            </div>
            <label for="">Correo</label>
            <div class="input-field" name="email">
              <i class="fas fa-envelope"></i>
              <input type="email" />
            </div>
            <label for="">Contraseña</label>
            <div class="input-field"  name="password">
              <i class="fas fa-lock"></i>
              <input type="password" />
            </div>
            <input type="submit" class="btn-kohaku-login" value="Guardar" />
            <p class="social-text"></p>
            <div class="social-media">
              
            </div>
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>¿Nuevo aquí?</h3>
            <p class="title-login">
              Rellena el formulario de registro para acceder.
            </p>
            <button class="btn-kohaku-login" id="sign-up-btn">
              Registrarse
            </button>
            <div class="logo">
              
              <img src="<?php echo SERVERURL; ?>assets/img/logo.png" class="image" alt="" />
            </div>
          </div>
          
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>¿Ya eres miembro?</h3>
            <p>
              Ingresa con tu datos registrados... ¡Qué estás esperando!
            </p>
            <button class="btn-kohaku-login" id="sign-in-btn">
              Iniciar sesión
            </button>
          </div>
          
           <img src="<?php echo SERVERURL; ?>assets/img/logo.png" class="image" alt=""/>
        </div>
      </div>
    </div>
    
    <script src="<?php echo SERVERURL; ?>assets/Script/app.js"></script>
  </body>
  <?php 
    // if(isset($_POST['emailSignIn']) && isset($_POST['passwordSignIn'])){
    //     require_once "./controller/controllerLogin.php";
    //     $login = new ControllerLogin();
    //     echo $login->start_controller_session();
    // }
?>
</html>
