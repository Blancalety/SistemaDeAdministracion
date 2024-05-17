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
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>

    <div class="nav-bg">
        <nav class="navegacion-principal contenedor">
            <a href="bienvenido.php">Inicio</a>
            <a href="empleados_lista.php">Empleados</a>
            <a href="#">Productos</a>
            <a href="#">Promociones</a>
            <a href="#">Pedidos</a>
            <a href="#">Bienvenido <?php echo $nombre; ?> </a>
            <a href="#">Cerrar Sesion</a>
        </nav>
    </div>
    
    <section class="hero">
        <div class="contenido-hero">
            <h2>Administracion de empleados</h2> 
            <div class="ubicacion">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pin" width="50" height="50" viewBox="0 0 24 24" stroke-width="1.5" stroke="#FFC107" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z"/>
                    <circle cx="12" cy="11" r="3" />
                    <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 0 1 -2.827 0l-4.244-4.243a8 8 0 1 1 11.314 0z" />
                </svg>
                <p>Guadalajara, Jalisco</p>
    </section>
    
    <main class="contenedor sombra">
        <h2>Menu principal</h2>

        <div class="servicios">
            <section class="servicio">
                <h3>Bienvenido a Star!</h3>
                <p> Estamos muy felices de que estes aqui. </p>
            </section>
        </div> 
    </main>
    
    <footer class="footer">
        <p>Todos los derechos reservados. Blanca leticia RR</p>
    </footer>

</body>
</html>