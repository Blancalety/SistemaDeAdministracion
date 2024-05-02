<!DOCTYPE html>
<html lang="en">
    

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edicion de empleados</title>
    <style>
        body {
            background-color: #f2f2f2;
        }

        input {
            padding: 4px;
            border-radius: 5px;
            border: 1px solid black;
        }

        .caja {
            font-size: 15px;
            color: #4E5C92;
            font-family: 'Helvetica', sans-serif;
            margin-bottom: 10px;
        }

        button {
            width: 35%; 
            box-sizing: border-box;
            margin-top: 15px;
            margin-bottom: 14px;
            padding: 7px; 
            border-radius: 4px;
        }

        .format{
            color: #333;
            font-size: 15px;
        }

        form {
            font-family: 'Helvetica', sans-serif;
            font-size: 1.5em;
            font-weight: bold;
            margin-top: 30px;
            margin-bottom: 30px;
            text-align: center;
            background-color: lightgray;
            border: 2px solid black; 
            border-radius: 5px;
            padding: 15px; 
            width: calc(30% - 90px);
            margin-left: 37%
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

        #alerta {
            display: none;
            color: white;
            text-align: center;
            padding: 3px;
            width: 80%;
            margin: 10px;
            border: #4CAF50;
            border-radius: 5px;
            background-color: #4CAF50;
            font-size: .7em;
        }

        #mensaje {
            display: none;
            color: white;
            text-align: center;
            padding: 3px;
            width: 80%;
            margin: 10px;
            border: #4CAF50;
            border-radius: 5px;
            background-color: #4CAF50;
            font-size: .7em;
        }

        .rol {
            padding: 3px;
            border-radius: 5px;
            width: 11rem;
            border: 1px solid black;
        }

    </style>
        
    <!--formulario va a salva-->
    <!--<script src="js/jquery-3.3.1.min.js"></script>-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        //js
        
    //var correoValidado = false;
    function enviaDatos() {
        var nombre = $('#nombre').val();
        var apellidos = $('#apellidos').val();
        var correo = $('#correo').val();
        var pass = $('#pass').val();
        var rol = $('#rol').val();
        //var rol = document.getElementById('rol').value;

        if (nombre == "" || apellidos == "" || correo == "" || rol == 0){
            $('#mensaje').html('Faltan campos por llenar').show(); 
            setTimeout(function() {
                $('#mensaje').html('').hide();
            }, 5000);;
        }
        else{
            // $(document).ready(function(){
            //     $('#btnguardar').click(function(){
                    var datos=$('#form2').serialize();
                    $.ajax({
                        type: "POST",
                        url: "empleados_editar.php",
                        data: datos,
                        success:function(r){
                            if (r == 1){
                                alert("Fallo el server");
                            }
                            else{
                                window.location.href = "empleados_lista.php";
                            //     $('#alerta').html('Actualizado con exito').show();
                            // setTimeout(function() {
                            //     $('#alerta').html('').hide();
                            // }, 5000);
                            }
                        }
                    });
                    return false;
            //     });
            // });
            
        }

    }
        

    function sale() {
        var correo = $('#correo').val();

        $.ajax({
            url: 'verificar_correo.php',
            method: 'POST',
            data: { correo: correo },
            dataType: 'json',                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
            success: function(response) {
                if (response.success) {
                    var correo = $('#correo').val();
                    
                } else {
                    $('#correo').val('');
                    $('#alerta').html(response.message).show();
                    setTimeout(function() {
                    $('#alerta').html('').hide();
                }, 5000);
                }

            },
            error: function() {
                $('#alerta').html('Error al verificar el correo electrónico.').show();
                setTimeout(function() {
                    $('#alerta').html('').hide();
                }, 5000);
            }
        });
    }

$(document).ready(function() {
    //sale();
    //enviaDatos();
});   


    </script>
</head>

<body>

<?php

    require "funciones/conecta.php";

    $con = conecta();

    // Obtener los detalles del empleado de los parámetros GET
    $id = $_GET['id'];
    $nombre = $_GET['nombre'];
    $apellidos = $_GET['apellidos'];
    $correo = $_GET['correo'];
    $pass = $_GET['pass'];
    
    $rol = $_GET['rol'];
    $roles = [
        1 => 'Gerente',
        2 => 'Ejecutivo',
    ];
    $rols = isset($roles[$rol]) ? $roles[$rol] : 'Desconocido';

?>

    <div class="titulo">Edicion de empleados</div>
    <a href="empleados_lista.php" class="link boton">Regresar al listado</a><br><br>

    <!-- <div class="celda"><?php echo $nombre . " " . $apellidos; ?></div>
    <div class="celda"><?php echo $correo; ?></div>
    <div class="celda"><?php echo $rols; ?></div>
    <div class="celda"><?php echo $pass; ?></div>
    <div class="celda" style="font-weight: bold"><?php echo $statusValor; ?></div> -->
    

    <form name="Forma01" action="empleados_editar.php" method="post" autocomplete="off" id="form2">
        <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- Agrega un campo oculto para enviar el ID del empleado -->
        <div class="caja">
            <span>Nombre </span><br>
            <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>"><br>
        </div>
        <div class="caja">
            <span>Apellidos </span><br>
            <input type="text" name="apellidos" id="apellidos" value="<?php echo $apellidos; ?>"><br>
        </div>
        <div class="caja">
            <span>Correo</span><br>
            <input onblur="sale()" type="text" name="correo" id="correo" autocomplete="off" value="<?php echo $correo; ?>"><br>
        </div>
        <div class="caja">
            <span>Password </span><br>
            <input type="password" name="pass" id="pass" value="<?php echo $pass; ?>"><br>
        </div>
        <div class="caja">
            <span>Rol </span><br>
            <select name="rol" id="rol" class="rol">
                <option value="0" <?php if ($rols == 0) echo "selected"; ?>>Selecciona</option>
                <option value="1" <?php if ($rols == 'Gerente') echo "selected"; ?>>Gerente</option>
                <option value="2" <?php if ($rols == 'Ejecutivo') echo "selected"; ?>>Ejecutivo</option>
            </select>
        </div>
        
        <!-- <input class="input-salvar" id="btnguardar" onclick="enviaDatos(); return false;" type="submit" value="Actualizar"> -->
        <button id="btnguardar" onclick="enviaDatos(); return false;">
            Salvar
        </button>

        <div id="mensaje" class="mensaje"></div>

        <div id="alerta" class="alerta"></div>
    </form>

</body>

</html>

<!-- <script type="text/javascript">
    $(document).ready(function(){
        $('#btnguardar').click(function(){
            var datos=$('#form2').serialize();
            $.ajax({
                type: "POST",
                url: "empleados_editar.php",
                data: datos,
                success:function(r){
                    if (r == 1){
                        alert("Fallo el server");
                    }
                    else{
                        //window.location.href = "empleados_lista.php";
                        $('#alerta').html('Actualizado con exito').show();
                    setTimeout(function() {
                        $('#alerta').html('').hide();
                    }, 5000);
                        }
                }
            });
            return false;
        });
    });
</script> -->

