<?php
//inserta
require "funciones/conecta.php";
$con = conecta();

//Recibe variables, request viene del name.
$nombre         =   $_REQUEST['nombre'];
$apellidos      =   $_REQUEST['apellidos'];
$correo         =    $_REQUEST['correo'];
$pass           =   $_REQUEST['pass'];
$rol            =   $_REQUEST['rol'];
$archivo_n      =   '';
$archivo_f      =   '';
$passEnc = md5($pass);//cadena encriptada de la contrasenia, metodo de encriptacion md5.

if (isset($_POST['correo'])) {
        $correo = $_POST['correo'];
    
        // Consulta para verificar si el correo electrónico ya existe
        $sql = "SELECT * FROM empleados WHERE correo = '$correo'";
        $res = $con->query($sql);
        
    
        if ($res->num_rows > 0) {
            echo json_encode(['success' => false, 'message' => 'El correo electrónico ya existe.']);
        } else {
            echo json_encode(['success' => true]);
                $sql = "INSERT INTO empleados
                (nombre, apellidos, correo, pass, rol, archivo_n, archivo_f)
                VALUES ('$nombre', '$apellidos', '$correo', '$passEnc', $rol, '$archivo_n', '$archivo_f')";
                echo $res = $con->query($sql);
        }

        // Cierra la conexión a la base de datos
        $con->close();
    }

    header("Location: empleados_lista.php");//redireccionamiento, implementar funcion ajax en lista
?>
