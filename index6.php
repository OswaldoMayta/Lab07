<?php
// Iniciar sesión
session_start();

// Configuración de la conexión PDO
$dsn = 'mysql:host=localhost;dbname=mi_base';
$username = 'root';
$password = '';

try {
    // Crear una nueva conexión PDO
    $pdo = new PDO($dsn, $username, $password);

    // Establecer el modo de error de PDO a excepción
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Mensaje de conexión exitosa
    echo "Conexión PDO exitosa";
    
    // Datos de usuario ficticios (reemplazar con una consulta a la base de datos en una aplicación real)
    $validUsername = "usuario";
    $validPasswordHash = password_hash("contraseña", PASSWORD_DEFAULT);

    // Función para validar la entrada del usuario
    function validarEntrada($data) {
        // Eliminar espacios en blanco al principio y al final
        $data = trim($data);
        // Convertir caracteres especiales a entidades HTML para prevenir ataques XSS
        $data = htmlspecialchars($data);
        return $data;
    }

    // Comprobar si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validar nombre de usuario y contraseña
        $username = validarEntrada($_POST['username']);
        $password = validarEntrada($_POST['password']);

        // Hash de la contraseña
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Ejecutar la consulta de inserción de datos
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        if (!$stmt->execute([$username, $hashedPassword])) {
            die("Error al insertar datos: " . $stmt->errorInfo()[2]);
        }

    // Verificar credenciales de usuario
        if ($username === $validUsername && password_verify($password, $validPasswordHash)) {
            // Establecer variables de sesión
            $_SESSION['username'] = $username;
            // Redirigir al panel de control
            header("Location: dashboard.php");
            exit();
        } else {
            // Nombre de usuario o contraseña inválidos
            $error = "Nombre de usuario o contraseña inválidos.";
        }
    }
} catch (PDOException $e) {
    // Manejar errores de conexión
    die("Error de conexión: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
</head>
<body>
    <h2>Iniciar sesión</h2>
    <?php if(isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Usuario:</label><br>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Iniciar sesión">
    </form>
</body>
</html>
