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
            display: table-cell;
            background-color: lightgrey;
        }

        .celda {
            display:flex;
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
            width: 30%;
            font-family: Arial, sans-serif;
            border: 1px solid #000;
            border-radius: 6px;
            margin-top: 1px;
            margin-left: 36%;  /* Ajusta el margen izquierdo a automático para centrar */
            margin-right: auto;
        }

        .rounded {
            border-radius: 50%; /* Imagen redonda */
            margin-top: 1px;
            border: 2px solid black;
            margin-left: 44%;
        }

        #archivo {
            display: none;
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

    $archivo = $_GET['archivo'];
    

    // Mostrar los detalles del empleado en la página
    // echo "Nombre: " . $nombre . " " . $apellidos . "<br>";
    // echo "Correo: " . $correo . "<br>";
    // echo "Rol: " . $rols . "<br>";
    // echo "Status: " . $statusValor . "<br>";

    ?>

    <script>

        function previsualizarImagen(input) {
            const defaultFile = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4eMoz7DH8l_Q-iCzSc1xyu_C2iryWh2O9_FcDBpY04w&s';
            const img = document.getElementById('previa-imagen'); 
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#previa-imagen')
                        .attr('src', e.target.result)
                        .show();

                 };
                reader.readAsDataURL(input.files[0]);
            }
            else {
                //console.log("hola");
                //$('#previa-imagen').attr('src', 'archivos/default.png');
                img.src = defaultFile;
                //rounded.style.display = 'none';
            }
        }

    </script>

    <div class='titulo'>Detalles del empleado</div>
    <a href="empleados_lista.php" class="link boton">Regresar al listado</a><br><br>

    <img id="previa-imagen" class="previa-imagen rounded" src=<?php echo 'archivos/' . $archivo  ?> alt="sin imagen"
    style="width: 190px; height: 220px; "><br>
    <input type="file" id="archivo" name="archivo" onchange="previsualizarImagen(this)" ><br><br>
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

<!-- 
    <img src='$destination' alt='Imagen guardada'> -->

</body>
</html>


