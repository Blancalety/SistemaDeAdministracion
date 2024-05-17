<?php

session_start();

$nombre = $_SESSION['nombreUser'];

?>

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
            padding: 5px;
            border-radius: 5px;
            border: 1px solid black;
        }

        .inputfile {
            padding: 1px;
        }

        .caja {
            font-size: 15px;
            color: #4E5C92;
            font-family: 'Helvetica', sans-serif;
            margin-bottom: 10px;
        }

        .opcional {
            font-size: small; 
            font-family: 'Comic Sans MS', cursive, sans-serif; 
            color: #800000; 
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

        /* mt */
        form {
            font-family: 'Helvetica', sans-serif;
            font-size: 1.5em;
            font-weight: bold;
            margin-top: 10px;
            margin-bottom: 30px;
            text-align: center;
            background-color: lightgray;
            border: 2px solid black; 
            border-radius: 5px;
            padding: 15px; 
            width: calc(30% - 90px);
            margin-left: 37%;
        }

        .titulo {
            font-family: 'Verdana', sans-serif;
            font-size: 1.5em;
            font-weight: bold;
            margin-top: 30px;
            margin-bottom: 20px;
            text-align: center;
        }

        .botonlista {
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

        .rounded {
            width: 200px;
            border-radius: 50%; /* Imagen redonda */
            margin-top: 5px;
            margin-bottom: 5px;
            border: 2px solid black;
        }

    </style>
        
    <!--formulario va a salva-->
    <!--<script src="js/jquery-3.3.1.min.js"></script>-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        //js
        

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

    function previsualizarImagen(input) {
            //const defaultFile = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4eMoz7DH8l_Q-iCzSc1xyu_C2iryWh2O9_FcDBpY04w&s';
            const img = document.getElementById('previa-imagen'); 
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#previa-imagen')
                        .attr('src', e.target.result)
                        .show();

                 };
                reader.readAsDataURL(input.files[0]);
            }else{
                    //console.log("No se ha seleccionado ningún archivo");
                    $('#previa-imagen').attr('src', 'archivos/default.png');
                    //img.src = defaultFile;
                }
        }

$(document).ready(function() {
    //sale();
    //enviaDatos();
});   


    </script>
</head>

<body>

<?php

    include('navegacionGeneral.php');
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

    $archivo = $_GET['archivo'];

?>

    <div class="titulo">Edicion de empleados</div>
    <a href="empleados_lista.php" class="link botonlista">Regresar al listado</a><br><br>

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
            <span>Password <span class="opcional">opcional</span>  </span><br>
            <input type="password" name="pass" id="pass" placeholder="Escribe tu password"><br>
        </div>
        <div class="caja">
            <span>Rol </span><br>
            <select name="rol" id="rol" class="rol">
                <option value="0" <?php if ($rols == 0) echo "selected"; ?>>Selecciona</option>
                <option value="1" <?php if ($rols == 'Gerente') echo "selected"; ?>>Gerente</option>
                <option value="2" <?php if ($rols == 'Ejecutivo') echo "selected"; ?>>Ejecutivo</option>
            </select>
        </div>
        <div class="caja">
            <img id="previa-imagen" class="previa-imagen rounded" src=<?php echo 'archivos/' . $archivo  ?> alt="sin imagen"
            style="width: 170px; height: 150px;"><br>
            <input class="inputfile" type="file" id="archivo" name="archivo" onchange="previsualizarImagen(this)" ><br><br>
        </div>
        <!-- <input class="input-salvar" id="btnguardar" onclick="enviaDatos(); return false;" type="submit" value="Actualizar"> -->
        <div class="caja">
            <button id="btnguardar" type="submit" class="input-salvar">
                Salvar
            </button>
        </div>

        <div id="mensaje" class="mensaje"></div>

        <div id="alerta" class="alerta"></div>
    </form>

</body>

</html>

<script type="text/javascript">
    $(document).ready(function(){
        $('#btnguardar').click(function(){
            var formData = new FormData($('#form2')[0]);
            $.ajax({
                type: "POST",
                url: "empleados_editar.php",
                data: formData,
                processData: false, // Desactivar el procesamiento de datos
                contentType: false, // Desactivar el tipo de contenido
                success:function(r){
                    if (r == 1){
                        alert("Fallo el server");
                    }
                    else{
                        var nombre = $('#nombre').val();
                        var apellidos = $('#apellidos').val();
                        var correo = $('#correo').val();
                        var rol = $('#rol').val();

                        if (nombre == "" || apellidos == "" || correo == "" || rol == 0 ){
                        $('#mensaje').html('Faltan campos por llenar').show(); 
                        setTimeout(function() {
                            $('#mensaje').html('').hide();
                            }, 5000);
                        }else{
                            window.location.href = "empleados_lista.php";
                        }
                        
                    }
                }
            });
            return false;
        });
    });
</script>

