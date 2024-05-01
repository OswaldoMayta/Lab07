<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usuarios_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se han enviado los datos del formulario
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // Recuperar los datos del formulario
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        // Hashear la contraseña antes de almacenarla en la base de datos
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Insertar el usuario y la contraseña hasheada en la base de datos
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Error de preparación de consulta: " . $conn->error);
        }
        $stmt->bind_param("ss", $username, $hashedPassword);
        if ($stmt->execute()) {
            echo "Usuario registrado exitosamente.";
        } else {
            echo "Error al registrar el usuario: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Cerrar conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de usuario</title>
</head>
<body>
    <h2>Registro de usuario</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="username">Usuario:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password"><br>
        <input type="submit" value="Registrar usuario">
    </form>
</body>
</html>
