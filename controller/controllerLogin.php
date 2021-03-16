<?php

    if($petitionAjax){
        require_once "../models/modelLogin.php";
    }else{
        // si la eticion ajax es fale aceder a la configuración DB
        require_once "./models/modelLogin.php";
    }
    class controllerLogin extends modelLogin{
        // Funcion para iniciar sesion

        public function start_controller_session(){
            //se limpian los espacios que se piden en login por si traian partes de cadena anterior 
            //y luego se usa la nueva cadena en las variables

            $email=mainModel::clean_string($_POST['emailSignIn']);
            $password=mainModel::clean_string($_POST['passwordSignIn']);

            //se encripta la contraseña
            $password=mainModel::encryption($password);

            //se pasan los datos del login a una variable para usarlos en el modelo
            $logindata=[
                "email"=>$email,
                "password"=>$password,
            ];
            
            //se pasan los datos del login al modelo
            $accountdata= modelLogin::start_model_session($logindata);
            
            if($accountdata->rowCount()==1){
                $userrow=$accountdata->fetch();
               
                @session_start(['name'=>'SK']);

                $_SESSION['email_sk']=$userrow['accountEmail'];
                $_SESSION['role_sk']=$userrow['accountRole'];
                $_SESSION['token_sk']=md5(uniqid(mt_rand(),true));
                $_SESSION['code_sk']=$userrow['accountCode'];
                
                //Se agrega este código para acceder a las vistasdependiendo el tipo de usuario
                if($userrow['accountRole']==="Administrador"){
                    $url=SERVERURL."admin";
                }else{
                    $url=SERVERURL."admin";
                }
                
                return $urlLocation=' <script> window.location= " '.$url.'" </script>';
               
            } else{
                $alert=[
                    "alert"=>"simple",
                    "title"=>"Ocurrió un error inesperado",
                    "text"=>"El nombre de usuario y contraseña no son correctos o su cuenta puede estar deshabilitada",
                    "type"=>"error"
                ];
                return mainModel::sweet_alert($alert);
            }
        }
        
    }
?>