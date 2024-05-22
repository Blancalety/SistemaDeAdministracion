<?php

error_reporting(0);
session_start();

// Verificar si el usuario está autenticado
if (isset($_SESSION['correoUser'])) {
    // Opcional: Redirigir a una página específica si un usuario autenticado intenta acceder al registro
    header("Location: bienvenido_cliente.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
    

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo usuario</title>
    <style>
        body {
            background-color: #f2f2f2;
        }

        input {
            padding: 4px;
            border-radius: 5px;
            border: 1px solid black;
        }

        button {
            width: 35%; 
            box-sizing: border-box;
            margin-top: 5px;
            padding: 7px;
            border-radius: 4px; 
        }

        .caja {
            font-size: 15px;
            color: #4E5C92;
            font-family: 'Helvetica', sans-serif;
            margin-bottom: 10px;
        }

        .form {
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

        #alerta,
        #mensaje {
            position: absolute;
            left: 55rem;
            top: 119px; 

            display: none;
            color: white;
            text-align: center;
            padding: 3px;
            width: 30%;
            /* margin: 10px auto; <-Centra el elemento horizontalmente, funciona sin el absolute */
            border: #4CAF50;
            border-radius: 5px;
            background-color: #4CAF50;
            font-size: 15px;
        }

        .rol {
            padding: 3px;
            border-radius: 5px;
            width: 11rem;
            border: 1px solid black;
        }

        .rounded {
            width: 170px;
            border-radius: 50%; /* Imagen redonda */
            margin-top: 5px;
            margin-bottom: 5px;
            border: 2px solid black;
            padding: 5px;
        }

        #archivo {
            width: 75%; 
            box-sizing: border-box;
            margin-top: 5px;
            padding: 7px;
            border-radius: 4px; 
            border: 1px solid black;
            background-color: beige;
        }



    </style>
        
    <!--<script src="js/jquery-3.3.1.min.js"></script>-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        //js

        function sale() {
            var correo = $('#correo').val();

            $.ajax({
                url: 'verificar_correo.php',
                method: 'POST',
                data: { correo: correo, validacion:true },
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


    </script>
</head>

<body>
    <?php

    include('navegacionGeneral.php');

    ?>

    <div class="titulo">Nuevo usuario</div>
    <div class="titulo">Si ya eres usuario, inicia sesion para poder hacer compras :)</div>
    <a href="productos.php" class="link botonlista">Regresar</a><br><br>
    
    <div id="mensaje" class="mensaje"></div>
    <div id="alerta" class="alerta"></div>
    <form class='form' enctype="multipart/form-data" name="Forma01" action="cliente_salva.php" method="post" id="form1">
        <div class="caja">
            <span>Nombre </span><br>
            <input type="text" name="nombre" id="nombre" autocomplete="off"><br>
        </div>
        <div class="caja">
            <span>Correo</span><br>
            <input onblur="sale()" type="text" name="correo" id="correo" autocomplete="off" ><br>
        </div>
        <div class="caja">
            <span>Password <span class="opcional"></span>  </span><br>
            <input type="password" name="pass" id="pass" placeholder="Escribe tu password" autocomplete="off"><br>
        </div>
        
        <!-- <input type="submit" id="btnguardar" class="input-salvar"  value="Salvar"> -->
        <div class="caja">
            <button id="btnguardar" type="submit" class="input-salvar">
                Salvar
            </button>
        </div>
        
    </form>

</body>

</html>

<!--formulario va a salva-->
<script type="text/javascript">
    $(document).ready(function(){
        $('#btnguardar').click(function(){
            var formData = new FormData($('#form1')[0]);
            $.ajax({
                type: "POST",
                url: "cliente_salva.php",
                data: formData,
                processData: false, // Desactivar el procesamiento de datos
                contentType: false, // Desactivar el tipo de contenido
                success:function(r){
                    if (r == 1){
                        alert("Fallo el server");
                    }
                    else{
                        var nombre = $('#nombre').val();
                        var correo = $('#correo').val();
                        var pass = $('#pass').val();

                        if (nombre == "" || correo == "" || pass == "" ){
                        $('#mensaje').html('Faltan campos por llenar').show(); 
                        setTimeout(function() {
                            $('#mensaje').html('').hide();
                            }, 5000);
                        }else{
                            window.location.href = "bienvenido_cliente.php";
                        }
                        
                    }
                }
            });
            return false;
        });
    });
</script>