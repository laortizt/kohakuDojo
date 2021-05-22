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
    
        public function get_user_admin_controller(){
            $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $parts = parse_url($url);
            parse_str($parts['query'], $query);
            $code = $query['c'];
            
            // Desencriptar y Limpiar el código
            $code=mainModel::decryption($code);
            $code=mainModel::clean_string($code);

            $profile = modelAdmin::get_profile_model($code);
            return $profile;
        }

        public function list_role_controller($userCurrentRole) {
            $roles = modelAdmin::list_role_model();

            $select = '<select class="input-field-profile" name="role-profile" required="">';
            
            foreach($roles as $rol){
                if ($rol['idRole'] == $userCurrentRole) {
                    $select.='
                        <option value="'.$rol['idRole'].'" selected="">'
                        .$rol['roleName'].
                        '</option>
                    ';
                } else {
                    $select.='
                        <option value="'.$rol['idRole'].'">'
                        .$rol['roleName'].
                        '</option>
                    ';
                }
            }

            $select.='</select>';

            return $select;
        }
        public function count_students() {
            //Obtiene la cantidad de roles estudiantes
            $datos = mainModel::connect()->query("SELECT count(*) as nEstudiantes
                FROM accounts WHERE accountRole =3");

            $row = $datos->fetch();

            return $row['nEstudiantes'];
        }

        public function count_admin() {
            //Obtiene la cantidad de roles administrador
            $datos = mainModel::connect()->query("SELECT count(*) as nAdmin
                FROM accounts WHERE accountRole =1");

            $row = $datos->fetch();

            return $row['nAdmin'];
        }

        public function count_allRegisters() {
            //Obtiene la cantidad total usuarios registrados
            $datos = mainModel::connect()->query("SELECT count(*) as nAll
                FROM accounts WHERE accountRole ");

            $row = $datos->fetch();

            return $row['nAll'];
        }

        public function count_instructors() {
            //Obtiene la cantidad de roles administrador
            $datos = mainModel::connect()->query("SELECT count(*) as nInstructors
                FROM accounts WHERE accountRole =2");

            $row = $datos->fetch();

            return $row['nInstructors'];
        }

        

        public function list_state_controller($userCurrentState) {
            $states = modelAdmin::list_state_model();

            $select = '<select class="input-field-profile" name="state-profile" required="">';
            
            foreach($states as $state){
                if ($state['idState'] == $userCurrentState) {
                    $select.='
                        <option value="'.$state['idState'].'" selected="">'
                        .$state['stateName'].
                        '</option>
                    ';
                } else {
                    $select.='
                        <option value="'.$state['idState'].'">'
                        .$state['stateName'].
                        '</option>
                    ';
                }
            }

            $select.='</select>';

            return $select;
        }

        public function list_typeDocument_controller($userCurrentDocType){
            $documentTypes = modelAdmin::list_typeDocuments_model();

            $select = '<select class="input-field-profile" name="typeDocument-profile" required="">';
            
            foreach($documentTypes as $documentType){
                if ($documentType['idDocumentType'] == $userCurrentDocType) {
                    $select.='
                        <option value="'.$documentType['idDocumentType'].'" selected="">'
                        .$documentType['nameDocumentType'].
                        '</option>
                    ';
                } else {
                    $select.='
                        <option value="'.$documentType['idDocumentType'].'">'
                        .$documentType['nameDocumentType'].
                        '</option>
                    ';
                }
            }

            $select.='</select>';

            return $select;
        }

        //funciòn que llama la lista de generos de model
        public function list_genres_controller($userCurrentGenre) {
            $genres = modelAdmin::list_genres_model();

            $select = '<select class="input-field-profile" name="genre-profile" required="">';
            
            foreach($genres as $genre){
                if ($genre['idGenre'] == $userCurrentGenre) {
                    $select.='
                        <option value="'.$genre['idGenre'].'" selected="">'
                        .$genre['nameGenre'].
                        '</option>
                    ';
                } else {
                    $select.='
                        <option value="'.$genre['idGenre'].'">'
                        .$genre['nameGenre'].
                        '</option>
                    ';
                }
            }

            $select.='</select>';

            return $select;
        }

         //controlador para páginar administrador
        public function pages_admin_controller($pages, $register, $role, $code){
            $pages=mainModel::clean_string($pages);
            $register=mainModel::clean_string($register);
            $role=mainModel::clean_string($role);
            $code=mainModel::clean_string($code);

            $table="";

            $page=(isset($page)&& $page>0) ? (int) $page :1;
            $start=($pages>0)? (($pages*$register)-$register) : 0;
            $conexion= mainModel::connect();

            //Calcula cúantos registros hay en la consutla
            //aqui en la consulta el admin 1 es el principal del sistema y  NO se va a seleccionar
            $datos = $conexion->query("SELECT SQL_CALC_FOUND_ROWS * FROM accounts a
                LEFT JOIN genre g ON (a.accountGenre = g.idGenre)
                LEFT JOIN documenttype dt ON (a.accountDocumentType = dt.idDocumentType)
                LEFT JOIN `role` r ON (a.accountRole = r.idRole)
                WHERE a.idAccount!='1' ORDER BY a.accountFirstName ASC LIMIT $start, $register");
            $datos=$datos->fetchAll();
            $total=$conexion->query("SELECT found_rows()");
            $total=(int) $total->fetchColumn();

            //calcular el otal de páginas
            $Npages= ceil($total/$register);
            $table.='<div >
            <table  class="table table-hover thead-primary  table-responsive"> 
                <thead> 
                    <td>#</td>
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
                    
                    <td colspan="1">Editar</td>
                   
                </thead>
                <tbody>
            ';
            
            if($total>=1 && $pages<=$Npages){
                $count=$start+1;
                foreach($datos as $rows){
                    $table.='
                    <tr>
                        <td>'.$count.'</td>
                        <td>'.$rows['nameDocumentType'].'</td>
                        <td>'.$rows['accountDni'].'</td>
                        <td>'.$rows['accountFirstName'].'</td>
                        <td>'.$rows['accountLastName'].'</td>
                        <td>'.$rows['accountAddress'].'</td>
                        <td>'.$rows['accountPhone'].'</td>
                        <td>'.(isset($rows['nameGenre']) ? $rows['nameGenre'] : "Pendiente").'</td>
                        <td>'.$rows['accountEmail'].'</td>
                        <td>'.$rows['roleName'].'</td>
                       
                        <td>'.($rows['accountState'] == 1 ? "Activo" : "Inactivo").'</td>
                    
                        <td>
                        <a href="'.SERVERURL.'editAdmin?c='.mainModel::encryption($rows['accountCode']).'" type="submit" class="btn-edit">
                        <i class="bi bi-pencil-square"></i>
                        </a>
                        </td>

                    
                        <div class="RespuestaAjax"></div>
                        
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

        public function delete_user_controller() {
            // Desencriptar el code del usuario a borrar
            $code=mainModel::decryption($_POST['userToDelete']);

            // Limpiar el resultado desencriptado
            $code=mainModel::clean_string($code);            

           
            // Verificar si el usuario actual es Admin
            if (!isset($_SESSION) || !isset($_SESSION['role_sk']) || $_SESSION['role_sk'] != "Administrador") {
                // Si no, informar del error
                $alert=[ 
                    "alert"=>"simple",
                    "title"=>"No autorizado",
                    "text"=>"No tiene permisos para borrar usuarios.",
                    "type"=>"error"
                ];
            } else {
                // Buscar si existe
                $user = modelAdmin::find_code($code);

                // Si existe
                if (isset($user['idAccount'])) {
                    // Pedir borrarlo
                    $result = modelAdmin::delete_admin_model($user['idAccount']);
                    
                    // Verificar borrado
                    if ($result->rowCount() >= 1) {
                        // Si lo borró, informar que se pudo borrar
                        $alert=[ 
                            "alert"=>"simple",
                            "title"=>"Usuario eliminado",
                            "text"=>"El usuario se ha borrado exitósamente.",
                            "type"=>"success"
                        ];
                    } else {
                        // Si no, notificar que no se pudo borrar
                        $alert=[ 
                            "alert"=>"simple",
                            "title"=>"Error al borrar",
                            "text"=>"No se pudo borrar el usuario solicitado.",
                            "type"=>"error"
                        ];
                    }
                } else {
                    // Si no existe, informar que no existe
                    $alert=[ 
                        "alert"=>"simple",
                        "title"=>"Operación fallida",
                        "text"=>"No se pudo borrar el usuario solicitado.",
                        "type"=>"error"
                    ];
                }
            }

            return mainModel::sweet_alert($alert);
        }

        public function update_admin_controller() {
            $code = mainModel::decryption($_POST['userToEdit']);
            $code = mainModel::clean_string($code);  

            // Limpiar info del formulario
            $role = mainModel::clean_string($_POST['role-profile']);
            $state = mainModel::clean_string($_POST['state-profile']);
            
            // Verificar si el usuario actual es Admin
            if (!isset($_SESSION) || !isset($_SESSION['role_sk']) || $_SESSION['role_sk'] != "Administrador") {
                // Si no, informar del error
                $alert=[ 
                    "alert"=>"simple",
                    "title"=>"No autorizado",
                    "text"=>"No tiene permisos para borrar usuarios.",
                    "type"=>"error"
                ];
            } else {
                // Buscar si existe
                $user = modelAdmin::get_profile_model($code);

                // Si existe
                if (isset($user['idAccount'])) {        
                    // Construir el objeto que se envía al modelo
                    // El modelo espera todas las propiedades, por lo que se envian las actuales
                    $data = [
                        "Id" => $user['idAccount'],
                        "DocumentType" => $user['accountDocumentType'],
                        "Dni" => $user['accountDni'],
                        "FirstName" => $user['accountFirstName'],
                        "LastName" =>  $user['accountLastName'],
                        "Address" => $user['accountAddress'],
                        "Phone" => $user['accountPhone'],
                        "Genre" => $user['accountGenre'],
                        "Email" => $user['accountEmail'],
                        "Role" => $role,
                        "State" => $state
                    ];

                    // LLamar al modelo
                    $saveAdmin = modelAdmin::update_admin_model($data);

                    // Verificar respuesta del modelo y construir la respuesta para la vista
                    if($saveAdmin->rowCount() == 1){
                        $alert=[
                            "alert"=>"limpiar",
                            "title"=>"Actualizar Permsisos",
                            "text"=>"Se ha cambiado el rol exitósamente.",
                            "type"=>"success"
                        ];
                    } else {
                        $alert=[
                            "alert"=>"simple",
                            "title"=>"Actualizar usuario",
                            "text"=>"No se pudo actualizar el rol, verifique los campos estén diligenciados.",
                            "type"=>"error"
                        ];
                    }
                } else {
                    $alert=[
                        "alert"=>"simple",
                        "title"=>"Actualizar usuario",
                        "text"=>"No se pudo actualizar el rol, verifique los campos estén diligenciados.",
                        "type"=>"error"
                    ];
                }

                return mainModel::sweet_alert($alert);
            }
        }

        public function get_users_by_month_chart() {
            // Traer la data que se quiere mostrar

            // Trnasformar esa data en el areglo que requiere la interfaz

            // Reemplazar en la cadena del resultado

            return "
                <script>
                $(document).ready(function() {
                    // Client Recollection Chart JS
                    if(document.getElementById('client-recollection-chart')){
                        var options = {
                            chart: {
                                height: 332,
                                type: 'bar',
                            },
                            plotOptions: {
                                bar: {
                                    horizontal: false,
                                    columnWidth: '30%',
                                    endingShape: 'rounded'	
                                },
                            },
                            dataLabels: {
                                enabled: false
                            },
                            colors: ['#343434', '#ff0000'],
                            stroke: {
                                show: true,
                                width: 3,
                                colors: ['transparent']
                            },
                            series: [{
                                name: 'Clientes',
                                data: [44, 55, 57, 56, 65, 65, 70, 65, 60, 70, 75]
                            }, {
                                name: 'Pagos',
                                data: [35, 41, 36, 26, 70, 68, 70, 60, 55, 65, 70]
                            }],
                            xaxis: {
                                categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                            },
                            fill: {
                                opacity: 1
                            },
                            tooltip: {
                                y: {
                                    formatter: function (val) {
                                        return + val + ' thousands'
                                    }
                                }
                            },
                        }
                        var chart = new ApexCharts(
                            document.querySelector('#client-recollection-chart'),
                            options
                        );
                        chart.render();
                    }
                });
                </script>";
        }
        
}