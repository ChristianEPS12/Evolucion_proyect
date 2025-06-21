<?php
    
    //Llamando a la cadena de Conexion
    require_once("../config/conexion.php");

    //llamando a la clase
    require_once("../models/Instructor.php");

    //inicializando clase
    $instructor = new Instructor();

    //opcion de solicitud de controller
    switch ($_GET["op"]) {

        // Guardar y editar cuando se tenga el ID
        case "guardaryeditar":
            if(empty($_POST["inst_id"])){
                $instructor->insert_instructor($_POST["inst_nom"], $_POST["inst_apep"], $_POST["inst_apem"], $_POST["inst_correo"], $_POST["inst_sex"], $_POST["isnt_telf"]);
            }else{
                $instructor->update_instructor($_POST["inst_id"],$_POST["inst_nom"], $_POST["inst_apep"], $_POST["inst_apem"], $_POST["inst_correo"], $_POST["inst_sex"], $_POST["isnt_telf"]);
            }
            break;
        
        //Creando Json segun el ID
        case "mostrar":
            $datos = $instructor->get_instructor_id($_POST["inst_id"]);
            if(is_array($datos) == true and count($datos) > 0){
                foreach($datos as $row){
                    $output["inst_id"] = $row["inst_id"];
                    $output["inst_nom"] = $row["inst_nom"];
                    $output["inst_apep"] = $row["inst_apep"];
                    $output["inst_apem"] = $row["inst_apem"];
                    $output["inst_correo"] = $row["inst_correo"];
                    $output["inst_sex"] = $row["inst_sex"];
                    $output["isnt_telf"] = $row["isnt_telf"];
                }
                echo json_encode($output);
            }
            break;
        
        //Eliminar segun ID
        case "eliminar":
            $instructor->delete_instructor($_POST["inst_id"]);
            break;

        //listar toda la informacion segun formato de datatable
        case "listar":
            $datos = $instructor->get_instructor();
            $data = array();
    
            foreach ($datos as $row) {
                $sub_array = array();
                // Agregar cada columna al array en lugar de sobrescribirlo
                $sub_array[] = $row["inst_nom"];
                $sub_array[] = $row["inst_apep"];
                $sub_array[] = $row["inst_apem"];
                $sub_array[] = $row["inst_correo"];
                $sub_array[] = $row["isnt_telf"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["inst_id"].');" id="'.$row["inst_id"].'" class="btn btn-outline-warning btn-icon"><i class="fa fa-edit"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["inst_id"].');" id="'.$row["inst_id"].'" class="btn btn-outline-danger btn-icon"><i class="fa fa-times"></i></button>';

                $data[] = $sub_array;
            }
            
            // Devolver los resultados en formato JSON
            $results = array(
                "sEcho" => 1,
                "iTotalRecords" => count($data),
                "iTotalDisplayRecords" => count($data),
                "aaData" => $data
            );
            
            echo json_encode($results);
            break;
        
        case "combo":
            $datos = $instructor->get_instructor();
            if (is_array($datos) == true and count($datos) > 0) {
                $html = "<option value='' disabled selected>Seleccione</option>";
                foreach ($datos as $row) {
                    $html .= "<option value='".$row['inst_id']."'>".$row['inst_nom']." ".$row['inst_apep']." ".$row['inst_apem']."</option>";
                }
            }
            echo $html;
            break;
    }
?>