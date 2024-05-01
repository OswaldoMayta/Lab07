<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Correo Electrónico</title>
</head>
<body>

<?php
// Procesamiento del formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validación del correo electrónico
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Correo electrónico inválido";
    } else {
        // El correo electrónico es válido, puedes realizar alguna acción aquí
        echo "Correo electrónico válido: $email";
    }
}
?>

<h2>Formulario de Correo Electrónico</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="email">Correo electrónico:</label>
    <input type="email" id="email" name="email" required>
    <button type="submit">Enviar</button>
</form>

<?php
// Mostrar errores de validación, si los hay
if (isset($error)) {
    echo "<p>$error</p>";
}
?>

</body>
</html>

