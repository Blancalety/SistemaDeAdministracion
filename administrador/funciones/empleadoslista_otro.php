<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario con Select</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .container {
            width: 100%;
            height: 70rem;
            padding: .5rem;
            border: 1px solid #000;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden; 
        }

        .content {
            width: 100%;
            height: 100%;
        }

        .titulo {
            font-size: 1.5em;
            font-weight: bold;
            margin-top: 30px;
            margin-bottom: 20px;
            text-align: center;
            font-family: Arial, sans-serif;
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

        .eliminar {
            background: pink;
            margin-bottom: 20px;
        }

        .detalles, .editar, .eliminar {
            border-radius: 8px;
            padding: 5px 10px;
            margin: 0 5px;
            cursor: pointer;
        }

    


    </style>

    <script>
//height: calc(100% - 50rem);
        function funcAjax (){
            var numero_id = $('#id').val();
            $.ajax({//implementandolo con jquery
                    url         : 'empleados_elimina.php',//aqui se manda llamar al siguiente archivo
                    type        : 'post',
                    dataType    : 'text',//EN LUGAR DE recibe.php?id=$id
                    data        : 'numero_id='+numero_id,//mando variable hacia url
                    success     : function(hola) {
                        $('#mensaje').show();
                        if (confirm("¿Quieres eliminar este registro?")){
                            $(this).closest('td').hide();
                        }
                        setTimeout("$('#mensaje').html(''); $('#mensaje').hide();", 3000);
                    }, error: function() {
                        alert('Error archivo no encontrado...');
                    }
                });

        //     $(document).ready(function esconder() {
        //     $(".uno").on("click", function esconder() {
        //         if (confirm("¿Quieres eliminar este registro?")) {
        //             $(this).closest('tr').hide();
        //         }
        //     });
        // });

        }

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
    <div class="container">
        <div class="content">
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
        </div>
</body>

</html>
