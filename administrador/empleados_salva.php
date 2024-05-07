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
// $archivo_n      =   '';
// $archivo_f      =   '';
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

            $file_name  = $_FILES['archivo']['name'];       //nombre real del archivo                           <-------name real
            $file_tmp   = $_FILES['archivo']['tmp_name'];   //nombre temporal del archivo                           
            
            $arreglo    = explode(".", $file_name);         //salva el nombre para obtener la extension, donde encuentre el punto se separara
            $len        = count($arreglo);                  //numero de elementos                  
            $pos        = $len-1;                           //posicion a buscar     
            $ext        = $arreglo[$pos];                   //extension     
            
            $dir        = "archivos/";                      //carpeta donde se guardan los archivos
            $file_enc   = md5_file($file_tmp);              //nombre del archivo encriptado                         
            
            if ($file_name != '') {
                $fileName1 = "$file_enc.$ext";
                copy($file_tmp, $dir.$fileName1);//origen destino
            }

                $sql = "INSERT INTO empleados
                (nombre, apellidos, correo, pass, rol, archivo_n, archivo_f)
                VALUES ('$nombre', '$apellidos', '$correo', '$passEnc', $rol, '$file_name', '$fileName1')";
                // echo $res = $con->query($sql);
                $res = $con->query($sql);

        }

        // Cierra la conexión a la base de datos
        $con->close();
    }

    //header("Location: empleados_lista.php");//redireccionamiento, implementar funcion ajax en lista
?>
