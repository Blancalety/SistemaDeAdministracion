<?php
// Conexión a la base de datos
require "funciones/conecta.php";
$con = conecta();

// Var recibidas del form
$nombre         = $_REQUEST['nombre'];
$codigo         = $_REQUEST['codigo'];
$descripcion    = $_REQUEST['descripcion'];
$costo          = $_REQUEST['costo'];
$stock          = $_REQUEST['stock'];

// Verificar si se envio el formulario
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // verificar correo electrónico 
    $sql = "SELECT * FROM productos WHERE id = '$id'";
    $res = $con->query($sql);

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
            $sqlArchivo = "SELECT archivo_f, archivo_n FROM productos WHERE id = '$id'";
            $resArchivo = $con->query($sqlArchivo);
            if ($resArchivo->num_rows > 0) {
                $row = $resArchivo->fetch_assoc();
                $fileName1 = $row['archivo_f'];
                $file_name = $row['archivo_n'];
            }
        }

        // actualizar registro en la bd
        $sql = "UPDATE productos SET nombre='$nombre', codigo='$codigo', descripcion='$descripcion', costo=$costo, stock=$stock, archivo_n='$file_name', archivo_f='$fileName1' WHERE id='$id'";
        $res = $con->query($sql);

        if ($res) {
            echo json_encode(['success' => true, 'message' => 'Producto actualizado correctamente.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar Producto.']);
        }
    } else {
        // Si el correo electrónico no existe
        echo json_encode(['success' => false, 'message' => 'El codigo no existe en la base de datos.']);
    }
}

// Cierra la conexión a la bd
$con->close();
?>
