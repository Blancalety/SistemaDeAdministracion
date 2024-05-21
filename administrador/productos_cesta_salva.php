<?php
// agregarProducto.php
session_start();

date_default_timezone_set('America/Mexico_City');
require "funciones/conecta.php";
$con = conecta();

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

// Recibe variables
$id_producto  = $_POST['id_producto'];
$cantidad = $_POST['cantidad'];
// $costo = $_POST['costo'];
$id_usuario = $_SESSION['idUser'];

// Verificar que la cantidad sea un número positivo
if ($cantidad <= 0) {
    echo 0;
    exit();
}

// Obtener id_pedido
$sql = "SELECT * FROM pedidos WHERE id_usuario = $id_usuario AND status = 0";
$res = $con->query($sql);
$num = $res->num_rows;


if ($num == 0) {
    // Establecer la zona horaria de Guadalajara
    $zona_horaria = new DateTimeZone('America/Mexico_City');
    // Obtener la fecha y hora actual en la zona horaria de Guadalajara
    $fecha_hora = new DateTime('now', $zona_horaria);
    $fecha = (new DateTime())->format('Y-m-d H:i:s');
    $sql = "INSERT INTO pedidos (fecha, id_usuario) VALUES ('$fecha', $id_usuario)";
    $con->query($sql);
    $id_pedido = $con->insert_id; // Obtener el id del nuevo pedido
} else {
    $row = $res->fetch_assoc();
    $id_pedido = $row['id'];
}

// Obtener precio del producto
$sql = "SELECT costo FROM productos WHERE id = $id_producto";
$res = $con->query($sql);
$num = $res->num_rows;

if ($num > 0) {
    $row = $res->fetch_assoc();
    $costo = $row['costo'];
} else {
    echo 0;
    exit();
}

// Verificar si ya se está pidiendo ese producto
$sql = "SELECT * FROM pedidos_productos WHERE id_producto = $id_producto AND id_pedido = $id_pedido";
$res = $con->query($sql);
$num = $res->num_rows;

if ($num == 0) {
    // Insertar nuevo producto en el pedido
    $sql = "INSERT INTO pedidos_productos (id_pedido, id_producto, cantidad, precio) VALUES ($id_pedido, $id_producto, $cantidad, $costo)";
} else {
    // Actualizar la cantidad del producto en el pedido existente
    $sql = "UPDATE pedidos_productos SET cantidad = cantidad + $cantidad WHERE id_producto = $id_producto AND id_pedido = $id_pedido";
}

// if ($con->query($sql) === TRUE) {
//     header("Location: productos_lista.php");
//     //echo 1;
// } 

// else {
//     echo 0;
// }

//$con->close();

if ($con->query($sql) === TRUE) {
    $_SESSION['notification'] = "El producto se ha agregado correctamente al pedido.";
} else {
    $_SESSION['notification'] = "Hubo un error al agregar el producto al pedido.";
}

$con->close();

header("Location: productos_lista.php");


?>




























<!-- <?php
// Datos de los productos del pedido (por ejemplo, enviados desde un formulario)
$productos = $_POST['productos']; // Suponiendo que productos es un array de IDs de productos

foreach ($productos as $producto_id) {
    // Insertar cada producto en la tabla pedidos_producto
    $sqlPedidoProducto = "INSERT INTO pedidos_producto (pedido_id, producto_id) VALUES ('$pedido_id', '$producto_id')";
    if ($con->query($sqlPedidoProducto) === TRUE) {
        echo "Producto $producto_id agregado al pedido $pedido_id con éxito.<br>";
    } else {
        echo "Error al insertar el producto $producto_id: " . $sqlPedidoProducto . "<br>" . $con->error;
    }
}

// Cerrar la conexión a la base de datos
$con->close();
?> -->
