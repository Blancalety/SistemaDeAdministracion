<?php
//inserta
require "funciones/conecta.php";
$con = conecta();

//Recibe variables, request viene del name.
$nombre         =   $_REQUEST['nombre'];

if (isset($_POST['nombre'])) {
        $nombre = $_POST['nombre'];
    
        // Consulta para verificar si el nombre ya existe
        $sql = "SELECT * FROM promociones WHERE nombre = '$nombre'";
        $res = $con->query($sql);
        
    
        if ($res->num_rows > 0) {
            echo json_encode(['success' => false, 'message' => 'El nombre de la promo ya existe.']);
        } else {
            echo json_encode(['success' => true]);

            $file_name  = $_FILES['archivo']['name'];       //nombre real del archivo                          
            $file_tmp   = $_FILES['archivo']['tmp_name'];   //nombre temporal del archivo                           
            
            $arreglo    = explode(".", $file_name);         //salva el nombre para obtener la extension, donde encuentre el punto se separara
            $len        = count($arreglo);                  //numero de elementos                  
            $pos        = $len-1;                           //posicion a buscar     
            $ext        = $arreglo[$pos];                   //extension     
            
            $dir        = "archivos/";                      //carpeta donde se guardan los archivos
            $file_enc   = md5_file($file_tmp);              //nombre del archivo encriptado                         
            
            if ($file_name != '') {
                $fileName1 = "$file_enc.$ext";
                copy($file_tmp, $dir.$fileName1);//origen-destino
            }

                $sql = "INSERT INTO promociones
                (nombre, archivo)
                VALUES ('$nombre', '$fileName1')";
                // echo $res = $con->query($sql);
                $res = $con->query($sql);

        }

        // Cierra la conexión a la base de datos
        $con->close();
    }
    
?>
