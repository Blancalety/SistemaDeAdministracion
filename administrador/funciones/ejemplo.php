<!DOCTYPE html>
<html lang="es">

<style>
    .titulo {
    font-size: 1.5em;
    font-weight: bold;
    margin-bottom: 20px;
}


</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario con Select</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        //js
        
    </script>

</head>
<body>
<?php

//require 'funciones/conecta.php';
require __DIR__ . '/conecta.php';
//require 'administrador/funciones/conecta.php';

$con = conecta();

$sql = "SELECT * FROM empleados
        WHERE status = 1 AND eliminado = 0";//activos y no eliminados
        //ejecuto cconsulta
$res = $con->query($sql);//se ejecuta un query en la conexion,consulta en $con
$num = $res->num_rows;

//echo "Lista de empleados ($num) <br><br>";
echo "<div class='titulo'>Lista de empleados ($num)</div><br><br>";

//tomar pimer fila y convertirlo en un arreglo
//fila en cada ciclo y accedo a esa posicion de mi arreglo llamado row 
while($row = $res->fetch_array()) {
    $id = $row["id"];
    $nombre = $row["nombre"];
    $apellidos = $row["apellidos"];
    $correo = $row["correo"];
}
//rol: gerente o ejecutivo

?>
</body>
</html>