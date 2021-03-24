<?php
    //CONTROLADOR PARA CREAR ADMINISTRADOR
    if($petitionAjax){
        require_once "../models/modelAdmin.php";
    }else{
        // si la Peticion ajax es false aceder a la configuración DB
        require_once "./models/modelAdmin.php";
    }

//clase heredada de modelo administrador
    class controllerAdmin extends modelAdmin{
        //controlador para agregar administrador
        public function add_controller_Admin(){
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
                $consult1=mainModel::run_simple_query("SELECT accountDni
                    FROM accounts WHERE accountDni ='$Dni'");

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
                        FROM accounts WHERE accountEmail= '$password'");  
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
                        $consult3=mainModel::run_simple_query("SELECT accountEmail
                            FROM accounts WHERE accountEmail = '$user'");

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
                                "Pasword"=>$password,
                                "Role"=>1,
                                "State"=>1,
                                "FirstName"=>$firstName,
                                "LastName"=>$lastName
                            ];
                            $saveAccount=modelAdmin::add_admin_account($dataAC);
                            // Comprobar si se registro la cuenta

                            if($saveAccount->rowCount()>=1){
                                $alert=[
                                    "alert"=>"limpiar",
                                    "title"=>"Administrador registrado",
                                    "text"=>"El administrador se creo con Éxito",
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

         //controlador para páginar administrador
        public function pages_admin_controller($pages, $register, $role, $code){
            $pages=mainModel::clean_string($pages);
            $register=mainModel::clean_string($register);
            $role=mainModel::clean_string($role);
            $code=mainModel::clean_string($code);

            $table="";

            $page=(isset($page)&& $page>0) ? (int) $page : 1;
            $start=($pages>0)? (($pages*$register)-$register) : 0;
            $conexion= mainModel::connect();

            //Calcula cúantos registros hay en la consutla
            //aqui en la consulta el admin 1 es el principal del sistema y  NO se va a seleccionar
            $datos = $conexion->query("SELECT SQL_CALC_FOUND_ROWS * FROM accounts 
                WHERE idAccount!='1' ORDER BY accountFirstName ASC LIMIT $start, $register");
            $datos=$datos->fetchAll();
            $total=$conexion->query("SELECT found_rows()");
            $total=(int) $total->fetchColumn();

            //calcular el otal de páginas
            $Npages= ceil($total/$register);
            $table.='<div>
            <table>
                <thead> 
                    <td>Id</td>
                    <td>Tipo Documento</td>
                    <td>Número documento</td>
                    <td>Nombres</td>
                    <td>Apellidos</td>
                    <td>Dirección</td>
                    <td>Teléfono</td>
                    <td>Género</td>
                    <td>Correo</td>
                    <td>Rol</td>
                    <td>Estado</td>
                    <td colspan="2">Acciones</td>
                </thead>
                <tbody>
            ';
            
            if($total>=1 && $pages<=$Npages){
                $count=$start+1;
                foreach($datos as $rows){
                    $table.='
                    <tr> 
                        <td>'.$count.'</td> 
                        <td>'.$rows['accountDocumentType'].'</td>
                        <td>'.$rows['accountDni'].'</td>
                        <td>'.$rows['accountFirstName'].'</td>
                        <td>'.$rows['accountLastName'].'</td>
                        <td>'.$rows['accountAddress'].'</td>
                        <td>'.$rows['accountPhone'].'</td>
                        <td>'.$rows['accountGenre'].'</td>
                        <td>'.$rows['accountEmail'].'</td>
                        <td>'.$rows['accountRole'].'</td>
                        <td>'.$rows['accountState'].'</td>
                        <td>'.'<button class="btn btn__update"><a href="#">Editar</a></button>&nbsp;'.
                        '<button class="btn btn__delete"><a href="#">Eliminar</a></button>'.'</td>
                    </tr>
                    ';
                    $count++;
                }
            } else {
                $table.='
                    <tr>
                        <td colspan="15"> No hay registros en el sistema</td>
                    </tr>';
            }
            $table.='</tbody> </table> </div>';

            return $table;
    }
}