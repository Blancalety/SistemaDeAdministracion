<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario con Select</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .titulo {
            font-size: 1.5em;
            font-weight: bold;
            margin-top: 30px;
            margin-bottom: 20px;
            text-align: center;
            font-family: Arial, sans-serif;
        }

        .datos {
            text-align: center;
            border: 1px solid #100;
            font-family: Arial, sans-serif;
            border-radius: 8px;
            overflow: hidden; 
            margin-top: 10px;
        }

        .link {
            color: black;
            font-family: Arial, sans-serif;
            font-size: 1em;
            font-weight: bold;
            box-shadow: 0 0 10px;
            padding: 10px;
            border-radius: 9px;
            text-decoration: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden; 
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            border-radius: 8px;
            overflow: hidden; 
        }

        tr {
            background-color: lightgrey; 
        }

        th {
            background-color: black;
        }

        th {
           color: #ddd; 
        }

        .empleado {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 8px;
            background: blueviolet;
            text-align: center;
        }

        .detalles, .editar, .eliminar {
            border-radius: 8px;
            padding: 5px 10px;
            margin: 0 5px;
            cursor: pointer;
        }

        .detalles {
            background: lightgoldenrodyellow;
        }

        .editar {
            background: blue;
        }

        .eliminar {
            background: pink;
        }

        body {
            background-color: #f2f2f2;
        }

        #mensaje {
                width: 200px;
                height: 25px;
                background: #EFEFEF;
                border-radius: 5px;
                color: #F00;
                font-size: 16px;
                line-height: 25px;
                text-align: center;
                margin-top: 20px;
                padding: 5px;
                display: none;
            }

        .notification {
            display: none;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 15px;
            position: fixed;
            top: 0;
            right: 0;
            z-index: 1;
            width: 250px;
            margin: 10px;
            border-radius: 5px;
        }

    </style>

    <script>

    function calificarAjax() {
                $(".eliminar").on("click", function() {
                    if (confirm("¿Quieres eliminar esta fila?")) {
                        $("#notification").html("Eliminado exitosamente").show();
                        setTimeout(function() {
                            $("#notification").html("").hide();
                        }, 3000);
                    }
                });
            }

    $(document).ready(function() {
        calificarAjax();
    });

    
</script>

</head>

<body>
    <?php
    require "funciones/conecta.php";
    $con = conecta();

    $sql = "SELECT * FROM empleados WHERE status = 1 AND eliminado = 0";
    $res = $con->query($sql);
    $num = $res->num_rows;

    $roles = [
        1 => 'Gerente',
        2 => 'Ejecutivo',
    ];

    $opciones = [
        1 => 'Ver detalles',
        2 => 'Editar',
        3 => 'Eliminar',
    ];
    ?>
    <div class='titulo'>Lista de empleados (<?php echo $num; ?>)</div>
    <a href="empleados_alta.php" class="link">Agregar nuevo registro</a><br><br>
    <div class='datos'>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $res->fetch_array()) {
                    $id = $row["id"];
                    $nombre = $row["nombre"];
                    $apellidos = $row["apellidos"];
                    $correo = $row["correo"];
                    $rol = $row["rol"];
                    $nombreRol = isset($roles[$rol]) ? $roles[$rol] : 'Desconocido';
                    ?>
                    <tr>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $nombre; ?></td>
                        <td><?php echo $apellidos; ?></td>
                        <td><?php echo $correo; ?></td>
                        <td><?php echo $nombreRol; ?></td>
                        <td>
                            <span class='detalles'><?php echo $opciones[1]; ?></span>
                            <span class='editar'><?php echo $opciones[2]; ?></span>
                            <span class='eliminar'>
                            <a onclick="funcAjax();" class='link'><?php echo $opciones[3]; ?></a>
                            </span>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <div id="notification" class="notification"></div>
    
</body>

</html>
