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
            <a href="bienvenido_cliente">Home</a>
            <a href="inicioAut">Productos</a>
            <a href="#">Contacto</a>
            <!-- <a href="productos_carritoF1">Carrito</a> -->

            <a href="productos_carritoF1.php" class="centrar">
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M17 17h-11v-14h-2" />
                    <path d="M6 5l14 1l-1 7h-13" />
                </svg>
            </a>


            <!-- <a href="#">Pedidos</a>
            <a href="#">Bienvenido <?php echo $nombre; ?> </a>
            <a href="#">Cerrar Sesion</a> -->
        </nav>
    </div>
   
</body>
</html>