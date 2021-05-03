<?php
    //CONTROLADOR PARA CREAR ADMINISTRADOR
    if($petitionAjax){
        require_once "../models/modelProgress.php";
    }else{
        // si la Peticion ajax es false aceder a la configuración DB
        require_once "./models/modelProgress.php";
    }

    class controllerProgress extends modelProgress{

        public function list_menkyo_controller($userCurrentMenkyo){
            $menkyos = modelProgress::list_menkyo_model();

            $select = '<select class="input-field-profile" name="menkyo-progress" required="">';
            
            foreach($menkyos as $rol){
                if ($rol['idMenkyo'] == $userCurrentMenkyo) {
                    $select.='
                        <option value="'.$rol['idMenkyo'].'" selected="">'
                        .$rol['menkyoName'].
                        '</option>
                    ';
                } else {
                    $select.='
                        <option value="'.$rol['idMenkyo'].'">'
                        .$rol['menkyoName'].
                        '</option>
                    ';
                }
            }

            $select.='</select>';

            return $select;
        }
        
        public function find_dni($dni) {
            //Obtiene los perfiles que coincidan con el dni enviado
            $datos = mainModel::connect()->query("SELECT idAccount, accountDni, accountCode
                FROM accounts WHERE accountDni ='$dni'");
            return $datos->fetchAll();
        }

        public function list_state_controller($userCurrentState) {
            $states = modelProgress::list_state_model();

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

        public function count_students() {
            //Obtiene la cantidad de roles estudiantes
            $datos = mainModel::connect()->query("SELECT count(*) as nEstudiantes
                FROM accounts WHERE accountRole =3");

            $row = $datos->fetch();

            return $row['nEstudiantes'];
        }

        

        public function create_payment_controller(){
            $date= mainModel::clean_string($_POST['date-newpay']);
            $dni= mainModel::clean_string($_POST['dni-newpay']);
            $procedure= mainModel::clean_string($_POST['procedure-newpay']); 
            $price= mainModel::clean_string($_POST['price-newpay']);
            $observation= mainModel::clean_string($_POST['observation-newpay']);
            
            //reemplaza el $
            $price = str_replace('$', '', $price);

            //AQUI se incluye el campo dni para registrar el pago al usuario.
            $accountsByDni=modelPayment::find_dni($dni);

            if (count($accountsByDni) < 1 || 
                $accountsByDni[0]['accountDni'] != $dni)
            {
                $alert=[
                    "alert"=>"simple",
                    "title"=>"Ocurrio un error inesperado",
                    "text"=>"El número de Identificación no está registrado",
                    "type"=>"error"
                ];
            } else {
                $idAccount = $accountsByDni[0]['idAccount'];
    
                // Si todas se cumplen, llamar al modelo para que ejecute el cambio, enviando la info en un arreglo
                $dataPayment = [
                    "Date"=>$date,
                    "Procedure"=>$procedure,
                    "Price"=>$price,
                    "Observation"=>$observation,
                    "IdAccount"=>$idAccount
                ];

                $savePayment = modelPayment::create_payment_model($dataPayment);

                // Verificar si el cambió se aplico e informar al usuario
                if($savePayment->rowCount() >= 1){
                    $alert=[
                        "alert"=>"limpiar",
                        "title"=>"Guardar Pago",
                        "text"=>"El pago se haguardado exitósamente.",
                        "type"=>"success"
                    ];
                } else {
                    $alert=[
                        "alert"=>"simple",
                        "title"=>"Guardar Pago",
                        "text"=>"No se pudo guardar el pago, verifique si el usuario está registrado.",
                        "type"=>"error"
                    ];
                }
            }

            return mainModel::sweet_alert($alert);   
        }

        public function pages_progress_controller($pages, $register, $role, $code){
            //Aqui que va?
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
            $datos = $conexion->query("SELECT SQL_CALC_FOUND_ROWS * FROM progress p
                LEFT JOIN accounts a ON (p.progressAccount = a.idAccount)
                -- LEFT JOIN procedures pr ON (p.paymentProcedure = pr.idProcedures)
                WHERE a.idAccount!='1' ORDER BY progressDate DESC LIMIT $start, $register");
            $datos=$datos->fetchAll();
            $total=$conexion->query("SELECT found_rows()");
            $total=(int) $total->fetchColumn();

            //calcular el total de páginas
            $Npages= ceil($total/$register);
            $table.='<div>
            <table>
                <thead> 
                    <td>Fecha de pago</td>
                    <td>Documento</td>
                    <td>Nombre</td>
                    <td>Grado</td>
                    <td>Observaciones</td>
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
                        <td>'.$rows['progressDate'].'</td>
                        <td>'.$rows['progressDni'].'</td>
                        <td>'.$rows['accountFirstName'].' '.$rows['accountLastName'].'</td>
                        <td>'.$rows['progressMenkyo'].'</td>
                        <td>'.$rows['progressObservation'].'</td>
                        <td>'.$rows['progressState'].'</td>
                        
                        <td>
                        <form action="'.SERVERURL.'ajax/adminAjax.php" method="POST" class="formulario-ajax" data-form="delete" enctype="multipart/form-data">
                            <input type="hidden" name="userToDelete" value="'.mainModel::encryption($rows['accountCode']).'">
                            <button type="submit" class="btn-general">
                                <i class="fas fa-trash-alt"></i>
                            </button>

                            <div class="RespuestaAjax"></div>
                        </form>

                    </td>

                    <td>
                        <a href="'.SERVERURL.'editAdmin?c='.mainModel::encryption($rows['accountCode']).'" type="submit" class="btn-general">
                            <i class="fas fa-edit"></i>
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
}
