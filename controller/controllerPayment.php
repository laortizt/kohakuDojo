<?php
    //CONTROLADOR PARA CREAR ADMINISTRADOR
    if($petitionAjax){
        require_once "../models/modelPayment.php";
    }else{
        // si la Peticion ajax es false aceder a la configuración DB
        require_once "./models/modelPayment.php";
    }

    class controllerPayment extends modelPayment{


        public function list_procedure_controller(){
            $Procedures = modelPayment::list_procedure_model();

            $select = '<select id="procedure-newpay" class="input-field-profile" name="procedure-newpay" required="">';
            
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
                    "IdAccount"=>$idAccount
                ];

                $savePayment = modelPayment::create_payment_model($dataPayment);

                // Verificar si el cambió se aplico e informar al usuario
                if($savePayment->rowCount() >= 1){
                    $alert=[
                        "alert"=>"limpiar",
                        "title"=>"Guardar Pago",
                        "text"=>"El pago se ha guardado exitósamente.",
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

        public function update_payment_controller(){
            $date= mainModel::clean_string($_POST['date-newpay']);
            $dni= mainModel::clean_string($_POST['dni-newpay']);
            $procedure= mainModel::clean_string($_POST['procedure-newpay']); 
            $price= mainModel::clean_string($_POST['price-newpay']);
            
            $idPayments= mainModel::clean_string($_POST['']);
            if (!isset($_SESSION) || !isset($_SESSION['role_sk']) || $_SESSION['role_sk'] != "Administrador") {
                // Si no, informar del error
                $alert=[ 
                    "alert"=>"simple",
                    "title"=>"No autorizado",
                    "text"=>"No tiene permisos para editar pagos.",
                    "type"=>"error"
                ];
            } else {    
                $paymentById=modelPayment::find_idPay($idPayments);

                if(count($paymentById) != 1 || $paymentById[0]['$idPayments'] != $_SESSION['code_sk']) {
                    // Si no coincide, error
                    $alert=[
                        "alert"=>"simple",
                        "title"=>"Ocurrio un error inesperado",
                        "text"=>"Pa no encontrado",
                        "type"=>"error"
                    ];  
                }else{
                    $a = 2;
                }
            }

            return mainModel::sweet_alert($alert);
        }
        
        public function pages_payment_controller($pages, $register, $role, $code){
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
            $datos = $conexion->query("SELECT SQL_CALC_FOUND_ROWS * FROM payments p
                LEFT JOIN accounts a ON (p.paymentAccount = a.idAccount)
                LEFT JOIN procedures pr ON (p.paymentProcedure = pr.idProcedures)
                WHERE a.idAccount!='1' ORDER BY paymentDate DESC LIMIT $start, $register");
            $datos=$datos->fetchAll();
            $total=$conexion->query("SELECT found_rows()");
            $total=(int) $total->fetchColumn();

            //calcular el otal de páginas
            $Npages= ceil($total/$register);
            $table.='<div>
            <table class="table table-hover thead-primary">
                <thead> 
                    <td>Fecha de pago</td>
                    <td>Documento</td>
                    <td>Trámite</td>
                    <td>Valor</td>
                    
                    <td>Nombre</td>
                   
                </thead>
                <tbody>
            ';
            
            if($total>=1 && $pages<=$Npages){
                $count=$start+1;
                foreach($datos as $rows){
                    $table.='
                    <tr>
                        <td>'.$rows['paymentDate'].'</td>
                        <td>'.$rows['accountDni'].'</td>
                        <td>'.$rows['procedureName'].'</td>
                        <td>'.'$'.$rows['paymentPrice'].'</td>
                       
                        <td>'.$rows['accountFirstName'].' '.$rows['accountLastName'].'</td>

                       
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
                                name: 'Pagos',
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
    }
   