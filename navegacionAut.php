<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link rel="preload" href="css/normalize.css" as="style">
    <link rel="stylesheet" href="css/normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Krub:wght@400;700&display=swap" rel="stylesheet">
    <link rel="preload" href="css/styles.css" as="style">
    <link href="css/stylesC.css" rel="stylesheet">
</head>
<body>

<div class="nav-bg">
        <nav class="navegacion-principal contenedor">
            <a href="inicioAut.php">Home</a>
            <a href="bienvenido_cliente.php">Productos</a>
            <a href="contacto.php">Contacto</a>
            <!-- <a href="productos_carritoF1.php">Carrito</a> -->
            
            <a href="productos_carritoF1.php" class="centrar">
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M17 17h-11v-14h-2" />
                    <path d="M6 5l14 1l-1 7h-13" />
                </svg>
            </a>

            <a href="cerrar.php">Cerrar Sesion</a>



            <!-- <a href="#">Pedidos</a>
            <a href="#">Bienvenido <?php echo $nombre; ?> </a>
            <a href="#">Cerrar Sesion</a> -->
        </nav>
    </div>
    
    <section class="hero">
        <div class="contenido-hero">
            <h2>Moda a tu medida</h2>
            
            <div class="ubicacion">
                <?php echo "<div><img src=\"archivos/icono.jpg\" width=\"200\" height=\"210\" class=\"rounded\"/></a></div>"; ?>
            </div> 
        </div>        
    </section>
    
    <main class="contenedor sombra">
        <h2>Marcas originales</h2>

        <div class="servicios">
            <section class="servicio">
                <h3>Bienvenido a Star!</h3>
                <p> Estamos muy felices de que estes aqui. </p>
            </section>
        </div> 
    </main>

</body>
</html>