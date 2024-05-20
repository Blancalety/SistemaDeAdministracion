<?php 
require "funciones/conecta.php";

$con = conecta();

// Verificar si se proporcionó un ID en la solicitud
if(isset($_POST['id'])){
    $id = $_POST['id']; // Captura el ID 

    $sql = "SELECT id, nombre, status, archivo FROM promociones WHERE id = $id"; // Consulta para obtener los detalles 

    $res = $con->query($sql); // Ejecuta la consulta

    if ($res->num_rows > 0) { // Verifica si se encontraron resultados
        $promocion = $res->fetch_assoc(); // Obtiene los datos 

        echo json_encode(['success' => true, 'promocion' => $promocion]); //Devuelve los detalles en formato JSON
    } else {
        echo json_encode(['success' => false, 'message' => 'Promocion no encontrada']); //Si no, mensaje de error
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID de promocion no proporcionado']); //Sin ID, devuelve mensaje de error
}

$con->close(); // Cierra la conexión a la base de datos

?>


