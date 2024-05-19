<?php
//inserta
require "funciones/conecta.php";
$con = conecta();

if (isset($_POST['codigo'])) {
        $codigo = $_POST['codigo'];

        // Consulta para verificar si el codigo electrónico ya existe
        $sql = "SELECT * FROM productos WHERE codigo = '$codigo'";
        $res = $con->query($sql);


        if (isset($_POST['validacion']) && $_POST['validacion'] == true) {
            if ($res->num_rows > 0) {
                echo json_encode(['success' => false, 'message' => 'El codigo '. $codigo .' ya existe.']);
            } else {
                echo json_encode(['success' => true]);
            }
        } 
    
        else if ($res->num_rows > 0) {
            echo json_encode(['success' => false, 'message' => 'El codigo '. $codigo .' ya existe.']);
            
        } else {
            echo json_encode(['success' => true]);
            
        }
    }


?>
