<?php
//archivo de conexión a la base de datos
require "funciones/conecta.php";

//establece conexión
$con = conecta();

//Verifica envio de datos del formulario
if (isset($_POST['id'])) {
    //Captura ID de empleado desde formulario
    $id = $_POST['id'];

    //verifica si existe en la bd
    $sql = "SELECT * FROM empleados WHERE id = '$id'";
    $res = $con->query($sql);

    if ($res->num_rows > 0) {
        // Si el empleado existe, actualizar sus datos
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $pass = $_POST['pass']; 
        $correo = $_POST['correo'];
        $rol = $_POST['rol'];
        $archivo_n = ''; 
        $archivo_f = ''; 

        //cifrar contraseña
        $passEnc = md5($pass); 

        //Consulta para actualizar los datos del empleado
        $sql_update = "UPDATE empleados SET 
                            nombre = '$nombre', 
                            apellidos = '$apellidos',  
                            pass = '$passEnc',
                            correo = '$correo', 
                            rol = $rol, 
                            archivo_n = '$archivo_n', 
                            archivo_f = '$archivo_f' 
                        WHERE id = $id";

        //Ejecuta consulta de actualización
        echo $res_update = $con->query($sql_update);

        if ($res_update) {
            //la actualización fue exitosa
            echo json_encode(['success' => true, 'message' => 'Los datos del empleado se actualizaron correctamente.']);
        } else {
            //falló
            echo json_encode(['success' => false, 'message' => 'Error al actualizar los datos del empleado.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'El empleado no existe en la base de datos.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No se han recibido datos del formulario para actualizar.']);
}

//cerrar la conexión a la bd
$con->close();

//header("Location: empleados_lista.php");
?>
