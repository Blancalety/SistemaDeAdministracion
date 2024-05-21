<?php

session_start();
if(!$correo = $_SESSION['correoUser']){
    header("Location: index.php");
}
$nombre = $_SESSION['nombreUser'];
$correo = $_SESSION['correoUser'];
$id_usuario = $_SESSION['idUser'];

global $total;
$total = 0;

// Verificar si hay un mensaje para mostrar
// if(isset($_SESSION['notification'])) {
//     echo "<div class='notification'>" . $_SESSION['notification'] . "</div>";
//     // Una vez mostrado el mensaje, borra la variable de sesión para que no se muestre nuevamente
//     unset($_SESSION['notification']);
// }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
            left: 12.5%;
            top: 20rem; 
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

        .total {
            margin-left: auto;
            margin-right: -2%;
            font-size: large;
            font-weight: bold;
            font-family: Arial, sans-serif;
        }

        .fila {
            display: table-row;
            background-color: lightgrey;
            box-shadow: 
                0 0 20px rgba(0, 0, 0, 0.7), /* Primera sombra */
                0 0 30px rgba(0, 0, 255, 0.2); /* Segunda sombra */
        }

        .celda {
            display:table-cell;
            /* border: 1px solid #000; */
            padding: 10px;
            text-align: center;
            vertical-align: middle; 
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
            margin-left: 31%;  /* Ajusta el margen izquierdo a automático para centrar */
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
</head>

<body>

    <?php

    include('navegacionGeneral.php');

    require "funciones/conecta.php";

    $con = conecta();
    $id_usuario = $_SESSION['idUser']; 


    $sql_productos = "SELECT * FROM productos WHERE status = 1 AND eliminado = 0";
    $res_productos = $con->query($sql_productos);
    $num_productos = $res_productos->num_rows;

    if ($num_productos > 0) {
        // Obtener la primera fila del resultado
        $row_productos = $res_productos->fetch_assoc();
        // Obtener datos producto
        $id_producto = $row_productos['id'];
        $costo = $row_productos['costo'];
        $nombre = $row_productos['nombre'];
        $descripcion = $row_productos['descripcion'];
        $stock = $row_productos['stock'];
        $archivo_f = $row_productos['archivo_f'];
    } else {
        // Si no se encuentra el producto, establecer el costo como 0 o cualquier valor predeterminado
        $costo = 0;
    }

    // Obtener id_pedido
    $sql_pedido = "SELECT * FROM pedidos WHERE id_usuario = ? AND status = 0";
    $stmt_pedido = $con->prepare($sql_pedido);
    $stmt_pedido->bind_param("i", $id_usuario);
    $stmt_pedido->execute();
    $res_pedido = $stmt_pedido->get_result();

    if ($res_pedido->num_rows > 0) {
        $row_pedido = $res_pedido->fetch_assoc();
        $id_pedido = $row_pedido['id'];
        $fecha = $row_pedido['fecha'];

        // Consultar productos en el pedido
        $sql_pedidos_productos = "SELECT pp.*, p.nombre, p.descripcion, p.costo, p.archivo_f 
                                FROM pedidos_productos pp 
                                INNER JOIN productos p ON pp.id_producto = p.id 
                                WHERE pp.id_pedido = ?";
        $stmt_pedidos_productos = $con->prepare($sql_pedidos_productos);
        $stmt_pedidos_productos->bind_param("i", $id_pedido);
        $stmt_pedidos_productos->execute();
        $res_pedidos_productos = $stmt_pedidos_productos->get_result();
    } else {
        // Si no se encuentra el pedido
        $id_pedido = null;
        $fecha = null;
        $res_pedidos_productos = null;
    }

    ?>

<?php
    
    ?>

    <div class='titulo'>Carrito</div>
    <a href="productos_lista.php" class="link botonlista">Seguir agregando</a><br><br>
    <form class='form' action="productos_carrito_salva.php" method="post" id="form1">
        <div class="table">

            <!-- Fila Header -->
            <div class="fila header">
                <div class="celda">Imagen</div>
                <div class="celda">Fecha</div>
                <div class="celda">Producto</div>
                <div class="celda">Descripcion</div>
                <div class="celda">Cantidad</div>
                <div class="celda">Costo</div>
                <div class="celda">Subtotal</div>
            </div>


            <!-- Fila Contenido -->
            <?php
            if ($res_pedidos_productos && $res_pedidos_productos->num_rows > 0) {
                while ($row = $res_pedidos_productos->fetch_array(MYSQLI_ASSOC)) {
                    $archivo_f = $row['archivo_f'];
                    $nombre = $row['nombre'];
                    $descripcion = $row['descripcion'];
                    $cantidad = $row['cantidad'];
                    $costo = $row['costo'];
                    $subtotal = $cantidad * $costo;
                    $total += $subtotal; 
                    ?>
                    <div class="fila">
                        <div class="celda"><img src="<?php echo 'archivos/' . htmlspecialchars($archivo_f); ?>" alt="Producto" style="width: 100px; height: 80px;"></div>
                        <div class="celda"><?php echo htmlspecialchars($fecha); ?></div>
                        <div class="celda"><?php echo htmlspecialchars($nombre); ?></div>
                        <div class="celda"><?php echo htmlspecialchars($descripcion); ?></div>
                        <div class="celda"><?php echo htmlspecialchars($cantidad); ?></div>
                        <div class="celda"><?php echo htmlspecialchars($costo); ?></div>
                        <div class="celda"><?php echo htmlspecialchars($subtotal); ?></div>
                    </div>
                    <?php
                }
            } else {
                echo "<div class='fila'><div class='celda' colspan='6'>No hay productos en el carrito.</div></div>";
            }
            ?>
        </div> 

        <br><br>
            <div class="total" style="text-align: center;">Total: <?php echo htmlspecialchars($total); ?></div>

        <div>
            <a href="productos_lista.php?confirmar_compra=1" id="botonCesta" class="link botonCesta">Confirmar compra</a><br><br>
        </div>
    </form>
    <div id="notification" class="notification"></div>
</body>
</html>

<script type="text/javascript">
    $(document).ready(function() {
    $('#botonCesta').click(function(e) {
        e.preventDefault(); // Evitar el comportamiento predeterminado del enlace

        // Realizar la solicitud AJAX
        $.ajax({
            type: 'GET',
            url: 'productos_carrito_salva.php', // La URL del archivo PHP que contiene el código para manejar la actualización del estado del pedido
            data: { confirmar_compra: 1 }, // Los datos que quieres enviar al servidor
            success: function(response) {
                // alert(response); // Muestra la respuesta del servidor en un cuadro de diálogo
                document.getElementById('notification').innerText = response;
                window.location.href = "productos_lista.php";
            },
            error: function(xhr, status, error) {
                // Manejar errores en caso de que la solicitud AJAX falle
                console.error(xhr.responseText);
            }
        });
    });
});

</script>





