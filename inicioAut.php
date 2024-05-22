<?php


session_start();
if(!$correo = $_SESSION['correoUser']){
    header("Location: productos.php");
}
$nombre = $_SESSION['nombreUser'];
$correo = $_SESSION['correoUser'];

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    

    <style>
        .table {
            display: grid;
            border-collapse: separate;
            border-spacing: 30px;
            text-align: center;
            margin: 40px;
            color: black;
            grid-template-columns: 1fr 1fr 1fr;
        }

        body {
            background-color: #f2f2f2;
        }

        .fila {
            /* cambiar a display grid y listo  */
            display: grid;
            border: 1px solid #ccc;
            margin: 0px auto 50px; /*sup, izq der, abajo espacio entre recuadro*/
            /* background-color: lightcoral; */
        }

        .celda {
            display: table-cell;
            /* border: 1px solid #000; */
            padding: 15px;
            text-align: center;
            border-radius: 9px;
            margin: 3px auto auto; 
        }

        .header {
            font-weight: bold;
            color: lightgrey;
            background-color: #f2f2f2;
        }

        .header .celda {
            background-color: black;
        }
        /* mt */
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

        a {
            text-decoration: none;
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

        .designletra {
            color:#a10684;
        }

        .detalles {
            background: rgb(200, 160, 255);
            text-decoration: none;
        }

        .editar {
            background: rgb(173, 216, 230);
        }

        .eliminar {
            background: pink;
        }

        .detalles, .editar, .eliminar {
            border-radius: 8px;
            padding: 5px 10px;
            margin: 0 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .mensaje {
            background-color: red;
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

        .rounded {
            border-radius: 50%; /* Imagen redonda */
            margin-top: 5px;
            margin-bottom: 5px;
            border: 2px solid black;
            padding: 1px;
        }
        
    </style>


</head>
<body>

<header>

        <h1 class="titulo"><?php echo $nombre; ?> <span>bienvenido al sistema Star </span></h1>

</header>

<script>

function botonDetalles() {
    $(".detalles a").on("click", function(e) {
        e.preventDefault(); // Evita el comportamiento por defecto del enlace
        
        var numero_id = $(this).data("id");

        $.ajax({
            url: 'productos_detalle.php', 
            method: 'POST',
            dataType: 'json',
            data: { id: numero_id }, // Envío el ID del registro
            success: function(response) {
                //console.log(response);
                if (response.success) {
                    
                    $("#notification").html("Mostrando los datos...").show();
                    setTimeout(function() {
                        $("#notification").html("").hide();
                    // Redirige después de x segundos
                    setTimeout(function() {
                        var producto = response.producto;
                        var url = 'muestra_detallesProdInicio.php?nombre=' + producto.nombre + '&id=' + producto.id + '&codigo=' + producto.codigo + 
                        '&descripcion=' + producto.descripcion + '&costo=' + producto.costo + '&stock=' + producto.stock + '&archivo=' + producto.archivo_f;

                        window.location.href = url 
                    }, 300);
                }, 400);


                } else {
                    $("#notification").html("Error al ver detalles").show();
                    setTimeout(function() {
                        $("#notification").html("").hide();
                    }, 3000);
                }
            },
            error: function() {
                $("#mensaje").html("Error al conectar").show();
                    setTimeout(function() {
                        $("#mensaje").html("").hide();
                    }, 3000);
            }
        });
        
        
    });
}


$(document).ready(function() {
    botonDetalles();
});

</script>




<?php
    include('navegacionAut.php');

    

    // echo "<div><img src=\"archivos/icono.jpg\" width=\"120\" height=\"100\" class=\"rounded\"/></a></div>";


    require "funciones/conecta.php";
    $con = conecta();

    // Consulta para obtener productos
    $sql_productos = "SELECT * FROM productos WHERE status = 1 AND eliminado = 0 ORDER BY RAND() LIMIT 3";
    $res_productos = $con->query($sql_productos);
    $num_productos = $res_productos->num_rows;

    // Consulta para obtener una promoción
    $sql_promociones = "SELECT * FROM promociones WHERE status = 1 AND eliminado = 0 ORDER BY RAND() LIMIT 1";
    $res_promociones = $con->query($sql_promociones);
    $num_promociones = $res_promociones->num_rows;


    $opciones = [
        1 => 'Ver detalle',
    ];

    ?>

    <!-- <div class='titulo'>Lista de promociones (<?php echo $num; ?>)</div>
    <a href="promociones_alta.php" class="link botonlista">Agregar nueva promocion</a><br><br> -->

    <div class="table">
        <?php
        // Renderizando promoción
        if ($fila = $res_promociones->fetch_array()) {
            $archivo = $fila["archivo"];
            $id = $fila["id"];
            $nombre = $fila["nombre"];
        ?>
            <div class="fila">
                <?php echo "<div><a href=\"#\"><img src=\"archivos/$archivo\" width=\"1500\" height=\"480\"/></a></div>"; ?>
                <!-- <div class="celda"><?php echo "Promoción: " . $id; ?></div> -->
                <div class="celda"><?php echo $nombre; ?></div>
            </div>
        <?php
        }
        ?>
    </div>


    <div class="table">
        <?php
        // Renderizando productos
        while ($fila = $res_productos->fetch_array()) {
            $archivo = $fila["archivo_f"];
            $id = $fila["id"];
            $nombre = $fila["nombre"];
            $codigo = $fila["codigo"];
        ?>
            <div class="fila">
                <?php echo "<div><a href=\"#\"><img src=\"archivos/$archivo\" width=\"380\" height=\"350\"/></a></div>"; ?>
                <div class="celda"><?php echo "Producto: " . $id; ?></div>
                <div class="celda"><?php echo $nombre; ?></div>
                <div class="celda"><?php echo "Codigo: " . $codigo; ?></div>
                <div class="celda">
                    <span class="detalles">
                        <a class='designletra' href="#" data-id="<?php echo $id; ?>"><?php echo $opciones[1]; ?></a>
                    </span>
                </div>
            </div>
        <?php
        }
        ?>
    </div>

<div id="notification" class="notification"></div>
<div id="mensaje" class="mensaje"></div>

</body>

<footer class="footer">
    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pin" width="50" height="50" viewBox="0 0 24 24" stroke-width="1.5" stroke="#FFC107" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z"/>
                    <circle cx="12" cy="11" r="3" />
                    <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 0 1 -2.827 0l-4.244-4.243a8 8 0 1 1 11.314 0z" />
                </svg>
                <p>Guadalajara, Jalisco</p> 
                <br>
        <p>Todos los derechos reservados. Blanca leticia RR. |  S.A. de C.V. | <a href="terminos.php">Consulta términos y condiciones</a> </p>
    </footer>

</html>