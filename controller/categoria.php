<?php
    
    //Llamando a la cadena de Conexion
    require_once("../config/conexion.php");

    //llamando a la clase
    require_once("../models/Categoria.php");

    //inicializando clase
    $categoria = new Categoria();

    //opcion de solicitud de controller
    switch ($_GET["op"]) {

        // Guardar y editar cuando se tenga el ID
        case "guardaryeditar":
            if(empty($_POST["cat_id"])){
                $categoria->insert_categoria($_POST["cat_nom"]);
            }else{
                $categoria->update_categoria($_POST["cat_id"],$_POST["cat_nom"]);
            }
            break;
        
        //Creando Json segun el ID
        case "mostrar":
            $datos = $categoria->get_categoria_id($_POST["cat_id"]);
            if(is_array($datos) == true and count($datos) > 0){
                foreach($datos as $row){
                    $output["cat_id"] = $row["cat_id"];
                    $output["cat_nom"] = $row["cat_nom"];
                }
                echo json_encode($output);
            }
            break;
        
        //Eliminar segun ID
        case "eliminar":
            $categoria->delete_categoria($_POST["cat_id"]);
            break;

        //listar toda la informacion segun formato de datatable
        case "listar":
            $datos = $categoria->get_categoria();
            $data = array();
    
            foreach ($datos as $row) {
                $sub_array = array();
                // Agregar cada columna al array en lugar de sobrescribirlo
                $sub_array[] = $row["cat_nom"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["cat_id"].');" id="'.$row["cat_id"].'" class="btn btn-outline-warning btn-icon"><i class="fa fa-edit"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["cat_id"].');" id="'.$row["cat_id"].'" class="btn btn-outline-danger btn-icon"><i class="fa fa-times"></i></button>';

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
            $datos = $categoria->get_categoria();
            if (is_array($datos) == true and count($datos) > 0) {
                $html = "<option value='' disabled selected>Seleccione</option>";
                foreach ($datos as $row) {
                    $html .= "<option value='".$row['cat_id']."'>".$row['cat_nom']."</option>";
                }
            }
            echo $html;
            break;
    }
?>