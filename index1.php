<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario con Escapado de Salida</title>
</head>
<body>
    <h2>Formulario de Registro</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="username">Nombre de usuario:</label>
        <input type="text" id="username" name="username" required>
        <button type="submit">Enviar</button>
    </form>

    <?php
    // Output escaping example
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recuperar el nombre de usuario del formulario
        $username = $_POST['username'];
        
        // Escapar el nombre de usuario para prevenir ataques XSS
        $escaped_username = htmlspecialchars($username);
        
        // Mostrar el nombre de usuario escapado
        echo "Nombre de usuario ingresado: " . $escaped_username;
    }
    ?>
</body>
</html>
