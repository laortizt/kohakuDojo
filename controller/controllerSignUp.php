<?php
    //CONTROLADOR PARA CREAR ADMINISTRADOR
    if($petitionAjax){
        require_once "../models/modelSignUp.php";
    }else{
        // si la Peticion ajax es false aceder a la configuración DB
        require_once "./models/modelSignUp.php";
    }

//clase heredada de modelo administrador
    class controllerSignUp extends modelSignUp {

        //controlador para agregar registro  de usuarios
        public function add_controller_user(){
            $firstName= mainModel::clean_string($_POST['firstname']); 
            $lastName= mainModel::clean_string($_POST['lastname']);
            $email= mainModel::clean_string($_POST['emailSignUp']);
            $password= mainModel::clean_string($_POST['passwordSignUp']);
            
            $firstName= ucwords($firstName);
            $lastName= ucwords($lastName);
            $email= strtolower($email);
            
            //validación contraseñas
            if($password!=$password){
                $alert=[
                    "alert"=>"simple",
                    "title"=>"Ocurrio un error inesperado",
                    "text"=>"Las contraseñas no coinciden",
                    "type"=>"error"
                ];
            }else{
                //validación correo
                if($email!=""){
                    $consult2=mainModel::run_simple_query("SELECT accountEmail
                    FROM accounts WHERE accountEmail= '$email'");  
                    //variable correo-cuenta- columnas afectadas
                    $cc=$consult2->rowCount();
                }else{
                    //si no existe es 0
                    $cc=0;
                }

                if($cc>=1){
                    $alert=[
                        "alert"=>"simple",
                        "title"=>"Ocurrio un error inesperado",
                        "text"=>"El correo ya está registrado",
                        "type"=>"error"
                    ];
                }else{
                    //validación cuantos registros tengo
                    $consult4=mainModel::run_simple_query("SELECT idAccount
                    FROM accounts");
                        //variable para guardar la consulta
                    $num=($consult4->rowCount())+1;
                        // generar código aletaorio de 10 cifras AC: Account
                    $code=mainModel::generate_random_code("AC", 10, $num);

                    // encriptar la contraseña
                    $password=mainModel::encryption($password);

                    // Crar un array para ingresar una cuenta
                    $dataAC=[
                        "Code"=>$code,
                        "Email"=>$email,
                        "Password"=>$password,
                        "FirstName"=>$firstName,
                        "LastName"=>$lastName,
                    ];
                    $saveAccount=modelSignUp::add_account($dataAC);
                    // Comprobar si se registro la cuenta

                    if($saveAccount->rowCount()>=1){
                        $alert=[
                            "alert"=>"limpiar",
                            "title"=>"Usuario registrado",
                            "text"=>"El usuario se creo con Éxito, por favor inicie sesión",
                            "type"=>"success"
                        ];
                    } else {
                        $alert=[
                            "alert"=>"simple",
                            "title"=>"Ocurrio un error inesperado",
                            "text"=>"La cuenta no se pudo registrar",
                            "type"=>"error"
                        ];
                    }
                }
            }
            
            return mainModel::sweet_alert($alert);
        }
    
        public function add_user_incomplete_data() {
            $alert=[
                "alert"=>"simple",
                "title"=>"Información incompleta",
                "text"=>"Diligencie todos los campos",
                "type"=>"error"
            ];

            return mainModel::sweet_alert($alert);
        }
    
         
    }
