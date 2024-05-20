<?php
// Conexión a la base de datos
require "funciones/conecta.php";
$con = conecta();

// Var recibidas del form
// $id             = $_REQUEST['id'];
$nombre         = $_POST['nombre'];

// Verificar si se envio el formulario

$id = intval($_POST['id']);
if ($id > 0) {

    // verificar nombre
    $sql = "SELECT * FROM promociones WHERE id = '$id'";
    $res = $con->query($sql);
    echo $res->num_rows;
    if ($res->num_rows > 0) {
        // Actualizar el registro si el codigo ya existe
        // Subir archivo si hay
        if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
            $file_name  = $_FILES['archivo']['name'];       // Nombre real del archivo
            $file_tmp   = $_FILES['archivo']['tmp_name'];   // Nombre temporal del archivo
            $arreglo    = explode(".", $file_name);         // Divide el nombre para obtener la extensión
            $len        = count($arreglo);                  // Número de elementos
            $pos        = $len - 1;                         // Posición de la extensión
            $ext        = $arreglo[$pos];                   // Extensión
            $dir        = "archivos/";                      // Carpeta donde se guardan los archivos
            $file_enc   = md5_file($file_tmp);              // Nombre encriptado del archivo
            $fileName1  = "$file_enc.$ext";                 // Nombre del archivo encriptado + extensión

            // Mover el archivo al dir
            move_uploaded_file($file_tmp, $dir . $fileName1);
        } else {
            //  mantener el valor existente en la bd
            $sqlArchivo = "SELECT archivo FROM promociones WHERE id = '$id'";
            $resArchivo = $con->query($sqlArchivo);
            if ($resArchivo->num_rows > 0) {
                $row = $resArchivo->fetch_assoc();
                $fileName1 = $row['archivo'];
            }
        }

        // actualizar registro en la bd
        $sql = "UPDATE promociones SET nombre='$nombre', archivo='$fileName1' WHERE id='$id'";
        $res = $con->query($sql);

        if ($res) {
            echo json_encode(['success' => true, 'message' => 'Actualizado correctamente.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar Promocion.']);
        }
    } else {
        // Si no existe
        echo json_encode(['success' => false, 'message' => 'El nombrePromo no existe en la base de datos.']);
    }

}else {
    // Si no se ha enviado el formulario
    echo json_encode(['success' => false, 'message' => 'No se han enviado datos.']);
}
// Cierra la conexión a la bd
$con->close();
?>
