
<?php
// Iniciar sesión
session_start();


// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    // Si no ha iniciado sesión, redirigir al formulario de inicio de sesión
    header("Location: index6.php");
    exit();
}

// Obtener el nombre de usuario de la sesión
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h2>Bienvenido, <?php echo $username; ?>!</h2>
    <p>Este es tu panel de control.</p>
    <p><a href="logout.php">Cerrar sesión</a></p>
</body>
</html>
