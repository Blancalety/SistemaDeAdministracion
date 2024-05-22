<?php 
require "funciones/conecta.php";

$con = conecta();

// Verificar si se proporcionó un ID en la solicitud
if(isset($_POST['id'])){
    $id = $_POST['id']; // Captura el ID del empleado

    $sql = "SELECT id, nombre, codigo, descripcion, costo, stock, archivo_f FROM productos WHERE id = $id"; // Consulta para obtener los detalles

    $res = $con->query($sql); // Ejecuta la consulta

    if ($res->num_rows > 0) { // Verifica si se encontraron resultados
        $producto = $res->fetch_assoc(); // Obtiene los datos del producto

        echo json_encode(['success' => true, 'producto' => $producto]); //Devuelve los detalles en formato JSON
    } else {
        echo json_encode(['success' => false, 'message' => 'Producto no encontrado']); //Si no, mensaje de error
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID de producto no proporcionado']); //Sin ID, devuelve mensaje de error
}

$con->close(); // Cierra la conexión a la base de datos

?>


