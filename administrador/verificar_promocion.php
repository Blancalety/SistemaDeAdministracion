<?php
//inserta
require "funciones/conecta.php";
$con = conecta();

if (isset($_POST['nombre'])) {
        $nombre = $_POST['nombre'];

        // Consulta para verificar si el nombre ya existe
        $sql = "SELECT * FROM promociones WHERE nombre = '$nombre'";
        $res = $con->query($sql);


        if (isset($_POST['validacion']) && $_POST['validacion'] == true) {
            if ($res->num_rows > 0) {
                echo json_encode(['success' => false, 'message' => 'Esta promocion '. $nombre .' ya existe.']);
            } else {
                echo json_encode(['success' => true]);
            }
        } 
    
        else if ($res->num_rows > 0) {
            echo json_encode(['success' => false, 'message' => 'Esta promocion:  '. $nombre .' ya existe.']);
            
        } else {
            echo json_encode(['success' => true]);
            
        }
    }

?>
