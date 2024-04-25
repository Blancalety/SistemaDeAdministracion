<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validación de Campo con onblur</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <h2>Validación de Campo con onblur</h2>

    <form>
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" onblur="validateUsername()">
        <span id="usernameError" style="color: red;"></span>

        <br><br>

        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" onblur="validateEmail()">
        <span id="emailError" style="color: red;"></span>

        <br><br>

        <input type="submit" value="Enviar">
    </form>

    <script>
        function validateUsername() {
            const username = $('#username').val();
            const usernameError = $('#usernameError');

            if (username.length < 5) {
                usernameError.text('El usuario debe tener al menos 5 caracteres.');
            } else {
                usernameError.text('');
            }
        }

        function validateEmail() {
            const email = $('#email').val();
            const emailError = $('#emailError');

            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

            if (!emailPattern.test(email)) {
                emailError.text('El correo electrónico no es válido.');
            } else {
                emailError.text('');
            }
        }
    </script>

</body>
</html>
