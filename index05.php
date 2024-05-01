<?php

// Iniciar sesión
session_start();

// Almacenar datos en la sesión
$_SESSION['username'] = 'john_doe';
$_SESSION['user_id'] = 12345;

// Acceder a los datos de la sesión
$username = $_SESSION['username'];
$userId = $_SESSION['user_id'];
echo "¡Bienvenido de nuevo, $username (ID: $userId)";

// Finalizar la sesión y eliminar los datos de la sesión
session_destroy();

?>
