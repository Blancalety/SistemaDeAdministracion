<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de empleados</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .table {
            display: table;
            width: 85%;
            margin-top: 25px;
            font-family: Arial, sans-serif;
            border: 1px solid #000;
            border-radius: 5px;
            margin-left: auto;  /* Ajusta el margen izquierdo a automático para centrar */
            margin-right: auto;
        }

        body {
            background-color: #f2f2f2;
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
            background-color: black;
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

        .detalles {
            background: rgb(200, 160, 255);
        }

        .editar {
            background: rgb(173, 216, 230);
        }

        .eliminar {
            background: pink;
        }

        .detalles, .editar, .eliminar {
            border-radius: 8px;
            padding: 5px 10px;
            margin: 0 5px;
            cursor: pointer;
        }

        .mensaje {
            background-color: red;
        }

        .notification {
            background-color: #4CAF50;
        }

        .notification, .mensaje {
            display: none;
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

function usarAjax() {
    $(".eliminar a").on("click", function(e) {
        e.preventDefault(); // Evita el comportamiento por defecto del enlace

        if (confirm("¿Quieres eliminar esta fila?")) {
            var numero_id = $(this).data("id"); // Obtiene el ID del registro a eliminar
            $.ajax({
                url: 'empleados_elimina.php', // Script PHP para eliminar el empleado
                type: 'post',
                dataType: 'json',
                data: { id: numero_id }, // Envía el ID del registro
                success: function(response) {
                    if (response.success) {
                        $('[data-id="' + numero_id + '"]').closest('.fila').hide();
                        $("#notification").html("Eliminado exitosamente").show();
                        setTimeout(function() {
                            $("#notification").html("").hide();
                        }, 3000);
                    } else {
                        $("#notification").html("Error al eliminar el registro").show();
                        setTimeout(function() {
                            $("#notification").html("").hide();
                        }, 3000);
                    }
                },
                error: function() {
                    $("#mensaje").html("Error al conectar").show();
                        setTimeout(function() {
                            $("#mensaje").html("").hide();
                        }, 3000);
                }
            });
        }
    });
}

$(document).ready(function() {
    usarAjax();
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
    <a href="empleados_alta.php" class="link boton">Agregar nuevo registro</a><br><br>
    <div class="table">

    <!-- Fila Header -->
    <div class="fila header">
        <div class="celda">ID</div>
        <div class="celda">Nombre</div>
        <div class="celda">Apellidos</div>
        <div class="celda">Correo</div>
        <div class="celda">Rol</div>
        <div class="celda">Opciones</div>
    </div>

    <?php
    while ($fila = $res->fetch_array()) {
        $id = $fila["id"];
        $nombre = $fila["nombre"];
        $apellidos = $fila["apellidos"];
        $correo = $fila["correo"];
        $rol = $fila["rol"];
        $nombreRol = isset($roles[$rol]) ? $roles[$rol] : 'Desconocido';
        ?>

        <!-- Fila Contenido -->
        <div class="fila">
            <div class="celda"><?php echo $id; ?></div>
            <div class="celda"><?php echo $nombre; ?></div>
            <div class="celda"><?php echo $apellidos; ?></div>
            <div class="celda"><?php echo $correo; ?></div>
            <div class="celda"><?php echo $nombreRol; ?></div>
            <div class="celda">
                <span class="detalles"><?php echo $opciones[1]; ?></span>
                <span class="editar"><?php echo $opciones[2]; ?></span>
                <span class="eliminar">
                <a href="#" class='link' data-id="<?php echo $id; ?>"><?php echo $opciones[3]; ?></a>
                </span>
            </div>
        </div>
            
    <?php
    }
    ?>
</div>

<div id="notification" class="notification"></div>
<div id="mensaje" class="mensaje"></div>

</body>

</html>
