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

</body>
</html>