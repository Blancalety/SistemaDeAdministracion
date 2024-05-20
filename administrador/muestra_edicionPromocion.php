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
    <title>Edicion de promociones</title>
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
            /* ancho del recuadro seleccionar archivo: */
            width: 151px;
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
                $('#alerta').html('Error al verificar promocion producto.').show();
                setTimeout(function() {
                    $('#alerta').html('').hide();
                }, 5000);
            }
        });
    }

    function previsualizarImagen(input) {
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
                    $('#previa-imagen').attr('src', 'archivos/defaultP.png');
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
    $id         = $_GET['id'];
    
    $nombre     = $_GET['nombre'];

    $archivo = $_GET['archivo'];

?>

    <div class="titulo">Edicion de promociones</div>
    <a href="promociones_lista.php" class="link botonlista">Regresar al listado</a><br><br>


    <div id="mensaje" class="mensaje"></div>
    <div id="alerta" class="alerta"></div>
    <form name="Forma01" action="promociones_editar.php" method="post" autocomplete="off" id="form2">

        <input type="hidden" name="id" value="<?php echo $id; ?>"> <!--Agrega un campo oculto para enviar el ID del producto-->
        
        <div class="caja">
            <span>Nombre </span><br>
            <input onblur="sale()" type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>"><br>
        </div>
        
        <div class="caja">
            <img id="previa-imagen" class="previa-imagen rounded" src=<?php echo 'archivos/' . $archivo  ?> alt="sin imagen"
            style="width: 170px; height: 150px;"><br>
            <input class="inputfile" type="file" id="archivo" name="archivo" onchange="previsualizarImagen(this)" ><br><br>
        </div>
        
        <div class="caja">
            <button id="btnguardar" type="submit" class="input-salvar">
                Salvar
            </button>
        </div>
        
    </form>

</body>

</html>

<script type="text/javascript">
    $(document).ready(function(){
        $('#btnguardar').click(function(){
            var formData = new FormData($('#form2')[0]);
            $.ajax({
                type: "POST",
                url: "promociones_editar.php",
                data: formData,
                processData: false, // Desactivar el procesamiento de datos
                contentType: false, // Desactivar el tipo de contenido
                success:function(r){
                    if (r == 1){
                        alert("Fallo el server");
                    }
                    else{
                        var nombre = $('#nombre').val();

                        if (nombre == "" ){
                            $('#mensaje').html('Faltan campos por llenar').show(); 
                        setTimeout(function() {
                            $('#mensaje').html('').hide();
                            }, 5000);
                        }else{
                           window.location.href = "promociones_lista.php";
                        }
                        
                    }
                },
                error: function(){
                    alert("Error al comunicarse con el servidor.");
                }
            });
            return false;
        });
    });
</script>

