<?php
// Iniciar sesión
session_start();

// Conexión a la base de datos
$pdo = new PDO(
     'mysql:host=localhost;dbname=mydatabase',
     'root',
     '');

// Función para validar la entrada del usuario
function validateInput($data) {
    // Eliminar espacios en blanco al principio y al final
    $data = trim($data);
    // Convertir caracteres especiales a entidades HTML para prevenir ataques XSS
    $data = htmlspecialchars($data);
    return $data;
}

// Comprobar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar nombre de usuario y contraseña
    $username = validateInput($_POST['username']);
    $password = validateInput($_POST['password']);

    // Hash de la contraseña
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Ejecutar la consulta de inserción de datos
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    if ($stmt->execute([$username, $hashedPassword])) {
        // Usuario registrado correctamente
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        // Error al registrar el usuario
        $error = "Error al registrar el usuario.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if(isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Nombre de usuario:</label><br>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Iniciar sesión">
    </form>
</body>
</html>
