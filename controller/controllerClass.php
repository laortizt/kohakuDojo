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

            $select = '<select class="select-instructor" name="select-instructor" required="">';
            
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


        public function save_class(){
            // Limpiar la información diligenciada
            $day= mainModel::clean_string($_POST['class-date']);
            $teacher= mainModel::clean_string($_POST['select-instructor']); 
            $topic= mainModel::clean_string($_POST['topic']);
            
            $phpDate = strtotime($day);            
            $day = date('c', $phpDate);
            
            
            // Validar condiciones SI YA HAY UNA CLASEREGISTRADA EN EL MISMO HORARIO
            // $classById=modelClass::find_class($day);

            // if (count($classById) > 1 || 
            //     (count($classById) == 1 && $classById[0]['classDate'] != $day) )
            // {
            //     $alert=[
            //         "alert"=>"simple",
            //         "title"=>"Ocurrio un error inesperado",
            //         "text"=>"Ya hay una clase registrada a esa hora",
            //         "type"=>"error"
            //     ];
            // }else {
            //     $id = $$classById[0]['idAccount'];

                // Si todas se cumplen, llamar al modelo para que ejecute el cambio, enviando la info en un arreglo
                $dataClass = [
                    "Date"=>$day,
                    "Teacher"=>$teacher,
                    "Topic"=>$topic,
                ];

                $saveClass = modelClass::update_class_model($dataClass);

                // Verificar si el cambió se aplico e informar al usuario
                if($saveClass->rowCount() >= 1){
                    $alert=[
                        "alert"=>"limpiar",
                        "title"=>"Actualizar Clase",
                        "text"=>"La Clase se ha creado exitósamente.",
                        "type"=>"success"
                    ];
                } else {
                    $alert=[
                        "alert"=>"simple",
                        "title"=>"Actualizar clase",
                        "text"=>"No se pudo crear la clase, verifique que no hay más clases en ese horario.",
                        "type"=>"error"
                    ];
                }
            // }

            return mainModel::sweet_alert($alert);
        }
    }