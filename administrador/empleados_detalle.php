<?php 
require "funciones/conecta.php";

$con = conecta();

// Verificar si se proporcionó un ID en la solicitud
if(isset($_POST['id'])){
    $id = $_POST['id']; // Captura el ID del empleado

    $sql = "SELECT id, nombre, apellidos, correo, rol, status FROM empleados WHERE id = $id"; // Consulta para obtener los detalles del empleado

    $res = $con->query($sql); // Ejecuta la consulta

    if ($res->num_rows > 0) { // Verifica si se encontraron resultados
        $empleado = $res->fetch_assoc(); // Obtiene los datos del empleado


        echo json_encode(['success' => true, 'empleado' => $empleado]); //Devuelve los detalles en formato JSON
    } else {
        echo json_encode(['success' => false, 'message' => 'Empleado no encontrado']); //Si no, mensaje de error
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID de empleado no proporcionado']); //Sin ID, devuelve mensaje de error
}

$con->close(); // Cierra la conexión a la base de datos

?>



