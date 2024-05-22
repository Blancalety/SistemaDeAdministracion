<?php

// session_name('user_session');
session_start();
require "funciones/conecta.php";
$con = conecta();

if (isset( $_POST['correo']) && isset($_POST['pass'])) {
        $correo = $_POST['correo'];
        $pass = md5($_POST['pass']);
    
        // Consulta para verificar 
        $sql = "SELECT * FROM cliente WHERE correo = '$correo' AND pass = '$pass' AND status = 1 AND eliminado = 0";
        $res = $con->query($sql);
        $num = $res->num_rows;
        
    
        if ($num > 0) {
            $row = $res->fetch_array();
            $id = $row["id"];
            $nombre = $row["nombre"];
            $correo = $row["correo"];

            $_SESSION['idUser'] = $id;
            $_SESSION['nombreUser'] = $nombre;
            $_SESSION['correoUser'] = $correo;
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error en los datos o usuario inexistente']);

        }
    }


?>
