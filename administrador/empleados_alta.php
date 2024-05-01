<!DOCTYPE html>
<html lang="en">
    

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de empleados</title>
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
        function enviaDatos() {
            var nombre = $('#nombre').val();
            var apellidos = $('#apellidos').val();
            var correo = $('#correo').val();
            var pass = $('#pass').val();
            var rol = $('#rol').val();
            //var rol = document.getElementById('rol').value;

            if (nombre == "" || apellidos == "" || correo == "" || pass == "" || rol == 0){
             $('#mensaje').html('Faltan campos por llenar').show(); 
             setTimeout(function() {
                 $('#mensaje').html('').hide();
                }, 5000);;
            }
            // else {
            //     document.Forma01.method = 'post';
            //     document.Forma01.action = 'empleados_salva.php';
            //     document.Forma01.submit();
            // }
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

    </script>
</head>

<body>

    <div class="titulo">Alta de empleados</div>
    <a href="empleados_lista.php" class="link boton">Regresar al listado</a><br><br>

    <form name="Forma01" action="empleados_salva.php" method="post" autocomplete="off" id="form1">
        <input type="text" name="nombre" id="nombre" placeholder="Escribe tu nombre" autocomplete="off"> <br>
        <input type="text" name="apellidos" id="apellidos" placeholder="Escribe tus apellidos" autocomplete="off"> <br>
        <!--<input type="text" name="correo" id="correo" placeholder="Escribe tu correo"> <br>-->
        <input onblur="sale()" type="text" name="correo" id="correo" placeholder="Escribe tu correo" autocomplete="off"><br>
        <input type="text" name="pass" id="pass" placeholder="Escribe tu password" autocomplete="off"> <br>
        <select name="rol" id="rol" class="rol">
            <option value="0">Selecciona</option>
            <option value="1">Gerente</option>
            <option value="2">Ejecutivo</option>
        </select>
        <br>
        <!-- <input class="input-salvar" onclick="enviaDatos(); return false;" type="submit" value="Salvar"> -->
        <button id="btnguardar" onclick="enviaDatos(); return false;">
            Salvar
        </button>

        <div id="mensaje" class="mensaje"></div>

        <div id="alerta" class="alerta"></div>
    </form>

</body>

</html>

<script type="text/javascript">
    $(document).ready(function(){
        $('#btnguardar').click(function(){
            var datos=$('#form1').serialize();
            $.ajax({
                type: "POST",
                url: "empleados_salva.php",
                data: datos,
                success:function(r){
                    if (r == 1){
                        alert("Fallo el server");
                    }
                    else{
                        window.location.href = "empleados_lista.php";
                    }
                }
            });
            return false;
        });
    });
</script>

<!--
validar y eliminar correo con ajax
-->