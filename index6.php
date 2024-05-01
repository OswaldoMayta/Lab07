<?php
// Start session
session_start();

// Dummy user data (replace with database query in a real application)
$validUsername = "user";
$validPasswordHash = password_hash("password", PASSWORD_DEFAULT);

// Function to validate user input
function validateInput($data) {
    // Remove leading and trailing whitespaces
    $data = trim($data);
    // Convert special characters to HTML entities to prevent XSS attacks
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username and password
    $username = validateInput($_POST['username']);
    $password = validateInput($_POST['password']);

    // Verify user credentials
    if ($username === $validUsername && password_verify($password, $validPasswordHash)) {
        // Set session variables
        $_SESSION['username'] = $username;
        // Redirect to dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        // Invalid username or password
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?= if(isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <form method="post" action="<?= echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
