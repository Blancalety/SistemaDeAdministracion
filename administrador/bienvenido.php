<?php

session_start();

$nombre = $_SESSION['nombreUser'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>

</head>
<body>

    <header>

        <h1 class="titulo"><?php echo $nombre; ?> <span>bienvenido al sistema Star </span></h1>

    </header>
    <!-- <div class="titulo">Hola <?php echo $nombre; ?> bienvenido al sistema Star</div> -->

    <?php

        include('navegacion.php');

    ?>

        <section>

            <form action="http://google.com" class="formulario">
                <fieldset>
                    <legend>Contactame llenando todos los campos</legend>
                    <div class="contenedor-campos">
                        <div class="campo">
                            <label>Nombre</label>
                            <input class="input-text" type="input-text" placeholder="Tu nombre">
                        </div>

                        <div class="campo">
                            <label>Telefono</label>
                            <input class="input-text" type="input-text" placeholder="Tu telefono">
                        </div>

                        <div class="campo">
                            <label>Correo</label>
                            <input class="input-text" type="input-text" placeholder="Tu email">
                        </div>

                        <div class="campo">
                            <label>Mensaje</label>
                            <textarea class="input-text"></textarea>
                        </div>
                    </div><!--.contenedor-campos-->

                    <div class="alinear-derecha flex">
                            <input class="boton w100" type="submit" value="Enviar">
                        
                    </div>

                </fieldset>
            </form>
        </section>

    </main>


    <footer class="footer">
        <p>Todos los derechos reservados. Blanca leticia RR</p>
    </footer>

  
</body>
</html>