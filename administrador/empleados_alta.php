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

        .rounded {
            width: 200px;
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
            }else{
                img.src = defaultFile;
            }
        }


    </script>
</head>

<body>

    <div class="titulo">Alta de empleados</div>
    <a href="empleados_lista.php" class="link boton">Regresar al listado</a><br><br>

    <form enctype="multipart/form-data" name="Forma01" action="empleados_salva.php" method="post" id="form1">
        <input type="text" name="nombre" id="nombre" placeholder="Escribe tu nombre" autocomplete="off"> <br>
        <input type="text" name="apellidos" id="apellidos" placeholder="Escribe tus apellidos" autocomplete="off"> <br>
        <!--<input type="text" name="correo" id="correo" placeholder="Escribe tu correo"> <br>-->
        <input onblur="sale()" type="text" name="correo" id="correo" placeholder="Escribe tu correo" autocomplete="off"><br>
        <input type="password" name="pass" id="pass" placeholder="Escribe tu password" autocomplete="off"> <br>
        <select name="rol" id="rol" class="rol">
            <option value="0">Selecciona</option>
            <option value="1">Gerente</option>
            <option value="2">Ejecutivo</option>
        </select><br><br>

        <img id="previa-imagen" class="previa-imagen rounded" src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4eMoz7DH8l_Q-iCzSc1xyu_C2iryWh2O9_FcDBpY04w&s' alt="avatar"
        style="width: 200px; height: 250px;"><br>
        <input type="file" id="archivo" name="archivo" onchange="previsualizarImagen(this)"><br><br>
        
        
        <!-- <input type="submit" id="btnguardar" class="input-salvar"  value="Salvar"> -->
        <button id="btnguardar" type="submit" class="input-salvar">
            Salvar
        </button>

        <div id="mensaje" class="mensaje"></div>

        <div id="alerta" class="alerta"></div>
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
                url: "empleados_salva.php",
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
                        var pass = $('#pass').val();
                        var rol = $('#rol').val();
                        var archivoInput = document.getElementById('archivo');

                        if (nombre == "" || apellidos == "" || correo == "" || pass == "" || rol == 0 || archivoInput.files.length === 0){
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