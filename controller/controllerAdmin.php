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
            //+++estos datos era del primer formulario y se modifico,s se estan usando estos datos???
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
            $privileges= mainModel::clean_string($_POST['Privileges']);
            //cambiar el contenido de la última fila
            ;
             
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
            $datos = $conexion->query("SELECT SQL_CALC_FOUND_ROWS * FROM accounts a
                LEFT JOIN genre g ON (a.accountGenre = g.idGenre)
                WHERE a.idAccount!='1' ORDER BY a.accountFirstName ASC LIMIT $start, $register");
            $datos=$datos->fetchAll();
            $total=$conexion->query("SELECT found_rows()");
            $total=(int) $total->fetchColumn();

            //calcular el otal de páginas
            $Npages= ceil($total/$register);
            $table.='<div>
            <table>
                <thead> 
                    <td>Id</td>
                    <td>Documento</td>
                    <td>Número</td>
                    <td>Nombres</td>
                    <td>Apellidos</td>
                    <td>Dirección</td>
                    <td>Teléfono</td>
                    <td>Género</td>
                    <td>Correo</td>
                    <td>Rol</td>
                    <td>Estado</td>
                    <td colspan="1">Acciones</td>
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
                        <td>'.(isset($rows['nameGenre']) ? $rows['nameGenre'] : "Pendiente").'</td>
                        <td>'.$rows['accountEmail'].'</td>
                        <td>'.$rows['accountRole'].'</td>
                        <td>'.($rows['accountState'] == 1 ? "Activo" : "Inactivo").'</td>
                        <td>'.'<button class="btn btn__update"><a href=""><i class="far fa-check-circle"></i></a></button>&nbsp;'.
                        '<button class="btn btn__delete"><a href="#"><i class="far fa-times-circle"></i></a></button>'.'</td>
                    </tr>
                    ';
                    $count++;
                }
            }else{
                $table.='
                    <tr>
                        <td colspan="15"> No hay registros en el sistema</td>
                    </tr>';
            }
            $table.='</tbody> </table> </div>';

            return $table;
    }


    public function update_admin_controller() {
        // Limpiar info del formulario
        $typeDocument= mainModel::clean_string($_POST['typeDocument-profile']);
        $Dni= mainModel::clean_string($_POST['dni-profile']);
        $firstName= mainModel::clean_string($_POST['firstname-profile']); 
        $lastName= mainModel::clean_string($_POST['lastname-profile']);
        $address= mainModel::clean_string($_POST['adress-profile']); 
        $email= mainModel::clean_string($_POST['email-profile']);
        $phone= mainModel::clean_string($_POST['phone-profile']);
        $genre= mainModel::clean_string($_POST['genre-profile']);

        // Validar la info que llega
        $profilesByDni=modelAdmin::find_dni($Dni);

        if (count($profilesByDni) > 1 || 
            (count($profilesByDni) == 1 && $profilesByDni[0]['accountDni'] != $Dni) )
        {
            $alert=[
                "alert"=>"simple",
                "title"=>"Ocurrio un error inesperado",
                "text"=>"El número de Identificación ya está registrado",
                "type"=>"error"
            ];
        } else {
            // Buscar por correo
            $profilesByEmail=modelAdmin::find_email($email);
        
            // Si existe uno, verificar si su account code coincide con el usuario actual
            if(count($profilesByEmail) != 1){
                // Si no coincide, error
                $alert=[
                    "alert"=>"simple",
                    "title"=>"Ocurrio un error inesperado",
                    "text"=>"Usuario no encontrado",
                    "type"=>"error"
                ];
            } else if ($_SESSION['role_sk'] != "Administrador") {
                // El usuario logueado no es Admin, no puede editar otros usuarios
                $alert=[
                    "alert"=>"simple",
                    "title"=>"Acción no permitida",
                    "text"=>"No tiene privilegios suficientes para editar usuarios",
                    "type"=>"error"
                ];
            } else {
                // Si coincide, proceder con la actualización
                $id = $profilesByEmail[0]['idAccount'];

                // Construir el objeto que se envía al modelo
                // Si todas se cumplen, llamar al modelo para que ejecute el cambio, enviando la info en un arreglo
                $data = [
                    "Id"=>$id,
                    "DocumentType"=>$typeDocument,
                    "Dni"=>$Dni,
                    "FirstName"=>$firstName,
                    "LastName"=>$lastName,
                    "Address"=>$address,
                    "Phone"=>$phone,
                    "Genre"=>$genre
                ];

                // LLamar al modelo
                $saveAdmin = modelAdmin::update_admin_model($data);

                // Verificar respuesta del modelo y construir la respuesta para la vista
                if($saveAdmin->rowCount() >= 1){
                    $alert=[
                        "alert"=>"limpiar",
                        "title"=>"Actualizar perfil",
                        "text"=>"El perfil se ha actualizado exitósamente.",
                        "type"=>"success"
                    ];
                }else {
                    $alert=[
                        "alert"=>"simple",
                        "title"=>"Actualizar perfil",
                        "text"=>"No se pudo actualizar el perfil, verifique los campos e intente de nuevo.",
                        "type"=>"error"
                    ];
                }
            }
        }

        return mainModel::sweet_alert($alert);
    }

}