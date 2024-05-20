<?php

session_start();
if(!$correo = $_SESSION['correoUser']){
    header("Location: index.php");
}
$nombre = $_SESSION['nombreUser'];
$correo = $_SESSION['correoUser'];

?>

<!DOCTYPE html>
<html lang="en">
    

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de promociones</title>
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
            top: 119px; /* Ajusta según sea necesario */

            display: none;
            color: white;
            text-align: center;
            padding: 3px;
            width: 30%;
            /* margin: 10px auto;Centra el elemento horizontalmente funciona sin el absolute */
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
            width: 200px;
            border-radius: 50%; /* Imagen redonda */
            margin-top: 5px;
            margin-bottom: 5px;
            border: 2px solid black;
            padding: 2px;
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
            var nombre = $('#nombre').val();

            $.ajax({
                url: 'verificar_promocion.php',
                method: 'POST',
                data: { nombre: nombre },
                dataType: 'json',                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                success: function(response) {
                    if (response.success) {
                        var nombre = $('#nombre').val();
                        
                    } else {
                        $('#nombre').val('');
                        $('#alerta').html(response.message).show();
                        setTimeout(function() {
                        $('#alerta').html('').hide();
                    }, 5000);
                    }

                },
                error: function() {
                    $('#alerta').html('Error al verificar promocion.').show();
                    setTimeout(function() {
                        $('#alerta').html('').hide();
                    }, 5000);
                }
            });
        }

        function previsualizarImagen(input) {
            const defaultFile = 'data:image/png;base64,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';
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
    <?php

    include('navegacionGeneral.php');

    ?>

    <div class="titulo">Alta de promocion</div>
    <a href="promociones_lista.php" class="link botonlista">Regresar al listado</a><br><br>

    <div id="mensaje" class="mensaje"></div>
    <div id="alerta" class="alerta"></div>
    <form class='form' enctype="multipart/form-data" name="Forma01" action="promociones_salva.php" method="post" id="form1">
        <input type="hidden" name="id" value="<?php echo $id; ?>"> <!--Agrega un campo oculto para enviar el ID del producto-->
        <div class="caja">
            <span>Nombre </span><br>
            <input onblur="sale()" type="text" name="nombre" id="nombre" placeholder="Nombre de la promocion" autocomplete="off"><br>
        </div>
        
        <div class="caja">
            <img id="previa-imagen" class="previa-imagen rounded" src='data:image/png;base64,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' alt="avatar de subir producto"
            style="width: 180; height: 150px;"><br>
            <input type="file" id="archivo" name="archivo" onchange="previsualizarImagen(this)"><br><br>
        </div>
        
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
                url: "promociones_salva.php",
                data: formData,
                processData: false, // Desactivar el procesamiento de datos
                contentType: false, // Desactivar el tipo de contenido
                success:function(r){
                    if (r == 1){
                        alert("Fallo el server");
                    }
                    else{
                        var nombre = $('#nombre').val();
                        var archivoInput = document.getElementById('archivo');

                        if (nombre == "" || archivoInput.files.length === 0){
                        $('#mensaje').html('Faltan campos por llenar').show(); 
                        setTimeout(function() {
                            $('#mensaje').html('').hide();
                            }, 5000);
                        }else{
                            window.location.href = "promociones_lista.php";
                        }
                        
                    }
                }
            });
            return false;
        });
    });
</script>