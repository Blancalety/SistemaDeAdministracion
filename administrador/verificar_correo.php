<?php
//inserta
require "funciones/conecta.php";
$con = conecta();

if (isset($_POST['correo'])) {
        $correo = $_POST['correo'];

        // Consulta para verificar si el correo electrónico ya existe
        $sql = "SELECT * FROM empleados WHERE correo = '$correo'";
        $res = $con->query($sql);


        if (isset($_POST['validacion']) && $_POST['validacion'] == true) {
            if ($res->num_rows > 0) {
                echo json_encode(['success' => false, 'message' => 'El correo '. $correo .' ya existe.']);
            } else {
                echo json_encode(['success' => true]);
            }
        } 
    
        else if ($res->num_rows > 0) {
            echo json_encode(['success' => false, 'message' => 'El correo '. $correo .' ya existe.']);
            
        } else {
            echo json_encode(['success' => true]);
            
        }
    }

    //header("Location: empleados_lista.php");

?>
