<?php
//CONTROLADOR PARA CREAR ADMINISTRADOR
if ($petitionAjax) {
    require_once "../models/modelProgress.php";
} else {
    // si la Peticion ajax es false aceder a la configuración DB
    require_once "./models/modelProgress.php";
}

class controllerProgress extends modelProgress
{

    public function list_menkyo_controller()
    {
        $Menkyos = modelProgress::list_menkyo_model();

        $select = '<select id="menkyo-progress" class="input-field" name="menkyo-progress" required="">';

        foreach ($Menkyos as $menkyo) {
            $select .= '<option value="' . $menkyo['idMenkyo'] . '" data-cost="' . $menkyo['menkyoName'] . '">'
                . $menkyo['menkyoName'] .
                '</option>';
        }

        $select .= '</select>';

        return $select;
    }

    public function find_dni($dni)
    {
        //Obtiene los perfiles que coincidan con el dni enviado
        $datos = mainModel::connect()->query("SELECT idAccount, accountDni, accountCode
                FROM accounts WHERE accountDni ='$dni'");
        return $datos->fetchAll();
    }

    public function list_state_controller()
    {
        $States = modelProgress::list_state_model();

        $select = '<select id="state-progress" class="input-field" name="state-progress" required="">';

        foreach ($States as $state) {
            $select .= '<option value="' . $state['idState'] . '" data-cost="' . $state['stateName'] . '">'
                . $state['stateName'] .
                '</option>';
        }

        $select .= '</select>';

        return $select;
    }

    public function count_students()
    {
        //Obtiene la cantidad de roles estudiantes
        $datos = mainModel::connect()->query("SELECT count(*) as nEstudiantes
                FROM accounts WHERE accountRole =3");

        $row = $datos->fetch();

        return $row['nEstudiantes'];
    }

    public function create_progress_controller()
    {
        $date = mainModel::clean_string($_POST['date-progress']);
        $dni = mainModel::clean_string($_POST['dni-progress']);
        $menkyo = mainModel::clean_string($_POST['menkyo-progress']);
        $observation = mainModel::clean_string($_POST['observation-progress']);
        $state = mainModel::clean_string($_POST['state-progress']);


        //AQUI se incluye el campo dni para registrar el pago al usuario.
        $accountsByDni = modelProgress::find_dni($dni);

        if (
            count($accountsByDni) < 1 ||
            $accountsByDni[0]['accountDni'] != $dni
        ) {
            $alert = [
                "alert" => "simple",
                "title" => "Ocurrio un error inesperado",
                "text" => "El número de Identificación no está registrado",
                "type" => "error"
            ];
        } else {
            $idAccount = $accountsByDni[0]['idAccount'];

            // Si todas se cumplen, llamar al modelo para que ejecute el cambio, enviando la info en un arreglo
            $dataProgress = [
                "Date" => $date,
                "Dni" => $dni,
                "Menkyo" => $menkyo,
                "Observation" => $observation,
                "State" => $state,
                "IdAccount" => $idAccount
            ];

            $saveProgress = modelProgress::create_progress_model($dataProgress);

            // Verificar si el cambió se aplico e informar al usuario
            if ($saveProgress->rowCount() >= 1) {
                $alert = [
                    "alert" => "limpiar",
                    "title" => "Guardar Registro",
                    "text" => "El alumno se ha promovido con exitó.",
                    "type" => "success"
                ];
            } else {
                $alert = [
                    "alert" => "simple",
                    "title" => "Guardar Registro",
                    "text" => "No se pudo guardar el avance, verifique si el alumno está registrado.",
                    "type" => "error"
                ];
            }
        }

        return mainModel::sweet_alert($alert);
    }
    //trae el progeso por usuario
    public function get_progressUser_controller()
    {
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $parts = parse_url($url);
        parse_str($parts['query'], $query);
        $idProgress = $query['id'];

        // Desencriptar y Limpiar el código
        $idProgress = mainModel::decryption($idProgress);
        $idProgress = mainModel::clean_string($idProgress);

        $progress = modelProgress::get_progress_model($idProgress);

        return $progress;
    }

    public function pages_progress_controller($pages, $register, $role, $code)
    {
        //Aqui que va?
        $pages = mainModel::clean_string($pages);
        $register = mainModel::clean_string($register);
        $role = mainModel::clean_string($role);
        $code = mainModel::clean_string($code);

        $table = "";

        $page = (isset($page) && $page > 0) ? (int) $page : 1;
        $start = ($pages > 0) ? (($pages * $register) - $register) : 0;
        $conexion = mainModel::connect();

        //Calcula cúantos registros hay en la consutla
        //aqui en la consulta el admin 1 es el principal del sistema y  NO se va a seleccionar
        $datos = $conexion->query("SELECT SQL_CALC_FOUND_ROWS * FROM progress p
                INNER JOIN accounts a ON (p.progressAccount = a.idAccount)
                INNER JOIN state st ON (p.progressState = st.idState)
                INNER JOIN menkyo mk ON (p.progressMenkyo = mk.idMenkyo)
                WHERE a.idAccount!='1' ORDER BY progressDate DESC LIMIT $start, $register");
        $datos = $datos->fetchAll();
        $total = $conexion->query("SELECT found_rows()");
        $total = (int) $total->fetchColumn();

        //calcular el total de páginas
        $Npages = ceil($total / $register);
        $table .= '<div>
            <table class="table table-hover thead-primary">
                <thead> 
                    <td>Fecha de pago</td>
                    <td>Documento</td>
                    <td>Nombre</td>
                    <td>Grado</td>
                    <td>Observaciones</td>
                    <td>Estado</td>
                    <td colspan="1">Eliminar</td>
                    <td colspan="1">Editar</td>
                </thead>
                <tbody>
            ';

        if ($total >= 1 && $pages <= $Npages) {
            $count = $start + 1;
            foreach ($datos as $rows) {
                $table .= '
                    <tr>
                        <td>' . $rows['progressDate'] . '</td>
                        <td>' . $rows['progressDni'] . '</td>
                        <td>' . $rows['accountFirstName'] . ' ' . $rows['accountLastName'] . '</td>
                        <td>' . $rows['menkyoName'] . '</td>
                        <td>' . $rows['progressObservation'] . '</td>
                        <td>' . $rows['stateName'] . '</td>
                        
                        <td>
                        <a href="' . SERVERURL . 'editProgress?id=' . mainModel::encryption($rows['idProgress']) . '" type="submit" class="btn-edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        </td>

                        <td>
                        <form action="' . SERVERURL . 'ajax/progressAjax.php" method="POST" class="formulario-ajax" data-form="delete" enctype="multipart/form-data">
                            <input type="hidden" name="userToDelete" value="' . mainModel::encryption($rows['idProgress']) . '">
                            <button type="submit" class="btn-delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>

                            <div class="RespuestaAjax"></div>
                        </form>

                    </td>

                    
                    
                    <div class="RespuestaAjax"></div>
                    
                
                    ';
                $count++;
            }
        } else {
            $table .= '
                    <tr>
                        <td colspan="15"> No hay registros en el sistema</td>
                    </tr>';
        }
        $table .= '</tbody> </table> </div>';

        return $table;
    }

    public function update_progress_controller()
    {
        $code = mainModel::decryption($_POST['userToEdit']);
        $code = mainModel::clean_string($code);

        // Limpiar info del formulario
        $date = mainModel::clean_string($_POST['date-progress']);
        $dni = mainModel::clean_string($_POST['dni-progress']);
        $menkyo = mainModel::clean_string($_POST['menkyo-progress']);
        $observation = mainModel::clean_string($_POST['observation-progress']);
        $state = mainModel::clean_string($_POST['state-progress']);

        // Verificar si el usuario actual es Admin
        if (!isset($_SESSION) || !isset($_SESSION['role_sk']) || $_SESSION['role_sk'] != "Administrador") {
            // Si no, informar del error
            $alert = [
                "alert" => "simple",
                "title" => "No autorizado",
                "text" => "No tiene permisos para borrar registros.",
                "type" => "error"
            ];
        } else {
            // Buscar si existe
            $user = modelProgress::get_progress_model($code);

            // Si existe
            if (isset($user['idAccount'])) {
                // Construir el objeto que se envía al modelo
                // El modelo espera todas las propiedades, por lo que se envian las actuales
                $data = [
                    "Id" => $user['idAccount'],
                    "Date" => $date,
                    "Dni" => $dni,
                    "Menkyo" => $menkyo,
                    "Observation" => $observation,
                    "State" => $state,
                ];

                // LLamar al modelo
                $saveProgress = modelProgress::update_progress_model($data);

                // Verificar respuesta del modelo y construir la respuesta para la vista
                if ($saveProgress->rowCount() == 1) {
                    $alert = [
                        "alert" => "limpiar",
                        "title" => "Actualizar Progreso",
                        "text" => "Se ha actualizado el registro exitósamente.",
                        "type" => "success"
                    ];
                } else {
                    $alert = [
                        "alert" => "simple",
                        "title" => "Actualizar Progreso",
                        "text" => "No se pudo actualizar el registro, verifique  si los campos estén diligenciados.",
                        "type" => "error"
                    ];
                }
            } else {
                $alert = [
                    "alert" => "simple",
                    "title" => "Actualizar Progreso",
                    "text" => "No se pudo actualizar el registro, verifique los campos estén diligenciados.",
                    "type" => "error"
                ];
            }

            return mainModel::sweet_alert($alert);
        }
    }

    public function save_profile()
    {
        // Limpiar la información diligenciada
        $code = mainModel::decryption($_POST['userToEdit']);
        $code = mainModel::clean_string($code);

        // Limpiar info del formulario
        $date = mainModel::clean_string($_POST['date-progress']);
        $dni = mainModel::clean_string($_POST['dni-progress']);
        $menkyo = mainModel::clean_string($_POST['menkyo-progress']);
        $observation = mainModel::clean_string($_POST['observation-progress']);
        $state = mainModel::clean_string($_POST['state-progress']);

        // Validar condiciones
        $progressByDni = modelProgress::find_dni($dni);

        if (
            count($progressByDni) > 1 ||
            (count($progressByDni) == 1 && $$progressByDni[0]['progressDni'] != $dni)
        ) {
            $alert = [
                "alert" => "simple",
                "title" => "Ocurrio un error inesperado",
                "text" => "El número de Identificación ya está registrado",
                "type" => "error"
            ];
        } else {
            // Si coincide, proceder con la actualización
            $id = $$progressByDni[0]['idAccount'];

            // Si todas se cumplen, llamar al modelo para que ejecute el cambio, enviando la info en un arreglo
            $dataProgress = [
                "Id"=> $id,
                "Date" => $date,
                "Dni" => $dni,
                "Menkyo" => $menkyo,
                "Observation" => $observation,
                "State" => $state,
            ];

            $saveProgress = modelProgress::update_progress_model($dataProgress);

            // Verificar si el cambió se aplico e informar al usuario
            if ($saveProgress->rowCount() >= 1) {
                $alert = [
                    "alert" => "limpiar",
                    "title" => "Actualizar perfil",
                    "text" => "El registro se ha actualizado exitósamente.",
                    "type" => "success"
                ];
            } else {
                $alert = [
                    "alert" => "simple",
                    "title" => "Actualizar perfil",
                    "text" => "No se pudo actualizar el registro, verifique los campos e intente de nuevo.",
                    "type" => "error"
                ];
            }
        }

        return mainModel::sweet_alert($alert);
    }
}
