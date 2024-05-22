<?php
//inserta
require "funciones/conecta.php";
$con = conecta();

//Recibe variables, request viene del name.
$nombre         =   $_REQUEST['nombre'];
$correo         =    $_REQUEST['correo'];
$pass           =   $_REQUEST['pass'];
$passEnc = md5($pass);//cadena encriptada de la contrasenia, metodo de encriptacion md5.

if (isset($_POST['correo'])) {
        $correo = $_POST['correo'];
    
        // Consulta para verificar si el correo electrónico ya existe
        $sql = "SELECT * FROM cliente WHERE correo = '$correo'";
        $res = $con->query($sql);
        
    
        if ($res->num_rows > 0) {
            echo json_encode(['success' => false, 'message' => 'El correo electrónico ya existe.']);
        } else {
            echo json_encode(['success' => true]);

            $sql = "INSERT INTO cliente
            (nombre, correo, pass)
            VALUES ('$nombre', '$correo', '$passEnc')";
            // echo $res = $con->query($sql);
            $res = $con->query($sql);

        }

        // Cierra la conexión a la base de datos
        $con->close();
    }

    //header("Location: empleados_lista.php");//redireccionamiento, implementar funcion ajax en lista
?>
