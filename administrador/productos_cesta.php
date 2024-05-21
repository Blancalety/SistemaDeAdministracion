<?php

session_start();
if(!$correo = $_SESSION['correoUser']){
    header("Location: index.php");
}
$nombre = $_SESSION['nombreUser'];
$correo = $_SESSION['correoUser'];

// Verificar si hay un mensaje para mostrar
if(isset($_SESSION['notification'])) {
    echo "<div class='notification'>" . $_SESSION['notification'] . "</div>";
    // Una vez mostrado el mensaje, borra la variable de sesión para que no se muestre nuevamente
    unset($_SESSION['notification']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>


    <style>
        body {
            background-color: #f2f2f2;
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
        
        .botonCesta {
            background: rgb(255, 255, 153);
            position: absolute;
            left: 48%;
            top: 58rem; 
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

        .fila {
            display: table-row;
            background-color: lightgrey;
        }

        .celda {
            display:table-cell;
            /* border: 1px solid #000; */
            padding: 10px;
            text-align: center;
            /* border-radius: 9px; */
        }

        .header {
            font-weight: bold;
            color: lightgrey;
            background-color: #f2f2f2;
        }

        .header .celda {
            background-color: cornflowerblue;
            color: whitesmoke;
        }

        .table {
            display: table;
            width: 30%;
            font-family: Arial, sans-serif;
            border: 1px solid #000;
            /* border-radius: 6px; */
            margin-top: 1px;
            margin-left: 36%;  /* Ajusta el margen izquierdo a automático para centrar */
            margin-right: auto;
        }

        .rounded {
            border-radius: 50%; /* Imagen redonda */
            margin-top: 1px;
            border: 2px solid black;
            margin-left: 42%;
        }

        #archivo {
            display: none;
        }

        .cantidad {
            margin: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 70px;
            cursor: pointer;border: none;
            border-radius: 4px;
        }

        /* la class fila no me deja centrar la cantidad*/
        .centrar {
            display: flex;
            justify-content: center;
            align-items: center;
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
            font-family: Arial, sans-serif;
        }

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

    </style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>

    <?php

    include('navegacionGeneral.php');

    require "funciones/conecta.php";

    $con = conecta();

    // Obtener los detalles del empleado de los parámetros GET
    $nombre         = $_GET['nombre'];
    $id_producto    = $_GET['id'];
    $codigo         = $_GET['codigo'];
    $descripcion    = $_GET['descripcion'];
    $costo          = $_GET['costo'];
    $stock          = $_GET['stock'];
    $archivo        = $_GET['archivo'];
    
    ?>

    <script>

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
            }
            else {
                img.src = defaultFile;
            }
        }

        // var id_producto = <?php echo $id_producto; ?>;
        // console.log("id producto:", id_producto); 
        function calcularTotal() {
            const cantidad = document.getElementById('cantidad').value;
            const costo = parseFloat(document.getElementById('costo').innerText); // Convertir a número
            const total = cantidad * costo;
            document.getElementById('total').innerText = total.toFixed(2);
        }

        // Inicializa el total cuando la página se carga
        window.onload = function() {
            // console.log("La página se ha cargado.");
            // calcularTotal();
        };

    </script>

    <div class='titulo'>Cesta</div>
    <a href="productos_lista.php" class="link botonlista">Cancelar y volver</a><br><br>

    <img id="previa-imagen" class="previa-imagen rounded" src=<?php echo 'archivos/' . $archivo  ?> alt="sin imagen"
    style="width: 260px; height: 250px; "><br>
    <input type="file" id="archivo" name="archivo" onchange="previsualizarImagen(this)" ><br><br>

    <!-- <div id="mensaje" class="mensaje"></div> -->
    <form class='form' enctype="multipart/form-data" name="Forma01" action="pedidos_productos_salva.php" method="post" id="form1">
        <div class="table">

            <!-- Fila Header -->
            <div class="fila header">
                <div class="celda">Cantidad</div>
                <div class="celda">Costo</div>
                <div class="celda">Total</div>
            </div>

            <!-- Fila Contenido -->
            <div class="fila">
                <input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>">
                
                <div class="centrar">   
                    <input onblur="calcularTotal()" onclick="calcularTotal()" type="number" class="cantidad celda" id="cantidad" name="cantidad" min="1" step="1" value="0">
                </div>

                <div class="celda" id="costo"><?php echo $costo ?></div>
                
                <div class="celda" id="total"></div>
            </div>
        
        </div> 

        <span >
            <!-- <a href="productos_lista.php" class="link botonCesta">Confirmar</a><br><br> -->
            <button id="btnguardar" type="submit" class="link botonCesta">Confirmar</button>
        </span>
    </form>

    <div id="notification" class="notification"></div>

</body>
</html>

<!--formulario va a salva-->
<script type="text/javascript">
    $(document).ready(function(){
        $('#btnguardar').click(function(){
            var formData = new FormData($('#form1')[0]);
            $.ajax({
                type: "POST",
                url: "pedidos_productos_salva.php",
                data: formData,
                processData: false, // Desactivar el procesamiento de datos
                contentType: false, // Desactivar el tipo de contenido
                success:function(r){
                        if (r == 1){
                            alert("Fallo el server");
                        }
                        else{
                                window.location.href = "productos_lista.php";
                            }
                    }
            });
            return false;
        });
    });
</script>


