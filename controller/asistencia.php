<?php
require_once("../config/conexion.php");
require_once("../models/Asistencia.php");

$asistencia = new Asistencia();

switch ($_GET["op"]) {

    case "listar":
        $usu_id = $_POST["usu_id"]; // Obtener el ID del usuario del formulario
        $datos = $asistencia->get_asistencia($usu_id); // Pasar el ID del usuario a la función
        $data = array();
    
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["usu_nom"] . " " . $row["usu_apep"]. " " . $row["usu_apem"]; // Nombre completo del usuario
            $sub_array[] = $row["fecha"]; // Fecha de asistencia
            $sub_array[] = $row["hora"]; // Hora de asistencia
            $sub_array[] = $row["latitud"] . ', ' . $row["longitud"]; // Ubicación
            $sub_array[] = '<img src="../../public/fotos_asistencia/'.$row["foto"].'" width="50" height="50" class="img-thumbnail">';
            $sub_array[] = '<button type="button" onClick="editar('.$row["id_asistencia"].');" id="'.$row["id_asistencia"].'" class="btn btn-outline-info btn-icon"><i class="fa fa-eye"></i></button>';
            $sub_array[] = '<button type="button" onClick="eliminar('.$row["id_asistencia"].');" id="'.$row["id_asistencia"].'" class="btn btn-outline-danger btn-icon"><i class="fa fa-times"></i></button>';
    
            $data[] = $sub_array;
        }
    
        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
    
        echo json_encode($results);
        break;

        case "guardaryeditar":
            // Aquí continua el código para guardar los demás datos
            if (empty($_POST["id_asistencia"])) {
                // Si el id_asistencia está vacío, inserta una nueva asistencia
                $asistencia->insert_asistencia(
                    $_POST["usu_id"],
                    $_POST["fecha"],
                    $_POST["foto"],  // El nombre de la imagen que se subió
                    $_POST["latitud"],
                    $_POST["longitud"],
                    $_POST["hora"]
                );
            } else {
                // Si el id_asistencia tiene valor, actualiza la asistencia existente
                $asistencia->update_asistencia(
                    $_POST["id_asistencia"],
                    $_POST["usu_id"],
                    $_POST["fecha"],
                    $_POST["foto"], // La foto guardada o vacía si no se subió
                    $_POST["latitud"],
                    $_POST["longitud"],
                    $_POST["hora"] // La hora recibida del front-end
                );
            }
            break;
        
    
    case "mostrar":
    $datos = $asistencia->get_asistencia_id($_POST["id_asistencia"]);
    if (is_array($datos) == true and count($datos) > 0) {
        foreach ($datos as $row) {
            $output["id_asistencia"] = $row["id_asistencia"];
            $output["usu_id"] = $row["usu_id"];
            $output["fecha"] = $row["fecha"];
            $output["hora"] = $row["hora"];
            $output["latitud"] = $row["latitud"];
            $output["longitud"] = $row["longitud"];
            // También la foto si es necesario
            $output["foto"] = $row["foto"];
        }
        echo json_encode($output);
    }
    break;

    case "eliminar":
        $asistencia->delete_asistencia($_POST["id_asistencia"]);
        break;

    case "combo":
        $datos = $asistencia->get_usuarios();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = "<option label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='".$row['usu_id']."'>".$row['usu_nom']." ".$row['usu_apep']." ".$row['usu_apem']."</option>";
            }
            echo $html;
        }
        break;
}