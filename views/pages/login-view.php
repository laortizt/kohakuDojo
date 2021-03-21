<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Balsamiq+Sans&family=Fjalla+One&family=Fredoka+One&family=Ranchers&family=Roboto:wght@500&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="./assets/style/login.css"/>
    <title>Kohaku - Login</title>
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
              <input type="text" name="emailSignIn" required=""/>
            </div>

            <label for="">Contraseña</label>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="passwordSignIn" required=""/>
            </div>

            <input type="submit" value="Entrar" class="btn-kohaku-login"/>
          </form>

          <!-- se crea la ruta que conecta con el ajax,  -->
          <form action="" method="post" autocomplete="off" class="sign-up-form">
            <h1 class="title">Crear cuenta</h1>
            
            <label class="label">Nombres</label>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="firstname" required="" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}"/>
            </div>

            <label class="label">Apellidos</label>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="lastname" required="" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}"/>
            </div>

            <label class="label">Correo</label>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" required="" name="emailSignUp"/>
            </div>

            <label class="label">Contraseña</label>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" required="" name="passwordSignUp"/>
            </div>

            <input type="submit" class="btn-kohaku-login" value="Guardar" />
            <p class="social-text"></p>

            <div class="social-media"></div>
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <img src="<?php echo SERVERURL; ?>assets/img/logo.png" class="image" alt="" />

            <h3>¿Nuevo por aquí?</h3>

            <button class="btn-kohaku-login" id="sign-up-btn">
              Regístrate
            </button>          
          </div>
        </div>

        <div class="panel right-panel">
          <div class="content">
            <img src="<?php echo SERVERURL; ?>assets/img/logo.png" class="image" alt=""/>
            
            <div class="texto-login">
              <h3>¿Ya eres miembro?</h3>
            </div>
            
            <button class="btn-kohaku-login" id="sign-in-btn">
              Iniciar sesión
            </button>
          </div>
        </div>
      </div>
    </div>
    
    <script src="<?php echo SERVERURL; ?>assets/Script/app.js"></script>
  </body>

  <?php
    if(isset($_POST['emailSignIn'])&& isset($_POST['passwordSignIn']) && $_POST['emailSignIn']!=""&&$_POST['passwordSignIn']!="" ){
      require_once "./controller/controllerLogin.php";
      $login = new controllerLogin();
      echo $login->start_session_controller();
    }
    elseif (isset($_POST['emailSignUp'])) {
      require_once "./controller/controllerSignUp.php";
      $insUser= new controllerSignUp();
  
      if(isset($_POST['emailSignUp'])&& 
          isset($_POST['firstname'])&&
          isset($_POST['lastname'])&&
          isset($_POST['passwordSignUp'])){
              echo $insUser->add_controller_User();
      } else {
        
        // echo $insUser->add_User_incomplete_data();  ERROR EN ESTÁ LINEA OOOOOJOOOOOOOO
      }
    }
  ?>
</html>
