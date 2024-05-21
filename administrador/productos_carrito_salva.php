<?php

session_start();

require "funciones/conecta.php";
$con = conecta();

$id_usuario = $_SESSION['idUser']; 

// Confirmar compra---------------------------------------------------------------------------
if (isset($_GET['confirmar_compra']) && $_GET['confirmar_compra'] == 1) {
    $sql = "UPDATE pedidos SET status = 1 WHERE id_usuario = $id_usuario AND status = 0";
    if ($con->query($sql) === TRUE) {
        $_SESSION['notification'] = "Compra confirmada con éxito.";
    } else {
        $_SESSION['notification'] = "Hubo un error al confirmar la compra: " . $con->error;
    }
    
}

exit();

//Mostrar notificación si existe
if (isset($_SESSION['notification'])) {
    echo "<script>alert('" . $_SESSION['notification'] . "');</script>";
    unset($_SESSION['notification']);
}

// Confirmar compra---------------------------------------------------------------------------

$con->close();

header("Location: productos_lista.php");
?>