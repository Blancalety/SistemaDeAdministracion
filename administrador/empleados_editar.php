<?php
// Archivo de conexión a la base de datos
require "funciones/conecta.php";

// Establece conexión
$con = conecta();

// Verifica envío de datos del formulario
if (isset($_POST['id'])) {
    // Captura ID de empleado desde formulario
    $id = $_POST['id'];

    // Verifica si existe en la BD
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
 

        // Cifrar contraseña
        $passEnc = md5($pass); 

        // Consulta para actualizar los datos del empleado
        $sql_update = "UPDATE empleados SET 
                        nombre = '$nombre', 
                        apellidos = '$apellidos',  
                        pass = '$passEnc',
                        correo = '$correo', 
                        archivo_n = '',
                        archivo_f = '',
                        rol = $rol";

        // Verifica si se proporciona una nueva foto
        if (!empty($_FILES['archivo']['name'])) {
            $file_name  = $_FILES['archivo']['name'];       // Nombre real del archivo
            $file_tmp   = $_FILES['archivo']['tmp_name'];   // Nombre temporal del archivo
            
            $file_name  = $_FILES['archivo']['name'];       //nombre real del archivo                           <-------name real
            $file_tmp   = $_FILES['archivo']['tmp_name'];   //nombre temporal del archivo                           
            $arreglo    = explode(".", $file_name);         //salva el nombre para obtener la extension, donde encuentre el punto se separara
            $len        = count($arreglo);                  //numero de elementos                  
            $pos        = $len-1;                           //posicion a buscar     
            $ext        = $arreglo[$pos];                   //extension     
            $dir        = "archivos/";                      //carpeta donde se guardan los archivos
            $file_enc   = md5_file($file_tmp);              //nombre del archivo encriptado    

            $dir = "archivos/";  // Carpeta donde se guardan los archivos
            $file_enc = md5_file($file_tmp);  // Nombre del archivo encriptado
            $fileName1 = "$file_enc.$ext";  
            copy($file_tmp, $dir.$fileName1); 
            
            // Agregar campos de archivo_n y archivo_f en la consulta de actualización
            $sql_update .= ", archivo_n = '$file_name', archivo_f = '$fileName1'";
        }

        $sql_update .= " WHERE id = $id";

        // Ejecuta consulta de actualización
        $res_update = $con->query($sql_update);

        if ($res_update) {
            echo json_encode(['success' => true, 'message' => 'Los datos del empleado se actualizaron correctamente.']);
        } else {
            // Falló
            echo json_encode(['success' => false, 'message' => 'Error al actualizar los datos del empleado.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'El empleado no existe en la base de datos.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No se han recibido datos del formulario para actualizar.']);
}

// Cerrar la conexión a la BD
$con->close();
?>
