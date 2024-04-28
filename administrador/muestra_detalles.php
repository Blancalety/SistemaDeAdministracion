<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles</title>


    <style>

        body {
            background-color: #f2f2f2;
        }

        .titulo {
            font-family: 'Verdana', sans-serif;
            font-size: 1.5em;
            font-weight: bold;
            margin-top: 30px;
            margin-bottom: 20px;
            text-align: center;
        }

        .boton {
            background: rgb(255, 255, 153);
            margin-left: 20rem;
        }

        .link {
            color: black;
            font-family: Arial, sans-serif;
            font-size: 1em;
            font-weight: bold;
            box-shadow: 
                0 0 20px rgba(0, 0, 0, 0.7), /* Primera sombra */
                0 0 30px rgba(0, 0, 255, 0.2); /* Segunda sombra */
            padding: 10px;
            border-radius: 9px;
            text-decoration: none;
        }

        .fila {
            display: table-row;
            background-color: lightgrey;
        }

        .celda {
            display: table-cell;
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
            border-radius: 9px;
        }

        .header {
            font-weight: bold;
            color: lightgrey;
            background-color: #f2f2f2;
        }

        .header .celda {
            background-color: cornflowerblue;
            color: whitesmoke;
        }

        .table {
            display: table;
            width: 65%;
            margin-top: 25px;
            font-family: Arial, sans-serif;
            border: 1px solid #000;
            border-radius: 3px;
            margin-left: auto;  /* Ajusta el margen izquierdo a automático para centrar */
            margin-right: auto;
        }

    </style>

</head>
<body>

    <?php

    require "funciones/conecta.php";

    $con = conecta();

    // Obtener los detalles del empleado de los parámetros GET
    $nombre = $_GET['nombre'];
    $apellidos = $_GET['apellidos'];
    $correo = $_GET['correo'];
    $rol = $_GET['rol'];
    $roles = [
        1 => 'Gerente',
        2 => 'Ejecutivo',
    ];
    $rols = isset($roles[$rol]) ? $roles[$rol] : 'Desconocido';
    $status = $_GET['status'];
    $statusResultado = [
        0 => 'Inactivo',
        1 => 'Activo'
    ];
    $statusValor = isset($statusResultado[$status]) ? $statusResultado[$status] : 'Desconocido';

    // Mostrar los detalles del empleado en la página
    // echo "Nombre: " . $nombre . " " . $apellidos . "<br>";
    // echo "Correo: " . $correo . "<br>";
    // echo "Rol: " . $rols . "<br>";
    // echo "Status: " . $statusValor . "<br>";

    ?>

    <div class='titulo'>Detalles del empleado</div>
    <a href="empleados_lista.php" class="link boton">Regresar al listado</a><br><br>
    <div class="table">

        <!-- Fila Header -->
        <div class="fila header">
            <div class="celda">Nombre</div>
            <div class="celda">Correo</div>
            <div class="celda">Rol</div>
            <div class="celda">Status</div>
        </div>

        <!-- Fila Contenido -->
        <div class="fila">
            <div class="celda"><?php echo $nombre . " " . $apellidos; ?></div>
            <div class="celda"><?php echo $correo; ?></div>
            <div class="celda"><?php echo $rols; ?></div>
            <div class="celda" style="font-weight: bold"><?php echo $statusValor; ?></div>
        </div>
    
    </div> 

</body>
</html>


