<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Inicio de Sesión</title>
</head>
<body>
    <h2>Formulario de Inicio de Sesión</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="username">Nombre de usuario:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Iniciar Sesión</button>
    </form>

    <?php
    // Set secure session cookie parameters
    session_set_cookie_params([
        'lifetime' => 3600,
        'path' => '/',
        'domain' => 'example.com',
        'secure' => true,  // Only send cookie over HTTPS
        'httponly' => true  // Prevent JavaScript access to the cookie
    ]);

    // Iniciar sesión
    session_start();

    // Procesamiento del formulario de inicio de sesión
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recuperar los datos del formulario
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Validar el nombre de usuario y la contraseña (solo un ejemplo)
        if ($username === 'usuario' && $password === 'contraseña') {
            // Regenerar ID de sesión
            session_regenerate_id(true);

            // Establecer variables de sesión
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;

            // Redirigir a la página de inicio
            header("Location: inicio.php");
            exit();
        } else {
            echo "Nombre de usuario o contraseña incorrectos.";
        }
    }
    ?>
</body>
</html>
