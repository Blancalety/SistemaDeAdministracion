<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <style>
        body {
            background-color: #DFE9F3;
        }

        input {
            padding: 5px;
            border-radius: 5px;
            border: 1px solid black;
            font-size: 18px;
            margin-top: 10px;
        }

        .input-salvar {
            width: 35%; 
            box-sizing: border-box;
            margin-top: 5px;
            padding: 7px; 
            color: white;
            background-color: #DF2614;
        }

        form {
            font-family: 'Helvetica', sans-serif;
            font-size: 1.5em;
            font-weight: bold;
            color: white;
            margin-top: 5px;
            margin-bottom: 30px;
            text-align: center;
            background-color: #0097A7;
            border: 2px solid black; 
            border-radius: 5px;
            padding: 15px; 
            width: calc(30% - 90px);
            margin-left: 37%
        }

        .titulo {
            font-family: 'Verdana', sans-serif;
            font-size: 0.8em;
            font-weight:bolder;
            margin-top: 20px;
            margin-bottom: 5px;
            text-align: center;
        }
        .tema {
            font-family: 'Verdana', sans-serif;
            font-size: 2rem;
            font-weight:bolder;
            margin-top: 30px;
            margin-bottom: 2px;
            text-align: center;
            line-height: 200px;
        }
        .link {
            color: black;
            font-family: Arial, sans-serif;
            font-size: 1em;
            font-weight: bold;
            box-shadow: 
                0 0 20px rgba(0, 0, 0, 0.7), /* Primera sombra */
                0 0 30px rgba(0, 0, 255, 0.2); 
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

        #rol {
            padding: 3px;
            border-radius: 5px;
            width: 11rem;
            border: 1px solid black;
        }

    </style>
        
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>

        function enviaDatos() {
            var correo = $('#correo').val();
            var pass = $('#pass').val();

            if (correo == "" || pass == ""){
                $('#mensaje').html('Faltan campos por llenar').show(); 
                setTimeout(function() {
                    $('#mensaje').html('').hide();
                    }, 2000);
            }
            else {
                $.ajax({
                    url: 'verificar_usuario.php',
                    method: 'POST',
                    data: { correo: correo, pass: pass },
                    dataType: 'json',                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                    success: function(response) {
                        if (response.success) {
                            window.location.href = 'bienvenido.php';  

                        } else {
                            $('#pass').val('');
                            $('#alerta').html(response.message).show();
                            setTimeout(function() {
                                $('#alerta').html('').hide();
                            }, 5000); 
                        }

                    },
                    error: function() {
                        $('#alerta').html('Error en index.php!').show();
                        setTimeout(function() {
                            $('#alerta').html('').hide();
                        }, 5000);
                    }
                });
            }
        }


    </script>
</head>

<body>

    <div class="tema">Login</div>
    <form name="Forma01" action="verificar_usuario.php" method="post" autocomplete="off">
    <div class="titulo">Sistema de administracion de empleados</div>

        <input type="text" name="correo" id="correo" placeholder="Escribe tu correo" autocomplete="off"><br>
        <input type="password" name="pass" id="pass" placeholder="Escribe tu password" autocomplete="off"> <br>

        <br>

        <input class="input-salvar" onclick="enviaDatos(); return false;" type="submit" value="Ingresar">

        <div id="mensaje" class="mensaje"></div>

        <div id="alerta" class="alerta"></div>
    </form>

</body>

</html>

