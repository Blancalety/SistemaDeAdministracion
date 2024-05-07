<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=Subir archivos, initial-scale=1.0">
    <title>Subir archivos</title>
</head>
<body>
    
<!-- El metodo debe ser post y agregar el metodo de encriptacion, copia de compu hacia servidor -->
    <form enctype="multipart/form-data" action="archivos.php" method="post">
        <input type="file" id="archivo" name="archivo"><br><br>
        <input type="submit" value="Subir archivo" name="submit"><br><br>
    </form>

</body>
</html>