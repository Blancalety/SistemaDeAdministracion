<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
    <link rel="preload" href="css/normalize.css" as="style">
    <link rel="stylesheet" href="css/normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Krub:wght@400;700&display=swap" rel="stylesheet">
    <link rel="preload" href="css/styles.css" as="style">
    <link href="css/stylesGeneral.css" rel="stylesheet">
</head>
<body>

    <div class="nav-bg">
        <nav class="navegacion-principal contenedor">
            <a href="index.php">Inicio</a>
            <a href="empleados_lista.php">Empleados</a>
            <a href="productos_lista.php">Productos</a>
            <a href="promociones_lista.php">Promociones</a>
            <a href="pedidos_lista.php">Pedidos</a>
            <a href="bienvenido.php">Bienvenido <?php echo $nombre; ?> </a>
            <a href="cerrar_sesion.php">Cerrar Sesion</a>
        </nav>
    </div>
    
   
</body>
</html>