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
    <title>Bienvenido</title>

</head>
<body>

    <header>
        <h1 class="titulo"><?php echo $nombre; ?> <span>bienvenido al sistema Star </span></h1>
    </header>

    <?php

        include('navegacion.php');

    ?>

</body>
</html>