<?php  

// error_reporting(0);//Silencia los errores para que no se muestren al usuario.
// // session_name('user_session');
// session_start();
// if(!$correo = $_SESSION['correoUser']){
//     header("Location: productos.php");
//     exit();
// }

// $nombre = $_SESSION['nombreUser'];
// $correo = $_SESSION['correoUser'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


    
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

        .carrito {
            background: rgb(218, 100, 255);
            border-radius: 8px;
            padding: 5px 10px;
            margin: 0 5px;
            cursor: pointer;
            text-decoration: none;
        }

        
    </style>
</head>
<body>


    
<section>

<!-- <header>

        <h1 class="titulo"><?php echo $nombre; ?> <span>bienvenido al sistema Star </span></h1>

</header> -->
        <?php 
            include('navegacion.php');
        ?>

        <h2>Contacto</h2>

        <form class="formulario" action="enviarNoaut.php" method="post">
            <fieldset>
                <legend>Contactános llenando todos los campos</legend>

                <div class="contenedor-campos">
                    <div class="campo">
                        <label>Nombre</label>
                        <input id="nombre" name=nombre class="input-text" type="text" placeholder="Tu Nombre">
                    </div>

                    <div class="campo">
                        <label>Telefono</label>
                        <input id="telefono" name="telefono" class="input-text" type="tel" placeholder="Tu Teléfono">
                    </div>

                    <div class="campo">
                        <label>Correo</label>
                        <input id="correo" name="correo" class="input-text" type="email" placeholder="Tu Email">
                    </div>
            
                    <div class="campo">
                        <label>Mensaje</label>
                        <textarea id="texto" name="texto" class="input-text"></textarea>
                    </div>
                </div> <!-- .contenedor-campos -->

                <div class="alinear-derecha flex">
                    <input class="boton w-sm-100" type="submit" value="Enviar">
                </div>
            </fieldset>
        </form>
    </section>
    <br><br><br>

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