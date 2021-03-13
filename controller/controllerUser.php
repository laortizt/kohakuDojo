<?php
    //CONTROLADOR PARA CREAR ADMINISTRADOR
    if($petitionAjax){
        require_once "../models/modelUser.php";
    }else{
        // si la Peticion ajax es false aceder a la configuración DB
        require_once "./models/modelUser.php";
    }

//clase heredada de modelo administrador
    class controllerUser extends modelUser{

        public function add_controller_User(){
            $typeDocument= mainModel::clean_string($_POST['dni']);
            $Dni= mainModel::clean_string($_POST['dni']);
            $firstName= mainModel::clean_string($_POST['FirstName']); 
            $lastName= mainModel::clean_string($_POST['LastName']);
            $addres= mainModel::clean_string($_POST['Adress']); 
            $phone= mainModel::clean_string($_POST['Phone']);
            $user= mainModel::clean_string($_POST['User']);
            $email= mainModel::clean_string($_POST['Email']);
            $password= mainModel::clean_string($_POST['Pass1']);
            $genre= mainModel::clean_string($_POST['Genere']);
            $privilegio= mainModel::clean_string($_POST['Privileges']);

            //validación contraseñas
            if($password!=$password){
                $alert=[
                    "alert"=>"simple",
                    "title"=>"Ocurrio un error inesperado",
                    "text"=>"Las contraseñas no coinciden",
                    "type"=>"error"
                ];
            }else{
                //validación documento registrado
                $consult1=mainModel::run_simple_query("SELECT usersDni
                 FROM users WHERE usersDni ='$Dni'");

                if($consult1->rowCount()>=1){
                    $alert=[
                        "alert"=>"simple",
                        "title"=>"Ocurrio un error inesperado",
                        "text"=>"El número de Identificación ya está registrado",
                        "type"=>"error"
                    ];
                }else{
                    //validación correo
                    if($password!=""){
                        $consult2=mainModel::run_simple_query("SELECT accountEmail
                        FROM account WHERE accountEmail= '$password'");  
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
                            "text"=>"El correo ingresado está registrado",
                            "type"=>"error"
                        ];
                    }else{
                        //validación de usuario
                        $consult3=mainModel::run_simple_query("SELECT Usuario
                        FROM cuenta WHERE Usuario = '$user'");

                        if($consult3->rowCount()>=1){
                            // $alert=[
                            //     "alert"=>"simple",
                            //     "title"=>"Ocurrio un error inesperado",
                            //     "text"=>"El usuario ingresado está registrado",
                            //     "type"=>"error"
                            // ];
                        }else{
                            //validación cuantos registros tengo
                            $consult4=mainModel::run_simple_query("SELECT idAccount
                            FROM account");
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
                                "Pasword"=>$password,
                                "Role"=>"Administrador",
                                "State"=>"Activo",
                            ];
                            $saveAccount=mainModel::add_account($dataAC);
                            // Comprobar si se registro la cuenta

                            if($saveAccount->rowCount()>=1){
                                $dataAD=[
                                    "Dni"=>$Dni,
                                    "FirstName"=>$firstName,
                                    "LastName"=>$lastName,
                                    "Addres"=>$addres, 
                                    "Phone"=>$phone,
                                    "Code"=>$code,
                                ];
                                $saveAdmin=modelUser::add_modelUser($dataAD);
                                if($saveAdmin->rowCount()>=1){
                                    $alert=[
                                        "alert"=>"limpiar",
                                        "title"=>"Administrador registrado",
                                        "text"=>"El administrador se creo con Éxito",
                                        "type"=>"success"
                                    ];
                                }else{
                                    mainModel::delete_account($code);
                                    $alert=[
                                        "alert"=>"simple",
                                        "title"=>"Ocurrio un error inesperado",
                                        "text"=>"No se pudo registrar el administrador",
                                        "type"=>"error"
                                    ];
                                }

                                }else{
                                $alert=[
                                    "alert"=>"simple",
                                    "title"=>"Ocurrio un error inesperado",
                                    "text"=>"La cuenta no se pudo registrar",
                                    "type"=>"error"
                                ];
                            }
                        }
                    }
                }
            }
            
            return mainModel::sweet_alert($alert);
        }
    
        public function add_admin_incomplete_data() {
            $alert=[
                "alert"=>"simple",
                "title"=>"Información incompleta",
                "text"=>"Diligencie todos los campos",
                "type"=>"error"
            ];

            return mainModel::sweet_alert($alert);
        }

    
    }