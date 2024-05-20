<?php 
require "funciones/conecta.php";

$con = conecta();

$id = $_REQUEST['id'];//cacho el id que quiero borrar
//$sql = "DELETE FROM empleados WHERE id = $id";//y lo borro

//Pero usaremos la bandera para de manera logica indicar que fue eliminado:
$sql = "UPDATE promociones 
        SET eliminado = 1
        WHERE id = $id";//y lo borro de manera logica.

//$res= $con->query($sql);

if ($con->query($sql) === TRUE) {
        //devuelve un JSON con un objeto con clave success => valor true.
        echo json_encode(['success' => true]);
    } else {
        //clave message que contiene el mensaje de error generado por la base de datos 
        echo json_encode(['success' => false, 'message' => $con->error]);
    }
    
    $con->close();//cerrar la conexión activa con la base de datos en PHP

//header('Location: empleados_lista.php');
?>