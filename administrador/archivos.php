<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archivos</title>

    
<style>
    .rounded {
        border-radius: 50%; /* Imagen redonda */
        margin-top: 10px;
    }

    body {
        font-family: Verdana, Geneva, sans-serif;
    }

</style>

</head>
<body>

<?php

$file_name  = $_FILES['archivo']['name'];       //nombre real del archivo                           <-------name real
$file_tmp   = $_FILES['archivo']['tmp_name'];   //nombre temporal del archivo                           

$arreglo    = explode(".", $file_name);         //salva el nombre para obtener la extension, donde encuentre el punto se separara
$len        = count($arreglo);                  //numero de elementos                  
$pos        = $len-1;                           //posicion a buscar     
$ext        = $arreglo[$pos];                   //extension     

$dir        = "archivos/";                      //carpeta donde se guardan los archivos
$file_enc   = md5_file($file_tmp);              //nombre del archivo encriptado                         

echo "file_name: $file_name  <br>";
echo "file_tmp:  $file_tmp   <br>";
echo "ext:       $ext        <br>";
echo "file_enc:  $file_enc   <br>";

if ($file_name != '') {
    $fileName1 = "$file_enc.$ext";
    copy($file_tmp, $dir.$fileName1);//origen destino
    echo "Name encriptado con extension: $fileName1  <br>";                                             //<-------nuevo name
    // Mostrar la imagen utilizando la etiqueta <img>
    echo "<img src='$dir$fileName1' alt='Imagen' class='rounded' style='width: 200px; height: 250px;'>";
}

?>
    
</body>
</html>

