<?php

session_start();
if(!$correo = $_SESSION['correoUser']){
    header("Location: index.php");
}
$nombre = $_SESSION['nombreUser'];
$correo = $_SESSION['correoUser'];

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de promociones</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .table {
            /* display: table;
            width: 80%;
            margin-top: 25px;
            font-family: Arial, sans-serif;
            border: 1px solid #000;
            border-radius: 5px;
            margin-left: auto;  /* Ajusta el margen izquierdo a automático para centrar */
            /* margin-right: auto; */ 

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
            padding: 20px;
            text-align: center;
            border-radius: 9px;
            margin: 10px auto auto; 
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
        
    </style>
</head>
<body>

<script>

function botonDetalles() {
    $(".detalles a").on("click", function(e) {
        e.preventDefault(); // Evita el comportamiento por defecto del enlace
        
        var numero_id = $(this).data("id");

        $.ajax({
            url: 'promociones_detalle.php', 
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
                        var promocion = response.promocion;
                        var url = 'muestra_detallesPromocion.php?nombre=' + promocion.nombre + '&status=' + promocion.status + '&archivo=' + promocion.archivo;
                        
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

function botonEditar() {
    $(".editar a").on("click", function(e) {
        e.preventDefault(); // Evita el comportamiento por defecto del enlace
  
        var numero_id = $(this).data("id");

        $.ajax({
            url: 'promociones_detalle.php', 
            method: 'POST',
            dataType: 'json',
            data: {id: numero_id}, // Envío de id, y otras variables
            success: function(response) {
                if (response.success) {
                    $("#notification").html("Cargando edicion...").show();
                    setTimeout(function() {
                        $("#notification").html("").hide();
                    // Redirige después de x segundos
                    setTimeout(function() {
                        var promocion = response.promocion;
                        var url = 'muestra_edicionPromocion.php?nombre=' + promocion.nombre + '&archivo=' + promocion.archivo +
                        '&id=' + promocion.id;
                        
                        window.location.href = url; // Redireccionar a la página con datos en URL
                    }, 300);
                }, 400);


                } else {
                    //console.log(response.data);// Imprimir los datos en la consola del navegador
                    $("#notification").html("Error al ver edicion").show();
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

function botonEliminar() {
    $(".eliminar a").on("click", function(e) {
        e.preventDefault(); // Evita el comportamiento por defecto del enlace

        if (confirm("¿Quieres eliminar esta fila?")) {
            var numero_id = $(this).data("id"); // Obtiene el ID del registro a eliminar
            $.ajax({
                url: 'promociones_elimina.php', // Script PHP para eliminar el empleado
                method: 'POST',
                dataType: 'json',
                data: { id: numero_id }, // Envía el ID del registro
                success: function(response) {
                    if (response.success) {
                        $('[data-id="' + numero_id + '"]').closest('.fila').hide();
                        $("#notification").html("Eliminado exitosamente").show();
                        setTimeout(function() {
                            $("#notification").html("").hide();
                        }, 3000);
                    } else {
                        $("#notification").html("Error al eliminar el registro").show();
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
        }
    });
}




$(document).ready(function() {
    botonDetalles();
    botonEditar();
    botonEliminar();
});

</script>


<?php

    require "funciones/conecta.php";
    $con = conecta();

    $sql = "SELECT * FROM promociones WHERE status = 1 AND eliminado = 0";
    $res = $con->query($sql);
    $num = $res->num_rows;


    $roles = [
        1 => 'Gerente',
        2 => 'Ejecutivo',
    ];

    $opciones = [
        1 => 'Ver detalle',
        2 => 'Editar',
        3 => 'Eliminar',
    ];

    

    ?>

<?php

include('navegacionGeneral.php');

?>

    <div class='titulo'>Lista de promociones (<?php echo $num; ?>)</div>
    <a href="promociones_alta.php" class="link botonlista">Agregar nueva promocion</a><br><br>
    <div class="table">

        <?php
        while ($fila = $res->fetch_array()) {   
            
            $archivo = $fila["archivo"];        
            $id = $fila["id"];
            $nombre = $fila["nombre"];
            
            ?>


            <!-- Fila Contenido -->
            <div class="fila">   
                <?php echo "<div ><a href=\"promociones_detalle.php?id=$id\" ><img src=\"archivos/$archivo\" width=\"380\" height=\"350\"/></a></div>";?>
                <!-- <div class="celda"><?php echo $id; ?></div> -->
                <div class="celda"><?php echo $nombre; ?></div>

                <div class="celda">
                    <span class="detalles">
                        <a class='designletra' href="#" data-id="<?php echo $id; ?>"><?php echo $opciones[1]; ?></a>
                    </span>

                    <span class="editar">
                        <a class='designletra' href="#" data-id="<?php echo $id; ?>"><?php echo $opciones[2]; ?></a>
                    </span>

                    <span class="eliminar">
                        <a href="#" class='link' data-id="<?php echo $id; ?>"><?php echo $opciones[3]; ?></a>
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

</html>
