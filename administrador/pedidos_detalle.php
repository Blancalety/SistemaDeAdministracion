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
    <title>Pedidos detalles</title>
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
            width: 38%;
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

        .linkDetalles {
            color: black;
            font-family: Arial, sans-serif;
            font-size: 15px;
            font-weight: bold;
            box-shadow: 
                0 0 20px rgba(0, 0, 0, 0.7), /* Primera sombra */
                0 0 30px rgba(0, 0, 255, 0.2); /* Segunda sombra */
            padding: 7px;
            border-radius: 5px;
            text-decoration: none;
        }

    </style>
</head>

<body>

    <?php

    include('navegacionGeneral.php');

    require "funciones/conecta.php";

    $con = conecta();
    $id_usuario = $_SESSION['idUser']; 

    
    // Obtener el id_pedido de la URL
    $id_pedido = isset($_GET['id_pedido']) ? intval($_GET['id_pedido']) : 0;

    // Consulta para obtener los detalles del pedido y los productos asociados
    $sql_pedido_productos = "SELECT pp.id_pedido, p.fecha, pr.nombre AS nombre_producto, pr.descripcion, pp.cantidad, pr.costo, (pp.cantidad * pr.costo) AS subtotal, pr.archivo_f
                            FROM pedidos p
                            INNER JOIN pedidos_productos pp ON p.id = pp.id_pedido
                            INNER JOIN productos pr ON pp.id_producto = pr.id
                            WHERE p.id = ? AND p.status = 1";
    $stmt_pedido_productos = $con->prepare($sql_pedido_productos);
    $stmt_pedido_productos->bind_param("i", $id_pedido);
    $stmt_pedido_productos->execute();
    $res_pedido_productos = $stmt_pedido_productos->get_result();

    ?>

<?php
    
    ?>

    <div class='titulo'>Productos de su pedido</div>
    <a href="pedidos_lista.php" class="link botonlista">Listado de pedidos</a><br><br>
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
            if ($res_pedido_productos && $res_pedido_productos->num_rows > 0) {
                while ($row = $res_pedido_productos->fetch_assoc()) {
                    $archivo_f = $row['archivo_f'];
                    $img_src = 'archivos/' . $archivo_f;
                    $fecha = $row['fecha'];
                    $nombre_producto = $row['nombre_producto'];
                    $descripcion = $row['descripcion'];
                    $cantidad = $row['cantidad'];
                    $costo = $row['costo'];
                    $subtotal = $row['subtotal'];
                    $total += $subtotal;
                    ?>
                    <div class="fila">
                        <div class="celda" style="width: 150px; height: 120px;"><img src="<?php echo htmlspecialchars($img_src); ?>" alt="<?php echo htmlspecialchars($nombre_producto); ?>" style="width: 50px; height: 50px;"></div>
                        <div class="celda"><?php echo htmlspecialchars($fecha); ?></div>
                        <div class="celda"><?php echo htmlspecialchars($nombre_producto); ?></div>
                        <div class="celda"><?php echo htmlspecialchars($descripcion); ?></div>
                        <div class="celda"><?php echo htmlspecialchars($cantidad); ?></div>
                        <div class="celda"><?php echo htmlspecialchars($costo); ?></div>
                        <div class="celda"><?php echo htmlspecialchars($subtotal); ?></div>
                    </div>
                    <?php
                }
            } else {
                echo "<div class='fila'><div class='celda' colspan='6'>No hay pedidos.</div></div>";
            }
            ?>
        </div> 

        <br><br>
        <div class="total" style="text-align: center;">Total: <?php echo htmlspecialchars($total); ?></div>
        <br><br><br><br>
        
    </form>
    <div id="notification" class="notification"></div>
</body>
</html>



</script>





