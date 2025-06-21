<?php
$uploadDirectory = '../public/fotos_asistencia/'; // Asegúrate de que esta ruta sea correcta

// Asegurarse de que el directorio de destino exista y sea escribible
if (!is_dir($uploadDirectory)) {
    mkdir($uploadDirectory, 0777, true);  // Crea el directorio si no existe
}

$response = array(); // Array para almacenar la respuesta

if (isset($_FILES['capturedImage']) && !empty($_FILES['capturedImage']['tmp_name'])) {
    $uploadedFile = $_FILES['capturedImage']['tmp_name'];

    // Obtener la extensión del archivo y verificar que sea una imagen válida
    $extension = strtolower(pathinfo($_FILES['capturedImage']['name'], PATHINFO_EXTENSION));
    $validExtensions = array("jpg", "jpeg", "png"); // Extensiones permitidas

    if (in_array($extension, $validExtensions)) {
        // Generar un nombre único para la imagen
        $newFileName = uniqid() . '.' . $extension;
        $destination = $uploadDirectory . $newFileName;

        if (move_uploaded_file($uploadedFile, $destination)) {
            $response['status'] = 'success';
            $response['message'] = 'Imagen subida exitosamente';
            $response['fileName'] = $newFileName;  // Aquí puedes devolver el nombre de la imagen
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error al mover la imagen al directorio de destino.';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Tipo de archivo no permitido. Solo se permiten imágenes jpg, jpeg y png.';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'No se recibió ninguna imagen.';
}

echo json_encode($response); // Devolver la respuesta en formato JSON
?>
