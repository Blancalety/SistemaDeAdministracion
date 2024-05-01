<?php
// Incluir el archivo de conexión a la base de datos
require "funciones/conecta.php";

// Establecer la conexión
$con = conecta();

// Verificar si se han enviado datos del formulario
if (isset($_POST['id'])) {
    // Capturar el ID del empleado desde el formulario
    $id = $_POST['id'];

    // Verificar si el empleado existe en la base de datos
    $sql = "SELECT * FROM empleados WHERE id = '$id'";
    $res = $con->query($sql);

    if ($res->num_rows > 0) {
        // Si el empleado existe, actualizar sus datos
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $pass = $_POST['pass']; // Contraseña sin cifrar
        $correo = $_POST['correo'];
        $rol = $_POST['rol'];
        $archivo_n = ''; // Nombre del archivo si se está actualizando
        $archivo_f = ''; // Contenido del archivo si se está actualizando

        // Cifrar la contraseña antes de almacenarla
        $passEnc = md5($pass); // Usar un método de cifrado seguro en producción

        // Consulta para actualizar los datos del empleado
        $sql_update = "UPDATE empleados SET 
                            nombre = '$nombre', 
                            apellidos = '$apellidos',  
                            pass = '$passEnc',
                            correo = '$correo', 
                            rol = $rol, 
                            archivo_n = '$archivo_n', 
                            archivo_f = '$archivo_f' 
                        WHERE id = $id";

        // Ejecutar la consulta de actualización
        echo $res_update = $con->query($sql_update);

        if ($res_update) {
            // Si la actualización fue exitosa, devolver un mensaje de éxito
            echo json_encode(['success' => true, 'message' => 'Los datos del empleado se actualizaron correctamente.']);
        } else {
            // Si la actualización falló, devolver un mensaje de error
            echo json_encode(['success' => false, 'message' => 'Error al actualizar los datos del empleado.']);
        }
    } else {
        // Si el empleado no existe, devolver un mensaje de error
        echo json_encode(['success' => false, 'message' => 'El empleado no existe en la base de datos.']);
    }
} else {
    // Si no se enviaron datos del formulario, devolver un mensaje de error
    echo json_encode(['success' => false, 'message' => 'No se han recibido datos del formulario para actualizar.']);
}

// Cerrar la conexión a la base de datos
$con->close();
header("Location: empleados_lista.php");
?>
