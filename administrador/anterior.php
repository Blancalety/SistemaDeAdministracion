<?php
//actualiza insercion
require "funciones/conecta.php";

$con = conecta();

if (isset($_POST['id'])) {
    $id = $_POST['id'];// Captura el correo del empleado

    // Consulta para verificar si el correo electrónico ya existe
    $sql = "SELECT * FROM empleados WHERE id = '$id'";
    $res = $con->query($sql);// Ejecuta la consulta


    if ($res->num_rows > 0) {

        echo json_encode(['success' => true]);
            $sql = 
            "UPDATE empleados
            SET nombre = '$nombre', apellidos = '$apellidos', correo = '$correo', pass = '$passEnc', rol = $rol, archivo_n = '$archivo_n', archivo_f = '$archivo_f'
            WHERE id = $id";

            $res = $con->query($sql);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error en empleados_editar']);
    }
}else{
        echo json_encode(['success' => false, 'message' => 'El empleado no existe.']);
}

?>


<?php
//actualiza insercion
require "funciones/conecta.php";

$con = conecta();

if (isset($_POST['id'])) {
    $id = $_POST['id'];// Captura el correo del empleado

    // Consulta para verificar si el correo electrónico ya existe
    $sql = "SELECT * FROM empleados WHERE id = '$id'";
    $res = $con->query($sql);// Ejecuta la consulta


    if ($res->num_rows > 0) {

        echo json_encode(['success' => true]);
            
    } else {
        echo json_encode(['success' => false, 'message' => 'Error en empleados_editar']);
    }
}else{
        echo json_encode(['success' => false, 'message' => 'El empleado no existe.']);
}

?>