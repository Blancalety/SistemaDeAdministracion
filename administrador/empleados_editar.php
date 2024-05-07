<?php
// Conexión a la base de datos
require "funciones/conecta.php";
$con = conecta();

// Var recibidas del form
$nombre     = $_REQUEST['nombre'];
$apellidos  = $_REQUEST['apellidos'];
$correo     = $_REQUEST['correo'];
$pass       = $_REQUEST['pass'];
$rol        = $_REQUEST['rol'];
$passEnc    = md5($pass); // Encriptación de la contraseña

// Verificar si se envio el formulario
if (isset($_POST['correo'])) {
    $correo = $_POST['correo'];

    // verificar correo electrónico 
    $sql = "SELECT * FROM empleados WHERE correo = '$correo'";
    $res = $con->query($sql);

    if ($res->num_rows > 0) {
        // Actualizar el registro si el correo electrónico ya existe
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
            $sqlArchivo = "SELECT archivo_f, archivo_n FROM empleados WHERE correo = '$correo'";
            $resArchivo = $con->query($sqlArchivo);
            if ($resArchivo->num_rows > 0) {
                $row = $resArchivo->fetch_assoc();
                $fileName1 = $row['archivo_f'];
                $file_name = $row['archivo_n'];
            }
        }

        // actualizar registro en la bd
        $sql = "UPDATE empleados SET nombre='$nombre', apellidos='$apellidos', pass='$passEnc', rol=$rol, archivo_n='$file_name', archivo_f='$fileName1' WHERE correo='$correo'";
        $res = $con->query($sql);

        if ($res) {
            echo json_encode(['success' => true, 'message' => 'Empleado actualizado correctamente.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar empleado.']);
        }
    } else {
        // Si el correo electrónico no existe
        echo json_encode(['success' => false, 'message' => 'El correo electrónico no existe en la base de datos.']);
    }
}

// Cierra la conexión a la bd
$con->close();
?>
