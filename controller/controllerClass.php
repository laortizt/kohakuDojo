<?php
    //CONTROLADOR PARA CREAR CLASE
    if($petitionAjax){
        require_once "../models/modelClass.php";
    }else{
        // si la Peticion ajax es false aceder a la configuración DB
        require_once "./models/modelClass.php";
    }

    class controllerClass extends modelClass{
        //controlador para agregar clase
        // public function get_class_controller(){
        //     $class = modelClass::get_class_model($_SESSION['code_sk']);
        //     return $class;
        // }  
       
        public function list_teachers_controller(){
            $teachers = modelClass::list_teachers_model();

            $select = '<select class="select-instructor input-field-profile" name="select-instructor" required="">';
            
            foreach($teachers as $teacher){
                $select.='
                    <option value="'.$teacher['idAccount'].'">'
                    .$teacher['accountFirstName'].' '.$teacher['accountLastName'].
                    '</option>
                ';
            }

            $select.='</select>';

            return $select;
        }

        // public function list_events_controller(){
        //     $Events = modelclass::list_events_model();

        //     $select = '<select id="select-event" class="input-field-profile" name="select-event" required="">';
            
        //     foreach($Events as $events){
        //         $select.='<option value="'.$events['idEvents'].'" data-cost="'.$events['eventsPrice'].'">'
        //             .$events['eventsName'].
        //             '</option>';
        //     }

        //     $select.='</select>';

        //     return $select;
        // }

        public function list_events_controller($userCurrentEvent){
            $events = modelClass::list_events_model();

            $select = '<select id="select-event" class="input-field-profile" name="select-event" required="">';
            
            foreach($events as $event){
                if ($event['idEvents'] == $userCurrentEvent) {
                    $select.='
                        <option value="'.$event['idEvents'].'" selected="" data-cost="'.$event['eventsPrice'].'">'
                        .$event['eventsName'].
                        '</option>
                    ';
                } else {
                    $select.='
                        <option value="'.$event['idEvents'].'" data-cost="'.$event['eventsPrice'].'">'
                        .$event['eventsName'].
                        '</option>
                    ';
                }
            }

            $select.='</select>';

            return $select;
        }

        public function save_class(){
            // Limpiar la información diligenciada
            
            $teacher= mainModel::clean_string($_POST['select-instructor']); 
            $topic= mainModel::clean_string($_POST['classTopic']);
            $event= mainModel::clean_string($_POST['select-event']);
            $price= mainModel::clean_string($_POST['eventsPrice']);
            $date= mainModel::clean_string($_POST['classDate']);
            $timeInit= mainModel::clean_string($_POST['classTimeInit']);
            $timeEnd= mainModel::clean_string($_POST['classTimeEnd']);
            
        
            $price = str_replace('$', '', $price);
            
            // Validar condiciones SI YA HAY UNA CLASEREGISTRADA EN EL MISMO HORARIO
            $classById=modelClass::find_class($date);

            if (count($classById) > 1 || 
                (count($classById) == 1 && $classById[0]['classDate'] != $date) )
            {
                $alert=[
                    "alert"=>"simple",
                    "title"=>"Ocurrio un error inesperado",
                    "text"=>"Ya hay una clase registrada a esa hora",
                    "type"=>"error"
                ];
            }else {
                // Si todas se cumplen, llamar al modelo para que ejecute el cambio, enviando la info en un arreglo
                $dataClass = [
                    "Teacher"=>$teacher,
                    "Topic"=>$topic,
                    "Events"=>$event,
                    "Price"=>$price,
                    "Date"=>$date,
                    "TimeInit"=>$timeInit,
                    "TimeEnd"=>$timeEnd,
                ];

                $saveClass = modelClass::create_class_model($dataClass);

                // Verificar si el cambió se aplico e informar al usuario
                if($saveClass->rowCount() >= 1){
                    $alert=[
                        "alert"=>"limpiar",
                        "title"=>"Registrar Clase",
                        "text"=>"La Clase se ha creado exitósamente.",
                        "type"=>"success"
                    ];
                } else {
                    $alert=[
                        "alert"=>"simple",
                        "title"=>"Clase no registrada",
                        "text"=>"No se pudo crear la clase, verifique que no hay más clases en ese horario.",
                        "type"=>"error"
                    ];
                }
             }

            return mainModel::sweet_alert($alert);
        }

        public function pages_attendance_controller($pages, $register, $role, $code){
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
            $datos = $conexion->query("SELECT SQL_CALC_FOUND_ROWS c.*, e.*, a.accountFirstName, a.accountLastName FROM class c
                LEFT JOIN events e ON (c.classEvents = e.idEvents)
                LEFT JOIN accounts a ON (c.classTeacher = a.idAccount)
                ORDER BY c.classDate DESC LIMIT $start, $register");
                
            $datos=$datos->fetchAll();
            $total=$conexion->query("SELECT found_rows()");
            $total=(int) $total->fetchColumn();

            //calcular el otal de páginas
            $Npages= ceil($total/$register);
            $table.='<div >
            <table  class="table table-hover thead-primary  table-responsive"> 
                <thead> 
                    <td>#</td>
                    <td>Instructor</td>
                    <td>Tema</td>
                    <td>Tipo de evento</td>
                    <td>Precio</td>
                    <td>Fecha</td>
                    <td>Hora Inicio</td>
                    <td>Hora Fin</td>
                    <td>ver</td>

                </thead>
                <tbody>
            ';
            
            if($total>=1 && $pages<=$Npages){
                $count=$start+1;
                foreach($datos as $rows){
                    $table.='
                    <tr>
                        <td>'.$count.'</td>
                        <td>'.$rows['accountFirstName'].' '.$rows['accountLastName'].'</td>
                        <td>'.$rows['classTopic'].'</td>
                        <td>'.$rows['eventsName'].'</td>
                        <td>'.$rows['classPrice'].'</td>
                        <td>'.$rows['classDate'].'</td>
                        <td>'.$rows['classTimeInit'].'</td>
                        <td>'.$rows['classTimeEnd'].'</td>
                        <td>
                        <a href="" type="submit" class="btn-eye">
                        <i class="bi bi-eye"></i>
                        </a>
                        </td>
                      
                        <div class="RespuestaAjax"></div>
                      
                    ';
                    $count++;
                }
            }else{
                $table.='
                    <tr>
                        <td colspan="15"> No hay registros en esta página</td>
                    </tr>';
            }
            $table.='</tbody> </table> </div>';
            

            return $table;
        }

        public function pages_class_controller($pages, $register, $role, $code){
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
            $datos = $conexion->query("SELECT SQL_CALC_FOUND_ROWS c.*, e.*, a.accountFirstName, a.accountLastName FROM class c
                LEFT JOIN events e ON (c.classEvents = e.idEvents)
                LEFT JOIN accounts a ON (c.classTeacher = a.idAccount)
                ORDER BY c.classDate DESC LIMIT $start, $register");
                
            $datos=$datos->fetchAll();
            $total=$conexion->query("SELECT found_rows()");
            $total=(int) $total->fetchColumn();

            //calcular el otal de páginas
            $Npages= ceil($total/$register);
            $table.='<div >
            <table  class="table table-hover thead-primary  table-responsive"> 
                <thead> 
                    <td>#</td>
                    <td>Instructor</td>
                    <td>Tema</td>
                    <td>Tipo de evento</td>
                    <td>Precio</td>
                    <td>Fecha</td>
                    <td>Hora Inicio</td>
                    <td>Hora Fin</td>
                    <td>Eliminar</td>
                    <td>Editar</td>

                </thead>
                <tbody>
            ';
            
            if($total>=1 && $pages<=$Npages){
                $count=$start+1;
                foreach($datos as $rows){
                    $table.='
                    <tr>
                        <td>'.$count.'</td>
                        <td>'.$rows['accountFirstName'].' '.$rows['accountLastName'].'</td>
                        <td>'.$rows['classTopic'].'</td>
                        <td>'.$rows['eventsName'].'</td>
                        <td>'.'$'.$rows['classPrice'].'</td>
                        <td>'.$rows['classDate'].'</td>
                        <td>'.$rows['classTimeInit'].'</td>
                        <td>'.$rows['classTimeEnd'].'</td>
                       
                      
                       
                      
                        <td>
                            <form action="'.SERVERURL.'ajax/classAjax.php" method="POST" class="formulario-ajax" data-form="delete" enctype="multipart/form-data">
                                <input type="hidden" name="classToDelete" value="'.mainModel::encryption($rows['idClass']).'">
                                <button type="submit" class="btn-delete">
                                <i class="bi bi-trash"></i>
                                </button>
                                <div class="RespuestaAjax"></div>
                            </form>
                        </td>
                        
                        <td>
                        <a href="'.SERVERURL.'editClass?c='.mainModel::encryption($rows['idClass']).'" type="submit" class="btn-edit">
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
                        <td colspan="15"> No hay registros en esta página</td>
                    </tr>';
            }
            $table.='</tbody> </table> </div>';
            

            return $table;
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
                                name: 'Asistencia',
                                data: [44, 55, 57, 56, 65, 65, 70, 65, 60, 70, 75]
                            }, {
                                name: 'Clases',
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
                                        return + val 
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

        public function update_class_controller() {
            $idClass = mainModel::decryption($_POST['userToEdit']);
            $idClass = mainModel::clean_string($idClass);  
            

            // Verificar si el usuario actual es Admin
            if (!isset($_SESSION) || !isset($_SESSION['role_sk']) || $_SESSION['role_sk'] != "Administrador") {
                // Si no, informar del error
                $alert=[ 
                    "alert"=>"simple",
                    "title"=>"No autorizado",
                    "text"=>"No tiene permisos para borrar Clases.",
                    "type"=>"error"
                ];
            } else {
                // Buscar si existe
                $class = modelClass::get_class_model($idClass);

                // Si existe
                if (isset($class['idClass'])) {        
                    // Construir el objeto que se envía al modelo
                    // El modelo espera todas las propiedades, por lo que se envian las actuales
                    $data = [
                        "Teacher" => $class['classTeacher'],
                        "Topic" => $class['classTopic'],
                        "Event" => $class['classEvents'],
                        "Price" => $class['classPrice'],
                        "Date" =>  $class['classDate'],
                        "timeInit" => $class['classTimeInit'],
                        "timeEnd" => $class['classTimeEnd'],
                        
                    ];

                    // LLamar al modelo
                    $saveClass = modelClass::update_class_model($data);

                    // Verificar respuesta del modelo y construir la respuesta para la vista
                    if($saveClass->rowCount() == 1){
                        $alert=[
                            "alert"=>"limpiar",
                            "title"=>"Actualizar clase",
                            "text"=>"Se ha actualizado la clase exitósamente.",
                            "type"=>"success"
                        ];
                    } else {
                        $alert=[
                            "alert"=>"simple",
                            "title"=>"Actualizar clase",
                            "text"=>"No se pudo actualizar la clase, verifique los campos estén diligenciados.",
                            "type"=>"error"
                        ];
                    }
                } else {
                    $alert=[
                        "alert"=>"simple",
                        "title"=>"Actualizar clase",
                        "text"=>"No se pudo actualizar la clase, verifique los campos estén diligenciados.",
                        "type"=>"error"
                    ];
                }

                return mainModel::sweet_alert($alert);
            }
        }

        public function delete_class_controller() {
            // Desencriptar el code del usuario a borrar
            $idClass=mainModel::decryption($_POST['classToDelete']);

            // Limpiar el resultado desencriptado
            $idClass=mainModel::clean_string($idClass);    
           
            // Verificar si el usuario actual es Admin
            if (!isset($_SESSION) || !isset($_SESSION['role_sk']) || $_SESSION['role_sk'] != "Administrador") {
                // Si no, informar del error
                $alert=[ 
                    "alert"=>"simple",
                    "title"=>"No autorizado",
                    "text"=>"No tiene permisos para borrar clases.",
                    "type"=>"error"
                ];
            } else {
                // Buscar si existe
                $classes = modelClass::find_class($idClass);

                if (count($classes)) {
                    $class = $classes[0];
                }
                
                // Si existe
                if (isset($class['idClass'])) {
                    // Pedir borrarlo
                    $result = modelClass::delete_class($class['idClass']);
                    
                    // Verificar borrado
                    if ($result->rowCount() >= 1) {
                        // Si lo borró, informar que se pudo borrar
                        $alert=[ 
                            "alert"=>"simple",
                            "title"=>"Clase eliminada",
                            "text"=>"La clase se ha borrado exitósamente.",
                            "type"=>"success"
                        ];
                    } else {
                        // Si no, notificar que no se pudo borrar
                        $alert=[ 
                            "alert"=>"simple",
                            "title"=>"Error al borrar",
                            "text"=>"No se pudo borrar la clase solicitada.",
                            "type"=>"error"
                        ];
                    }
                } else {
                    // Si no existe, informar que no existe
                    $alert=[ 
                        "alert"=>"simple",
                        "title"=>"Operación fallida",
                        "text"=>"No se pudo borrar la clase solicitado.",
                        "type"=>"error"
                    ];
                }
            }

            return mainModel::sweet_alert($alert);
        }
        public function get_class_controller(){
            $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $parts = parse_url($url);
            parse_str($parts['query'], $query);
            $idClass = $query['c'];
            
            // Desencriptar y Limpiar el código
            $idClass=mainModel::decryption($idClass);
            $idClass=mainModel::clean_string($idClass);

            $class = modelClass::get_class_model($idClass);
            return $class;
        }

        public function class_teacher_controller(){
            $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $parts = parse_url($url);
            parse_str($parts['query'], $query);
            $idClass = $query['c'];
            
            // Desencriptar y Limpiar el código
            $idClass=mainModel::decryption($idClass);
            $idClass=mainModel::clean_string($idClass);

            $class = modelClass::get_class_model($idClass);
            return $class;
        }
    }