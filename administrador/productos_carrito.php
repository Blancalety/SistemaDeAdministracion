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
        // Obtener el costo del producto
        $id_producto = $row_productos['id'];
        $costo = $row_productos['costo'];
        $nombre = $row_productos['nombre'];
        $descripcion = $row_productos['descripcion'];
        $stock = $row_productos['stock'];
    } else {
        // Si no se encuentra el producto, establecer el costo como 0 o cualquier valor predeterminado
        $costo = 0;
    }

    // Obtener id_pedido
    $sql_pedido = "SELECT * FROM pedidos WHERE id_usuario = $id_usuario AND status = 0";
    $res_pedido = $con->query($sql_pedido);

    if ($res_pedido->num_rows > 0) {
        $row_pedido = $res_pedido->fetch_assoc();
        $id_pedido = $row_pedido['id'];
        $fecha = $row_pedido['fecha'];
    
        // Consultar productos en el pedido
        $sql_pedidos_productos = "SELECT pp.*, p.nombre, p.descripcion, p.costo 
                                  FROM pedidos_productos pp 
                                  INNER JOIN productos p ON pp.id_producto = p.id 
                                  WHERE pp.id_pedido = $id_pedido";
        $res_pedidos_productos = $con->query($sql_pedidos_productos);
    } else {
        // Si no se encuentra el pedido
        $id_pedido = null;
        $fecha = null;
        $res_pedidos_productos = null;
    }

    // $sql = "SELECT * FROM pedidos_productos WHERE id_producto = $id_producto AND id_pedido = $id_pedido";
    // $res = $con->query($sql);
    // $num = $res->num_rows;

    // if ($res->num_rows > 0) {
    //     // Obtener la primera fila del resultado
    //     $row = $res->fetch_assoc();
    //     // Obtener datos
    //     $cantidad = $row['cantidad'];
    // } else {
    //     // Si no se encuentra el producto
    //     $costo = 0;
    // }

    ?>

<?php
    
    ?>

    <div class='titulo'>Carrito</div>
    <a href="productos_lista.php" class="link botonlista">Cancelar y volver</a><br><br>

    <div class="table">

        <!-- Fila Header -->
        <div class="fila header">
            <div class="celda">Fecha</div>
            <div class="celda">Producto</div>
            <div class="celda">Descripcion</div>
            <div class="celda">Cantidad</div>
            <div class="celda">Costo</div>
            <div class="celda">Total</div>
        </div>

        <!-- Fila Contenido -->
        <?php
        if ($res_pedidos_productos && $res_pedidos_productos->num_rows > 0) {
            while ($row = $res_pedidos_productos->fetch_array(MYSQLI_ASSOC)) {
                $nombre = $row['nombre'];
                $descripcion = $row['descripcion'];
                $cantidad = $row['cantidad'];
                $costo = $row['costo'];
                $total = $cantidad * $costo;
                ?>
                <div class="fila">
                    <div class="celda"><?php echo htmlspecialchars($fecha); ?></div>
                    <div class="celda"><?php echo htmlspecialchars($nombre); ?></div>
                    <div class="celda"><?php echo htmlspecialchars($descripcion); ?></div>
                    <div class="celda"><?php echo htmlspecialchars($cantidad); ?></div>
                    <div class="celda"><?php echo htmlspecialchars($costo); ?></div>
                    <div class="celda"><?php echo htmlspecialchars($total); ?></div>
                </div>
                <?php
            }
        } else {
            echo "<div class='fila'><div class='celda' colspan='6'>No hay productos en el carrito.</div></div>";
        }
        ?>

    </div> 

    <div>
        <a href="productos_lista.php" class="link botonCesta">Confirmar</a><br><br>
    </div>


</body>
</html>


