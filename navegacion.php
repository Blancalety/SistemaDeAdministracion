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

            <a href="inicio.php">Home</a>
            <a href="productos.php">Productos</a>
            <a href="#">Contacto</a>
            <a href="#">Carrito</a>
            <a href="login.php">Inicio de sesion</a>
            <a href="cliente_alta.php">Crear cuenta</a>

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
                <p> Estamos muy felices de que estes aqui!!</>
                <p> Inicia sesión o crea tu cuenta para que tengas acceso total a la pagina :) </p>
            </section>
        </div> 
    </main>

</body>
</html>