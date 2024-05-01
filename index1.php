<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Usuario</title>
</head>
<body>
    <h2>Registro de Usuario</h2>
    <form action="procesar_registro.php" method="post">
        <label for="username">Nombre de usuario:</label>
        <input type="text" id="username" name="username">
        <button type="submit">Registrarse</button>
    </form>

     <?php
     // Output escaping example
     $username = "<script>alert('XSS attack');</script>";
     echo htmlspecialchars($username);
     ?>
</body>
</html>


