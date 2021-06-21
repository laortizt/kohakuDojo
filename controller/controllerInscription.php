<?php
    //CONTROLADOR PARA CREAR CLASE
    if($petitionAjax){
        require_once "../models/modelInscription.php";
    }else{
        // si la Peticion ajax es false aceder a la configuración DB
        require_once "./models/modelInscription.php";
    }

    class controllerInscription extends modelInscription {

        public function save_inscription(){
            // Limpiar la información diligenciada
            $classId = mainModel::clean_string($_POST['inscription-class']);
        
            $user = mainModel::get_account($_SESSION['code_sk']);
            
            if (!isset($user) || !isset($user['idAccount'])){
                $alert=[
                    "alert"=>"simple",
                    "title"=>"Ocurrio un error inesperado",
                    "text"=>"No se pudo obtener su información de usuario. Intente de nuevo en unos minutos.",
                    "type"=>"error"
                ];
            } else {
                $userId = $user['idAccount'];
                $existingInscriptionsToClass = modelInscription::find_inscription_by_user_and_classmodel($userId, $classId);

                if ($existingInscriptionsToClass->rowCount() > 0) {
                    $alert=[
                        "alert"=>"simple",
                        "title"=>"Ocurrio un error",
                        "text"=>"Ya está registrado para esta clase",
                        "type"=>"error"
                    ];
                } else {
                    // Si todas se cumplen, llamar al modelo para que ejecute el cambio, enviando la info en un arreglo
                    $dataInscription = [
                        "UserId"=>$userId,
                        "ClassId"=>$classId,
                        "Assisted"=>false
                    ];

                    $savedInscription = modelInscription::create_inscription_model($dataInscription);

                    // Verificar si el cambió se aplico e informar al usuario
                    if($savedInscription->rowCount() >= 1) {
                        $alert = [
                            "alert"=>"recargar",
                            "title"=>"Registrar Clase",
                            "text"=>"Se ha registrado a la clase exitósamente.",
                            "type"=>"success"
                        ];
                    } else {
                        $alert = [
                            "alert"=>"simple",
                            "title"=>"Inscripción no registrada",
                            "text"=>"No se pudo registrar a la clase. Intente más tarde.",
                            "type"=>"error"
                        ];
                    }
                }
            }

            return mainModel::sweet_alert($alert);
        }

        public function update_inscription_controller() {
            $inscriptionId = mainModel::decryption($_POST['inscriptionToUpdate']);
            $inscriptionId = mainModel::clean_string($inscriptionId);

            $classId= mainModel::clean_string($_POST['inscriptionClass']);
            $userId= mainModel::clean_string($_POST['inscriptionUser']);
            $assisted= mainModel::clean_string($_POST['inscriptionAssisted']);

            if (!isset($_SESSION) || !isset($_SESSION['role_sk']) || $_SESSION['role_sk'] != "Administrador" || $_SESSION['role_sk'] != "Instructor") {
                // Si no, informar del error
                $alert=[ 
                    "alert"=>"simple",
                    "title"=>"No autorizado",
                    "text"=>"No tiene permisos para modificar asistencia.",
                    "type"=>"error"
                ];
            } else {
                // Buscar si existe
                $existingInscriptionsToClass = modelInscription::find_inscription_model($inscriptionId);
    
                // Si existe
                if (count($existingInscriptionsToClass) !== 1) {
                    $alert=[
                        "alert"=>"simple",
                        "title"=>"Ocurrio un error",
                        "text"=>"Usted no está registrado para esta clase",
                        "type"=>"error"
                    ]; 
                } else {
                    $dataInscription = [
                        "UserId"=>$userId,
                        "ClassId"=>$classId,
                        "Assisted"=>$assisted
                    ];
    
                    // LLamar al modelo
                    $savedInscription = modelInscription::update_inscription_model($dataInscription);
    
                    // Verificar respuesta del modelo y construir la respuesta para la vista
                    if($savedInscription->rowCount() == 1){
                        $alert=[
                            "alert"=>"redireccion",
                            "title"=>"Actualizar inscripción",
                            "text"=>"Se ha actualizado la inscripción exitósamente.",
                            "type"=>"success",
                            "path"=>"adminClass"
                        ];
                    } else {
                        $alert=[
                            "alert"=>"simple",
                            "title"=>"Actualizar inscripción",
                            "text"=>"No se pudo actualizar la inscripción, verifique los campos estén diligenciados.",
                            "type"=>"error"
                        ];
                    }
                }
            }

            return mainModel::sweet_alert($alert);
        }

        public function delete_class_controller() {
            $inscriptionId = mainModel::decryption($_POST['inscriptionToDelete']);
            $inscriptionId = mainModel::clean_string($inscriptionId);
           
            // Obterner información del usuario actual
            $user = mainModel::get_account($_SESSION['code_sk']);
            
            if (!isset($user) || !isset($user['idAccount'])){
                $alert=[
                    "alert"=>"simple",
                    "title"=>"Ocurrio un error inesperado",
                    "text"=>"No se pudo obtener su información de usuario. Intente de nuevo en unos minutos.",
                    "type"=>"error"
                ];
            } else {
                $userId = $user['idAccount'];
                // Buscar si existe
                $inscriptions = modelInscription::find_inscription_model($inscriptionId);

                if (count($inscriptions) != 1) {
                    $alert=[ 
                        "alert"=>"simple",
                        "title"=>"Operación fallida",
                        "text"=>"Usted no está registrado para esta clase.",
                        "type"=>"error"
                    ];
                } else {
                    // Pedir borrarlo
                    $result = modelInscription::delete_inscription_model($inscriptionId);

                    // Verificar borrado
                    if ($result->rowCount() >= 1) {
                        // Si lo borró, informar que se pudo borrar
                        $alert=[ 
                            "alert"=>"recargar",
                            "title"=>"Inscripción eliminada",
                            "text"=>"La inscripción a la clase se ha borrado exitósamente.",
                            "type"=>"success"
                        ];
                    } else {
                        // Si no, notificar que no se pudo borrar
                        $alert=[ 
                            "alert"=>"simple",
                            "title"=>"Error al borrar",
                            "text"=>"No se pudo borrar la inscripción a la clase solicitada.",
                            "type"=>"error"
                        ];
                    }
                }
            }

            return mainModel::sweet_alert($alert);
        }

        public function pages_class_assistance_controller($classId, $pages, $register, $role, $code) {
            $classId=mainModel::clean_string($classId);
            $pages=mainModel::clean_string($pages);
            $register=mainModel::clean_string($register);
            $role=mainModel::clean_string($role);
            $code=mainModel::clean_string($code);

            $table="";

            $page=(isset($page)&& $page>0) ? (int) $page : 1;
            $start=($pages>0)? (($pages*$register)-$register) : 0;
            
            $pageurl = "listAttendance/page";
            
            $conexion = mainModel::connect();

            // Obtener los usuarios
            $consulta = "SELECT SQL_CALC_FOUND_ROWS i.*, c.*, a.accountFirstName, a.accountLastName
                    FROM inscription i
                    INNER JOIN class c ON (i.inscriptionClass = c.idClass)
                    INNER JOIN accounts a ON (i.inscriptionUserId = a.idAccount)
                    WHERE i.inscriptionClass=$classId
                    ORDER BY a.accountFirstName ASC LIMIT $start, $register;
                ";

            $datos = $conexion->query($consulta);
            $datos = $datos->fetchAll();
            
            //Calcula cúantos registros hay en la consutla
            $total=$conexion->query("SELECT found_rows()");
            $total=(int) $total->fetchColumn();

            //calcular el total de páginas
            $Npages= ceil($total/$register);
            $table.='<div >
                <table class="table table-hover thead-primary table-responsive">
                    <thead>
                        <td>#</td>
                        <td>Nombre</td>
                       

                      
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
                        <td>'.(isset($rows['inscriptionAssisted']) ? $rows['inscriptionAssisted'] : '').'</td>
                        
                    </tr>';
                    $count++;
                }
                
            } else {
                $table.='
                    <tr>
                        <td colspan="15"> No hay registros en esta página</td>
                    </tr>';
            }
            $table.='</tbody> </table> </div>';

            if($total>=1 && $pages<=$Npages) {
                $table.='<nav class="text-center"><ul class="pagination pagination-sm">';

                if($page == 1) {
                    $table.='<li class="disabled"><a>«</a></li>';
                } else {
                    $table.='<li>
                        <a href="'.SERVERURL.$pageurl.'/'.($pages-1).'/">«</a>
                    </li>';
                }

                for($i=1; $i<=$Npages; $i++) {
                    if($pages == $i) {
                        $table.='<li class="active">
                            <a>'.$i.'</a>
                        </li>';
                    } else {
                        $table.='<li><a href="'.SERVERURL.$pageurl.'/'.$i.'/">'.$i.'</a></li>';
                    }
                }

                if($page == $Npages) {
                    $table.='<li class="disabled"><a>»</a></li>';
                } else {
                    $table.='<li>
                        <a href="'.SERVERURL.$pageurl.'/'.($pages+1).'/">»</a>
                    </li>';
                }

                $table.='</ul></nav>';
            }

            return $table;
        }
    }