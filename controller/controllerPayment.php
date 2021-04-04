<?php
    //CONTROLADOR PARA CREAR ADMINISTRADOR
    if($petitionAjax){
        require_once "../models/modelPayment.php";
    }else{
        // si la Peticion ajax es false aceder a la configuración DB
        require_once "./models/modelPayment.php";
    }

    class controllerPayment extends modelPayment{

        public function find_dni($dni) {
            //Obtiene los perfiles que coincidan con el dni enviado
            $datos = mainModel::connect()->query("SELECT idAccount, accountDni, accountCode
                FROM accounts WHERE accountDni ='$dni'");
            return $datos->fetchAll();
        }

        public function list_procedure_controller(){
            $Procedures = modelPayment::list_procedure_model();

            $select = '<select id="procedure-newpay" class="input-field" name="procedure-newpay" required="">';
            
            foreach($Procedures as $procedure){
                $select.='<option value="'.$procedure['idProcedures'].'" data-cost="'.$procedure['procedurePrice'].'">'
                    .$procedure['procedureName'].
                    '</option>';
            }

            $select.='</select>';

            return $select;
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
    }