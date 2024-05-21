<?php
// Conexión a la base de datos
require "funciones/conecta.php";
$con = conecta();

// Datos del pedido
$cliente_id = $_POST['cliente_id'];
$fecha = date('Y-m-d H:i:s');

// Insertar pedido
$sqlPedido = "INSERT INTO pedidos (cliente_id, fecha) VALUES ('$cliente_id', '$fecha')";
if ($con->query($sqlPedido) === TRUE) {
    $pedido_id = $con->insert_id; // Obtener el ID del nuevo pedido
    echo "Pedido insertado con éxito. ID del pedido: " . $pedido_id;
} else {
    echo "Error: " . $sqlPedido . "<br>" . $con->error;
    exit();
}
?>


